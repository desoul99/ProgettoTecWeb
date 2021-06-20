<?php
require_once('dbConnection.php');
require_once('session.php');

deleteFeedback();

if (!checkLogin() || !isset($_POST['signup'])) {
	if (isset($_POST['previousPage'])) {
		header('Location: ' . $_POST['previousPage']);
	} else {
		header('Location: home.php');
	}
	die();
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$previousPage = $_POST['previousPage'] ?? '';
$passLen = strlen($password);

if (empty($username) || empty($password)) {
	$msg = 'Compila tutti i campi %s';
} elseif (filter_var($username, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-z\d_]{3,20}$/i"]]) === false) {
	$msg = "L'username deve contenere solamente caratteri alfanumerici e deve essere lungo almeno 3 e massimo 20 caratteri %s";
} elseif ($passLen < 5 || $passLen > 20) {
	$msg = 'La password deve essere lunga almeno 5 e massimo 20 caratteri %s';
} else {
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);
	$DBConnection = new DBAccess;
	if (!$DBConnection->openDBConnection()) {
		die("Errore nella connessione al database. Contattare un amministratore. %s");
	}
	$user = $DBConnection->getUser($username);
	if ($user === null) {
		if ($DBConnection->signUp($username, $passwordHash)) {
			$msg = 'Registrazione eseguita con successo %s';
			createSession($username);
		} else {
			$msg = "Errore nell'inserimento dei dati. Contattare un amministratore. %s";
		}
	} else {
		$msg = 'Username già in uso %s';
	}
	$DBConnection->closeDBConnection();
}

$msg = sprintf($msg, '<a href="dashboard.php">Torna indietro</a>');
createFeedback($msg, 'Home');
header('Location: risultato.php');
exit;

?>