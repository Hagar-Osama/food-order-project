<?php include_once "../../includes/config.php";
//process the value from the form and store it in the database
//check whether the button is clicked or not

$_SESSION['validation-errors'] = [];
//make validation rules;
    if (isset($_POST['submit'])) {
       $fullname = filter_var($_POST['full_name'],FILTER_SANITIZE_STRING);
       $username = filter_var($_POST['user_name'],FILTER_SANITIZE_STRING);
       $password = filter_var($_POST['password'].FILTER_SANITIZE_STRING);
       $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
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
    if (empty($hashed_password)) {
        $_SESSION['validation-errors'] [] = 'Password is required'; 
        }elseif (strlen($hashed_password) > 30) {
        $_SESSION ['validation-errors'][] = 'password must be less than 31 char';
        }elseif (strlen($hashed_password) < 6) {
        $_SESSION ['validation-errors'][] = 'password must be greater than 6 char'; 
    }
  
    //check empty errors
    if(! empty($_SESSION['validation-errors'])) {
        header('location:'.SITEURL.'adminpanel/add_admin.php');
    }

    //2- sql query to save the data in the database

    $sql = "INSERT INTO admins  (full_name, `user_name`, `password`) VALUES ('$fullname', '$username', '$hashed_password')";
    //3- make connection and execute qury and save into database

    $result = mysqli_query($connection, $sql);

    //4- check whether query is excuted (data inserted) or not and display a success or error message

    if (mysqli_affected_rows($connection) > 0) {
        // echo 'good';
        $_SESSION['success'] = 'Data inserted succussfully';
        header('location:' . SITEURL . 'adminpanel/admin-manage.php');
    } else {
        $_SESSION['error'] = 'Data Failed To Be Inserted';
        header('location:' . SITEURL . 'adminpanel/add_admin.php');
    }
}