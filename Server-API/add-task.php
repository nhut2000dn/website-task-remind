<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $query_insert = 'INSERT INTO task_remind (id, id_account, name_task, note_task, level_task, date_create, deadline, time_reminder, check_mark, status) VALUES (NULL, "'. $_POST["idAccount"] .'", "'. $_POST["nameTask"] .'", "'. $_POST["noteTask"] .'", "'. $_POST["levelTask"] .'", "' . date("Y-m-d h:i:s") . '", "'. $_POST["deadline"] .'", "'. $_POST["timeSendMail"] .'", "0", "0")';
  $result = $db_handle->functionQuery($query_insert);
  if ($result) {
    echo 'succesful';
  } else {
    echo 'false';
  }
?>