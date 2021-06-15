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
        $contatti .= Utils::template($singleContatto, $templateContatto);
    }
}else{
    $contatti = "<h2>Nessun messaggio di contatto presente nel sistema.</h2>";
}

$pageContent = Utils::template(array('contatti' => $contatti),file_get_contents('../html/dashboard_contatti.html'));
$pageContent .= Utils::template(array('currentPage' => 'dashboard.php'),file_get_contents('../html/signup_form.html'));


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


echo Utils::template($replacements, $template);
?>