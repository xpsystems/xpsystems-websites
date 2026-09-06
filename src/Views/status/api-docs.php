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
<?php $component('header'); ?>
<?php $component('transition-banner'); ?>

<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span>Telemetry Integration &bull; REST / JSON</span>
    </div>

    <h1 class="hero-title">
      Status API Reference<br>
      <span class="hero-title-accent">&amp; Telemetry Endpoints</span>
    </h1>

    <p class="hero-tagline">
      Public, unauthenticated REST endpoints for live uptime metrics, 90-day historical check records, and incident timelines across xpsystems.
    </p>

    <div class="hero-ctas">
      <a href="<?= $e(url('/status')) ?>" class="btn btn-secondary btn-lg">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"/>
          <polyline points="12 19 5 12 12 5"/>
        </svg>
        <span>Back to Live Status</span>
      </a>

      <a href="https://api-sandbox.de" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-lg">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="5 3 19 12 5 21 5 3"/>
        </svg>
        <span>Test in Sandbox</span>
      </a>
    </div>
  </div>
</header>

<main class="legal-page">
  <div class="container">
    <div class="legal-layout">

      <!-- Sticky Sidebar -->
      <aside class="legal-sidebar">
        <nav class="legal-toc-card" aria-label="API Navigation">
          <div class="legal-toc-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="8" y1="6" x2="21" y2="6"/>
              <line x1="8" y1="12" x2="21" y2="12"/>
              <line x1="8" y1="18" x2="21" y2="18"/>
              <line x1="3" y1="6" x2="3.01" y2="6"/>
              <line x1="3" y1="12" x2="3.01" y2="12"/>
              <line x1="3" y1="18" x2="3.01" y2="18"/>
            </svg>
            <span>API Specification</span>
          </div>

          <ul class="legal-toc-list">
            <li><a href="#overview" class="legal-toc-link"><span class="toc-num">01</span><span>Overview &amp; Base URL</span></a></li>
            <li><a href="#sse" class="legal-toc-link"><span class="toc-num">02</span><span>Server-Sent Events</span></a></li>
            <li><a href="#ep-status" class="legal-toc-link"><span class="toc-num">03</span><span>GET /api/status</span></a></li>
            <li><a href="#ep-services" class="legal-toc-link"><span class="toc-num">04</span><span>GET /api/services</span></a></li>
            <li><a href="#ep-service" class="legal-toc-link"><span class="toc-num">05</span><span>GET /api/service/{slug}</span></a></li>
            <li><a href="#ep-history" class="legal-toc-link"><span class="toc-num">06</span><span>GET /api/history</span></a></li>
            <li><a href="#ep-history-slug" class="legal-toc-link"><span class="toc-num">07</span><span>GET /api/history/{slug}</span></a></li>
            <li><a href="#ep-day" class="legal-toc-link"><span class="toc-num">08</span><span>GET /api/day/...</span></a></li>
            <li><a href="#ep-ping" class="legal-toc-link"><span class="toc-num">09</span><span>GET /api/ping</span></a></li>
          </ul>
        </nav>

        <div class="legal-toc-card mono" style="font-size:0.75rem;color:var(--text-muted);display:flex;flex-direction:column;gap:8px;">
          <div><strong>Format:</strong> JSON</div>
          <div><strong>Auth:</strong> None (Public)</div>
          <div><strong>CORS:</strong> * (Unrestricted)</div>
          <div><strong>Rate Limit:</strong> None</div>
        </div>
      </aside>

      <!-- Main API Documentation Content -->
      <div class="legal-content">

        <!-- Overview -->
        <article id="overview" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[01]</span>
            <span>Overview &amp; Base URL</span>
          </h2>
          <div class="legal-prose">
            <p>
              The xpsystems status monitoring architecture exposes an open, lightweight JSON API for direct consumption by uptime monitoring aggregators, continuous integration pipelines, and private infrastructure dashboards.
            </p>
            <p>
              <strong>Base Endpoint:</strong> <code>https://<?= $e($activeHost) ?>/api</code><br>
              <strong>Content-Type:</strong> <code>application/json; charset=utf-8</code>
            </p>
          </div>
        </article>

        <!-- SSE Section -->
        <article id="sse" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[02]</span>
            <span>Server-Sent Events (SSE)</span>
          </h2>
          <div class="legal-prose">
            <p>
              Connect to our real-time streaming endpoint to receive immediate status changes as they are benchmarked by our monitoring runner:
            </p>
            <p>
              <code>curl -N -H "Accept: text/event-stream" https://<?= $e($activeHost) ?>/events</code>
            </p>
          </div>
        </article>

        <!-- Endpoint: GET /api/status -->
        <article id="ep-status" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[03]</span>
            <span>GET /api/status</span>
          </h2>
          <div class="legal-prose">
            <p>Returns the aggregated network health state across all monitored nodes, along with a numerical summary.</p>
            <pre style="background:var(--bg-subtle);border:1px solid var(--border);padding:16px;border-radius:var(--radius-xs);font-family:var(--font-mono);font-size:0.8125rem;color:var(--text);">{
  "overall": "operational",
  "checked_at": <?= time() ?>,
  "server": "<?= $e($activeHost) ?>",
  "summary": {
    "total": 12,
    "up": 12,
    "degraded": 0,
    "down": 0,
    "unknown": 0,
    "not_deployed": 5
  }
}</pre>
          </div>
        </article>

        <!-- Endpoint: GET /api/services -->
        <article id="ep-services" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[04]</span>
            <span>GET /api/services</span>
          </h2>
          <div class="legal-prose">
            <p>Returns the complete inventory of tracked services, their latest HTTP response status code, and latency in milliseconds.</p>
            <p>
              <code>curl -s https://<?= $e($activeHost) ?>/api/services | jq</code>
            </p>
          </div>
        </article>

        <!-- Endpoint: GET /api/service/{slug} -->
        <article id="ep-service" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[05]</span>
            <span>GET /api/service/{slug}</span>
          </h2>
          <div class="legal-prose">
            <p>Fetches real-time telemetry for an individual service identified by its unique slug identifier.</p>
            <p>
              <strong>Parameters:</strong> <code>slug</code> &mdash; e.g. <code>xpsystems-eu</code>, <code>europehost-eu</code>, <code>dnbx-de</code>
            </p>
          </div>
        </article>

        <!-- Endpoint: GET /api/history -->
        <article id="ep-history" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[06]</span>
            <span>GET /api/history[?limit=N]</span>
          </h2>
          <div class="legal-prose">
            <p>Returns chronological check records across all monitored endpoints.</p>
            <p>
              <strong>Query Parameters:</strong> <code>limit</code> (optional, default: 90, max: 1440).
            </p>
          </div>
        </article>

        <!-- Endpoint: GET /api/history/{slug} -->
        <article id="ep-history-slug" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[07]</span>
            <span>GET /api/history/{slug}[?days=N]</span>
          </h2>
          <div class="legal-prose">
            <p>Fetches aggregated per-day historical uptime records and rolling availability percentages for a specific service.</p>
            <p>
              <strong>Query Parameters:</strong> <code>days</code> (optional, default: 90, max: 3650).
            </p>
          </div>
        </article>

        <!-- Endpoint: GET /api/day/{slug}/{date} -->
        <article id="ep-day" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[08]</span>
            <span>GET /api/day/{slug}/{YYYY-MM-DD}</span>
          </h2>
          <div class="legal-prose">
            <p>Detailed incident diagnostics and exact timeline for a service on a given UTC date.</p>
          </div>
        </article>

        <!-- Endpoint: GET /api/ping -->
        <article id="ep-ping" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[09]</span>
            <span>GET /api/ping</span>
          </h2>
          <div class="legal-prose">
            <p>Lightweight liveness probe for verifying status ingress health.</p>
            <p>
              <code>curl -s https://<?= $e($activeHost) ?>/api/ping</code>
            </p>
          </div>
        </article>

      </div>
    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
