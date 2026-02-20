<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

if (empty($_SESSION['dop_request_csrf'])) {
  $_SESSION['dop_request_csrf'] = bin2hex(random_bytes(16));
}

$dopProductId = (int) ($rowproduct['id'] ?? 0);
$dopProductName = trim((string) ($rowproduct['name'] ?? ''));
$dopText = trim((string) ($rowproduct['doptext'] ?? "Declaration of Performance"));
$dopReturnUrl = (string) ($_SERVER['REQUEST_URI'] ?? '/');
$dopFlash = null;
$captchaVersion = trim((string) cms_pref('prefCaptchaVer', '2'));
if ($captchaVersion !== '3') {
  $captchaVersion = '2';
}
$captchaSiteKey = trim((string) cms_pref('prefCaptchaSiteKey', ''));
$captchaSecret = trim((string) cms_pref('prefCaptchaSecret', (string) cms_pref('prefCaptchaSecretKey', (string) cms_pref('prefCaptchaSecretKeyV3', ''))));
$captchaEnabled = ((string) cms_pref('prefCaptchaEnabled', (string) cms_pref('prefCaptcha', 'No')) === 'Yes');
$useCaptcha = $captchaEnabled && $captchaSiteKey !== '' && $captchaSecret !== '';

if (!empty($_SESSION['dop_request_flash']) && is_array($_SESSION['dop_request_flash'])) {
  $flashProductId = (int) ($_SESSION['dop_request_flash']['product_id'] ?? 0);
  if ($flashProductId === 0 || $flashProductId === $dopProductId) {
    $dopFlash = $_SESSION['dop_request_flash'];
    unset($_SESSION['dop_request_flash']);
  }
}
?>

<?php if ($dopFlash): ?>
  <div class="container inner">
    <div class="alert alert-<?php echo ($dopFlash['type'] ?? '') === 'success' ? 'success' : 'danger'; ?> mt-3" role="alert">
      <?php echo htmlspecialchars((string) ($dopFlash['message'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
    </div>
  </div>
<?php endif; ?>

<style>
  #dopRequestModal .modal-dialog {
    max-width: 560px;
  }
  #dopRequestModal .modal-content {
    border: 0;
    border-radius: 0;
    background: #efefef;
    padding: 18px 26px 20px;
  }
  #dopRequestModal .modal-header {
    border: 0;
    padding: 0;
    margin: 0 0 8px 0;
    position: relative;
  }
  #dopRequestModal .modal-title {
    font-family: 'Lato', sans-serif;
    font-size: 24px;
    line-height: 1.1;
    color: #454545;
    font-weight: 400;
    padding-right: 56px;
  }
  #dopRequestModal .dop-modal-close {
    position: absolute;
    right: -12px;
    top: -12px;
    width: 44px;
    height: 44px;
    border: 0;
    border-radius: 50%;
    background: #b6b6b6;
    color: #fff;
    font-size: 30px;
    line-height: 42px;
    text-align: center;
    padding: 0;
  }
  #dopRequestModal .modal-body {
    padding: 0;
  }
  #dopRequestModal .form-label {
    margin: 4px 0 0;
    font-size: 14px;
    line-height: 1.2;
    color: #8e8e8e;
    font-weight: 300;
  }
  #dopRequestModal .form-control {
    border: 0;
    border-bottom: 2px solid #9c9c9c;
    border-radius: 0;
    box-shadow: none;
    background: transparent;
    padding: 4px 2px 7px;
    font-size: 14px;
    line-height: 1.25;
    color: #444;
  }
  #dopRequestModal .form-control:focus {
    border-bottom-color: #444;
    box-shadow: none;
    background: transparent;
  }
  #dopRequestModal .dop-request-summary {
    margin-top: 10px;
    font-size: 16px;
    line-height: 1.18;
    color: #4a4a4a;
  }
  #dopRequestModal .dop-request-summary strong {
    font-weight: 700;
  }
  #dopRequestModal .modal-footer {
    background: transparent;
    border: 0;
    padding: 0;
    margin-top: 10px;
    justify-content: flex-start;
    gap: 10px;
  }
  #dopRequestModal .modal-footer .btn {
    border-radius: 4px;
    font-size: 14px;
    line-height: 1.1;
    padding: 6px 12px;
    text-transform: none;
  }
  #dopRequestModal .btn-dop-send {
    background: #3e3e3e;
    color: #fff;
    border: 1px solid #3e3e3e;
  }
  #dopRequestModal .btn-dop-send:hover {
    background: #2f2f2f;
    color: #fff;
  }
  #dopRequestModal .btn-dop-cancel {
    background: transparent;
    color: #555;
    border: 1px solid #a9a9a9;
  }
  #dopRequestModal .btn-dop-cancel:hover {
    background: #e4e4e4;
    color: #444;
  }
  #dopRequestModal .g-recaptcha {
    margin-top: 12px;
  }
  @media (max-width: 768px) {
    #dopRequestModal .modal-content {
      padding: 16px 14px 18px;
    }
    #dopRequestModal .modal-title {
      font-size: 22px;
    }
    #dopRequestModal .form-label {
      font-size: 13px;
    }
    #dopRequestModal .form-control {
      font-size: 13px;
    }
    #dopRequestModal .dop-request-summary {
      font-size: 15px;
    }
    #dopRequestModal .modal-footer .btn {
      font-size: 13px;
    }
  }
</style>

<div class="modal fade" id="dopRequestModal" tabindex="-1" aria-labelledby="dopRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="dopRequestForm" method="post" action="<?php echo $baseURL; ?>/includes/dop-request-handler.php" data-captcha-version="<?php echo htmlspecialchars($captchaVersion, ENT_QUOTES, 'UTF-8'); ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="dopRequestModalLabel">Request <?php echo htmlspecialchars($dopText, ENT_QUOTES, 'UTF-8'); ?></h5>
          <button type="button" class="dop-modal-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars((string) $_SESSION['dop_request_csrf'], ENT_QUOTES, 'UTF-8'); ?>">
          <input type="hidden" name="product_id" value="<?php echo $dopProductId; ?>">
          <input type="hidden" name="return_url" value="<?php echo htmlspecialchars($dopReturnUrl, ENT_QUOTES, 'UTF-8'); ?>">
          <input type="hidden" name="captcha_version" value="<?php echo htmlspecialchars($captchaVersion, ENT_QUOTES, 'UTF-8'); ?>">

          <div class="mb-2">
            <label class="form-label" for="dop_name">Name</label>
            <input type="text" class="form-control" id="dop_name" name="name" required>
          </div>
          <div class="mb-2">
            <label class="form-label" for="dop_company">Company</label>
            <input type="text" class="form-control" id="dop_company" name="company" required>
          </div>
          <div class="mb-2">
            <label class="form-label" for="dop_email">Email</label>
            <input type="email" class="form-control" id="dop_email" name="email" required>
          </div>
          <div class="mb-2">
            <label class="form-label" for="dop_phone">Phone</label>
            <input type="text" class="form-control" id="dop_phone" name="phone" required>
          </div>
          <div class="dop-request-summary">Request the manufacturer's <?php echo htmlspecialchars($dopText, ENT_QUOTES, 'UTF-8'); ?>: <strong><?php echo htmlspecialchars($dopProductName, ENT_QUOTES, 'UTF-8'); ?></strong></div>
          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($dopProductName, ENT_QUOTES, 'UTF-8'); ?>">
          <?php if ($useCaptcha && $captchaVersion === '2'): ?>
            <div class="mt-3">
              <div class="g-recaptcha" data-sitekey="<?php echo htmlspecialchars($captchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>"></div>
            </div>
          <?php endif; ?>
          <?php if ($useCaptcha && $captchaVersion === '3'): ?>
            <input type="hidden" id="dop_recaptcha_token" name="recaptcha_token" value="">
          <?php endif; ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dop-send">&lt;&lt; Send &gt;&gt;</button>
          <button type="button" class="btn btn-dop-cancel" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if ($useCaptcha && $captchaVersion === '3'): ?>
  <script src="https://www.google.com/recaptcha/api.js?render=<?php echo rawurlencode($captchaSiteKey); ?>"></script>
  <script>
    (function () {
      var form = document.getElementById('dopRequestForm');
      if (!form) return;
      var siteKey = <?php echo json_encode($captchaSiteKey); ?>;

      form.addEventListener('submit', function (event) {
        if ((form.getAttribute('data-captcha-version') || '') !== '3') return;
        if (form.getAttribute('data-captcha-pending') === '1') return;
        event.preventDefault();

        if (typeof grecaptcha === 'undefined') {
          form.submit();
          return;
        }

        grecaptcha.ready(function () {
          grecaptcha.execute(siteKey, { action: 'dop_request' }).then(function (token) {
            var tokenInput = document.getElementById('dop_recaptcha_token');
            if (tokenInput) tokenInput.value = token;
            form.setAttribute('data-captcha-pending', '1');
            form.submit();
          });
        });
      });
    })();
  </script>
<?php endif; ?>
