<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');


$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/contatti.html');

if(!checkLogin()){
    $loginSection = Utils::template(array('currentPage' => 'contatti.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Contatti');
}else{
    $loginSection = '';
    $navBar = navbar('Contatti', false, true);
}


$replacements = array(
    'pageTitle' => 'Contatti - Orient Review',
    'metaTitle' => 'Contatti - Orient Review',
    'metaDescription' => 'Informazioni e form di contatto del sito Orient Review',
    'metaKeywords' => 'recensioni, oriente, manga, anime, orientreview, fumetti, libri, contatti',
    'metaAuthors' => 'Marco Dello Iacovo, Lorenzo Piran, Samuele Pozzebon, Stefano Manunza',
    'breadcrumb' => 'Contatti',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '<script type="text/javascript" src="../js/controllo.js"></script>',
    'bodyOptions' => ' onload="caricamento();"'
);


echo Utils::template($replacements, $template);
?>