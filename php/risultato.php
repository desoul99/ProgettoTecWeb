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
    'pageTitle' => 'Risultato - Orient Review',
    'metaTitle' => 'Risultato - Orient Review',
    'metaDescription' => 'Risultato operazione nel sito Orient Review',
    'metaKeywords' => 'recensioni, oriente, manga, anime, orientreview, fumetti, libri',
    'metaAuthors' => 'Marco Dello Iacovo, Lorenzo Piran, Samuele Pozzebon, Stefano Manunza',
    'breadcrumb' => $breadcrumbs.' > Risultato',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);

$pageContent = Utils::template($replacements, $template);
echo str_replace('<a class="linktornasu" href="#content">Torna su</a>', '', $pageContent);
?>