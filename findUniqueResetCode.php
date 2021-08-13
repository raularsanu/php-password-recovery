<?php

 include('generateRandomString.php');

 function findUniqueResetCode($conn) {
    $randomString = generateRandomString();
    $findQuery = "SELECT code FROM resetpasswords WHERE code='$randomString'";
    $randomResult = mysqli_query($conn, $findQuery);
    $randomResultData = mysqli_fetch_all($randomResult, MYSQLI_ASSOC);
    if(count($randomResultData) == 0) {
        return $randomString;
        echo $randomString;
    } else {
        return findUniqueResetCode($conn);
    };
 };

?>