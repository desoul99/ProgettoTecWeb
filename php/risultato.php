<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/risultato.html');

if(!getFeedback() || !getBreadcrumbs()){
    header("location: home.php");
    die();
}

$feedback = getFeedback();
$breadcrumbs = getBreadcrumbs();

if(!checkLogin()){
    $loginSection = Utils::template(array('currentPage' => 'risultato.php'), file_get_contents('../html/login_form.html'));
    $navBar = navbar($breadcrumbs);
}else{
    $loginSection = '';
    $navBar = navbar($breadcrumbs, false, true);
}

$pageContent = Utils::template(array('feedback' => $feedback), $pageContent);

$replacements = array(
    'pageTitle' => 'Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => $breadcrumbs.' > Risultato',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);

echo Utils::template($replacements, $template);
?>