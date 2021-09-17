<?php include_once "../includes/header.php" ?>
<?php
$sql = "SELECT * FROM categories"; //query to get the data
$result = mysqli_query($connection, $sql); //excute the query

?>
    <!-- Main Content Section Ends -->

    <!-- Menu Section Starts -->
    <div class="main-content">
        <div class="wrapper">
         <h1>Category Manage</h1>
         <br />
         <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <span><?= $_SESSION['success']; ?></span>
            </div>
        <?php endif; ?>
         <br /> <br />
        <a href="<?=SITEURL; ?>adminpanel/add_category.php" class="btn-primary">Add Category</a>
        <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Title</th>
                <th>Featured</th>
                <th>Active</th>
                <th>image</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <!-- use while loop get all the data from database -->
            <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?=$data['title']; ?></td>
                <td><?=$data['featured']; ?></td>
                <td><?=$data['active']; ?></td>
                <td><?php if (! empty($data['image'])): ?>
                <img src= "<?= SITEURL; ?>images/categories/<?=$data['image']; ?>"width= "100px" height="100px"> 
                <?php endif; ?></td>
                <td> <a href="<?=SITEURL;?>adminpanel/update_category.php?id=<?=$data['id']; ?>" class="btn-secondary">Update</a>
                     <a href="<?=SITEURL;?>controllers/categories/delete.php?id=<?=$data['id']; ?>&image=<?=$data['image']; ?>" class="btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>

        </table>
         

        </div>
    </div>

    <!-- Main Content Section Ends -->

    <?php unset($_SESSION['success']);
    include_once "../includes/footer.php" ?>