<div style="text-align:center;">
  <h4><?php echo ($_SESSION['IdClasse'] != "") ? $_SESSION['Classe']." ".$_SESSION['TipoIndirizzo'] : $_SESSION['TipoIndirizzo']; ?></h4>
  <div>
    <button class="style-special-button" style="width:50%;" onclick="redirectIndietro()">Indietro</button>
    <button class="style-special-button" style="width:50%;" onclick="location.href=''">Valutazioni precedenti</button>
  </div>
    <hr style="width:80%;display:inline-block"/>
  <div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block">

  </div>
</div>
<script>
  function redirectIndietro(){
    location.href = "newReport.php?key=<?php echo $_SESSION['IdIndirizzo'] ?>";
  }
</script>
