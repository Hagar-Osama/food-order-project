<?php include_once "../includes/header.php" ?>
<?php
$sql = "SELECT * FROM admins"; //query to get the data
$result = mysqli_query($connection, $sql); //excute the query

?>

<!-- Main Content Section Ends -->

<!-- Menu Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Admin Manage</h1>
        <br />
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <span><?= $_SESSION['success']; ?></span>
            </div>
        <?php endif; ?>
       
        <br /> <br />
        <a href="<?=SITEURL; ?>adminpanel/add_admin.php" class="btn-primary">Add Admin</a>
        <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Full Name</th>
                <th>UserName</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <!-- use while loop get all the data from database -->
            <?php while ($data = mysqli_fetch_assoc($result)) : ?>

                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $data['full_name']; ?></td>
                    <td><?= $data['user_name']; ?></td>
                    <td> <a href="<?= SITEURL; ?>adminpanel/update_password.php?id=<?= $data['id']; ?>" class="btn-primary">Update Password</a>
                        <a href="<?= SITEURL; ?>adminpanel/update_admin.php?id=<?= $data['id']; ?>" class="btn-secondary">Update</a>
                        <a href="<?= SITEURL; ?>controllers/admins/delete.php?id=<?= $data['id']; ?>" class="btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>


    </div>
</div>

<!-- Main Content Section Ends -->

<?php include_once "../includes/footer.php";
unset($_SESSION['success']);
unset($_SESSION['error']); ?>