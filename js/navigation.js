(function () {
	'use strict';

	var toggle = document.querySelector('.menu-toggle');
	var navigation = document.getElementById('mobile-navigation');

	if (!toggle || !navigation) {
		return;
	}

	function closeMenu() {
		toggle.setAttribute('aria-expanded', 'false');
		navigation.hidden = true;
		document.body.classList.remove('mobile-menu-open');
	}

	toggle.addEventListener('click', function () {
		var isExpanded = toggle.getAttribute('aria-expanded') === 'true';
		toggle.setAttribute('aria-expanded', String(!isExpanded));
		navigation.hidden = isExpanded;
		document.body.classList.toggle('mobile-menu-open', !isExpanded);
	});

	navigation.addEventListener('click', function (event) {
		if (event.target.closest('a')) {
			closeMenu();
		}
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeMenu();
		}
	});

	window.addEventListener('resize', function () {
		if (window.matchMedia('(min-width: 901px)').matches) {
			closeMenu();
		}
	});
}());
