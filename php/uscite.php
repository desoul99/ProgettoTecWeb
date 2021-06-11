<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/uscite.html');

if(!checkLogin()){
    $loginSection = Utils::bind_to_template(array('currentPage' => 'uscite.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Calendario uscite', true);
}else{
    $loginSection = '';
    $navBar = navbar('Calendario uscite', true, true);
}

$replacements = array(
    'pageTitle' => 'Calendario uscite - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Calendario uscite',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection
);


echo Utils::bind_to_template($replacements, $template);
?>