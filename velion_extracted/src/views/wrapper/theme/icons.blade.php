{{-- Velion - Icon & sidebar element styling --}}
<style id="velion-icons-theme">

  /* Icon base styling */
  .sidebarIcon {
    color: var(--sidebarTextSecondary);
    transition: color 0.15s ease;
    line-height: 1;
    flex-shrink: 0;
    font-size: 18px !important;
    width: 22px;
    text-align: center;
  }

  /* Active state icons */
  .sidebarButton.active .sidebarIcon,
  .sidebarButtonSelected .sidebarIcon {
    color: #fff !important;
  }

  /* Hide tooltips (wide sidebar has text labels) */
  .sidebar .sidebarTooltip {
    display: none !important;
  }

  /* Custom logo */
  .customlogo {
    max-height: 32px;
    max-width: 100%;
    display: block;
  }

  /* Hide sidebar default header text/icon if it appears */
  .sidebarLogo,
  .sidebar-logo,
  .sidebar > .sidebarHeader {
    display: none !important;
  }

  /* Badge in sidebar */
  .sidebarBadge {
    background-color: var(--sidebarAccent);
    color: #fff;
    font-size: 11px;
    font-weight: 600;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: auto;
  }

  /* Make sure icon fonts render properly */
  .bi, .ri, .fa, .fas, .far, .fal, .mdi, .ff {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-style: normal;
  }

</style>
