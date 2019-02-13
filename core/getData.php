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
      $sql = "SELECT * FROM t_controlli ORDER BY Data DESC";
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
        $controlli["$i"] = array($ris['ID'], $ris['Data'], $ris['FK_Operatore'], $ris['FK_Classe']);
        $i++;
      }else{
        $controlli['ID'] = $ris['ID'];
        $controlli['Data'] = $ris['Data'];
        $controlli['FK_Operatore'] = $ris['FK_Operatore'];
        $controlli['FK_Classe'] = $ris['FK_Classe'];
      }
    }
    return $controlli;
  }
  function getControlliByUserDate($Data, $FK_Operatore, $FK_Classe, $db_conn){
    $controlli = array();
    $sql = "SELECT * FROM t_controlli WHERE (Data='$Data' and FK_Operatore='$FK_Operatore' and FK_Classe='$FK_Classe')";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $controlli["$i"] = array($ris['ID'], $ris['Data'], $ris['FK_Operatore'], $ris['FK_Classe']);
      $i++;
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
    while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
      //$_SESSION['include'] = ' ';
      $operatore = getOperatore($id, $db_conn);
      $_SESSION['ID'] = $operatore['ID'];
      $_SESSION['Nome'] = $operatore['Nome'];
      $_SESSION['Cognome'] = $operatore['Cognome'];
      $_SESSION['Codice'] = $operatore['Codice'];
    }
    return $operatore;
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
        $classi["$i"] = array($ris['ID'], $ris['FK_Sezione'], $ris['FK_Indirizzo']);
        $i++;
      }else{
        $classi['ID'] = $ris['ID'];
        $classi['FK_Sezione'] = $ris['FK_Sezione'];
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
  function getCestino($ID, $FK_Tipologia, $db_conn){
    $cestini = array();
    $query = "";
    if ($FK_Tipologia != null){
      $query = "WHERE FK_Tipologia='".$FK_Tipologia."'";
    }
    if ($ID == null){
      $sql = "SELECT * FROM t_cestini ".$query;
    }else{
      $sql = "SELECT * FROM t_cestini WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $cestini["$i"] = array($ris['ID'], $ris['Foto'], $ris['Valutazioni'], $ris['FK_Tipologia'], $ris['FK_Controllo']);
        $i++;
      }else{
        $cestini['ID'] = $ris['ID'];
        $cestini['Foto'] = $ris['Foto'];
        $cestini['Valutazioni'] = $ris['Valutazioni'];
        $cestini['FK_Tipologia'] = $ris['FK_Tipologia'];
        $cestini['FK_Controllo'] = $ris['FK_Controllo'];
      }
    }
    return $cestini;
  }
  function checkIfPhotoExist ($foto, $db_conn){
    $sql = "SELECT * FROM t_cestini WHERE (Foto='$foto')";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      return false;
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      return true;
    }
    return false;
  }
  function getSezioni($ID, $db_conn){
    $sezioni = array();
    if ($ID == null){
      $sql = "SELECT * FROM t_sezioni";
    }else{
      $sql = "SELECT * FROM t_sezioni WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $sezioni["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else{
        $sezioni['ID'] = $ris['ID'];
        $sezioni['Descrizione'] = $ris['Descrizione'];
      }
    }
    return $sezioni;
  }
  function getCestiniByControllo($idControllo, $db_conn){
    $cestini = array();
    if ($idControllo == null){
      return false;
    }else{
      $sql = "SELECT * FROM t_cestini WHERE (FK_Controllo='$idControllo')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $cestini["$i"] = array($ris['ID'], $ris['Foto'], $ris['Valutazioni'], $ris['FK_Tipologia'], $ris['FK_Controllo']);
      $i++;
    }
    return $cestini;
  }
  function getIdControlloByCestini($ID, $db_conn){
    $controllo = null;
    if ($ID == null){
      return false;
    }else{
      $sql = "SELECT FK_Controllo FROM t_cestini WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $controllo = $ris['FK_Controllo'];
    }
    return $controllo;
  }
  function searchOperatori($search, $db_conn){
    $operatori = array();
    if ($search == null){
      return false;
    }else{
      $sql = "SELECT * FROM t_operatori WHERE Concat(Nome, ' ', Cognome) LIKE "."'%$search%'"."";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $operatori["$i"] = array($ris['ID'], $ris['Nome'], $ris['Cognome'], $ris['Codice']);
      $i++;
    }
    return $operatori;
  }
  function searchSezioni($search, $db_conn){
    $sezioni = array();
    if ($search == null){
      return false;
    }else{
      $sql = "SELECT * FROM t_sezioni WHERE Descrizione LIKE "."'%$search%'"."";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $sezioni["$i"] = array($ris['ID'], $ris['Descrizione']);
      $i++;
    }
    return $sezioni;
  }
  function searchIndirizzi($search, $db_conn){
    $indirizzi = array();
    if ($search == null){
      return false;
    }else{
      $sql = "SELECT * FROM t_indirizzi WHERE Descrizione LIKE "."'%$search%'"."";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $indirizzi["$i"] = array($ris['ID'], $ris['Descrizione']);
      $i++;
    }
    return $indirizzi;
  }
  function getReportsByOperatori($idOperatori, $db_conn){
    $reports = array();
    $sql = "SELECT * FROM t_controlli WHERE FK_Operatore='$idOperatori'";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $reports["$i"] = array($ris['ID'], $ris['Data'], $ris['FK_Operatore'], $ris['FK_Classe']);
      $i++;
    }
    return $reports;
  }
  function getClasseBySearch($idIndirizzo, $idSezioni, $db_conn){
    $classe = array();
    $sql = "SELECT * FROM t_classi WHERE ";
    $query = '';
    if ($idIndirizzo!= null && $idSezioni){
      $query = "FK_Sezione='$idSezioni' AND FK_Indirizzo='$idIndirizzo'";
    }else if ($idIndirizzo == null && $idSezioni != null){
      $query = "FK_Sezione='$idSezioni'";
    }else if ($idIndirizzo !=null && $idSezioni == null){
      $query = "FK_Indirizzo='$idIndirizzo'";
    }
    $risultato = mysqli_query($db_conn, $sql.$query);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $classe["$i"] = $ris['ID'];
      $i++;
    }
    return $classe;
  }
  function getReportsByClasse($classe, $db_conn){
    $reports= array();
    $sql = "SELECT * FROM t_controlli WHERE FK_Classe='$classe'";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $reports["$i"] = array($ris['ID'], $ris['Data'], $ris['FK_Operatore'], $ris['FK_Classe']);
      $i++;
    }
    return $reports;
  }
  function getClassFromReport($anno, $db_conn){
    if ($anno){
      $anno = " WHERE YEAR(Data) = '$anno'";
    }
    $sql = "SELECT DISTINCT FK_Classe FROM t_controlli $anno";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $classi = array();
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $classi[$i] = $ris["FK_Classe"];
      $i++;
    }
    return $classi;
  }
  function getRatingByReport($anno, $db_conn){
    if ($anno){
      $anno = " YEAR(Data) = '$anno'";
    }else{
      $anno = ' ';
    }
    $sql = "SELECT Valutazioni FROM t_controlli WHERE FK_Controllo  $anno";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $rating = array();
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $rating[$i] = $ris["Valutazioni"];
      $i++;
    }
    return $rating;
  }
  // GET STATISTICS
  function getReportYears($db_conn){
    $sql = "SELECT YEAR(Data) as anno FROM t_controlli GROUP BY anno DESC";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $years = array();
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $years[$i] = $ris["anno"];
      $i++;
    }
    return $years;
  }
  function getNumControlli($anno, $isFrequent, $db_conn){
    $frequent = "";
    if ($isFrequent){
      $frequent = " ORDER BY n_controlli DESC LIMIT 5";
    }
    if ($anno){
      $anno = "WHERE YEAR(Data) = '$anno'";
    }else{
      $anno = ' ';
    }
    $report = array();
    $sql = "SELECT FK_Classe AS Classe, COUNT(FK_Classe) AS n_controlli, ID AS id FROM t_controlli $anno GROUP BY FK_Classe".$frequent;
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $report[$i] = array($ris['id'], $ris['Classe'], $ris['n_controlli']);
      $i++;
    }
    return $report;
  }
  function getNumControlliAnnuali($anno, $db_conn){
    if ($anno){
      $anno = "WHERE YEAR(Data) = '$anno'";
    }else{
      $anno = ' ';
    }
    $report = array();
    $sql = "SELECT COUNT(FK_Classe) AS n_controlli, MONTH(Data) as mese FROM t_controlli $anno GROUP BY MONTH(Data)";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $month = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];
    for ($i=0; $i < 12; $i++){
      $report[$i] = array($month[$i], 0);
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $report[$ris["mese"]-1][1] = $ris["n_controlli"];
      $i++;
    }
    return $report;
  }
?>
