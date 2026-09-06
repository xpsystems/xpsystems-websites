/**
 * xpsystems — Master Interactive Client Script
 * World-Class Agency Interactions: In-Browser XP-CLI Terminal, Edge PoP Latency Explorer,
 * Web Audio API Tactile Sound Synthesis, Real-Time Domain Filter, CET Clock, Theme Switcher
 */

(function () {
  'use strict';

  /* ── 1. Web Audio API Tactile Mechanical Sound Synthesizer ─────────────── */
  let audioCtx = null;
  let soundEnabled = localStorage.getItem('xps-sound') === 'on';

  function initAudio() {
    if (!audioCtx && (window.AudioContext || window.webkitAudioContext)) {
      const AudioContextClass = window.AudioContext || window.webkitAudioContext;
      audioCtx = new AudioContextClass();
    }
    if (audioCtx && audioCtx.state === 'suspended') {
      audioCtx.resume();
    }
  }

  function playTickSound(freq = 1200, type = 'sine', duration = 0.02) {
    if (!soundEnabled) return;
    try {
      initAudio();
      if (!audioCtx) return;

      const osc = audioCtx.createOscillator();
      const gain = audioCtx.createGain();

      osc.type = type;
      osc.frequency.setValueAtTime(freq, audioCtx.currentTime);

      gain.gain.setValueAtTime(0.04, audioCtx.currentTime);
      gain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + duration);

      osc.connect(gain);
      gain.connect(audioCtx.destination);

      osc.start();
      osc.stop(audioCtx.currentTime + duration);
    } catch (e) {
      // Audio context might fail silently if autoplay blocked
    }
  }

  window.playTickSound = playTickSound;

  function updateSoundUI() {
    document.querySelectorAll('.sound-toggle-btn').forEach(btn => {
      if (soundEnabled) {
        btn.classList.add('is-active');
        btn.setAttribute('title', 'Sound: ON (click to mute)');
        btn.setAttribute('aria-label', 'Sound: ON');
      } else {
        btn.classList.remove('is-active');
        btn.setAttribute('title', 'Sound: OFF (click to enable)');
        btn.setAttribute('aria-label', 'Sound: OFF');
      }
    });
  }

  document.addEventListener('click', function (e) {
    const soundBtn = e.target.closest('.sound-toggle-btn');
    if (soundBtn) {
      soundEnabled = !soundEnabled;
      localStorage.setItem('xps-sound', soundEnabled ? 'on' : 'off');
      updateSoundUI();
      if (soundEnabled) {
        initAudio();
        playTickSound(1400, 'sine', 0.04);
        showToast('Tactile audio enabled');
      } else {
        showToast('Tactile audio muted');
      }
      return;
    }

    // Play subtle tick on interactive elements if audio is enabled
    if (soundEnabled && e.target.closest('button, .btn, .nav-link, .domain-filter-pill, .announcement-btn')) {
      playTickSound(1100, 'sine', 0.015);
    }
  });


  /* ── 2. Toast Notification System ─────────────────────────────────────── */
  let toastContainer = document.querySelector('.toast-container');
  if (!toastContainer) {
    toastContainer = document.createElement('div');
    toastContainer.className = 'toast-container';
    document.body.appendChild(toastContainer);
  }

  function showToast(message, duration = 2600) {
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
      }, 200);
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

  document.addEventListener('click', function (e) {
    const copyTarget = e.target.closest('[data-copy]');
    if (copyTarget) {
      e.preventDefault();
      e.stopPropagation();
      const text = copyTarget.getAttribute('data-copy');
      const label = copyTarget.getAttribute('data-copy-label') || text;
      copyToClipboard(text, `Copied: ${label}`);
      playTickSound(1600, 'sine', 0.03);
    }
  });


  /* ── 3. Theme Switcher (Dark / Light / Matrix) ────────────────────────── */
  function applyTheme(theme) {
    if (theme === 'system') {
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      document.documentElement.setAttribute('data-theme', prefersDark ? 'dark' : 'light');
    } else {
      document.documentElement.setAttribute('data-theme', theme);
    }

    document.querySelectorAll('.theme-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.theme === theme);
    });
  }

  const savedTheme = localStorage.getItem('xps-theme') || 'dark';
  applyTheme(savedTheme);

  document.addEventListener('click', function (e) {
    const themeBtn = e.target.closest('.theme-btn');
    if (themeBtn) {
      const targetTheme = themeBtn.dataset.theme;
      localStorage.setItem('xps-theme', targetTheme);
      applyTheme(targetTheme);
      playTickSound(1300, 'sine', 0.02);
      showToast(`Theme: ${targetTheme.toUpperCase()}`);
    }
  });


  /* ── 4. Mobile Navigation Drawer ──────────────────────────────────────── */
  const hamburger = document.getElementById('nav-hamburger');
  const navLinks = document.getElementById('nav-links');

  if (hamburger && navLinks) {
    hamburger.addEventListener('click', function () {
      const isOpen = navLinks.classList.contains('is-open');
      if (isOpen) {
        navLinks.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
      } else {
        navLinks.classList.add('is-open');
        hamburger.setAttribute('aria-expanded', 'true');
      }
    });

    // Close on navigation click
    navLinks.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
      });
    });
  }


  /* ── 8. Domain Portfolio Live Search & Filter Engine ───────────────────── */
  const domainSearchInput = document.getElementById('domain-search-input');
  const domainFilterPills = document.querySelectorAll('.domain-filter-pill');
  const domainGroups = document.querySelectorAll('.domain-card');
  const domainCounterStatus = document.getElementById('domain-counter-status');

  function filterDomains() {
    if (!domainGroups.length) return;

    const query = domainSearchInput ? domainSearchInput.value.toLowerCase().trim() : '';
    const activeFilter = document.querySelector('.domain-filter-pill.active')?.dataset.category || 'all';

    let totalVisible = 0;
    let totalDomains = 0;

    domainGroups.forEach(group => {
      const categoryKey = group.dataset.category || '';
      const items = group.querySelectorAll('.domain-item-row');
      let groupHasMatch = false;

      // Filter by category
      const categoryMatches = (activeFilter === 'all' || activeFilter === categoryKey);

      items.forEach(item => {
        totalDomains++;
        const domainText = item.querySelector('.domain-item-link')?.textContent.toLowerCase() || '';
        const matchesQuery = !query || domainText.includes(query);

        if (categoryMatches && matchesQuery) {
          item.style.display = 'flex';
          groupHasMatch = true;
          totalVisible++;
        } else {
          item.style.display = 'none';
        }
      });

      group.style.display = groupHasMatch ? 'flex' : 'none';
    });

    if (domainCounterStatus) {
      if (query || activeFilter !== 'all') {
        domainCounterStatus.textContent = `Showing ${totalVisible} of ${totalDomains} domains`;
      } else {
        domainCounterStatus.textContent = `All ${totalDomains} domains indexed & monitored`;
      }
    }
  }

  if (domainSearchInput) {
    domainSearchInput.addEventListener('input', filterDomains);
  }

  domainFilterPills.forEach(pill => {
    pill.addEventListener('click', function () {
      domainFilterPills.forEach(p => p.classList.remove('active'));
      this.classList.add('active');
      filterDomains();
    });
  });


  /* ── 9. Live Status Health Checker & Refresh ──────────────────────────── */
  const statusBadge = document.getElementById('status-badge');
  const statusDot = document.getElementById('status-dot');
  const statusText = document.getElementById('status-text');
  const refreshBtn = document.getElementById('status-refresh-btn');

  function checkStatus() {
    if (refreshBtn) refreshBtn.classList.add('spinning');

    fetch('/api/status')
      .then(res => res.json())
      .then(data => {
        if (refreshBtn) refreshBtn.classList.remove('spinning');
        if (data && data.overall) {
          const isUp = data.overall === 'operational';
          if (statusDot) {
            statusDot.className = `status-dot ${isUp ? 'green' : 'warn'}`;
          }
          if (statusText) {
            statusText.textContent = isUp ? 'Operational' : 'Incident';
          }
        }
      })
      .catch(() => {
        if (refreshBtn) refreshBtn.classList.remove('spinning');
        // Fallback keep existing
      });
  }

  if (refreshBtn) {
    refreshBtn.addEventListener('click', checkStatus);
  }


  /* ── 10. Uptime Bar Tooltips ─────────────────────────────────────────── */
  const tooltip = document.createElement('div');
  tooltip.className = 'uptime-tick-tooltip';
  tooltip.style.display = 'none';
  document.body.appendChild(tooltip);

  document.addEventListener('mouseover', function (e) {
    const tick = e.target.closest('.uptime-bar-tick');
    if (tick) {
      const date = tick.dataset.date || '';
      const uptime = tick.dataset.uptime || '100%';
      const status = tick.dataset.status || 'Operational';

      tooltip.innerHTML = `<strong>${escapeHtml(date)}</strong> &bull; ${escapeHtml(uptime)} &bull; <em>${escapeHtml(status)}</em>`;
      tooltip.style.display = 'block';

      const rect = tick.getBoundingClientRect();
      tooltip.style.left = `${rect.left + window.scrollX - 40}px`;
      tooltip.style.top = `${rect.top + window.scrollY - 36}px`;
    }
  });

  document.addEventListener('mouseout', function (e) {
    if (e.target.closest('.uptime-bar-tick')) {
      tooltip.style.display = 'none';
    }
  });


  /* ── 11. Top Hairline Preload Bar Completion ───────────────────────────── */
  const preloadBar = document.getElementById('preload-bar');
  if (preloadBar) {
    const finishBar = () => {
      preloadBar.style.width = '100%';
      setTimeout(() => {
        preloadBar.classList.add('is-loaded');
        setTimeout(() => {
          if (preloadBar && preloadBar.parentNode) preloadBar.parentNode.removeChild(preloadBar);
        }, 250);
      }, 120);
    };
    if (document.readyState === 'complete') {
      finishBar();
    } else {
      window.addEventListener('load', finishBar, { once: true });
    }
  }


  /* ── 12. Table of Contents (TOC) Active State on "Abschnitte" & "API Specification" ── */
  function initTocActiveState() {
    // 1. Add .active on elements with "Abschnitte" and "API Specification"
    const tocTitles = document.querySelectorAll('.legal-toc-title');
    tocTitles.forEach(title => {
      const text = (title.textContent || '').trim();
      if (/Abschnitte|API Specification/i.test(text)) {
        title.classList.add('active');
        const span = title.querySelector('span');
        if (span) span.classList.add('active');
        const card = title.closest('.legal-toc-card');
        if (card) card.classList.add('active');
      }
    });

    // Also directly match any standalone span or heading labeled Abschnitte or API Specification
    document.querySelectorAll('span, div, h1, h2, h3, h4, nav').forEach(el => {
      if (el.children.length === 0) {
        const txt = el.textContent.trim();
        if (txt === 'Abschnitte' || txt === 'API Specification') {
          el.classList.add('active');
          const parent = el.closest('.legal-toc-title');
          if (parent) parent.classList.add('active');
        }
      }
    });

    // 2. Interactive ScrollSpy for TOC links inside "Abschnitte" and "API Specification"
    const tocNavs = document.querySelectorAll('.legal-toc-card');
    if (!tocNavs.length) return;

    tocNavs.forEach(nav => {
      const links = Array.from(nav.querySelectorAll('.legal-toc-link'));
      if (!links.length) return;

      const sections = [];
      links.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.startsWith('#')) {
          const targetId = href.slice(1);
          const targetEl = document.getElementById(targetId);
          if (targetEl) {
            sections.push({ link, id: targetId, el: targetEl });
          }
        }
      });

      if (!sections.length) return;

      function setActive(activeLink) {
        links.forEach(l => l.classList.remove('active'));
        if (activeLink) {
          activeLink.classList.add('active');
        }
      }

      // Initial active link from URL hash or first section
      let initialLink = null;
      if (window.location.hash) {
        const hashId = window.location.hash.slice(1);
        const match = sections.find(s => s.id === hashId);
        if (match) initialLink = match.link;
      }
      if (!initialLink && sections.length > 0) {
        initialLink = sections[0].link;
      }
      if (initialLink) {
        setActive(initialLink);
      }

      let isClickScrolling = false;
      let clickTimeout = null;

      links.forEach(link => {
        link.addEventListener('click', function () {
          setActive(this);
          isClickScrolling = true;
          if (clickTimeout) clearTimeout(clickTimeout);
          clickTimeout = setTimeout(() => {
            isClickScrolling = false;
          }, 850);
        });
      });

      let scrollRaf = null;
      function onScroll() {
        if (isClickScrolling) return;
        if (scrollRaf) cancelAnimationFrame(scrollRaf);

        scrollRaf = requestAnimationFrame(() => {
          const scrollBottom = window.innerHeight + window.scrollY;
          const pageHeight = document.documentElement.scrollHeight;
          if (pageHeight - scrollBottom < 60) {
            setActive(sections[sections.length - 1].link);
            return;
          }

          const scrollY = window.scrollY;
          const offset = 140;

          let current = sections[0];
          for (let i = 0; i < sections.length; i++) {
            const sec = sections[i];
            const top = sec.el.getBoundingClientRect().top + window.scrollY;
            if (scrollY + offset >= top) {
              current = sec;
            } else {
              break;
            }
          }

          if (current) {
            setActive(current.link);
          }
        });
      }

      window.addEventListener('scroll', onScroll, { passive: true });
      window.addEventListener('hashchange', () => {
        if (window.location.hash) {
          const hashId = window.location.hash.slice(1);
          const match = sections.find(s => s.id === hashId);
          if (match) setActive(match.link);
        }
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTocActiveState);
  } else {
    initTocActiveState();
  }


  /* ── Helper: Escape HTML ─────────────────────────────────────────────── */
  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  // Initialize Sound State
  updateSoundUI();

})();

