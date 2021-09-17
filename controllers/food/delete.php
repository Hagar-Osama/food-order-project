<?php include_once "../../includes/config.php";
//get the id & image to be deleted
if (isset($_GET['id']) && ! empty($_GET['id'])) {
    $id = (int) $_GET['id'];

    //remove the image if available 
    if ($image_name != "") {
        $remove = unlink($image_name);
        // echo $remove;
        // die();
        // if removing process failed display an error message
        $_SESSION['error'] = "Image Failed To Be Deleted.";
        header("location:". SITEURL."adminpanel/food-manage.php");
    }
     //query to delete the id
    $sql = "DELETE FROM food WHERE id = '$id'";
    // echo $sql;
    // die();
    //execute the quey
    $result = mysqli_query($connection, $sql);
   
    //check if the sql statment is executed
    if (mysqli_affected_rows($connection) > 0) {
          // 3- redirect to admin-manage page with message
          $_SESSION['success'] = "Food Deleted Successfully.";
          header("location:". SITEURL."adminpanel/food-manage.php");
      }else {
          $_SESSION['error'] = "Food Failed To Be Deleted.";
          header("location:". SITEURL."adminpanel/food-manage.php");
      }
    
}
