<?php 
    // INITIATE AND HANDLE SESSIONS
    
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    if(!isset($_SESSION['username'])) {
        $_SESSION['username'] = '';
    }

    if (!isset($_SESSION['day'])) {
        $_SESSION['day'] = date("d");
    }
    if (!isset($_SESSION['month'])) {
        $_SESSION['month'] = date("m");
    }
    if (!isset($_SESSION['year'])) {
        $_SESSION['year'] = date("Y");
    }