<?php
require_once('utils.php');
require_once('navbar.php');
require_once('dbConnection.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/lista_recensioni.html');
$templateRecensione = file_get_contents('../html/item_recensione.html');

$isRecensore = false;
if(!checkLogin()){
    $loginSection = Utils::template(array('currentPage' => 'lista_recensioni.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Recensioni');
}else{
    $loginSection = '';
    $navBar = navbar('Recensioni', false, true);
    $isRecensore = true;
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
        $singleRecensione['testo'] = substr($singleRecensione['testo'], 0, 120);
        $singleRecensione['titolo'] = $singleRecensione['titolo_inglese'] ? '<span xml:lang="en">'.$singleRecensione['titolo'].'</span>' : $singleRecensione['titolo'];
        if($isRecensore){
            $singleRecensione['opzioniRecensore'] = '<a class="rimuovi-recensione" href="rimuovi_recensione.php?nome={{nome_recensione}}">Rimuovi recensione</a>'.PHP_EOL.'<a class="modifica-recensione" href="modifica_recensione.php?nome={{nome_recensione}}">Modifica recensione</a>';
            $singleRecensione['opzioniRecensore'] = Utils::template($singleRecensione, $singleRecensione['opzioniRecensore']);
        }else{
            $singleRecensione['opzioniRecensore'] = '';
        }
        $recensioni .= Utils::template($singleRecensione, $templateRecensione);
    }
    if($isRecensore){
        $pageContent = Utils::template(array('recensioni' => $recensioni, 'aggiuntaRecensione' => '<a href="aggiungi_recensione.php">Aggiungi recensione</a>'), $pageContent);
    }else{
        $pageContent = Utils::template(array('recensioni' => $recensioni, 'aggiuntaRecensione' => ''), $pageContent);
    }
    
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


echo Utils::template($replacements, $template);
?>