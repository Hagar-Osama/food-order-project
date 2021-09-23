<?php include_once "../../includes/config.php";
if (isset($_POST['submit'])) {
    //get the data from the form
    $food = $_POST['food'];
    $price = htmlspecialchars($_POST['price']);
    $qty = filter_var($_POST['qty'],FILTER_VALIDATE_INT);
    $total = $price * $qty;
    $order_date = date("y-m-d h:i:sa");
    $status = "ordered"; //deivered, on delivery, ordered, cancelled
    $fullname = filter_var($_POST['full-name'],FILTER_SANITIZE_STRING);
    $contact = filter_var($_POST['contact'],FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    //save data in database 
    $sql2 = "INSERT INTO orders  (food, price, qty, total, order_date, `status`,`full-name`,contact, `address`, email) VALUES ('$food', '$price', '$qty', '$total', '$order_date', '$status', '$fullname', '$contact', '$address', '$email')";
    $res = mysqli_query($connection, $sql2);
    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['order'] = "<div class='success text-center'>Order Done successfully</div>";
        header('location:' . SITEURL);
    } else {
        $_SESSION['failed'] = '<div clas="error text-center">Order Failed To Be Placed</div>';
        header('location:' . SITEURL);
    }
}






?>