<?php
require_once('session.php');
require_once('dbConnection.php');

deleteFeedback();

if (!checkLogin() || !isset($_GET['nome'])) {
	header('Location: lista_recensioni.php');
	exit;
}

$nome = $_GET['nome'] ?? '';

if (empty($nome)) {
	$msg = 'Nome recensione non valido %s';
} else {
	$DBConnection = new DBAccess;
	if (!$DBConnection->openDBConnection()) {
		die("Errore nella connessione al database. Riprovare o contattare un amministratore. %s");
	}
	$result = $DBConnection->removeRecensione($nome);
	$DBConnection->closeDBConnection();

	if ($result) {
        $msg = 'Recensione rimossa correttamente %s';
	} else {
		$msg = 'Errore nella rimozione. Riprovare o contattare un amministratore. %s';
		createSession($username);
	}
}

$msg = sprintf($msg, '<a href="lista_recensioni.php">Torna indietro</a>');

createFeedback($msg, 'Recensioni');
header('Location: risultato.php');
exit;
?>