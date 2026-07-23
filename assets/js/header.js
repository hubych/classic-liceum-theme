( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		/* ---------- Мобільне меню (бургер) ---------- */
		var burger = document.querySelector( '.site-header__burger' );
		var mobileNav = document.getElementById( 'site-header-mobile-nav' );

		if ( burger && mobileNav ) {
			burger.addEventListener( 'click', function () {
				var isOpen = burger.getAttribute( 'aria-expanded' ) === 'true';
				burger.setAttribute( 'aria-expanded', String( ! isOpen ) );
				mobileNav.classList.toggle( 'is-open', ! isOpen );

				// Якщо відкрили мобільне меню — закриваємо пошук, щоб не накладались
				closeSearch();
			} );
		}

		/* ---------- Пошук ---------- */
		var searchToggle = document.querySelector( '.site-header__search-toggle' );
		var searchPanel = document.getElementById( 'site-header-search' );

		function closeSearch() {
			if ( searchPanel && searchToggle ) {
				searchPanel.classList.remove( 'is-open' );
				searchToggle.setAttribute( 'aria-expanded', 'false' );
			}
		}

		if ( searchToggle && searchPanel ) {
			searchToggle.addEventListener( 'click', function () {
				var isOpen = searchPanel.classList.contains( 'is-open' );
				searchPanel.classList.toggle( 'is-open', ! isOpen );
				searchToggle.setAttribute( 'aria-expanded', String( ! isOpen ) );

				if ( ! isOpen ) {
					var input = searchPanel.querySelector( 'input[type="search"]' );
					if ( input ) {
						input.focus();
					}
				}
			} );
		}

		/* ---------- Закриття по Escape ---------- */
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' ) {
				closeSearch();
				if ( burger && mobileNav && mobileNav.classList.contains( 'is-open' ) ) {
					burger.setAttribute( 'aria-expanded', 'false' );
					mobileNav.classList.remove( 'is-open' );
				}
			}
		} );

		/* ---------- Закриття мобільного меню при зміні розміру екрана на десктоп ---------- */
		window.addEventListener( 'resize', function () {
			if ( window.innerWidth > 900 && mobileNav && mobileNav.classList.contains( 'is-open' ) ) {
				mobileNav.classList.remove( 'is-open' );
				burger.setAttribute( 'aria-expanded', 'false' );
			}
		} );

	} );
}() );
