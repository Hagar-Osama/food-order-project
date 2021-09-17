<?php
include_once "../../includes/config.php";
$_SESSION['validation-errors'] = [];
//process the value from the form and store it in the database
//check whether the bhtton is clicked or not

if (isset($_POST['submit'])) {

    //button clicked

    //1- get data from form

    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
    $featured = filter_var($_POST['featured'], FILTER_SANITIZE_STRING);
    $active = filter_var($_POST['active'], FILTER_SANITIZE_STRING);
    $category_id = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);


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
    if (empty($featured)) {
        $_SESSION['validation-errors'][] = 'No Featured Has Been Chosen';
    }
    if (empty($active)) {
        $_SESSION['validation-errors'][] = 'No Active Has Been Chosen';
    }
    if (!empty($_FILES['image'])) {
        $image_name = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];
        $image_size = $_FILES['image']['size'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = rand() . '.' . $image_extension;
        $data = move_uploaded_file($image_tmp, '../../images/food/' . $image_new_name);
        //    var_dump($data);
        //    die();

    }
    if (empty($image_name)) {
        $_SESSION['validation-errors'][] = 'No Image Has Been Chosen';
    }
    //check empty errors
    if (!empty($_SESSION['validation-errors'])) {
        header('location:' . SITEURL . 'adminpanel/add_food.php');
    } else

        //2- sql query to save the data in the database

        $sql = "INSERT INTO food  (title, `description`, price, category_id, featured, active, `image` ) VALUES ('$title', '$description', '$price', '$category_id', '$featured', '$active', '$image_new_name')";
    //3- make connection and execute qury and save into database
    // echo $sql;
    // die();

    $result = mysqli_query($connection, $sql);

    //4- check whether query is excuted (data inserted) or not and display a success or error message

    if (mysqli_affected_rows($connection) > 0) {
        // echo 'good';
        $_SESSION['success'] = 'Data inserted succussfully';
        header('location:' . SITEURL . 'adminpanel/food-manage.php');
    } else {
        echo 'error ' . mysqli_error($connection);
    }
}
