<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $data = $db_handle->functionQuery('UPDATE task_remind SET task_remind.status = "'. $_POST["valueUpdate"] .'" WHERE task_remind.id = "'. $_POST["idTask"] .'"');
  if ($data) {
    echo "succesful";
  }
?>