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
      const label = btn.querySelector('.sound-label');
      if (soundEnabled) {
        btn.classList.add('is-active');
        if (label) label.textContent = 'SOUND: ON';
      } else {
        btn.classList.remove('is-active');
        if (label) label.textContent = 'SOUND: OFF';
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
    if (soundEnabled && e.target.closest('button, .btn, .nav-link, .shell-tab-btn, .domain-filter-pill, .radar-node-card')) {
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


  /* ── 4. Live CET Clock (Frankfurt / Berlin) ───────────────────────────── */
  function updateClock() {
    const clockEl = document.getElementById('nav-clock-time');
    if (!clockEl) return;

    try {
      const now = new Date();
      const formatter = new Intl.DateTimeFormat('de-DE', {
        timeZone: 'Europe/Berlin',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      });
      clockEl.textContent = formatter.format(now) + ' CET';
    } catch (e) {
      // Fallback
    }
  }
  updateClock();
  setInterval(updateClock, 1000);


  /* ── 5. Mobile Navigation Drawer ──────────────────────────────────────── */
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


  /* ── 6. In-Browser Interactive XP-CLI Terminal ────────────────────────── */
  const terminalInput = document.getElementById('terminal-cli-input');
  const terminalHistory = document.getElementById('terminal-cli-history');

  const COMMANDS = {
    help: () => [
      { text: 'XP-SYSTEMS SOVEREIGN SHELL (v5.4.0)', class: 'accent-line' },
      { text: 'Available commands:', class: 'prompt-line' },
      { text: '  status       — Query live European infrastructure telemetry', class: 'output-line' },
      { text: '  domains      — Inspect active domain portfolio overview', class: 'output-line' },
      { text: '  ping <pop>   — Test edge node latency (fra, fsn, ams, hel)', class: 'output-line' },
      { text: '  dns          — Display authoritative Anycast nameservers', class: 'output-line' },
      { text: '  notice       — Open system transition briefing modal', class: 'output-line' },
      { text: '  team         — Display core leadership & developers', class: 'output-line' },
      { text: '  manifesto    — Print principles of European digital sovereignty', class: 'output-line' },
      { text: '  theme <mode> — Switch color theme (dark, light, matrix)', class: 'output-line' },
      { text: '  sound        — Toggle tactile sound feedback', class: 'output-line' },
      { text: '  clear        — Clear console history', class: 'dim-line' },
    ],
    notice: () => {
      if (window.openTransitionModal) window.openTransitionModal();
      return [
        { text: '[BRIEFING] Opening System Migration Briefing modal...', class: 'success-line' },
        { text: 'xpsystems has transitioned to ternis.dev (ternis-edv).', class: 'output-line' }
      ];
    },
    briefing: () => {
      if (window.openTransitionModal) window.openTransitionModal();
      return [
        { text: '[BRIEFING] Opening System Migration Briefing modal...', class: 'success-line' },
        { text: 'xpsystems has transitioned to ternis.dev (ternis-edv).', class: 'output-line' }
      ];
    },
    status: () => [
      { text: '[LIVE TELEMETRY] All European Nodes Operational', class: 'success-line' },
      { text: '  DE-FRA (Frankfurt)  : 100Gbps DE-CIX — UP (3.8ms)', class: 'output-line' },
      { text: '  DE-FSN (Falkenstein): Bare-Metal Tier IV — UP (6.2ms)', class: 'output-line' },
      { text: '  NL-AMS (Amsterdam)  : AMS-IX Transit — UP (8.9ms)', class: 'output-line' },
      { text: '  FI-HEL (Helsinki)   : Cold Vault Backup — UP (14.1ms)', class: 'output-line' },
      { text: 'Overall Network Health: 100.0% (Zero Active Incidents)', class: 'accent-line' },
    ],
    domains: () => [
      { text: 'PRIMARY NETWORK DOMAINS (~100+ Total Managed):', class: 'accent-line' },
      { text: '  xpsystems.eu / xpsystems.de — Sovereign Core Infrastructure', class: 'output-line' },
      { text: '  ternis.dev / ternis-edv.de   — Parent Entity & Enterprise Systems', class: 'output-line' },
      { text: '  europehost.eu                — European Cloud & Bare-Metal Hosting', class: 'output-line' },
      { text: '  eu-data.org                  — Privacy Sovereignty & GDPR Mail', class: 'output-line' },
      { text: '  mtex.dev / dnbx.de           — Developer Intelligence & Nameservers', class: 'output-line' },
      { text: 'Type "/domains" in your browser or run: curl https://xpsystems.eu/domains', class: 'dim-line' }
    ],
    dns: () => [
      { text: 'AUTHORITATIVE ANYCAST NAMESERVERS (ternis.net):', class: 'accent-line' },
      { text: '  Primary   : one.ns.ternis.net [Anycast European Core]', class: 'output-line' },
      { text: '  Secondary : two.ns.ternis.net [Redundant Edge Node]', class: 'output-line' },
      { text: '  DDoS Shield & DNSSEC: Active / Hardware-Enforced', class: 'success-line' },
    ],
    team: () => [
      { text: 'LEADERSHIP & ENGINEERING:', class: 'accent-line' },
      { text: '  Fabian Ternis  — Founder & Lead / ternis-edv (fabianternis.de)', class: 'output-line' },
      { text: '  Ramsay Brewer  — Systems & Web Developer (dogwaterdev.de)', class: 'output-line' },
    ],
    manifesto: () => [
      { text: 'OUR FOUR ENGINEERING PILLARS:', class: 'accent-line' },
      { text: '  01. Privacy by Default    — Zero cookies, zero third-party telemetry.', class: 'output-line' },
      { text: '  02. Open Source Core      — Transparent code audited on GitHub.', class: 'output-line' },
      { text: '  03. Resilient Bare-Metal  — Independence from US hyperscaler lock-in.', class: 'output-line' },
      { text: '  04. European Sovereignty  — GDPR compliant, registered in Germany.', class: 'output-line' }
    ],
    sound: () => {
      soundEnabled = !soundEnabled;
      localStorage.setItem('xps-sound', soundEnabled ? 'on' : 'off');
      updateSoundUI();
      return [
        { text: `Sound FX toggled: ${soundEnabled ? 'ON' : 'MUTED'}`, class: 'accent-line' }
      ];
    }
  };

  function executeTerminalCommand(cmdRaw) {
    const cmd = cmdRaw.trim();
    if (!cmd) return;

    // Append prompt line
    appendTerminalLine(`$ ${cmd}`, 'prompt-line');

    const parts = cmd.split(' ');
    const root = parts[0].toLowerCase();
    const arg = parts[1] ? parts[1].toLowerCase() : '';

    if (root === 'clear') {
      if (terminalHistory) terminalHistory.innerHTML = '';
      return;
    }

    if (root === 'ping') {
      const validTargets = {
        fra: { city: 'Frankfurt am Main', latency: '3.8ms', peer: 'DE-CIX Core' },
        fsn: { city: 'Falkenstein', latency: '6.2ms', peer: 'Hetzner Tier IV' },
        ams: { city: 'Amsterdam', latency: '8.9ms', peer: 'AMS-IX Transit' },
        hel: { city: 'Helsinki', latency: '14.1ms', peer: 'Cold Vault Edge' },
      };

      const target = validTargets[arg] || validTargets['fra'];
      appendTerminalLine(`PING ${target.city} (${target.peer}): 56 data bytes`, 'output-line');
      setTimeout(() => {
        appendTerminalLine(`64 bytes from ${target.city}: icmp_seq=1 ttl=58 time=${target.latency}`, 'success-line');
        appendTerminalLine(`--- ${target.city} ping statistics: 0% packet loss ---`, 'dim-line');
      }, 100);
      return;
    }

    if (root === 'theme') {
      if (['dark', 'light', 'matrix'].includes(arg)) {
        localStorage.setItem('xps-theme', arg);
        applyTheme(arg);
        appendTerminalLine(`Theme successfully switched to: ${arg.toUpperCase()}`, 'success-line');
      } else {
        appendTerminalLine('Usage: theme <dark|light|matrix>', 'dim-line');
      }
      return;
    }

    if (COMMANDS[root]) {
      const lines = COMMANDS[root]();
      lines.forEach(l => appendTerminalLine(l.text, l.class));
    } else {
      appendTerminalLine(`Command not found: "${cmd}". Type "help" for a list of commands.`, 'dim-line');
    }
  }

  function appendTerminalLine(text, className = 'output-line') {
    if (!terminalHistory) return;
    const div = document.createElement('div');
    div.className = `terminal-line ${className}`;
    div.textContent = text;
    terminalHistory.appendChild(div);

    // Auto-scroll
    const shellTerminal = document.querySelector('.shell-content-terminal');
    if (shellTerminal) {
      shellTerminal.scrollTop = shellTerminal.scrollHeight;
    }
  }

  if (terminalInput) {
    terminalInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        const val = terminalInput.value;
        terminalInput.value = '';
        executeTerminalCommand(val);
        playTickSound(900, 'sine', 0.02);
      }
    });
  }


  /* ── 7. Shell Widget Tabs (Terminal vs European Edge PoP Radar) ────────── */
  const shellTabBtns = document.querySelectorAll('.shell-tab-btn');
  const terminalContent = document.querySelector('.shell-content-terminal');
  const radarContent = document.querySelector('.shell-content-radar');

  shellTabBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      const tab = this.dataset.tab;
      shellTabBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      if (tab === 'terminal') {
        if (terminalContent) terminalContent.style.display = 'flex';
        if (radarContent) radarContent.style.display = 'none';
        if (terminalInput) terminalInput.focus();
      } else if (tab === 'radar') {
        if (terminalContent) terminalContent.style.display = 'none';
        if (radarContent) radarContent.style.display = 'block';
      }
    });
  });

  // Radar Node Selection
  const radarCards = document.querySelectorAll('.radar-node-card');
  radarCards.forEach(card => {
    card.addEventListener('click', function () {
      radarCards.forEach(c => c.classList.remove('is-selected'));
      this.classList.add('is-selected');
      const city = this.querySelector('.node-city')?.textContent || 'Node';
      const latency = this.querySelector('.node-latency-pill')?.textContent || '';
      showToast(`Selected Node: ${city} (${latency.trim()})`);
    });
  });


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


  /* ── Helper: Escape HTML ─────────────────────────────────────────────── */
  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  // Initialize Sound State
  updateSoundUI();

})();
