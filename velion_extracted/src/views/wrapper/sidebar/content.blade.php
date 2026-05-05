{{-- Velion - Sidebar content (always wide with text labels) --}}
<div class="sidebarContentContainer">
  <div class="sidebarContent">

    {{-- Logo / Brand --}}
    <div class="velion-brand">
      @if($n_sidebar_customlogo != "")
        <img src="{{ $n_sidebar_customlogo }}" class="customlogo" alt="Logo">
      @else
        <i class="bi bi-lightning-charge-fill velion-brand-icon"></i>
        <span class="velion-brand-text">Velion</span>
      @endif
    </div>

    {{-- Search bar --}}
    <div class="velion-search-wrapper">
      <i class="bi bi-search"></i>
      <input type="text" class="velion-search" placeholder="Hledat..." id="velionSearch">
    </div>

    {{-- General category --}}
    <div id="sidebarCategoryGeneral">
      @if($n_sidebar_home != "0")
      <a href="/" class="velion-nav-link">
        <div class="sidebarButton" id="sidebarHome">
          <i class="{{ $__home }} sidebarIcon"></i>
          <span class="wideSidebarSpan">Servery</span>
        </div>
      </a>
      @endif

      @if($n_sidebar_admin != "0" && Auth::user()->root_admin)
      <a href="/admin" class="velion-nav-link">
        <div class="sidebarButton" id="sidebarAdmin">
          <i class="{{ $__admin }} sidebarIcon"></i>
          <span class="wideSidebarSpan">Administrace</span>
        </div>
      </a>
      @endif

      @if($n_sidebar_account != "0")
      <a href="/account" class="velion-nav-link">
        <div class="sidebarButton" id="sidebarAccount">
          <i class="{{ $__account }} sidebarIcon"></i>
          <span class="wideSidebarSpan">Účet</span>
        </div>
      </a>
      @endif

      <div class="sidebarSpacer"></div>
    </div>

    {{-- Server category --}}
    <div id="sidebarCategoryServer" style="display: none;">
      <div id="velionServerLabel" class="velion-category-label"></div>

      @if($n_sidebar_server_terminal != "0")
      <div class="sidebarButton serverButton" data-page="server-terminal" id="sidebarServerTerminal">
        <i class="{{ $__server_terminal }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Konzole</span>
      </div>
      @endif

      @if($n_sidebar_server_startup != "0")
      <div class="sidebarButton serverButton" data-page="server-startup" id="sidebarServerStartup">
        <i class="{{ $__server_startup }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Spuštění</span>
      </div>
      @endif

      @if($n_sidebar_server_files != "0")
      <div class="sidebarButton serverButton" data-page="server-files" id="sidebarServerFiles">
        <i class="{{ $__server_files }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Soubory</span>
      </div>
      @endif

      @if($n_sidebar_server_databases != "0")
      <div class="sidebarButton serverButton" data-page="server-databases" id="sidebarServerDatabases">
        <i class="{{ $__server_databases }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Databáze</span>
      </div>
      @endif

      @if($n_sidebar_server_schedules != "0")
      <div class="sidebarButton serverButton" data-page="server-schedules" id="sidebarServerSchedules">
        <i class="{{ $__server_schedules }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Automatizace</span>
      </div>
      @endif

      @if($n_sidebar_server_users != "0")
      <div class="sidebarButton serverButton" data-page="server-users" id="sidebarServerUsers">
        <i class="{{ $__server_users }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Uživatelé</span>
      </div>
      @endif

      @if($n_sidebar_server_backups != "0")
      <div class="sidebarButton serverButton" data-page="server-backups" id="sidebarServerBackups">
        <i class="{{ $__server_backups }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Zálohy</span>
      </div>
      @endif

      @if($n_sidebar_server_network != "0")
      <div class="sidebarButton serverButton" data-page="server-network" id="sidebarServerNetwork">
        <i class="{{ $__server_network }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Síť</span>
      </div>
      @endif

      @if($n_sidebar_server_settings != "0")
      <div class="sidebarButton serverButton" data-page="server-settings" id="sidebarServerSettings">
        <i class="{{ $__server_settings }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Nastavení</span>
      </div>
      @endif

      @if($n_sidebar_server_activity != "0")
      <div class="sidebarButton serverButton" data-page="server-activity" id="sidebarServerActivity">
        <i class="{{ $__server_activity }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Aktivita</span>
      </div>
      @endif
    </div>

    {{-- Account category --}}
    <div id="sidebarCategoryAccount" style="display: none;">
      @if($n_sidebar_account_account != "0")
      <div class="sidebarButton accountButton" data-page="account" id="sidebarAccountAccount">
        <i class="{{ $__account_account }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Účet</span>
      </div>
      @endif

      @if($n_sidebar_account_api != "0")
      <div class="sidebarButton accountButton" data-page="account-api" id="sidebarAccountApi">
        <i class="{{ $__account_api }} sidebarIcon"></i>
        <span class="wideSidebarSpan">API</span>
      </div>
      @endif

      @if($n_sidebar_account_ssh != "0")
      <div class="sidebarButton accountButton" data-page="account-ssh" id="sidebarAccountSsh">
        <i class="{{ $__account_ssh }} sidebarIcon"></i>
        <span class="wideSidebarSpan">SSH klíče</span>
      </div>
      @endif

      @if($n_sidebar_account_activity != "0")
      <div class="sidebarButton accountButton" data-page="account-activity" id="sidebarAccountActivity">
        <i class="{{ $__account_activity }} sidebarIcon"></i>
        <span class="wideSidebarSpan">Aktivita</span>
      </div>
      @endif
    </div>

  </div>
</div>

{{-- User info at bottom --}}
<div class="velion-user-info" id="velion-user-info">
  <div class="velion-user-avatar">
    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=64&d=identicon" alt="">
  </div>
  <div class="velion-user-details">
    <span class="velion-user-name">{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</span>
  </div>
  <div class="velion-user-menu-btn" onclick="document.getElementById('velion-user-dropdown').classList.toggle('show')">
    <i class="bi bi-three-dots"></i>
  </div>
</div>
<div class="velion-user-dropdown" id="velion-user-dropdown">
  <a href="/account" class="velion-dd-item"><i class="bi bi-person"></i> Nastavení účtu</a>
  <a href="/auth/logout" class="velion-dd-item velion-dd-danger"><i class="bi bi-box-arrow-right"></i> Odhlásit se</a>
</div>

<style>
  /* Search bar */
  .velion-search-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 4px 10px 10px 10px;
    padding: 8px 12px;
    background-color: var(--sidebarSecondary);
    border-radius: 10px;
    border: 1px solid transparent;
    transition: border-color 0.2s;
  }
  .velion-search-wrapper:focus-within {
    border-color: var(--sidebarAccent);
  }
  .velion-search-wrapper i {
    color: var(--sidebarTextSecondary);
    font-size: 14px;
  }
  .velion-search {
    background: transparent !important;
    border: none !important;
    color: var(--sidebarText) !important;
    font-size: 13px;
    font-family: var(--font) !important;
    width: 100%;
    outline: none !important;
    padding: 0 !important;
    box-shadow: none !important;
  }
  .velion-search::placeholder {
    color: var(--sidebarTextSecondary);
  }

  /* Navigation links */
  .velion-nav-link {
    text-decoration: none !important;
    display: block;
  }

  /* Sidebar buttons - Hexado style */
  .sidebarButton {
    display: flex !important;
    align-items: center !important;
    gap: 12px;
    padding: 10px 14px;
    margin: 2px 8px;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.15s, transform 0.1s;
    border-left: 0px solid transparent;
    color: var(--sidebarTextSecondary);
  }
  .sidebarButton:hover {
    background-color: var(--sidebarSecondary);
    color: var(--sidebarText);
  }
  .sidebarButton:hover .sidebarIcon,
  .sidebarButton:hover .wideSidebarSpan {
    color: var(--sidebarText);
  }

  /* Active state - orange pill */
  .sidebarButtonSelected,
  .sidebarButton.active {
    background: var(--dashboardAccentGradient) !important;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(255, 122, 0, 0.3);
  }
  .sidebarButtonSelected .sidebarIcon,
  .sidebarButton.active .sidebarIcon,
  .sidebarButtonSelected .wideSidebarSpan,
  .sidebarButton.active .wideSidebarSpan {
    color: #fff !important;
  }

  /* Icon in sidebar */
  .sidebarIcon {
    font-size: 18px !important;
    width: 22px;
    text-align: center;
    color: var(--sidebarTextSecondary);
    transition: color 0.15s;
    flex-shrink: 0;
    float: none !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 1 !important;
  }

  /* Text label */
  .wideSidebarSpan {
    font-size: 14px !important;
    font-weight: 500;
    font-family: var(--font) !important;
    color: var(--sidebarTextSecondary);
    transition: color 0.15s;
    display: inline !important;
    line-height: 1.2 !important;
    height: auto !important;
    float: none !important;
    text-align: left !important;
    width: auto !important;
  }

  /* Category label */
  .velion-category-label {
    padding: 4px 14px 6px 14px;
    font-size: 11px;
    font-weight: 600;
    color: var(--sidebarTextSecondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-family: var(--font);
  }

  /* Separator */
  .sidebarSpacer {
    height: 1px;
    background-color: var(--sidebarSecondary);
    margin: 8px 14px;
  }

  /* User info at bottom */
  .velion-user-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 14px;
    background-color: var(--sidebarBackground);
    border-top: 1px solid var(--sidebarSecondary);
  }
  .velion-user-avatar img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: block;
  }
  .velion-user-details {
    flex: 1;
    min-width: 0;
  }
  .velion-user-name {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--sidebarText);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-family: var(--font);
  }
  .velion-user-menu-btn {
    cursor: pointer;
    color: var(--sidebarTextSecondary);
    font-size: 16px;
    padding: 4px 6px;
    border-radius: 6px;
    transition: background-color 0.15s;
  }
  .velion-user-menu-btn:hover {
    background-color: var(--sidebarSecondary);
    color: var(--sidebarText);
  }
  .velion-user-dropdown {
    display: none;
    position: absolute;
    bottom: 62px;
    left: 10px;
    right: 10px;
    background-color: var(--sidebarSecondary);
    border-radius: 10px;
    padding: 4px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
    border: 1px solid var(--sidebarTertiary);
    z-index: 50;
  }
  .velion-user-dropdown.show { display: block; }
  .velion-dd-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 12px;
    border-radius: 8px;
    color: var(--sidebarText) !important;
    font-size: 13px;
    font-family: var(--font);
    text-decoration: none !important;
    transition: background-color 0.15s;
    cursor: pointer;
  }
  .velion-dd-item:hover { background-color: var(--sidebarTertiary); }
  .velion-dd-danger { color: #ef4444 !important; }
  .velion-dd-danger:hover { background-color: rgba(239,68,68,0.1); }

  /* Sidebar container */
  .sidebar {
    width: 200px !important;
    display: block !important;
  }
  .sidebarContentContainer {
    width: 100% !important;
  }
  .sidebarContent {
    padding-bottom: 70px;
  }
</style>
