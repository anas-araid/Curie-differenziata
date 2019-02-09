<?php

  function updateCestino($ID, $Foto, $Voto, $Tipologia, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $sql = "UPDATE t_cestini SET Foto='$Foto', Valutazioni='$Voto', FK_Tipologia='$Tipologia' WHERE (ID='$ID')";
      $updateCestino = mysqli_query($db_conn, $sql);
      if ($updateCestino==null){
        echo "
        <script>
        flatAlert('Errore', 'Errore nell\'aggiornamento del cestino: contattare l\'amministratore);
        </script>";
      }
    }
  }
  function editCestino($ID, $Foto, $Voto, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $sql = "UPDATE t_cestini SET Foto='$Foto', Valutazioni='$Voto' WHERE (ID='$ID')";
      $updateCestino = mysqli_query($db_conn, $sql);
      if ($updateCestino==null){
        echo "
        <script>
        flatAlert('Errore', 'Errore nell\'aggiornamento del cestino: contattare l\'amministratore);
        </script>";
      }
    }
  }
  function updateUser($ID, $nome, $cognome, $codice, $password, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      if ($password == null){
        $sql = "UPDATE t_operatori SET Nome='$nome', Cognome='$cognome', Codice='$codice' WHERE (ID='$ID')";
      }else{
        $sql = "UPDATE t_operatori SET Nome='$nome', Cognome='$cognome', Codice='$codice', Password='$password' WHERE (ID='$ID')";
      }
      $updateUser = mysqli_query($db_conn, $sql);
      if ($updateUser==null){
        return false;
      }
      return true;
    }
  }

?>
