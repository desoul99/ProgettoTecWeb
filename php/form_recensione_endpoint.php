<?php
require_once('dbConnection.php');
require_once('session.php');
require_once('utils.php');
deleteFeedback();

if (!checkLogin() || !isset($_POST['submit']) || ($_POST['submit'] != 'Aggiungi' && $_POST['submit'] != 'Modifica')) {
	header('Location: lista_recensioni.php');
	die();
}

$nome_recensione = $_POST['nome_recensione'] ?? '';
$old_nome_recensione = $_POST['old_nome_recensione'] ?? '';
$autore = $_POST['autore'] ?? '';
$titolo = $_POST['titolo'] ?? '';
$titolo_inglese = $_POST['titolo_inglese'] ?? 'off';
$autore_opera = $_POST['autore_opera'] ?? '';
$testo = $_POST['testo'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$tags = $_POST['tags'] ?? '';
$alt_immagine = $_POST['alt_immagine'] ?? '';
$old_immagine = $_POST['old_immagine'] ?? '';
$voto = $_POST['voto'] ?? '';
$nome_recensione = Utils::cleanInput($nome_recensione);
$old_nome_recensione = Utils::cleanInput($old_nome_recensione);
$autore = Utils::cleanInput($autore);
$titolo = Utils::cleanInput($titolo);
$titolo_inglese = filter_var($titolo_inglese, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
$autore_opera = Utils::cleanInput($autore_opera, false);
$testo = Utils::cleanInput($testo, false);
$tipo = Utils::cleanInput($tipo);
$tags = Utils::cleanInput($tags);
$alt_immagine = Utils::cleanInput($alt_immagine);
$voto = Utils::cleanInput($voto);

$error = '';
$DBConnection = new DBAccess;

do{
    if(!$DBConnection->openDBConnection()){
        $error = "Errore nella connessione al database. Riprovare o contattare un amministratore. %s";
        break;
    }
    if(strlen($nome_recensione)>32 || strlen($nome_recensione) === 0 || !preg_match('/^[a-z_]{1,32}$/', $nome_recensione)){
        $error = "Nome recensione non valido. Deve contenere solo lettere minuscole, niente spazi, e deve avere meno di 32 caratteri %s";
        break;
    }
    if($_POST['submit'] === 'Modifica'){
        if(strlen($old_nome_recensione)>32 || strlen($old_nome_recensione) === 0 || !preg_match('/^[a-z_]{1,32}$/', $old_nome_recensione)){
            $error = "Errore. Contattare un amministratore. %s";
            break;
        }
    }
    if(strlen($autore)<=32 && strlen($autore) > 0){
        $listaRecensori = $DBConnection->getRecensori();
        $found = false;
        foreach($listaRecensori as $recensore){
            if($recensore['username'] === $autore){
                $found = true;
                break;
            }
        }
        if($found === false){
            $error = "Autore non presente nel sistema. %s";
            break;
        }
    }else{
        $error = "Autore non valido. Deve avere meno di 32 caratteri %s";
        break;
    }
    if(strlen($autore_opera)>128 || strlen($autore_opera) === 0){
        $error = "Autore opera non valido. Deve avere meno di 128 caratteri %s";
        break;
    }
    if(strlen($titolo)>128 || strlen($titolo) === 0){
        $error = "Titolo opera non valido. Deve avere meno di 128 caratteri %s";
        break;
    }
    if(strlen($testo)>4096 || strlen($testo) === 0){
        $error = "Testo non valido. Deve avere meno di 4096 caratteri %s";
        break;
    }
    if(strlen($tipo)>16 || strlen($titolo) === 0){
        $error = "Tipo non valido. Deve avere meno di 16 caratteri %s";
        break;
    }
    if(strlen($tags)>256 || strlen($tags) === 0){
        $error = "Tags non valide. Devono avere meno di 256 caratteri %s";
        break;
    }
    if(strlen($alt_immagine)>64){
        $error = "Alt immagine non valido. Deve avere meno di 64 caratteri %s";
        break;
    }
    if($voto != '1/5' && $voto != '2/5' && $voto != '3/5' && $voto != '4/5' && $voto != '5/5'){
        $error = "Voto non valido %s";
        break;
    }
    if($_POST['submit'] === 'Modifica'){
        if((!preg_match("/^[-0-9A-Z_\.]+(gif|jpg|jpeg|jpe|png)$/i", $old_immagine)) || strlen($old_immagine)>250){
            $error = "Errore. Contattare un amministratore. %s";
            break;
        }
    }
    if(!($_POST['submit'] === 'Modifica' && $_FILES['immagine']['error'] === 4)){
        if($_FILES['immagine']['error'] != 0 || !file_exists($_FILES['immagine']['tmp_name']) || !is_uploaded_file($_FILES['immagine']['tmp_name'])) {
            $error = "Errore nell'upload dell'immagine. Controlla che pesi meno di 100kB %s";
            break;
        }elseif((!preg_match("/^[-0-9A-Z_\.]+(gif|jpg|jpeg|jpe|png)$/i", $_FILES['immagine']['name'])) || strlen($_FILES['immagine']['name'])>250){
            $error = "Errore nell'upload dell'immagine. Il nome dell'immagine deve avere meno di 250 caratteri alfanumerici, trattini o punti. L'immagine può avere le seguenti estensioni: gif, jpg, jpeg, jpe, png %s";
            break;
        }
    }else{
        break;
    }
    if(!move_uploaded_file($_FILES['immagine']['tmp_name'], sprintf('../images/'.$_FILES['immagine']['name']))){
        $error = "Errore nell'upload dell'immagine. Riprovare o contattare un amministratore";
        break;
    }
}while(false);

if($error){
    $error = sprintf($error, '<a href="lista_recensioni.php">Torna indietro</a>');
    createFeedback($error, 'Recensioni');
    header('Location: risultato.php');
    die();
}

$immagine = $_FILES['immagine']['name'] ?? '';
$voto = substr($voto, 0,1);
if($_POST['submit'] === 'Modifica' && $_FILES['immagine']['error'] === 4){
    $result = $DBConnection->addEditRecensione($nome_recensione, $autore, $autore_opera, $titolo, $titolo_inglese, $testo, $tipo, $tags, $alt_immagine, $immagine, $voto, $old_nome_recensione);
}elseif($_POST['submit'] === 'Modifica'){
    $result = $DBConnection->addEditRecensione($nome_recensione, $autore, $autore_opera, $titolo, $titolo_inglese, $testo, $tipo, $tags, $alt_immagine, $immagine, $voto, $old_nome_recensione, true);
}else{
    $result = $DBConnection->addEditRecensione($nome_recensione, $autore, $autore_opera, $titolo, $titolo_inglese, $testo, $tipo, $tags, $alt_immagine, $immagine, $voto);
}

$DBConnection->closeDBConnection();

if($result === false){
    $msg = 'Errore nella connessione al database. Riprovare o contattare un amministratore. <a href="lista_recensioni.php">Torna indietro</a>';
    createFeedback($msg, 'Recensioni');
    header('Location: risultato.php');
    die();
}

if($_POST['submit'] === 'Modifica' && $_FILES['immagine']['error'] === 0 && $immagine != $old_immagine){
    error_reporting(0);
    unlink('../images/'.$old_immagine);
    error_reporting(-1);
}

if($_POST['submit'] === 'Modifica'){
    $msg = "Recensione modificata con successo. %s";
}else{
    $msg = "Recensione aggiunta con successo. %s";
}

$msg = sprintf($msg, '<a href="lista_recensioni.php">Torna indietro</a>');
createFeedback($msg, 'Recensioni');
header('Location: risultato.php');
die();
?>

