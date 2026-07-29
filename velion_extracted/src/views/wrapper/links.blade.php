{{-- Velion - Website links (in sidebar) --}}
@if(isset($n_website_links) && $n_website_links == "1")
<div class="velion-links" style="
  padding: 6px 10px;
  display: flex;
  flex-direction: column;
  gap: 2px;
">
  @if($n_weblink_support != "")
  <a href="{{ $n_weblink_support }}" target="_blank" class="velion-link-item">
    <i class="bi bi-headset"></i>
    @if($n_sidebar_full == "1")<span>Podpora</span>@endif
  </a>
  @endif

  @if($n_weblink_billing != "")
  <a href="{{ $n_weblink_billing }}" target="_blank" class="velion-link-item">
    <i class="bi bi-credit-card"></i>
    @if($n_sidebar_full == "1")<span>Platby</span>@endif
  </a>
  @endif

  @if($n_weblink_status != "")
  <a href="{{ $n_weblink_status }}" target="_blank" class="velion-link-item">
    <i class="bi bi-activity"></i>
    @if($n_sidebar_full == "1")<span>Stav služeb</span>@endif
  </a>
  @endif

  @if($n_weblink_social_discord != "")
  <a href="{{ $n_weblink_social_discord }}" target="_blank" class="velion-link-item">
    <i class="bi bi-discord"></i>
    @if($n_sidebar_full == "1")<span>Discord</span>@endif
  </a>
  @endif

  @if($n_weblink_social_github != "")
  <a href="{{ $n_weblink_social_github }}" target="_blank" class="velion-link-item">
    <i class="bi bi-github"></i>
    @if($n_sidebar_full == "1")<span>GitHub</span>@endif
  </a>
  @endif
</div>

<style>
  .velion-link-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    color: var(--sidebarTextSecondary) !important;
    font-size: 13px;
    border-radius: var(--borderRadiusSidebar);
    text-decoration: none !important;
    transition: background-color 0.15s, color 0.15s;
  }
  .velion-link-item i { font-size: 16px; width: 20px; text-align: center; }
  .velion-link-item:hover {
    background-color: var(--sidebarSecondary);
    color: var(--sidebarText) !important;
  }
</style>

@if($n_sidebar_separators == "1")
<div class="sidebarSpacer"></div>
@endif
@endif
