{{-- Velion - CSS variables (Authenticated only) --}}
@if(Auth::check())
<style id="velion-variables">
  :root {
    /* Core Velion Colors - Updated to #ff8c00 */
    --trueBlack: #050505;
    --deepBlack: #0a0a0a;
    --surfaceBlack: #111111;
    --accentOrange: #ff8c00;
    --accentOrangeLight: #ffa500;
    --orangeGradient: linear-gradient(135deg, #ff8c00, #ffa500);
    --orangeGlow: 0 0 12px rgba(255, 140, 0, 0.2);

    /* Dashboard */
    --dashboardText: #e2e8f0;
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
    --sidebarText: #ffffff;
    --sidebarTextSecondary: #94a3b8;
    --sidebarBackground: var(--trueBlack);
    --sidebarSecondary: var(--deepBlack);
    --sidebarTertiary: var(--surfaceBlack);
    --sidebarAccent: var(--accentOrange);
    --sidebarDeep: var(--trueBlack);
    --sidebarHighlight: var(--accentOrange);

    /* Sidebar derived */
    --sidebarPrimary: #ffffff;
    --sidebarPrimaryHover: var(--accentOrange);
    --sidebarSecondaryHover: var(--deepBlack);
    --sidebarSecondaryActive: var(--surfaceBlack);
    --sidebarButtonActive: var(--accentOrange);

    /* Status */
    --statusOffline: {{ $n_palette_status_offline }};
    --statusError: {{ $n_palette_status_error }};
    --statusStarting: {{ $n_palette_status_starting }};
    --statusOnline: {{ $n_palette_status_online }};

    /* Shape */
    --borderRadius: 12px;
    --borderRadiusSidebar: {{ $n_sidebar_border_radius }}px;

    /* Typography */
    --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  }
</style>
@endif
