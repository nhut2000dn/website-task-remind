<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Task Remind</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
  <script src="js/jquery.datetimepicker.js"></script>
  <script type="text/javascript" src="js/jquery.timepicker.js"></script>

</head>
<body>
	<div class="wrapper">
		<div class="container-center">


      <div class="header">
        <div class="header-left">
          <div class="box-name-website">
            <p class="name-website"><a href="index.php">My Tasks</a></p>
          </div>
        </div>
        <div class="header-right">
          <button type="button" class="btn-add-task btn btn-info" data-toggle="modal" data-target="#data_Modal" class="btn btn-warning"><i class="fas fa-plus-circle"></i> Add new task</button>
          <div class="box-icon-user">
            <i class="fas fa-user"></i>
          </div>
          <div class="drop-down-user" style="display: none;">
            <div class="arrow-up"></div>
            <div class="container-drop-user">
              <ul class="bar-drop-user">
                <li class="item-drop-user"><button type="button" name="" class="btn-function-user">Setting</button></li>
                <li class="item-drop-user"><button type="button" name="btn-modal-password" class="btn-modal-password btn-function-user">Profile</button></li>
                <li class="item-drop-user"><button type="button" name="btn-logout" class="btn-logout btn-function-user">Logout</button></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="main">
        <div class="container-main-task"></div>
      </div>

      <!-- Modal Form Edit & Add -->
      <div id="data_Modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title-model title-add-edit">Add Task</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form method="post" class="js-form-task" id="form-model">
                <label class="label-task">Enter Name Task</label>
                <input type="text" name="nameTask" id="name-task" class="form-control" />
                <label class="label-task">Enter Note Of Task</label>
                <textarea name="noteTask" id="note-task" class="form-control"></textarea>
                <label class="label-task">Select Level Task</label>
                <select name="levelTask" id="level-task" class="form-control">
                  <option value="1">Not important</option>  
                  <option value="2">Not so important</option>
                  <option value="3">important</option>
                  <option value="4">Very important</option>
                  <option value="5">Most important</option>
                </select>  
                <label class="label-task">Deadline</label>
                <input type="text" id="deadline" name="deadline" class="form-control datetimepicker" >  
                <label class="label-task">Send mail before</label>
                <input type="text" id="time-send-mail" name="timeSendMail" class="form-control timepicker" > 
                
              </form>
            </div>
            <div class="modal-footer">
              <input type="button" name="btn-model" id="btn-model" value="Add" class="btn btn-success js-btn-task" id-task="1" disabled>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal display information task -->
      <div id="Modal_display" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title-model">View Task</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <ul class="list">
                <li><span class="title-list">Name Task:</span> <span id="list-name"></span></li>
                <li><span class="title-list">Note Task:</span> <span id="list-note"></span></li>
                <li><span class="title-list">Level Task:</span> <span id="list-level"></span></li>
                <li><span class="title-list">Date Create:</span> <span id="list-date-create"></span></li>
                <li><span class="title-list">Deadline:</span> <span id="list-deadline"></li>
                <li><span class="title-list">Time reminder:</span> <span id="list-time-reminder"></span></li>
                <li><span class="title-list">Check Mark:</span> <span id="list-check-mark"></span></li>
                <li><span class="title-list">Finish:</span> <span id="list-status"></span></li>
                <li><span class="title-list">Time remain :</span><span id="list-remain"></span></li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Model change password -->
      <div id="Modal_change_password" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title-model">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form method="post" class="js-form-password" id="form-model">
                <label class="label-task">Your recently password</label>
                <input type="password" name="recentlyPassword" id="recently-password" class="form-control" />
                <div class="error error-password"></div>
                <label class="label-task">Your new password</label>
                <input type="password" name="newPassword" id="new-password" class="form-control" >  
                <label class="label-task">Your confirm password</label>
                <input type="password" name="cPassword" id="comfirm-password" class="form-control" >  
              </form>
            </div>
            <div class="modal-footer">
              <input type="button" name="btn-model" id="btn-model" class="btn btn-success js-btn-change" value="Change Password" disabled>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
		</div>
  </div>
  <script src="js/myjs.js"></script>
</body>
</html>