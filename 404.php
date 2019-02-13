<html>
  <head>
    <?php
      include "core/_header.php";
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
            <a class="mdl-navigation__link style-text-green" href="explore.php">Scopri di più</a>
            <a class="mdl-navigation__link style-text-green" onclick="redirectLogin()" style="cursor:pointer">Login</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="core/logout.php">Home</a>
          <a class="mdl-navigation__link" onclick="redirectLogin()" style="cursor:pointer">Login</a>
          <a class="mdl-navigation__link" href="explore.php">Scopri di più</a>
        </nav>
      </div>
      <main class="mdl-layout__content" style="margin:0">
        <section class="mdl-cell--hide-desktop" style="width:100%;margin:35px">
          <h4 class="style-text-green" style="font-weight:500;display:inline">Curie</h4><h4 class="style-text-grey" style="font-weight:100;display:inline">Differenziata</h4>
        </section>
        <section>
          <div style="text-align:center">
            <h1 class="style-text-grey">Errore</h1>
            <h5 class="style-text-grey">Contatta l'amministratore</h5>
            <button class="style-special-button" onclick="location.href='core/logout.php'">Torna indietro</button>
            <br>
            <img src="img/404.svg" style="max-width:45%"/></img>
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
