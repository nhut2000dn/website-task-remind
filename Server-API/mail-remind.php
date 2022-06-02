<?php
  // include("config/connection.php");
  // $db_handle = new DBController();
  // $data_task = $db_handle->runQuery('SELECT * FROM account, task_remind WHERE account.id = task_remind.id_account ORDER BY task_remind.id');
  // $datetime_currently = date("Y-m-d H:i:s");
  // if (!empty($data_task)) {
  //   foreach($data_task as $key=>$value) {
  //     $deadline = $data_task[$key]['deadline'];
  //     $time_reminder = $data_task[$key]['time_reminder'];
  //     $time_reminder_explode = explode(':', $data_task[$key]['time_reminder']);
  //     $timestamp = strtotime($deadline);
  //     $time = $timestamp - ($time_reminder_explode[0] * 60 * 60) - ($time_reminder_explode[1] * 60);
  //     $datetime_send_mail = date("Y-m-d H:i:s", $time);
  //     echo $deadline . '__' . $time_reminder . '===' . $datetime_send_mail . '</br>';
  //     if ($datetime_currently == $datetime_send_mail) {
  //       $sub = $data_task[$key]['name_task'];
  //       $msg = $data_task[$key]['note_task'];
  //       $rec = $data_task[$key]['email'];
  //       mail($rec,$sub,$msg);
  //     }
  //   }
  //   echo $datetime_currently;
  // }
?>