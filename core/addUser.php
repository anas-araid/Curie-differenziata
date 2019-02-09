<?php
  @ob_start();
  session_start();
  include 'dbConnection.php';
  include 'getData.php';
  include 'addData.php';
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
          $nome = text_filter($_POST["nome"]);
          $cognome = text_filter($_POST["cognome"]);
          $codice = text_filter($_POST["codice"]);
          $password = text_filter_encrypt(text_filter($_POST["password"]));
          $addUser = addUser($nome, $cognome, $codice, $password, $db_conn);
          if ($addUser){
           echo "
           <script>
             flatAlert('', 'Operatore aggiunto con successo', 'success', '../checking.php?back=true');
           </script>";
          }else{
           echo "
           <script>
             flatAlert('Errore', 'Errore nell\'aggiunta dell\'operatore: contattare l\'amministratore', 'error', '../checking.php?back=true');
           </script>";
          }
        }
      }
    ?>
  </body>
</html>