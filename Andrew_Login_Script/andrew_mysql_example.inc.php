<?php

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
