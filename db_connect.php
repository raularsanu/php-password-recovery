<?php

   $conn = mysqli_connect('localhost', 'RAUL', 'test1234', 'loginregister');

   if(!$conn){
       echo mysqli_connect_error();
   };
?>