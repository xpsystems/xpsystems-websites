# xpsystems — Comprehensive Agency Redesign & Rework Plan

> **Client / Project:** xpsystems (xpsystems.eu / xpsystems.de / ternis.dev ecosystem)  
> **Target Aesthetic:** Leading Global Web Design & Development Agency (Swiss Modernist / High-Craft Brutalist & Tactical Editorial)  
> **Backup Archive:** `.version-05-09-2026/` (completed)  
> **Content Sources:** `.initial/` archives + live application dataset  

---

## 1. Executive Vision & Core Philosophy

The new xpsystems platform is re-architected as if designed by one of the world's most acclaimed digital design agencies (e.g., Pentagram, Locomotive, Studio Freight, Active Theory, Linear, Vercel). 

Rather than relying on generic AI-template tropes (milky glassmorphic cards, floaty hover translations, neon drop-shadows, and gradients), the new design embraces **tactile materiality, authentic architectural grids, razor-sharp typographic hierarchy, and solid, confident color contrast**.

### Strict Design Directives (User Requirements)
1. **NO Gradients:** All surfaces, borders, buttons, and text use bold, intentional solid colors.
2. **NO / Minimal Glassy & Frosty Elements:** No blurry `backdrop-filter` cards or milky containers; solid surfaces, physical rules, and authentic editorial panels (minimal translucent sticky nav is the only exception).
3. **NO Excessive `transform: translateY()` on Hover:** No generic cards floating up 4px. Instead, hover states employ tactile border color shifts, solid contrast inversions, kinetic typography, and glyph transitions.
4. **NO Excessive Shadows on Hover:** No glowing drop-shadows or fuzzy halos. We use crisp hairline borders (1px) or hard-edge architectural offset frames.
5. **NO Emojis (100% Bespoke SVGs):** Every icon, badge, protocol indicator, and status marker is rendered using custom mathematical SVG vector geometry.
6. **Playful, Stunning & Unique:** Real-time domain filter matrix, live telemetry feeds, tactile theme switcher, and optional Web Audio API mechanical tactile clicks.

---

## 2. Master Color & Design System (Zero Gradients)

The site will support three agency-grade themes toggled via a tactile switcher:

### A. Obsidian Onyx (Default Dark)
- **Background (`--bg`):** Deep Carbon Ink `#08090c`
- **Surface Layer 1 (`--bg-surface`):** Dark Vellum `#101217`
- **Surface Layer 2 (`--bg-surface-elevated`):** Solid Slate `#171a22`
- **Hairline Borders (`--border`):** Solid Rule `#20242e`
- **Active / Accent Rules (`--border-active`):** Electric Cobalt `#185aff` or Safety Orange `#ff4f00`
- **Typography Primary (`--text`):** Crisp Bone `#f6f7f9`
- **Typography Secondary (`--text-secondary`):** Cool Chalk `#a4adbb`
- **Typography Muted (`--text-muted`):** Subdued Monospace `#616a79`
- **Primary Accent (`--accent`):** Electric Cobalt `#185aff` (Solid)
- **Secondary Accent (`--signal`):** International Safety Orange `#ff4f00` (Solid)
- **System / Network Green (`--status-up`):** Phosphor Jade `#00d66f` (Solid)

### B. Architectural Vellum (Paper Light)
- **Background (`--bg`):** Warm Architectural Paper `#f6f5f0`
- **Surface Layer 1 (`--bg-surface`):** Crisp Chalk `#ffffff`
- **Surface Layer 2 (`--bg-surface-elevated`):** Warm Stone `#edebe3`
- **Hairline Borders (`--border`):** Editorial Black Rule `#d6d3c7`
- **Active / Accent Rules (`--border-active`):** Solid Ink `#0e0f12`
- **Typography Primary (`--text`):** Deep Dense Ink `#0e0f12`
- **Typography Secondary (`--text-secondary`):** Charcoal `#494e58`
- **Primary Accent (`--accent`):** Deep Royal Cobalt `#0038ff`
- **Secondary Accent (`--signal`):** Safety Vermilion `#e63900`

### C. System Matrix (High-Contrast Cyber Mono)
- **Background (`--bg`):** Pitch Black `#000000`
- **Surface Layer 1 (`--bg-surface`):** Hard Carbon `#0a0a0a`
- **Hairline Borders (`--border`):** 1px Wireframe `#262626`
- **Primary Accent (`--accent`):** Terminal Phosphor Green `#00ff66`
- **Secondary Accent (`--signal`):** Electric Cyan `#00f0ff`

---

## 3. Typography & Micro-Layout System

- **Display & Headings:** `Plus Jakarta Sans` / `Syne` with deliberate letter-spacing (`-0.035em`), tight line heights, and confident editorial weight.
- **Technical & Coordinates:** `JetBrains Mono` for system telemetry, latency readings, region badges (`[DE-FRA]`, `[NL-AMS]`), port metrics, and live timestamps.
- **Grid Structure:** Strict 12-column architectural grid with visible hairline alignment guidelines and technical coordinate labels (`SYS.01`, `NET.POPS`, `DOM.REGISTRY`).

---

## 4. Tactile Hover & Interaction Mechanics

Instead of generic `translateY` lifts and fuzzy drop shadows, interactions will feel mechanical, instant, and high-craft:

1. **Solid Inversion Buttons:** On hover, buttons swap fill and foreground cleanly (e.g., solid black text on bone inverts instantly to solid electric cobalt with white text).
2. **Kinetic Glyphs:** Hovering action links triggers a subtle 45-degree rotation of directional arrow SVGs (`rotate(45deg)`) or bracket reveals (`[ → ]`).
3. **Hairline Flash:** Grid cards outline with an instant 1px solid accent line transition on hover (`border-color: var(--accent)`).
4. **Interactive In-Browser XP-Terminal:** A fully interactive mini-console where visitors can type real commands:
   - `help` — display command manual
   - `ping fra` / `ping ams` — test live simulated node latency
   - `status` — query current system health
   - `domains` — list top managed domains
   - `team` — display engineers
   - `theme` — cycle color themes
   - `clear` — clear console output
5. **Interactive European Edge Radar / PoP Latency Explorer:** Interactive selector for Frankfurt, Falkenstein, Amsterdam, and Helsinki with real-time ping updates, transit carrier details, and server architecture.
6. **Web Audio API Mechanical Sound (Playful & Opt-in):** Subtle synthesizer-generated micro-clicks on navigation and button clicks with a visible mute toggle (`SOUND: ON / OFF`) in the header/footer.

---

## 5. Information Architecture & Page Rework Scope

### 1. Main Landing (`/` & `xpsystems.eu` / `xpsystems.de`)
- **Global Editorial Header:** Monospace clock (CET time in Frankfurt), live system health beacon, sound toggle, theme switcher, responsive drawer navigation.
- **Hero Unit:** Clean typographic declaration: *"European Sovereign Infrastructure & Digital Tooling"*. Sub-entity notice to `ternis.dev`.
- **XP-Terminal / Interactive Node Console:** Dual-mode interactive widget (Terminal vs. European PoP Edge Map).
- **Network Ecosystem & Services:** EuropeHost, eu-data.org, MTEX.dev, DNBX.de, xpsys.eu, ternis-edv presented as tactile architectural service blocks with technical metadata.
- **The Engineering Principles (Manifesto):** 4 numbered foundational principles with bespoke vector diagrams.
- **Live Metric Counter:** Domains, active services, uptime statistics.
- **Tactile Footer:** Comprehensive navigation, legal links, copyright, and system state.

### 2. Live System Status (`/status` & `status.xpsystems.eu`)
- Real-time telemetry dashboard with overall system operational pill.
- Service cards with 90-day history tick-bars, detailed tooltips, and response latency.
- Live Server-Sent Events (SSE) listener for push updates.
- Incident history and status API documentation link.

### 3. Domain Portfolio (`/domains` & `domains.xpsystems.eu`)
- Full catalog of 100+ domains across 7 categories.
- Real-time instant live search filter and category tab buttons (`All`, `Core`, `EuropeHost`, `MTEX`, `Official`, `Other`, `Legacy`).
- Domain count badges, TLD breakdown metrics, and instant copy button with toast notification.

### 4. Open Source Hub (`/opensource` & `opensource.xpsystems.eu`)
- "We Build in the Open" showcase.
- GitHub organization cards for `ternis`, `xpsystems`, and `xpsystems-ai`.
- Live repo directory with language tags, star counters, and direct repo links.
- Interactive stats banner (total stars, forks, public repositories).

### 5. Contact Hub (`/contact` & `contact.xpsystems.eu`)
- Editorial correspondence desk: official email routing (`xpsystems@ternismail.de`, `contact@xpsystems.eu`, `contact@xpsystems.de`).
- Direct founder channel for Fabian Ternis.
- Social networks, instant email copy with toast confirmation, and PGP/security fingerprints.

### 6. API Reference (`/api-docs`)
- Technical REST API documentation with endpoint schemas, curl request samples, and response JSON viewers.

### 7. Legal Pages (`/impressum` & `/privacy`)
- Modern, clean, DDG-compliant German Impressum and GDPR/DSGVO privacy declarations.

---

## 6. Execution Steps & Verification Plan

1. **Safety Backup:** Archived existing application into `.version-05-09-2026/` (Completed).
2. **Master Design System & Tokens (`assets/scss/_tokens.scss`):**
   - Eliminate all gradients, blurry shadows, and glassmorphism.
   - Define solid, tactile agency palettes (Dark, Light, Matrix) and typography scales.
3. **SCSS Core Architecture (`assets/scss/*.scss`):**
   - Re-architect `_base.scss`, `_buttons.scss`, `_nav.scss`, `_hero.scss`, `_sections.scss`, `_status.scss`, `_pages.scss`, `_footer.scss`.
   - Implement solid contrast hover inversions, kinetic typographic glyphs, and rigid hairline grids.
4. **Client-Side JavaScript & Playful Interactions (`assets/js/main.js`):**
   - Interactive retro-modern XP-Terminal with commands.
   - Interactive European Edge PoP explorer.
   - Real-time domain search and filter engine.
   - Web Audio API micro-haptic clicks with mute toggle.
   - Theme switcher (Dark / Light / Matrix).
   - Live Frankfurt CET clock.
5. **View Templates Redesign (`src/Views/*`):**
   - Replace all generic markup and emojis with bespoke SVGs and agency-grade semantic HTML.
   - Implement components: `header`, `footer`, `theme-toggle`, `sound-toggle`, `transition-banner`.
   - Update landing, domains, opensource, contact, status, and legal templates.
6. **Build & Validation:**
   - Compile SCSS via `php build-css.php --force`.
   - Validate PHP syntax on all controllers, router, and view files.
   - Test all routes locally using built-in PHP server.
   - Verify zero gradients, zero blurry card glass, zero emoji usage, and refined hover states.
