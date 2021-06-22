<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/chi_siamo.html');

if(!checkLogin()){
    $loginSection = Utils::template(array('currentPage' => 'chi_siamo.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Chi siamo');
}else{
    $loginSection = '';
    $navBar = navbar('Chi siamo', false, true);
}


$replacements = array(
    'pageTitle' => 'Chi siamo - Orient Review',
    'metaTitle' => 'Chi siamo - Orient Review',
    'metaDescription' => 'Presentazione dei creatori del sito Orient Review',
    'metaKeywords' => 'recensioni, oriente, manga, anime, orientreview, fumetti, libri, chisiamo',
    'metaAuthors' => 'Marco Dello Iacovo, Lorenzo Piran, Samuele Pozzebon, Stefano Manunza',
    'breadcrumb' => 'Chi siamo',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::template($replacements, $template);
?>