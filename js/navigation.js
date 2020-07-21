/**
 * File navigation.js.
 *
 * Toggles the navigation menu for small screens
 */
( function() {
	
	var mobileNavButton, mobileMenu, searchButton, searchDisplay, searchCloseButton;

	mobileNavButton = document.getElementById('mobile-nav-button');

	mobileMenu = document.getElementById('mobile-nav-links-container');

	mobileNavButton.onclick = function() {
		if ( -1 !== mobileMenu.className.indexOf( 'toggled1' ) ) {
			mobileMenu.className = mobileMenu.className.replace( ' toggled1', '' );
			mobileNavButton.setAttribute( 'aria-expanded', 'false' );
			mobileNavButton.className = mobileNavButton.className.replace( ' toggled1', '' );
			// menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			mobileMenu.className += ' toggled1';
			mobileNavButton.setAttribute( 'aria-expanded', 'true' );
			mobileNavButton.className += ' toggled1';
			// menu.setAttribute( 'aria-expanded', 'true' );
		}

	
	};


	/* Toggles the search bar */
	searchButton = document.getElementById('search-button');

	searchDisplay = document.getElementById('search-display');

	searchCloseButton = document.getElementById('search-close-button');

	searchButton.onclick = function() {
		if ( -1 !== searchDisplay.className.indexOf( 'toggled2' ) ) {
			searchDisplay.className = searchDisplay.className.replace( ' toggled2', '' );
			searchButton.setAttribute( 'aria-expanded', 'false' );
			searchButton.className = searchButton.className.replace( ' toggled2', '' );
		} else {
			searchDisplay.className += ' toggled2';
			searchButton.setAttribute( 'aria-expanded', 'true' );
			searchButton.className += ' toggled2';
		}
	};

	searchCloseButton.onclick = function() {
		searchDisplay.className = searchDisplay.className.replace( ' toggled2', '' );
		searchButton.setAttribute( 'aria-expanded', 'false' );
	}


} )();
