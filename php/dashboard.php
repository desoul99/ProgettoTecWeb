<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');
require_once('dbConnection.php');

$template = file_get_contents('../html/template.html');
$templateContatto = file_get_contents('../html/item_contatto.html');


if(!checkLogin()){
    header('Location: home.php');
    die();
}else{
    $loginSection = '';
    $navBar = navbar('Dashboard', false, true);
}

$DBConnection = new DBAccess;
if(!$DBConnection->openDBConnection()){
    die("Errore nella connessione al database. Contattare un amministratore.");
}
$listaContatti = $DBConnection->getContatti();
$DBConnection->closeDBConnection();

if($listaContatti){
    $contatti = '';
    foreach($listaContatti as $singleContatto){
        $singleContatto['rimuoviContatto'] = 'rimuovi_contatto.php?email='.$singleContatto['email'].'&amp;time='.urlencode($singleContatto['data']);
        $contatti .= Utils::template($singleContatto, $templateContatto);
    }
}else{
    $contatti = "<li><h2>Nessun messaggio di contatto presente nel sistema.</h2></li>";
}

$pageContent = Utils::template(array('currentPage' => 'dashboard.php'),file_get_contents('../html/signup_form.html'));
$pageContent .= Utils::template(array('contatti' => $contatti),file_get_contents('../html/dashboard_contatti.html'));



$replacements = array(
    'pageTitle' => 'Dashboard - Orient Review',
    'metaTitle' => 'Dashboard - Orient Review',
    'metaDescription' => 'Dashboard riservata agli utenti recensori del sito Orient Review',
    'metaKeywords' => 'recensioni, oriente, manga, anime, orientreview, fumetti, libri',
    'metaAuthors' => 'Marco Dello Iacovo, Lorenzo Piran, Samuele Pozzebon, Stefano Manunza',
    'breadcrumb' => 'Dashboard',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::template($replacements, $template);
?>