<div style="text-align:center;">
  <h4><?php echo ($_SESSION['IdClasse'] != "") ? $_SESSION['Classe']." ".$_SESSION['TipoIndirizzo'] : $_SESSION['TipoIndirizzo']; ?></h4>
  <div>
    <button class="style-special-button" style="width:60%;" onclick="redirectIndietro()">INDIETRO</button>
    <button class="style-special-button" style="width:60%;" onclick="location.href=''">VALUTAZIONI PRECEDENTI</button>
  </div>
  <hr style="width:80%;display:inline-block"/>
  <?php
    $tipologieCestini = getTipologieCestini(null ,$db_conn);
    for ($i=0; $i < count($tipologieCestini); $i++){
      $tipologia = $tipologieCestini[$i][1];
      $idTipologia = $tipologieCestini[$i][0];
      ?>
      <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:left">
        <h4><?php echo $tipologia?></h4>
        <div style="text-align:center">
          <div class="rate">
            <input type="radio" id="<?php echo $idTipologia."_star5" ?>" name="<?php echo "name_".$idTipologia ?>" value="5" />
            <label for="<?php echo $idTipologia."_star5" ?>" title="5">5 stars</label>
            <input type="radio" id="<?php echo $idTipologia."_star4" ?>" name="<?php echo "name_".$idTipologia ?>" value="4" />
            <label for="<?php echo $idTipologia."_star4" ?>" title="4">4 stars</label>
            <input type="radio" id="<?php echo $idTipologia."_star3" ?>" name="<?php echo "name_".$idTipologia ?>" value="3" />
            <label for="<?php echo $idTipologia."_star3" ?>" title="3">3 stars</label>
            <input type="radio" id="<?php echo $idTipologia."_star2" ?>" name="<?php echo "name_".$idTipologia ?>" value="2" />
            <label for="<?php echo $idTipologia."_star2" ?>" title="2">2 stars</label>
            <input type="radio" id="<?php echo $idTipologia."_star1" ?>" name="<?php echo "name_".$idTipologia ?>" value="1" />
            <label for="<?php echo $idTipologia."_star1" ?>" title="1">1 star</label>
          </div>
          <!--
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
        -->
          <br>
          <br>
          <br>
          <button class="style-special-button" style="width:50%;" onclick="">CARICA FOTO</button>
          <button class="style-special-button" style="width:50%;" onclick="">SCATTA FOTO</button>
        </div>
      </div>
      <?php
    }
  ?>

</div>
<script>
  function redirectIndietro(){
    location.href = "newReport.php?key=<?php echo $_SESSION['IdIndirizzo'] ?>";
  }
</script>
