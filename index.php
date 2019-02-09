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
        // error_reporting per togliere il notice quando non trova isLogged
        //error_reporting(0);
        // inclusoine del file per la connessione al database
        include "core/dbConnection.php";
        include "core/getData.php";
        if (isset($_GET['login'])){
          $_SESSION['curieInclude'] = "core/login.php";
          echo "<script>location.href='index.php'</script>";
        }
        // se la session non esiste, allora integra la home al layout
        if (!$_SESSION['curieInclude']){
          $_SESSION = array();
          $_SESSION['curieInclude'] = 'core/home.php';
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
            <a class="mdl-navigation__link style-text-green" onclick="redirectLogin()" style="cursor:pointer">Login</a>
            <a class="mdl-navigation__link style-text-green" href="https://github.com/asdf1899/Curie-differenziata">Progetto</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="core/logout.php">Home</a>
          <a class="mdl-navigation__link" onclick="redirectLogin()" style="cursor:pointer">Login</a>
          <a class="mdl-navigation__link" href="https://github.com/asdf1899/Curie-differenziata">Progetto</a>
          <hr>
          <a class="mdl-navigation__link" href="https://asdf1899.github.io" target="_blank">Creato da Anas Araid</a>
        </nav>
      </div>
      <main class="mdl-layout__content" style="margin:0">
        <section class="mdl-cell--hide-desktop" style="width:100%;margin:35px">
          <h4 class="style-text-green" style="font-weight:500;display:inline">Curie</h4><h4 class="style-text-grey" style="font-weight:100;display:inline">Differenziata</h4>
        </section>
        <section>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--7-col mdl-cell--6-col-tablet">
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
                if ($_SESSION['curieInclude'] != 'core/login.php' && $_SESSION['curieInclude'] != 'core/home.php'){
                  redirect("404.php");
                }
                // integra il file salvato nella session
                include $_SESSION['curieInclude'];
              ?>
            </div>
            <div class="mdl-cell mdl-cell--5-col mdl-cell--2-col-tablet mdl-cell--hide-phone">
              <img src="img/recycling.png" style="width:50%"></img>
            </div>
          </div>
          <div class="mdl-grid" style="background:url(img/bg.svg);background-repeat:no-repeat;background-size:cover;margin:0;bottom:0">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet">
              <img src="img/bg1.png" style="width:100%"></img>
            </div>
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
