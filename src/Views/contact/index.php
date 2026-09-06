<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
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

<!-- Hero Section -->
<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span>Official Inboxes &bull; Communication Desk</span>
    </div>

    <h1 class="hero-title">
      <?= $e($contact['title'] ?? 'Get in Touch') ?><br>
      <span class="hero-title-accent">&amp; Connect Direct.</span>
    </h1>

    <p class="hero-tagline">
      <?= $e($contact['description'] ?? "Official communication channels for xpsystems and the ternis infrastructure ecosystem.") ?>
    </p>
  </div>
</header>

<!-- Main Content -->
<main class="section section-alt">
  <div class="container">

    <!-- Official Email Inboxes -->
    <div class="contact-section">
      <h2 class="section-title">
        <svg class="section-title-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect width="20" height="16" x="2" y="4" rx="2"/>
          <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
        </svg>
        <span>Official Email Inboxes</span>
      </h2>

      <div class="contact-grid">
        <?php foreach (($contact['emails'] ?? []) as $item): ?>
          <div class="contact-card">
            <div class="contact-main-info">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="16" x="2" y="4" rx="2"/>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                </svg>
              </div>
              <div class="contact-content">
                <span class="contact-label"><?= $e($item['label']) ?></span>
                <span class="contact-value"><?= $e($item['email']) ?></span>
              </div>
            </div>

            <div style="display:flex;gap:6px;align-items:center;">
              <button class="contact-action-btn" title="Copy email address" data-copy="<?= $e($item['email']) ?>" data-copy-label="<?= $e($item['label']) ?>" type="button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
              </button>

              <a href="mailto:<?= $e($item['email']) ?>" class="contact-action-btn" title="Send email">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="22" y1="2" x2="11" y2="13"></line>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Founder & Direct Leadership -->
    <?php if (!empty($contact['founder'])): ?>
      <div class="contact-section">
        <h2 class="section-title">
          <svg class="section-title-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          <span>Direct Leadership &amp; Engineering</span>
        </h2>

        <div class="contact-grid">
          <div class="contact-card contact-card--highlight">
            <div class="contact-main-info">
              <div class="contact-icon contact-icon--founder">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
              </div>
              <div class="contact-content">
                <span class="contact-name"><?= $e($contact['founder']['name']) ?></span>
                <span class="contact-role"><?= $e($contact['founder']['role']) ?></span>
                <span class="contact-value"><?= $e($contact['founder']['email']) ?></span>
              </div>
            </div>

            <div style="display:flex;gap:6px;align-items:center;">
              <button class="contact-action-btn" title="Copy email address" data-copy="<?= $e($contact['founder']['email']) ?>" data-copy-label="Fabian Ternis Email" type="button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
              </button>

              <a href="mailto:<?= $e($contact['founder']['email']) ?>" class="contact-action-btn" title="Send direct email">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="22" y1="2" x2="11" y2="13"></line>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
              </a>

              <a href="<?= $e($contact['founder']['portfolio']) ?>" target="_blank" rel="noopener noreferrer" class="contact-action-btn" title="Visit personal portfolio">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                  <polyline points="15 3 21 3 21 9"></polyline>
                  <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Social & Public Profiles -->
    <?php if (!empty($contact['socials'])): ?>
      <div class="contact-section">
        <h2 class="section-title">
          <svg class="section-title-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="18" cy="5" r="3"></circle>
            <circle cx="6" cy="12" r="3"></circle>
            <circle cx="18" cy="19" r="3"></circle>
            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
          </svg>
          <span>Social Media &amp; Public Profiles</span>
        </h2>

        <div class="contact-grid">
          <?php foreach ($contact['socials'] as $social): ?>
            <a href="<?= $e($social['url']) ?>" target="_blank" rel="noopener noreferrer" class="contact-card">
              <div class="contact-main-info">
                <div class="contact-icon contact-icon--social">
                  <?php if ($social['platform'] === 'GitHub'): ?>
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                  <?php elseif ($social['platform'] === 'Instagram'): ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                  <?php else: ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                  <?php endif; ?>
                </div>
                <div class="contact-content">
                  <span class="contact-label"><?= $e($social['platform']) ?><?= !empty($social['personal']) ? ' &bull; Personal' : '' ?></span>
                  <span class="contact-value"><?= $e($social['handle']) ?></span>
                </div>
              </div>

              <div class="contact-action-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                  <polyline points="15 3 21 3 21 9"></polyline>
                  <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <!-- Security & Encryption Notice -->
    <div class="security-desk-card">
      <svg class="security-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
      </svg>
      <div>
        <h3 class="security-title">Encrypted Transmission &amp; Responsible Disclosure</h3>
        <p class="security-desc">
          Security notices and sensitive infrastructure reports may be submitted directly to <a href="mailto:xpsystems@ternismail.de" style="color:var(--accent);text-decoration:underline;">xpsystems@ternismail.de</a>. All inboxes are hosted within Germany under strict DSGVO guidelines.
        </p>
      </div>
    </div>

  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
