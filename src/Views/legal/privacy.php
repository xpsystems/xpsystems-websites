<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <script>
  (function(){
    try {
      var s = localStorage.getItem('xps-theme') || 'dark';
      document.documentElement.setAttribute('data-theme', s);
    } catch(e) {}
  })();
  </script>

  <link rel="icon" type="image/svg+xml" href="/assets/img/icon.svg">
  <link rel="alternate icon" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>
<?php $component('transition-banner'); ?>
<?php $component('header'); ?>

<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span>DSGVO / GDPR Konformität &bull; Datenschutz</span>
    </div>

    <h1 class="hero-title">
      Datenschutzerklärung<br>
      <span class="hero-title-accent">&amp; Privatsphäre</span>
    </h1>

    <p class="hero-tagline">
      Transparente Informationen über die Art, den Umfang und die Zwecke der Verarbeitung personenbezogener Daten im xpsystems-Netzwerk &mdash; 100% europäisch gehostet, zero Cookies.
    </p>
  </div>
</header>

<main class="legal-page">
  <div class="container">
    <div class="legal-layout">

      <!-- Sticky Navigation Sidebar -->
      <aside class="legal-sidebar">
        <nav class="legal-toc-card" aria-label="Inhaltsverzeichnis">
          <div class="legal-toc-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="8" y1="6" x2="21" y2="6"/>
              <line x1="8" y1="12" x2="21" y2="12"/>
              <line x1="8" y1="18" x2="21" y2="18"/>
              <line x1="3" y1="6" x2="3.01" y2="6"/>
              <line x1="3" y1="12" x2="3.01" y2="12"/>
              <line x1="3" y1="18" x2="3.01" y2="18"/>
            </svg>
            <span>Abschnitte</span>
          </div>
          <ul class="legal-toc-list">
            <li><a href="#controller" class="legal-toc-link"><span class="toc-num">01</span><span>Verantwortlicher</span></a></li>
            <li><a href="#principles" class="legal-toc-link"><span class="toc-num">02</span><span>Grundsätze &amp; Zero Cookies</span></a></li>
            <li><a href="#server-logs" class="legal-toc-link"><span class="toc-num">03</span><span>Server-Logfiles</span></a></li>
            <li><a href="#contact-data" class="legal-toc-link"><span class="toc-num">04</span><span>Kontaktaufnahme</span></a></li>
            <li><a href="#rights" class="legal-toc-link"><span class="toc-num">05</span><span>Ihre Rechte (DSGVO)</span></a></li>
          </ul>
        </nav>

        <div class="legal-toc-card mono" style="font-size:0.75rem;color:var(--text-muted);display:flex;flex-direction:column;gap:8px;">
          <div><strong>Tracking:</strong> 0% (Keine Tracker)</div>
          <div><strong>Cookies:</strong> Keine Third-Party</div>
          <div><strong>Hosting:</strong> DE/EU Bare-Metal</div>
          <div><strong>Stand:</strong> 2026-09</div>
        </div>
      </aside>

      <!-- Main Privacy Content -->
      <div class="legal-content">

        <!-- 01 Verantwortlicher -->
        <article id="controller" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[01]</span>
            <span>Name und Anschrift des Verantwortlichen</span>
          </h2>
          <div class="legal-prose">
            <p>
              Verantwortlicher im Sinne der Datenschutz-Grundverordnung (DSGVO) und anderer nationaler Datenschutzgesetze ist:<br><br>
              <strong>Fabian Ternis</strong><br>
              ternis-edv / ternis.dev (Ecosystem xpsystems)<br>
              Deutschland<br>
              E-Mail: <a href="mailto:xpsystems@ternismail.de">xpsystems@ternismail.de</a>
            </p>
          </div>
        </article>

        <!-- 02 Grundsätze & Zero Cookies -->
        <article id="principles" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[02]</span>
            <span>Grundsätze der Datenverarbeitung &amp; Zero Tracking</span>
          </h2>
          <div class="legal-prose">
            <p>
              Wir betreiben unsere Webangebote nach dem Grundsatz der Datenminimierung („Privacy by Design“):
            </p>
            <ul>
              <li><strong>Keine Tracking-Cookies:</strong> Wir verwenden weder Google Analytics noch Matomo noch sonstige Webanalyse- oder Werbenetzwerke.</li>
              <li><strong>Kein Werbe-Profiling:</strong> Ihr Besuchsverhalten wird nicht profiliert oder an Dritte weitergegeben.</li>
              <li><strong>Lokaler Speicher:</strong> Lediglich UI-Präferenzen (wie das gewählte Farbdesign und Toneinstellungen) werden lokal im Browser (LocalStorage) gespeichert.</li>
            </ul>
          </div>
        </article>

        <!-- 03 Server-Logfiles -->
        <article id="server-logs" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[03]</span>
            <span>Erfassung von Server-Logfiles</span>
          </h2>
          <div class="legal-prose">
            <p>
              Bei jedem Zugriff auf unsere Server werden aus technischen Gründen temporäre Verbindungsdaten (Server-Logfiles) erhoben:
            </p>
            <ul>
              <li>Browsertyp und Browserversion</li>
              <li>Verwendetes Betriebssystem</li>
              <li>Referrer URL (zuvor besuchte Seite)</li>
              <li>Hostname des zugreifenden Rechners / IP-Adresse</li>
              <li>Uhrzeit der Serveranfrage</li>
              <li>HTTP-Statuscode und übertragene Datenmenge</li>
            </ul>
            <p>
              Die Speicherung erfolgt auf Grundlage unseres berechtigten Interesses gemäß Art. 6 Abs. 1 lit. f DSGVO zur Gewährleistung der Netzsicherheit und Abwehr von DDoS-Angriffen. Die Daten werden routinemäßig gelöscht.
            </p>
          </div>
        </article>

        <!-- 04 Kontaktaufnahme -->
        <article id="contact-data" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[04]</span>
            <span>Kontaktaufnahme per E-Mail</span>
          </h2>
          <div class="legal-prose">
            <p>
              Wenn Sie uns per E-Mail kontaktieren, werden die von Ihnen übermittelten Daten (z. B. Name, E-Mail-Adresse und Inhalt Ihrer Nachricht) zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen bei uns gespeichert. Rechtsgrundlage hierfür ist Art. 6 Abs. 1 lit. b bzw. lit. f DSGVO.
            </p>
          </div>
        </article>

        <!-- 05 Rechte der betroffenen Person -->
        <article id="rights" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[05]</span>
            <span>Ihre Rechte gemäß DSGVO</span>
          </h2>
          <div class="legal-prose">
            <p>Sie haben jederzeit das Recht:</p>
            <ul>
              <li>gemäß Art. 15 DSGVO Auskunft über Ihre von uns verarbeiteten personenbezogenen Daten zu verlangen;</li>
              <li>gemäß Art. 16 DSGVO unverzüglich die Berichtigung unrichtiger oder Vervollständigung Ihrer bei uns gespeicherten Daten zu verlangen;</li>
              <li>gemäß Art. 17 DSGVO die Löschung Ihrer bei uns gespeicherten Daten zu verlangen;</li>
              <li>gemäß Art. 18 DSGVO die Einschränkung der Datenverarbeitung zu verlangen;</li>
              <li>gemäß Art. 77 DSGVO sich bei einer Datenschutz-Aufsichtsbehörde zu beschweren.</li>
            </ul>
          </div>
        </article>

      </div>
    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
