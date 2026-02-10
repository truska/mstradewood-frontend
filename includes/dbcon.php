<?php
/**
 * Migration DB bridge.
 *
 * Source of truth is the new PDO config in /private/dbcon.php.
 * Legacy templates still expect $conn (mysqli), so we expose it
 * via a temporary compatibility layer.
 */

require_once dirname(__DIR__, 2) . '/private/dbcon.php';
require_once __DIR__ . '/dbcon-legacy-mysqli.php';
