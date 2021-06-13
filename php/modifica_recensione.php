<?php
require_once('utils.php');
require_once('navbar.php');
require_once('session.php');
require_once('dbConnection.php');

$template = file_get_contents('../html/template.html');

if(!checkLogin() || !isset($_GET['nome'])){
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
$recensione = $DBConnection->getRecensione($_GET['nome'])[0];
$listaRecensori = $DBConnection->getRecensori();
$DBConnection->closeDBConnection();

$selezione = array(
    'selected1' => '',
    'selected2' => '',
    'selected3' => '',
    'selected4' => '',
    'selected5' => '',
);

$selezione['selected'.$recensione['voto']] = ' selected="selected"';
if($recensione['titolo_inglese'] === '1'){
    $recensione['titolo_inglese'] = ' checked="checked"';
}else{
    $recensione['titolo_inglese'] = '';
}
$recensione['testo'] = htmlentities($recensione['testo'], ENT_XHTML); #non posso avere span in un textarea, poi tolgo l'escape nell'endpoint
$recensoriOptions = '';
foreach($listaRecensori as $recensore){
    if($recensore['username'] === $recensione['autore']){
        $recensoriOptions .= '<option selected="selected">'.$recensore['username'].'</option>';
    }else{
        $recensoriOptions .= '<option>'.$recensore['username'].'</option>';
    }
}
$immagine = '<input type="hidden" name="old_immagine" value="'.$recensione['immagine'].'" />';
$old_nome_recensione = '<input type="hidden" name="old_nome_recensione" value="'.$recensione['nome_recensione'].'" />';
$recensione = array_merge($recensione, $selezione);
$recensione = array_merge($recensione, array('listaRecensori' => $recensoriOptions, 'old_immagine' => $immagine, 'old_nome_recensione' => $old_nome_recensione));
$recensione = array_merge($recensione, array('legend' => 'Modifica recensione', 'formValue' => 'Modifica'));

$pageContent = Utils::template($recensione, file_get_contents('../html/form_recensione.html'));

$replacements = array(
    'pageTitle' => 'Modifica Recensione - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Recensioni > Modifica recensione',
    'navBar' => $navBar,
    'pageContent' => $pageContent,
    'login' => $loginSection,
    'scripts' => '',
    'bodyOptions' => '',
);


echo Utils::template($replacements, $template);
?>