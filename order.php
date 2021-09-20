<?php include_once "front-end_assets/header.php";

if (isset($_GET['food_id'])) {
    //Get the food_id and details of the selected food
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM food WHERE id = '$food_id'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_affected_rows($connection) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image = $row['image'];
    } else {
        header("location:" . SITEURL);
    }
} else {
    header("location:" . SITEURL);
}


?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="<?=SITEURL;?>controllers/orders/add.php" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php if (!empty($image)) : ?>
                        <img src="<?= SITEURL; ?>images/food/<?= $image; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>
            <?php endif; ?>

            <div class="food-menu-desc">
                <h3><?= $title; ?></h3>
                <input type="hidden" name="food" value="<?= $title; ?>">
                <p class="food-price">$<?= $price; ?></p>
                <input type="hidden" name="price" value="<?= $price; ?>">

                <div class="order-label">Quantity</div>
                <input type="number" name="qty" class="input-responsive" value="1" required>

            </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include_once "front-end_assets/footer.php" ?>