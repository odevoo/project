<?php

	$w_routes = array(        
		/* Acceuil */
		['GET', '/home', 'Default#home', 'default_home'],

        /*Connexion / Inscription */

        ['GET', '/register', 'Admin#showRegisterForm', 'admin_register'],
        ['POST', '/register', 'Admin#processRegisterForm', 'admin_process_register'],




	);
