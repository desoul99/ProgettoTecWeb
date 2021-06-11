<?php  //pagina raggiunta dall'utente
$paginaHTML = file_get_contents('..' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR .'contatti.html');//importo HTML con form
$paginaHTMLConferma = file_get_contents('..' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR .'corretto.html');//importo HTML con form
require_once __DIR__ . DIRECTORY_SEPARATOR . "dbConnection.php";

$mail = '';
$nome = '';
$oggetto = '';
$messaggio = '';

$flag = FALSE;

function cleanInput($value){
  //elimino spazi
  $value = trim($value);
  //rimuovo tag html
  $value = strip_tags($value);
  return $value;
}

if(isset($_POST['submit'])){

  $nome = cleanInput($_POST['nome']);
  $mail = cleanInput($_POST['mail']);
  $oggetto = cleanInput($_POST['oggetto']);
  $messaggio = cleanInput($_POST['messaggio']);
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

if($flag == true)
  echo $paginaHTMLConferma;
?>
