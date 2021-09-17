<?php
//authorization control
//check whether user logged in or not
if (!isset($_SESSION['user'])) {
    //user not logged in
    $_SESSION['message'] = '<div class="error text-center">Please Log In To Access Admin Panel</div>';
    //redirect to login page
    header("location:" . SITEURL . "adminpanel/Authentication/login.php");
}
