<?php

  $error = '';
  $success = '';
  include('findUniqueResetCode.php');
  include('db_connect.php');
  include('email.php');

  if(isset($_POST['submit'])) {

     $email = $_POST['email'];

     if($email == '') {
        $error = 'Please fill input';
     } else {
        $findSql = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $findSql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if(count($data) == 0) {
            $error = 'No user with this email';
        } else {
            $duplicateQuery = "SELECT email FROM resetpasswords WHERE email='$email'";
            $duplicateDBQuery = mysqli_query($conn, $duplicateQuery);
            $duplicateData = mysqli_fetch_all($duplicateDBQuery, MYSQLI_ASSOC);
            if(count($duplicateData) > 0) {
                $error = 'Request already pending';
            } else {
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                $headers[] = 'From: raularsanu10@gmail.com';
                $code = findUniqueResetCode($conn);
                $message = returnMessage($code);
                if(mail($email, "Password reset", $message, implode("\r\n", $headers))) {
                    $insertQuery = "INSERT INTO resetpasswords(email, code) VALUES('$email', '$code')";
                    $insertResult = mysqli_query($conn, $insertQuery);
                    if($insertResult) {
                        $success = 'Successfully sent! Please check email';
                    } else {
                        $error = 'Failed to complete';
                    };
                } else {
                    $error = 'Failed to send';
                }
            };
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
   <form action='reset.php' method='post'>
    <h1 class='form-container-header'>Reset password</h1>
    <div class='form-error-div'><?php echo $error; ?></div>
    <div class='form-success-div'><?php echo $success; ?></div>
    <input type='text' name='email' placeholder='email' class='form-container-input'>
    <button type='submit' name='submit' class='submit-btn'>Reset</button>
    <a class='switch' href='index.php'>Back to login?</a>
   </form>
  </div>    

  <script src='app.js'></script>
</body>
</html>