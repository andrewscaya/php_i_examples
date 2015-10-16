<?php

$validSession = TRUE;

define('OURUNIQUEKEY', 'phpi');

// Avoid session prediction.
$sessionname = OURUNIQUEKEY;

if (session_name() != $sessionname) {

    session_name($sessionname);

} else {

    session_name();

}

// Start session.
session_start();

if ((isset($_SESSION['initiated']) && !isset($_SESSION['LOGGEDIN']))
    || (isset($_COOKIE['loggedin']) && !isset($_SESSION['LOGGEDIN']))) {

    session_regenerate_id();
	session_write_close();
	setcookie(session_name(),'', time() - 3600, '/');
	setcookie('loggedin', '', time() - 3600, '/');
	$_SESSION = array();
	session_unset();     // Unset $_SESSION variable for the runtime.
	$validSession = FALSE;
    $userMessage = 'Invalid session. Please login again.';

}

if ($validSession == TRUE) {
    
    // Avoid session fixation.
    if (!isset($_SESSION['initiated'])) {
    
        session_regenerate_id();
        $_SESSION['initiated'] = TRUE;
    
    }
    
    if (!isset($_SESSION['CREATED'])) {
    
        $_SESSION['CREATED'] = time();
    
    } 
    
    if (time() - $_SESSION['CREATED'] > 3600) {
    
        // Session started more than 60 minates ago.
        session_regenerate_id();    // Change session ID for the current session an invalidate old session ID.
        $_SESSION['CREATED'] = time();  // Update creation time.
    
    }
    
    // Avoid session hijacking.
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    
    $useragent .= OURUNIQUEKEY;
    
    if (isset($_SESSION['HTTP_USER_AGENT'])) {
    
        if ($_SESSION['HTTP_USER_AGENT'] != md5($useragent)) {
    
            session_regenerate_id();
    		session_write_close();
    		setcookie(session_name(),'', time() - 3600, '/');
    		setcookie('loggedin', '', time() - 3600, '/');
    		$_SESSION = array();
    		session_destroy();   // Destroy session data in storage.
    		session_unset();     // Unset $_SESSION variable for the runtime.
    		$validSession = FALSE;
            $userMessage = 'Invalid session. Please login again.';
    
        }
    
    } else {
    
        $_SESSION['HTTP_USER_AGENT'] = md5($useragent);
    
    }
    
    // Avoid session fixation in case of an inactive session.
    if ($validSession == TRUE && isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > 3600) {
        
        // Last request was more than 60 minutes ago.
    	session_regenerate_id();
    	session_write_close();
    	setcookie(session_name(),'', time() - 3600, '/');
    	setcookie('loggedin', '', time() - 3600, '/');
    	$_SESSION = array();
    	session_destroy();   // Destroy session data in storage.
        session_unset();     // Unset $_SESSION variable for the runtime.
        $validSession = FALSE;
        $userMessage = 'Session inactive for too long. Please login again.';
        
    } else {
    
    	$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp.
    
    }

}
