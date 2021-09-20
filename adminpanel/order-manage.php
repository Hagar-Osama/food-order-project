<?php include_once "../includes/header.php";
$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = mysqli_query($connection, $sql);

?>

<!-- Main Content Section Ends -->

<!-- Menu Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Order Manage</h1>

        <br /> <br />
        <a href="#" class="btn-primary">Add Order</a>
        <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Food</th>
                <th>price</th>
                <th>Qty</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
                <!-- use while loop get all the data from database -->
                <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <tr>
                    <td><?=$i++;?></td>
                    <td><?=$data['food'];?></td>
                    <td><?=$data['price'];?></td>
                    <td><?=$data['qty'];?></td>
                    <td><?=$data['order_date'];?></td>
                    <td><?=$data['status'];?></td>
                    <td><?=$data['total'];?></td>
                    <td><?=$data['full-name'];?></td>
                    <td><?=$data['contact'];?></td>
                    <td><?=$data['email'];?></td>
                    <td><?=$data['address'];?></td>
                    <td> 
                        <a href="<?=SITEURL;?>adminpanel/update_order.php?id=<?=$data['id'];?>" class="btn-secondary">Update</a>
                    </td>
            </tr>
        <?php endwhile; ?>
        </table>

    </div>
</div>

<!-- Main Content Section Ends -->

<?php include_once "../includes/footer.php" ?>