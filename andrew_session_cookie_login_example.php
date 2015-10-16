<?php

ob_start();

$fakeDB = ['Doug' => 'pass', 'Andrew' => 'pass2'];

$postLoginForm = TRUE;

$userMessage = '';

if (isset($_COOKIE['loggedin'])) {
    
    require_once './andrew_session_example.php';
	
	if ($validSession == TRUE) {
	
		$postLoginForm = FALSE;
	
	}
    
}

// Login verification.
if (isset($_POST['submit'])) {

	if ($_POST['submit'] == 1
    && array_key_exists($_POST['username'], $fakeDB)
    && $_POST['password'] == $fakeDB[$_POST['username']]) {
		    
	    require_once './andrew_session_example.php';
		
		if ($validSession == TRUE) {
		    
		    if (isset($_SESSION['LOGGEDIN'])) {
		    
		        session_regenerate_id();
            	session_write_close();
            	setcookie(session_name(),'', time() - 3600, '/');
            	setcookie('loggedin', '', time() - 3600, '/');
            	$_SESSION = array();
            	session_destroy();   // Destroy session data in storage.
                session_unset();     // Unset $_SESSION variable for the runtime.
                $validSession = FALSE;
                header("location: andrew_session_cookie_login_example.php?lo=2");
                exit;
		    
		    }
		
			setcookie('loggedin', TRUE, time()+ 4200, '/');
			session_set_cookie_params(4200);
			$_SESSION['LOGGEDIN'] = TRUE;
			$_SESSION['REMOTE_USER'] = $_POST['username'];
			$postLoginForm = FALSE;
		
		}
		
	} else {
		
			$postLoginForm = TRUE;
			$userMessage = 'Wrong credentials.  Try again.';
		
	}
	
}

// Intercept logout POST.
if (isset($_POST['logout'])) {
			
	require_once './session_example.php';
	session_write_close();
	setcookie(session_name(),'', time() - 3600, '/');
	setcookie('loggedin', '', time() - 3600, '/');
	$_SESSION = array();
	session_destroy();   // Destroy session data in storage.
	session_unset();     // Unset $_SESSION variable for the runtime.
	$postLoginForm = TRUE;
	header("location: andrew_session_cookie_login_example.php?lo=1");
	exit;

}

if (!isset($_COOKIE['loggedin']) && isset($_GET['lo'])) {
    
    if ($_GET['lo'] == 1) {

        $userMessage = 'You are logged out!  You can login again.';
        
    } else {
        
        $userMessage = 'Invalid session. Please login again.';
        
    }

}

if ($postLoginForm == TRUE) {

	$htmlOut = '<!DOCTYPE html>';
	$htmlOut .= '<html>';
	$htmlOut .= '<head>';
	$htmlOut .= '</head>';
	$htmlOut .= '<body>';
	$htmlOut .= '<p><b>' . $userMessage . '</b></p><br /><br />';
	$htmlOut .= '<form action="" method="post">';
	$htmlOut .= 'Username: <input type="text" name="username">';
	$htmlOut .= 'Password: <input type="password" name="password">';
	$htmlOut .= '<button name="submit" type="submit" value="1">Submit</button>';
	$htmlOut .= '</form>';
	$htmlOut .= '</body>';
	$htmlOut .= '</html>';

} else {

	$htmlOut = '<!DOCTYPE html>';
	$htmlOut .= '<html>';
	$htmlOut .= '<head>';
	$htmlOut .= '</head>';
	$htmlOut .= '<body>';
	
	if (isset($_GET['check'])) {
	    
	    $htmlOut .= '<p>Hello, ' . $_SESSION['REMOTE_USER'] . ' !<br />You are still logged in.<br /><br /></p>';
	    
	} else {
	    
	    $htmlOut .= '<p>Welcome, ' . $_SESSION['REMOTE_USER'] . ' !<br />You are logged in.<br /><br /><a href="andrew_session_cookie_login_example.php?check=1">Check cookie</a></p>';
	}
	
	$htmlOut .= '<form action="" method="post">';
	$htmlOut .= '<button name="logout" type="submit" value="2">Logout</button>';
	$htmlOut .= '</form>';
	$htmlOut .= '</body>';
	$htmlOut .= '</html>';

}

echo $htmlOut;

ob_end_flush();

flush();
