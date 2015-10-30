<?php
/**
 * Andrew's Session App
 *
 * @package    Andrew's Session App
 * @author     Andrew Caya
 * @link       https://github.com/andrewscaya
 * @version    2.1.0
 * @license    http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 */
/**
 * Functions getConnection and getQuote 
 * Another contributor authored these functions
 * 
 * @author     Doug Bierer
 * @link       http://unlikelysource.com
 */

function getConnection()
{
    
    static $link = NULL;
    
    if ($link === NULL) {
        
        $link = mysqli_connect('127.0.0.1', 'phpi', 'password', 'andrew_session_app');
        
    }
    
    return $link;
    
}

function getQuote()
{
    
    return "'";
    
}

function queryResults($query)
{
    
    $link = getConnection();
    
    $result = mysqli_query($link, $query);
    
    $values = mysqli_fetch_assoc($result);
    
    mysqli_close($link);

    return $values;
    
}

// SELECT `username`, `password` FROM `users` WHERE `username` LIKE $username; 
function checkLogin($username, $password)
{
    
    $query = 'SELECT `username`, `password` FROM `users` WHERE `username` LIKE ' . getQuote() . $username . getQuote();
    
    $values = queryResults($query);
    
    $passwordVerified = password_verify($password, $values['password']);
    
    return $passwordVerified;
    
}
