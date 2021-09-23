<?php include_once "../../includes/config.php";
$_SESSION['validation-errors'] = [];
if (isset($_POST['update'])) {

    //get the data from the form
    $id = filter_var($_POST['id'],FILTER_VALIDATE_INT);
    $price = htmlspecialchars($_POST['price']);
    $qty = filter_var($_POST['qty'],FILTER_VALIDATE_INT);
    $total = $price * $qty;
    $status = $_POST['status']; //deivered, on delivery, ordered, cancelled
    $fullname = filter_var($_POST['full-name'],FILTER_SANITIZE_STRING);
    $contact = filter_var($_POST['contact'],FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);

    if (empty($qty)) {
        $_SESSION ['validation-errors'] [] = 'quantity must be entered';
    }elseif (! is_numeric($qty) || $qty <= 0) {
        $_SESSION ['validation-errors'] [] = 'quantity must be a number and greater than zero';
    }
    if (empty($fullname)) {
        $_SESSION ['validation-errors'][] = 'Firstname is required';
    }elseif (strlen($fullname) > 50) {
        $_SESSION ['validation-errors'][] = 'Fullname must be less than 51 char';
    }elseif (strlen($fullname) < 5) {
        $_SESSION ['validation-errors'][] = 'Fullname must be greater than 5 char';
    
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION ['validation-errors'][] = 'Email is Invaild';
    }elseif (strlen($email) > 30) {
        $_SESSION ['validation-errors'][] = 'email must be less than 31 char';
    }elseif (strlen($email) < 9) {
        $_SESSION ['validation-errors'][] = 'email must be greater than 9 char';
    }elseif (empty($email)) {
        $_SESSION ['validation-errors'][] = 'email is required';
    } 
    if (empty($contact)) {
        $_SESSION ['validation-errors'][] = 'Phone is required';
    }elseif (strlen($contact) > 20) {
        $_SESSION ['validation-errors'][] = 'Phone must be less than 20 char';
    }elseif (strlen($contact) < 5) {
        $_SESSION ['errors'][] = 'Phone must be greater than 5 char';
    
    }
    if (empty($address)) {
        $_SESSION ['validation-errors'][] = 'Address is required';
    }elseif (strlen($address) > 50) {
        $_SESSION ['validation-errors'][] = 'Address must be less than 51 char';
    }elseif (strlen($address) < 5) {
        $_SESSION ['validation-errors'][] = 'Address must be greater than 5 char';
    
    }
    //check empty errors
 if(! empty($_SESSION['validation-errors'])) {
    header('location:'.SITEURL.'adminpanel/update_order.php');
}
    //update data in database 
    $sql = "UPDATE orders SET qty = '$qty', total = '$total', `status` = '$status', `full-name` = '$fullname', contact = '$contact', `address` = '$address', email = '$email' WHERE id = '$id'";
    // echo $sql;
    // die();
    //execute the query
    $result = mysqli_query($connection, $sql);
    if (mysqli_affected_rows($connection) > 0) {
        // 6- redirect to category-manage page with message
        $_SESSION['success'] = "Order Updated Successfully.";
        header("location:" . SITEURL . "adminpanel/order-manage.php");
    } else {
        $_SESSION['error'] = "Order Failed To Be Updated.";
        header("location:" . SITEURL . "adminpanel/order-manage.php");
    }
}
///cant see validation as well as admin