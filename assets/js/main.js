(function () {
  'use strict';

  /* ── 1. Global Toast Notification System ───────────────────────────── */
  let toastContainer = document.querySelector('.toast-container');
  if (!toastContainer) {
    toastContainer = document.createElement('div');
    toastContainer.className = 'toast-container';
    document.body.appendChild(toastContainer);
  }

  function showToast(message, duration = 3000) {
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `
      <svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span>${escapeHtml(message)}</span>
    `;
    toastContainer.appendChild(toast);

    requestAnimationFrame(() => {
      toast.classList.add('toast-show');
    });

    setTimeout(() => {
      toast.classList.remove('toast-show');
      setTimeout(() => {
        if (toast.parentNode) toast.parentNode.removeChild(toast);
      }, 300);
    }, duration);
  }
  window.showToast = showToast;

  function copyToClipboard(text, successMsg = 'Copied to clipboard') {
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(text).then(() => {
        showToast(successMsg);
      }).catch(() => {
        fallbackCopy(text, successMsg);
      });
    } else {
      fallbackCopy(text, successMsg);
    }
  }

  function fallbackCopy(text, successMsg) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
      document.execCommand('copy');
      showToast(successMsg);
    } catch (err) {
      showToast('Could not copy text');
    }
    document.body.removeChild(textArea);
  }

  /* ── 2. Click-to-Copy Handlers ─────────────────────────────────────── */
  document.addEventListener('click', function (e) {
    const copyTarget = e.target.closest('[data-copy]');
    if (copyTarget) {
      e.preventDefault();
      e.stopPropagation();
      const text = copyTarget.getAttribute('data-copy');
      const label = copyTarget.getAttribute('data-copy-label') || text;
      copyToClipboard(text, `Copied: ${label}`);
    }
  });

  /* ── 3. Status URL & Preload Bar ──────────────────────────────────── */
  const scriptEl = document.querySelector("script[data-status-url]");
  const STATUS_URL = (scriptEl && scriptEl.dataset.statusUrl)
    ? scriptEl.dataset.statusUrl
    : (window.location.hostname.includes("status.") || window.location.hostname.includes("localhost") || window.location.hostname.includes("127.0.0.1"))
      ? "/api/status"
      : "https://status.xpsystems.eu/api/status";

  const bar = document.getElementById("preload-bar");
  if (bar) {
    requestAnimationFrame(function () {
      bar.style.transition = "width 600ms cubic-bezier(.23,.49,.55,.98)";
      bar.style.width = "75%";
    });

    function finishBar() {
      bar.classList.add("done");
      bar.style.width = "100%";
      bar.style.opacity = "0";
      setTimeout(function () {
        if (bar.parentNode) bar.parentNode.removeChild(bar);
      }, 600);
    }

    if (document.readyState === "complete") {
      finishBar();
    } else {
      window.addEventListener("load", finishBar, { once: true });
    }
  }

  /* ── 4. Theme Management ─────────────────────────────────────────── */
  const THEME_KEY = "xps-theme";

  function getSystemTheme() {
    return window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "dark";
  }

  function applyTheme(mode, animate = true) {
    if (animate) {
      const html = document.documentElement;
      html.classList.add("is-switching-theme");
      clearTimeout(applyTheme._t);
      applyTheme._t = setTimeout(function () {
        html.classList.remove("is-switching-theme");
      }, 300);
    }

    const resolved = mode === "system" ? getSystemTheme() : mode;
    document.documentElement.setAttribute("data-theme", resolved);
    document.querySelectorAll(".theme-btn").forEach(function (btn) {
      btn.classList.toggle("active", btn.dataset.theme === mode);
    });
  }

  const currentTheme = localStorage.getItem(THEME_KEY) || "system";
  applyTheme(currentTheme, false);

  window.matchMedia("(prefers-color-scheme: light)").addEventListener("change", function () {
    if ((localStorage.getItem(THEME_KEY) || "system") === "system") {
      applyTheme("system", false);
    }
  });

  document.querySelectorAll(".theme-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const mode = btn.dataset.theme;
      localStorage.setItem(THEME_KEY, mode);
      applyTheme(mode);
    });
  });

  /* ── 5. Mobile Navigation Drawer ─────────────────────────────────── */
  const hamburger = document.getElementById("nav-hamburger") || document.querySelector(".nav-hamburger");
  const navLinks = document.getElementById("nav-links") || document.querySelector(".nav-links");
  const overlay = document.getElementById("nav-overlay") || document.querySelector(".nav-overlay");

  function openNav() {
    if (!hamburger || !navLinks) return;
    hamburger.classList.add("open");
    navLinks.classList.add("open");
    if (overlay) overlay.classList.add("active");
    hamburger.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  }

  function closeNav() {
    if (!hamburger || !navLinks) return;
    hamburger.classList.remove("open");
    navLinks.classList.remove("open");
    if (overlay) overlay.classList.remove("active");
    hamburger.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  }

  if (hamburger) {
    hamburger.addEventListener("click", function () {
      navLinks && navLinks.classList.contains("open") ? closeNav() : openNav();
    });
  }

  if (overlay) {
    overlay.addEventListener("click", closeNav);
  }

  if (navLinks) {
    navLinks.querySelectorAll("a.nav-link").forEach(function (link) {
      link.addEventListener("click", function () {
        if (navLinks.classList.contains("open")) closeNav();
      });
    });
  }

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && navLinks && navLinks.classList.contains("open")) {
      closeNav();
    }
  });

  /* ── 6. Scroll Reveal ────────────────────────────────────────────── */
  if ("IntersectionObserver" in window) {
    const revealObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.08, rootMargin: "0px 0px -40px 0px" }
    );

    document.querySelectorAll(".reveal").forEach(function (el) {
      revealObserver.observe(el);
    });
  } else {
    document.querySelectorAll(".reveal").forEach(function (el) {
      el.classList.add("visible");
    });
  }

  /* ── 7. Live Status Checking ─────────────────────────────────────── */
  const statusDot = document.getElementById("status-dot");
  const statusText = document.getElementById("status-text");
  const statusBadge = document.getElementById("status-badge");

  const STATUS_MAP = {
    operational:    { dot: "green",  label: "All Systems Operational", badgeClass: "badge-green"  },
    partial_outage: { dot: "yellow", label: "Partial Outage",          badgeClass: "badge-yellow" },
    major_outage:   { dot: "red",    label: "Major Outage",            badgeClass: "badge-red"    },
    unknown:        { dot: "grey",   label: "Checking Status…",        badgeClass: "badge-grey"   },
  };

  function applyStatus(overall) {
    if (!statusDot || !statusBadge || !statusText) return;
    const state = STATUS_MAP[overall] || STATUS_MAP["unknown"];
    statusDot.className = "status-dot " + state.dot;
    statusBadge.className = "status-badge " + state.badgeClass;
    statusText.textContent = state.label;
  }

  async function checkStatus() {
    if (!statusDot || !STATUS_URL) return;
    const controller = new AbortController();
    const timeout = setTimeout(function () { controller.abort(); }, 6000);
    try {
      const res = await fetch(STATUS_URL, {
        method: "GET", signal: controller.signal, cache: "no-store",
      });
      clearTimeout(timeout);
      if (!res.ok) throw new Error("status error " + res.status);
      const data = await res.json();
      const overall = typeof data.overall === "string" ? data.overall : "operational";
      applyStatus(overall);
    } catch {
      clearTimeout(timeout);
      // Fallback to operational if endpoint blocked by client adblocker
      applyStatus("operational");
    }
  }

  if (statusDot) {
    checkStatus();
  }

  /* ── 8. Header Sticky Border ─────────────────────────────────────── */
  const navHeader = document.querySelector(".nav-header");
  if (navHeader) {
    window.addEventListener("scroll", function () {
      navHeader.classList.toggle("is-scrolled", window.scrollY > 15);
    }, { passive: true });
  }

  /* ── 9. Universal Keyboard Search Navigation (Press '/') ─────────── */
  document.addEventListener("keydown", function (e) {
    if (e.key === "/" && !["INPUT", "TEXTAREA", "SELECT"].includes(document.activeElement.tagName)) {
      const searchTarget = document.getElementById("domain-search") || document.getElementById("repo-search");
      if (searchTarget) {
        e.preventDefault();
        searchTarget.focus();
        searchTarget.select();
      }
    }
  });

  /* ── 10. Domain Portfolio Filter & Search ────────────────────────── */
  const domainSearch = document.getElementById("domain-search");
  const domainFilterPills = document.querySelectorAll(".domain-filter-pill");
  const domainCounterStatus = document.getElementById("domain-counter-status");

  if (domainSearch || domainFilterPills.length > 0) {
    let activeFilter = "all";
    let searchQuery = "";

    function filterDomains() {
      let visibleCount = 0;
      let totalCount = 0;

      const cards = document.querySelectorAll(".domain-card");
      cards.forEach(function (card) {
        const category = card.dataset.category || "all";
        const matchesCategory = (activeFilter === "all" || category === activeFilter);

        let cardHasMatch = false;
        const rows = card.querySelectorAll(".domain-row");
        rows.forEach(function (row) {
          totalCount++;
          const domain = row.dataset.domain || row.textContent.toLowerCase();
          const matchesSearch = !searchQuery || domain.includes(searchQuery);

          if (matchesCategory && matchesSearch) {
            row.style.display = "";
            cardHasMatch = true;
            visibleCount++;
          } else {
            row.style.display = "none";
          }
        });

        card.style.display = cardHasMatch ? "" : "none";
      });

      if (domainCounterStatus) {
        if (searchQuery || activeFilter !== "all") {
          domainCounterStatus.textContent = `Showing ${visibleCount} of ${totalCount} domains`;
        } else {
          domainCounterStatus.textContent = `Registry contains ${totalCount} domains across our European network`;
        }
      }
    }

    if (domainSearch) {
      domainSearch.addEventListener("input", function () {
        searchQuery = domainSearch.value.trim().toLowerCase();
        filterDomains();
      });
    }

    domainFilterPills.forEach(function (pill) {
      pill.addEventListener("click", function () {
        domainFilterPills.forEach(p => p.classList.remove("active"));
        pill.classList.add("active");
        activeFilter = pill.dataset.filter;
        filterDomains();
      });
    });

    // Run initial tally
    filterDomains();
  }

  /* ── 11. Interactive Contact Subject Selector ────────────────────── */
  const subjectPills = document.querySelectorAll(".subject-pill");
  const founderEmailLink = document.getElementById("founder-mail-link");
  const generalEmailLink = document.getElementById("general-mail-link");

  if (subjectPills.length > 0) {
    subjectPills.forEach(function (pill) {
      pill.addEventListener("click", function () {
        subjectPills.forEach(p => p.classList.remove("active"));
        pill.classList.add("active");
        const subject = pill.dataset.subject || pill.textContent.trim();

        if (founderEmailLink) {
          founderEmailLink.href = `mailto:f.ternis@xpsystems.eu?subject=${encodeURIComponent(subject)}`;
        }
        if (generalEmailLink) {
          generalEmailLink.href = `mailto:contact@xpsystems.eu?subject=${encodeURIComponent(subject)}`;
        }
        showToast(`Topic selected: "${subject}"`);
      });
    });
  }

  /* ── 12. Open Source Live GitHub Explorer ────────────────────────── */
  const repoTable = document.getElementById("repo-table");
  if (repoTable) {
    initOpenSourceExplorer();
  }

  function initOpenSourceExplorer() {
    let allRepos = [];
    let sortCol = "updated";
    let sortDir = "desc";
    let filterSrc = "all";
    let searchQ = "";

    const LANG_COLORS = {
      JavaScript: "#f1e05a", TypeScript: "#3178c6", Python: "#3572A5",
      PHP: "#4F5D95", CSS: "#563d7c", HTML: "#e34c26", Shell: "#89e051",
      Go: "#00ADD8", Rust: "#dea584", Dockerfile: "#384d54", Vue: "#41b883",
      Svelte: "#ff3e00", Ruby: "#701516", C: "#555555", "C++": "#f34b7d",
      Java: "#b07219", Kotlin: "#A97BFF", Swift: "#F05138", Nix: "#7e7eff",
    };

    function escapeHtml(str) {
      return String(str ?? "")
        .replace(/&/g, "&amp;").replace(/</g, "&lt;")
        .replace(/>/g, "&gt;").replace(/"/g, "&quot;");
    }

    function relTime(iso) {
      if (!iso) return "recently";
      const diff = (Date.now() - new Date(iso)) / 1000;
      if (diff < 60) return "just now";
      if (diff < 3600) return `${Math.floor(diff / 60)}m ago`;
      if (diff < 86400) return `${Math.floor(diff / 3600)}h ago`;
      if (diff < 86400 * 30) return `${Math.floor(diff / 86400)}d ago`;
      if (diff < 86400 * 365) return `${Math.floor(diff / 2592000)}mo ago`;
      return `${Math.floor(diff / 31536000)}y ago`;
    }

    function animateCount(el, target) {
      if (!el || isNaN(target)) return;
      const duration = 900;
      const start = performance.now();
      const step = (now) => {
        const p = Math.min((now - start) / duration, 1);
        const ease = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.round(ease * target);
        if (p < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    }

    async function api(action, params = {}) {
      const qs = new URLSearchParams({ action, ...params }).toString();
      const res = await fetch(`/api?${qs}`);
      if (!res.ok) throw new Error(`API error ${res.status}`);
      return res.json();
    }

    function getFilteredRepos() {
      return allRepos
        .filter(r => filterSrc === "all" || r._source === filterSrc)
        .filter(r => {
          if (!searchQ) return true;
          const q = searchQ.toLowerCase();
          return (r.name || "").toLowerCase().includes(q) ||
                 (r.description || "").toLowerCase().includes(q) ||
                 (r.language || "").toLowerCase().includes(q);
        })
        .sort((a, b) => {
          let av, bv;
          if (sortCol === "name")    { av = a.name;             bv = b.name; }
          if (sortCol === "stars")   { av = a.stargazers_count; bv = b.stargazers_count; }
          if (sortCol === "forks")   { av = a.forks_count;      bv = b.forks_count; }
          if (sortCol === "updated") { av = a.pushed_at;        bv = b.pushed_at; }
          if (sortDir === "asc") return av > bv ? 1 : -1;
          if (sortDir === "desc") return av < bv ? 1 : -1;
          return 0;
        });
    }

    function renderTable() {
      const tbody = document.getElementById("repo-tbody");
      const empty = document.getElementById("repo-empty");
      const meta  = document.getElementById("repo-meta");
      if (!tbody) return;

      const repos = getFilteredRepos();

      document.querySelectorAll(".repo-table th.sortable").forEach(th => {
        th.classList.remove("sort-asc", "sort-desc");
        if (th.dataset.col === sortCol) th.classList.add("sort-" + sortDir);
      });

      if (repos.length === 0) {
        tbody.innerHTML = "";
        if (empty) empty.style.display = "block";
        if (meta) meta.textContent = "";
        return;
      }
      if (empty) empty.style.display = "none";
      if (meta) meta.textContent = `Showing ${repos.length} of ${allRepos.length} public repositories`;

      tbody.innerHTML = repos.map(r => `
        <tr>
          <td class="col-name">
            <div>
              <a class="repo-name-link" href="${escapeHtml(r.html_url)}" target="_blank" rel="noopener">
                ${escapeHtml(r.name)}
                ${r.fork ? '<span class="repo-fork-badge">fork</span>' : ''}
              </a>
              ${r.description ? `<div class="repo-desc">${escapeHtml(r.description)}</div>` : ''}
            </div>
          </td>
          <td class="col-org">
            <span class="org-tag">@${escapeHtml(r._source)}</span>
          </td>
          <td class="col-lang">
            <span class="lang-label">
              ${r.language
                ? `<span class="lang-dot" style="background:${LANG_COLORS[r.language] || '#8b8b8b'}"></span>${escapeHtml(r.language)}`
                : '<span style="color:var(--text-dim)">—</span>'}
            </span>
          </td>
          <td class="col-stars">
            <span class="star-count">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              ${r.stargazers_count}
            </span>
          </td>
          <td class="col-forks">
            <span class="fork-count">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="3" x2="6" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><circle cx="6" cy="6" r="3"/><path d="M18 9a9 9 0 0 1-9 9"/></svg>
              ${r.forks_count}
            </span>
          </td>
          <td class="col-updated" style="color:var(--text-muted);font-size:0.8125rem;">${relTime(r.pushed_at)}</td>
          <td class="col-link">
            <div style="display:flex; gap:6px; align-items:center;">
              <button class="repo-link-btn" title="Copy git clone URL" data-copy="git clone ${escapeHtml(r.clone_url || r.html_url)}.git" data-copy-label="${escapeHtml(r.name)}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
              </button>
              <a href="${escapeHtml(r.html_url)}" target="_blank" rel="noopener" class="repo-link-btn" title="Open on GitHub">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                </svg>
              </a>
            </div>
          </td>
        </tr>
      `).join("");
    }

    document.querySelectorAll(".repo-table th.sortable").forEach(th => {
      th.addEventListener("click", () => {
        const col = th.dataset.col;
        if (sortCol === col) { sortDir = sortDir === "asc" ? "desc" : "asc"; }
        else { sortCol = col; sortDir = col === "name" ? "asc" : "desc"; }
        renderTable();
      });
    });

    document.querySelectorAll(".filter-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        filterSrc = btn.dataset.filter;
        renderTable();
      });
    });

    const searchEl = document.getElementById("repo-search");
    if (searchEl) {
      searchEl.addEventListener("input", () => {
        searchQ = searchEl.value.trim();
        renderTable();
      });
    }

    // Load org/user accounts
    document.querySelectorAll(".org-card").forEach(async (card) => {
      const handle = card.dataset.handle;
      if (!handle) return;
      try {
        const isUser = card.querySelector(".org-type-badge")?.textContent.trim() === "user";
        const action = isUser ? "user_info" : "org_info";
        const param = isUser ? { user: handle } : { org: handle };
        const info = await api(action, param);

        const avatarWrap = document.getElementById(`avatar-${handle}`);
        if (avatarWrap && info.avatar_url) {
          avatarWrap.innerHTML = `<img src="${info.avatar_url}" alt="${handle}">`;
        }

        const repoCountEl = document.querySelector(`#org-repos-${handle} .org-stat-num`);
        if (repoCountEl && typeof info.public_repos !== "undefined") {
          repoCountEl.textContent = info.public_repos;
        }
      } catch (_) {}
    });

    // Fetch repositories
    (async () => {
      try {
        const repos = await api("all_repos");
        allRepos = Array.isArray(repos) ? repos : [];

        const totalStars = allRepos.reduce((s, r) => s + (r.stargazers_count || 0), 0);
        const totalForks = allRepos.reduce((s, r) => s + (r.forks_count || 0), 0);

        animateCount(document.getElementById("stat-repos"), allRepos.length);
        animateCount(document.getElementById("stat-stars"), totalStars);
        animateCount(document.getElementById("stat-forks"), totalForks);

        renderTable();
      } catch (err) {
        const tbody = document.getElementById("repo-tbody");
        if (tbody) {
          tbody.innerHTML = `
            <tr><td colspan="7">
              <div class="repo-loading" style="color:var(--text-dim)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Could not load live repositories. Please check connection or reload shortly.
              </div>
            </td></tr>`;
        }
      }
    })();
  }

  function escapeHtml(str) {
    return String(str ?? "")
      .replace(/&/g, "&amp;").replace(/</g, "&lt;")
      .replace(/>/g, "&gt;").replace(/"/g, "&quot;");
  }
})();

