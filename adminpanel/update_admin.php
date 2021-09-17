<?php include_once "../includes/header.php";
$full_name = '';
$username = '';
//1- get the id for the update

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];
    //2- create sql query to get the values
    $sql = "SELECT * FROM admins WHERE id = '$id'";
    //3- execute the query 
    $result = mysqli_query($connection, $sql);
    //4- check whether the query created successfully or not
    if (mysqli_affected_rows($connection) > 0) {
        //5- get the data
        $data = mysqli_fetch_assoc($result);
        $full_name = $data['full_name'];
        $username = $data['user_name'];
        // if data not found
    } else {
        $_SESSION['error'] = "Admin not found";
        header("location:" . SITEURL . "adminpanel/update_admin.php");
    }
}







?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br />

        <form action="../controllers//admins/update.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Full Name" value="<?= $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="user_name" placeholder="Enter Your User Name" value="<?= $username; ?>"></td>
                    <input type="hidden" name="id" value="<?= $id; ?>">
                </tr>
                <tr class="2">
                    <td><input type="submit" name="update" value="Update Admin" class="btn-secondary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>






<?php include_once "../includes/footer.php" ?>