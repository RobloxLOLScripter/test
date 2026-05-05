{{-- Velion - CSS custom properties (Hexado-style) --}}
<style id="velion-variables">
  :root {
    /* Core Velion Colors */
    --trueBlack: #050505;
    --deepBlack: #0a0a0a;
    --surfaceBlack: #111111;
    --accentOrange: #ff7a00;
    --accentOrangeLight: #ffb347;
    --orangeGradient: linear-gradient(135deg, #ff7a00, #ffb347);
    --orangeGlow: 0 0 15px rgba(255, 122, 0, 0.3);

    /* Dashboard */
    --dashboardText: {{ $n_palette_dashboard_1 }};
    --dashboardAccent: var(--accentOrange);
    --dashboardAccentGradient: var(--orangeGradient);
    --dashboardPrimary: var(--deepBlack);
    --dashboardSecondary: var(--surfaceBlack);
    --dashboardTertiary: #1a1a1a;
    --dashboardQuaternary: #222222;
    --dashboardBackground: var(--trueBlack);
    --dashboardFifth: {{ $n_palette_dashboard_8 }};
    --dashboardSixth: {{ $n_palette_dashboard_9 }};
    --pageBackground: var(--trueBlack);

    /* Sidebar */
    --sidebarText: {{ $n_palette_sidebar_1 }};
    --sidebarTextSecondary: {{ $n_palette_sidebar_2 }};
    --sidebarBackground: var(--trueBlack);
    --sidebarSecondary: var(--deepBlack);
    --sidebarTertiary: var(--surfaceBlack);
    --sidebarAccent: var(--accentOrange);
    --sidebarDeep: var(--trueBlack);
    --sidebarHighlight: var(--accentOrange);

    /* Sidebar derived */
    --sidebarPrimary: {{ $n_palette_sidebar_1 }};
    --sidebarPrimaryHover: var(--accentOrange);
    --sidebarSecondaryHover: var(--deepBlack);
    --sidebarSecondaryActive: var(--surfaceBlack);
    --sidebarButtonActive: var(--accentOrange);

    /* Auth */
    --authBackground: var(--trueBlack);
    --authPrimary: var(--deepBlack);
    --authSecondary: var(--surfaceBlack);
    --authTertiary: #1a1a1a;
    --authError: {{ $n_palette_auth_5 }};
    --authAccent: var(--accentOrange);
    --authQuaternary: #222222;
    --authText: {{ $n_palette_auth_8 }};

    /* Status */
    --statusOffline: {{ $n_palette_status_offline }};
    --statusError: {{ $n_palette_status_error }};
    --statusStarting: {{ $n_palette_status_starting }};
    --statusOnline: {{ $n_palette_status_online }};

    /* Shape */
    --borderRadius: {{ $n_border_radius }}px;
    --borderRadiusSidebar: {{ $n_sidebar_border_radius }}px;

    /* Typography */
    --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  }
</style>
