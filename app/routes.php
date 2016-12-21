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
        ['GET', '/searchresult/[:id]', 'Search#searchResultPage', 'search_result'],

        

		/*  Connexion  */
		['GET', '/login', 'Admin#showLoginForm', 'admin_login'],
        ['POST', '/login', 'Admin#processLoginForm', 'admin_process_login'],
        ['GET', '/admin', 'Admin#showSubjectForm', 'admin_subject'],
        ['POST', '/admininsert', 'Admin#insertSubjectForm', 'admin_insert_subject'],
        ['POST', '/admindelete', 'Admin#deleteSubjectForm', 'admin_delete_subject'],
        ['POST', '/adminupdate', 'Admin#updateSubjectForm', 'admin_update_subject'],


        ['GET', '/settings', 'Admin#showSettingsPage', 'admin_settings'],
        ['POST', '/updatessettings', 'Admin#updateSettings', 'admin_update'],

		/*  Déconnexion  */
		['GET', '/logout', 'Admin#processlogOut', 'admin_logout'],


        /*Profile Professeur */

        ['GET', '/profile/[:id]', 'Profile#showProfile', 'profile_show'],


        /* Contact */
        ['GET', '/contact/', 'Default#showContact', 'contact'],
        ['POST', '/contact_send', 'Default#traitementContact', 'contact_form'],

        /*lessons */
        
        ['POST', '/lessonsreservationform', 'Lessons#lessonsReservationForm', 'lessons_reservation_form'],
        ['GET', '/lessons', 'Lessons#showLessonsPage', 'lessons_page'],
        ['POST', '/lessonscharge', 'Lessons#charge', 'lessons_charge'],
        ['POST', '/cancellesson', 'Lessons#cancelLesson', 'lessons_cancel'],
        ['POST', '/ratinglesson', 'Lessons#ratingLesson', 'lessons_rating'],
        ['POST', '/validlesson', 'Lessons#validLesson', 'lessons_valid'],
        ['POST', '/finalizelesson', 'Lessons#finalizeLesson', 'lessons_finalize'],
	);
