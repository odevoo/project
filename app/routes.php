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

        

		/*  Administration  */
		['GET', '/login', 'Admin#showLoginForm', 'admin_login'],
        ['POST', '/login', 'Admin#processLoginForm', 'admin_process_login'],
        ['GET', '/admin', 'Admin#showSubjectForm', 'admin_subject'],
        ['POST', '/admininsert', 'Admin#insertSubjectForm', 'admin_insert_subject'],
        ['POST', '/admindelete', 'Admin#deleteSubjectForm', 'admin_delete_subject'],
        ['POST', '/adminupdate', 'Admin#updateSubjectForm', 'admin_update_subject'],
        ['GET', '/adminlost', 'Admin#lostPasswordForm', 'admin_lost_password'],
        ['POST', '/adminreset', 'Admin#resetPasswordForm', 'admin_reset_password'],
        ['GET', '/reinitpwd/[:id]/[:token]', 'Admin#reinitPasswordForm', 'admin_reinit_password'],
        ['POST', '/reinitpwd/[:id]/[:token]', 'Admin#majPassword', 'admin_maj_password'],


        ['GET', '/settings', 'Admin#showSettingsPage', 'admin_settings'],
        ['POST', '/updatessettings', 'Admin#updateSettings', 'admin_update'],

        ['POST', '/generatepdf', 'Admin#generatePdf', 'admin_pdf'],
        ['POST', '/uploadrib', 'Admin#uploadRib', 'admin_rib'],
        ['POST', '/deleterib', 'Admin#deleteRib', 'admin_delete_rib'],


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
