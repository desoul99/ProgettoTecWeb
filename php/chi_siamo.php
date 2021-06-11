<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/chi_siamo.html');

if(!checkLogin()){
    $loginSection = Utils::bind_to_template(array('currentPage' => 'chi_siamo.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Chi siamo');
}else{
    $loginSection = '';
    $navBar = navbar('Chi siamo', false, true);
}


$replacements = array(
    'pageTitle' => 'Chi siamo - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Chi siamo',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::bind_to_template($replacements, $template);
?>