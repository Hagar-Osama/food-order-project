<?php include_once "../../includes/config.php";
//check if button clicked
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['user_name'];
    //5- create the sql query to be updated
    $sql = "UPDATE admins SET full_name = '$full_name', `user_name` = '$username'  WHERE id = '$id'";
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





