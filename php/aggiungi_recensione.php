<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');
require_once('dbConnection.php');

$template = file_get_contents('../html/template.html');

if(!checkLogin()){
    header('Location: lista_recensioni.php');
    die();
}else{
    $loginSection = '';
    $navBar = navbar('Recensioni', true, true);
}

$DBConnection = new DBAccess;
if(!$DBConnection->openDBConnection()){
    die("Errore nella connessione al database. Contattare un amministratore.");
}
$listaRecensori = $DBConnection->getRecensori();
$DBConnection->closeDBConnection();

$recensione = array(
    'selected1' => '',
    'selected2' => '',
    'selected3' => '',
    'selected4' => '',
    'selected5' => '',
    'nome_recensione' => '',
    'titolo' => '',
    'titolo_inglese' => '',
    'autore_opera' => '',
    'testo' => '',
    'tipo' => '',
    'tags' => '',
    'alt_immagine' => '',
    'legend' => 'Aggiungi nuova recensione',
    'formValue' => 'Aggiungi',
    'old_immagine' => '',
    'old_nome_recensione' => ''
);

$recensoriOptions = '';
foreach($listaRecensori as $recensore){
    $recensoriOptions .= '<option>'.$recensore['username'].'</option>';
}
$recensione = array_merge($recensione, array('listaRecensori' => $recensoriOptions));

$pageContent = Utils::template($recensione, file_get_contents('../html/form_recensione.html'));

$replacements = array(
    'pageTitle' => 'Aggiunta Recensione - Orient Review',
    'metaTitle' => 'Aggiunta Recensione - Orient Review',
    'metaDescription' => 'Pagina di aggiunta recensione del sito Orient Review',
    'metaKeywords' => 'recensioni, oriente, manga, anime, orientreview, fumetti, libri, calendariouscite',
    'metaAuthors' => 'Marco Dello Iacovo, Lorenzo Piran, Samuele Pozzebon, Stefano Manunza',
    'breadcrumb' => 'Recensioni > Aggiungi recensione',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => ''
);


echo Utils::template($replacements, $template);
?>