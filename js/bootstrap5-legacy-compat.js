(function () {
  function mapAttribute(selector, fromAttr, toAttr) {
    var nodes = document.querySelectorAll(selector);
    nodes.forEach(function (el) {
      var value = el.getAttribute(fromAttr);
      if (value !== null && !el.hasAttribute(toAttr)) {
        el.setAttribute(toAttr, value);
      }
    });
  }

  // Map common BS3 data attributes to BS5 equivalents.
  mapAttribute('[data-toggle]', 'data-toggle', 'data-bs-toggle');
  mapAttribute('[data-target]', 'data-target', 'data-bs-target');
  mapAttribute('[data-dismiss]', 'data-dismiss', 'data-bs-dismiss');
  mapAttribute('[data-parent]', 'data-parent', 'data-bs-parent');
  mapAttribute('[data-slide]', 'data-slide', 'data-bs-slide');
  mapAttribute('[data-slide-to]', 'data-slide-to', 'data-bs-slide-to');
  mapAttribute('[data-ride]', 'data-ride', 'data-bs-ride');

  // Convert BS3 carousel slide items to BS5 class.
  document.querySelectorAll('.carousel .item').forEach(function (item) {
    item.classList.add('carousel-item');
  });

  // Ensure toggles targeting id by raw value still work.
  document.querySelectorAll('[data-bs-target]').forEach(function (el) {
    var target = (el.getAttribute('data-bs-target') || '').trim();
    if (target && target.charAt(0) !== '#' && document.getElementById(target)) {
      el.setAttribute('data-bs-target', '#' + target);
    }
  });

  if (window.bootstrap && window.bootstrap.Carousel) {
    document.querySelectorAll('.carousel').forEach(function (carouselEl) {
      var interval = parseInt(carouselEl.getAttribute('data-interval') || '5000', 10);
      if (isNaN(interval)) {
        interval = 5000;
      }
      window.bootstrap.Carousel.getOrCreateInstance(carouselEl, {
        interval: interval,
        ride: carouselEl.getAttribute('data-bs-ride') === 'carousel'
      });
    });
  }

  // BS3 CSS often targets .open; BS5 toggles .show.
  document.querySelectorAll('.dropdown').forEach(function (dropdownEl) {
    dropdownEl.addEventListener('shown.bs.dropdown', function () {
      dropdownEl.classList.add('open');
    });
    dropdownEl.addEventListener('hidden.bs.dropdown', function () {
      dropdownEl.classList.remove('open');
    });
  });

  // Legacy mobile nav supports nested submenu expansion with custom toggles.
  document.querySelectorAll('.mobile-submenu-toggle').forEach(function (toggleEl) {
    toggleEl.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();

      var targetId = toggleEl.getAttribute('data-submenu-target');
      if (!targetId) {
        return;
      }

      var submenu = document.getElementById(targetId);
      if (!submenu) {
        return;
      }

      var isExpanded = toggleEl.getAttribute('aria-expanded') === 'true';
      toggleEl.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');

      if (isExpanded) {
        submenu.setAttribute('hidden', 'hidden');
      } else {
        submenu.removeAttribute('hidden');
      }
    });
  });

})();
