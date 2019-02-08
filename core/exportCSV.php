<?php
  @ob_start();
  session_start();
  include "dbConnection.php";
  include "getData.php";
  $controlli = getControlli(null, $db_conn);
  if ($controlli != false){
    $filedir = "../rapporti.csv";
    if (!file_exists($filedir)){
      $csv = fopen($filedir, "w");
    }else{
      unlink($filedir);
      $csv = fopen($filedir, "w");
    }
    fwrite($csv, "sep=,");
    fwrite($csv, "\n");
    fwrite($csv, "ID,");
    fwrite($csv, "Data,");
    fwrite($csv, "Operatore,");
    fwrite($csv, "Aula,");
    $tipologieCestini = getTipologieCestini(null, $db_conn);
    for ($j=0;$j<count($tipologieCestini);$j++){
      fwrite($csv, $tipologieCestini[$j][1].",");
    }
    for ($i=0;$i < count($controlli);$i++){
      $classe = getClasse($controlli[$i][3], null, $db_conn);
      $indirizzo = getIndirizzi($classe['FK_Indirizzo'], $db_conn);
      $sezione = getSezioni($classe['FK_Sezione'], $db_conn);
      $classeCompleta = ($sezione['Descrizione'] != '--') ? ($sezione['Descrizione'].' '.$indirizzo['Descrizione']) : ($indirizzo['Descrizione']);

      fwrite($csv, "\n");
      fwrite($csv, $controlli[$i][0].",");
      fwrite($csv, $controlli[$i][1].",");
      fwrite($csv, getOperatore($controlli[$i][2], $db_conn)['Nome'].' '.getOperatore($controlli[$i][2], $db_conn)['Cognome'].",");
      fwrite($csv, $classeCompleta.",");

      $cestiniByIdControllo = getCestiniByControllo($controlli[$i][0], $db_conn);
      for ($indexCurrentCestino = 0; $indexCurrentCestino<count($cestiniByIdControllo);$indexCurrentCestino++){
        fwrite($csv, $cestiniByIdControllo[$indexCurrentCestino][2].",");
      }

    }
  }
  fclose($csv);
  $_SESSION['reportCSV'] = true;
  redirect('../checking.php?back=true');
 ?>
