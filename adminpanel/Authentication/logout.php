<?php include_once "../../includes/config.php";
//destroy session
session_destroy(); //unset $_session['user']
//redirect to login page
header("location:".SITEURL."adminpanel/Authentication/login.php");