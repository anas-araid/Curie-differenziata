<?php
  @ob_start();
  session_start();
?>
<html>
  <head>
    <?php
      include "core/_header.php";
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova
        error_reporting(0);
        // inclusoine del file per la connessione al database
        include "core/dbConnection.php";
        include "core/getData.php";
        $operatore = getOperatore($_SESSION['ID'], $db_conn);
        $loggedIn = ($operatore['ID'] != null);
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
            <?php
              if($loggedIn){
                echo '<a class="mdl-navigation__link style-text-green" href="checking.php?back=true">Controlli</a>';
                echo '<a class="mdl-navigation__link style-text-green" href="core/logout.php" style="cursor:pointer">Logout</a>';
              }else{
                echo '<a class="mdl-navigation__link style-text-green" onclick="redirectLogin()" style="cursor:pointer">Login</a>';
              }
            ?>
            <a class="mdl-navigation__link style-text-green" href="explore.php">Scopri di più</a>
            <img src="img/mc.png" style="height:100%;z-index:10;cursor:pointer" onclick="window.open('https://www.curiepergine.gov.it')"></img>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="core/logout.php">Home</a>
          <?php
            if($loggedIn){
              echo '<a class="mdl-navigation__link style-text-green" href="checking.php?back=true">Controlli</a>';
              echo '<a class="mdl-navigation__link style-text-green" href="core/logout.php" style="cursor:pointer">Logout</a>';
            }else{
              echo '<a class="mdl-navigation__link style-text-green" onclick="redirectLogin()" style="cursor:pointer">Login</a>';
            }
          ?>
          <a class="mdl-navigation__link" href="explore.php">Scopri di più</a>
          <hr>
          <a class="mdl-navigation__link" href="https://asdf1899.github.io" target="_blank">Creato da Anas Araid</a>
          <hr>
          <div class="mdl-cell--hide-desktop" style="text-align:center">
            <img src="img/mc.png" style="width:50%;height:auto;z-index:10;cursor:pointer" onclick="window.open('https://www.curiepergine.gov.it')"></img>
          </div>
        </nav>
      </div>
      <main class="mdl-layout__content" style="margin:0">
        <section class="mdl-cell--hide-desktop" style="width:100%;margin:35px">
          <h4 class="style-text-green" style="font-weight:500;display:inline">Curie</h4><h4 class="style-text-grey" style="font-weight:100;display:inline">Differenziata</h4>
        </section>
        <section>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--1-col"></div>
            <div class="mdl-cell mdl-cell--10-col mdl-cell--10-col-tablet">
              <br>
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
              <div style="text-align:center">
                <br>
                <h3 class="style-text-darkGrey">Per un ambiente più pulito.</h3><br>
                <h4 class="style-text-grey">
                  La raccolta differenziata è il miglior modo per preservare e mantenere le risorse naturali.<br>
                  Riciclare, riusare e valorizzare i rifiuti, dalla carta alla plastica, dal vetro alle pile esauste
                  contribuisce a conservare un ambiente più ricco.
                </h4><br><br>
              </div><br>
              <div class="mdl-grid" style="text-align:center">
                <div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet">
                  <img src="img/explore1.png" style="max-height:80px">
                  <h5>Ridurre</h5>
                </div>
                <div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet">
                  <img src="img/explore2.png" style="max-height:80px">
                  <h5>Riutilizzare</h5>
                </div>
                <div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet">
                  <img src="img/explore3.png" style="max-height:80px">
                  <h5>Riciclare</h5>
                </div>
              </div>
              <br><br>
            </div>
            <div class="mdl-cell mdl-cell--1-col"></div>
          </div>

        </section>
        <section>
          <div style="text-align:center;background:url(img/bg.jpg);background-repeat:no-repeat;background-size:cover;margin:0;bottom:0;background-attachment: fixed;padding:20px">
            <h3 class="style-text-white">Differenziamo 2.0</h3><br>
            <h4 class="style-text-white">
              Il progetto <i>Differenziamo 2.0</i>, promosso dall'istituto <b>Marie Curie</b>: principale polo scolastico dell'Alta Valsugana, mira
              al monitoraggio dell'andamento delle attività di differenziazione tramite metodi di controlli e valutazione da parte dei
              collaboratori scolastici.<br> Per incentivare la collaborazione di tutti, verrà stilata una classifica parziale.
              Il comportamento virtuoso o negativo degli studenti nel differenziare i rifiuti, verrà segnalato al proprio coordinatore
              ed andrà ad influenzare il voto di capacità relazionale.
            </h4><br>
          </div>
        </section>
        <section>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--1-col"></div>
            <div class="mdl-cell mdl-cell--10-col mdl-cell--10-col-tablet">
              <div style="text-align:center;margin:30px">
                <h3 class="style-text-darkGrey">Responsabili</h3><br>
                <ul style="text-align:left;font-size:20px">
                  <li>Prof. Sebastiano Libri</li>
                  <li>Prof. Antonio Marasco</li>
                  <li>Prof.ssa Carla Zanei</li>
                </ul>
              </div>
              <div style="text-align:left;">
                <h5 class="style-text-darkGrey"><b>Telefono</b>: 0461 530226</h5>
                <h5 class="style-text-darkGrey"><b>Indirizzo</b>: Via S. Pietro, 24 - 38057 Pergine Valsugana (TN)</h5>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--1-col"></div>
          </div>
        </section>
        <section>
          <div class="mdl-grid" style="position:relative;background:url(img/bg.svg);background-repeat:no-repeat;background-size:cover;margin:0;bottom:0;min-height:300px">
            <h6 style="position:absolute;color:white;bottom:0">Curie Differenziata &copy 2019 Anas Araid</h6>
          </div>
        </section>
        <script>
          // faccio una get per il redirect alla pagina del login
          function redirectLogin(){
            location.href = "";
            location.href = "index.php?login=true";
          }
        </script>

      </main>
    </div>
  </body>
</html>
