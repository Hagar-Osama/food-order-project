<?php include_once "../../includes/config.php";
//check if button clicked
if (isset($_POST['update'])) {
    $id = filter_var($_POST['id'],FILTER_VALIDATE_INT);
    $fullname = filter_var($_POST['full_name'],FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['user_name'],FILTER_SANITIZE_STRING);
 
 if (empty($fullname)) {
     $_SESSION['validation-errors'] [] = 'Full Name must be entered';

 }elseif (strlen($fullname) < 6) {
     $_SESSION['validation-errors'] [] = 'Full name must be greater than 5 chars';
 }elseif (strlen($fullname) > 25) {
     $_SESSION['validation-errors'] [] = 'Full name must be less than 26 chars';
     
 }
 if (empty($username)) {
     $_SESSION['validation-errors'] [] = 'User Name must be entered';

 }elseif (strlen($username) < 6) {
     $_SESSION['validation-errors'] [] = 'User name must be greater than 5 chars';
 }elseif (strlen($username) > 25) {
     $_SESSION['validation-errors'] [] = 'User name must be less than 26 chars';
     
 }

 //check empty errors
 if(! empty($_SESSION['validation-errors'])) {
     header('location:'.SITEURL.'adminpanel/add_admin.php');
 }
    //5- create the sql query to be updated
    $sql = "UPDATE admins SET full_name = '$fullname', `user_name` = '$username'  WHERE id = '$id'";
    //echo $sql;
   // die();
    //execute the query
    $result = mysqli_query($connection, $sql);
    // var_dump($result);
    // die();
    if (mysqli_affected_rows($connection) > 0) {
        // 6- redirect to admin-manage page with message
        $_SESSION['success'] = "Admin Updated Successfully.";
        header("location:" . SITEURL . "adminpanel/admin-manage.php");
     } else {
        $_SESSION['error'] = "Admin Failed To Be Updated.";
        header("location:" . SITEURL . "adminpanel/admin-manage.php");
    }
}





