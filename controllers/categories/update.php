<?php include_once "../../includes/config.php";
$_SESSION['validation-errors'] = [];
//check if button clicked
if (isset($_POST['update'])) {
    //1- get data from form
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $categorytitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    $current_image = $_POST['current_image'];

    //make validations  
    if (empty($categorytitle)) {
        $_SESSION['validation-errors'][] = 'No title has been entered';
    } elseif (strlen($categorytitle) < 5) {
        $_SESSION['validation-errors'][] = 'title must be greater than 4 char';
    } else if (strlen($categorytitle) > 20) {
        $_SESSION['validation-errors'][] = 'title must be less than 21 char';
    }
    //check if upload button is clicked or not
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];
        $image_size = $_FILES['image']['size'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = rand() . '.' . $image_extension;
        $data = move_uploaded_file($image_tmp, '../../images/categories/' .$image_new_name);
        //    var_dump($data);
        //    die();

        // remove the old image
        if (!empty($current_image)) {
            //image is available
            $remove_path = "../../images/categories/" .$current_image;
            $remove = unlink($remove_path);
            if ($remove == false) {
                $_SESSION['error'] = "Image Failed To Be Removed.";
                header("location:" . SITEURL . "adminpanel/category-manage.php");
            } else {
                // upload button not clicked
                $image_name = $current_image;
            }
        }
    }

    //check empty errors
    if (!empty($_SESSION['validation-errors'])) {
        header('location:' . SITEURL . 'adminpanel/update_category.php');
    } else
        //5- create the sql query to be updated
        $sql = "UPDATE categories SET title = '$categorytitle', featured = '$featured', active = '$active', `image` = '$image_new_name' WHERE id = '$id'";
    //     echo $sql;
    //    die();
    //execute the query
    $result = mysqli_query($connection, $sql);
    // var_dump($result);
    // die();
    if (mysqli_affected_rows($connection) > 0) {
        // 6- redirect to category-manage page with message
        $_SESSION['success'] = "Category Updated Successfully.";
        header("location:" . SITEURL . "adminpanel/category-manage.php");
    } else {
        $_SESSION['error'] = "Category Failed To Be Updated.";
        header("location:" . SITEURL . "adminpanel/category-manage.php");
    }
}
///cant make update without changing the image???