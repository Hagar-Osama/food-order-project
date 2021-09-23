<?php include_once "../../includes/config.php";
//process the value from the form and store it in the database
//check whether the button is clicked or not

$_SESSION['validation-error'] = [];
//make validation rules;
    if (isset($_POST['submit'])) {
     

       $fullname = filter_var($_POST['full_name'],FILTER_SANITIZE_STRING);
       $username = filter_var($_POST['user_name'],FILTER_SANITIZE_STRING);
       $password = $_POST['password'];
       $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    if (empty($fullname)) {
        $_SESSION['validation-error'] [] = 'Full Name must be entered';

    }elseif (strlen($fullname) < 6) {
        $_SESSION['validation-error'] [] = 'Full name must be greater than 5 chars';
    }elseif (strlen($fullname) > 25) {
        $_SESSION['validation-error'] [] = 'Full name must be less than 26 chars';
        
    }
    if (empty($username)) {
        $_SESSION['validation-error'] [] = 'User Name must be entered';

    }elseif (strlen($username) < 6) {
        $_SESSION['validation-error'] [] = 'User name must be greater than 5 chars';
    }elseif (strlen($username) > 25) {
        $_SESSION['validation-error'] [] = 'User name must be less than 26 chars';
        
    }
    if (empty($password)) {
        $_SESSION['validation-error'] [] = 'Password is required'; 
        }elseif (strlen($password) > 30) {
        $_SESSION ['validation-error'][] = 'password must be less than 31 char';
        }elseif (strlen($password) < 6) {
        $_SESSION ['validation-error'][] = 'password must be greater than 6 char'; 
    }
  
    //check empty errors
    if(! empty($_SESSION['validation-error'])) {
        header('location:'.SITEURL.'adminpanel/add_admin.php');
    }

    //2- sql query to save the data in the database

    $sql = "INSERT INTO admins  (full_name, `user_name`, `password`) VALUES ('$fullname', '$username', '$hashed_password')";
    //3- make connection and execute qury and save into database

    $result = mysqli_query($connection, $sql);

    //4- check whether query is excuted (data inserted) or not and display a success or error message

    if (mysqli_affected_rows($connection) > 0) {
        // echo 'good';
        $_SESSION['success'] = 'Data inserted successfully';
        header('location:' . SITEURL . 'adminpanel/admin-manage.php');
    } else {
        $_SESSION['error'] = 'Data Failed To Be Inserted';
        header('location:' . SITEURL . 'adminpanel/add_admin.php');
    }
}