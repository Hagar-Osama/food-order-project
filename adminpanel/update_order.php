<?php include_once "../includes/header.php"; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br /> <br />
        <form action="../controllers/orders/update.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td></td>
                </tr>
                <tr>
                    <td>QTY</td>
                    <td>
                        <input type="number" name="qty" value="">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option value="ordered">Ordered</option>
                            <option value="on Delivery">On Delivery</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>

                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="full-name" value="">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="address" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <td>Customer Email</td>
                <td>
                    <input type="text" name="email" value="">
                </td>
                </tr>
                <td>Customer Contact</td>
                <td>
                    <input type="text" name="contact" value="">
                </td>
                </tr>
                <tr>
                    <td><input type="submit" name="update" value="Update Order" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>




<?php include_once "../includes/footer.php"; ?>