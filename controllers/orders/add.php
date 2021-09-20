<?php include_once "../../includes/config.php";


if (isset($_POST['submit'])) {
    //get the data from the form
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date("y-m-d h:i:sa");
    $status = "ordered"; //deivered, on delivery, ordered, cancelled
    $fullname =$_POST['full-name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email= $_POST['email'];
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