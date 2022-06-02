<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Task remind</title>
  <link rel="stylesheet" href="css/css-auth.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://sweetalert2.github.io/styles/bootstrap4-buttons.css"/>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

  <script>
    $(document).ready(function() {

      // check if had login
      if (localStorage.getItem("idAccount") != null) {
        window.location.href = 'index.php';
      }

      // check link auth
      if (window.location.hash == '#login') {
        $(".container-login").css("display", "block");
        $(".container-register").css("display", "none");
      } else if (window.location.hash == '#register') {
        $(".container-login").css("display", "none");
        $(".container-register").css("display", "block");
      }

      // handle check error login
      $(".form-login").validate({
        errorElement: 'li',
        rules: {
          UsernameLogin: "required",
          passwordLogin: "required"
        },
        messages: {
          UsernameLogin: "Please enter your username",
          passwordLogin: "Please enter your password"
        },
        onkeyup: function() {
          if ($('.form-login').valid() == true) {
            $('.btn-login').prop('disabled', false);
          } else {
            $('.btn-login').prop('disabled', true);
          }
        }
      });

      // handle button login
      $('.btn-login').click(function() {
        var data = $('.form-login').serialize(); 
        $.ajax({
          url: "../Server-API/LoginControllers.php",
          type: "post",
          dataType :"text",
          data: data,
          success:function (response){
            response = JSON.parse(response);
            if (response['status'] == true) {
              Swal.fire({
                type: 'success',
                title: 'Login succesful!',
                text: 'Have a nice day!',
                showConfirmButton: false,
                timer: 4500
              }).then((result) => {
                if (typeof(Storage) !== "undefined") {
                  localStorage.setItem("idAccount", response['idAccount']);
                }
                window.location.href = 'index.php';
              })
            } else if (response['status'] == false) {
              $('.error-login').html('<li>Username or Password wrong</li>');
            }
          }
        });
      });

      // handle check error register
      $.validator.addMethod("validatePassword", function (value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
      });
      $(".form-register").validate({
        errorElement: 'li',
        rules: {
          UsernameRegister: {
            required: true,
            minlength: 6
          },
          PasswordRegister: {
            required: true,
            validatePassword: true,
          },
          Comfirmpassword: {
            equalTo: ".password-register"
          },
          EmailRegister: {
            required: true,
            email: true
          }
        },
        messages: {
          UsernameRegister: {
            required: "Please enter your username",
            minlength: "Enter your username must be than 6 characters"
          },
          PasswordRegister: {
            required: "Please enter your password",
            validatePassword: "Enter your password must be between 8 and 15 characters and at least one numeric, one uppercase"
          },
          Comfirmpassword: "Enter Confirm Password Same as Password",
          EmailRegister: {
            required: "Please enter your email",
          }
        },
        onkeyup: function() {
          if ($('.form-register').valid() == true) {
            $('.btn-register').prop('disabled', false);
          } else {
            $('.btn-register').prop('disabled', true);
          }
        }
      });

      // handle button register
      $('.btn-register').click(function() {
        var data = $('.form-register').serialize(); 
        $.ajax({
          url: "../Server-API/RegisterControllers.php",
          type: "post",
          dataType :"text",
          data: data,
          success:function (response){
            response = JSON.parse(response);
            if (response['status'] == true) {
              Swal.fire({
                type: 'success',
                title: 'Register succesful!',
                text: 'Have a nice day!',
                showConfirmButton: false,
                timer: 4500
              }).then((result) => {
                window.location.href = 'auth.php#login';
                $(".container-register").fadeOut(function() {
                  $(".container-login").fadeIn() 
                });
              })
            } else if (response['status'] == false) {
              if (response['error-username'] == 'username-existed') {
                $('.error-register').html('<li>Your username was existed</li>');
              }
              if (response['error-email'] == 'email-existed') {
                $('.error-register').html('<li>Your email was existed</li>');
              }
            }
          }
        });
      });

      // hanle button link login
      $('.btn-link-login').click(function() {
        $(".container-register").fadeOut(function() {
          $(".container-login").fadeIn() 
        });
      });

      // handle button link register
      $('.btn-link-register').click(function() {
        $(".container-login").fadeOut(function() {
          $(".container-register").fadeIn() 
        });
      });
    });
  </script>
</head>

<body>
  <main class="main-auth">
    <div class="container-auth container-login">
      <h1 class="title-login">Login</h1>
      <form action="login.php" method="post" class="form-login">
        <input type="text" class="input-form username-login" name="UsernameLogin" placeholder="Username">
        <input type="password" class="input-form password-login" name="passwordLogin" placeholder="Password">
        <button type="button" class="btn-login" disabled>Login</button>
        <div class="error error-login"></div>
      </form>
      <div class="container-link">
        <a href="#register" class="btn-link-auth btn-link-register">Register</a>
      </div>
    </div>
    <div class="container-auth container-register">
      <h1 class="title-register">Register</h1>
      <form action="register.php" method="post" class="form-register">
        <input type="text" class="input-form username-register" name="UsernameRegister" placeholder="Username">
        <input type="password" class="input-form password-register" name="PasswordRegister" placeholder="Password">
        <input type="password" class="input-form comfirm-password" name="Comfirmpassword" placeholder="Comfirm Password">
        <input type="text" class="input-form email" name="EmailRegister" placeholder="Your Email">
        <button type="button" class="btn-register" disabled>Register</button>
        <div class="error error-register"></div>
      </form>
      <div class="container-link">
        <a href="#login" class="btn-link-auth btn-link-login">Login</a>
      </div>
    </div>
  </main>
</body>

</html>