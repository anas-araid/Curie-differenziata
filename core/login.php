<form action="" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <select class="mdl-textfield__input" id="operatore" name="operatore" required="" style="outline:none">
      <?php
        // inserisco nel menu a tendina tutti gli operatori nel database
        include 'core/getData.php';
        // $users contiene un array con le info degli operatori
        $users = getOperatore(null, $db_conn);
        for ($i=0; $i < count($users); $i++){
          if ($users[$i][3] == 1){
            echo "<option value='".$users[$i][0]."'>".$users[$i][1]." ".$users[$i][2]."</option>";
          }
        }
      ?>
    </select>
    <label class="mdl-textfield__label" for="operatore">Operatore</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="password" name="password" required="">
    <label class="mdl-textfield__label" for="password">Password</label>
  </div>
  <!-- DA FARE!! Dovrebbe reindirizzare a una pagina di richesta -->
  <p>Non hai ancora un profilo? <a style="color:#2ECC71;text-decoration:underline;cursor:pointer">Clicca qui</a></p>
  <div>
    <button class="style-special-button" type="submit">ACCEDI</button>
    <br>
    <button class="style-special-button" type="reset" onclick="location.href='core/logout.php'">Indietro</button>
  </div>
</form>
<?php
  if(isset($_POST['password'])){
    // text_filter l'input
    $id = text_filter($_POST["operatore"]);
    // md5 della password
    $password = text_filter_encrypt($_POST["password"]);
    $esistenzaUtente = checkPassword($id, $password, $db_conn);
    if (!$esistenzaUtente){
      echo "
      <script>
      flatAlert('Password errata', '', 'error', 'index.php');
      </script>";
    }else{
      echo "
      <script>
      flatAlert('Accesso eseguito con successo', '', 'success', 'core/log.php');
      </script>";
    }

  }

 ?>
