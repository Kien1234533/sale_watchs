<!-- Nguyễn Tâm An -->

<?php

session_start();
require_once './config/database.php';
spl_autoload_register(function ($className) {
    require_once "./app/models/$className.php";
});
$userModel = new UserModel();

$idUser = $_SESSION['idUser'];

$totalPrice = 0;

//Xóa sản phẩm trong giỏ hàng
if (isset($_POST['deleteProduct'])) {
    $idProduct = $_POST['deleteProduct'];
    $userModel->deleteProductInCart($idUser, $idProduct);
}


//Xóa toàn bộ sản phẩm trong giỏ hàng
if (isset($_POST['buy'])) {
    if ($userModel->deleteAllProductInCart($idUser)) {
?>
<script>
    window.alert("BUY successful");
</script>
<?php
    }
}


$productListInCart = $userModel->getAllProductInCart($idUser);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cart</title>

    <!-- Bootstrap -->
    <link href="http://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <a href="index.php" style="
    overflow: hidden;
    font-size: 14px;
    color: #288ad6;
    line-height: 16px;
    padding: 10px;">

        <button type="button" class="btn btn-info">&#60; Buy more products</button>
    </a>
    <div class="container">
        <h1>My cart</h1>

        <table class="table">
            <tr>
                <td><b>Product</b></td>
                <td><b>Name</b></td>
                <td><b>Price</b></td>
                <td><b>Action</b></td>
            </tr>
            <?php
            foreach ($productListInCart as $items) {
                $totalPrice += (int) $items['product_price'];
            ?>
            <tr>
                <!-- Hình ảnh -->
                <td>

                    <a href="product.php?id=<?php echo $items['id'] ?>">
                        <img src="public/images/<?php echo $items['product_photo'] ?>" alt="" width="100px">
                    </a>

                </td>
                <!-- Tên sản phẩm -->
                <td>

                    <?php echo $items['product_name'] ?>

                </td>
                <!-- Giá tiền -->
                <td>
                    <?php echo $items['product_price'] ?>
                </td>

                <!-- Hành động -->
                <td>
                    <form action="cart.php" method="post" onsubmit="return confirm('Remove products in cart?')">
                        <input type="hidden" name="deleteProduct" value="<?php echo $items['id'] ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
            <?php
            }

            ?>
        </table>
        <strong style="float: left; margin: 5px;">Total Price:
            <?php echo ($totalPrice) ?> Đ
        </strong>





        <form action="cart.php" method="post">
            <input type="hidden" name="buy" value="<?php
            // đã có sản phẩm trong giỏ hàng
            if (count($productListInCart) != 0) {
                echo $items['id'];
            } ?>">
            <button type="submit" class="btn btn-success">BUY</button>
        </form>

    </div>

</body>

</html>