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

  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<div id="preload-bar"></div>

<?php $component('header'); ?>

<!-- Hero Section -->
<header class="hero">
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">
      <svg class="eyebrow-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
      </svg>
      Get In Touch
    </div>
    <h1 class="hero-title reveal" style="--delay:60ms"><?= $e($contact['title'] ?? 'Get in Touch') ?></h1>
    <p class="hero-tagline reveal" style="--delay:120ms">
      <?= $e($contact['description'] ?? "We'd love to hear from you. Reach out through any of the channels below.") ?>
    </p>
  </div>
</header>

<!-- Main Content -->
<main class="services-section">
  <div class="container">
    <!-- Email Section -->
    <div class="contact-section reveal">
      <h2 class="section-title">Email</h2>
      <div class="contact-grid">
        <?php foreach (($contact['emails'] ?? []) as $item): ?>
          <a href="mailto:<?= $e($item['email']) ?>" class="contact-card">
            <div class="contact-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="20" height="16" x="2" y="4" rx="2"/>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
              </svg>
            </div>
            <div class="contact-content">
              <span class="contact-label"><?= $e($item['label']) ?></span>
              <span class="contact-value"><?= $e($item['email']) ?></span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Founder Direct Section -->
    <?php if (!empty($contact['founder'])): ?>
      <div class="contact-section reveal" style="--delay: 100ms">
        <h2 class="section-title">Direct Contact</h2>
        <a href="mailto:<?= $e($contact['founder']['email']) ?>" class="contact-card contact-card--highlight">
          <div class="contact-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </div>
          <div class="contact-content">
            <span class="contact-name"><?= $e($contact['founder']['name']) ?></span>
            <span class="contact-role"><?= $e($contact['founder']['role']) ?></span>
            <span class="contact-value"><?= $e($contact['founder']['email']) ?></span>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <!-- Socials Section -->
    <div class="contact-section reveal" style="--delay: 200ms">
      <h2 class="section-title">Social Media</h2>
      <div class="contact-grid">
        <?php foreach (($contact['socials'] ?? []) as $social): ?>
          <a href="<?= $e($social['url']) ?>" target="_blank" rel="noopener noreferrer" class="contact-card<?= !empty($social['personal']) ? ' contact-card--personal' : '' ?>">
            <div class="contact-icon<?= strtolower($social['platform']) === 'instagram' ? ' contact-icon--instagram' : '' ?>">
              <?php if (strtolower($social['platform']) === 'instagram'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                  <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                </svg>
              <?php else: ?>
                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
                  <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                </svg>
              <?php endif; ?>
            </div>
            <div class="contact-content">
              <span class="contact-label"><?= $e($social['handle']) ?></span>
              <span class="contact-value"><?= $e($social['platform']) ?></span>
              <?php if (!empty($social['personal'])): ?>
                <span class="contact-tag">Personal</span>
              <?php endif; ?>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
