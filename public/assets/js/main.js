/**
 * xpsystems — Interactive Client Script
 * Simple, flat UI architecture for the platform rework & ecosystem transition.
 * Features:
 *   1. Web Audio API Tactile Mechanical Sound Synthesizer + Volume Slider Dropdown
 *   2. Toast Notification & Clipboard Copy System
 *   3. Theme Switcher (Dark / Light / Matrix)
 *   4. Mobile Navigation Drawer Controller
 *   5. Live Infrastructure Status Telemetry & Reactive --status-color Manager
 *   6. Top Announcement Bar & Transition Briefing Modal Controller
 *   7. Top Hairline Preload Progress Bar Completion
 *   8. Section / TOC Active State Controller ("Abschnitte" & "API Specification")
 */

(function () {
  'use strict';

  /* ── 1. Web Audio API Tactile Mechanical Sound Synthesizer ─────────────── */
  let audioCtx = null;
  let soundEnabled = localStorage.getItem('xps-sound') === 'on';
  let soundVolume = parseFloat(localStorage.getItem('xps-sound-volume') ?? '70');
  if (isNaN(soundVolume) || soundVolume < 0 || soundVolume > 100) {
    soundVolume = 70;
  }

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
    if (!soundEnabled || soundVolume <= 0) return;
    try {
      initAudio();
      if (!audioCtx) return;

      const osc = audioCtx.createOscillator();
      const gain = audioCtx.createGain();

      osc.type = type;
      osc.frequency.setValueAtTime(freq, audioCtx.currentTime);

      const peakGain = 0.05 * (soundVolume / 100);
      gain.gain.setValueAtTime(peakGain, audioCtx.currentTime);
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
    const slider = document.getElementById('sound-volume-slider');
    const valueDisplay = document.getElementById('sound-volume-value');
    if (slider) {
      slider.value = soundEnabled ? soundVolume : 0;
    }
    if (valueDisplay) {
      valueDisplay.textContent = soundEnabled ? `${Math.round(soundVolume)}%` : '0% (Muted)';
    }

    document.querySelectorAll('.sound-toggle-btn').forEach(btn => {
      if (soundEnabled && soundVolume > 0) {
        btn.classList.add('is-active');
        btn.setAttribute('title', `Sound: ON (${Math.round(soundVolume)}%) — hover to adjust volume`);
        btn.setAttribute('aria-label', `Sound: ON (${Math.round(soundVolume)}%)`);
      } else {
        btn.classList.remove('is-active');
        btn.setAttribute('title', 'Sound: OFF — hover to adjust volume');
        btn.setAttribute('aria-label', 'Sound: OFF');
      }
    });
  }

  function initVolumeSlider() {
    const slider = document.getElementById('sound-volume-slider');
    const valueDisplay = document.getElementById('sound-volume-value');
    if (!slider) return;

    slider.value = soundEnabled ? soundVolume : 0;
    if (valueDisplay) {
      valueDisplay.textContent = soundEnabled ? `${Math.round(soundVolume)}%` : '0% (Muted)';
    }

    slider.addEventListener('input', function () {
      soundVolume = parseFloat(this.value);
      localStorage.setItem('xps-sound-volume', soundVolume);

      if (soundVolume === 0) {
        soundEnabled = false;
        localStorage.setItem('xps-sound', 'off');
      } else {
        soundEnabled = true;
        localStorage.setItem('xps-sound', 'on');
      }
      updateSoundUI();
    });

    slider.addEventListener('change', function () {
      if (soundEnabled && soundVolume > 0) {
        initAudio();
        playTickSound(1300, 'sine', 0.03);
      }
    });
  }

  document.addEventListener('click', function (e) {
    const soundBtn = e.target.closest('.sound-toggle-btn');
    if (soundBtn) {
      soundEnabled = !soundEnabled;
      localStorage.setItem('xps-sound', soundEnabled ? 'on' : 'off');
      if (soundEnabled && soundVolume === 0) {
        soundVolume = 70;
        localStorage.setItem('xps-sound-volume', soundVolume);
      }
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
    if (soundEnabled && e.target.closest('button, .btn, .nav-link, .rework-card, .footer-rework-link, .announcement-btn')) {
      playTickSound(1100, 'sine', 0.015);
    }
  });


  /* ── 2. Toast Notification System & Clipboard Helper ───────────────────── */
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

    // Close on navigation link click
    navLinks.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
      });
    });
  }


  /* ── 5. Live Infrastructure Status Telemetry & --status-color Reactive Controller ── */
  const statusBadge = document.getElementById('status-badge');
  const statusDot = document.getElementById('status-dot');
  const statusText = document.getElementById('status-text');

  function applyStatusBadgeState(rawStatus) {
    if (!statusBadge) return;
    const s = (rawStatus || 'operational').toLowerCase();

    let colorVar = 'var(--status-up)';
    let label = 'Operational';

    if (s === 'operational' || s === 'up') {
      colorVar = 'var(--status-up)';
      label = 'Operational';
    } else if (s === 'degraded' || s === 'warn' || s === 'partial_outage') {
      colorVar = 'var(--status-warn)';
      label = 'Degraded';
    } else if (s === 'major_outage' || s === 'outage' || s === 'down' || s === 'incident') {
      colorVar = 'var(--status-down)';
      label = 'Incident';
    } else if (s === 'maintenance') {
      colorVar = 'var(--cyan)';
      label = 'Maintenance';
    }

    // Update --status-color CSS variable directly on #status-badge
    statusBadge.style.setProperty('--status-color', colorVar);
    statusBadge.setAttribute('data-status', s);

    if (statusText) {
      statusText.textContent = label;
    }

    if (statusDot) {
      statusDot.style.backgroundColor = colorVar;
    }

    const statusPing = statusBadge.querySelector('.status-ping');
    if (statusPing) {
      statusPing.style.backgroundColor = colorVar;
    }
  }

  function checkStatus() {
    fetch('/api/status')
      .then(res => res.json())
      .then(data => {
        if (data && data.overall) {
          applyStatusBadgeState(data.overall);
        }
      })
      .catch(() => {
        // Status fetch failure handled gracefully without UI disturbance
      });
  }

  // Initial status check & periodic refresh
  checkStatus();
  setInterval(checkStatus, 60000);


  /* ── 6. Top Announcement Bar & Transition Briefing Modal ──────────────── */
  const STORAGE_DISMISSED_KEY = 'xps_announcement_dismissed_v5';
  const STORAGE_MODAL_KEY = 'xps_transition_modal_seen_v5';

  const topbar = document.getElementById('announcement-topbar');
  const modal = document.getElementById('transition-modal');
  const dismissBtn = document.getElementById('btn-dismiss-topbar');

  // Check topbar dismissal preference immediately
  try {
    if (localStorage.getItem(STORAGE_DISMISSED_KEY) === '1' && topbar) {
      topbar.classList.add('is-dismissed');
    }
  } catch (e) {}

  if (dismissBtn && topbar) {
    dismissBtn.addEventListener('click', function () {
      topbar.classList.add('is-dismissed');
      try {
        localStorage.setItem(STORAGE_DISMISSED_KEY, '1');
      } catch (e) {}
      playTickSound(1000, 'sine', 0.02);
    });
  }

  window.openTransitionModal = function () {
    if (!modal) return;
    modal.style.display = 'flex';
    requestAnimationFrame(() => {
      modal.classList.add('is-active');
    });
    document.body.style.overflow = 'hidden';
    playTickSound(1400, 'sine', 0.03);
  };

  window.closeTransitionModal = function () {
    if (!modal) return;
    modal.classList.remove('is-active');
    setTimeout(() => {
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }, 200);
    try {
      localStorage.setItem(STORAGE_MODAL_KEY, '1');
    } catch (e) {}
    playTickSound(1100, 'sine', 0.02);
  };

  if (modal) {
    modal.addEventListener('click', function (e) {
      if (e.target === modal) {
        window.closeTransitionModal();
      }
    });
  }

  window.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modal && modal.classList.contains('is-active')) {
      window.closeTransitionModal();
    }
  });

  // First-load trigger: if modal has never been seen on this device, display it gently
  try {
    if (!localStorage.getItem(STORAGE_MODAL_KEY)) {
      setTimeout(() => {
        window.openTransitionModal();
      }, 500);
    }
  } catch (e) {}


  /* ── 7. Top Hairline Preload Progress Bar Completion ───────────────────── */
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


  /* ── 8. Section / TOC Active State Controller ("Abschnitte" & "API Specification") ── */
  function initTocActiveState() {
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

    // Also match standalone heading or label text
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

  // Initialize Sound State & Volume Control
  initVolumeSlider();
  updateSoundUI();

})();

