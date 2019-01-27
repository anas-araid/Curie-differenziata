<?php
  session_start();
  //echo $_POST["rating_1"];
  if (isset($_POST["salva"])){
    //$target_dir = "uploads/";
    //$target_file = $target_dir . basename($_FILES["carica_1"]["name"]);
    //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    print_r($_FILES["carica_1"]);
    echo "<script>alert('".$_FILES['carica_1']['name']."')</script>";
  }

  $_SESSION['idCestino'] = $_SESSION['idCestino'] + 1;
  if ($_SESSION['idCestino'] <= $_SESSION['maxCestini']){
    header('location:../checking.php?bin='.$_SESSION['idCestino']);
  }


?>
