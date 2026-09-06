<footer class="site-footer" id="site-footer">
  <div class="container">
    <!-- Telemetry Dock -->
    <div class="footer-dock">
      <div class="footer-dock-left">
        <span class="footer-meta-tag">
          <span class="status-dot green"></span>
          <span>German Operations: xpsystems.eu &bull; xpsystems.de &bull; xpsys.de</span>
        </span>
        <span class="footer-meta-tag mono">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
            <line x1="6" y1="6" x2="6.01" y2="6"/>
            <line x1="6" y1="18" x2="6.01" y2="18"/>
          </svg>
          <span>Authoritative NS: one.ns.ternis.net</span>
        </span>
      </div>

      <div class="footer-dock-right">
        <span class="footer-meta-tag mono">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          <span>Sub-Entity of ternis.dev (ternis-edv)</span>
        </span>

        <button type="button" class="btn btn-secondary btn-sm" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Return to top of page">
          <span>Top</span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- 4-Column Editorial Links Grid -->
    <div class="footer-links-grid">
      <!-- Brand & Declaration -->
      <div class="footer-brand-col">
        <a href="<?= htmlspecialchars(url('main')) ?>" class="footer-brand-logo" aria-label="xpsystems home">
          <span class="nav-logo-mark">XP</span>
          <span>xpsystems<span style="color:var(--accent);">.</span></span>
        </a>

        <p class="footer-brand-desc">
          German web provider and European sovereign infrastructure platform. Operated as a sub-entity of <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" style="color:var(--text);text-decoration:underline;">ternis.dev</a> (<a href="https://ternis-edv.de" target="_blank" rel="noopener noreferrer" style="color:var(--text);text-decoration:underline;">ternis-edv</a>).
        </p>

        <div class="footer-sovereignty-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          <span>100% GDPR &bull; Bare-Metal EU &bull; Zero Cookies</span>
        </div>
      </div>

      <!-- Column 1: Infrastructure -->
      <div>
        <h4 class="footer-col-title">Infrastructure</h4>
        <ul class="footer-nav-list">
          <li><a href="<?= htmlspecialchars(url('/status')) ?>">System Status</a></li>
          <li><a href="<?= htmlspecialchars(url('/api-docs')) ?>">Status API Reference</a></li>
          <li><a href="<?= htmlspecialchars(url('/domains')) ?>">Domain Portfolio</a></li>
          <li><a href="https://status.xpsystems.eu" target="_blank" rel="noopener noreferrer">Live Telemetry Feed</a></li>
          <li><a href="https://dnbx.de" target="_blank" rel="noopener noreferrer">DNBX Nameserver API</a></li>
        </ul>
      </div>

      <!-- Column 2: Ecosystem & Services -->
      <div>
        <h4 class="footer-col-title">Ecosystem</h4>
        <ul class="footer-nav-list">
          <li><a href="https://ternis.dev" target="_blank" rel="noopener noreferrer">ternis.dev (Parent)</a></li>
          <li><a href="https://europehost.eu" target="_blank" rel="noopener noreferrer">EuropeHost.eu</a></li>
          <li><a href="https://eu-data.org" target="_blank" rel="noopener noreferrer">eu-data.org</a></li>
          <li><a href="https://mtex.dev" target="_blank" rel="noopener noreferrer">MTEX.dev</a></li>
          <li><a href="https://xpsys.eu" target="_blank" rel="noopener noreferrer">xpsys.eu</a></li>
        </ul>
      </div>

      <!-- Column 3: Open Source & Legal -->
      <div>
        <h4 class="footer-col-title">Source &amp; Legal</h4>
        <ul class="footer-nav-list">
          <li><a href="<?= htmlspecialchars(url('/opensource')) ?>">Open Source Hub</a></li>
          <li><a href="https://github.com/xpsystems" target="_blank" rel="noopener noreferrer">GitHub @xpsystems</a></li>
          <li><a href="https://oss.ternis.org" target="_blank" rel="noopener noreferrer">oss.ternis.org</a></li>
          <li><a href="<?= htmlspecialchars(url('/contact')) ?>">Contact Desk</a></li>
          <li><a href="<?= htmlspecialchars(url('/impressum')) ?>">Impressum (§ 5 DDG)</a></li>
          <li><a href="<?= htmlspecialchars(url('/privacy')) ?>">Privacy Policy (DSGVO)</a></li>
        </ul>
      </div>
    </div>

    <!-- Bottom State Strip -->
    <div class="footer-bottom">
      <div>
        &copy; <?= date('Y') ?> xpsystems &bull; A sub-entity of <a href="https://ternis-edv.de" target="_blank" rel="noopener noreferrer">ternis-edv</a> (ternis.dev). All rights reserved.
      </div>

      <div style="display:flex;gap:16px;align-items:center;">
        <button type="button" onclick="window.openTransitionModal &amp;&amp; window.openTransitionModal()" style="background:none;border:none;color:var(--text-muted);font-family:var(--font-mono);font-size:0.75rem;cursor:pointer;text-decoration:underline;padding:0;" title="View Transition Briefing">Transition Briefing</button>
        <span>&bull;</span>
        <span class="mono">v<?= htmlspecialchars($brand['version'] ?? $app['version'] ?? '5.4.0') ?></span>
        <span>&bull;</span>
        <span class="mono">Engineered in Germany</span>
      </div>
    </div>
  </div>
</footer>
