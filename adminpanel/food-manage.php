<?php include_once "../includes/header.php";
$sql = "SELECT * FROM food";
// $sql2 = "SELECT * FROM food INNER JOIN categories ON food.category_id = categories.id"; //query to get the data
$result = mysqli_query($connection, $sql); //excute the query

?>

<!-- Main Content Section Ends -->

<!-- Menu Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Food Manage</h1>
        <br /> <br />
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <span><?= $_SESSION['success']; ?></span>
            </div>
        <?php endif; ?>
        <br /> <br />
        <a href="<?= SITEURL; ?>adminpanel/add_food.php" class="btn-primary">Add Food</a>
        <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>TITLE</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Category ID</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <!-- use while loop get all the data from database -->
            <?php while ($data = mysqli_fetch_assoc($result)) : ?>

                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $data['title']; ?></td>
                    <td><?= $data['price']; ?></td>
                    <td><?php if (!empty($data['image'])) : ?>
                            <img src="<?= SITEURL; ?>images/food/<?= $data['image']; ?>" width="100px" height="100px">
                        <?php endif; ?>
                    </td>
                    <td><?= $data['featured']; ?></td>
                    <td><?= $data['active']; ?></td>
                    <td><?= $data['category_id']; ?></td>
                    <td> <a href="<?= SITEURL; ?>adminpanel/update_food.php?id=<?= $data['id']; ?>" class="btn-secondary">Update</a>
                        <a href="<?= SITEURL; ?>controllers/food/delete.php?id=<?= $data['id']; ?>" class="btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>


    </div>
</div>

<!-- Main Content Section Ends -->

<?php unset($_SESSION['success']);
include_once "../includes/footer.php" ?>