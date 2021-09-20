<?php include_once "front-end_assets/header.php" ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        $sql = "SELECT * FROM categories WHERE active = 'yes'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_affected_rows($connection) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $title = $row['title'];
                $image = $row['image'];
        ?>
                <a href="<?=SITEURL;?>category-foods.php?category_id=<?=$id;?>">
                    <div class="box-3 float-container">
                        <?php if (! empty($image)) : ?>
                        <img src="<?= SITEURL;?>images/categories/<?=$image;?>" alt="Pizza" class="img-responsive img-curve">
                        <?php endif; ?>
                        <h3 class="float-text text-white"><?=$title;?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'>category not found</div>";
        }
        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include_once "front-end_assets/footer.php" ?>