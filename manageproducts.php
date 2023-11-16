<!-- header('Location: manageproducts'); -->
<?php
// Nguyễn Tâm An //
include 'rangeAdmin.php';
require_once './config/database.php';
spl_autoload_register(function ($className) {
    require_once "./app/models/$className.php";
});


// lấy sản phẩm
$productModel = new ProductModel();
//xóa sản phẩm
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
   $productModel->deleteProduct($id) ;
        
    }

$productList = $productModel->getAllProducts();

// Thông báo 
if (isset($_SESSION['update']) && $_SESSION['update'] == true) {
    unset($_SESSION['update']);
?>
<script>
    window.alert("Update successful")
</script>
<?php
} else if (isset($_SESSION['update']) && $_SESSION['update'] == false) {
    unset($_SESSION['update']);
?>
<script>
    window.alert("Update failing")
</script>
<?php
}

// Update sản phẩm
if (isset($_POST['productID'])) {

    // Lấy thông tin sản phẩm
    $id = $_POST['productID'];
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $price = $_POST['product_price'];
    $photo_cu = $_POST['product_photo_cu'];
    // $photo_moi = $_POST['product_photo_moi'];
    $photo_moi = $_FILES['product_photo_moi']['name'];
    // Thay đổi hình ảnh
    if ($photo_moi != null) {
        // upload ảnh
        $path = 'public/images/' . $_FILES['product_photo_moi']['name'];
        if (
            is_uploaded_file($_FILES['product_photo_moi']['tmp_name']) &&
            move_uploaded_file(
                $_FILES['product_photo_moi']['tmp_name'],
                $path
            )
        ) {
            $productPhoto2 = $_FILES['product_photo_moi']['name'];

            // Update thành công
            if ($productModel->editProduct($name, $description, $price, $productPhoto2, $id)) {
                // bật biến update thành công
                $_SESSION['update'] = true;
                // Load lại sản phẩm
                header('Location: manageproducts.php');
            }
            // Update thất bại
            else {
                // bật biến update thất bại
                $_SESSION['update'] = false;
                // Load lại sản phẩm
                header('Location: manageproducts.php');
            }
        }


        // ko đổi ảnh
    } else {
        // Update thành công
        if ($productModel->editProduct($name, $description, $price, $photo_cu, $id)) {
            // bật biến update thành công
            $_SESSION['update'] = true;
            // Load lại sản phẩm
            header('Location: manageproducts.php');
        }
        // Update thất bại
        else {
            // bật biến update thất bại
            $_SESSION['update'] = false;
            // Load lại sản phẩm
            header('Location: manageproducts.php');
        }
    }


}

//kiem tra neu co day du thong tin thi them vao database
if (
    !empty($_POST['product_name']) && !empty($_POST['product_description']) &&
    !empty($_POST['product_price'])
) {

    $productModel = new ProductModel();
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $uploadPath = 'public/images/' . $_FILES['product_photo']['name'];
    if (
        is_uploaded_file($_FILES['product_photo']['tmp_name']) &&
        move_uploaded_file(
            $_FILES['product_photo']['tmp_name'],
            $uploadPath
        )
    ) {
        $productPhoto = $_FILES['product_photo']['name'];
    }
    if ($productModel->addProduct($productName, $productDescription, $productPrice, $productPhoto)) {


        /* This will give an error. Note the output
         * above, which is before the header() call */
        header('Location: manageproducts.php');
        exit;

    } else {
?>
<script>
  .alert("Lỗi không thể thêm !!!");
</script>
<?php
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        #id2:hover {
            background: #ccffff;

        }

        #id3:hover {
            background: #ffcccc;

        }
    </style>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <!-- Modal bootstrap sửa -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- Tiêu đề các trang -->
    <header style="border-bottom: solid 2px grey" class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.php">
                    <span>
                        Switzerland
                    </span>

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="watches.php"> Watches </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php"> About </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                    </ul>
                    <div class="user_option-box">

                        <?php
                        if (isset($_SESSION['username'])) {
                        ?>
                        <span style="font-style: italic; font-weight: 700;">
                            <?php echo "WELCOME TO " . $_SESSION['username'] . " !" ?>
                        </span>


                        <a id="id3" style="border: dashed red 1px;
             padding: 5px 10px;
             border-radius: 10px;
             color: red;" href="logout.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Logout
                        </a>
                        <?php
                        } else {
                        ?>

                        <a id="id2" style="border: dashed #0066cc 1px;
             padding: 5px 10px;
             border-radius: 10px;
             color: #0066cc;" href="login.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Login
                        </a>
                        <?php
                        }
                        ?>







                    </div>
                </div>
            </nav>
        </div>
    </header>


    <!-- Quản lý sản phẩm -->
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Quản lý sản phẩm</h2>
              
            </div>
            
            <div class="col-md-2">
                <button style="margin-top: 5px" type="button" class="btn btn-outline-primary" data-toggle="modal"
                    data-target="#exampleModal">+ ADD</button>
            </div>
        </div>
        <table class="table">
            <tr>
                <td><b>ID</b></td>
                <td><b>Name</b></td>
                <td><b>Price</b></td>
                <td><b>Image</b></td>
                <td><b>Action</b></td>
            </tr>
            <?php
            foreach ($productList as $items) {
            ?>
            <tr>
                <td>
                    <?php echo $items['id'] ?>

                </td>
                <td>
                    <?php echo $items['product_name'] ?>
                </td>
                <td>
                    <?php echo $items['product_price'] ?>
                </td>

                <td><img src="public/images/<?php echo $items['product_photo'] ?>" alt="" width="100px"></td>
                <td>
                    <!-- button sửa -->
                    <button style="width: 71.63px;" type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal<?php echo $items['id']; ?>">
                        Edit
                    </button>
                    <!-- Xoa san pham -->
                    <form action="manageproducts.php" method="post"
                        onsubmit="return confirm('Bạn có chắc muốn xóa không ?')">
                        <input type="hidden" name="deleteId" value=" <?php echo $items['id'] ?>">
                        <button style="margin-top: 2px" type="submit" class="btn btn-danger">Delete</button>
                    </form>

                    <!-- Modal -->
                    <form action="manageproducts.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="productID" value="<?php echo $items['id']; ?>">
                        <div class="modal fade" id="exampleModal<?php echo $items['id']; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <?php echo "Product " . $items['id'] ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product_name"
                                                name="product_name" value="<?php echo $items['product_name'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_description" class="form-label">Mô tả</label>

                                            <textarea type="text" class="form-control" id="product_description"
                                                name="product_description" cols="30" rows="10"><?php echo $items['product_description'] ?>
                                        </textarea>


                                        </div>
                                        <div class="mb-3">
                                            <label for="product_price" class="form-label">Giá</label>
                                            <input type="text" class="form-control" id="product_price"
                                                name="product_price" value="<?php echo $items['product_price'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="product_photo" class="form-label">Hình</label>
                                            <!-- Hình cũ -->
                                            <input type="hidden" class="form-control" id="product_photo_cu"
                                                name="product_photo_cu" value="<?php echo $items['product_photo'] ?>">
                                            <!-- Hình mới -->
                                            <input type="file" class="form-control" id="product_photo_moi"
                                                name="product_photo_moi" value="">

                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- add san pham -->
                    <form action="manageproducts.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="productID">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <?php echo "New product" ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product_name"
                                                name="product_name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_description" class="form-label">Mô tả</label>
                                            <input type="text" class="form-control" id="product_description"
                                                name="product_description">
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_price" class="form-label">Giá</label>
                                            <input type="text" class="form-control" id="product_price"
                                                name="product_price">
                                        </div>

                                        <div class="mb-3">
                                            <label for="product_photo" class="form-label">Product photo</label>
                                            <input type="file" class="form-control" id="product_photo"
                                                name="product_photo">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>

            </tr>
            <?php
            }
            ?>

        </table>
    </div>
</body>
<script>
</script>

</html>