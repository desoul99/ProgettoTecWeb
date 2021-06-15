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
    return mysqli_query($this->connection, $query);
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

  public function getRecensori(){
    $query = sprintf("SELECT username FROM recensori");
    $queryResult = mysqli_query($this->connection, $query);
    if(mysqli_num_rows($queryResult) == 0){
      return null;
    }else{
      return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
  }

  public function getContatti(){
    $query = sprintf("SELECT * FROM contatto ORDER BY data DESC");
    $queryResult = mysqli_query($this->connection, $query);
    if(mysqli_num_rows($queryResult) == 0){
      return null;
    }else{
      return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
  }

  public function removeRecensione($nome){
    $query = sprintf("DELETE FROM recensioni WHERE nome_recensione = '%s'", mysqli_real_escape_string($this->connection, $nome));
    return mysqli_query($this->connection, $query);
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
        return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
      }
  }
  public function addEditRecensione($nome_recensione, $autore, $autore_opera, $titolo, $titolo_inglese, $testo, $tipo, $tags, $alt_immagine, $immagine, $voto, $old_nome_recensione = null, $update_image = false){
    $nome_recensione = mysqli_real_escape_string($this->connection, $nome_recensione);
    $autore = mysqli_real_escape_string($this->connection, $autore);
    $titolo = mysqli_real_escape_string($this->connection, $titolo);
    $titolo_inglese = mysqli_real_escape_string($this->connection, $titolo_inglese);
    $autore_opera = mysqli_real_escape_string($this->connection, $autore_opera);
    $testo = mysqli_real_escape_string($this->connection, $testo);
    $tipo = mysqli_real_escape_string($this->connection, $tipo);
    $tags = mysqli_real_escape_string($this->connection, $tags);
    $alt_immagine = mysqli_real_escape_string($this->connection, $alt_immagine);
    $immagine = mysqli_real_escape_string($this->connection, $immagine);
    $voto = mysqli_real_escape_string($this->connection, $voto);
    if($old_nome_recensione === null){
      $query = sprintf("INSERT INTO recensioni VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $nome_recensione, $autore, $autore_opera, $titolo, $titolo_inglese, $testo, $tipo, $tags, $alt_immagine, $immagine, $voto);
    }elseif($update_image){
      $query = sprintf("UPDATE recensioni SET nome_recensione = '%s', autore = '%s', autore_opera = '%s', titolo = '%s', titolo_inglese = '%s', testo = '%s', tipo = '%s', tags = '%s', alt_immagine = '%s', immagine = '%s', voto = '%s' WHERE nome_recensione = '%s'", $nome_recensione, $autore, $autore_opera, $titolo, $titolo_inglese, $testo, $tipo, $tags, $alt_immagine, $immagine, $voto, $old_nome_recensione);
    }else{
      $query = sprintf("UPDATE recensioni SET nome_recensione = '%s', autore = '%s', autore_opera = '%s', titolo = '%s', titolo_inglese = '%s', testo = '%s', tipo = '%s', tags = '%s', alt_immagine = '%s', voto = '%s' WHERE nome_recensione = '%s'", $nome_recensione, $autore, $autore_opera, $titolo, $titolo_inglese, $testo, $tipo, $tags, $alt_immagine, $voto, $old_nome_recensione);
    }
    return mysqli_query($this->connection, $query);
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
