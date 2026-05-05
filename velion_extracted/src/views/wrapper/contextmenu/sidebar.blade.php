{{-- Velion - Sidebar context menu --}}
<div class="velion-contextmenu" id="velion-contextmenu-sidebar" style="display:none;">
  <div class="velion-contextmenu-item" onclick="window.location.href='/account'">
    <i class="bi bi-person"></i> Nastavení účtu
  </div>
  <div class="velion-contextmenu-item" onclick="window.location.href='/account/api'">
    <i class="bi bi-code-slash"></i> API klíče
  </div>
  <div style="height:1px;background:var(--dashboardSecondary);margin:4px 10px;"></div>
  <div class="velion-contextmenu-item" style="color:#ef4444;" onclick="window.location.href='/auth/logout'">
    <i class="bi bi-box-arrow-right" style="color:#ef4444;"></i> Odhlásit se
  </div>
</div>
