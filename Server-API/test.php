<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $data = $db_handle->runQuery('SELECT * FROM account WHERE username="nhutpro" AND account.password="Nhutpro92"');
  foreach($data as $key=>$value) {
    $idAccount = $data[$key]["id"];
  }
  echo $idAccount;
//   if (!empty($data)) { 
//     $resp['username'] = $_POST['UsernameLogin'];
//     $resp['status'] = true;
//     echo json_encode($resp);
//   } else {
//     $resp['status'] = false;
//     echo json_encode($resp);
//   }
?>