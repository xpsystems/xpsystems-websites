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

<header class="hero hero--subpage">
  <div class="hero-backdrop-glow" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">
      <svg class="eyebrow-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="16 18 22 12 16 6"/>
        <polyline points="8 6 2 12 8 18"/>
      </svg>
      <span>Telemetry Integration &middot; REST JSON</span>
    </div>
    
    <h1 class="hero-title reveal" style="--delay: 50ms">Status API Reference</h1>
    
    <p class="hero-tagline reveal" style="--delay: 100ms">
      Public, unauthenticated REST endpoints for live uptime metrics, 90-day historical check records, and incident timelines across xpsystems.
    </p>

    <div class="hero-ctas reveal" style="--delay: 150ms">
      <a href="/status" class="btn btn-secondary">
        <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"/>
          <polyline points="12 19 5 12 12 5"/>
        </svg>
        <span>Back to Live Status</span>
      </a>
      <a href="https://api-sandbox.de/playground.html?url=https://<?= $e($activeHost) ?>/api/status" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
        <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
      <aside class="legal-sidebar reveal">
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

        <div class="legal-meta-card">
          <div class="legal-meta-row">
            <span>Format:</span>
            <span class="meta-val">JSON (application/json)</span>
          </div>
          <div class="legal-meta-row">
            <span>Auth:</span>
            <span class="meta-val">None (Public)</span>
          </div>
          <div class="legal-meta-row">
            <span>CORS:</span>
            <span class="meta-val">Access-Control-Allow-Origin: *</span>
          </div>
          <div class="legal-meta-row">
            <span>Rate Limit:</span>
            <span class="meta-val">Uncapped</span>
          </div>
        </div>
      </aside>

      <!-- Main API Documentation Content -->
      <div class="legal-main">
        
        <!-- Overview -->
        <section id="overview" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">01</span>
            <h2 class="legal-sec-title">Overview &amp; Base URL</h2>
          </div>
          <div class="legal-body">
            <p>
              The xpsystems status monitoring architecture exposes an open, lightweight JSON API for direct consumption by uptime monitoring aggregators, continuous integration pipelines, and private infrastructure dashboards.
            </p>
            <div class="legal-kv-grid">
              <div class="kv-label">Primary Endpoint</div>
              <div class="kv-value"><code>https://<?= $e($activeHost) ?>/api</code></div>

              <div class="kv-label">Alternative Nodes</div>
              <div class="kv-value"><code>https://status.xpsystems.eu/api</code> &middot; <code>https://status.xpsys.de/api</code></div>

              <div class="kv-label">Headers Returned</div>
              <div class="kv-value"><code>Content-Type: application/json; charset=utf-8</code><br><code>Access-Control-Allow-Origin: *</code></div>
            </div>
          </div>
        </section>

        <!-- SSE Section -->
        <section id="sse" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">02</span>
            <h2 class="legal-sec-title">Server-Sent Events (SSE)</h2>
          </div>
          <div class="legal-body">
            <p>
              Connect to our real-time streaming endpoint to receive immediate status changes as they are benchmarked by our monitoring runner:
            </p>
            <div class="hero-terminal" style="margin: 16px 0;">
              <div class="terminal-bar">
                <span class="terminal-title">curl -N -H "Accept: text/event-stream" https://<?= $e($activeHost) ?>/events</span>
              </div>
              <div class="terminal-body" style="padding: 12px 18px;">
                <code>event: status<br>data: {"overall":"operational","checked_at":<?= time() ?>,"services":[...]}</code>
              </div>
            </div>
          </div>
        </section>

        <!-- Endpoint: GET /api/status -->
        <section id="ep-status" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">03</span>
            <h2 class="legal-sec-title">GET /api/status</h2>
          </div>
          <div class="legal-body">
            <p>Returns the aggregated network health state across all monitored nodes, along with a numerical summary.</p>
            <div class="hero-terminal" style="margin: 16px 0;">
              <div class="terminal-bar"><span class="terminal-title">Example Response</span></div>
              <div class="terminal-body" style="padding: 14px 18px;">
                <pre style="margin:0;font-family:var(--font-mono);font-size:0.8125rem;color:var(--text);">{
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
            </div>
          </div>
        </section>

        <!-- Endpoint: GET /api/services -->
        <section id="ep-services" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">04</span>
            <h2 class="legal-sec-title">GET /api/services</h2>
          </div>
          <div class="legal-body">
            <p>Returns the complete inventory of tracked services, their latest HTTP response status code, and latency in milliseconds.</p>
            <div class="hero-terminal" style="margin: 16px 0;">
              <div class="terminal-bar"><span class="terminal-title">cURL</span></div>
              <div class="terminal-body" style="padding: 12px 18px;">
                <code>curl -s https://<?= $e($activeHost) ?>/api/services | jq</code>
              </div>
            </div>
          </div>
        </section>

        <!-- Endpoint: GET /api/service/{slug} -->
        <section id="ep-service" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">05</span>
            <h2 class="legal-sec-title">GET /api/service/{slug}</h2>
          </div>
          <div class="legal-body">
            <p>Fetches real-time telemetry for an individual service identified by its unique slug identifier.</p>
            <div class="legal-kv-grid">
              <div class="kv-label">URL Parameter</div>
              <div class="kv-value"><code>slug</code> &mdash; e.g. <code>xpsystems-eu</code>, <code>europehost-eu</code>, <code>status-node-1</code></div>
            </div>
          </div>
        </section>

        <!-- Endpoint: GET /api/history -->
        <section id="ep-history" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">06</span>
            <h2 class="legal-sec-title">GET /api/history[?limit=N]</h2>
          </div>
          <div class="legal-body">
            <p>Returns chronological check records across all monitored endpoints.</p>
            <div class="legal-kv-grid">
              <div class="kv-label">Query Parameter</div>
              <div class="kv-value"><code>limit</code> (optional) &mdash; number of check runs to retrieve (default: 90, max: 1440).</div>
            </div>
          </div>
        </section>

        <!-- Endpoint: GET /api/history/{slug} -->
        <section id="ep-history-slug" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">07</span>
            <h2 class="legal-sec-title">GET /api/history/{slug}[?days=N]</h2>
          </div>
          <div class="legal-body">
            <p>Fetches aggregated per-day historical uptime records and rolling availability percentages for a specific service.</p>
            <div class="legal-kv-grid">
              <div class="kv-label">Query Parameter</div>
              <div class="kv-value"><code>days</code> (optional) &mdash; days of history to cover (default: 90, max: 3650).</div>
            </div>
          </div>
        </section>

        <!-- Endpoint: GET /api/day/{slug}/{date} -->
        <section id="ep-day" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">08</span>
            <h2 class="legal-sec-title">GET /api/day/{slug}/{YYYY-MM-DD}</h2>
          </div>
          <div class="legal-body">
            <p>Detailed incident diagnostics and exact timeline for a service on a given UTC date.</p>
            <div class="legal-kv-grid">
              <div class="kv-label">Parameters</div>
              <div class="kv-value"><code>slug</code> &middot; <code>YYYY-MM-DD</code> (e.g. <code>2026-09-05</code>)</div>
            </div>
          </div>
        </section>

        <!-- Endpoint: GET /api/ping -->
        <section id="ep-ping" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">09</span>
            <h2 class="legal-sec-title">GET /api/ping</h2>
          </div>
          <div class="legal-body">
            <p>Lightweight liveness probe for checking whether the status ingress endpoint itself is reachable.</p>
            <div class="hero-terminal" style="margin: 16px 0;">
              <div class="terminal-bar"><span class="terminal-title">Response</span></div>
              <div class="terminal-body" style="padding: 12px 18px;">
                <code>{"pong": true, "timestamp": <?= time() ?>, "server": "<?= $e($activeHost) ?>"}</code>
              </div>
            </div>
          </div>
        </section>

      </div>
    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
