<?php
/**
 * Temporary legacy mysqli adapter during PDO migration.
 * Remove this file once all queries are converted to PDO.
 */

if (isset($conn) && $conn instanceof mysqli) {
  return;
}

$db_host = $DB_HOST ?? null;
$db_name = $DB_NAME ?? null;
$db_user = $DB_USER ?? null;
$db_pass = $DB_PASS ?? null;

// Optional legacy override file for old mysqli credentials.
$legacyLocalConfig = dirname(__DIR__, 2) . '/private/dbcon-legacy-local.php';
if (file_exists($legacyLocalConfig)) {
  require $legacyLocalConfig;
  $db_host = $DB_LEGACY_HOST ?? $db_host;
  $db_name = $DB_LEGACY_NAME ?? $db_name;
  $db_user = $DB_LEGACY_USER ?? $db_user;
  $db_pass = $DB_LEGACY_PASS ?? $db_pass;
}

$DB_LEGACY_OK = false;
$DB_LEGACY_ERROR = null;

if (
  extension_loaded('mysqli') &&
  $db_host !== null &&
  $db_name !== null &&
  $db_user !== null &&
  $db_pass !== null
) {
  // PHP 8.1+ defaults mysqli to exceptions; keep legacy behavior during migration.
  mysqli_report(MYSQLI_REPORT_OFF);
  $hostsToTry = [$db_host];
  if ($db_host === 'localhost') {
    $hostsToTry[] = '127.0.0.1';
  }

  foreach ($hostsToTry as $host) {
    try {
      $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
    } catch (Throwable $e) {
      $conn = null;
      $DB_LEGACY_ERROR = $e->getMessage();
    }

    if ($conn instanceof mysqli) {
      mysqli_set_charset($conn, 'utf8mb4');
      $DB_LEGACY_OK = true;
      $DB_LEGACY_ERROR = null;
      break;
    }

    $DB_LEGACY_ERROR = $DB_LEGACY_ERROR ?: mysqli_connect_error();
  }
} else {
  $conn = null;
  $DB_LEGACY_ERROR = 'mysqli extension missing or DB credentials are not set.';
}
