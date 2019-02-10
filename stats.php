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
        // inclusione del file per la connessione al database
        include "core/dbConnection.php";
        include "core/getData.php";

        $operatore = getOperatore($_SESSION['ID'], $db_conn);
        if ($operatore['ID'] == null){
          header('location:core/logout.php');
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
            <h2 class="style-text-grey">Statistiche</h2>
            <hr style="width:100px;height:8px;border:5px solid white;border-radius:10px;background-color:#2ECC71">
            <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:100%;min-height:300px;">
              <div style="text-align:center">
                <button class="style-special-button" style="width:70%;" onclick="location.href='checking.php?back=true'">INDIETRO</button>
              </div>
              <br>
              <script>
                function updateYears() {
                    var select = document.getElementById("anno").value;
                    if (select == 1){
                        window.location.href= '?year=""'
                    }else{
                      window.location.href= '?year=' + select;
                    }
                }
              </script>
              <div style="text-align:center">

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty is-upgraded" style="width:40%" data-upgraded=",MaterialTextfield">
                  <select id="anno" onchange="updateYears()" class="mdl-textfield__input" style="outline:none">
                    <option value="1">TUTTI</option>
                    <?php
                      $years = getReportYears($db_conn);
                      $annoSelezionato = "";
                      if (isset($_GET['year'])){
                        $annoSelezionato = $_GET['year'];
                        if (!in_array($annoSelezionato, $years)){
                          $annoSelezionato = "";
                        }
                      }
                      for ($i=0; $i < count($years); $i++){
                        $selected = "";
                        if ($annoSelezionato == $years[$i]){
                          $selected = "selected";
                        }
                        echo '<option value="'.$years[$i].'"  '.$selected.'>'.$years[$i].'</option>';
                      }

                    ?>
                  </select>
                  <label class="mdl-textfield__label" for="anno">Seleziona anno</label>
                </div>
                <button class="style-button-green"
                        type="reset"
                         onclick="allReports.open()">
                         RIEPILOGO CONTROLLI
                </button>
              </div>
            </div>
          </div>
          <div class="mdl-cell mdl-cell--1-col"></div>
          </div>
        </section>
        <?php
          $tuttiControlli = "'";
          $controlli = getNumControlli($annoSelezionato, "", $db_conn);
          for ($i=0; $i < sizeOf($controlli); $i++){
            if($controlli[$i][2]==1){
              $ctrl = "controllo";
            }else{
              $ctrl = "controlli";
            }

            $idClasse = $controlli[$i][1];
            $classe = getClasse($idClasse, null, $db_conn);
            $indirizzo = getIndirizzi($classe['FK_Indirizzo'], $db_conn);
            $sezione = getSezioni($classe['FK_Sezione'], $db_conn);
            $classeCompleta = ($sezione['Descrizione'] != '--') ? ($sezione['Descrizione'].' '.$indirizzo['Descrizione']) : ($indirizzo['Descrizione']);

            $n_controlli = $controlli[$i][2];
            $tuttiControlli .= "<b>$classeCompleta: </b> $n_controlli $ctrl <br>";
          }
          $tuttiControlli .= "'";
        ?>
        <script>
        var allReports = new tingle.modal({
                  closeMethods: ['overlay', 'button', 'escape'],
                  closeLabel: "Chiudi",
                  cssClass: ['custom-class-1', 'custom-class-2'],
                  onOpen: function() {
                      console.log('modal open');
                  },
                  onClose: function() {
                      console.log('modal closed');
                  },
                  beforeClose: function() {
                      return true; // close the modal
                      return false; // nothing happens
                  }
              });
          allReports.setContent(
            '<h2 class="style-text-green">Tutti i controlli<h2>'+
            '<div>'+
            '<ul class="mdl-list">'+
            <?php echo $tuttiControlli ?> +
            '</ul>'+
            '</div>'
          );
        </script>
        <footer style="background:url(img/bg.svg);background-repeat:no-repeat;background-size:cover;margin-bottom:0;bottom:0;height:200px;z-index:-2000">
          <br>
          <br>
        </footer>
      </main>
    </div>
  </body>
</html>
