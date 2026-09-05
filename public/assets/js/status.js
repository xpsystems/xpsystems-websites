(function () {
  "use strict";

  const script     = document.querySelector("script[data-status-engine]");
  const API_BASE   = script?.dataset.apiBase || "";
  const SSE_URL    = script?.dataset.sseUrl  || "/events";

  const refreshBtn    = document.getElementById("refresh-btn");
  const checkedTimeEl = document.getElementById("checked-time");
  const tip           = document.getElementById("day-tooltip");
  const tipDate       = document.getElementById("day-tooltip-date");
  const tipBadge      = document.getElementById("day-tooltip-badge");
  const tipRows       = document.getElementById("day-tooltip-rows");

  const drawerBackdrop= document.getElementById("day-drawer-backdrop");
  const drawer        = document.getElementById("day-drawer");
  const drawerClose   = document.getElementById("day-drawer-close");
  const drawerSvc     = document.getElementById("day-drawer-svc");
  const drawerTitle   = document.getElementById("day-drawer-title");
  const drawerBody    = document.getElementById("day-drawer-body");

  const STATUS_CLS = ["up", "degraded", "outage-minor", "outage-major", "outage-critical", "unknown", "not_deployed"];
  const STATUS_LABELS = {
    up:           "Operational",
    degraded:     "Degraded",
    "outage-minor": "Minor Outage",
    "outage-major": "Major Outage",
    "outage-critical": "Critical Outage",
    down:         "Outage",
    not_deployed: "Not Deployed",
    unknown:      "No data",
  };

  function fmtSecs(s) {
    s = parseInt(s, 10);
    if (!s || s <= 0) return null;
    const h = Math.floor(s / 3600), m = Math.floor((s % 3600) / 60), sec = s % 60;
    if (h > 0 && m > 0) return h + "h " + m + "m";
    if (h > 0) return h + "h";
    if (m > 0 && sec > 0) return m + "m " + sec + "s";
    if (m > 0) return m + "m";
    return sec + "s";
  }

  function tipRow(label, value) {
    const el = document.createElement("div");
    el.className = "day-tooltip-row";
    el.innerHTML = '<span class="day-tooltip-label">' + label + '</span>'
                 + '<span class="day-tooltip-val">' + value + '</span>';
    return el;
  }

  function positionTip(e) {
    if (!tip) return;
    const tw = tip.offsetWidth, th = tip.offsetHeight;
    let x = e.clientX - tw / 2;
    let y = e.clientY - th - 14;
    x = Math.max(8, Math.min(x, window.innerWidth - tw - 8));
    if (y < 8) y = e.clientY + 18;
    tip.style.left = x + "px";
    tip.style.top  = y + "px";
  }

  // ── Attach Tooltip & Drawer on Uptime Ticks ──────────────────────────────
  document.querySelectorAll(".uptime-tick").forEach(tick => {
    tick.addEventListener("mouseenter", e => {
      if (!tip) return;
      const date     = tick.dataset.tipDate      || "";
      const status   = tick.dataset.tipStatus    || "";
      const cls      = tick.dataset.tipStatusCls || "";
      const uptime   = tick.dataset.tipUptime    || "";
      const lat      = tick.dataset.tipLat       || "";
      const downSecs = tick.dataset.tipDownSecs  || "0";
      const degSecs  = tick.dataset.tipDegSecs   || "0";
      const total    = tick.dataset.tipTotal     || "0";

      if (tipDate) tipDate.textContent = date;
      if (tipBadge) {
        STATUS_CLS.forEach(c => tipBadge.classList.remove("day-tooltip-badge--" + c));
        tipBadge.textContent = status || "Unknown";
        if (cls) tipBadge.classList.add("day-tooltip-badge--" + cls);
      }

      if (tipRows) {
        tipRows.innerHTML = "";
        if (uptime !== "") tipRows.appendChild(tipRow("Uptime", parseFloat(uptime).toFixed(2) + "%"));
        const df = fmtSecs(downSecs); if (df) tipRows.appendChild(tipRow("Downtime", df));
        const dg = fmtSecs(degSecs);  if (dg) tipRows.appendChild(tipRow("Degraded", dg));
        if (lat !== "") tipRows.appendChild(tipRow("Avg latency", lat + " ms"));
        if (parseInt(total, 10) > 0) tipRows.appendChild(tipRow("Checks", total));
      }

      tip.classList.add("day-tooltip--visible");
      positionTip(e);
    });

    tick.addEventListener("mousemove", positionTip);
    tick.addEventListener("mouseleave", () => {
      if (tip) tip.classList.remove("day-tooltip--visible");
    });

    tick.addEventListener("click", () => {
      const slug = tick.dataset.slug;
      const date = tick.dataset.date;
      if (slug && date) {
        openDrawer(slug, date);
      }
    });
  });

  // ── Drawer Management ──────────────────────────────────────────────────────
  async function openDrawer(slug, date) {
    if (!drawer || !drawerBackdrop) return;

    if (drawerSvc) drawerSvc.textContent = slug;
    if (drawerTitle) drawerTitle.textContent = date;
    if (drawerBody) {
      drawerBody.innerHTML = `
        <div style="display:flex;align-items:center;justify-content:center;gap:12px;padding:48px;color:var(--text-muted);">
          <div class="loading-spinner"></div>
          <span>Loading day diagnostics...</span>
        </div>
      `;
    }

    drawerBackdrop.classList.add("day-drawer-backdrop--open");
    drawer.classList.add("day-drawer--open");
    document.body.style.overflow = "hidden";

    try {
      const res = await fetch(API_BASE + "/api/day/" + encodeURIComponent(slug) + "/" + encodeURIComponent(date));
      if (!res.ok) throw new Error("HTTP error " + res.status);
      const data = await res.json();
      renderDrawerContent(data);
    } catch (err) {
      if (drawerBody) {
        drawerBody.innerHTML = `
          <div style="text-align:center;padding:40px;color:var(--text-dim);">
            <p style="color:var(--red);font-weight:600;">Unable to load telemetry for this date.</p>
            <p style="font-size:0.8125rem;font-family:var(--font-mono);margin-top:8px;">${err.message}</p>
          </div>
        `;
      }
    }
  }

  function renderDrawerContent(data) {
    if (!drawerBody) return;
    const sum = data.summary || {};
    const incidents = Array.isArray(data.incidents) ? data.incidents : [];
    const checks = Array.isArray(data.checks) ? data.checks : [];

    let incidentsHtml = '';
    if (incidents.length === 0) {
      incidentsHtml = `
        <div style="background-color:var(--bg-alt);border:1px solid var(--border);border-radius:var(--radius-xs);padding:14px 18px;color:var(--green);font-size:0.875rem;display:flex;align-items:center;gap:10px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          <span>No incidents or service disruptions recorded for this day.</span>
        </div>
      `;
    } else {
      incidentsHtml = '<div class="drawer-incident-list">';
      incidents.forEach(inc => {
        const fromDate = new Date(inc.from * 1000).toISOString().substring(11, 19) + ' UTC';
        const toDate = new Date(inc.to * 1000).toISOString().substring(11, 19) + ' UTC';
        const isDegraded = inc.status === 'degraded';
        incidentsHtml += `
          <div class="drawer-incident-item ${isDegraded ? 'drawer-incident-item--degraded' : ''}">
            <div class="incident-time">${fromDate} &mdash; ${toDate} (${fmtSecs(inc.secs) || inc.secs + 's'})</div>
            <div class="incident-desc">${isDegraded ? 'Degraded Performance Event' : 'Outage Event'}</div>
          </div>
        `;
      });
      incidentsHtml += '</div>';
    }

    drawerBody.innerHTML = `
      <div class="drawer-metrics-grid">
        <div class="drawer-metric-box">
          <span class="metric-label">Daily Uptime</span>
          <span class="metric-value" style="color:var(--green)">${sum.uptime_pct != null ? sum.uptime_pct + '%' : '100%'}</span>
        </div>
        <div class="drawer-metric-box">
          <span class="metric-label">Avg Response</span>
          <span class="metric-value">${sum.avg_latency_ms != null ? sum.avg_latency_ms + ' ms' : '&mdash;'}</span>
        </div>
        <div class="drawer-metric-box">
          <span class="metric-label">Downtime</span>
          <span class="metric-value">${fmtSecs(sum.down_secs) || '0s'}</span>
        </div>
        <div class="drawer-metric-box">
          <span class="metric-label">Total Checks</span>
          <span class="metric-value">${sum.total_checks ?? checks.length}</span>
        </div>
      </div>

      <div style="margin-top:24px;">
        <h3 style="font-size:0.875rem;font-family:var(--font-mono);text-transform:uppercase;letter-spacing:0.06em;color:var(--text-muted);margin-bottom:12px;">
          Incident Timeline
        </h3>
        ${incidentsHtml}
      </div>
    `;
  }

  function closeDrawer() {
    if (drawerBackdrop) drawerBackdrop.classList.remove("day-drawer-backdrop--open");
    if (drawer) drawer.classList.remove("day-drawer--open");
    document.body.style.overflow = "";
  }

  if (drawerClose) drawerClose.addEventListener("click", closeDrawer);
  if (drawerBackdrop) drawerBackdrop.addEventListener("click", closeDrawer);
  document.addEventListener("keydown", e => {
    if (e.key === "Escape") closeDrawer();
  });

  // ── Real-Time Status Engine & SSE ──────────────────────────────────────────
  function applyStatusPayload(json) {
    if (!json || !json.services) return;
    const services = Array.isArray(json.services) ? json.services : Object.entries(json.services).map(([k, v]) => ({ slug: k, ...v }));

    services.forEach(svc => {
      const card = document.querySelector(`.status-service-card[data-slug="${CSS.escape(svc.slug)}"]`);
      if (!card) return;

      const indicator = card.querySelector(".service-indicator");
      const statusPill = card.querySelector(".telemetry-pill--status");
      const latencyPill = card.querySelector(".telemetry-pill--latency");

      if (indicator) {
        STATUS_CLS.forEach(s => indicator.classList.remove("service-indicator--" + s));
        indicator.classList.add("service-indicator--" + (svc.status || "unknown"));
      }

      if (statusPill) {
        STATUS_CLS.forEach(s => statusPill.classList.remove("telemetry-pill--status-" + s));
        statusPill.classList.add("telemetry-pill--status-" + (svc.status || "unknown"));
        statusPill.textContent = STATUS_LABELS[svc.status] || "Unknown";
      }

      if (latencyPill && svc.latency_ms != null) {
        latencyPill.textContent = svc.latency_ms + "ms";
      }
    });

    if (checkedTimeEl && json.checked_at) {
      const d = new Date(json.checked_at * 1000);
      checkedTimeEl.textContent = d.toISOString().replace("T", " ").substring(0, 16) + " UTC";
    }

    if (window.showToast) {
      window.showToast("Live telemetry updated", "success");
    }
  }

  async function fetchStatusManual() {
    if (refreshBtn) {
      refreshBtn.classList.add("spinning");
      refreshBtn.disabled = true;
    }
    try {
      const res = await fetch(API_BASE + "/api/status", { cache: "no-store" });
      if (!res.ok) throw new Error("HTTP " + res.status);
      const data = await res.json();
      applyStatusPayload(data);
    } catch (_) {
      if (window.showToast) {
        window.showToast("Failed to refresh status", "error");
      }
    } finally {
      if (refreshBtn) {
        setTimeout(() => {
          refreshBtn.classList.remove("spinning");
          refreshBtn.disabled = false;
        }, 500);
      }
    }
  }

  if (refreshBtn) {
    refreshBtn.addEventListener("click", fetchStatusManual);
  }

  // ── SSE Stream ─────────────────────────────────────────────────────────────
  if (window.EventSource && SSE_URL) {
    try {
      const sse = new EventSource(SSE_URL);
      sse.addEventListener("status", e => {
        try {
          applyStatusPayload(JSON.parse(e.data));
        } catch (_) {}
      });
    } catch (_) {}
  }
})();
