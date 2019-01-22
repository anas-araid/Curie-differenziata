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
            <a class="mdl-navigation__link style-text-green" href="">Progetto</a>
            <a class="mdl-navigation__link style-text-green" href="core/logout.php" style="cursor:pointer">Logout</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="core/logout.php">Home</a>
          <a class="mdl-navigation__link" href="core/logout.php" style="cursor:pointer">Logout</a>
          <a class="mdl-navigation__link" href="">Progetto</a>
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
            <h2 class="style-text-grey">Controlli</h2>
            <hr style="width:100px;height:8px;border:5px solid white;border-radius:10px;background-color:#2ECC71">
            <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:100%;min-height:300px;">
              <?php include $_SESSION['curieInclude'] ?>
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
