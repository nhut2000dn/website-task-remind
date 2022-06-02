<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Task Remind</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
  <link rel="stylesheet" href="css/style.css">

  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class='col-sm-4'>
        <div class="form-group">
          <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class="form-group">
          <div class='input-group date' id='datetimepicker2'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class="form-group">
          <div class='input-group date' id='datetimepicker3'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                          <span class="glyphicon glyphicon-time"></span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function () {
      $('#datetimepicker1').datetimepicker({
        format: 'DD-MM-YYYY LT'
      });
      $('#datetimepicker2').datetimepicker({
        format: 'DD-MM-YYYY'
      });
      $('#datetimepicker3').datetimepicker({
        format: 'LT'
      });
      $('#datetimepicker3').datetimepicker({
        format: 'LT'
      });
    });
  </script>
</body>
</html>