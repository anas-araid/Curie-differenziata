<div style="text-align:center">
  <?php
    if ($_SESSION['admin']){
      ?>
      <button class="style-special-button" style="width:70%;" onclick="location.href='newUser.php'">AGGIUNGI OPERATORE</button>
      <button class="style-special-button" style="width:70%;" onclick="location.href='editUser.php'">MODIFICA OPERATORE</button>
      <?php
    }
   ?>
  <button class="style-special-button" style="width:70%;" onclick="location.href='newReport.php'">NUOVO CONTROLLO</button>
</div>
<div>
  <form action="core/search.php" method="POST" style="text-align:center">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:40%;">
      <input class="mdl-textfield__input style-gradient-text" style="border-bottom:1px solid #c5003e;color:grey" type="text" id="find" name="find" required="">
      <label class="mdl-textfield__label style-gradient-text" for="find">Cerca</label>
    </div>
    <button id="btn-search" type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white ">
      <i class="material-icons style-text-green">search</i>
    </button>
    <button id="btn-download"
            type="reset"
            class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white"
            onclick="location.href='core/exportCSV.php'">
      <i class="material-icons style-text-green">save</i>
    </button>
    <button id="btn-stats"
            type="reset"
            class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white"
            onclick="location.href='stats.php'">
      <i class="material-icons style-text-green">bar_chart</i>
    </button>
  </form>
  <div class="mdl-tooltip mdl-tooltip--large" for="btn-search">
    Cerca
  </div>
  <div class="mdl-tooltip mdl-tooltip--large" for="btn-download">
    Salva
  </div><div class="mdl-tooltip mdl-tooltip--large" for="btn-stats">
    Statistiche
  </div>
</div>


<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th>Data</th>
        <th>Operatore</th>
        <th>Classe</th>
        <th></th
      </tr>
    </thead>
    <tbody>
      <?php
        if (isset($_SESSION['searchReports'])){
          if ($_SESSION['searchReports'] == array()){
            echo "<script>flatAlert('Attenzione', 'La ricerca non ha prodotto risultati.', 'warning', '#')</script>";
            $_SESSION['searchReports'] = null;
          }else{
            $_SESSION['curieInclude'] = 'core/searchControlli.php';
            echo "
            <script>
              location.reload();
            </script>";
          }
        }
        $list = getControlli(null, $db_conn);
        for ($i=0; $i < count($list); $i++){
          $checkingExists = true;
          $operatore = getOperatore($list[$i][2], $db_conn);
          $classe = getClasse($list[$i][3], null, $db_conn);
          $indirizzo = getIndirizzi($classe['FK_Indirizzo'], $db_conn);
          $sezione = getSezioni($classe['FK_Sezione'], $db_conn);
          $classeCompleta = ($sezione['Descrizione'] != '--') ? ($sezione['Descrizione'].' '.$indirizzo['Descrizione']) : ($indirizzo['Descrizione']);
          echo '<tr>
              <td>'.date('d-m-Y H:i', strtotime($list[$i][1])).'</td>
              <td>'.$operatore['Nome'].' '.$operatore['Cognome'].'</td>
              <td>'.$classeCompleta.'</td>
              <td><a href="showReport.php?id='.$list[$i][0].'">Dettagli</a></td>
              <td><a href="#" onclick="alertDeleteReport('.$list[$i][0].')" style="color:red">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-gradient-text'>Nessun controllo effettuato</h5>";
  }
  ?>
</div>
