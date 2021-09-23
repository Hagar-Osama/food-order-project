<?php include_once "../includes/header.php";

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];
}


?>



<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <br />

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Curent Password:</td>
                    <td><input type="password" name="current_password" placeholder="current password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="new password"></td>

                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="confirm Your password"></td>
                </tr>
                <tr class="2">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <td><input type="submit" name="update" value="Change Password" class="btn-secondary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>


<?php

//1- check if button is clicked
if (isset($_POST['update'])) {
    //2- get the data from the form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    //3- check whether the user with current id and password exists or not
    $sql = "SELECT `password` FROM admins WHERE id = '$id'";
    // echo $sql;
    // die();
    //4- execute the sql statment
    $result = mysqli_query($connection, $sql);
    //5- check whether the data exists or not
    if (mysqli_affected_rows($connection) > 0) {
        //user exists
        //check whether new and confirm password match
        if ($new_password == $confirm_password) {
            $sql2 = "UPDATE admins SET `password` = '$new_password' WHERE id = '$id'";
            // echo $sql2;
            // die();
            //execute query
            $result2 = mysqli_query($connection, $sql2);
            //check query created or not
            if (mysqli_affected_rows($connection) > 0) {
                //password changed 
                $_SESSION['success'] = "Password Changed Successfully";
                header("location:" . SITEURL . "adminpanel/admin-manage.php");
            } else {
                //password doesn't change
                $_SESSION['error'] = "Password Failed to Be created";
                header("location:" . SITEURL . "adminpanel/admin-manage.php");
            }
        } else {
            //user doesn't exist
            $_SESSION['error'] = "User Doesn't Exist";
            header("location:" . SITEURL . "adminpanel/admin-manage.php");
        }
    }
}




?>















<?php include_once "../includes/footer.php" ?>;