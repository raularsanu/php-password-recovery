<?php

    function returnMessage($code) {
      $message = 
      '<html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
      </head>
      <body>
        <div class="form-container">
          <h1 class="form-container-header">Reset password</h1>
          <a class="switch" href="http://localhost/loginregister/resetpanel.php?code='.$code.'">Click to reset password</a>
        </div>    
      </body>
      </html>';

      return $message;
    };

?>