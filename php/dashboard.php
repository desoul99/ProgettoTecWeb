<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');


$template = file_get_contents('../html/template.html');

if(!checkLogin()){
    $loginSection = Utils::bind_to_template(array('currentPage' => 'dashboard.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Dashboard');
}else{
    $loginSection = '';
    $navBar = navbar('Dashboard', false, true);
}

$pageContent = Utils::bind_to_template(array('currentPage' => 'dashboard.php'),file_get_contents('../html/signup_form.html'));


$replacements = array(
    'pageTitle' => 'Dashboard - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Dashboard',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::bind_to_template($replacements, $template);
?>