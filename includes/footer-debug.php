<?php
$dbOk = isset($DB_OK) ? (bool) $DB_OK : (isset($pdo) && $pdo instanceof PDO);
$dbName = $DB_NAME ?? 'unknown';
?>
<section class="footer-debug">
  <style>
    .footer-debug {
      padding-top: 1rem;
      padding-bottom: 1rem;
      margin-top: 0.75rem;
    }
    .footer-debug .small {
      line-height: 1.45;
    }
    .footer-debug .content-debug-list {
      line-height: 1.5;
    }
    .footer-debug .content-debug-list > div {
      margin-bottom: 0.25rem;
    }
  </style>
  <div class="container">
    <div class="row g-3">
      <div class="col-sm-6 col-lg-3">
        <h6>Environment</h6>
        <p class="mb-0">Development</p>
        <?php
          $requestUri = (string) ($_SERVER['REQUEST_URI'] ?? '');
          $requestPath = trim((string) parse_url($requestUri, PHP_URL_PATH), '/');
          $segs = $requestPath !== '' ? array_values(array_filter(explode('/', $requestPath), 'strlen')) : [];
          if (!$segs && !empty($pageSegments) && is_array($pageSegments)) {
            $segs = array_values($pageSegments);
          }
        ?>
        <div class="small mt-2">
          <div><strong>Segments</strong></div>
          <?php if (!$segs): ?>
            <div class="text-muted">No URL segments</div>
          <?php endif; ?>
          <?php for ($i = 0; $i <= 4; $i++): ?>
            <div>
              segs[<?php echo $i; ?>]:
              <?php echo htmlspecialchars((string) ($segs[$i] ?? ''), ENT_QUOTES); ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <h6>Server</h6>
        <p class="mb-0"><?php echo htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'unknown', ENT_QUOTES); ?></p>
      </div>
      <div class="col-sm-6 col-lg-3">
        <h6>PHP</h6>
        <p class="mb-0"><?php echo htmlspecialchars(PHP_VERSION, ENT_QUOTES); ?></p>
      </div>
      <div class="col-sm-6 col-lg-3">
        <h6>Database</h6>
        <p class="mb-0">
          <i class="fa-solid <?php echo $dbOk ? 'fa-circle-check' : 'fa-circle-xmark'; ?>"></i>
          <span><?php echo htmlspecialchars($dbName, ENT_QUOTES); ?></span>
        </p>
      </div>
    </div>
    <div class="row g-3 mt-2">
      <div class="col-12 col-lg-9 ms-lg-auto">
        <h6>Content Map</h6>
        <?php
          $contentDebug = $GLOBALS['cms_content_debug'] ?? [];
        ?>
        <?php if (!empty($contentDebug)): ?>
          <div class="content-debug-list">
            <?php foreach ($contentDebug as $item): ?>
              <div>
                [<?php echo htmlspecialchars((string) ($item['id'] ?? ''), ENT_QUOTES); ?>]
                | <?php echo htmlspecialchars((string) ($item['name'] ?? ''), ENT_QUOTES); ?>
                {Layout: <?php echo htmlspecialchars((string) ($item['layout'] ?? ''), ENT_QUOTES); ?>
                | URL: <?php echo htmlspecialchars((string) ($item['layout_url'] ?? ''), ENT_QUOTES); ?>
                | <?php echo htmlspecialchars((string) ($item['layout_name'] ?? ''), ENT_QUOTES); ?>}
                | Sort: <?php echo htmlspecialchars((string) ($item['sort'] ?? ''), ENT_QUOTES); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="mb-0">No content blocks found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
