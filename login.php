<html>
  <head>
    <?php
      include "core/_header.php";
     ?>
  </head>
  <body style="margin:0">
    <div class="mdl-layout mdl-js-layout">
      <header class="mdl-layout__header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="">Login</a>
            <a class="mdl-navigation__link" href="">Progetto</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title style-text-green" style="font-weight:500">Curie</span><span class="mdl-layout-title style-text-grey" style="font-weight:100">Differenziata</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="">Login</a>
          <a class="mdl-navigation__link" href="">Progetto</a>
        </nav>
      </div>
      <main class="mdl-layout__content" style="margin:0">
        <section class="mdl-cell--hide-desktop" style="width:100%;margin:35px">
          <h4 class="style-text-green" style="font-weight:500;display:inline">Curie</h4><h4 class="style-text-grey" style="font-weight:100;display:inline">Differenziata</h4>
        </section>
        <section>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--7-col mdl-cell--6-col-tablet">
              <form action="" method="POST" style="text-align:center">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="number" id="codice" name="codice" required="">
                  <label class="mdl-textfield__label" for="codice">Codice</label>
                </div>
                <br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="password" id="confermaPassword" name="confermaPassword" required="">
                  <label class="mdl-textfield__label" for="confermaPassword">Password</label>
                </div>
                <div>
                  <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">Crea profilo</button>
                  <br>
                  <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="reset" onclick="location.href='core/logout.php'">Indietro</button>
                </div>
              </form>
            </div>
            <div class="mdl-cell mdl-cell--5-col mdl-cell--2-col-tablet mdl-cell--hide-phone">
              <img src="img/recycling.png" style="width:50%"></img>
            </div>
          </div>
          <div class="mdl-grid" style="background:url(img/bg.svg);background-repeat:no-repeat;background-size:cover;margin:0;bottom:0">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet">
              <img src="img/bg1.png" style="width:100%"></img>
              <div>
                <p style="color:white;font-size:1.6vw">Copyright 2018 Anas Araid in collaborazione con Marie Curie Pergine</p>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>
