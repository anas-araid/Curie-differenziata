<?php
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

?>
