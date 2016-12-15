<?php

	$w_routes = array(        
		/* Acceuil */
		['GET', '/', 'Default#home', 'default_home'],

        /*  Inscription */

    	['GET', '/register', 'Admin#showRegisterForm', 'admin_register'],
    	['POST', '/register', 'Admin#processRegisterForm', 'admin_process_register'],

        /*
        /*Page de recherche*/
        
        ['GET', '/search/[:id]', 'Search#searchPage', 'search_page'],
        ['POST', '/[:id]/getallteachers', 'Search#getAllTeachers', 'search_getallteachers'],
        ['POST', '/getlatlng/[:id1]', 'Search#getLatLng', 'search_getlatlng'],
        



		/*  Connexion  */
		['GET', '/login', 'Admin#showLoginForm', 'admin_login'],
        ['POST', '/login', 'Admin#processLoginForm', 'admin_process_login'],

        ['GET', '/settings', 'Admin#showSettingsPage', 'admin_settings'],


		/*  Déconnexion  */
		['GET', '/logout', 'Admin#processlogOut', 'admin_logout'],


        /*Profile Professeur */

        ['GET', '/profile/[:id]', 'Profile#showProfile', 'profile_show'],




	);
