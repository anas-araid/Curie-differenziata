<div style="max-height:600px;min-height:500px;overflow:auto">
  <div style="text-align:center">
    <button class="style-special-button" style="width:70%;" onclick="location.href='checking.php?back=true'">INDIETRO</button>
  </div>
  <div>
    <form action="core/search.php" method="POST" style="text-align:center">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%;">
        <input class="mdl-textfield__input style-gradient-text" style="border-bottom:1px solid #c5003e;color:grey" type="text" id="find" name="find" required="">
        <label class="mdl-textfield__label style-gradient-text" for="find">Cerca</label>
      </div>
      <button id="btn-search" type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white ">
        <i class="material-icons style-text-green">search</i>
      </button>
    </form>
  </div>
  <p>Risultati relativi alla ricerca <i>"<?php echo $_SESSION['searchKeyword'] ?> "</i></p>
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
          $searchIDs = $_SESSION['searchReports'];
          for ($j=0;$j<count($searchIDs);$j++){
            $list = getControlli($searchIDs[$j], $db_conn);
            $checkingExists = true;
            $operatore = getOperatore($list['FK_Operatore'], $db_conn);
            $classe = getClasse($list['FK_Classe'], null, $db_conn);
            $indirizzo = getIndirizzi($classe['FK_Indirizzo'], $db_conn);
            $sezione = getSezioni($classe['FK_Sezione'], $db_conn);
            $classeCompleta = ($sezione['Descrizione'] != '--') ? ($sezione['Descrizione'].' '.$indirizzo['Descrizione']) : ($indirizzo['Descrizione']);
            $date = $list['Data'];
            echo '<tr>
                <td>'.date('d-m-Y H:i', strtotime($date)).'</td>
                <td>'.$operatore['Nome'].' '.$operatore['Cognome'].'</td>
                <td>'.$classeCompleta.'</td>
                <td><a href="showReport.php?id='.$list['ID'].'">Dettagli</a></td>
                <td><a href="#" onclick="alertDeleteReport('.$list['ID'].')" style="color:red">Elimina</a></td>
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
