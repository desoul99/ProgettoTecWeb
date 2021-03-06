<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');

$template = file_get_contents('../html/html5template.html');
$pageContent = file_get_contents('../html/uscite.html');

if(!checkLogin()){
    $loginSection = Utils::template(array('currentPage' => 'uscite.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Calendario uscite');
}else{
    $loginSection = '';
    $navBar = navbar('Calendario uscite', false, true);
}

$replacements = array(
    'pageTitle' => 'Calendario uscite - Orient Review',
    'metaTitle' => 'Calendario uscite - Orient Review',
    'metaDescription' => 'Calendario delle prossime uscite di anime e manga',
    'metaKeywords' => 'recensioni, oriente, manga, anime, orientreview, fumetti, libri, calendariouscite',
    'metaAuthors' => 'Marco Dello Iacovo, Lorenzo Piran, Samuele Pozzebon, Stefano Manunza',
    'breadcrumb' => 'Calendario uscite',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


$pageContent = Utils::template($replacements, $template);
echo str_replace('xml:lang', 'lang', $pageContent);
?>