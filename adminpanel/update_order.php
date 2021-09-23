<?php include_once "../includes/header.php"; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br />
        <?php if (! empty($_SESSION['validation-errors'])) : ?>
            <?php foreach ((array) $_SESSION['validation-errors'] as $error) : ?>
                <div class="alert alert-danger">
                    <span><?= $error; ?></span>
                </div>
            <?php endforeach;  ?>
        <?php endif; ?>
        <?php 
        if (isset($_GET['id']))  {
            $id = $_GET['id'];
            $sql = "SELECT * FROM orders WHERE id = '$id'";
            $result = mysqli_query($connection, $sql);
            if (mysqli_affected_rows($connection) > 0) {
                $data = mysqli_fetch_assoc($result);
                $food = $data['food'];
                    $price = $data['price'];
                    $qty = $data['qty'];
                    $order_date = $data['order_date'];
                    $status = $data['status'];
                    $fullname =$data['full-name'];
                    $customer_contact = $data['contact'];
                    $email =$data['email'];
                    $customer_address =$data['address'];
            }else {
                $_SESSION['error'] = "Order not found";
                header("location:".SITEURL."adminpanel/order-manage.php");
            }
        }else {
            header("location:".SITEURL."adminpanel/order-manage.php");
        }
        
        ?>

        <br /> <br />
        <form action="../controllers/orders/update.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><?=$food;?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?=$price;?></td>
                </tr>
                <tr>
                    <td>QTY</td>
                    <td>
                        <input type="number" name="qty" value="<?=$qty;?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?= ! empty($status) && $status == 'ordered' ? "selected" : "";?> value="ordered">Ordered</option>
                            <option <?= ! empty($status) && $status == 'on delivery' ? "selected" : "";?> value="on delivery">On Delivery</option>
                            <option <?= ! empty($status) && $status == 'delivered' ? "selected" : "";?>  value="delivered">Delivered</option>
                            <option <?= ! empty($status) && $status == 'cancelled' ? "selected" : "";?>  value="cancelled">Cancelled</option>

                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="full-name" value="<?=$fullname;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="address" cols="30" rows="5"><?=$customer_address;?></textarea>
                    </td>
                </tr>
                <td>Customer Email</td>
                <td>
                    <input type="text" name="email" value="<?=$email;?>">
                </td>
                </tr>
                <td>Customer Contact</td>
                <td>
                    <input type="text" name="contact" value="<?=$customer_contact;?>">
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type = "hidden" name="id" value="<?=$id;?>">
                    <input type = "hidden" name="price" value="<?=$price;?>">
                    <input type="submit" name="update" value="Update Order" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php unset($_SESSION['validation-errors']) ?>
<?php include_once "../includes/footer.php"; ?>