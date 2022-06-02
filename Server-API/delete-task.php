<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $query_delete = 'DELETE FROM task_remind WHERE id = "' . $_POST["idTask"] . '"';
  $result = $db_handle->functionQuery($query_delete);
  if ($result) {
    echo 'succesful';
  } else {
    echo 'false';
  }
?>