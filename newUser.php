<?php
  @ob_start();
  session_start();
?>
<html>
  <head>
    <?php
      include "core/_header.php";
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova isLogged
        //error_reporting(0);
        // inclusoine del file per la connessione al database
        include "core/dbConnection.php";
        include "core/getData.php";

        // se la session non esiste, allora integra la home al layout
        if (!$_SESSION['admin']){
          redirect('404.php');
        }
      }catch(Exception $e){
      }
     ?>
  </head>




 ?>
