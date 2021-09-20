<?php include_once "front-end_assets/header.php";
//displaying the title of the category
//check id is passed or not
if (isset($_GET['category_id'])) {
    //get the id
    $category_id = $_GET['category_id'];
    //get the category title based on category id
    $sql = "SELECT title FROM categories WHERE id = '$category_id'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_affected_rows($connection) > 0) {
        $data = mysqli_fetch_assoc($result);
        $category_title = $data['title'];
    }
} else {
    //rediect to home page
    header("location:" . SITEURL);
}



?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?= $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //sql to get food based on selected category
        $sql2 = "SELECT * FROM food WHERE category_id = '$category_id'";
        $res = mysqli_query($connection, $sql2);
        if (mysqli_affected_rows($connection) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image = $row['image'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if (! empty($image))  : ?>
                        <img src="<?=SITEURL;?>images/food/<?=$image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
                    <?php endif; ?>

                    <div class="food-menu-desc">
                        <h4><?=$title;?></h4>
                        <p class="food-price">$<?=$price;?></p>
                        <p class="food-detail">
                            <?=$description;?>
                        </p>
                        <br>

                        <a href="<?=SITEURL;?>order.php?food_id=<?=$id;?>" class="btn btn-primary">Order Now</a>
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