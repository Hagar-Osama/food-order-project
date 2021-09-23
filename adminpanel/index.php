<?php include_once "../includes/header.php" ?>
<!-- Main Content Section Ends -->

<!-- Menu Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>DashBoard</h1>
        <br /> <br />
        <div class="col-4 text-center">
            <?php 
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($connection, $sql);
            $count = mysqli_num_rows($result);
            ?>
            <h1><?=$count;?></h1>
            <br />
            Categories
        </div>
        <div class="col-4 text-center">
        <?php 
            $sql = "SELECT * FROM food";
            $result = mysqli_query($connection, $sql);
            $count = mysqli_num_rows($result);
            ?>
            <h1><?=$count;?></h1>
            <br />
            Food
        </div>
        <div class="col-4 text-center">
        <?php 
            $sql = "SELECT * FROM orders";
            $result = mysqli_query($connection, $sql);
            $count = mysqli_num_rows($result);
            ?>
            <h1><?=$count;?></h1>
            <br />
            Total Order
        </div>
        <div class="col-4 text-center">
            <?php
            $sql = "SELECT SUM(total) AS total FROM orders WHERE status = 'delivered'";
            $result = mysqli_query($connection, $sql);
            $data = mysqli_fetch_assoc($result);
            $total_revenu = $data['total']
            ?>
            <h1>$<?=$total_revenu;?></h1>
            <br />
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include_once "../includes/footer.php" ?>