<?php
  @ob_start();
  session_start();
?>
<html>
<head>
  <title>Curie Differenziata</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="theme-color" content="#FFFFFF">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Anas Araid">
  <link type="text/css" rel="stylesheet" href="../css/reset.css" />
  <link type="text/css" rel="stylesheet" href="../css/material.min.css" />
  <link type="text/css" rel="stylesheet" href="../css/style.css" />
  <link type="text/css" rel="stylesheet" href="../css/tingle.css" />
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/font-quicksand.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <script src="../js/material.js"></script>
  <script src="../js/script.js"></script>
  <script src="../js/sweetalert.js"></script>
  <script src="../js/tingle.js"></script>
  <script src="../js/chart.js"></script>
  <script src="../js/jquery.min.js"></script>
</head>
<body>
  <?php
    include "dbConnection.php";
    include "getData.php";
    $IdIndirizzo = text_filter($_POST['indirizzo']);
    if ($IdIndirizzo == 0){
      echo "<script>flatAlert('Attenzione', 'Inserisci un indirizzo', 'warning', '../newReport.php')</script>";
      return;
    }
    $IdClasse = text_filter($_POST['classe']);
    $indirizzo = getIndirizzi($IdIndirizzo, $db_conn);
    $_SESSION['IdIndirizzo'] = $indirizzo['ID'];
    $_SESSION['TipoIndirizzo'] = $indirizzo['Descrizione'];
    $_SESSION['IdClasse'] = '';
    $_SESSION['Classe'] = '';
    if ($IdClasse == 0){
      $classe = getClasse(null, $IdIndirizzo, $db_conn);
      if ($classe != null){
        echo "<script>flatAlert('Attenzione', 'Inserisci la classe', 'warning', '../newReport.php?key=".$IdIndirizzo."')</script>";
        return;
      }
    }else{
      $classe = getClasse($IdClasse, $IdIndirizzo, $db_conn);
      $_SESSION['IdClasse'] = $classe['ID'];
      $_SESSION['Classe'] = getSezioni($classe['FK_Sezione'], $db_conn)['Descrizione'];
    }
    $_SESSION['curieInclude'] = "core/recycleBin.php";
    redirect("../checking.php");
   ?>
 </body>
</html>
