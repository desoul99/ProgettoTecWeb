<?php
class DBAccess{
  private const HOST_DB = "localhost";//maiusc perchè const, senza $ le const
  private const USER = "root";
  private const PSW = "";
  private const NAME_DB = "orient_db";

  private $connection;//connessione verso db, istanzio quando vioglio aprire connessione, ogg di tipo connesione
  public function openDBConnection(){
    $this->connection = mysqli_connect(DBAccess::HOST_DB, DBAccess::USER, DBAccess::PSW, DBAccess::NAME_DB); //libreria per connessione ai DB di tipo mysql, essa restituisce ogg tipo connesione se andata a buon fine oppure false
    if (!$this->connection){
      return false;
    }
    else{
      return true;
    }
  }

  public function signUp($username, $password){
    $query = sprintf("INSERT INTO recensori VALUES ('%s', '%s')", mysqli_real_escape_string($this->connection, $username), mysqli_real_escape_string($this->connection, $password));
    if(mysqli_query($this->connection, $query)){
      return true;
    }else{
      return false;
    }
  }

  public function getUser($username){
    $query = sprintf("SELECT username, password FROM recensori WHERE username = '%s'", mysqli_real_escape_string($this->connection, $username));
    $queryResult = mysqli_query($this->connection, $query);
    if(mysqli_num_rows($queryResult) != 1){
      return null;
    }else{
      return mysqli_fetch_assoc($queryResult);
    }
  }

  public function getRecensione($nome = null){
      if($nome === null){
        $query = "SELECT * FROM recensioni ORDER BY nome_recensione ASC";
      }else{
        $query = sprintf("SELECT * FROM recensioni WHERE nome_recensione = '%s'", mysqli_real_escape_string($this->connection, $nome));
      }

      $queryResult = mysqli_query($this->connection, $query);

      if(mysqli_num_rows($queryResult) == 0){
        return null;
      }else{
        $listaRecensioni = array();
        while($row = mysqli_fetch_assoc($queryResult)){

          $singleRecensione = array(
            "nomeRecensione" => $row['nome_recensione'],
            "titoloRecensione" => $row['titolo'],
            "titoloInglese" => $row['titolo_inglese'],
            "altImmagine" => $row['alt_immagine'],
            "nomeAutore" => $row['autore_opera'],
            "autoreRecensione" => $row['autore'],
            "votoRecensione" => $row['voto'],
            "testoRecensione" => $row['testo'],
            "tagRecensione" => $row['tags'],
            "tipoRecensione" => $row['tipo'],
          );

          array_push($listaRecensioni, $singleRecensione);
        }
        return $listaRecensioni;
      }
  }
  public function closeDBConnection(){
    mysqli_close($this->connection);
  }
  public function inserisciContatto($nome, $mail, $oggetto, $messaggio){
    $this->date = date('Y-m-d H:i:s');
    $query_insert = "INSERT INTO contatto(email, data, oggetto, testo, nome) VALUES (\"$mail\", \"$this->date\", \"$oggetto\", \"$messaggio\", \"$nome\")";

    $queryResult = mysqli_query($this->connection, $query_insert);

    if ($queryResult){
      return true;
    }
    else{
      return false;
    }
  }
}
?>
