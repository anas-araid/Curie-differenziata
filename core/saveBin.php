<?php
  include "dbConnection.php";
  include "getData.php";
  session_start();
  if (in_array($_SESSION['idTipologiaCestino'], $_SESSION['maxCestini'])){
    if (isset($_POST["salva"])){
      $file = 'scatta_';
      if ($_FILES["carica_".$_SESSION['idTipologiaCestino']]["size"] != 0 && $_FILES["scatta_".$_SESSION['idTipologiaCestino']]["size"] != 0){
        $file = 'scatta_';
      }elseif ($_FILES["carica_".$_SESSION['idTipologiaCestino']]["size"] == 0 && $_FILES["scatta_".$_SESSION['idTipologiaCestino']]["size"] != 0){
        $file = 'scatta_';
      }elseif ($_FILES["carica_".$_SESSION['idTipologiaCestino']]["size"] != 0 && $_FILES["scatta_".$_SESSION['idTipologiaCestino']]["size"] == 0){
        $file = 'carica_';
      }
      //echo $file;
      if (isset($_SESSION['valutazioni'])){
        $_SESSION['valutazioni'][$_SESSION['idTipologiaCestino']] =  [$_SESSION['idTipologiaCestino'], $_POST["rating_".$_SESSION['idTipologiaCestino']], $_FILES[$file.$_SESSION['idTipologiaCestino']]["tmp_name"]];
      }else{
        $valutazioni = array();
        $valutazioni[$_SESSION['idTipologiaCestino']] = [$_SESSION['idTipologiaCestino'], $_POST["rating_".$_SESSION['idTipologiaCestino']], $_FILES[$file.$_SESSION['idTipologiaCestino']]["tmp_name"]];
        $_SESSION['valutazioni'] = $valutazioni;
      }
    }
  }
  // ##############################################################################################################################
  // @@@@@@@@@@@@@@@@ LE FOTO DEVONO ESSERE SALVATE DOPO L INSERT DEI DATI COSI SI HA L ID DEL CESTINO @@@@@@@@@@@@@@@@
  // $valutazioni
  // Array ( [idTipologiaCestino] => Array ( [idTipologiaCestino] => 1 [Voto] => 1 [TempImage] => xampp\tmp\phpE0A1.tmp )
  // $valutazioni[$_SESSION['maxCestini'][$i]][0] ---> restituisce gli id della tipologia di cestini
  // ##############################################################################################################################


  if (in_array($_SESSION['idTipologiaCestino'], $_SESSION['maxCestini'])){
    // $position contiene l'index della tipologia di cestino all'interno di maxCestini
    $position = array_search($_SESSION['idTipologiaCestino'], $_SESSION['maxCestini']);
    // salvo temporaneamente le foto
    $tempValutazione = $_SESSION['valutazioni'];
    $tempRawImage = $tempValutazione[$_SESSION['idTipologiaCestino']][2];
    $tempFile = $tempValutazione[$_SESSION['idTipologiaCestino']][0].'.jpg';
    $dir = "../uploads/".$tempFile;
    if (!move_uploaded_file($tempRawImage, $dir)){
      //echo "Impossibile caricare l'immagine ";
    }else{
      //echo "foto caricata \n";
    }
    // se esistono ancora altre tipologie di cestini allora va avanti altrimenti vuol dire
    // che ha finito e inizia a salvare i dati nel db
    if (array_key_exists($position + 1, $_SESSION['maxCestini'])){
      $_SESSION['idTipologiaCestino'] = $_SESSION['maxCestini'][$position + 1];
      header('location:../checking.php?bin='.$_SESSION['idTipologiaCestino']);
    }else{
      $valutazioni = $_SESSION['valutazioni'];
      $maxCestini = $_SESSION['maxCestini'];
      print_r($valutazioni);
      // ... salvare tutte le robe nel db

      for ($i=0; $i < count($maxCestini); $i++){
        $oldFile = '../uploads/'.$maxCestini[$i].'.jpg';
        // '1_' sarebbe l'id del cestino che va salvato nel db
        $newFile = '../uploads/'.'1_'.$maxCestini[$i].'.jpg';
        rename($oldFile, $newFile);

        // libera le session per un altro controllo
        //$_SESSION['valutazioni'] = '';
        //$_SESSION['maxCestini'] = '';
        //$_SESSION['idTipologiaCestino'] = '';
      }

    }
  }

?>
