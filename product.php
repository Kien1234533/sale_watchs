<?php
session_start();
require_once './config/database.php';
spl_autoload_register(function ($className)
{
   require_once "./app/models/$className.php";
});
if(isset($_GET['id'])) {
    $detail = new UserModel();
    $detail ->getView($_GET['id']);
    $id = $_GET['id'];
    $productModel = new productModel();
    $item = $productModel->getProductById($id);
    //Vua xem
    if(!isset($_COOKIE['viewedProduct'])) {
      $value = [$id];
      setcookie('viewedProduct', json_encode($value), time() + 3600);
  }
  else {
      $viewedProduct = json_decode($_COOKIE['viewedProduct'], true);
      if(!in_array($id, $viewedProduct)) {
          if(count($viewedProduct) == 5) {
              array_shift($viewedProduct);
          }
          array_push($viewedProduct, $id);
          setcookie('viewedProduct', json_encode($viewedProduct), time() + 3600);
      }
      else {
          unset($viewedProduct[array_search($id, $viewedProduct)]);
          array_push($viewedProduct, $id);
          setcookie('viewedProduct', json_encode($viewedProduct), time() + 3600);
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script type="text/javascript" src="js/btn_top.js"></script>

  <style>
    #id2:hover {
      background: #ccffff;

    }

    #id3:hover {
      background: #ffcccc;

    }

    /* Tâm An: Giỏ hàng */
    .zoom {
      transition: transform .2s;
      margin: 5px;
    }

    /* Tâm An: Giỏ hàng */
    .zoom:hover {
      transform: scale(1.5);
    }
    #sw:hover{
color: red;
    }
  </style>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="public/styles.css">
  <link href="http://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>Watches</title>


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
  <script src="https://kit.fontawesome.com/f6dce9b617.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="hero_area">
    
    <!-- header section strats -->
    <header style="border-bottom: solid 2px grey;" class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span id="sw">
              Switzerland
            </span>

          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <span style="font-style: italic;
    font-weight: 700;">
                <?php echo "WELCOME TO " . $_SESSION['username'] . " !" ?>
              </span>
              <!-- Tâm An: Quản lý sản phẩm -->
              <?php
                // Quyền hạn admin
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
              ?>
              <a id="id3" style="border: dashed blue 1px;
             padding: 5px 10px;
             border-radius: 10px;
             color: blue;" href="manageproducts.php">
                <i class="fa fa-user" aria-hidden="true"></i>
                Product <br> Management
              </a>
              <?php
                }
              ?>
              <!-- Tâm An: Quản lý sản phẩm -->

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




              <!-- Tâm An: Check giỏ hàng -->
              <div class="zoom">
                <a href="cart.php">
                  <i class="fa fa-cart-plus" aria-hidden="true" id="cart"></i>
                </a>
              </div>

              <a href="">
                <i class="fa fa-search" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <div>
        <h5 style="margin-top: 10px;color: #288ad6;font-size: 15px;"><a href="index.php"> Trang chủ  </a> <span style="">></span> <span> Chi tiết sản phẩm:</span></h5>
    </div>
    <!-- end header section -->
    <!-- slider section -->
   
    <!-- end slider section -->
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div style="display: flex;"><h1><?php echo $item['product_name']; ?></h1><p style="line-height: 60px;margin-left: 10px;color: #fb6e2e"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> <span style="color:#288ad6">9 đánh giá</span> </p></div>
            
                <img src="./public/images/<?php echo $item['product_photo']; ?>" alt="" class="img-fluid"width =710px height = 396px>
            </div>
            <div class="col-md-5">
                <h4 style="margin-top: 70px; text-align: center;border-bottom: solid 1px grey;padding-bottom: 30px;">Tại sao nên chọn chúng tôi ?</h4>
                <div class="row">
                    <div class="col-md-2">
                    <img  src="./public/images/chung-nhan1.jpg" alt="">
                   
                    </div>
                    <div class="col-md-10">
                   <p> Hoàn Lại Tiền Gấp 10 Lần Nếu Phát Hiện Hàng Giả - Hàng Nhái.</p>
                    
                    </div>
                    <div class="col-md-2">
                    <img src="./public/images/bao-hanh-5-nam1.jpg" alt="">
                    </div>
                    <div class="col-md-10">
                    <p>Tăng Thêm Thời Gian Bảo Hành Lên Đến 5 Năm - Xem Thêm</p> 
                    </div>
                    <div class="col-md-2">
                    <img src="./public/images/bao-hanh-quoc-te.jpg" alt="">
                    </div>
                    <div class="col-md-10">
                    <p>Trung Tâm Bảo Hành Đạt Tiêu Chuẩn Quốc Tế - Xem Thêm</p> 
                    </div>
                    <div class="col-md-2">
                    <img src="./public/images/1-doi-12.jpg" alt="">
                    </div>
                    <div class="col-md-10">
                    <p>Sai Kích Cỡ? Không Ưng Ý? Đổi Hàng Trong 7 Ngày - Xem Thêm</p> 
                    </div>
                    <div class="col-md-2">
                    <img src="./public/images/thay-pin-mien-phi1.jpg" alt="">
                    </div>
                    <div class="col-md-10">
                    <p>Thay Pin Miễn Phí Suốt Đời - Không Còn Lo Hết Pin Nữa.</p> 
                    </div>
                    <div class="col-md-2">
                    <img src="./public/images/giao-hang-2h.jpg" alt="">
                    </div>
                    <div class="col-md-10">
                    <p>Giao Hàng SIÊU TỐC Trong 2h - SHIP COD Miễn Phí</p> 
                    </div>
                    <div class="col-md-2">
                    <img src="./public/images/30-nam-kinh-nghiem1.jpg" alt="">
                    </div>
                    <div class="col-md-10">
                    <p>Đến & Cảm Nhận Kinh Nghiệm Hơn 30 Năm Của Chúng Tôi.</p> 
                    </div>

                    
                    
                        
                        
                    
                </div>
            </div>
            <div class="row">
            
                <p><?php echo $item['product_price']; ?></p>
                <p><?php echo $item['product_description']; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
