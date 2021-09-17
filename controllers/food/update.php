<?php include_once "../../includes/config.php";
$_SESSION ['validation-errors'] = [];
//check if button clicked
if (isset($_POST['update'])) {
    // echo 'clicked';
    // die();
    //1- get data from form
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    $category_id = $_POST['category_id'];
    $current_image = $_POST['current_image'];



    //make validations  
    if (empty($title)) {
        $_SESSION['validation-errors'][] = 'No title has been entered';
    } elseif (strlen($title) < 5) {
        $_SESSION['validation-errors'][] = 'title must be greater than 4 char';
    } else if (strlen($title) > 20) {
        $_SESSION['validation-errors'][] = 'title must be less than 21 char';
    }
    if (empty($description)) {
        $_SESSION['validation-errors'][] = 'No description has been entered';
    } elseif (strlen($description) < 20) {
        $_SESSION['validation-errors'][] = 'description must be greater than 19 char';
    } else if (strlen($description) > 200) {
        $_SESSION['error'][] = 'description must be less than 201 char';
    }
    if (empty($price)) {
        $_SESSION['validation-errors'][] = 'Price must be entered';
    } elseif (!is_numeric($price) || $price <= 0) {
        $_SESSION['validation-errors'][] = 'Price must be a number and greater than zero';
    }
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];
        $image_size = $_FILES['image']['size'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = rand() . '.' . $image_extension;
        $data = move_uploaded_file($image_tmp, '../../images/food/' .$image_new_name);
        //    var_dump($data);
        //    die();
           // remove the old image
           if (! empty($current_image)) {
            //image is available
            $remove_path = "../../images/food/" .$current_image;
            $remove = unlink($remove_path);
            if ($remove == false) {
                $_SESSION['error'] = "Image Failed To Be Removed.";
                header("location:" . SITEURL . "adminpanel/food-manage.php");
            } else {
                // upload button not clicked
                $image_name = $current_image;
            }
        }

    }
    //check empty errors
    if (! empty($_SESSION['validation-errors'])) {
        header('location:' . SITEURL . 'adminpanel/update_food.php');
    } else
        //5- create the sql query to be updated
        $sql = "UPDATE food SET title = '$title', `description` = '$description', price = $price, category_id = '$category_id', featured = '$featured', active = '$active', `image` = '$image_new_name'  WHERE id = '$id'";
        echo $sql;
       die();
    //execute the query
    $result = mysqli_query($connection, $sql);
    // var_dump($result);
    // die();
    if (mysqli_affected_rows($connection) > 0) {
        // 6- redirect to food-manage page with message
        $_SESSION['success'] = "Food Updated Successfully.";
        header("location:" . SITEURL . "adminpanel/food-manage.php");
    } else {
        $_SESSION['error'] = "Food Failed To Be Updated.";
        header("location:" . SITEURL . "adminpanel/food-manage.php");
    }
}