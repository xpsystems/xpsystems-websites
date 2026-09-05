<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

  <script>
  (function(){
    try {
      var s = localStorage.getItem('xps-theme') || 'system';
      var r = s === 'system'
        ? (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark')
        : s;
      document.documentElement.setAttribute('data-theme', r);
    } catch(e) {}
  })();
  </script>

  <link rel="icon" type="image/svg+xml" href="/assets/img/icon.svg">
  <link rel="alternate icon" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>

<?php $component('header'); ?>

<main class="error-page">
  <div class="hero-backdrop-glow" aria-hidden="true"></div>
  <div class="container">
    <div class="error-container">
      
      <div class="error-badge reveal">
        <span class="error-pulse-dot"></span>
        <span>STATUS_CODE: 404_NOT_FOUND</span>
      </div>

      <div class="error-code reveal" style="--delay: 50ms">404</div>

      <h1 class="error-title reveal" style="--delay: 100ms">Route Resolution Failed</h1>
      
      <p class="error-desc reveal" style="--delay: 150ms">
        The requested resource, host, or subdomain could not be resolved by our ingress edge routing mesh.
      </p>

      <!-- High-Tech Diagnostic Terminal Box -->
      <div class="error-terminal reveal" style="--delay: 200ms">
        <div class="terminal-bar">
          <span class="term-dot term-dot--red"></span>
          <span class="term-dot term-dot--yellow"></span>
          <span class="term-dot term-dot--green"></span>
          <span class="term-label">ingress-edge-diagnostics</span>
        </div>
        <div class="terminal-line">
          <span class="term-key">TIMESTAMP</span>
          <span class="term-val"><?= gmdate('Y-m-d\TH:i:s\Z') ?></span>
        </div>
        <div class="terminal-line">
          <span class="term-key">HOST</span>
          <span class="term-val"><?= htmlspecialchars($_SERVER['HTTP_HOST'] ?? 'xpsystems.eu', ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div class="terminal-line">
          <span class="term-key">REQUEST_URI</span>
          <span class="term-val"><?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/unknown', ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div class="terminal-line">
          <span class="term-key">NODE_POP</span>
          <span class="term-val">DE-FRA-EDGE-01 (Frankfurt)</span>
        </div>
        <div class="terminal-line">
          <span class="term-key">STATUS</span>
          <span class="term-val term-val--err">ERR_TARGET_NODE_UNREACHABLE_OR_UNKNOWN</span>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="error-actions reveal" style="--delay: 250ms">
        <a href="/" class="btn btn-primary">
          <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <span>Return Home</span>
        </a>

        <a href="/domains" class="btn btn-secondary">
          <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          <span>Domain Registry</span>
        </a>

        <a href="/opensource" class="btn btn-secondary">
          <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6"/>
            <polyline points="8 6 2 12 8 18"/>
          </svg>
          <span>Open Source</span>
        </a>

        <a href="/contact" class="btn btn-secondary">
          <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
          <span>Contact Desk</span>
        </a>
      </div>

    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>

