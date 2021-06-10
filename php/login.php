<?php
require_once('session.php');
require_once('dbConnection.php');

if (checkLogin()) {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $previousPage = $_POST['previousPage'] ?? '';
    
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
            $msg = 'Accesso effettuato correttamente %s';
            createSession($username);
        }
    }
    printf($msg, '<a href="'.$previousPage.'">Torna indietro</a>');
}
?>