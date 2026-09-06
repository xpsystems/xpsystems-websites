<!-- Top Announcement Bar (Situated ABOVE Navigation Header) -->
<aside class="announcement-topbar" id="announcement-topbar" aria-label="System transition notice">
  <div class="container">
    <div class="announcement-topbar-box">
      <div class="announcement-left">
        <span class="announcement-pill">
          <span class="announcement-dot"></span>
          <span>Transition Notice</span>
        </span>
        <div class="announcement-text">
          <strong>xpsystems (xpsystems.eu &bull; xpsystems.de)</strong> has transitioned to
          <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer">ternis.dev</a> (ternis-edv).
          <span class="hide-mobile">&bull; Authoritative NS: <code data-copy="one.ns.ternis.net" title="Click to copy">one.ns.ternis.net</code> &amp; <code data-copy="two.ns.ternis.net" title="Click to copy">two.ns.ternis.net</code></span>
        </div>
      </div>

      <div class="announcement-actions">
        <button type="button" class="btn btn-outline btn-sm announcement-btn" id="btn-open-briefing" onclick="window.openTransitionModal && window.openTransitionModal()" title="View full transition briefing">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
          <span>Briefing</span>
        </button>

        <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm announcement-btn">
          <span>ternis.dev</span>
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </a>

        <button type="button" class="announcement-close-btn" id="btn-dismiss-topbar" aria-label="Dismiss announcement banner" title="Dismiss top banner">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
      </div>
    </div>
  </div>
</aside>

<!-- First-Load & On-Demand Transition Briefing Modal -->
<div id="transition-modal" class="transition-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="transition-modal-title" style="display:none;">
  <div class="transition-modal-box">
    <div class="transition-modal-header">
      <div>
        <span class="announcement-pill">
          <span class="announcement-dot"></span>
          <span>System Briefing &bull; v5.4.0</span>
        </span>
        <h2 id="transition-modal-title" class="transition-modal-title" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
          <span>xpsystems</span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          <span>ternis.dev Transition</span>
        </h2>
      </div>
      <button type="button" class="announcement-close-btn" onclick="window.closeTransitionModal && window.closeTransitionModal()" aria-label="Close transition briefing modal">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>

    <div class="transition-modal-body">
      <p>
        <strong>xpsystems</strong> (encompassing <code style="font-family:var(--font-mono);font-size:0.8125rem;">xpsystems.eu</code>, <code style="font-family:var(--font-mono);font-size:0.8125rem;">xpsystems.de</code>, and <code style="font-family:var(--font-mono);font-size:0.8125rem;">xpsys.de</code>) has transitioned operations under parent organisation <strong>ternis-edv (ternis.dev)</strong>.
      </p>
      <p style="color:var(--text-muted);font-size:0.8125rem;">
        European edge nodes, Anycast DNS meshes, and digital sovereignty initiatives continue uninterrupted with enhanced telemetry and unified infrastructure.
      </p>

      <div class="transition-modal-grid">
        <div class="transition-modal-card">
          <span class="transition-modal-card-label">Authoritative DNS</span>
          <span class="transition-modal-card-val">one.ns.ternis.net<br>two.ns.ternis.net</span>
        </div>
        <div class="transition-modal-card">
          <span class="transition-modal-card-label">Parent Entity</span>
          <span class="transition-modal-card-val">ternis-edv (Germany)</span>
        </div>
        <div class="transition-modal-card">
          <span class="transition-modal-card-label">Open-Source Hub</span>
          <span class="transition-modal-card-val">oss.ternis.org</span>
        </div>
        <div class="transition-modal-card">
          <span class="transition-modal-card-label">Inquiry Routing</span>
          <span class="transition-modal-card-val">xpsystems@ternismail.de</span>
        </div>
      </div>
    </div>

    <div class="transition-modal-footer">
      <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--text-muted);">
        Status: <span style="color:var(--status-up);font-weight:700;">100% Operational</span>
      </div>
      <div style="display:flex;gap:8px;align-items:center;">
        <button type="button" class="btn btn-outline btn-sm" onclick="window.closeTransitionModal && window.closeTransitionModal()">
          <span>Acknowledge</span>
        </button>
        <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">
          <span>Visit ternis.dev</span>
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  var STORAGE_DISMISSED_KEY = "xps_announcement_dismissed_v5";
  var STORAGE_MODAL_KEY = "xps_transition_modal_seen_v5";

  var topbar = document.getElementById("announcement-topbar");
  var modal = document.getElementById("transition-modal");
  var dismissBtn = document.getElementById("btn-dismiss-topbar");

  // Check topbar dismissal preference immediately to prevent flash
  try {
    if (localStorage.getItem(STORAGE_DISMISSED_KEY) === "1" && topbar) {
      topbar.classList.add("is-dismissed");
    }
  } catch (e) {}

  // Dismiss button handler
  if (dismissBtn && topbar) {
    dismissBtn.addEventListener("click", function() {
      topbar.classList.add("is-dismissed");
      try {
        localStorage.setItem(STORAGE_DISMISSED_KEY, "1");
      } catch (e) {}
    });
  }

  // Modal open/close functions
  window.openTransitionModal = function() {
    if (!modal) return;
    modal.style.display = "flex";
    requestAnimationFrame(function() {
      modal.classList.add("is-active");
    });
    document.body.style.overflow = "hidden";
  };

  window.closeTransitionModal = function() {
    if (!modal) return;
    modal.classList.remove("is-active");
    setTimeout(function() {
      modal.style.display = "none";
      document.body.style.overflow = "";
    }, 200);
    try {
      localStorage.setItem(STORAGE_MODAL_KEY, "1");
    } catch (e) {}
  };

  // Close modal on backdrop click
  if (modal) {
    modal.addEventListener("click", function(e) {
      if (e.target === modal) {
        window.closeTransitionModal();
      }
    });
  }

  // Close modal on Escape key
  window.addEventListener("keydown", function(e) {
    if (e.key === "Escape" && modal && modal.classList.contains("is-active")) {
      window.closeTransitionModal();
    }
  });

  // First-load trigger: if modal has never been seen on this device, display it gently
  try {
    if (!localStorage.getItem(STORAGE_MODAL_KEY)) {
      setTimeout(function() {
        window.openTransitionModal();
      }, 450);
    }
  } catch (e) {}

  // Copy to clipboard helper for code elements with data-copy
  if (topbar) {
    var copyEls = topbar.querySelectorAll("[data-copy]");
    copyEls.forEach(function(el) {
      el.addEventListener("click", function() {
        var val = el.getAttribute("data-copy");
        if (val && navigator.clipboard) {
          navigator.clipboard.writeText(val).then(function() {
            var orig = el.textContent;
            el.textContent = "copied!";
            setTimeout(function() { el.textContent = orig; }, 1400);
          });
        }
      });
    });
  }
})();
</script>
