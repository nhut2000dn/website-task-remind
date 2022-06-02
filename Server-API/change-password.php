<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $checkPassword = $db_handle->numRows('SELECT * FROM account WHERE id = "' . $_POST['idAccount'] . '" AND password = "' . $_POST['recentlyPassword'] . '"');
  if ($checkPassword == 0) {
    echo 'password-wrong';
  } else {
    $dataUpdate = $db_handle->functionQuery('UPDATE account SET account.password = "'. $_POST["newPassword"] .'" WHERE id = "'. $_POST["idAccount"] .'"');
    if ($dataUpdate) {
      echo "succesful";
    }
  }
?>