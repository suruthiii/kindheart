<?php
class AuthMiddleware {
    public function __construct() {
        // Initialize session here if not already done
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //Jayathma Modai
    }

    public function checkAccess($allowedRoles) {
        if (!isset($_SESSION['user_id'])) {
            // User is not logged in, redirect to the login page
            //redirect('users/login');
        } else {
            // Check if the user's role is allowed to access the page
            $userRole = $_SESSION['user_type'];
            if (!in_array($userRole, $allowedRoles)) {
                // User does not have the required role, show an error or redirect
                //redirect('pages/404');
            }
        }
    }
}

