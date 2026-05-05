{{-- Velion - Files context menu --}}
<div class="velion-contextmenu" id="velion-contextmenu-files" style="display:none;">
  <div class="velion-contextmenu-item" onclick="velionContextAction('refresh')">
    <i class="bi bi-arrow-clockwise"></i> Obnovit
  </div>
  <div class="velion-contextmenu-item" onclick="velionContextAction('upload')">
    <i class="bi bi-upload"></i> Nahrát soubor
  </div>
  <div class="velion-contextmenu-item" onclick="velionContextAction('new-file')">
    <i class="bi bi-file-plus"></i> Nový soubor
  </div>
  <div class="velion-contextmenu-item" onclick="velionContextAction('new-folder')">
    <i class="bi bi-folder-plus"></i> Nová složka
  </div>
</div>

<style>
  .velion-contextmenu {
    position: fixed;
    z-index: 999;
    background-color: var(--dashboardPrimary);
    border: 1px solid var(--dashboardSecondary);
    border-radius: 10px;
    padding: 6px;
    min-width: 180px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
    font-family: var(--font);
  }
  .velion-contextmenu-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    font-size: 13px;
    color: var(--dashboardText);
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.1s;
  }
  .velion-contextmenu-item:hover {
    background-color: var(--dashboardSecondary);
  }
  .velion-contextmenu-item i {
    font-size: 14px;
    width: 16px;
    text-align: center;
    color: var(--dashboardAccent);
  }
</style>
