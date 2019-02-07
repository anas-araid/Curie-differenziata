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
      for ($i=;$i<count($idOperatori);$i++){
        $reports[$reportsIndex] = getReportsByOperatori($idOperatori, $db_conn);
        $reportsIndex++;
      }
    }
    $idClass = array();
    $classIndex = 0;
    for ($i=0; $i<count($idSezioni);$i++){
      $idClass[$classIndex] = getClasseBySearch(null, $idSezioni[$i], $db_conn);
      $classIndex++;
    }
    for ($i=0; $i<count($idIndirizzi);$i++){
      $idClass[$classIndex] = getClasseBySearch($idIndirizzi[$i], null, $db_conn);
      $classIndex++;
    }
    $idClass = array_unique($idClass):
    $classe = getClasseBySearch($idIndirizzo, $idSezioni, $db_conn);
    $classReports = array();
    for ($i=0;$i<count($classe);$i++){
      $classReports[$i] = getReportsByClasse($classe[$i], $db_conn);
    }
    for ($i=0;$i<count($classReports);$i++){
      $reports[$reportsIndex] = $classReports[$i]['ID'];
    }
    $reports = array_unique($reports)
    $_SESSION['searchReport'] = $reports;
    return $reports;
  }

?>
