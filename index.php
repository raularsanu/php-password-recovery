<?php 

     if(isset($_COOKIE['email'])){
        header("Location: http://localhost/loginregister/home.php");
     };
  
     include('db_connect.php');

     $error = '';

     if(isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if($email == '' || $password == '') {

          $error = 'Fill all inputs';

        } else {

          $sql = "SELECT email, password FROM users WHERE email='$email'";
          $result = mysqli_query($conn, $sql);
          $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

          if(count($data) == 0) {
            $error = 'No such user exists';
          } else {
            if($data[0]['password'] == $password) {
              setcookie('email', $email, time() + (86400 * 30), '/');
              header("Location: http://localhost/loginregister/home.php");
            } else {
              $error = 'Wrong password';
            }
          };

        }


     };

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='style.css'>
    <title>Document</title>
</head>
<body>
  <div class='form-container'>
   <form action='index.php' method='post'>
    <h1 class='form-container-header'>Log In</h1>
    <div class='form-error-div'><?php echo $error; ?></div>
    <input type='text' name='email' placeholder='email' class='form-container-input'>
    <input type='password' name='password' placeholder='password' class='form-container-input'>
    <div class='form-forgot'><a class='forgot-link' href='reset.php'>Forgot password?</a></div>
    <button type='submit' name='submit' class='submit-btn'>Log In</button>
    <a class='switch' href='register.php'>Don't have an account?</a>
   </form>
  </div>    

  <script src='app.js'></script>
</body>
</html>