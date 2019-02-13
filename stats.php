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
                <!-- ###      SELEZIONA ANNO E RIEPILOGO CONTROLLI         ### -->

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty is-upgraded" style="width:40%" data-upgraded=",MaterialTextfield">
                  <select id="anno" onchange="updateYears()" class="mdl-textfield__input" style="outline:none">
                    <option value="1" selected>---</option>
                    <?php
                      $years = getReportYears($db_conn);
                      $annoSelezionato = false;
                      if (isset($_GET['year'])){
                        $annoSelezionato = $_GET['year'];
                        if (!in_array($annoSelezionato, $years)){
                          $annoSelezionato = false;
                        }
                      }else{
                        echo "<script>updateYears()</script>";
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

              <!-- ###      GRAFICO MEDIE VALUTAZIONI PIU' ALTE         ### -->
              <?php
                // restituisce distintamente le classi nei controlli
                $classi = getClassFromReport($annoSelezionato, $db_conn);
                $chartData = array();
                $chartLabel = array();
                $idControlli = array();
                $cestini = array();
                $reports = array();
                $ratings = array();
                for ($i=0;$i<count($classi);$i++){
                  $controllo = getReportsByClasse($classi[$i], $db_conn);
                  for ($j=0;$j<count($controllo);$j++){
                    $idControlli[$j] = $controllo[$j][0];
                  }
                  for ($t=0;$t<count($idControlli);$t++){
                    $cestini[$t] = getCestiniByControllo($idControlli[$t], $db_conn);
                  }
                  $ratingIndex = 0;
                  for ($c=0;$c<count($cestini);$c++){
                    for ($cc=0;$cc<count($cestini[$c]);$cc++){
                      $ratings[$ratingIndex] = $cestini[$c][$cc][2];
                      $ratingIndex++;
                    }
                  }
                  // reports contiene id della classe + un array con tutte le sue valutazioni
                  $reports[$i] = array($classi[$i], $ratings);
                }
                for ($j=0;$j<count($reports);$j++){
                  $classe = getClasse($reports[$j][0], null, $db_conn);
                  $indirizzo = getIndirizzi($classe['FK_Indirizzo'], $db_conn);
                  $sezione = getSezioni($classe['FK_Sezione'], $db_conn);
                  $classeCompleta = ($sezione['Descrizione'] != '--') ? ($sezione['Descrizione'].' '.$indirizzo['Descrizione']) : ($indirizzo['Descrizione']);
                  if ($reports[$j][1] != null){
                    $avgRating = array_sum($reports[$j][1]) / count($reports[$j][1]);
                  }

                  $valutazioniClassi[$j] = array($classeCompleta, round($avgRating, 2));
                }
                $maxRating = 5;
                if (count($valutazioniClassi) > $maxRating ){
                  usort($valutazioniClassi, function ($item1, $item2) {
                    if ($item1[1] == $item2[1]) return 0;
                    return $item1[1] < $item2[1] ? -1 : 1;
                  });
                  $valutazioniClassi = array_slice($valutazioniClassi, -$maxRating, $maxRating);
                }

                for ($i=0;$i<count($valutazioniClassi);$i++){
                  $chartData[$i] = $valutazioniClassi[$i][1];
                  $chartLabel[$i] = $valutazioniClassi[$i][0];
                }

                // conversione da array php a qullo javscript
                $chartLabel = json_encode($chartLabel);
                $chartData = json_encode($chartData);
              ?>
              <div style="text-align:center">
                <h5 class="style-text-green" style="text-align:center">Aule con le valutazioni medie più alte:</h5><br>
                <canvas id="chartMedieValutazioni" style="max-height:auto;max-width:350px;text-align:center;display:unset"></canvas>
              </div>
              <script>
                // lista colori
                chartColors = {
                  1: '#e74c3c',
                  2: '#e67e22',
                  3: '#2ecc71',
                  4: '#f1c40f',
                  5: '#3498db',
                  6: '#9b59b6',
                  7: '#34495e'
                };
                var colors = Array();
                for (var i=0; i < <?php echo $chartData ?>.length;i++){
                  colors[i]= chartColors[i+1];
                }
                var ctx = document.getElementById("chartMedieValutazioni").getContext('2d');
                var data = {
                  labels: <?php echo $chartLabel ?>,
                  datasets: [{
                    data: <?php echo $chartData ?>,
                    backgroundColor: colors,
                   }],
                }
                var chartMedia = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: {
                      responsive: true
                    }
                });
              </script>


              <!-- ###      GRAFICO NUMERO DI CONTROLLI AL MESE         ### -->
              <?php
                $numControlliMese = getNumControlliAnnuali($annoSelezionato, $db_conn);
                $chartMese = array();
                $chartNumControlli = array();
                for ($i=0;$i<count($numControlliMese);$i++){
                  $chartMese[$i] = $numControlliMese[$i][0];
                  $chartNumControlli[$i] = $numControlliMese[$i][1];
                }
                // conversione da array php a qullo javscript
                $maxNumAlMese = max($chartNumControlli);
                $chartMese = json_encode($chartMese);
                $chartNumControlli = json_encode($chartNumControlli);
              ?>
              <br><br>
              <div style="text-align:center">
                <h5 class="style-text-green" style="text-align:center">Numero di controlli al mese:</h5><br>
                <canvas id="chartNumValutazioni" style="max-height:auto;max-width:700px;text-align:center;display:unset"></canvas>
              </div>
              <script>
              var ctx = document.getElementById("chartNumValutazioni").getContext('2d');
                 var chartAnnuali = new Chart(ctx, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: 'Controlli: ',
                                data: <?php echo $chartNumControlli ?>,
                                backgroundColor: "rgba(39,174,96, 0.49)",
                                borderColor: "#27ae60",
                            }],
                            labels: <?php echo $chartMese ?>
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: <?php echo $maxNumAlMese + 1  ?>
                                    }
                                }]
                            }
                        }
                    });
              </script>


            </div>
          </div>
          <div class="mdl-cell mdl-cell--1-col"></div>
          </div>
        </section>
        <?php
          $tuttiControlli = "'";
          $controlli = getNumControlli($annoSelezionato, false, $db_conn);
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
