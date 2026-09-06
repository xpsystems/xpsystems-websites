<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle ?? '404 — Route Not Found') ?></title>
  <meta name="description" content="<?= $e($pageDescription ?? 'Requested endpoint or route not found.') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <script>
  (function(){
    try {
      var s = localStorage.getItem('xps-theme') || 'dark';
      document.documentElement.setAttribute('data-theme', s);
    } catch(e) {}
  })();
  </script>

  <link rel="icon" type="image/svg+xml" href="/assets/img/icon.svg">
  <link rel="alternate icon" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>
<?php $component('transition-banner'); ?>
<?php $component('header'); ?>

<main class="hero" style="min-height: 80vh; display: flex; align-items: center;">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">

    <div class="hero-eyebrow">
      <span class="status-dot red"></span>
      <span>STATUS_CODE: 404_NOT_FOUND &bull; INGRESS_FAIL</span>
    </div>

    <h1 class="hero-title">
      Route Resolution<br>
      <span class="hero-title-signal">Route Not Found.</span>
    </h1>

    <p class="hero-tagline">
      The requested resource, namespace, or path could not be resolved on this system.
    </p>

    <!-- Diagnostic Box -->
    <div style="max-width: 620px; margin: 0 auto 36px; background-color: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; text-align: left; font-family: var(--font-mono); font-size: 0.8125rem;">
      <div style="display: flex; gap: 8px; flex-direction: column;">
        <div style="color: var(--text-muted);">TIMESTAMP   : <?= gmdate('Y-m-d\TH:i:s\Z') ?></div>
        <div style="color: var(--text-secondary);">HOST        : <?= htmlspecialchars($_SERVER['HTTP_HOST'] ?? 'xpsystems.eu', ENT_QUOTES, 'UTF-8') ?></div>
        <div style="color: var(--text-secondary);">REQUEST_URI : <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/unknown', ENT_QUOTES, 'UTF-8') ?></div>
        <div style="color: var(--status-down); font-weight: 700;">STATUS      : 404_NOT_FOUND</div>
      </div>
    </div>

    <div class="hero-ctas" style="justify-content: center;">
      <a href="/" class="btn btn-primary btn-lg">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        <span>Return to Home</span>
      </a>

      <a href="/domains" class="btn btn-secondary btn-lg">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="2" y1="12" x2="22" y2="12"/>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        <span>Domain Registry</span>
      </a>

      <a href="/status" class="btn btn-secondary btn-lg">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
        </svg>
        <span>System Status</span>
      </a>
    </div>

  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
