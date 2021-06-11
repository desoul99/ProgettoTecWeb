<?php
require_once('utils.php');
require_once('navbar.php');
require_once('dbConnection.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/recensione.html');

if(!isset($_GET['nome'])){
    header("location: /lista_recensioni.php");
    die();
}

if(!checkLogin()){
    $loginSection = Utils::bind_to_template(array('currentPage' =>  $_SERVER['REQUEST_URI']), file_get_contents('../html/login_form.html'));
    $navBar = navbar('Recensioni', true);
}else{
    $loginSection = '';
    $navBar = navbar('Recensioni', true, true);
}

$DBConnection = new DBAccess;
if(!$DBConnection->openDBConnection()){
    die("Errore nella connessione al database. Contattare un amministratore.");
}
$recensione = $DBConnection->getRecensione($_GET['nome']);
$DBConnection->closeDBConnection();

$nonWrappedTitle = '';
$wrappedTitle = '';
if(!$recensione){
    $pageContent = "La recensione richiesta non è presente nel sistema.";
}else{
    $nonWrappedTitle = $recensione[0]['titoloRecensione'];
    $wrappedTitle = $recensione[0]['titoloInglese'] ? '<span xml:lang="en">'.$recensione[0]['titoloRecensione'].'</span>' : $recensione[0]['titoloRecensione'];
    $recensione[0]['titoloRecensione'] = $wrappedTitle;
    $pageContent = Utils::bind_to_template($recensione[0], $pageContent);
}

$replacements = array(
    'pageTitle' => $nonWrappedTitle.' - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Recensioni > '.$wrappedTitle,
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::bind_to_template($replacements, $template);
?>