<?php include_once "front-end_assets/header.php" ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?=SITEURL;?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php if (isset($_SESSION['order'])) : ?>
            <div class="order">
                <span><?= $_SESSION['order']; ?></span>
                <?php unset($_SESSION['order']);?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['failed'])) : ?>
            <div class="failed">
                <span><?= $_SESSION['failed']; ?></span>
                <?php unset($_SESSION['failed']);?>
            </div>
        <?php endif; ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        //create sql statment to display category
        $sql = "SELECT * FROM categories WHERE active = 'yes' AND featured = 'yes' LIMIT 3";
        //excute the statment
        $result = mysqli_query($connection, $sql);
        if (mysqli_affected_rows($connection) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $id = $data['id'];
                $title = $data['title'];
                $image = $data['image'];
        ?>
                <a href="<?=SITEURL;?>category-foods.php?category_id=<?=$id;?>">
                    <?php if (!empty($image)) : ?>
                        <div class="box-3 float-container">
                            <img src="<?= SITEURL; ?>images/categories/<?= $image; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php endif; ?>
                        <h3 class="float-text text-white"><?= $title; ?></h3>
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

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //writing sql query to display food
        $sql2 = "SELECT * FROM food WHERE active = 'yes' AND featured = 'yes' LIMIT 6";
        $result2 = mysqli_query($connection, $sql2);
        if (mysqli_affected_rows($connection) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image = $row['image'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if (! empty($image)) : ?>
                        <img src="<?= SITEURL; ?>images/food/<?= $image; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php endif; ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?= $title; ?></h4>

                        <p class="food-price">$<?= $price; ?></p>
                        <p class="food-detail">
                            <?= $description; ?>
                        </p>
                        <br>

                        <a href="<?=SITEURL;?>order.php?food_id=<?=$id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php

            }
        } else {
            echo "<div class='error'>category not found</div>";
        }
        ?>




        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include_once "front-end_assets/footer.php" ?>