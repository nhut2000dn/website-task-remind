$(document).ready(function () {
  $(function () {
    var checkStatus;
    var checkMark;
    var deadlineStatus;
    var colorDeadline;
    var titleAlert;
    loadMainTask();

    // button drop user
    var userDropDown = document.getElementsByClassName("drop-down-user")[0];
    document.addEventListener("click", (evt) => {
      const flyoutElement = document.getElementsByClassName("box-icon-user")[0];
      let targetElement = evt.target;
      do {
          if (targetElement == flyoutElement) {
            if (userDropDown.style.display == "none") {
              userDropDown.style.display = "block";
            } else {
              userDropDown.style.display = "none";
            }
            return;
          }
          targetElement = targetElement.parentNode;
      } while (targetElement);
      userDropDown.style.display = "none";
    });

    // button checkbox
    $('.button-checkbox').each(function () {
      var $widget = $(this),
        $button = $widget.find('button'),
        $checkbox = $widget.find('input:checkbox'),
        color = $button.data('color'),
        settings = {
          on: {
            icon: 'glyphicon glyphicon-check'
          },
          off: {
            icon: 'fa fa-square-o'
          }
        };

      $button.on('click', function () {
        $checkbox.prop('checked', !$checkbox.is(':checked'));
        $checkbox.triggerHandler('change');
        updateDisplay();
      });
      $checkbox.on('change', function () {
        updateDisplay();
      });

      function updateDisplay() {
        var isChecked = $checkbox.is(':checked');
        $button.data('state', (isChecked) ? "on" : "off");
        $button.find('.state-icon')
          .removeClass()
          .addClass('state-icon ' + settings[$button.data('state')].icon);

        if (isChecked) {
          $button
            .removeClass('btn-default')
            .addClass('btn-' + color + ' active');
        }
        else {
          $button
            .removeClass('btn-' + color + ' active')
            .addClass('btn-default');
        }
      }

      function init() {
        updateDisplay();
        if ($button.find('.state-icon').length == 0) {
          $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
        }
      }
      init();
    });

    // Check if logged in or not 
    if (localStorage.getItem('idAccount') == null) {
      $('.wrapper').empty();
      Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'You are not logged in!',
        footer: '<a href="auth.php">Login or Register</a>',
        timer: 8500
      }).then((result) => {
        window.location.href = 'auth.php';
      })
    }

    // function calculate name time remain
    function TimeNameRemain(timeDeadline) {
      var timeRemain = '';
      var today = new Date();
      var deadline = new Date(timeDeadline);
      var diffMs = (deadline - today); // milliseconds between now & deadline
      var diffDays = Math.floor(diffMs / 86400000); // days
      var diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
      var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
      if (diffDays != 0) {
        timeRemain = diffDays + ' days';
      } else if (diffHrs != 0) {
        timeRemain = diffHrs + ' hours';
      } else {
        timeRemain = diffMins + ' minutes';
      }
      if (diffDays <= 0 && diffHrs <= 0 && diffMins <= 0) {
        if (diffDays < -1) {
          timeRemain = diffDays + ' days';
        } else if (diffHrs < -1) {
          timeRemain = diffHrs + ' hours';
        } else {
          timeRemain = diffMins + ' minutes';
        }
      }
      return timeRemain;
    }

    // function calculate time remain
    function TimeRemain(timeDeadline) {
      var timeRemain = '';
      var today = new Date();
      var deadline = new Date(timeDeadline);
      var diffMs = (deadline - today); // milliseconds between now & deadline
      var diffDays = Math.floor(diffMs / 86400000); // days
      var diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
      var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
      if (diffDays != 0) {
        timeRemain = diffDays;
      } else if (diffHrs != 0) {
        timeRemain = diffHrs;
      } else {
        timeRemain = diffMins;
      }
      if (diffDays <= 0 && diffHrs <= 0 && diffMins <= 0) {
        if (diffDays < -1) {
          timeRemain = diffDays;
        } else if (diffHrs < -1) {
          timeRemain = diffHrs;
        } else {
          timeRemain = diffMins;
        }
      }
      return timeRemain;
    }

    // function load page
    function loadMainTask() {
      $.ajax({
        url:'../Server-API/load-data-task.php',
        type:'post',
        data: {
          idAccount: localStorage.getItem('idAccount')
        },
        success:function(response){
          $('.container-main-task').html('');
          var response = JSON.parse(response);
          for(var k in response['array-task']) {
            if (response['array-task'][k]['status'] == '1') {
              checkStatus = 'checked';
              deadlineStatus = 'Finished';
            } else {
              checkStatus = '';
              deadlineStatus = TimeNameRemain(response['array-task'][k]['deadline']);
            }
            if (response['array-task'][k]['check_mark'] == '1') {
              checkMark = 'checked';
            } else {
              checkMark = '';
            }
            if ((TimeRemain(response['array-task'][k]['deadline']) < 0) && (response['array-task'][k]['status'] == '0')) {
              colorDeadline = 'deadline-color';
            } else {
              colorDeadline = '';
            }
            $('.container-main-task').append('\
              <div class="box-task ' + colorDeadline + '">\
                <div class="task-left">\
                  <div class="js-btn-status checkbox-task">\
                    <label class="label">\
                      <input class="label__checkbox" type="checkbox" ' 
                        +  checkStatus + 
                      ' idTask = ' + response['array-task'][k]['task_id'] + ' value = ' + response['array-task'][k]['status'] + '>\
                      <span class="label__text">\
                        <span class="label__check">\
                          <i class="fa fa-check icon"></i>\
                        </span>\
                      </span>\
                    </label>\
                  </div>\
                  <div class="information-task">\
                    <h3 class="title-task">' + response['array-task'][k]['name_task'] + '</h3>\
                    <p class="deadline-task">\
                      <i class="fas fa-circle cirle-deadline"></i> Important: ' + response['array-task'][k]['name_level'] + ' \
                      <span class="deadline"><i class="fas fa-calendar-day calendar-deadline"></i> ' + deadlineStatus + '</span>\
                    </p>\
                  </div>\
                </div>\
                <div class="task-right">\
                  <div class="container-checkmark">\
                    <input class="star" type="checkbox" title="Inportant task" ' 
                    +  checkMark  +
                    ' idTask = ' + response['array-task'][k]['task_id'] + ' value = ' + response['array-task'][k]['check_mark'] + '><br/><br/>\
                  </div>\
                </div>\
                <div class="box-function-task"  style="display: none;">\
                  <ul class="container-function-task">\
                    <li class="item-function-task" id-task="' + response['array-task'][k]['task_id'] + '" action="view"><i class="far fa-clipboard"></i> View</li>\
                    <li class="item-function-task" id-task="' + response['array-task'][k]['task_id'] + '" action="edit"><i class="far fa-edit"></i> Edit</li>\
                    <li class="item-function-task" id-task="' + response['array-task'][k]['task_id'] + '" action="delete"><i class="fas fa-trash"></i> Delete</li>\
                  </ul>\
                </div>\
              </div>\
            ');
          }
        }
      });
    }

    // btn display modal form change password
    $('.btn-modal-password').click(function () {
      $("#Modal_change_password").modal("show");
    });

    // handle check error form change password
    $.validator.addMethod("validatePassword", function (value, element) {
      return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
    });
    var validatorChange = $(".js-form-password").validate({
      errorElement: 'li',
      rules: {
        recentlyPassword: {
          required: true
        },
        newPassword: {
          required: true,
          validatePassword: true,
        },
        cPassword: {
          equalTo: "#new-password"
        }
      },
      messages: {
        recentlyPassword: {
          required: "Please enter your username"
        },
        newPassword: {
          required: "Please enter your password",
          validatePassword: "Enter your password must be between 8 and 15 characters and at least one numeric, one uppercase"
        },
        cPassword: "Enter Confirm Password Same as Password"
      }
    });

    // handle btn change password
    $('.js-btn-change').click(function () {
      $.ajax({
        url:'../Server-API/change-password.php',
        type:'post',
        data : $('.js-form-password').serialize() + "&idAccount=" + localStorage.getItem("idAccount"),
        success:function(response){
          if (response == 'succesful') {
            Swal.fire({
              type: 'success',
              title: 'Your password have change !',
              timer: 8500
            }).then((result) => {
              $("#Modal_change_password").modal("hide");
              $("#Modal_change_password").on('hidden.bs.modal', function(){
                $(this).closest('#Modal_change_password').find("input[type=password]").val("");
                validatorChange.resetForm();
              });
            })
          } else if (response == 'password-wrong') {
            $('.error-password').html('<li>Your recently password is wrong</li>');
          }
        }
      });
    });

    // handle btn sign out
    $('.btn-logout').click(function () {
      localStorage.removeItem("idAccount");
      Swal.fire({
        type: 'success',
        title: 'Logout succesful',
        timer: 8500
      }).then((result) => {
        window.location.href = 'auth.php';
      })
    });

    // show box function task
    $(document).on('click', '.box-task', function(e){
      var top = e.pageY;
      var left = e.pageX;
      $('.box-function-task').hide();
      $(this).children('.box-function-task').css({'top': top,'left': left});
      $(this).children('.box-function-task').show();
    });
    
    // disble box function task
    $(document).on('click', '.container-checkmark', function(e){
      var self = $(e.target);
      var value = self.attr('value');
      var idTask = self.attr('idTask');
      var valueUpdate;
      if (value == 0) {
        valueUpdate = 1;
      } else {
        valueUpdate = 0;
      }
      $.ajax({
        url:'../Server-API/checkmark.php',
        type:'post',
        data: {
          idTask: idTask,
          valueUpdate: valueUpdate
        },
        success:function(response){
          if (response == 'succesful') {
            Swal.fire({
              type: 'success',
              title: 'Checkmark succesful',
              timer: 8500
            })
          }
        }
      });
      e.stopPropagation();
    });

    $(document).on('click', '.js-btn-status', function(e){
      var self = $(e.target);
      var value = self.attr('value');
      var idTask = self.attr('idTask');
      var valueUpdate;
      if (value == 0) {
        valueUpdate = 1;
        titleAlert = 'Finished succesful';
      } else {
        titleAlert = 'Cancel succesful';
        valueUpdate = 0;
      }
      $.ajax({
        url:'../Server-API/status.php',
        type:'post',
        data: {
          idTask: idTask,
          valueUpdate: valueUpdate
        },
        success:function(response){
          if (response == 'succesful') {
            Swal.fire({
              type: 'success',
              title: titleAlert,
              timer: 8500
            }).then(() => {
              loadMainTask();
            })
          }
        }
      });
      e.stopPropagation();
    });

    $('body').click(function (evt) {    
      if(evt.target.class == "box-task") {
        return;
      }
      if($(evt.target).closest('.box-task').length) {
        return;   
      }
      $('.box-function-task').hide();
    });

    // date time picker
    $('.datetimepicker').datetimepicker({
      minDate: 0
    });

    // time picker
    $('.timepicker').timepicker({ 'timeFormat': 'H:i:s' });

    // load form edit
    $(document).on('click', '.item-function-task', function(e){
      $('.box-function-task').hide();
      var self = $(this);
      var idTask = self.attr('id-task');
      var action = self.attr('action');
      if (action == 'edit') {
        $.ajax({
          url:'../Server-API/load-form.php',
          type:'post',
          data: {
            idTask: idTask,
            action: action
          },
          success:function(response){
            var response = JSON.parse(response);
            $('.title-add-edit').html('Edit');
            $('.js-btn-task').val('Edit');
            $("#data_Modal").modal("show");
            $('#name-task').val(response['name-task']);
            $('#note-task').val(response['note-task']);
            $("#level-task").val(response['level-task']);
            $('#deadline').val(response['deadline']);
            $('#time-send-mail').val(response['time-reminder']);
            $(".js-btn-task").attr('id-task', response['id']);
            $('.js-btn-task').prop('disabled', false);
            $("#data_Modal").on('hide.bs.modal', function () {
              $('.title-add-edit').html('Add');
              $('.js-btn-task').val('Add');
              $('#level-task').prop('selectedIndex',0);
              $(this).closest('#data_Modal').find("input[type=text], textarea").val("");
              $('.js-btn-task').prop('disabled', true);
              validator.resetForm();
            });
          }
        });
      } else if (action == 'view') {
        $.ajax({
          url:'../Server-API/load-form.php',
          type:'post',
          data: {
            idTask: idTask,
            action: action
          },
          success:function(response) {
            var response = JSON.parse(response);
            $("#Modal_display").modal("show");
            $('#list-name').html(response['name-task']);
            $('#list-note').html(response['note-task']);
            $('#list-level').html(response['name-level']);
            $('#list-date-create').html(response['date-create']);
            $('#list-deadline').html(response['deadline']);
            $('#list-time-reminder').html(response['time-reminder']);
            if (response['check-mark'] == 1) {
              $('#list-check-mark').html('Checked');
            } else {
              $('#list-check-mark').html('None');
            }
            if (response['status'] == 1) {
              $('#list-status').html('finished');
            } else {
              $('#list-status').html('None');
            }
            $('#list-remain').html(TimeNameRemain(response['deadline']));
          }
        });
      } else if (action == 'delete') {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url:'../Server-API/delete-task.php',
              type:'post',
              data: {
                idTask: idTask,
                action: action
              },
              success:function(response){
                if (response == 'succesful') {
                  Swal.fire({
                    type: 'success',
                    title: 'Delete succesful',
                    timer: 8500
                  }).then((result) => {
                    loadMainTask();
                  })
                }
              }
            });
          }
        })
      }
      e.stopPropagation();
    });

    // handle check error form task
    var validator = $(".js-form-task").validate({
      errorElement: 'li',
      rules: {
        nameTask: "required",
        noteTask: "required",
        deadline: "required",
        timeSendMail: "required"
      },
      messages: {
        nameTask: "Please enter name task",
        noteTask: "Please enter note task",
        deadline: "Please choose deadline",
        timeSendMail: "Please choose time send remind mail"
      }
    });

    // disabled button form
    $("input").on('keyup change', function (){
      if ($('.js-form-task').valid() == true) {
        $('.js-btn-task').prop('disabled', false);
      }
      if ($('.js-form-task').valid() == false) {
        $('.js-btn-task').prop('disabled', true);
      }
      if ($('.js-form-password').valid() == true) {
        $('.js-btn-change').prop('disabled', false);
      } else {
        $('.js-btn-change').prop('disabled', true);
      }
   });

    //btn add task
    $('.js-btn-task').click(function (e) {
      if ($('.js-btn-task').val() == 'Add') {
        $.ajax({
          url:'../Server-API/add-task.php',
          type:'post',
          data : $('.js-form-task').serialize() + "&idAccount=" + localStorage.getItem("idAccount"),
          success:function(response){
            if (response == 'succesful') {
              Swal.fire({
                type: 'success',
                title: 'Add succesful',
                timer: 8500
              }).then((result) => {
                $("#data_Modal").modal("hide");
                $("#data_Modal").on('hidden.bs.modal', function(){
                  $('.title-add-edit').html('Add');
                  $('.js-btn-task').val('Add');
                  $('#level-task').prop('selectedIndex',0);
                  $(this).closest('#data_Modal').find("input[type=text], textarea").val("");
                  $('.js-btn-task').prop('disabled', true);
                  validator.resetForm();
                });
                loadMainTask();
              })
            }
          }
        });
      } else {
        $.ajax({
          url:'../Server-API/update-task.php',
          type:'post',
          data : $('.js-form-task').serialize() + "&idTask=" + $('.js-btn-task').attr('id-task'),
          success:function(response){
            if (response == 'succesful') {
              Swal.fire({
                type: 'success',
                title: 'Update succesful',
                timer: 8500
              }).then((result) => {
                $("#data_Modal").modal("hide");
                $("#data_Modal").on('hidden.bs.modal', function () {
                  $('.title-add-edit').html('Add');
                  $('.js-btn-task').val('Add');
                  $('#level-task').prop('selectedIndex',0);
                  $(this).closest('#data_Modal').find("input[type=text], textarea").val("");
                  $('.js-btn-task').prop('disabled', true);
                  validator.resetForm();
                });
                loadMainTask();
              })
            }
          }
        });
      }
    });
  });
});