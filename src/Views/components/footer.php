<footer class="site-footer" id="site-footer">
  <div class="container">

    <!-- Flat Announcement Footer Card -->
    <div class="footer-rework-box">
      <div class="footer-rework-info">
        <a href="<?= htmlspecialchars(url('main')) ?>" class="footer-brand-logo" aria-label="xpsystems home">
          <span class="nav-logo-mark">XP</span>
          <span>xpsystems<span style="color:var(--signal);">.</span></span>
        </a>
        <p class="footer-rework-desc">
          German Web-Provider &bull; European Sovereign Infrastructure. Sub-entity of <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer"><strong>ternis.dev</strong></a> (<a href="https://ternis-edv.de" target="_blank" rel="noopener noreferrer">ternis-edv</a>). Currently under complete platform reconstruction.
        </p>
      </div>

      <div class="footer-rework-links">
        <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" class="footer-rework-link">
          <span>ternis.dev</span>
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </a>
        <a href="https://oss.ternis.org" target="_blank" rel="noopener noreferrer" class="footer-rework-link">
          <span>oss.ternis.org</span>
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </a>
        <a href="https://github.com/xpsystems" target="_blank" rel="noopener noreferrer" class="footer-rework-link">
          <span>GitHub</span>
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </a>
        <a href="mailto:xpsystems@ternismail.de" class="footer-rework-link">
          <span>Operations Desk</span>
        </a>
        <a href="https://ternis.dev/en/legal/imprint" target="_blank" rel="noopener noreferrer" class="footer-rework-link imprint-link">
          <span>Impressum / Imprint (§ 5 DDG)</span>
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </a>
      </div>
    </div>

    <!-- Bottom State Strip -->
    <div class="footer-bottom">
      <div>
        &copy; <?= date('Y') ?> xpsystems &bull; A sub-entity of <a href="https://ternis-edv.de" target="_blank" rel="noopener noreferrer">ternis-edv</a> (ternis.dev). All rights reserved.
      </div>

      <div style="display:flex;gap:14px;align-items:center;flex-wrap:wrap;">
        <button type="button" onclick="window.openTransitionModal &amp;&amp; window.openTransitionModal()" style="background:none;border:none;color:var(--signal);font-family:var(--font-mono);font-size:0.75rem;cursor:pointer;text-decoration:underline;padding:0;font-weight:700;" title="View Transition Briefing">Transition Briefing</button>
        <span>&bull;</span>
        <span class="mono">v<?= htmlspecialchars($brand['version'] ?? $app['version'] ?? '5.4.0') ?> (rework)</span>
        <span>&bull;</span>
        <span class="mono">DE/EU Bare-Metal</span>
      </div>
  </div>
</footer>
