<?php
  session_start();
  include "dbConnection.php";
  include "getData.php";

  if (isset($_POST['find'])){
    $searchKeyword = text_filter($_POST['find']);
    // searchOperatori restituisce l'id dell'operatore
    $idOperatori = searchOperatori($searchKeyword, $db_conn);
    $idSezioni = searchSezioni($searchKeyword, $db_conn);
    $idIndirizzi = searchIndirizzi($searchKeyword, $db_conn);
    $reports = array();
    $reportsIndex = 0;
    if (isset($idOperatori)){
      for ($i=0;$i<count($idOperatori);$i++){
        $getReports = getReportsByOperatori($idOperatori[$i][0], $db_conn);
        for ($j=0; $j<count($getReports);$j++){
          $reports[$reportsIndex] = $getReports[$j][0];
          $reportsIndex++;
        }
      }
    }
    $idClass = array();
    $classIndex = 0;
    for ($i=0; $i<count($idSezioni);$i++){
      $getSearchSezioni = getClasseBySearch(null, $idSezioni[$i][0], $db_conn);
      for ($j=0; $j<count($getSearchSezioni);$j++){
        $idClass[$classIndex] = $getSearchSezioni[$j][0];
        $classIndex++;
      }
    }
    for ($i=0; $i<count($idIndirizzi);$i++){
      $getSearchIndirizzi = getClasseBySearch($idIndirizzi[$i][0], null, $db_conn);
      for ($j=0; $j<count($getSearchIndirizzi);$j++){
        $idClass[$classIndex] = $getSearchIndirizzi[$j][0];
        $classIndex++;
      }
    }
    $idClass = array_unique($idClass);
    // array_values() reindex an array starting by 0
    $idClass = array_values($idClass);
    $classReports = array();
    $classReportIndex = 0;
    for ($i=0;$i<count($idClass);$i++){
      $getClasseReport = getReportsByClasse($idClass[$i], $db_conn);
      for ($j=0; $j<count($getClasseReport);$j++){
        $classReports[$classReportIndex] = $getClasseReport[$j][0];
        $classReportIndex++;
      }
    }
    for ($i=0;$i<count($classReports);$i++){
      $reports[$reportsIndex] = $classReports[$i];
      $reportsIndex++;
    }
    $reports = array_unique($reports);
    $_SESSION['searchReport'] = $reports;
    return $reports;
  }

?>
