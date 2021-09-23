<?php include_once "../includes/header.php" ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />
        <?php if (! empty($_SESSION['validation-error'])) : ?>
            <?php foreach ((array) $_SESSION['validation-error'] as $error) : ?>
                <div class="alert alert-danger">
                    <span><?= $error; ?></span>
                </div>
            <?php endforeach;  ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="success">
                <span><?= $_SESSION['error']; ?></span>
            </div>
        <?php endif; ?>
        <br /> <br />
        <form action="../controllers/admins/add.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Full Name"></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="user_name" placeholder="Enter Your User Name"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your password"></td>
                </tr>
                <tr class="2">
                    <td><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>





<?php include_once "../includes/footer.php";
 unset($_SESSION['validation-error']);
 unset($_SESSION['error']); ?>