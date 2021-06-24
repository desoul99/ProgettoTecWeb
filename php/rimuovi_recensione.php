<?php
require_once('session.php');
require_once('dbConnection.php');

deleteFeedback();

if (!checkLogin() || !isset($_GET['nome'])) {
	header('Location: lista_recensioni.php');
	exit;
}

$nome = $_GET['nome'] ?? '';

$DBConnection = new DBAccess;
if (!$DBConnection->openDBConnection()) {
	die("Errore nella connessione al database. Riprovare o contattare un amministratore. %s");
}
$recensione = $DBConnection->getRecensione($_GET['nome']);
$immagine = explode('.', $recensione[0]['immagine']);
$cssoldImage = <<<EOD

.img-$immagine[0] {
  background-image: url("../images/$immagine[0].$immagine[1]");
}

EOD;

if (empty($nome)) {
	$msg = 'Nome recensione non valido %s';
} else {
	
	
	$result = $DBConnection->removeRecensione($nome);
	$DBConnection->closeDBConnection();

	if ($result) {
        $msg = 'Recensione rimossa correttamente %s';
		error_reporting(0);
    	unlink('../images/'.$recensione[0]['immagine']);
    	error_reporting(-1);
		
		echo $cssoldImage;
		$cssFile1 = file_get_contents('../css/stile.css');
		$cssFile2 = file_get_contents('../css/print.css');
		$cssFile1 = str_replace($cssoldImage, '', $cssFile1);
		$cssFile2 = str_replace($cssoldImage, '', $cssFile2);
		file_put_contents('../css/stile.css', $cssFile1);
		file_put_contents('../css/print.css', $cssFile2);

	} else {
		$msg = 'Errore nella rimozione. Riprovare o contattare un amministratore. %s';
	}
}

$msg = sprintf($msg, '<a href="lista_recensioni.php">Torna indietro</a>');

createFeedback($msg, 'Recensioni');
header('Location: risultato.php');
exit;
?>