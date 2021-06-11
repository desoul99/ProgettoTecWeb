<?php
require_once('utils.php');
require_once('navbar.php');
require_once('dbConnection.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/lista_recensioni.html');
$templateRecensione = file_get_contents('../html/item_recensione.html');

if(!checkLogin()){
    $loginSection = Utils::bind_to_template(array('currentPage' => 'lista_recensioni.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Recensioni');
}else{
    $loginSection = '';
    $navBar = navbar('Recensioni', false, true);
}

$DBConnection = new DBAccess;
if(!$DBConnection->openDBConnection()){
    die("Errore nella connessione al database. Contattare un amministratore.");
}
$listaRecensioni = $DBConnection->getRecensione();
$DBConnection->closeDBConnection();

if($listaRecensioni){
    $recensioni = '';
    foreach($listaRecensioni as $singleRecensione){
        $singleRecensione['testoRecensione'] = substr($singleRecensione['testoRecensione'], 0, 120);
        $recensioni .= Utils::bind_to_template($singleRecensione, $templateRecensione);
    }
    $pageContent = Utils::bind_to_template(array('recensioni' => $recensioni), $pageContent);
}else{
    $pageContent = "Nessuna recensione presente nel sistema.";
}


$replacements = array(
    'pageTitle' => 'Recensioni - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Recensioni',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::bind_to_template($replacements, $template);
?>