<?php
  include("config/connection.php");
  $db_handle = new DBController();
  $data = $db_handle->runQuery('SELECT task_remind.id AS task_id, task_level.id, name_task, note_task, name_level, deadline, check_mark, task_remind.status 
    FROM task_remind, task_level WHERE task_remind.level_task = task_level.id AND id_account = ' . $_POST["idAccount"] . ' ORDER BY task_remind.id DESC');
  if (!empty($data)) {
    $array_task = $data;
  }
  $resp['array-task'] = $array_task;
  echo json_encode($resp);
?>
