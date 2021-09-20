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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //writing sql query to display food
        $sql = "SELECT * FROM food WHERE active = 'yes'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_affected_rows($connection) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include_once "front-end_assets/footer.php" ?>
