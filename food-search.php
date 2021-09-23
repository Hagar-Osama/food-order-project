<?php include_once "front-end_assets/header.php" ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php 
        //get the search keyword
        $search = mysqli_real_escape_string($connection, $_POST['search']);
        ?>
        <h2>Foods on Your Search <a href="#" class="text-white">"<?=$search;?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //write sql statment to get the food data 
        $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR `description` LIKE '%$search%'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_affected_rows($connection) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {

                $id = $data['id'];
                $title = $data['title'];
                $price = $data['price'];
                $description = $data['description'];
                $image = $data['image'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if (! empty($image)) : ?>
                        <img src="<?= SITEURL; ?>images/food/<?=$image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
                    <?php endif; ?>

                    <div class="food-menu-desc">
                        <h4><?=$title; ?></h4>
                        <p class="food-price">$<?=$price; ?></p>
                        <p class="food-detail">
                            <?=$description; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food Not Found</div>";
        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include_once "front-end_assets/footer.php" ?>