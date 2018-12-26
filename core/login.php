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
    <button class="special-button" type="submit">ACCEDI</button>
    <br>
    <button class="special-button" type="reset" onclick="location.href='core/logout.php'">Indietro</button>
  </div>
</form>
<?php
  if(isset($_POST['password'])){
    include 'core/functions.php';
    // text_filter l'input
    $id = text_filter($_POST["operatore"]);
    // md5 della password
    $password = text_filter_encrypt($_POST["password"]);
    $selectQuery = "SELECT * FROM t_operatori WHERE ID='$id' AND Password='$password'";
    $select = mysqli_query($db_conn, $selectQuery);
    if ($select==null){
      die('error');
        //throw new exception ("Impossibile aggiornare l'utente");
    }
    $esistenzaUtente = false;
    while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
      $esistenzaUtente = true;
      //$_SESSION['include'] = ' ';
      $operatore = getOperatore($id, $db_conn);
      $_SESSION['ID'] = $operatore['ID'];
      $_SESSION['Nome'] = $operatore['Nome'];
      $_SESSION['Cognome'] = $operatore['Cognome'];
      $_SESSION['Codice'] = $operatore['Codice'];
      echo "
      <script>
      flatAlert('Accesso eseguito con successo', '', 'success', 'core/log.php');
      </script>";
    }
    if (!$esistenzaUtente){
      echo "
      <script>
      flatAlert('Password errata', '', 'error', 'index.php');
      </script>";
    }

  }

 ?>
