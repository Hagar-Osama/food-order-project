<?php include_once "../includes/header.php" ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br />
        <?php if (!empty($_SESSION['validation-errors'])) : ?>
            <?php foreach ((array) $_SESSION['validation-errors'] as $error) : ?>
                <div class="alert alert-danger">
                    <span><?= $error; ?></span>
                </div>
            <?php endforeach;  ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="success">
                <span><?= $_SESSION['error']; ?></span>
            </div>
        <?php endif; ?>


        <br /> <br />
        <form action="../controllers/food/add.php" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter Title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" col="30" rows="5" placeholder="Food Description"></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Category ID</td>
                    <td> <select name="category_id">

                            <?php //write sql to get active category from database
                            $sql = "SELECT id , title FROM categories WHERE active = 'yes'";
                            //execute the statment
                            $result = mysqli_query($connection, $sql);
                            //check if statment executed
                            if (mysqli_affected_rows($connection) > 0) {
                                //get the data from database
                                while ($data = mysqli_fetch_assoc($result)) {
                                    $id = $data['id'];
                                    $title = $data['title'];
                            ?>
                                    <option value="<?= $id; ?>"><?= $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td><input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>

                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>

                </tr>
                <tr class="2">
                    <td><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>





<?php include_once "../includes/footer.php";
unset($_SESSION['validation-errors']);
unset($_SESSION['error']);
unset($_SESSION['success']); ?>