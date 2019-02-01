<html>
  <head>
    <?php
      include "core/_header.php";
      session_start();
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova isLogged
        //error_reporting(0);
        // inclusione del file per la connessione al database
        include "core/dbConnection.php";
        include "core/getData.php";

        $operatore = getOperatore($_SESSION['ID'], $db_conn);
        if ($operatore['ID'] == null){
          header('location:core/logout.php');
        }

        if (!$_SESSION['curieInclude']){
          $_SESSION = array();
          $_SESSION['curieInclude'] = 'core/lists.php';
        }
        if (isset($_GET['back'])) {
          $_SESSION['curieInclude'] = 'core/lists.php';
          $_SESSION['search'] = null;
        }
        if (isset($_GET['id'])){
          $id = $_GET['id'];
          $controlli = getControlli($id, $db_conn);
          if ($controlli['ID'] != null){
            $controlloOperatore = getOperatore($controlli['FK_Operatore'], $db_conn);
            $controlloClasse = getClasse($controlli['FK_Classe'], null, $db_conn);
            $controlloIndirizzo = getIndirizzi($controlloClasse['FK_Indirizzo'], $db_conn);
            $controlloSezione = getSezioni($controlloClasse['FK_Sezione'], $db_conn);
            $cestini = getCestiniByControllo($controlli['ID'], $db_conn);
            $controlloCompleto = [$controlloOperatore, $controlloIndirizzo, $controlloSezione, $cestini];
          }else{
            header('location:checking.php?back=true');
          }
        }else{
          header('location:checking.php?back=true');
        }
      }catch(Exception $e){
      }
     ?>
  </head>
  <body style="margin:0">
    <div class="mdl-layout mdl-js-layout">
      <header class="mdl-layout__header mdl-layout--fixed-header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link style-text-green" href="core/logout.php">Home</a>
            <a class="mdl-navigation__link style-text-green" href="checking.php?back=true">Controlli</a>
            <a class="mdl-navigation__link style-text-green" href="core/logout.php" style="cursor:pointer">Logout</a>
            <a class="mdl-navigation__link style-text-green" href="https://github.com/asdf1899/Curie-differenziata">Progetto</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="core/logout.php">Home</a>
          <a class="mdl-navigation__link" href="checking.php?back=true">Controlli</a>
          <a class="mdl-navigation__link" href="core/logout.php" style="cursor:pointer">Logout</a>
          <a class="mdl-navigation__link" href="https://github.com/asdf1899/Curie-differenziata">Progetto</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <section class="mdl-cell--hide-desktop" style="width:100%;margin:35px">
          <h4 class="style-text-green" style="font-weight:500;display:inline">Curie</h4><h4 class="style-text-grey" style="font-weight:100;display:inline">Differenziata</h4>
        </section>
        <section>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--1-col"></div>
            <div class="mdl-cell mdl-cell--10-col mdl-cell--10-col-tablet">
              <?php
                // variabile $error_message situata in dbConnection.php
                if ($error_message) {
                  echo "
                    <script>
                      window.onload = function(){
                        flatAlert('Accesso', 'Impossibile connettersi al database', 'error', '404.php');
                      }
                    </script>";
                }

              ?>
            <h2 class="style-text-grey">
              <?php
                if ($controlloCompleto[2]['Descrizione'] == '--'){
                  echo $controlloCompleto[1]['Descrizione'] ;
                }else{
                  echo $controlloCompleto[2]['Descrizione'].' '.$controlloCompleto[1]['Descrizione'] ;
                }
                ?>
            </h2>
            <hr style="width:100px;height:8px;border:5px solid white;border-radius:10px;background-color:#2ECC71">
            <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:100%;min-height:300px;">
              <div style="text-align:center">
                <button class="style-special-button" style="width:70%;" onclick="location.href='checking.php?back=true'">INDIETRO</button>
                <button class="style-special-button" style="width:70%;" onclick="location.href='editReport.php?id=<?php echo $controlli['ID'] ?>'">MODIFICA</button>
              </div>

              <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:100%;min-height:300px;text-align:center">
                <div style="overflow:auto">
                  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
                    <tbody>
                      <tr>
                        <td class="style-td"><h5>Orario:</h5></td>
                        <td class="style-td"><h5><b><?php echo date('d-m-Y H:i', strtotime($controlli['Data'])) ?></b></h5></td>
                        <td class="style-td"></td>
                      </tr>
                      <tr>
                        <td class="style-td"><h5>Operatore:</h5></td>
                        <td class="style-td"><h5><b><?php echo $controlloOperatore['Nome'].' '.$controlloOperatore['Cognome'] ?></b></h5></td>
                        <td class="style-td"></td>
                      </tr>
                      <?php
                        //print_r($controlloCompleto[3]);
                        for($i=0; $i < count($controlloCompleto[3]); $i++){
                          $controlloAttuale = $controlloCompleto[3][$i];
                          $tipologiaCestino = $controlloAttuale[3];
                          $votoCestino = $controlloAttuale[2];
                          $dirFoto = $controlloAttuale[1];
                          if (!file_exists($dirFoto)){
                            $dirFoto = "img/404.svg";
                          }
                          echo "<tr>";
                          echo "<td class='style-td'><h5>".getTipologieCestini($tipologiaCestino, $db_conn)['Descrizione'].":</h5></td>";
                          echo "<td class='style-td'>";
                          $img = "";

                          for ($j=0; $j < $votoCestino; $j++){
                            $img = $img."<img src='img/star.png' style='width:10%'></img>";
                          }
                          echo $img;
                          echo "</td>";
                          echo "<td class='style-td'>";
                          if ($dirFoto != null){
                            ?>
                            <a onclick="openModal(<?php echo "'$dirFoto'" ?>)" style="text-decoration:underline;cursor:pointer">Mostra immagine</a>
                            <?php
                          }else{
                            echo "<h6>Nessuna foto caricata</h6>";
                          }
                          echo "</td>";

                          echo "</tr>";
                        }
                       ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <script>
                var foto;
                var content = "";
                function openModal(photoDir){
                  this.foto = photoDir;
                  this.content = '<div><img id="idImmagine" src="'+foto+'" style="width:100%"></img><div>';
                  if (this.foto == "img/404.svg"){
                    this.content = '<div><h4>Immagine non disponibile</h4><img id="idImmagine" src="'+foto+'" style="width:100%"></img><div>';
                  }
                  modal.open();
                }
                var modal = new tingle.modal({
                    closeMethods: ['overlay', 'button', 'escape'],
                    closeLabel: "Chiudi",
                    cssClass: ['custom-class-1', 'custom-class-2'],
                    onOpen: function() {
                        console.log('modal open');
                        modal.setContent(
                          content
                        );
                    },
                    onClose: function() {
                        console.log('modal closed');
                    },
                    beforeClose: function() {
                        return true; // close the modal
                        return false; // nothing happens
                    }
                });
                console.log(this.content);
                //document.getElementById('idImmagine').src = foto;

              </script>

        </section>
        <footer style="background:url(img/bg.svg);background-repeat:no-repeat;background-size:cover;margin-bottom:0;bottom:0;height:200px;z-index:-2000">
          <br>
          <br>
        </footer>
      </main>
    </div>

  </body>
</html>
