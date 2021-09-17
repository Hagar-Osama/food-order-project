<?php
 include_once '../../includes/config.php';
// 1- get the id to be deleted{
if (isset($_GET['id']) && ! empty($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sql = "SELECT * FROM admins WHERE id = '$id'";
    //execute the query
    $result = mysqli_query($connection, $sql);
    // check whether the query created successfully or not
    if (mysqli_affected_rows($connection) > 0) {
        //get the data
        $data = mysqli_fetch_assoc($result);
    }
    // 2- create the sql query to be deleted
    $sql = "DELETE FROM admins WHERE id = '$id'";
    //execute the query
    $result = mysqli_query($connection, $sql);
    if (mysqli_affected_rows($connection) > 0) {
        // 3- redirect to admin-manage page with message
        $_SESSION['success'] = "Admin Deleted Successfully.";
        header("location:". SITEURL."adminpanel/admin-manage.php");
    }else {
        $_SESSION['error'] = "Admin Failed To Be Deleted.";
        header("location:". SITEURL."adminpanel/admin-manage.php");
    }


}
