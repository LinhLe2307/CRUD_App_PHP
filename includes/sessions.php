<?php 
session_start();

//Start or renew sessiom
$logged_in = $_SESSION['logged_in'] ?? false;

function login() {
    session_regenerate_id(true); // Update session id
    $_SESSION['logged_in'] = true; // Set logged_in key to true
}

function logout() { //terminate the session
    $_SESSION = [];
    $params = session_get_cookie_params();

    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'],
        $params['secure'], $params['httponly']);         // Delete session cookie
    
    unset($_SESSION['logged_in']);
}

function require_login($logged_in) {
    if($logged_in === false) {
        header('Location: ../index.php');
        exit;
    }
}