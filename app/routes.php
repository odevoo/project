<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

        /*  Inscription */

    	['GET', '/register', 'Admin#showRegisterForm', 'admin_register'],
    	['POST', '/register', 'Admin#processRegisterForm', 'admin_process_register'],
    	['GET', '/search', 'Search#searchPage', 'search_page'],


        /*Page de recherche*/

				/*  Connexion  */
				['GET', '/login', 'Admin#showLoginForm', 'admin_login'],
        ['POST', '/login', 'Admin#processLoginForm', 'admin_process_login'],



	);
