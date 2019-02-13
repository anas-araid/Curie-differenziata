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

        // se la session non esiste, allora integra la home al layout
        if (!$_SESSION['admin']){
          redirect('404.php');
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
            <a class="mdl-navigation__link style-text-green" href="https://github.com/asdf1899/Curie-differenziata">Scopri di più</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="core/logout.php">Home</a>
          <a class="mdl-navigation__link" href="checking.php?back=true">Controlli</a>
          <a class="mdl-navigation__link" href="core/logout.php" style="cursor:pointer">Logout</a>
          <a class="mdl-navigation__link" href="https://github.com/asdf1899/Curie-differenziata">Scopri di più</a>
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
            <h2 class="style-text-grey">Nuovo operatore</h2>
            <hr style="width:100px;height:8px;border:5px solid white;border-radius:10px;background-color:#2ECC71">
            <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:100%;min-height:300px;text-align:center">
              <form action="core/addUser.php" method="POST" style="text-align:center">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="nome" name="nome" required="">
                  <label class="mdl-textfield__label" for="nome">Nome</label>
                </div><br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="cognome" name="cognome" required="">
                  <label class="mdl-textfield__label" for="cognome">Cognome</label>
                </div><br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="codice" name="codice">
                  <label class="mdl-textfield__label" for="codice">Codice</label>
                </div><br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="password" id="password" name="password" required="">
                  <label class="mdl-textfield__label" for="password">Password</label>
                </div><br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="password" id="confermaPassword" name="confermaPassword" required="">
                  <label class="mdl-textfield__label" for="confermaPassword">Conferma password</label>
                </div><br>
                <div>
                  <button class="style-special-button" type="submit" name="conferma">CONFERMA</button>
                  <br>
                  <button class="style-special-button" type="reset" onclick="location.href='checking.php?back=true'">INDIETRO</button>
                </div>
              </form>
            </div>
          </div>
          <div class="mdl-cell mdl-cell--1-col"></div>
        </section>
        <footer style="background:url(img/bg.svg);background-repeat:no-repeat;background-size:cover;margin-bottom:0;bottom:0;height:200px;z-index:-2000">
          <br>
          <br>
        </footer>
        <script>
           var password          = document.getElementById("password");
           var conferma_password = document.getElementById("confermaPassword");
           //var registrati        = document.getElementById("signup");
           function validaPassword() {
             if (password.value != conferma_password.value){
               conferma_password.setCustomValidity("Le password non corrispondono o la lunghezza è insufficiente");
             }else{
               conferma_password.setCustomValidity("");
             }
           }
           password.onchange         = validaPassword;
           conferma_password.onkeyup = validaPassword;
        </script>
      </main>
    </div>

  </body>
</html>
