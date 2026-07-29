{{-- Velion - Mobile sidebar toggle --}}
<div class="velion-mobile-nav" id="velion-mobile-nav">
  <button class="velion-mobile-toggle" onclick="document.querySelector('.sidebar').classList.toggle('velion-sidebar-open')">
    <i class="bi bi-list"></i>
  </button>
  <span class="velion-mobile-title">Velion</span>
</div>

<style>
  .velion-mobile-nav {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 52px;
    background-color: var(--sidebarBackground);
    border-bottom: 1px solid var(--sidebarSecondary);
    z-index: 99;
    align-items: center;
    padding: 0 16px;
    gap: 12px;
  }
  .velion-mobile-toggle {
    background: none;
    border: none;
    color: var(--sidebarText);
    font-size: 24px;
    cursor: pointer;
    padding: 4px;
  }
  .velion-mobile-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--sidebarText);
    font-family: var(--font);
  }

  @media (max-width: 768px) {
    .velion-mobile-nav {
      display: flex !important;
    }
    .sidebar {
      transform: translateX(-100%);
      transition: transform 0.25s ease;
      z-index: 100;
    }
    .sidebar.velion-sidebar-open {
      transform: translateX(0);
    }
  }
</style>
