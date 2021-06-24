<?php
require_once('utils.php');
require_once('navbar.php');
require_once('dbConnection.php');
require_once('session.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/lista_recensioni_content.html');
$gruppoRecensioni = file_get_contents('../html/lista_recensioni.html');
$templateRecensione = file_get_contents('../html/item_recensione.html');

$isRecensore = false;
if(!checkLogin()){
    $loginSection = Utils::template(array('currentPage' => 'lista_recensioni.php'),file_get_contents('../html/login_form.html'));
    $navBar = navbar('Recensioni');
    $aggiuntaRecensione = '';
}else{
    $loginSection = '';
    $navBar = navbar('Recensioni', false, true);
    $aggiuntaRecensione = '<a class="linkaiuto" href="aggiungi_recensione.php">Aggiungi recensione</a>';
    $isRecensore = true;
}


$DBConnection = new DBAccess;
if(!$DBConnection->openDBConnection()){
    die("Errore nella connessione al database. Contattare un amministratore.");
}
$listaRecensioni = $DBConnection->getRecensione();
$DBConnection->closeDBConnection();

$lettere = array();
$contentRecensioni = '';
$prevletter = '';
if($listaRecensioni){
    $recensioni = '';
    foreach($listaRecensioni as $singleRecensione){
        $letter = $singleRecensione['nome_recensione'][0];
        $singleRecensione['voto'] = $singleRecensione['voto'].'/5';
        $singleRecensione['testo'] = Utils::html_cut($singleRecensione['testo'], 120);
        $singleRecensione['titolo'] = $singleRecensione['titolo_inglese'] ? '<span xml:lang="en">'.$singleRecensione['titolo'].'</span>' : $singleRecensione['titolo'];
        $singleRecensione['immagine'] = explode('.',$singleRecensione['immagine'])[0];
        if($isRecensore){
            $singleRecensione['opzioniRecensore'] = '<a class="rimuovi-recensione linkaiuto" href="rimuovi_recensione.php?nome={{nome_recensione}}">Rimuovi recensione</a>'.PHP_EOL.'<a class="modifica-recensione linkaiuto" href="modifica_recensione.php?nome={{nome_recensione}}">Modifica recensione</a>';
            $singleRecensione['opzioniRecensore'] = Utils::template($singleRecensione, $singleRecensione['opzioniRecensore']);
        }else{
            $singleRecensione['opzioniRecensore'] = '';
        }
        if(isset($lettere[$letter]) ? count($lettere[$letter]) : false){
            $lettere[$letter][] = $singleRecensione;
        }else{
            if(count($lettere)){
                $contentRecensioni .= Utils::template(array('recensioni' => $recensioni, 'letteraId' => $prevletter), $gruppoRecensioni);
                $recensioni = '';
            }
            $lettere[$letter] = [$singleRecensione];
        }
        $recensioni .= Utils::template($singleRecensione, $templateRecensione);
        $prevletter = $letter;
    }
    $contentRecensioni .= Utils::template(array('recensioni' => $recensioni, 'letteraId' => $letter), $gruppoRecensioni);
}else{
    $contentRecensioni = '<p id="feedback">Nessuna recensione presente nel sistema.</p>';
}

$aiutiLettere = '';
foreach($lettere as $lettera => $value){
    $aiutiLettere .= '<a class="hide-block" href="#'.$lettera.'">Salta alla lettera '.$lettera.'</a> ';
}

$pageContent = Utils::template(array('aiutiLettere' => $aiutiLettere, 'aggiuntaRecensione' => $aggiuntaRecensione, 'listaRecensioni' => $contentRecensioni), $pageContent);

$replacements = array(
    'pageTitle' => 'Recensioni - Orient Review',
    'metaTitle' => 'Recensioni - Orient Review',
    'metaDescription' => 'Lista recensioni del sito Orient Review',
    'metaKeywords' => 'recensioni, oriente, manga, anime, orientreview, fumetti, libri',
    'metaAuthors' => 'Marco Dello Iacovo, Lorenzo Piran, Samuele Pozzebon, Stefano Manunza',
    'breadcrumb' => 'Recensioni',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::template($replacements, $template);
?>