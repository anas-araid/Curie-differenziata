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
    <button class="special-button" type="submit">Crea profilo</button>
    <br>
    <button class="special-button" type="reset" onclick="location.href='core/logout.php'">Indietro</button>
  </div>
</form>
