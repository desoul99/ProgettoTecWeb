<?php
session_start();
function checkLogin(){
    return (isset($_SESSION['recensore']) && $_SESSION['recensore'] != '');
}

function getUsername(){
    return $_SESSION['recensore'];
}

function createSession($username){
    $_SESSION['recensore'] = $username;
}

function deleteSession(){
    session_unset();
    session_destroy();
}
?>