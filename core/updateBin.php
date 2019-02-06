<html>
  <head>
    <title>Curie Differenziata</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="theme-color" content="#FFFFFF">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Anas Araid">
    <link type="text/css" rel="stylesheet" href="../css/reset.css" />
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/font-quicksand.css">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <script src="../js/script.js"></script>
    <script src="../js/sweetalert.js"></script>
  </head>
  <body>

    <?php
      include "dbConnection.php";
      include "getData.php";
      include "updateData.php";
      session_start();
      if (isset($_POST['salva'])){
        // estraggo il rating dal post
        if (isset($_POST['star'])){
          $rating = text_filter($_POST['star']);
        }else{
          $rating = 1;          
        }
        $file = 'scatta';
        if ($_FILES["carica"]["size"] != 0 && $_FILES["scatta"]["size"] != 0){
          $file = 'scatta';          
        }else if ($_FILES["carica"]["size"] == 0 && $_FILES["scatta"]["size"] != 0){
          $file = 'scatta';  
        }else if ($_FILES["carica"]["size"] != 0 && $_FILES["scatta"]["size"] == 0){
          $file = 'carica';  
        }
        $idCestino = text_filter($_POST['salva']);        
        $tempFile = $_FILES[$file]['tmp_name'];
        // se è stato caricato un file allora lo salvo sia nel db che nel server
        if ($tempFile != null){
          // se esiste gia una foto nel server, la cancello
          $currentBin = getCestino($idCestino, null, $db_conn);
          if ($currentBin['Foto'] != null){
            unlink($currentBin['Foto']);
          }
          do{
            $fileName = uniqid().".jpg";
            $dir = "uploads/".$fileName;        
          }while (checkIfPhotoExist($dir, $db_conn));
          move_uploaded_file($tempFile, "../".$dir);
        }else{
          $dir = '';
        }
        editCestino($idCestino, $dir, $rating);
        $idControllo = getIdControlloByCestini($idCestino, $db_conn);
        redirect('../showReport.php?id='.$idControllo);
      }

    ?>

  </body>

  </html>
