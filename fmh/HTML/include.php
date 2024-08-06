<?php
    //Session Started
    session_start();
    //Connect Database
    $conn = mysqli_connect('localhost', 'root', '', 'fmh');
    //Define Links
    // define('RESTORE', 'http://localhost/process/html/restoredata.php');
    define('HOME', 'http://localhost/fmh/html/homelandlord.php');
    define('SIGNUP', 'http://localhost/fmh/html/signup.php');
    define('ROOM', 'http://localhost/fmh/html/addRoom.php');
    define('FORGOT', 'http://localhost/fmh/html/passwordRecovery.php');
    define('SIGNIN', 'http://localhost/fmh/html/signin.php');
    define('TENANT1', 'http://localhost/fmh/html/homeTenant1.php');
    define('WISHLIST', 'http://localhost/fmh/html/wishlist.php');
?>
 