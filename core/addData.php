<?php
  function addCestino($foto, $voto, $tipologia, $db_conn){
    $sql = "INSERT INTO t_cestini (Foto, Valutazioni, FK_Tipologia) VALUES ('$foto', '$voto', '$tipologia')";
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

?>
