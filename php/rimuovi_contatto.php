<?php
require_once('session.php');
require_once('dbConnection.php');

deleteFeedback();

if (!checkLogin() || !isset($_GET['email']) || !isset($_GET['time'])) {
	header('Location: lista_recensioni.php');
	exit;
}

$email = $_GET['email'] ?? '';
$time = $_GET['time'] ?? '';


if (empty($email) || empty($time)) {
	$msg = 'Email o data contatto non validi %s';
} else {
	$DBConnection = new DBAccess;
    if (!$DBConnection->openDBConnection()) {
    	die("Errore nella connessione al database. Riprovare o contattare un amministratore. %s");
    }
	$result = $DBConnection->removeContatto($email, $time);
	$DBConnection->closeDBConnection();

	if ($result) {
        $msg = 'Contatto rimosso correttamente %s';
	} else {
		$msg = 'Errore nella rimozione. Riprovare o contattare un amministratore. %s';
	}
}

$msg = sprintf($msg, '<a href="dashboard.php">Torna indietro</a>');

createFeedback($msg, 'Dashboard');
header('Location: risultato.php');
exit;
?>