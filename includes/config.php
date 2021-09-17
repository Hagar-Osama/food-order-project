<?php session_start();
//create contant to store non-repeated values
define('SITEURL', 'http://localhost/food-order-project/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

$connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
       if (! $connection) {
           die('error '. mysqli_connect_error());
       }



       //selecting database
       //$db_select = mysqli_select_db($connection, 'food-order') or die(mysqli_error());
?>