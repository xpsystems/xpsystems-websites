<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<div id="preload-bar"></div>

<?php $component('header'); ?>

<header class="hero">
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal" style="color:var(--red);">Error 404</div>
    <h1 class="hero-title reveal" style="--delay: 50ms">Page Not Found</h1>
    <p class="hero-description reveal" style="--delay: 100ms">
      The resource or subdomain you are looking for does not exist or has been moved.
    </p>
    <div class="hero-ctas reveal" style="--delay: 160ms">
      <a href="/" class="btn btn-primary">Return Home</a>
      <a href="/contact" class="btn btn-secondary">Contact Support</a>
    </div>
  </div>
</header>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
