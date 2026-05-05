{{-- Velion - Keyboard shortcuts --}}
@if(isset($n_keyboard_shortcuts) && $n_keyboard_shortcuts == "1")
<script>
document.addEventListener('keydown', function(e) {
  // Ctrl+/ or Ctrl+B — toggle sidebar
  if ((e.ctrlKey && e.key === '/') || (e.ctrlKey && e.key === 'b')) {
    e.preventDefault();
    var sidebar = document.querySelector('.sidebar');
    if (sidebar) sidebar.classList.toggle('velion-sidebar-hidden');
  }

  // Escape — close menus and dropdowns
  if (e.key === 'Escape') {
    document.querySelectorAll('.velion-contextmenu').forEach(function(m) {
      m.style.display = 'none';
    });
    var dropdown = document.getElementById('velion-user-dropdown');
    if (dropdown) dropdown.classList.remove('show');
    // Close mobile sidebar
    var sidebar = document.querySelector('.sidebar');
    if (sidebar) sidebar.classList.remove('velion-sidebar-open');
  }
});
</script>

<style>
  .sidebar.velion-sidebar-hidden {
    display: none !important;
  }
  .sidebar.velion-sidebar-hidden ~ * {
    padding-left: 0 !important;
  }
</style>
@endif
