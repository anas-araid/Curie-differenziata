<div style="text-align:center;">
  <!-- Mostra il titolo della classe -->
  <h4><?php echo ($_SESSION['Classe'] != "--") ? $_SESSION['Classe']." ".$_SESSION['TipoIndirizzo'] : $_SESSION['TipoIndirizzo']; ?></h4>
  <div>
    <button class="style-special-button" style="width:60%;" onclick="redirectIndietro()">INDIETRO</button>
  </div>
  <hr style="width:80%;display:inline-block"/>
  <form method="post" action="core/saveBin.php" enctype="multipart/form-data">
  <?php
    if (isset($_GET['bin'])){
      // $bin contiene l'id della tipologia di cestino
      $bin = $_GET['bin'];
      // passo l'id alla funzione getTipologieCestini: se restituisce un array allora l'id esiste
      $tipologieCestini = getTipologieCestini($bin ,$db_conn);
      // se non esiste la tipologia di cestino con id $bin allora reindirizza a checking.php
      if (empty($tipologieCestini)){
        echo "<script>location.href='checking.php'</script>";
        return;
      }else{
        // se esiste allora inserisco il'id nella sessione idTipologiaCestino
        $_SESSION['idTipologiaCestino'] = $bin;
        $idCestini = array();
        $cestini = getTipologieCestini(null ,$db_conn);
        for ($i=0; $i < count($cestini); $i++){
          $idCestini[$i] = $cestini[$i][0];
        }
        $_SESSION['maxCestini'] = $idCestini;
      }
    }else{
      // se $_GET[$bin] è vuoto allora stampa il primo cestino
      $tipologieCestini = getTipologieCestini(null ,$db_conn);
      if ($tipologieCestini != null){
        $url = 'checking.php?bin='.$tipologieCestini[0][0];
        echo "<script>location.href='$url'</script>";
      }else{
        echo "<h2 class='style-text-grey'>Errore: non ci sono cestini nel database</h1>";
        return;
      }
    }
    $idTipologia = $tipologieCestini['ID'];
    $tipologia = $tipologieCestini['Descrizione'];
    ?>
    <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:left">
      <h3><?php echo $tipologia?></h3>
      <div style="text-align:center">
        <div class="rate">
          <p style="text-align:left" class="style-text-grey">*campo obbligatorio</p>
          <input type="radio" id="<?php echo $idTipologia."_star5" ?>" name="<?php echo "rating_".$idTipologia ?>" value="5" required=""/>
          <label for="<?php echo $idTipologia."_star5" ?>" title="5">5 stars</label>
          <input type="radio" id="<?php echo $idTipologia."_star4" ?>" name="<?php echo "rating_".$idTipologia ?>" value="4" />
          <label for="<?php echo $idTipologia."_star4" ?>" title="4">4 stars</label>
          <input type="radio" id="<?php echo $idTipologia."_star3" ?>" name="<?php echo "rating_".$idTipologia ?>" value="3" />
          <label for="<?php echo $idTipologia."_star3" ?>" title="3">3 stars</label>
          <input type="radio" id="<?php echo $idTipologia."_star2" ?>" name="<?php echo "rating_".$idTipologia ?>" value="2" />
          <label for="<?php echo $idTipologia."_star2" ?>" title="2">2 stars</label>
          <input type="radio" id="<?php echo $idTipologia."_star1" ?>" name="<?php echo "rating_".$idTipologia ?>" value="1" />
          <label for="<?php echo $idTipologia."_star1" ?>" title="1">1 star</label>
        </div>
        <br>
        <br>
        <br>
        <br>
        <p style="text-align:left" class="style-text-grey">E' consigliato utilizzare foto orizzontali</p>
        <!-- Un modo artigianale per personalizzare il bottone carica foto -->
        <input hidden name='<?php echo "carica_".$idTipologia ?>' id='<?php echo "carica_".$idTipologia ?>' type="file" accept="image/*"></input>
        <input type="button" class="style-special-button" style="width:50%;" value="CARICA FOTO" onclick="document.getElementById('<?php echo "carica_".$idTipologia ?>').click();"></input>
        <input hidden name='<?php echo "scatta_".$idTipologia ?>' id="<?php echo "scatta_".$idTipologia ?>" type="file" capture="camera" accept="image/*"></input>
        <input type="button" class="style-special-button" style="width:50%;" value="SCATTA FOTO" onclick="document.getElementById('<?php echo "scatta_".$idTipologia ?>').click();"></input>
      </div>
    </div>
    <button hidden name='salva' id="salva" type="submit">salva</button>
  </form>
</div>

<script>
  function redirectIndietro(){
    location.href = "newReport.php?key=<?php echo $_SESSION['IdIndirizzo'] ?>";
  }
</script>
