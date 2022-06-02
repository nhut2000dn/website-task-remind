<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $check_login = $db_handle->runQuery('SELECT * FROM account WHERE username="' . $_POST['UsernameLogin'] . '" AND account.password="' . $_POST['passwordLogin'] . '"');
  if (!empty($check_login)) { 
    foreach($check_login as $key=>$value) {
      $idAccount = $check_login[$key]["id"];
    }
    $resp['idAccount'] = $idAccount;
    $resp['status'] = true;
    echo json_encode($resp);
  } else {
    $resp['status'] = false;
    echo json_encode($resp);
  }
?>