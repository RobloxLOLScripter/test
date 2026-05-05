{{-- Velion - SPA navigation script --}}
<script>
(function() {
  var lastPath = '';

  function velionUpdateSidebar() {
    var path = window.location.pathname;
    if (path === lastPath) return;
    lastPath = path;

    var serverMatch = path.match(/^\/server\/([^/]+)(\/(.*))?/);
    var accountMatch = path.match(/^\/account/);
    var isHome = (path === '/' || path === '');

    var catGeneral = document.getElementById('sidebarCategoryGeneral');
    var catServer = document.getElementById('sidebarCategoryServer');
    var catAccount = document.getElementById('sidebarCategoryAccount');
    var serverLabel = document.getElementById('velionServerLabel');

    if (!catGeneral) return;

    // Reset all active states
    document.querySelectorAll('.sidebarButton').forEach(function(btn) {
      btn.classList.remove('active');
    });

    if (serverMatch) {
      // Server page - show server category
      catGeneral.style.display = 'block';
      catServer.style.display = 'block';
      if (catAccount) catAccount.style.display = 'none';

      var serverId = serverMatch[1];
      var subPage = serverMatch[3] || '';

      // Set server name label
      if (serverLabel) {
        var nameEl = document.querySelector('h1') || document.querySelector('[class*="header"]');
        var serverName = nameEl ? nameEl.textContent.trim() : serverId.substring(0, 8);
        serverLabel.textContent = serverName;
      }

      // Map sub-pages to button IDs
      var pageMap = {
        '': 'sidebarServerTerminal',
        'console': 'sidebarServerTerminal',
        'startup': 'sidebarServerStartup',
        'files': 'sidebarServerFiles',
        'databases': 'sidebarServerDatabases',
        'schedules': 'sidebarServerSchedules',
        'users': 'sidebarServerUsers',
        'backups': 'sidebarServerBackups',
        'network': 'sidebarServerNetwork',
        'settings': 'sidebarServerSettings',
        'activity': 'sidebarServerActivity'
      };

      var btnId = pageMap[subPage] || pageMap[''];
      var activeBtn = document.getElementById(btnId);
      if (activeBtn) activeBtn.classList.add('active');

      // Make server buttons clickable
      document.querySelectorAll('.serverButton').forEach(function(btn) {
        btn.style.cursor = 'pointer';
        btn.onclick = function() {
          var page = btn.getAttribute('data-page');
          var url = '/server/' + serverId;
          if (page === 'server-terminal') url += '';
          else if (page === 'server-startup') url += '/startup';
          else if (page === 'server-files') url += '/files';
          else if (page === 'server-databases') url += '/databases';
          else if (page === 'server-schedules') url += '/schedules';
          else if (page === 'server-users') url += '/users';
          else if (page === 'server-backups') url += '/backups';
          else if (page === 'server-network') url += '/network';
          else if (page === 'server-settings') url += '/settings';
          else if (page === 'server-activity') url += '/activity';
          window.location.href = url;
        };
      });

    } else if (accountMatch) {
      // Account page
      catGeneral.style.display = 'block';
      catServer.style.display = 'none';
      if (catAccount) catAccount.style.display = 'block';

      var homeBtn = document.getElementById('sidebarAccount');
      if (homeBtn) homeBtn.classList.add('active');

      // Map account sub-pages
      var accountPageMap = {
        '/account': 'sidebarAccountAccount',
        '/account/api': 'sidebarAccountApi',
        '/account/ssh': 'sidebarAccountSsh',
        '/account/activity': 'sidebarAccountActivity'
      };

      var accBtnId = accountPageMap[path];
      if (accBtnId) {
        var accBtn = document.getElementById(accBtnId);
        if (accBtn) accBtn.classList.add('active');
      }

      // Make account buttons clickable
      document.querySelectorAll('.accountButton').forEach(function(btn) {
        btn.style.cursor = 'pointer';
        btn.onclick = function() {
          var page = btn.getAttribute('data-page');
          if (page === 'account') window.location.href = '/account';
          else if (page === 'account-api') window.location.href = '/account/api';
          else if (page === 'account-ssh') window.location.href = '/account/ssh';
          else if (page === 'account-activity') window.location.href = '/account/activity';
        };
      });

    } else {
      // Home page (server list)
      catGeneral.style.display = 'block';
      catServer.style.display = 'none';
      if (catAccount) catAccount.style.display = 'none';

      var homeBtn = document.getElementById('sidebarHome');
      if (homeBtn) homeBtn.classList.add('active');
    }
  }

  // Search functionality
  function velionInitSearch() {
    var searchInput = document.getElementById('velionSearch');
    if (!searchInput) return;

    searchInput.addEventListener('input', function() {
      var query = this.value.toLowerCase();
      document.querySelectorAll('.sidebarButton').forEach(function(btn) {
        var span = btn.querySelector('.wideSidebarSpan');
        if (!span) return;
        var text = span.textContent.toLowerCase();
        if (query === '' || text.includes(query)) {
          btn.style.display = '';
        } else {
          btn.style.display = 'none';
        }
      });
    });
  }

  // Close dropdown on outside click
  document.addEventListener('click', function(e) {
    var dropdown = document.getElementById('velion-user-dropdown');
    var menuBtn = document.querySelector('.velion-user-menu-btn');
    if (dropdown && menuBtn && !menuBtn.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.remove('show');
    }
  });

  // Initial run
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
      velionUpdateSidebar();
      velionInitSearch();
    });
  } else {
    velionUpdateSidebar();
    velionInitSearch();
  }

  // Fix grey backgrounds from styled-components
  function velionFixGreyBgs() {
    var app = document.getElementById('app');
    if (!app) return;
    var darkBg = getComputedStyle(document.documentElement).getPropertyValue('--dashboardPrimary').trim() || '#1a1d24';
    var pageBg = getComputedStyle(document.documentElement).getPropertyValue('--dashboardBackground').trim() || '#111318';

    app.querySelectorAll('div').forEach(function(el) {
      if (el.closest('.sidebar') || el.closest('#sidebar')) return;
      if (el.closest('[class*="terminal"]') || el.closest('[class*="Console"]')) return;
      var bg = getComputedStyle(el).backgroundColor;
      if (!bg || bg === 'transparent' || bg === 'rgba(0, 0, 0, 0)') return;

      // Parse rgb values
      var match = bg.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)/);
      if (!match) return;
      var r = parseInt(match[1]), g = parseInt(match[2]), b = parseInt(match[3]);

      // Detect grey-ish backgrounds (not too dark, not too light)
      // Grey = similar R/G/B values, brightness between 40-120
      var brightness = (r + g + b) / 3;
      var maxDiff = Math.max(r, g, b) - Math.min(r, g, b);
      if (brightness > 35 && brightness < 130 && maxDiff < 30) {
        el.style.setProperty('background-color', darkBg, 'important');
      }
    });
  }

  // SPA navigation detection
  setInterval(function() {
    velionUpdateSidebar();
    velionFixGreyBgs();
  }, 500);

  // Also listen to popstate
  window.addEventListener('popstate', function() {
    lastPath = '';
    velionUpdateSidebar();
  });

  // Run grey fix on load and after short delay
  setTimeout(velionFixGreyBgs, 500);
  setTimeout(velionFixGreyBgs, 1500);
  setTimeout(velionFixGreyBgs, 3000);

})();
</script>
