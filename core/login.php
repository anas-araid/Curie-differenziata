<form action="" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <select class="mdl-textfield__input" type="select" id="codice" name="codice" required="">
      <?php

       ?>
    </select>
    <label class="mdl-textfield__label" for="codice">Codice</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="confermaPassword" name="confermaPassword" required="">
    <label class="mdl-textfield__label" for="confermaPassword">Password</label>
  </div>
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
    $codice = text_filter_encrypt($_POST["codice"]);
    $password = text_filter_encrypt($_POST["password"]);
    $selectQuery = "SELECT * FROM t_operatori WHERE Codice='$codice' AND Password='$password'";
    $select = mysqli_query($db_conn, $selectQuery);
    if ($select==null){
      die('error');
        //throw new exception ("Impossibile aggiornare l'utente");
    }
    $esistenzaUtente = false;
    while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
      $esistenzaUtente = true;
      $_SESSION['include'] = ' ';
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
