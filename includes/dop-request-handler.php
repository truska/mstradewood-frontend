<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/dbcon.php';
require_once __DIR__ . '/prefs.php';
require_once __DIR__ . '/../wccms/includes/email.php';

function dop_redirect(string $url): void {
  header('Location: ' . $url, true, 302);
  exit;
}

function dop_safe_return_url(string $url): string {
  $url = trim($url);
  if ($url === '') {
    return '/welcome';
  }
  if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
    $parts = parse_url($url);
    $path = (string) ($parts['path'] ?? '/welcome');
    $query = isset($parts['query']) ? '?' . $parts['query'] : '';
    return $path . $query;
  }
  if ($url[0] !== '/') {
    $url = '/' . $url;
  }
  return $url;
}

$returnUrl = dop_safe_return_url((string) ($_POST['return_url'] ?? ($_SERVER['HTTP_REFERER'] ?? '/welcome')));

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
  dop_redirect($returnUrl);
}

$token = (string) ($_POST['csrf_token'] ?? '');
$sessionToken = (string) ($_SESSION['dop_request_csrf'] ?? '');
if ($token === '' || $sessionToken === '' || !hash_equals($sessionToken, $token)) {
  $_SESSION['dop_request_flash'] = [
    'type' => 'error',
    'message' => 'Your session expired. Please try again.',
    'product_id' => (int) ($_POST['product_id'] ?? 0),
  ];
  dop_redirect($returnUrl);
}

$name = trim((string) ($_POST['name'] ?? ''));
$company = trim((string) ($_POST['company'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$productId = (int) ($_POST['product_id'] ?? 0);
$productName = trim((string) ($_POST['product_name'] ?? ''));
$captchaVersion = trim((string) cms_pref('prefCaptchaVer', '2'));
if ($captchaVersion !== '3') {
  $captchaVersion = '2';
}
$captchaSiteKey = trim((string) cms_pref('prefCaptchaSiteKey', ''));
$captchaSecret = trim((string) cms_pref('prefCaptchaSecret', (string) cms_pref('prefCaptchaSecretKey', (string) cms_pref('prefCaptchaSecretKeyV3', ''))));
$captchaEnabled = ((string) cms_pref('prefCaptchaEnabled', (string) cms_pref('prefCaptcha', 'No')) === 'Yes');
$useCaptcha = $captchaEnabled && $captchaSiteKey !== '' && $captchaSecret !== '';

if ($name === '' || $company === '' || $email === '' || $phone === '' || $productName === '') {
  $_SESSION['dop_request_flash'] = [
    'type' => 'error',
    'message' => 'Please complete all fields before sending.',
    'product_id' => $productId,
  ];
  dop_redirect($returnUrl);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['dop_request_flash'] = [
    'type' => 'error',
    'message' => 'Please enter a valid email address.',
    'product_id' => $productId,
  ];
  dop_redirect($returnUrl);
}

$captchaToken = trim((string) ($_POST['g-recaptcha-response'] ?? ($_POST['recaptcha_token'] ?? '')));
if ($useCaptcha) {
  if ($captchaToken === '') {
    $_SESSION['dop_request_flash'] = [
      'type' => 'error',
      'message' => 'Please complete the captcha check.',
      'product_id' => $productId,
    ];
    dop_redirect($returnUrl);
  }

  $verifyContext = stream_context_create([
    'http' => [
      'method' => 'POST',
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'content' => http_build_query([
        'secret' => $captchaSecret,
        'response' => $captchaToken,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
      ]),
      'timeout' => 4,
    ],
  ]);
  $captchaResponse = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $verifyContext);
  $captchaData = $captchaResponse ? json_decode($captchaResponse, true) : null;
  $captchaSuccess = is_array($captchaData) && !empty($captchaData['success']);

  if ($captchaSuccess && $captchaVersion === '3') {
    $minScore = (float) cms_pref('prefCaptchaMinScore', 0.3);
    $score = (float) ($captchaData['score'] ?? 0);
    $action = trim((string) ($captchaData['action'] ?? ''));
    if ($score < $minScore || ($action !== '' && $action !== 'dop_request')) {
      $captchaSuccess = false;
    }
  }

  if (!$captchaSuccess) {
    $_SESSION['dop_request_flash'] = [
      'type' => 'error',
      'message' => 'Captcha verification failed. Please try again.',
      'product_id' => $productId,
    ];
    dop_redirect($returnUrl);
  }
}

$to = (string) cms_pref('prefManageEmail', (string) cms_pref('prefEmail', ''));
if ($to === '') {
  $_SESSION['dop_request_flash'] = [
    'type' => 'error',
    'message' => 'DOP email destination is not configured.',
    'product_id' => $productId,
  ];
  dop_redirect($returnUrl);
}

$subject = 'DOP Request: ' . $productName;
$pageUrl = cms_base_url($returnUrl);
$html = ''
  . '<h3>DOP Request</h3>'
  . '<p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>Company:</strong> ' . htmlspecialchars($company, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>Phone:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</p>'
  . '<p><strong>Product:</strong> ' . htmlspecialchars($productName, ENT_QUOTES, 'UTF-8') . ' (ID: ' . $productId . ')</p>'
  . '<p><strong>Page:</strong> ' . htmlspecialchars($pageUrl, ENT_QUOTES, 'UTF-8') . '</p>';

$ok = cms_send_mail($to, $subject, $html, '', 'web');

$_SESSION['dop_request_flash'] = [
  'type' => $ok ? 'success' : 'error',
  'message' => $ok
    ? 'Thank you. Your DOP request has been sent.'
    : 'We could not send your request right now. Please try again.',
  'product_id' => $productId,
];

dop_redirect($returnUrl);
