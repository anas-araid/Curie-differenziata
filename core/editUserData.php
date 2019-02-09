<?php
  @ob_start();
  session_start();
  include 'dbConnection.php';
  include 'getData.php';
  include 'updateData.php';
 ?>
<html>
  <head>
    <script src="../js/script.js"></script>
    <script src="../js/sweetalert.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/font-quicksand.css">
  </head>
  <body>
    <?php
      if (!$error_message) {
        if (isset($_POST['conferma'])){
          $id = text_filter($_POST["conferma"]);
          $nome = text_filter($_POST["nome"]);
          $cognome = text_filter($_POST["cognome"]);
          $codice = text_filter($_POST["codice"]);
          $password = text_filter($_POST["password"]);
          if (!empty($password)){
            $password = text_filter_encrypt($password);
            $updateUser = updateUser($id, $nome, $cognome, $codice, $password, $db_conn);
          }else{
            $updateUser = updateUser($id, $nome, $cognome, $codice, null, $db_conn);
          }
          if ($updateUser){
           echo "
           <script>
             flatAlert('', 'Operatore aggiornato con successo', 'success', '../checking.php?back=true');
           </script>";
          }else{
           echo "
           <script>
             flatAlert('Errore', 'Errore nell\'aggiornamento dell\'operatore: contattare l\'amministratore', 'error', '../checking.php?back=true');
           </script>";
          }
        }
      }
    ?>
  </body>
</html>
