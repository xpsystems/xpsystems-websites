<footer class="site-footer">
  <!-- Playful Top Banner Strip -->
  <div class="container footer-playful-banner">
    <div class="footer-status-pill">
      <span class="footer-pulse-dot"></span>
      <span>All European edge nodes humming happily in Frankfurt, Falkenstein &amp; Helsinki</span>
      <span class="footer-latency-badge">~8ms Anycast</span>
    </div>

    <button type="button" class="footer-highfive-btn" id="footer-highfive-btn" aria-label="Send high five to the servers">
      <span class="highfive-emoji">🎉</span>
      <span class="highfive-text">High-Five the Servers</span>
      <span class="highfive-count" id="highfive-count">128</span>
    </button>
  </div>

  <div class="container footer-main-grid">
    <!-- Brand & Mission Column -->
    <div class="footer-brand-col">
      <a href="<?= htmlspecialchars(url('main')) ?>" class="footer-logo" aria-label="xpsystems home">
        <span class="footer-logo-text">xpsystems</span>
        <span class="footer-badge-pill">DE &bull; EU</span>
      </a>

      <p class="footer-desc">
        <?= htmlspecialchars($brand['tagline'] ?? 'German Web-Provider') ?> — European sovereign bare-metal infrastructure, Anycast edge routing, and privacy-first web services operated from Germany.
      </p>

      <div class="footer-trust-chips">
        <span class="footer-chip">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          Zero Cookies
        </span>
        <span class="footer-chip">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          100% DSGVO / GDPR
        </span>
        <span class="footer-chip">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
          </svg>
          100% Green Energy
        </span>
      </div>

      <!-- Domain Switcher Pills -->
      <div class="footer-domain-switcher">
        <span class="domain-switcher-label">Namespaces:</span>
        <a href="https://xpsystems.eu" class="domain-pill" title="xpsystems European Gateway">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          <span>xpsystems.eu</span>
        </a>
        <a href="https://xpsystems.de" class="domain-pill" title="xpsystems Germany Gateway">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          <span>xpsystems.de</span>
        </a>
      </div>
    </div>

    <!-- Navigation Columns -->
    <div class="footer-nav-col">
      <h4 class="footer-col-title">Infrastructure</h4>
      <ul class="footer-col-list">
        <li>
          <a href="https://status.xpsystems.eu" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <span class="footer-bullet-dot green"></span>
            <span>Live Status &amp; Telemetry</span>
          </a>
        </li>
        <li><a href="https://europehost.eu" target="_blank" rel="noopener noreferrer" class="footer-nav-link">EuropeHost.eu</a></li>
        <li><a href="https://eu-data.org" target="_blank" rel="noopener noreferrer" class="footer-nav-link">eu-data.org</a></li>
        <li><a href="https://mtex.dev" target="_blank" rel="noopener noreferrer" class="footer-nav-link">MTEX.dev Services</a></li>
      </ul>
    </div>

    <div class="footer-nav-col">
      <h4 class="footer-col-title">Open Source</h4>
      <ul class="footer-col-list">
        <li>
          <a href="https://github.com/xpsystems" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
            </svg>
            <span>GitHub @xpsystems</span>
          </a>
        </li>
        <li><a href="<?= htmlspecialchars(url('opensource')) ?>" class="footer-nav-link">Repository Hub</a></li>
        <li><a href="https://github.com/xpsystems-ai" target="_blank" rel="noopener noreferrer" class="footer-nav-link">AI Automation</a></li>
        <li><a href="<?= htmlspecialchars(url('domains')) ?>" class="footer-nav-link">Domain Portfolio</a></li>
      </ul>
    </div>

    <div class="footer-nav-col">
      <h4 class="footer-col-title">Direct &amp; Legal</h4>
      <ul class="footer-col-list">
        <li><a href="<?= htmlspecialchars(url('contact')) ?>" class="footer-nav-link">Contact Desk</a></li>
        <li><a href="/impressum" class="footer-nav-link">Impressum (§ 5 DDG)</a></li>
        <li><a href="/privacy" class="footer-nav-link">Datenschutz (GDPR)</a></li>
        <li><a href="mailto:f.ternis@xpsystems.eu" class="footer-nav-link">Founder Desk</a></li>
      </ul>
    </div>
  </div>

  <!-- Bottom Strip -->
  <div class="container footer-bottom-strip">
    <div class="footer-bottom-left">
      <span>&copy; <?= $currentYear ?? date('Y') ?> <strong>xpsystems</strong>. Built with precision, flat geometry &amp; ☕ in Germany.</span>
    </div>

    <div class="footer-bottom-right">
      <span class="footer-version-pill">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
          <line x1="7" y1="7" x2="7.01" y2="7"/>
        </svg>
        <span>v<?= htmlspecialchars($app['version'] ?? '3.4.0') ?></span>
        <span class="pill-divider">&bull;</span>
        <span>AS216390 (EU)</span>
      </span>

      <?php $component('theme-toggle'); ?>
    </div>
  </div>
</footer>

