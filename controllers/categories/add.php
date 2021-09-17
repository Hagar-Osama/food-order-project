<?php
include_once "../../includes/config.php";
$_SESSION['validation-errors'] = [];
 //process the value from the form and store it in the database
//check whether the bhtton is clicked or not

if (isset($_POST['submit'])) {

    //button clicked

    //1- get data from form

    $categorytitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $featured = filter_var($_POST['featured'], FILTER_SANITIZE_STRING);
    $active = filter_var($_POST['active'], FILTER_SANITIZE_STRING);
    $image_name = filter_var($_POST['image'],FILTER_SANITIZE_STRING);


    //make validations  
    if (empty($categorytitle)) {
       $_SESSION ['validation-errors'] [] = 'No title has been entered';
      } elseif (strlen($categorytitle) < 5) {
          $_SESSION ['validation-errors'] [] = 'title must be greater than 4 char';
      }else if (strlen($categorytitle) > 20) {
          $_SESSION['validation-errors'] [] = 'title must be less than 21 char';
       } 
       if (empty($featured)) {
        $_SESSION ['validation-errors'] [] = 'No Featured Has Been Chosen'; 
       }
       if (empty($active)) {
        $_SESSION ['validation-errors'] [] = 'No Active Has Been Chosen'; 
       }
       if (! empty($_FILES['image'])) {
           $image_name = $_FILES['image']['name'];
           $image_type = $_FILES['image']['type'];
           $image_tmp = $_FILES['image']['tmp_name'];
           $image_error = $_FILES['image']['error'];
           $image_size = $_FILES['image']['size'];
           $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_new_name = rand(). '.'.$image_extension;
           $data = move_uploaded_file($image_tmp,'../../images/categories/'.$image_new_name);
        //    var_dump($data);
        //    die();

       }
       if (empty($image_name)) {
        $_SESSION ['validation-errors'] [] = 'No Image Has Been Chosen'; 
       }
         //check empty errors
       if (! empty($_SESSION['validation-errors'])) {
        header('location:'.SITEURL.'adminpanel/add_category.php');
       }else 
  
    //2- sql query to save the data in the database

    $sql = "INSERT INTO categories  (title, featured, active, `image` ) VALUES ('$categorytitle', '$featured', '$active', '$image_new_name')";
    //3- make connection and execute qury and save into database

    $result = mysqli_query($connection, $sql);

    //4- check whether query is excuted (data inserted) or not and display a success or error message

    if (mysqli_affected_rows($connection) > 0) {
        // echo 'good';
        $_SESSION['success'] = 'Data inserted succussfully';
        header('location:'.SITEURL.'adminpanel/category-manage.php');
    } else {
        echo 'error '. mysqli_error($connection);
    }
}




