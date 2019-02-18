<?php
  session_start();
  include "dbConnection.php";
  include "getData.php";
  // se la chiave è impostata
  if (isset($_POST['find'])){
    // filtra il testo
    $searchKeyword = text_filter($_POST['find']);
    $_SESSION['searchKeyword'] = $searchKeyword;
    // searchOperatori restituisce l'id dell'operatore
    $idOperatori = searchOperatori($searchKeyword, $db_conn);
    // searchSezioni restituisce l'id delle sezioni
    $idSezioni = searchSezioni($searchKeyword, $db_conn);
    // searchIndirizzi restituisce l'id degli indirizzi
    $idIndirizzi = searchIndirizzi($searchKeyword, $db_conn);

    $reports = array();
    $reportsIndex = 0;
    // contiene la lista di id degli operatori
    if (isset($idOperatori)){
      for ($i=0;$i<count($idOperatori);$i++){
        // getReportsByOperatori ritorna un array con gli id controlli
        $getReports = getReportsByOperatori($idOperatori[$i][0], $db_conn);
        for ($j=0; $j<count($getReports);$j++){
          // inserisce nell'array $reports gli id dei controlli
          $reports[$reportsIndex] = $getReports[$j][0];
          $reportsIndex++;
        }
      }
    }
    // i due for inseriscono nell'array $idClass gli id delle classi in base alle sezioni ed indirizzi
    $idClass = array();
    $classIndex = 0;
    for ($i=0; $i<count($idSezioni);$i++){
      $getSearchSezioni = getClasseBySearch(null, $idSezioni[$i][0], $db_conn);
      for ($j=0; $j<count($getSearchSezioni);$j++){
        $idClass[$classIndex] = $getSearchSezioni[$j];
        $classIndex++;
      }
    }
    for ($i=0; $i<count($idIndirizzi);$i++){
      $getSearchIndirizzi = getClasseBySearch($idIndirizzi[$i][0], null, $db_conn);
      for ($j=0; $j<count($getSearchIndirizzi);$j++){
        $idClass[$classIndex] = $getSearchIndirizzi[$j];
        $classIndex++;
      }
    }
    // elimina valori uguali
    $idClass = array_unique($idClass);
    // array_values() reindex an array starting by 0
    $idClass = array_values($idClass);
    $classReports = array();
    $classReportIndex = 0;
    for ($i=0;$i<count($idClass);$i++){
      // restituisce i controlli in base alle classi
      $getClasseReport = getReportsByClasse($idClass[$i], $db_conn);
      for ($j=0; $j<count($getClasseReport);$j++){
        $classReports[$classReportIndex] = $getClasseReport[$j][0];
        $classReportIndex++;
      }
    }
    // inserisce nell'array $reports gli id dei controlli
    for ($i=0;$i<count($classReports);$i++){
      $reports[$reportsIndex] = $classReports[$i];
      $reportsIndex++;
    }
    // elimina i valori uguali
    $reports = array_unique($reports);
    $_SESSION['searchReports'] = $reports;
    $_SESSION['curieInclude'] = 'core/lists.php';
    redirect('../checking.php');
    return $reports;
  }

?>
