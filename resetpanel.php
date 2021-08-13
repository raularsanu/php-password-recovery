<?php

    include('db_connect.php');

    $error = '';
    $success = '';

    if(!isset($_GET['code'])) {
        header('Location: http://localhost/loginregister/reset.php');
    };
      
    if(isset($_POST['submit'])) {
        
        $code = $_GET['code'];
        $getEmailQuery = "SELECT email FROM resetpasswords WHERE code='$code'";
        $emailResult = mysqli_query($conn, $getEmailQuery);
        $emailData = mysqli_fetch_all($emailResult, MYSQLI_ASSOC);

        if(count($emailData) == 0) {
            $error = 'No pending change for this password';
        } else {
            $email = $emailData[0]['email'];
            $password = $_POST['password'];
            $updateQuery = "UPDATE users SET password='$password' WHERE email='$email'";
            $deleteQuery = "DELETE FROM resetpasswords WHERE email='$email'";
            $updateResult = mysqli_query($conn, $updateQuery);
            $deleteResult = mysqli_query($conn, $deleteQuery);
            if($updateResult && $deleteResult) {
              $success = 'Successfully changes password';
            } else {
              $error = 'Password failed to change';
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
   <form action='reset.php' method='get'>
         
   </form>
   <form action="resetpanel.php?code=<?php echo $_GET['code'] ?>" method='post'>
    <h1 class='form-container-header'>Write your new password</h1>
    <div class='form-error-div'><?php echo $error; ?></div>
    <div class='form-success-div'><?php echo $success; ?></div>
    <input type='password' name='password' placeholder='password' class='form-container-input'>
    <button type='submit' name='submit' class='submit-btn'>Reset</button>
    <a class='switch' href='index.php'>Back to login?</a>
   </form>
  </div>    

  <script src='app.js'></script>
</body>
</html>