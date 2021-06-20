<?php
require_once('session.php');
require_once('dbConnection.php');
deleteFeedback();

if (checkLogin()) {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $previousPage = $_POST['previousPage'] ?? '';
    $previousPage = filter_var($previousPage, FILTER_SANITIZE_URL);
    
    if (empty($username) || empty($password)) {
        $msg = 'Username o password non validi %s';
    } else {
        $DBConnection = new DBAccess;
        if(!$DBConnection->openDBConnection()){
            die("Errore nella connessione al database. Contattare un amministratore. %s");
        }
        $user = $DBConnection->getUser($username);
        $DBConnection->closeDBConnection();

        if (!$user || password_verify($password, $user['password']) === false) {
            $msg = 'Credenziali errate %s';
        } else {
            createSession($username);
            header('Location: '.$previousPage);
            exit;
        }
    }
}else{
    $msg = "Errore nel login. Riprovare o contattare un amministratore. %s";
}

$msg = sprintf($msg, '<a href="'.$previousPage.'">Torna indietro</a>');

createFeedback($msg, 'Home');
header('Location: risultato.php');
exit;
?>