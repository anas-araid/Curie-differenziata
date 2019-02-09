<?php
  function addCestino($foto, $voto, $tipologia, $controllo, $db_conn){
    $sql = "INSERT INTO t_cestini (Foto, Valutazioni, FK_Tipologia, FK_Controllo) VALUES ('$foto', '$voto', '$tipologia', '$controllo')";
    try {
      $addCestino = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      echo "
      <script>
        flatAlert('Errore', 'Errore nell\'aggiunta del cestino: contattare l\'amministratore);
      </script>";
      echo $e;
    }
  }
  function addControllo($data, $FK_Operatore, $FK_Classe, $db_conn){
    $sql = "INSERT INTO t_controlli (Data, FK_Operatore, FK_Classe) VALUES ('$data', '$FK_Operatore', '$FK_Classe')";
    try {
      $addControllo = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      echo "
      <script>
        flatAlert('Errore', 'Errore nell\'aggiunta del cestino: contattare l\'amministratore);
      </script>";
    }
  }
  function addUser($nome, $cognome, $codice, $password, $db_conn){
    $sql = "INSERT INTO t_operatori (Nome, Cognome, Codice, Password) VALUES ('$nome', '$cognome', '$codice', '$password')";
    try {
      $addUser = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
?>
