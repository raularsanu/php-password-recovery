<?php 

  function generateRandomString() {
      $chars = "0123456789abcdefghijklmnoprstuvwxyz";
      $string = "";
      for($i = 0; $i < strlen($chars); $i++) {
         $random = rand(0, strlen($chars) - 1);
         $string = $string.$chars[$random];
      };
      return $string;
  };

?>