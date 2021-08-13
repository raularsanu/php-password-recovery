<?php 
   
   if(isset($_COOKIE['email'])){
     header("Location: http://localhost/loginregister/home.php");
   };
 
   $error = '';

   include 'db_connect.php';
   
   if(isset($_POST['submit'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if($password == '' || $email == '' || $name == '') {
        $error = 'Fill all inputs';
      } else {

        $findSql = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $findSql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
        if(count($data) == 0) {
          $sql = "INSERT INTO users(name, password, email) VALUES('$name', '$password', '$email')";
          unset($result);
  
          if(mysqli_query($conn, $sql)){
            setcookie('email', $_POST['email'], time() + (86400 * 30), '/');
            header("Location: http://localhost/loginregister/home.php");
          } else {
            $error = 'Please try again';
            header("Location: http://localhost/loginregister/register.php");
          };
        } else {
          unset($result);
          $error = "Email already taken";
        };

      };

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
   <form action='register.php' method='post'>
    <h1 class='form-container-header'>Sign Up</h1>
    <p class='form-error-div'><?php echo $error; ?></p>
    <input type='text' name='name' placeholder='name' class='form-container-input'>
    <input type='text' name='email' placeholder='email' class='form-container-input'>
    <input type='password' name='password' placeholder='password' class='form-container-input'>
    <button type='submit' name='submit' class='submit-btn'>Sign Up</button>
    <a class='switch' href='index.php'>Already have an account?</a>
   </form>
  </div>    

  <script src='app.js'></script>
</body>
</html>