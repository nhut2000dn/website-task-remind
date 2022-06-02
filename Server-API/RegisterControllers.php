<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $check_email = $db_handle->runQuery('SELECT * FROM account WHERE account.email="' . $_POST['EmailRegister'] . '"');
  $check_username = $db_handle->runQuery('SELECT * FROM account WHERE account.username="' . $_POST['UsernameRegister'] . '"');
  $error  = array();
  if (!empty($check_username)) {
    $resp['error-username'] = 'username-existed';
    $resp['status'] = false;
  } else if (!empty($check_email)) {
    $resp['error-email'] = 'email-existed';
    $resp['status'] = false;
  } else {
    $insert_account = $db_handle->functionQuery('INSERT INTO account (id, username, password, email) VALUES (NULL, "'. $_POST['UsernameRegister'] .'", "' . $_POST['PasswordRegister'] . '", "' . $_POST['EmailRegister'] . '")');
    $resp['username'] = $_POST['UsernameRegister'];
    $resp['status'] = true;    
  }
  echo json_encode($resp);
?>