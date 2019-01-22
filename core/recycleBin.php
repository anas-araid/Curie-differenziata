<div style="text-align:center;">
  <h4><?php echo ($_SESSION['IdClasse'] != "") ? $_SESSION['Classe']." ".$_SESSION['TipoIndirizzo'] : $_SESSION['TipoIndirizzo']; ?></h4>
  <div>
    <button class="style-special-button" style="width:50%;" onclick="redirectIndietro()">INDIETRO</button>
    <button class="style-special-button" style="width:50%;" onclick="location.href=''">VALUTAZIONI PRECEDENTI</button>
  </div>
  <hr style="width:80%;display:inline-block"/>
  <?php
    $tipologieCestini = getTipologieCestini(null ,$db_conn);
    for ($i=0; $i < count($tipologieCestini); $i++){
      $tipologia = $tipologieCestini[$i][1];
      ?>
      <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:left">
        <h4><?php echo $tipologia?></h4>
        <div style="text-align:center">
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
          <i class="material-icons">star</i>
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
