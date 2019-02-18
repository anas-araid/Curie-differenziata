<form action="" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <!-- Inserisco nel select tutti gli utenti dal db -->
    <select class="mdl-textfield__input" id="operatore" name="operatore" required="" style="outline:none">
      <?php
        // $users contiene un array con le info degli operatori
        $users = getOperatore(null, $db_conn);
        for ($i=0; $i < count($users); $i++){
          echo "<option value='".$users[$i][0]."'>".$users[$i][1]." ".$users[$i][2]."</option>";
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
  <div>
    <button class="style-special-button" type="submit">ACCEDI</button>
    <br>
    <button class="style-special-button" type="reset" onclick="location.href='core/logout.php'">Indietro</button>
  </div>
</form>
<?php
  if(isset($_POST['password'])){
    // text_filter dell'input
    $id = text_filter($_POST["operatore"]);
    // md5 della password
    $password = text_filter_encrypt($_POST["password"]);
    // controlla la password e restituisce i dati dell'utente
    $operatore = checkPassword($id, $password, $db_conn);
    if (empty($operatore)){
      echo "
      <script>
      flatAlert('Password errata', '', 'error', 'index.php');
      </script>";
    }else{
      // se l'operatore è 'Amministatore' allora avrà delle funzionalità in più
      if ($operatore['Nome'] == 'Amministratore'){
        $_SESSION['admin'] = true;
      }
      echo "
      <script>
      flatAlert('Accesso eseguito con successo', '', 'success', 'core/log.php');
      </script>";
    }
  }

 ?>
