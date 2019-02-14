<?php
  @ob_start();
  session_start();
?>
<html>
  <head>
    <?php
      include "core/_header.php";
      include 'core/getData.php';
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova
        error_reporting(0);
        // inclusione del file per la connessione al database
        include "core/dbConnection.php";

        $operatore = getOperatore($_SESSION['ID'], $db_conn);
        if ($operatore['ID'] == null){
          header('location:core/logout.php');
        }

        // se la session non esiste, allora integra i contolli al layout
        if (!$_SESSION['curieInclude']){
          $_SESSION = array();
          $_SESSION['curieInclude'] = 'core/lists.php';
        }
        if (isset($_GET['back'])) {
          $_SESSION['curieInclude'] = 'core/lists.php';
          $_SESSION['search'] = null;
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
            <a class="mdl-navigation__link style-text-green" href="explore.php">Scopri di più</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="core/logout.php">Home</a>
          <a class="mdl-navigation__link" href="checking.php?back=true">Controlli</a>
          <a class="mdl-navigation__link" href="core/logout.php" style="cursor:pointer">Logout</a>
          <a class="mdl-navigation__link" href="explore.php">Scopri di più</a>
          <hr>
          <a class="mdl-navigation__link" href="https://asdf1899.github.io" target="_blank">Creato da Anas Araid</a>
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
            <h2 class="style-text-grey">Nuovo</h2>
            <hr style="width:100px;height:8px;border:5px solid white;border-radius:10px;background-color:#2ECC71">
            <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:100%;min-height:300px;text-align:center">
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--1-col"></div>
                <div class="mdl-cell mdl-cell--10-col mdl-cell--10-col-tablet">
                  <form action="core/checkReport.php" method="post">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <script>
                        function updateIndirizzi(){
                          var select = document.getElementById("indirizzo").value;
                          if (select == 0){
                            window.location.href= '?key=""';
                          }else{
                            window.location.href= '?key=' + select;
                          }
                        }
                      </script>
                      <select class="mdl-textfield__input" id="indirizzo" name="indirizzo" required="" style="outline:none" onchange="updateIndirizzi()">
                        <?php
                          echo "<option value='0'>----</option>";
                          // inserisco nel menu a tendina tutti gli indirizzi nel database
                          $indirizzi = getIndirizzi(null, $db_conn);
                          $indirizzoSelezionato = "";
                          if (isset($_GET['key'])){
                            $key = $_GET['key'];
                            $indirizzoSelezionato = $key;
                          }
                          for ($i=0; $i < count($indirizzi); $i++){
                            $selected = "";
                            if ($indirizzoSelezionato == $indirizzi[$i][0]){
                              $selected = "selected";
                            }
                            echo "<option value='".$indirizzi[$i][0]."' ".$selected.">".$indirizzi[$i][1]."</option>";
                          }
                        ?>
                      </select>
                      <label class="mdl-textfield__label" for="indirizzo">Indirizzo</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <select class="mdl-textfield__input" id="classe" name="classe" style="outline:none">
                        <?php
                          if (isset($_GET['key'])){
                            $key = $_GET['key'];
                            //echo "<script>document.getElementById('classe').disabled = 'false';</script>";
                            // inserisco nel menu a tendina tutte le classi relative all'indirizzo selezionato
                            $classi = getClasse(null, $key, $db_conn);
                            for ($i=0; $i < count($classi); $i++){
                              echo "<option value='".$classi[$i][0]."'>".getSezioni($classi[$i][1], $db_conn)['Descrizione']."</option>";
                            }
                          }
                        ?>
                      </select>
                      <label class="mdl-textfield__label" for="classe">Classe</label>
                    </div>
                    <div style="text-align:center">
                      <button class="style-special-button" style="width:60%;" type="submit">AVANTI</button>
                      <button class="style-special-button" style="width:60%;" onclick="location.href='checking.php?back=true'" type="reset">INDIETRO</button>
                    </div>
                  </form>
                </div>
              <div class="mdl-cell mdl-cell--1-col"></div>
            </div>
          </div>
          <div class="mdl-cell mdl-cell--1-col"></div>
        </section>
        <footer style="background:url(img/bg.svg);background-repeat:no-repeat;background-size:cover;margin-bottom:0;bottom:0;height:200px;z-index:-2000">
          <br>
          <br>
        </footer>
      </main>
      </div>


  </body>
</html>
