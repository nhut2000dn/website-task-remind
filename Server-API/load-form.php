<?php
  include("config/connection.php");
  $db_handle = new DBController();
  if ($_POST['action'] == 'edit' || $_POST['action'] == 'view') {
    $data_task = $db_handle->runQuery('SELECT task_remind.id AS task_id, name_task, note_task, level_task, date_create, deadline, time_reminder, check_mark, task_remind.status, name_level  FROM task_remind, task_level WHERE task_remind.level_task =  task_level.id AND task_remind.id = "' . $_POST["idTask"] . '"');
    if (!empty($data_task)) {
      foreach($data_task as $key=>$value) {
        $resp['id'] = $data_task[$key]["task_id"];
        $resp['name-task'] = $data_task[$key]["name_task"];
        $resp['note-task'] = $data_task[$key]["note_task"];
        $resp['level-task'] = $data_task[$key]["level_task"];
        $resp['name-level'] = $data_task[$key]["name_level"];
        $resp['date-create'] = $data_task[$key]["date_create"];
        $resp['deadline'] = $data_task[$key]["deadline"];
        $resp['time-reminder'] = $data_task[$key]["time_reminder"];
        $resp['check-mark'] = $data_task[$key]["check_mark"];
        $resp['status'] = $data_task[$key]["status"];
      }
      echo json_encode($resp);
    }
  }
?>