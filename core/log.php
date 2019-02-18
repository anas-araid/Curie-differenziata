<?php
  session_start();
  include "functions.php";
  // raccoglie i dati del client
  $ipaddress = $_SERVER['REMOTE_ADDR'];
  $timestamp = date('d/m/Y H:i:s');
  $browser = $_SERVER['HTTP_USER_AGENT'];
  $line = "Connessione: [".$timestamp."] - ".$_SESSION['Nome']." ".$_SESSION['Cognome']." - ".$ipaddress." - ".$browser."\n";
  $filename = "log.txt";
  $filedir = "../logs/$filename";
  // salva nel log di accesso i dati del client
  if (!file_exists($filedir)){
    $log = fopen($filedir, "w");
  }else{
    $log = fopen($filedir, "a+");
  }
  fwrite($log, $line);
  fclose($log);
  // imposto la session alla lista dei controlli poi faccio il redirect
  $_SESSION['curieInclude'] = 'core/lists.php';
  redirect("../checking.php");
?>
