<div style="text-align:center;">
  <h4><?php echo ($_SESSION['IdClasse'] != "") ? $_SESSION['Classe']." ".$_SESSION['TipoIndirizzo'] : $_SESSION['TipoIndirizzo']; ?></h4>
  <div>
    <button class="style-special-button" style="width:50%;" onclick="location.href='newReport.php'">Indietro</button>
    <button class="style-special-button" style="width:50%;" onclick="location.href='newReport.php'">Valutazioni precedenti</button>
  </div>
</div>
