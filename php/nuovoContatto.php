<?php  //pagina raggiunta dall'utente
require_once('utils.php');
require_once('session.php');
deleteFeedback();

$paginaHTML = file_get_contents('..' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR .'contatti.html');//importo HTML con form
require_once __DIR__ . DIRECTORY_SEPARATOR . "dbConnection.php";

$flag = FALSE;

if(isset($_POST['submit'])){

  $mail = $_POST['mail'] ?? '';
  $nome = $_POST['nome'] ?? '';
  $oggetto = $_POST['oggetto'] ?? '';
  $messaggio = $_POST['messaggio'] ?? '';
  $nome = Utils::cleanInput($nome);
  $mail = Utils::cleanInput($mail);
  $oggetto = Utils::cleanInput($oggetto);
  $messaggio = Utils::cleanInput($messaggio);
  $controlMailFirst = explode("@", $mail);
  $controlMailSecond = explode(".", $controlMailFirst[1]);
  //controlli
  if (strlen($nome) >= 2 && !preg_match("/\d/", $nome) && strlen($oggetto) >= 5 && !preg_match("/\d/", $oggetto) && strlen($messaggio) >= 5 &&
  filter_var($mail, FILTER_VALIDATE_EMAIL) && strlen($controlMailFirst[0]) >= 3 && strlen($controlMailSecond[0]) >= 2 &&
  strlen($controlMailSecond[1]) >= 2){
    //inserire info nel db
    $dbAcces = new DBAccess();
    $openDBConnection = $dbAcces->openDBConnection();
    $risultato = $dbAcces->inserisciContatto($nome, $mail, $oggetto, $messaggio);
    if($risultato == true){//inserimento ok
      $flag = TRUE;
    }
  }
}

if($flag === TRUE){
  $msg = "Dati inseriti correttamente, verrete ricontattati al più presto. %s";
}else{
  $msg = "Errore nell' inserimento contatto. Riprovare o contattare un amministratore. %s";
}

$msg = sprintf($msg, '<a href="contatti.php">Torna indietro</a>');

createFeedback($msg, 'Contatti');
header('Location: risultato.php');
exit;
?>
