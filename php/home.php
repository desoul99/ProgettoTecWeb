<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/home.html');

if(!checkLogin()){
    $loginSection = Utils::template(array('currentPage' => 'home.php'), file_get_contents('../html/login_form.html'));
    $navBar = navbar('Home');
}else{
    $loginSection = '';
    $navBar = navbar('Home', false, true);
}

$replacements = array(
    'pageTitle' => 'Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => '<span xml:lang="en">Home</span>',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::template($replacements, $template);
?>