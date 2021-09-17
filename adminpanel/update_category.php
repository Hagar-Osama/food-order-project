<?php include_once "../includes/header.php";
$title = "";
//get the id to be updated
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];
    //2- create sql query to get the values
    $sql = "SELECT * FROM categories WHERE id = '$id'";
    //3- execute the query 
    $result = mysqli_query($connection, $sql);
    //4- check whether the query created successfully or not
    if (mysqli_affected_rows($connection) > 0) {
        //5- get the data
        $data = mysqli_fetch_assoc($result);
        $title = $data['title'];
        $featured = $data['featured'];
        $active = $data['active'];
        $current_image = $data['image'];

        // if data not found
    } else {
        $_SESSION['error'] = "Category not found";
        header("location:" . SITEURL . "adminpanel/update_category.php");
    }
}





?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br />

        <form action="../controllers/categories/update.php" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter Title" value="<?= $title; ?>"></td>

                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td><?php if (!empty($current_image)) : ?>
                            <img src="<?= SITEURL; ?>images/categories/<?= $current_image; ?>" width="100px" height="100px">
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
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
                        <input type="submit" name="update" value="Update category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php include_once "../includes/footer.php" ?>