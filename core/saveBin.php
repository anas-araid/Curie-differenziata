<?php
  include "dbConnection.php";
  include "getData.php";
  include "addData.php";
  include "updateData.php";

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
    $tempFile = session_id().'_'.$tempValutazione[$_SESSION['idTipologiaCestino']][0].'.jpg';
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
      //print_r($valutazioni);
      $data = date('Y/m/d h:i', time());
      addControllo($data, $_SESSION['ID'], $_SESSION['IdClasse'], $db_conn);
      $controlli = getControlliByUserDate($data, $_SESSION['ID'], $_SESSION['IdClasse'], $db_conn);
      for ($i=0; $i < count($maxCestini); $i++){
        $idTipologia = $maxCestini[$i];
        $voto = $valutazioni[$idTipologia][1];
        $oldFile = '../uploads/'.session_id().'_'.$idTipologia.'.jpg';
        do{
          $foto = uniqid().".jpg";
          $dir = 'uploads/'.$foto;
        }while (checkIfPhotoExist('../'.$dir, $db_conn));
        rename($oldFile, '../'.$dir);

        //addCestino($dir, $voto, $idTipologia, $db_conn);
      }

      /*for ($i=0; $i < count($maxCestini); $i++){
        // $cestino => Array ( [ID] => 1 [Foto] => [Valutazioni] => 2 [FK_Tipologia] => 1 )
        $cestino = getCestino(null, $maxCestini[$i], $db_conn);
        // ERRORE GRAVE FACENDO COSI SI PRENDONO I PRIMI CESTINI CON QUELLI ID CHE POTREBBERO ESSERE INFINITE
        // BISOGNA TROVARE UN MODO PER RENDERE IL NOME DELLA FOTO UNIVOCO
        $idCestino = $cestino[0][0];
        $idTipologia = $maxCestini[$i];
        $voto = $valutazioni[$idTipologia][1];
        print_r($cestino);
        echo 'maxCestini: '.$idTipologia;
        echo "cestino: ".$idCestino."\n";
        $oldFile = '../uploads/'.session_id().'_'.$idTipologia.'.jpg';
        $newFile = '../uploads/'.$idCestino.'.jpg';
        rename($oldFile, $newFile);
        $foto = 'uploads/'.$idCestino.'.jpg';
        updateCestino($idCestino, $foto, $voto, $idTipologia, $db_conn);
      }*/
      // libera le session per un altro controllo
      $_SESSION['valutazioni'] = array();
      $_SESSION['maxCestini'] = array();
      $_SESSION['idTipologiaCestino'] = '';
    }
  }

?>
