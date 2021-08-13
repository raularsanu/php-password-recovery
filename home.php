<?php

   if(!isset($_COOKIE['email'])){
        header("Location: http://localhost/loginregister/index.php");
   }

   echo $_COOKIE['email'];

   if(isset($_POST['submit'])){
        setcookie('email', 'somevalue', time() - 7200, '/');
        header("Location: http://localhost/loginregister/index.php");
   };

?>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
    welcome
    <form action='home.php' method='post'>
       <button type='submit' name='submit'>Logout</button>
    </form>
</body>
</html>