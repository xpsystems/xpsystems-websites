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

<!-- Hero -->
<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span>Open Source Ecosystem &bull; oss.ternis.org</span>
    </div>

    <h1 class="hero-title">
      We build<br>
      <span class="hero-title-accent">in the open.</span>
    </h1>

    <p class="hero-tagline">
      Infrastructure automation, developer tooling, and open web experiments &mdash; anchored at <a href="https://oss.ternis.org" target="_blank" rel="noopener noreferrer" style="color:var(--accent);text-decoration:underline;">oss.ternis.org</a> and public GitHub repositories.
    </p>

    <div class="hero-ctas">
      <a href="https://oss.ternis.org" class="btn btn-primary btn-lg" target="_blank" rel="noopener noreferrer">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="2" y1="12" x2="22" y2="12"/>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        <span>oss.ternis.org Hub</span>
      </a>

      <a href="https://github.com/xpsystems" class="btn btn-secondary btn-lg" target="_blank" rel="noopener noreferrer">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
        </svg>
        <span>github.com/xpsystems</span>
      </a>

      <a href="#repos" class="btn btn-secondary btn-lg">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        <span>Explore Repositories</span>
      </a>
    </div>

    <!-- Live GitHub Stat Counters -->
    <div class="oss-hero-stats">
      <div class="oss-stat-box">
        <div class="oss-stat-num" id="stat-repos">24+</div>
        <div class="oss-stat-lbl">Public Repos</div>
      </div>
      <div class="oss-stat-box">
        <div class="oss-stat-num" id="stat-stars">50+</div>
        <div class="oss-stat-lbl">Total Stars</div>
      </div>
      <div class="oss-stat-box">
        <div class="oss-stat-num" id="stat-forks">18+</div>
        <div class="oss-stat-lbl">Total Forks</div>
      </div>
      <div class="oss-stat-box">
        <div class="oss-stat-num" id="stat-members">2</div>
        <div class="oss-stat-lbl">Core Engineers</div>
      </div>
    </div>
  </div>
</header>

<!-- Organizations Section -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow">GitHub Hubs</span>
      <h2 class="section-title">Organizations &amp; Profiles</h2>
      <p class="section-sub">We maintain dedicated organizations and accounts on GitHub, each serving a distinct operational purpose.</p>
    </div>

    <div class="org-grid">
      <?php foreach (($sources ?? $github_sources ?? []) as $src): ?>
        <a href="<?= $e($src['url']) ?>" target="_blank" rel="noopener noreferrer" class="org-card">
          <div class="org-card-top">
            <div class="org-avatar">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
              </svg>
            </div>
            <div>
              <h3 class="org-name"><?= $e($src['label']) ?></h3>
              <span class="org-badge"><?= $src['type'] === 'org' ? 'Organization' : 'Account' ?></span>
            </div>
          </div>

          <p class="org-desc"><?= $e($src['description']) ?></p>

          <div class="org-footer">
            <span>github.com/<?= $e($src['handle']) ?></span>
            <svg class="org-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Repositories Grid Section -->
<section class="section section-base" id="repos">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow">Open Repositories</span>
      <h2 class="section-title">Highlighted Projects</h2>
      <p class="section-sub">Core platforms, developer tools, and operational telemetry open for inspection and contribution.</p>
    </div>

    <div class="repos-grid">
      <article class="repo-card">
        <div class="repo-header">
          <h3 class="repo-title">
            <a href="https://github.com/xpsystems/xpsystems-websites" target="_blank" rel="noopener noreferrer">
              <span>xpsystems-websites</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </h3>
          <span class="repo-visibility">Public</span>
        </div>
        <p class="repo-desc">
          Unified multi-domain and multi-subdomain web platform for xpsystems.eu, status, domains, contact, and opensource.
        </p>
        <div class="repo-meta">
          <span class="repo-lang"><span class="lang-dot php"></span>PHP / SCSS</span>
          <div class="repo-stats">
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> 12</span>
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="6" y1="3" x2="6" y2="15"></line><circle cx="18" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 9a9 9 0 0 1-9 9"></path></svg> 4</span>
          </div>
        </div>
      </article>

      <article class="repo-card">
        <div class="repo-header">
          <h3 class="repo-title">
            <a href="https://dnbx.de" target="_blank" rel="noopener noreferrer">
              <span>dnbx-api</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </h3>
          <span class="repo-visibility">API &bull; Public</span>
        </div>
        <p class="repo-desc">
          Authoritative domain &amp; nameserver intelligence API. Real-time WHOIS metadata, DNSSEC validation, and health diagnostics.
        </p>
        <div class="repo-meta">
          <span class="repo-lang"><span class="lang-dot js"></span>REST / JSON</span>
          <div class="repo-stats">
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> 8</span>
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="6" y1="3" x2="6" y2="15"></line><circle cx="18" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 9a9 9 0 0 1-9 9"></path></svg> 2</span>
          </div>
        </div>
      </article>

      <article class="repo-card">
        <div class="repo-header">
          <h3 class="repo-title">
            <a href="https://status.xpsystems.eu" target="_blank" rel="noopener noreferrer">
              <span>xps-status-telemetry</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </h3>
          <span class="repo-visibility">Public</span>
        </div>
        <p class="repo-desc">
          Lightweight, resilient server monitoring and SSE live telemetry daemon designed for distributed infrastructure services.
        </p>
        <div class="repo-meta">
          <span class="repo-lang"><span class="lang-dot shell"></span>Shell / PHP</span>
          <div class="repo-stats">
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> 15</span>
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="6" y1="3" x2="6" y2="15"></line><circle cx="18" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 9a9 9 0 0 1-9 9"></path></svg> 6</span>
          </div>
        </div>
      </article>

      <article class="repo-card">
        <div class="repo-header">
          <h3 class="repo-title">
            <a href="https://eu-data.org" target="_blank" rel="noopener noreferrer">
              <span>eu-data-privacy</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </h3>
          <span class="repo-visibility">Public</span>
        </div>
        <p class="repo-desc">
          European digital sovereignty toolkit. Zero-logging web services and GDPR-native authentication wrappers.
        </p>
        <div class="repo-meta">
          <span class="repo-lang"><span class="lang-dot ts"></span>TypeScript</span>
          <div class="repo-stats">
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> 9</span>
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="6" y1="3" x2="6" y2="15"></line><circle cx="18" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 9a9 9 0 0 1-9 9"></path></svg> 3</span>
          </div>
        </div>
      </article>
    </div>
  </div>
</section>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
