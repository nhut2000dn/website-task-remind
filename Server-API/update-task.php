<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $query_update = 'UPDATE task_remind SET name_task = "'. $_POST["nameTask"] .'", note_task = "'. $_POST["noteTask"] .'", level_task = "'. $_POST["levelTask"] .'", deadline = "'. $_POST["deadline"] .'", time_reminder = "'. $_POST["timeSendMail"] .'" WHERE task_remind.id = "' . $_POST["idTask"]. '"';
  $result = $db_handle->functionQuery($query_update);
  if ($result) {
    echo 'succesful';
  } else {
    echo 'false';
  }
?>