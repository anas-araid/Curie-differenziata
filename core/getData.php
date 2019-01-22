<?php
  include 'functions.php';
  function getOperatore($ID, $db_conn){
    $operatore = array();
    if ($ID == null){
      $sql = "SELECT * FROM t_operatori";
    }else{
      $sql = "SELECT * FROM t_operatori WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $operatore["$i"] = array($ris['ID'], $ris['Nome'], $ris['Cognome'], $ris['Codice'], $ris['Password']);
        $i++;
      }else{
        $operatore['ID'] = $ris['ID'];
        $operatore['Nome'] = $ris['Nome'];
        $operatore['Cognome'] = $ris['Cognome'];
        $operatore['Codice'] = $ris['Codice'];
        $operatore['Password'] = $ris['Password'];
      }
    }
    return $operatore;
  }
  function getControlli($ID, $db_conn){
    $controlli = array();
    if ($ID == null){
      $sql = "SELECT * FROM t_controlli";
    }else{
      $sql = "SELECT * FROM t_controlli WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $controlli["$i"] = array($ris['ID'], $ris['Data'], $ris['FK_Operatore'], $ris['FK_Cestino'], $ris['FK_Classe']);
        $i++;
      }else{
        $controlli['ID'] = $ris['ID'];
        $controlli['Data'] = $ris['Data'];
        $controlli['FK_Operatore'] = $ris['FK_Operatore'];
        $controlli['FK_Cestino'] = $ris['FK_Cestino'];
        $controlli['FK_Classe'] = $ris['FK_Classe'];
      }
    }
    return $controlli;
  }
  function checkPassword($id, $password, $db_conn){
    $selectQuery = "SELECT * FROM t_operatori WHERE ID='$id' AND Password='$password'";
    $select = mysqli_query($db_conn, $selectQuery);
    if ($select==null){
      die('error');
        //throw new exception ("Impossibile aggiornare l'utente");
    }
    $esistenzaUtente = false;
    while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
      $esistenzaUtente = true;
      //$_SESSION['include'] = ' ';
      $operatore = getOperatore($id, $db_conn);
      $_SESSION['ID'] = $operatore['ID'];
      $_SESSION['Nome'] = $operatore['Nome'];
      $_SESSION['Cognome'] = $operatore['Cognome'];
      $_SESSION['Codice'] = $operatore['Codice'];
    }
    return $esistenzaUtente;
  }
  function getIndirizzi($ID, $db_conn){
    $indirizzi = array();
    if ($ID == null){
      $sql = "SELECT * FROM t_indirizzi";
    }else{
      $sql = "SELECT * FROM t_indirizzi WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $indirizzi["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else{
        $indirizzi['ID'] = $ris['ID'];
        $indirizzi['Descrizione'] = $ris['Descrizione'];
      }
    }
    return $indirizzi;
  }
  function getClasse($idClasse, $idIndirizzo, $db_conn){
    $classi = array();
    $query = "";
    if ($idIndirizzo != null){
      $query = "WHERE FK_Indirizzo='".$idIndirizzo."'";
    }
    if ($idClasse == null){
      $sql = "SELECT * FROM t_classi ".$query;
    }else{
      $sql = "SELECT * FROM t_classi WHERE (ID='$idClasse')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($idClasse == null){
        $classi["$i"] = array($ris['ID'], $ris['Classe'], $ris['FK_Indirizzo']);
        $i++;
      }else{
        $classi['ID'] = $ris['ID'];
        $classi['Classe'] = $ris['Classe'];
        $classi['FK_Indirizzo'] = $ris['FK_Indirizzo'];
      }
    }
    return $classi;
  }
  function getTipologieCestini($ID, $db_conn){
    $tipologie = array();
    if ($ID == null){
      $sql = "SELECT * FROM t_tipologie";
    }else{
      $sql = "SELECT * FROM t_tipologie WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $tipologie["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else{
        $tipologie['ID'] = $ris['ID'];
        $tipologie['Descrizione'] = $ris['Descrizione'];
      }
    }
    return $tipologie;
  }
?>
