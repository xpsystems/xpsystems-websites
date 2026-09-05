<div id="preload-bar"></div>

<div id="xps-loader" class="xps-loader" role="status" aria-live="polite" aria-label="Loading xpsystems">
  <div class="loader-card">
    <!-- Playful SVG Node Network Graphic -->
    <div class="loader-art" aria-hidden="true">
      <svg class="loader-network-svg" viewBox="0 0 140 60" width="140" height="60" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Connecting Track -->
        <line x1="26" y1="30" x2="114" y2="30" stroke="var(--border)" stroke-width="3" stroke-linecap="round" />
        <line class="loader-active-track" x1="26" y1="30" x2="114" y2="30" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" />

        <!-- Node Left -->
        <circle cx="26" cy="30" r="14" fill="var(--bg-elevated)" stroke="var(--border-hover)" stroke-width="2" />
        <circle class="loader-pulse-dot dot-1" cx="26" cy="30" r="6" fill="var(--accent)" />

        <!-- Node Center -->
        <circle cx="70" cy="30" r="16" fill="var(--bg-elevated)" stroke="var(--border-hover)" stroke-width="2" />
        <circle class="loader-pulse-dot dot-2" cx="70" cy="30" r="7" fill="var(--accent)" />

        <!-- Node Right -->
        <circle cx="114" cy="30" r="14" fill="var(--bg-elevated)" stroke="var(--border-hover)" stroke-width="2" />
        <circle class="loader-pulse-dot dot-3" cx="114" cy="30" r="6" fill="var(--accent)" />

        <!-- Traveling Packet Dot -->
        <circle class="loader-packet-runner" cx="26" cy="30" r="4.5" fill="var(--accent)" />
      </svg>
    </div>

    <!-- Wordmark: xpsystems only -->
    <div class="loader-brand">
      <span class="loader-title">xpsystems</span>
    </div>

    <!-- Flat Progress Bar Pill -->
    <div class="loader-progress-track" aria-hidden="true">
      <div class="loader-progress-fill" id="loader-progress-fill"></div>
    </div>

    <!-- Live Status Pill Badge -->
    <div class="loader-footer">
      <span class="loader-status-pill">
        <span class="loader-status-dot"></span>
        <span class="loader-status-text" id="loader-status-text">initializing system...</span>
      </span>
    </div>
  </div>
</div>

<script>
(function() {
  var l = document.getElementById("xps-loader");
  if (!l) return;
  function dismiss() {
    if (!l || l.classList.contains("is-loaded")) return;
    var fill = document.getElementById("loader-progress-fill");
    var txt = document.getElementById("loader-status-text");
    if (fill) fill.style.width = "100%";
    if (txt) txt.textContent = "ready!";
    setTimeout(function() {
      if (l) l.classList.add("is-loaded");
      setTimeout(function() {
        if (l && l.parentNode) l.parentNode.removeChild(l);
      }, 350);
    }, 120);
  }

  // Fast trigger: on DOM ready or immediate if already interactive
  if (document.readyState === "interactive" || document.readyState === "complete") {
    setTimeout(dismiss, 180);
  } else {
    document.addEventListener("DOMContentLoaded", function() { setTimeout(dismiss, 180); }, { once: true });
    window.addEventListener("load", function() { setTimeout(dismiss, 100); }, { once: true });
    setTimeout(dismiss, 500); // 500ms guaranteed fallback
  }
})();
</script>
