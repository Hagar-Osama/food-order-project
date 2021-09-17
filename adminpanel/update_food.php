<?php include_once "../includes/header.php";
$title = "";
$description = "";
$price = "";
//get the id to be updated
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];
    //2- create sql query to get the values
    $sql = "SELECT * FROM food WHERE id = '$id'";
    //3- execute the query 
    $result = mysqli_query($connection, $sql);
    //4- check whether the query created successfully or not
    if (mysqli_affected_rows($connection) > 0) {
        //5- get the data
        $row2 = mysqli_fetch_assoc($result);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $data = $row2['price'];
        $category_id = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
        $current_image = $row2['image'];

        // if data not found
    } else {
        $_SESSION['error'] = "Category not found";
        header("location:" . SITEURL . "adminpanel/update_category.php");
    }
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br /> <br />
        <form action="../controllers/food/update.php" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?=$title;?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" col="30" rows="5" ><?=$description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" value="<?=$price;?>"></td>
                </tr>
                <tr>
                    <td>Category ID</td>
                    <td> <select name="category_id">
                    <?php //write sql to get active category from database
                            $sql = "SELECT id , title FROM categories WHERE active = 'yes'";
                            //execute the statment
                            $result = mysqli_query($connection, $sql);
                            //check if statment executed
                            if (mysqli_affected_rows($connection) > 0) {
                                //get the data from database
                                while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?= $id; ?>"><?= $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <td>Current Image:</td>
                    <td><?php if (! empty($current_image)) : ?>
                            <img src="<?= SITEURL; ?>images/food/<?= $current_image; ?>" width="100px" height="100px">
                        <?php endif; ?>

                        
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?= !empty($featured) && $featured == "yes" ? 'checked' : ""; ?> type="radio" name="featured" value="yes">Yes
                        <input <?= !empty($featured) && $featured == "no" ? 'checked' : ""; ?> type="radio" name="featured" value="no">No
                    </td>

                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input <?= !empty($active) && $active == "yes" ? 'checked' : ""; ?> type="radio" name="active" value="yes">Yes
                        <input <?= !empty($active) && $active == "no" ? 'checked' : ""; ?> type="radio" name="active" value="no">No
                    </td>

                </tr>
                <tr class="2">
                    <td><input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="hidden" name="current_image" value="<?= $current_image; ?>">
                    <td><input type="submit" name="update" value="Update Food" class="btn-secondary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php include_once "../includes/footer.php" ?>