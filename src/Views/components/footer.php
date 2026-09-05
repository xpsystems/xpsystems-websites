<footer class="site-footer" id="site-footer">
  <div class="footer-ambient-glow" aria-hidden="true"></div>
  <div class="footer-top-edge" aria-hidden="true"></div>

  <!-- Telemetry Console & Playful Action Strip -->
  <div class="container footer-telemetry-container">
    <div class="footer-telemetry-dock spotlight-card">
      <div class="telemetry-dock-left">
        <div class="footer-status-pill" title="Live status across primary European data centers">
          <span class="footer-pulse-dot"></span>
          <span class="footer-status-title">European Edge Mesh</span>
          <span class="footer-status-sep">&bull;</span>
          <span class="footer-status-locs">Frankfurt &bull; Falkenstein &bull; Amsterdam &bull; Helsinki</span>
        </div>

        <!-- Interactive Edge Ping Radar -->
        <button type="button" class="footer-ping-pill" id="footer-ping-btn" title="Click to test live Anycast edge roundtrip latency" aria-label="Measure live edge latency">
          <svg class="ping-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
          </svg>
          <span class="ping-label" id="footer-ping-val">~8ms Anycast</span>
          <span class="ping-action-badge">Test Ping</span>
        </button>
      </div>

      <div class="telemetry-dock-right">
        <!-- Live European Edge Time (CET) -->
        <div class="footer-time-pill" id="footer-live-time" title="Current time at European edge nodes (CET)">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
          <span id="footer-time-display">--:--:-- CET</span>
        </div>

        <!-- Server High-Five Celebration Button -->
        <button type="button" class="footer-highfive-btn" id="footer-highfive-btn" aria-label="Send high five to the servers">
          <span class="highfive-emoji">🎉</span>
          <span class="highfive-text">High-Five</span>
          <span class="highfive-count" id="highfive-count">128</span>
        </button>

        <!-- Back to Top Button -->
        <button type="button" class="footer-scroll-top-btn" id="footer-scroll-top" title="Back to top" aria-label="Scroll to top of page">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="container footer-main-grid">
    <!-- Brand & Sub-Entity Column -->
    <div class="footer-brand-col">
      <a href="<?= htmlspecialchars(url('main')) ?>" class="footer-logo" aria-label="xpsystems home">
        <span class="footer-logo-text">xpsystems<span class="nav-logo-dot">.</span></span>
        <span class="footer-badge-pill">ternis.dev</span>
      </a>

      <p class="footer-desc">
        A sub-entity of <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" class="footer-inline-link">ternis.dev</a> (<a href="https://ternis-edv.de" target="_blank" rel="noopener noreferrer" class="footer-inline-link">ternis-edv</a>) &mdash; <?= htmlspecialchars($brand['tagline'] ?? 'German Web-Provider') ?> delivering sovereign bare-metal infrastructure, Anycast edge routing, and privacy-first web services operated from Germany.
      </p>

      <!-- Trust Badges -->
      <div class="footer-trust-chips">
        <span class="footer-chip" title="Zero tracking cookies by default">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          Zero Cookies
        </span>
        <span class="footer-chip" title="100% DSGVO / GDPR compliant">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          100% DSGVO / GDPR
        </span>
        <span class="footer-chip" title="European green data centers">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
          </svg>
          100% Green Energy
        </span>
      </div>

      <!-- Domain Switcher Pills -->
      <div class="footer-domain-switcher">
        <span class="domain-switcher-label">Namespaces:</span>
        <a href="https://xpsystems.eu" class="domain-pill" title="xpsystems European Gateway">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          <span>xpsystems.eu</span>
        </a>
        <a href="https://xpsystems.de" class="domain-pill" title="xpsystems Germany Gateway">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          <span>xpsystems.de</span>
        </a>
        <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" class="domain-pill" title="Parent Organization (ternis.dev)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
            <polyline points="15 3 21 3 21 9"/>
            <line x1="10" y1="14" x2="21" y2="3"/>
          </svg>
          <span>ternis.dev</span>
        </a>
      </div>
    </div>

    <!-- Infrastructure & Anycast Column -->
    <div class="footer-nav-col">
      <h4 class="footer-col-title">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
          <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
          <line x1="6" y1="6" x2="6.01" y2="6"/>
          <line x1="6" y1="18" x2="6.01" y2="18"/>
        </svg>
        <span>Infrastructure</span>
      </h4>
      <ul class="footer-col-list">
        <li>
          <a href="https://status.xpsystems.eu" target="_blank" rel="noopener noreferrer" class="footer-nav-link footer-nav-highlight">
            <span class="footer-bullet-dot green"></span>
            <span>Live Status &amp; Telemetry</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
        <li>
          <a href="https://europehost.eu" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <span>EuropeHost.eu</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
        <li>
          <a href="https://eu-data.org" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <span>eu-data.org</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
        <li>
          <a href="https://mtex.dev" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <span>MTEX.dev Services</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
      </ul>

      <!-- Nameserver Box with Click-to-Copy -->
      <div class="footer-ns-box spotlight-card">
        <span class="footer-ns-title">Anycast Nameservers</span>
        <div class="footer-ns-item" data-copy="one.ns.ternis.net" title="Click to copy primary nameserver">
          <code>one.ns.ternis.net</code>
          <svg class="ns-copy-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
          </svg>
        </div>
        <div class="footer-ns-item" data-copy="two.ns.ternis.net" title="Click to copy secondary nameserver">
          <code>two.ns.ternis.net</code>
          <svg class="ns-copy-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Open Source Column -->
    <div class="footer-nav-col">
      <h4 class="footer-col-title">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="2" y1="12" x2="22" y2="12"/>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        <span>Open Source</span>
      </h4>
      <ul class="footer-col-list">
        <li>
          <a href="https://oss.ternis.org" target="_blank" rel="noopener noreferrer" class="footer-nav-link footer-nav-highlight">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <line x1="2" y1="12" x2="22" y2="12"/>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            <span>oss.ternis.org Hub</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
        <li>
          <a href="https://github.com/xpsystems" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
            </svg>
            <span>GitHub @xpsystems</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
        <li>
          <a href="https://github.com/xpsystems-ai" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <span>AI Automation Hub</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
        <li><a href="<?= htmlspecialchars(url('opensource')) ?>" class="footer-nav-link">Repository Hub</a></li>
        <li><a href="<?= htmlspecialchars(url('domains')) ?>" class="footer-nav-link">Domain Portfolio</a></li>
      </ul>
    </div>

    <!-- Direct & Legal Column -->
    <div class="footer-nav-col">
      <h4 class="footer-col-title">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
        </svg>
        <span>Direct &amp; Legal</span>
      </h4>
      <ul class="footer-col-list">
        <li><a href="<?= htmlspecialchars(url('contact')) ?>" class="footer-nav-link">Contact Desk</a></li>
        <li><a href="<?= htmlspecialchars(url('/impressum', 'main')) ?>" class="footer-nav-link">Impressum (§ 5 DDG)</a></li>
        <li><a href="/privacy" class="footer-nav-link">Datenschutz (GDPR)</a></li>
        <li>
          <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" class="footer-nav-link">
            <span>ternis.dev (Parent)</span>
            <span class="footer-ext-arrow">&nearr;</span>
          </a>
        </li>
        <li><a href="mailto:xpsystems@ternismail.de" class="footer-nav-link footer-nav-highlight">xpsystems@ternismail.de</a></li>
        <li><a href="mailto:f.ternis@xpsystems.eu" class="footer-nav-link">Founder Direct</a></li>
      </ul>
    </div>
  </div>

  <!-- Giant Architectural Wordmark -->
  <div class="container footer-monument-wrap" aria-hidden="true">
    <div class="footer-monument-wordmark">XPSYSTEMS</div>
  </div>

  <!-- Bottom Bar -->
  <div class="container footer-bottom-strip">
    <div class="footer-bottom-left">
      <span>&copy; <?= $currentYear ?? date('Y') ?> <strong>xpsystems</strong> &bull; Sub-entity of <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" class="footer-inline-link">ternis.dev</a> (<a href="https://ternis-edv.de" target="_blank" rel="noopener noreferrer" class="footer-inline-link">ternis-edv</a>). Built with precision &amp; sovereign infrastructure in Germany.</span>
    </div>

    <div class="footer-bottom-right">
      <!-- Playful Dev Easter Egg Quote -->
      <button type="button" class="footer-quote-pill" id="footer-quote-pill" title="Click for a quick byte from the dev desk" aria-label="Cycle developer thought">
        <span class="quote-sparkle">✨</span>
        <span id="footer-quote-text">Packets routed with zero drama</span>
      </button>

      <!-- Version & ASN Pill -->
      <span class="footer-version-pill">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
          <line x1="7" y1="7" x2="7.01" y2="7"/>
        </svg>
        <span>v<?= htmlspecialchars($app['version'] ?? '3.4.0') ?></span>
        <span class="pill-divider">&bull;</span>
        <span>AS??? (EU)</span>
      </span>

      <?php $component('theme-toggle'); ?>
    </div>
  </div>
</footer>
