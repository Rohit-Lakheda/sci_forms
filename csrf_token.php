<?php
session_start();

// Set session timeout to 30 minutes
$timeout = 30 * 60; // 30 minutes in seconds

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    // Destroy the session if inactive for more than 30 minutes
    session_unset();
    session_destroy();
    session_start(); // Start a new session to avoid errors
}

// Update last activity time
$_SESSION['last_activity'] = time();

function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
?>