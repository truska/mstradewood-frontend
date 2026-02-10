(function () {
  // Handle nested dropdowns in main top navigation.
  document.querySelectorAll('.menu-bs5 .menu-bs5-desktop-nav .dropdown-submenu > .dropdown-toggle').forEach(function (toggleEl) {
    toggleEl.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();

      var submenu = toggleEl.nextElementSibling;
      if (!submenu || !submenu.classList.contains('dropdown-menu')) {
        return;
      }

      var parentMenu = toggleEl.closest('.dropdown-menu');
      if (parentMenu) {
        parentMenu.querySelectorAll('.dropdown-menu.show').forEach(function (openMenu) {
          if (openMenu !== submenu) {
            openMenu.classList.remove('show');
          }
        });
      }

      submenu.classList.toggle('show');
    });
  });

  // Panel finder mobile: explicit nested expand/collapse state.
  function isPanelFinderMobile() {
    return window.matchMedia('(max-width: 991.98px)').matches;
  }

  function getDirectOpenSubmenus(parentMenu) {
    var result = [];
    if (!parentMenu) {
      return result;
    }
    Array.prototype.forEach.call(parentMenu.children, function (child) {
      if (child.classList && child.classList.contains('dropdown-submenu') && child.classList.contains('pf-open')) {
        result.push(child);
      }
    });
    return result;
  }

  function getDirectSubtoggle(item) {
    if (!item) {
      return null;
    }
    for (var i = 0; i < item.children.length; i += 1) {
      var child = item.children[i];
      if (child.classList && child.classList.contains('panel-finder-subtoggle')) {
        return child;
      }
    }
    return null;
  }

  function getDirectSubmenu(item) {
    if (!item) {
      return null;
    }
    for (var i = 0; i < item.children.length; i += 1) {
      var child = item.children[i];
      if (child.classList && child.classList.contains('dropdown-menu')) {
        return child;
      }
    }
    return null;
  }

  document.querySelectorAll('.menu-bs5 .panel-finder-bs5 .dropdown-submenu > .panel-finder-subtoggle').forEach(function (toggleEl) {
    toggleEl.addEventListener('click', function (event) {
      if (!isPanelFinderMobile()) {
        return;
      }

      event.preventDefault();
      event.stopPropagation();

      var parentItem = toggleEl.closest('.dropdown-submenu');
      if (!parentItem) {
        return;
      }

      var submenu = toggleEl.nextElementSibling;
      if (!submenu || !submenu.classList.contains('dropdown-menu')) {
        return;
      }

      var isLevel1 = parentItem.classList.contains('panel-finder-level1');
      var isLevel2 = parentItem.classList.contains('panel-finder-level2');

      var parentMenu = parentItem.parentElement;
      if (parentMenu) {
        getDirectOpenSubmenus(parentMenu).forEach(function (openItem) {
          if (openItem !== parentItem) {
            openItem.classList.remove('pf-open');
            var openToggle = getDirectSubtoggle(openItem);
            if (openToggle) {
              openToggle.setAttribute('aria-expanded', 'false');
            }
            var openSubmenu = getDirectSubmenu(openItem);
            if (openSubmenu) {
              openSubmenu.style.display = 'none';
            }
          }
        });
      }

      var willOpen = !parentItem.classList.contains('pf-open');
      parentItem.classList.toggle('pf-open', willOpen);
      toggleEl.setAttribute('aria-expanded', willOpen ? 'true' : 'false');

      if (willOpen) {
        submenu.style.display = 'block';
      } else {
        submenu.style.display = 'none';
      }

      // Force legacy-like mobile positioning regardless of stylesheet conflicts.
      if (isLevel1) {
        submenu.style.position = 'absolute';
        submenu.style.top = '0';
        submenu.style.left = '100%';
        submenu.style.width = '150px';
        submenu.style.minWidth = '150px';
        submenu.style.maxWidth = '150px';
        submenu.style.margin = '0';
        submenu.style.transform = 'none';
      } else if (isLevel2) {
        submenu.style.position = 'static';
        submenu.style.top = '';
        submenu.style.left = '';
        submenu.style.width = '100%';
        submenu.style.minWidth = '0';
        submenu.style.maxWidth = '100%';
        submenu.style.margin = '0';
        submenu.style.transform = 'none';
      }
    });
  });

  // Clear open nested dropdowns when top-level dropdown closes.
  document.querySelectorAll('.menu-bs5 .menu-bs5-top-dropdown').forEach(function (topDropdown) {
    topDropdown.addEventListener('hidden.bs.dropdown', function () {
      topDropdown.querySelectorAll('.dropdown-menu.show').forEach(function (openMenu) {
        openMenu.classList.remove('show');
      });
    });
  });

  // Clear nested panel finder submenus when root closes.
  document.querySelectorAll('.menu-bs5 .panel-finder-bs5').forEach(function (panelDropdown) {
    panelDropdown.addEventListener('hidden.bs.dropdown', function () {
      panelDropdown.querySelectorAll('.dropdown-menu.show').forEach(function (openMenu) {
        openMenu.classList.remove('show');
      });
      panelDropdown.querySelectorAll('.dropdown-submenu.pf-open').forEach(function (openItem) {
        openItem.classList.remove('pf-open');
      });
      panelDropdown.querySelectorAll('.panel-finder-subtoggle[aria-expanded=\"true\"]').forEach(function (openToggle) {
        openToggle.setAttribute('aria-expanded', 'false');
      });
      panelDropdown.querySelectorAll('.dropdown-submenu > .dropdown-menu').forEach(function (submenu) {
        submenu.style.display = 'none';
      });
    });
  });
})();
