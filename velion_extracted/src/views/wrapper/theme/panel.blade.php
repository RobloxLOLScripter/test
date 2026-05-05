{{-- Velion - Complete Pterodactyl UI override (Hexado-style) --}}
<style id="velion-panel-theme">

  /* ================================================================
     GLOBAL
     ================================================================ */
  *, *::before, *::after {
    font-family: var(--font) !important;
  }

  body, html {
    background-color: var(--dashboardBackground) !important;
    color: var(--dashboardText) !important;
  }

  a { color: var(--dashboardAccent); text-decoration: none; }
  a:hover { color: var(--dashboardAccent); opacity: 0.85; }

  /* ================================================================
     HIDE ALL DEFAULT PTERODACTYL NAVIGATION
     ================================================================ */

  /* Top navigation bar - all possible selectors */
  div[class*="NavigationBar"],
  nav[class*="NavigationBar"],
  div[class*="navigation-bar"],
  div[class*="NavBar__"],
  div[class*="navBar"],
  div[class*="NavigationBar__"],
  div[class*="css-"][role="navigation"],
  #navigation,
  header > nav,
  nav.bg-neutral-900,
  nav.bg-neutral-800,
  div > nav[class],
  .navigation-bar {
    display: none !important;
  }

  /* Sub-navigation (Console, Files, Databases tabs) */
  div[class*="SubNavigation"],
  div[class*="sub-navigation"],
  div[class*="ServerNavigation"],
  div[class*="SubNav__"],
  div[class*="subNavigation"],
  div[class*="SubNavigationLink"],
  div[class*="FlashMessage"] + div[class*="css-"],
  div.SubNavigation___StyledDiv-sc-1s8o6zv-0,
  div[class*="server-navigation"] {
    display: none !important;
  }

  /* Account sub-navigation */
  div[class*="AccountNavigation"],
  div[class*="AccountContainer"] > div:first-child > div:first-child {
    display: none !important;
  }

  /* Progress bar position fix */
  div.ProgressBar___StyledDiv-sc-14ayc3f-1,
  div[class*="ProgressBar"] {
    @if($n_sidebar_full == "1")
      left: 200px !important;
      width: calc(100% - 200px) !important;
    @else
      left: 75px !important;
      width: calc(100% - 75px) !important;
    @endif
  }

  /* ================================================================
     LAYOUT - Body padding for sidebar
     ================================================================ */
  @if(Auth::check())
    body, body.bg-neutral-800 {
      @if($n_sidebar_full == "1")
        padding-left: 200px;
      @else
        padding-left: 75px;
      @endif
      color: var(--dashboardText);
      background-color: var(--dashboardBackground);
    }

    /* Main app container */
    div[id="app"] {
      padding-top: 0 !important;
      min-height: 100vh;
    }
  @endif

  @media (max-width: 768px) {
    body, body.bg-neutral-800 {
      padding-left: 0 !important;
      padding-top: 52px;
    }
  }

  /* ================================================================
     CONTENT CONTAINERS
     ================================================================ */
  div[class*="ContentContainer"],
  div[class*="content-wrapper"],
  .ContentContainer___StyledDiv-sc-1eurbtl-0 {
    background-color: transparent !important;
    max-width: unset !important;
    padding: 20px 28px !important;
  }

  /* Page titles */
  h1[class*="header"], h1.header___StyledH-sc-1i85nw6-0,
  h1 {
    color: var(--dashboardText) !important;
    font-weight: 700 !important;
  }

  /* ================================================================
     CARDS & BOXES (Hexado-style)
     ================================================================ */
  div[class*="TitledGreyBox"],
  div[class*="grey-box"],
  div[class*="GreyRowBox"],
  div[class*="ContentBox"],
  div[class*="TitledGreyBox___StyledDiv"],
  div[class*="GreyBox"] {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    border-radius: var(--borderRadius) !important;
    color: var(--dashboardText) !important;
  }

  /* Card headers */
  div[class*="TitledGreyBox"] > div:first-child,
  div[class*="light:border-t"] {
    border-color: var(--dashboardSecondary) !important;
  }

  /* ================================================================
     SERVER LIST (Dashboard)
     ================================================================ */
  a[class*="ServerRow"],
  a[class*="server-row"] {
    text-decoration: none !important;
  }

  a[class*="ServerRow"] > div,
  div[class*="server-card"] {
    background-color: var(--dashboardPrimary) !important;
    border-radius: var(--borderRadius) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    transition: all 0.2s ease !important;
    margin-bottom: 10px !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15) !important;
  }
  a[class*="ServerRow"]:hover > div,
  div[class*="server-card"]:hover {
    border-color: var(--dashboardAccent) !important;
    box-shadow: var(--orangeGlow) !important;
    transform: translateY(-2px) !important;
  }
  a[class*="ServerRow"]:focus > div,
  a[class*="ServerRow"]:focus-within > div {
    border-color: var(--dashboardAccent) !important;
    box-shadow: 0 0 0 2px rgba(255, 122, 0, 0.2) !important;
  }

  /* Server status badge */
  span[class*="StatusIndicatorBox"],
  span[class*="status"] {
    border-radius: 6px !important;
    font-weight: 600 !important;
    font-size: 12px !important;
  }

  /* ================================================================
     STATUS COLORS
     ================================================================ */
  @if($n_statusgradient_style == "default")
  a[class*="ServerRow"] > div {
    border-left: 3px solid transparent !important;
  }
  @endif

  /* ================================================================
     BUTTONS
     ================================================================ */
  button, .btn,
  button[class*="Button"],
  a[class*="Button"] {
    border-radius: var(--borderRadius) !important;
    font-weight: 500 !important;
    transition: all 0.15s ease !important;
  }

  /* Primary/green button styling */
  button[class*="green"],
  button.bg-green-500,
  button.bg-green-600,
  button[class*="primary"],
  button.bg-blue-600,
  button.bg-primary-600 {
    background: var(--dashboardAccentGradient) !important;
    border: none !important;
    color: white !important;
    box-shadow: 0 4px 14px rgba(255, 122, 0, 0.3) !important;
  }
  button[class*="green"]:hover,
  button.bg-green-500:hover,
  button.bg-green-600:hover,
  button[class*="primary"]:hover,
  button.bg-blue-600:hover,
  button.bg-primary-600:hover {
    box-shadow: 0 6px 20px rgba(255, 122, 0, 0.5) !important;
    transform: translateY(-1px);
    opacity: 1 !important;
  }

  /* ================================================================
     FORMS & INPUTS
     ================================================================ */
  input, textarea, select,
  input[class*="Input"],
  div[class*="Input"],
  input[type="text"],
  input[type="password"],
  input[type="email"],
  input[type="number"],
  input[type="search"] {
    background-color: var(--dashboardSecondary) !important;
    border: 1px solid var(--dashboardTertiary) !important;
    border-radius: var(--borderRadius) !important;
    color: var(--dashboardText) !important;
    font-family: var(--font) !important;
    transition: border-color 0.2s ease;
  }
  input:focus, textarea:focus, select:focus {
    border-color: var(--dashboardAccent) !important;
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.15) !important;
  }

  /* ================================================================
     CONSOLE
     ================================================================ */
  div[class*="terminal"],
  div[class*="Console"],
  div[class*="console-container"],
  div.Console___StyledDiv-sc-bkudft-0 {
    border-radius: var(--borderRadius) !important;
    background-color: #0f1419 !important;
    border: 1px solid var(--dashboardSecondary) !important;
  }

  /* Console command input */
  div[class*="CommandInput"],
  input[class*="command-input"] {
    background-color: #0f1419 !important;
    border-radius: 0 0 var(--borderRadius) var(--borderRadius) !important;
    border-top: 1px solid var(--dashboardSecondary) !important;
    color: #e2e8f0 !important;
  }

  /* Power buttons */
  button[class*="PowerAction"],
  div[class*="power-buttons"] button {
    border-radius: var(--borderRadius) !important;
    font-weight: 600 !important;
    padding: 8px 18px !important;
  }

  /* ================================================================
     STAT BOXES (Server info cards)
     ================================================================ */
  div[class*="StatBlock"],
  div[class*="stat-block"],
  div[class*="ServerDetailsBlock"],
  div[class*="server-details"] > div {
    background-color: var(--dashboardPrimary) !important;
    border-radius: var(--borderRadius) !important;
    border: 1px solid var(--dashboardSecondary) !important;
  }

  /* ================================================================
     TABLES
     ================================================================ */
  table {
    color: var(--dashboardText) !important;
  }
  tr {
    border-color: var(--dashboardSecondary) !important;
  }
  td, th {
    color: var(--dashboardText) !important;
    border-color: var(--dashboardSecondary) !important;
  }

  /* ================================================================
     DROPDOWNS & MODALS
     ================================================================ */
  div[class*="DropdownMenu"],
  div[class*="dropdown-menu"] {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    border-radius: var(--borderRadius) !important;
    box-shadow: 0 12px 40px rgba(0,0,0,0.3) !important;
  }

  div[class*="Modal"],
  div[class*="modal-content"],
  div[class*="ModalContent"] {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    border-radius: var(--borderRadius) !important;
    color: var(--dashboardText) !important;
  }

  /* Modal overlay */
  div[class*="ModalMask"],
  div[class*="modal-mask"] {
    background-color: rgba(0, 0, 0, 0.6) !important;
    backdrop-filter: blur(4px) !important;
  }

  /* ================================================================
     TAILWIND OVERRIDES
     ================================================================ */
  .bg-neutral-900, .bg-neutral-800, .bg-neutral-700, .bg-gray-900, .bg-gray-800, .bg-zinc-900, .bg-zinc-800, .bg-slate-900, .bg-slate-800,
  div[class*="bg-neutral-900"], div[class*="bg-gray-900"], div[class*="bg-zinc-900"] {
    background-color: var(--dashboardBackground) !important;
  }
  .bg-neutral-600, .bg-gray-700, .bg-gray-600, .bg-zinc-700, .bg-slate-700,
  div[class*="bg-neutral-800"], div[class*="bg-gray-800"], div[class*="bg-zinc-800"],
  div[class*="bg-neutral-700"], div[class*="bg-gray-700"], div[class*="bg-zinc-700"] {
    background-color: var(--dashboardPrimary) !important;
  }
  .text-gray-200, .text-gray-300, .text-neutral-200, .text-neutral-300 {
    color: var(--dashboardText) !important;
  }
  .border-gray-700, .border-neutral-700, .border-gray-800, .border-neutral-800, .border-zinc-700, .border-zinc-800 {
    border-color: var(--dashboardSecondary) !important;
  }

  /* Specific Grey Fixes (Startup, Server List, etc) */
  div[class*="StartupContainer"] div[class*="rounded"],
  div[class*="StartupContainer"] div[class*="bg-neutral"],
  div[class*="ServerRow"] > div {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
  }

  /* Input fields in Startup */
  div[class*="StartupContainer"] input,
  div[class*="StartupContainer"] select {
    background-color: var(--dashboardSecondary) !important;
  }

  /* ================================================================
     FLASH MESSAGES
     ================================================================ */
  div[class*="FlashMessage"],
  div[class*="flash-message"] {
    border-radius: var(--borderRadius) !important;
  }

  /* ================================================================
     SCROLLBAR STYLING
     ================================================================ */
  ::-webkit-scrollbar {
    width: 6px;
    height: 6px;
  }
  ::-webkit-scrollbar-track {
    background: transparent;
  }
  ::-webkit-scrollbar-thumb {
    background: var(--dashboardTertiary);
    border-radius: 3px;
  }
  ::-webkit-scrollbar-thumb:hover {
    background: var(--dashboardAccent);
  }

  /* ================================================================
     TRANSPARENCY MODE
     ================================================================ */
  @if($n_dashboard_transparency == "1")
  div[class*="TitledGreyBox"],
  div[class*="ContentBox"] {
    background-color: color-mix(in srgb, var(--dashboardPrimary) 85%, transparent) !important;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
  }
  @endif

  /* ================================================================
     GRAPHS
     ================================================================ */
  @if($n_server_overview_graphs == "0")
  div[class*="ChartContainer"],
  div[class*="chart-container"] {
    display: none !important;
  }
  @endif

  /* ================================================================
     BACKGROUND
     ================================================================ */
  .fixed-background {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -1;
    background-color: var(--dashboardBackground);
    @if($n_background_image != "")
    background-image: url('{{ $n_background_image }}');
    background-size: cover;
    background-position: center;
    @if($n_background_appearance == "1") filter: brightness(0.7); @endif
    @if($n_background_appearance == "2") filter: blur(6px); @endif
    @endif
  }

  .fixed-pattern-background {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -1;
    background-color: var(--dashboardBackground);
  }

  /* Custom sidebar logo */
  @if($n_sidebar_customlogo != "")
  #sidebarHome i { display: none; }
  #sidebarHome {
    background-image: url('{{ $n_sidebar_customlogo }}');
    background-size: 28px;
    background-repeat: no-repeat;
    background-position: center;
  }
  @endif

  /* ================================================================
     HIDE PANEL TITLE (Velion.eu text at top)
     ================================================================ */
  div[class*="PageContentBlock"] > h1:first-child,
  div[class*="ContentContainer"] > h1:first-child,
  p[class*="header___StyledP"],
  p.text-center.text-neutral-500,
  p.header___StyledP-sc-1i85nw6-1,
  div[class*="PageContentBlock"] > p:first-of-type {
    display: none !important;
  }

  /* Hide "SHOWING YOUR SERVERS" toggle - nuclear approach */
  div[class*="ServerListToggle"],
  label[class*="switch"],
  div > label > span[class*="text-neutral-500"],
  div.flex.items-center.justify-between > div:last-child,
  div[class*="dashboard-header"],
  div > p[class*="uppercase"],
  p.uppercase,
  span.uppercase,
  div[class*="Toggle___StyledDiv"],
  div[class*="ServerRow___StyledDiv"] + div,
  div[class*="ContentContainer"] > div:first-child > div.flex {
    display: none !important;
  }

  /* Hide Pterodactyl footer */
  p[class*="text-center"][class*="text-neutral"],
  p[class*="text-center"][class*="text-xs"],
  footer,
  div[class*="footer"],
  p.text-center.text-xs,
  p.text-center {
    display: none !important;
  }

  /* ================================================================
     CONSOLE FIX - text wrapping
     ================================================================ */
  div[class*="terminal"] *,
  div[class*="Console"] *,
  div[class*="console"] * {
    font-family: 'JetBrains Mono', 'Fira Code', 'Cascadia Code', 'Source Code Pro', 'Courier New', monospace !important;
  }

  div[class*="terminal"],
  div[class*="Console"],
  div[class*="console-container"],
  div.Console___StyledDiv-sc-bkudft-0 {
    overflow: hidden !important;
    word-break: break-all !important;
  }

  div[class*="terminal"] > div,
  div[class*="Console"] > div {
    word-break: break-all !important;
    white-space: pre-wrap !important;
    overflow-wrap: break-word !important;
    overflow-x: hidden !important;
  }

  /* Console scrollbar */
  div[class*="Console"] > div::-webkit-scrollbar,
  div[class*="terminal"] > div::-webkit-scrollbar {
    width: 4px;
  }

  /* ================================================================
     GREY FIX - Targeted approach (not nuclear)
     ================================================================ */

  /* Cards and boxes */
  div[class*="TitledGreyBox"],
  div[class*="grey-box"],
  div[class*="GreyRowBox"],
  div[class*="ContentBox"],
  div[class*="TitledGreyBox___StyledDiv"],
  div[class*="GreyBox"] {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    border-radius: var(--borderRadius) !important;
  }

  /* Tailwind background classes */
  .bg-neutral-800, .bg-neutral-900, .bg-neutral-700,
  .bg-gray-700, .bg-gray-800, .bg-gray-900,
  .bg-zinc-800, .bg-zinc-900, .bg-slate-800, .bg-slate-900,
  .bg-neutral-600, .bg-gray-600 {
    background-color: var(--dashboardBackground) !important;
  }

  /* Grey backgrounds from styled-components are fixed via JS in script.blade.php */

  /* ================================================================
     GRAPH CONTAINERS - force dark
     ================================================================ */
  div[class*="Chart"],
  div[class*="chart"],
  div[class*="Graph"],
  div[class*="graph"],
  div[class*="StatGraph"],
  div[class*="ChartContainer"],
  div[class*="chart-container"] {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    border-radius: var(--borderRadius) !important;
  }

  /* Canvas parent containers */
  canvas {
    border-radius: var(--borderRadius) !important;
  }

  /* Any div that contains a canvas (graph container) */
  div:has(> canvas) {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    border-radius: var(--borderRadius) !important;
    padding: 12px !important;
  }

  /* Graph title text */
  div:has(> canvas) p,
  div:has(> canvas) span,
  div:has(> canvas) h3 {
    color: var(--dashboardText) !important;
  }

  /* ================================================================
     SERVER LIST CARDS - dark styling (keep inner content visible)
     ================================================================ */
  a[class*="ServerRow"] > div {
    background-color: var(--dashboardPrimary) !important;
  }
  a[class*="ServerRow"] p,
  a[class*="ServerRow"] span {
    color: var(--dashboardText) !important;
  }
  a[class*="ServerRow"] p[class*="text-neutral-400"],
  a[class*="ServerRow"] span[class*="text-neutral-400"],
  a[class*="ServerRow"] p[class*="text-neutral-500"],
  a[class*="ServerRow"] span[class*="text-neutral-500"] {
    color: var(--sidebarTextSecondary) !important;
  }

  /* ================================================================
     SERVER INFO CARDS (right side stat boxes)
     ================================================================ */
  div[class*="StatBlock"],
  div[class*="stat-block"],
  div[class*="ServerDetailsBlock"],
  div[class*="server-details"] > div,
  div[class*="StatGraphContainer"],
  div[class*="stat-graph"] {
    background-color: var(--dashboardPrimary) !important;
    border-radius: var(--borderRadius) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    padding: 16px !important;
  }

  /* Server info card icons */
  div[class*="StatBlock"] svg,
  div[class*="stat-block"] svg,
  div[class*="ServerDetailsBlock"] svg {
    color: var(--dashboardAccent) !important;
  }

  /* Status icon containers */
  div[class*="StatusIndicator"],
  div[class*="icon-container"] {
    background-color: var(--dashboardSecondary) !important;
    border-radius: 10px !important;
  }

  /* ================================================================
     TEXT COLOR FIX
     ================================================================ */
  .text-neutral-400, .text-gray-400,
  .text-neutral-500, .text-gray-500 {
    color: var(--sidebarTextSecondary) !important;
  }
  .text-neutral-100, .text-neutral-200, .text-neutral-300,
  .text-gray-100, .text-gray-200, .text-gray-300,
  .text-white {
    color: var(--dashboardText) !important;
  }
  label, legend {
    color: var(--dashboardText) !important;
  }
  p {
    color: var(--dashboardText);
  }

  /* Dividers/borders */
  hr, .divider,
  div[class*="divider"],
  .border-neutral-700, .border-neutral-600, .border-neutral-800,
  .border-gray-600, .border-gray-700 {
    border-color: var(--dashboardSecondary) !important;
  }

  /* Toggle switches */
  div[class*="Toggle"],
  div[class*="switch"],
  label[class*="toggle"] {
    border-color: var(--dashboardSecondary) !important;
  }

  /* ================================================================
     MISC POLISH
     ================================================================ */
  /* Pagination */
  div[class*="Pagination"] a,
  div[class*="pagination"] a {
    border-radius: 8px !important;
  }

  /* Tooltips */
  div[class*="Tooltip"],
  div[role="tooltip"] {
    background-color: var(--dashboardPrimary) !important;
    border: 1px solid var(--dashboardSecondary) !important;
    border-radius: 8px !important;
    color: var(--dashboardText) !important;
  }

  /* Code blocks */
  code, pre {
    background-color: var(--dashboardSecondary) !important;
    border-radius: 6px !important;
    color: var(--dashboardAccent) !important;
  }

  /* Selection highlight */
  ::selection {
    background-color: rgba(255, 122, 0, 0.3);
    color: #fff;
  }

  /* Links */
  a {
    color: var(--dashboardAccent);
  }
  a:hover {
    color: #fb923c;
  }


  /* Red/danger buttons */
  button[class*="red"],
  button.bg-red-500,
  button.bg-red-600 {
    background: linear-gradient(135deg, #ef4444, #dc2626) !important;
    border: none !important;
    color: #fff !important;
  }

  /* Secondary/gray buttons */
  button.bg-neutral-600,
  button.bg-gray-600 {
    background-color: var(--dashboardSecondary) !important;
    border: 1px solid var(--dashboardTertiary) !important;
    color: var(--dashboardText) !important;
  }

  /* ================================================================
     SIDEBAR OVERRIDES (must be last to override wrapper base CSS)
     ================================================================ */
  .sidebar {
    width: 200px !important;
    position: fixed !important;
    left: 0 !important;
    top: 0 !important;
    height: 100% !important;
    background-color: var(--sidebarBackground) !important;
    z-index: 5 !important;
    border-radius: 0 !important;
    border-right: 1px solid var(--sidebarSecondary) !important;
    overflow: visible !important;
  }

  .sidebarContentContainer {
    width: 100% !important;
    margin: 0 !important;
    overflow: visible !important;
  }

  .sidebarContent {
    padding-top: 10px !important;
    padding-bottom: 70px !important;
    height: 100vh !important;
    overflow-y: auto !important;
    overflow-x: visible !important;
  }

  .sidebarContent::-webkit-scrollbar { display: none; }
  .sidebarContent { scrollbar-width: none; }

  .sidebarButton {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 10px 14px !important;
    margin: 2px 8px !important;
    border-radius: 10px !important;
    cursor: pointer !important;
    border: none !important;
    border-left: none !important;
    width: auto !important;
    height: auto !important;
    background-color: transparent !important;
    position: static !important;
    left: 0 !important;
    overflow: visible !important;
    color: var(--sidebarTextSecondary) !important;
    transition: background-color 0.15s, color 0.15s !important;
  }
  .sidebarButton:hover {
    background-color: var(--sidebarSecondary) !important;
    color: var(--sidebarText) !important;
    position: static !important;
    left: 0 !important;
    padding-top: 10px !important;
    padding-bottom: 10px !important;
    box-shadow: inset 0 0 10px rgba(255, 122, 0, 0.05);
  }
  .sidebarButton:hover .sidebarIcon,
  .sidebarButton:hover .wideSidebarSpan {
    color: var(--sidebarText) !important;
  }

  .sidebarButtonSelected,
  .sidebarButton.active {
    background: var(--dashboardAccentGradient) !important;
    color: #fff !important;
    border: none !important;
    border-left: none !important;
    box-shadow: 0 2px 12px rgba(255, 122, 0, 0.3) !important;
  }
  .sidebarButtonSelected .sidebarIcon,
  .sidebarButton.active .sidebarIcon,
  .sidebarButtonSelected .wideSidebarSpan,
  .sidebarButton.active .wideSidebarSpan {
    color: #fff !important;
  }

  .sidebarIcon {
    font-size: 18px !important;
    width: 22px !important;
    text-align: center !important;
    color: var(--sidebarTextSecondary) !important;
    flex-shrink: 0 !important;
    float: none !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 1 !important;
    transition: color 0.15s !important;
  }

  .wideSidebarSpan {
    font-size: 14px !important;
    font-weight: 500 !important;
    font-family: var(--font) !important;
    color: var(--sidebarTextSecondary) !important;
    display: inline !important;
    float: none !important;
    line-height: 1.3 !important;
    height: auto !important;
    width: auto !important;
    text-align: left !important;
  }

  .sidebarSpacer {
    height: 1px !important;
    background-color: var(--sidebarSecondary) !important;
    margin: 8px 14px !important;
    padding: 0 !important;
    width: auto !important;
    border: none !important;
  }

  body, body.bg-neutral-800 {
    padding-left: 200px !important;
  }

  @media (max-width: 768px) {
    .sidebar {
      transform: translateX(-100%) !important;
      transition: transform 0.25s ease !important;
      z-index: 100 !important;
    }
    .sidebar.velion-sidebar-open {
      transform: translateX(0) !important;
    }
    body, body.bg-neutral-800 {
      padding-left: 0 !important;
      padding-top: 52px !important;
    }
  }

  /* User info section at bottom */
  .velion-user-info {
    position: absolute !important;
    bottom: 0 !important;
    left: 0 !important;
    right: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 14px !important;
    background-color: var(--sidebarBackground) !important;
    border-top: 1px solid var(--sidebarSecondary) !important;
    z-index: 10 !important;
  }
  .velion-user-avatar img {
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    display: block !important;
  }
  .velion-user-name {
    display: block !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: var(--sidebarText) !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
    font-family: var(--font) !important;
  }
  .velion-user-details {
    flex: 1 !important;
    min-width: 0 !important;
  }
  .velion-user-menu-btn {
    cursor: pointer !important;
    color: var(--sidebarTextSecondary) !important;
    font-size: 16px !important;
    padding: 4px 6px !important;
    border-radius: 6px !important;
  }
  .velion-user-menu-btn:hover {
    background-color: var(--sidebarSecondary) !important;
    color: var(--sidebarText) !important;
  }
  .velion-user-dropdown {
    display: none !important;
    position: absolute !important;
    bottom: 62px !important;
    left: 10px !important;
    right: 10px !important;
    background-color: var(--sidebarSecondary) !important;
    border-radius: 10px !important;
    padding: 4px !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5) !important;
    border: 1px solid var(--sidebarTertiary) !important;
    z-index: 50 !important;
  }
  .velion-user-dropdown.show { display: block !important; }

  .velion-dd-item {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    padding: 9px 12px !important;
    border-radius: 8px !important;
    color: var(--sidebarText) !important;
    font-size: 13px !important;
    font-family: var(--font) !important;
    text-decoration: none !important;
    cursor: pointer !important;
  }
  .velion-dd-item:hover { background-color: var(--sidebarTertiary) !important; }
  .velion-dd-danger { color: #ef4444 !important; }
  .velion-dd-danger:hover { background-color: rgba(239,68,68,0.1) !important; }

  /* Search bar */
  .velion-search-wrapper {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    margin: 4px 10px 10px 10px !important;
    padding: 8px 12px !important;
    background-color: var(--sidebarSecondary) !important;
    border-radius: 10px !important;
    border: 1px solid transparent !important;
  }
  .velion-search-wrapper:focus-within {
    border-color: var(--sidebarAccent) !important;
  }
  .velion-search-wrapper i {
    color: var(--sidebarTextSecondary) !important;
    font-size: 14px !important;
  }
  .velion-search {
    background: transparent !important;
    border: none !important;
    color: var(--sidebarText) !important;
    font-size: 13px !important;
    font-family: var(--font) !important;
    width: 100% !important;
    outline: none !important;
    padding: 0 !important;
    box-shadow: none !important;
  }
  .velion-search::placeholder { color: var(--sidebarTextSecondary) !important; }

  /* Category label */
  .velion-category-label {
    padding: 4px 14px 6px 14px !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    color: var(--sidebarTextSecondary) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    font-family: var(--font) !important;
  }

  /* Navigation links */
  .velion-nav-link {
    text-decoration: none !important;
    display: block !important;
  }

  /* Hide sidebar hover effects from wrapper */
  .sidebar .tooltip-toggle > span.tooltip {
    display: none !important;
  }

  /* Velion brand/logo in sidebar */
  .velion-brand {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 20px 18px 16px 18px !important;
    margin-bottom: 4px !important;
  }
  .velion-brand-icon {
    font-size: 28px !important;
    color: var(--sidebarAccent) !important;
    width: auto !important;
    text-align: center !important;
    filter: drop-shadow(0 0 8px rgba(255, 122, 0, 0.6)) !important;
  }
  .velion-brand-text {
    font-size: 20px !important;
    font-weight: 800 !important;
    color: var(--sidebarText) !important;
    font-family: var(--font) !important;
    letter-spacing: -0.5px !important;
    background: var(--orangeGradient) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    background-clip: text !important;
    text-shadow: 0 0 10px rgba(255, 122, 0, 0.2);
  }
  .velion-brand .customlogo {
    max-height: 32px !important;
    max-width: 140px !important;
    display: block !important;
  }

  /* Fix Pterodactyl panel title being shown */
  div[class*="PageContentBlock___StyledDiv"] > p.text-center,
  h1.text-center,
  div[class*="Header"] > h1,
  span[class*="server-name"],
  #app > div > div > div > p.text-center {
    display: none !important;
  }

  /* Force page header in server view to be visible */
  div[class*="ServerContentBlock"] > h1,
  div[class*="PageContentBlock"] > div > h1 {
    display: block !important;
    color: var(--dashboardText) !important;
  }
</style>
