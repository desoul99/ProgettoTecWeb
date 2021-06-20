<?php
session_start();
function checkLogin(){
    return (isset($_SESSION['recensore']) && $_SESSION['recensore'] != '');
}

function getUsername(){
    return $_SESSION['recensore'] ?? null;
}

function createSession($username){
    $_SESSION['recensore'] = $username;
}

function getFeedback(){
    return $_SESSION['feedback'] ?? null;
}
function getBreadcrumbs(){
    return $_SESSION['breadcrumbs'] ?? null;
}

function deleteFeedback(){
    unset($_SESSION['feedback']);
    unset($_SESSION['breadcrumbs']);
}

function createFeedback($feedback, $breadcrumbs){
    $_SESSION['feedback'] = $feedback;
    $_SESSION['breadcrumbs'] = $breadcrumbs;
}

function deleteSession(){
    session_unset();
    session_destroy();
}
?>