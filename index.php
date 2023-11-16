<?php
session_start();
require_once './config/database.php';
spl_autoload_register(function ($className) {
  require_once "./app/models/$className.php";
});
//chi tiet san pham

$productModel = new ProductModel();

//cac san pham da xem gan day
$viewedProductList = [];
if (isset($_COOKIE['viewedProduct'])) {
  $arrId = json_decode($_COOKIE['viewedProduct'], true);
  $viewedProductList = $productModel->getProductByIds($arrId);
}
//Cac loai dong ho
$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getAllCategories();

$userModel = new UserModel();
// AI CUNG LIKE DUOC SAN PHAM
if (isset($_POST['likedId'])) {
  $id = $_POST['likedId'];
  if (!isset($_COOKIE['likedProduct'])) {
    $value = [$id];
    $productModel->likeProduct($id);
    setcookie('likedProduct', json_encode($value), time() + 3600);
  } else {
    $likedProduct = json_decode($_COOKIE['likedProduct'], true);
    if (!in_array($id, $likedProduct)) {
      $productModel->likeProduct($id);
      array_push($likedProduct, $id);
      setcookie('likedProduct', json_encode($likedProduct), time() + 3600);
    }
  }


}
// phan trang
$page = 1;
$perPage = 9;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$totalPage = ceil($productModel->getToTalItem() / $perPage);
$productList = $productModel->getAllProductsByPage($page, $perPage);

//Tâm An: Thêm sản phẩm vào giỏ hàng
if (isset($_SESSION['role']) && isset($_POST['productID'])) {

  // lấy id user
  $idUser = $_SESSION['idUser'];
  $idProductCart = $_POST['productID'];
  if ($userModel->addProduct_Cart($idUser, $idProductCart)) {
    header('Location: cart');
  }
}

// Lấy số lượng sản phẩm trong giỏ hàng
if (isset($_SESSION['username'])) {
  $countProductsInCart = $userModel->countProductsInCart($_SESSION['idUser']);
}
// Đổi mật khẩu
if (isset($_POST['pass_moi'])) {
  $passMoi = $_POST['pass_moi'];
  $id = $_SESSION['idUser'];
  if ($userModel->changePassword($id, $passMoi)) {
    ?>
    <script>
    window.alert("Update password successful")
</script>
    <?php
  }
  else
  {
    ?>
    <script>
    window.alert("Update password fail")
</script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdn.leanhduc.pro.vn/utilities/animation/shake-effect/style.css" />
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script type="text/javascript" src="js/btn_top.js"></script>

  <style>
    #id2:hover {
      background: #ccffff;

    }

    #section2 {}

    html {
      scroll-behavior: smooth;
    }

    #id3:hover {
      background: #ffcccc;

    }

    #box-parent {}

    .box img {
      -webkit-transform: scale(0.8);
      /*Webkit: Thu nhỏ kích thước ảnh còn 0.8 so với ảnh gốc*/
      -moz-transform: scale(0.8);
      /*Thu nhỏ đối với Mozilla*/
      -o-transform: scale(0.8);
      /*Thu nhỏ đối với Opera*/
      -webkit-transition-duration: 0.5s;
      /*Webkit: Thời gian phóng to, nhỏ ảnh*/
      -moz-transition-duration: 0.5s;
      /*Như trên*/
      -o-transition-duration: 0.5s;
      /*Như trên*/
      opacity: 0.7;
      /*Độ mờ của hình ảnh*/
    }

    .box img:hover {
      -webkit-transform: scale(1.1);
      /*Webkit: Tăng kích cỡ ảnh lên 1.1 lần*/
      -moz-transform: scale(1.1);
      -o-transform: scale(1.1);
      box-shadow: 0px 0px 30px gray;
      /*Đổ bóng bằng CSS3*/
      -webkit-box-shadow: 0px 0px 30px gray;
      -moz-box-shadow: 0px 0px 30px gray;
      opacity: 1;
      /*Độ mờ của hình ảnh*/
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

    .lentop {
      display: none;
      bottom: 40%;
      right: 10px;
      cursor: pointer;
      position: fixed;
      z-index: 1000;
    }

    .lentop div {
      background: crimson;
      border: 2px solid #fff;
      border-radius: 45px;
      padding: 11px 12.5px;
      box-shadow: 1px 3px 5px 0px rgba(0, 0, 0, 0.3)
    }

    .lentop img {
      width: 16px;
      height: 16px;
    }

    #box-child {
      animation: colorBackground 0.5s infinite;
      -webkit-animation: colorBackground 5s infinite;
      -moz-animation: colorBackground 5s infinite;
      -o-animation: colorBackground 0.5s infinite
    }

    @keyframes colorBackground {
      0% {
        background-color: yellowgreen;
        color: white;
      }

      50% {
        background-color: red;
        color: yellow;
      }
    }

    .shadow {
      font-family: Mr Dafoe, sans-serif;
      font-size: 1.8em;
      text-align: center;
      text-shadow: 0 0px 0 #333,
        0 6px 8px rgba(0, 0, 0, .4),
        0 9px 10px rgba(0, 0, 0, .15),
        0 30px 10px rgba(0, 0, 0, .18),
        0 15px 10px rgba(0, 0, 0, .21);
      background: #ececec;
      background-image: url('data:image/svg+xml,%3Csvg width="42" height="44" viewBox="0 0 42 44" xmlns="http://www.w3.org/2000/svg"%3E%3Cg id="Page-1" fill="none" fill-rule="evenodd"%3E%3Cg id="brick-wall" fill="%239C92AC" fill-opacity="0.4"%3E%3Cpath d="M0 0h42v44H0V0zm1 1h40v20H1V1zM0 23h20v20H0V23zm22 0h20v20H22V23z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
    }

    /* Hover đổi mật khẩu */
    .dropbtn {
      background-color: #04AA6D;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown:hover .dropbtn {
      background-color: #3e8e41;
    }
  </style>
  <link href="https://fonts.googleapis.com/css?family=Mr+Dafoe" rel="stylesheet">
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

</head>

<body>

  <div class="hero_area">
    <div class="hero_social">
      <a href="">
        <i class="fa fa-facebook" aria-hidden="true"></i>
      </a>
      <a href="">
        <i class="fa fa-twitter" aria-hidden="true"></i>
      </a>
      <a href="">
        <i class="fa fa-linkedin" aria-hidden="true"></i>
      </a>
      <a href="">
        <i class="fa fa-instagram" aria-hidden="true"></i>
      </a>
    </div>
    <!-- header section strats -->
    <header id="section1" class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">

            <div class="shadow">Switzerland</div>


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
              <!-- WELCOME hover -> đổi mật khẩu -->
              <span style="font-style: italic; font-weight: 700;">
                <div class="dropdown">
                  <!-- WELCOME -->
                  <a href="user.php?username=<?php echo $_SESSION['username']; ?>"><button class="btn btn-light dropbtn" style="margin-top: 7px;"><?php echo "WELCOME TO " . $_SESSION['username'] . " !" ?></button></a>
                  
                 
                 
                  <!-- sub WELCOME -->
                  <div class="dropdown-content">
                    <!-- đổi mật khẩu -->
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                      Đổi mật khẩu
                    </button>

                  </div>
                </div>
                <!-- Modal: ĐỔi mật khẩu -->
                <form action="index.php" method="post">
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- Mật khẩu cũ -->
                          <label class="form-label">Mật khẩu cũ</label>
                          <input type="password" class="form-control" id="pass_cu" name="pass_cu">

                          <!-- Mật khẩu mới -->
                          <label class="form-label">Mật khẩu mới</label>
                          <input type="password" class="form-control" id="pass_moi" name="pass_moi">

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </span>
              <!-- Tâm An: Quản lý sản phẩm -->
              <?php
                // Quyền hạn admin
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
              ?>
              <a id="id3" style="border: dashed blue 1px;
             padding: 5px 5px;
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
                <?php
                if (isset($_SESSION['role'])) {
                ?>
                <a href="cart.php">
                  <?php
                } else {
                  ?>
                  <a href="login.php">
                    <?php
                }
                    ?>




                    <button type="button" class="btn btn-link position-relative">
                      <i class="fa fa-shopping-cart" style="font-size:24px"></i>
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                        <?php
                        if (isset($_SESSION['role'])) {

                          echo ((int) $countProductsInCart['numberProductsInCart']);
                        } else {
                          echo "0";
                        } ?>

                      </span>
                    </button>
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
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">

                    <h1>
                      Smart Watches
                    </h1>
                    <p>
                      Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit
                      amet, lobortis semper quam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1" id="box-child">
                        Contact Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="public/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Smart Watches
                    </h1>
                    <p>
                      Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit
                      amet, lobortis semper quam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="public/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Smart Watches
                    </h1>
                    <p>
                      Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit
                      amet, lobortis semper quam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="public/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>

    </section>
    <!-- end slider section -->
  </div>



  <!-- shop section -->
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2 class="title a-center" id="box">
          Latest Watches
        </h2>
      </div>

      <!-- cac loai san pham -->
      <header class="id" class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">



            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Tất cả</a>
                </li>
                <?php
                foreach ($categoryList as $item) {
                ?>
                <li id="id1" class="nav-item">
                  <a class="nav-link" href="category.php?id=<?php echo $item['id']; ?>">
                    <?php echo $item['category_name']; ?>
                  </a>
                </li>
                <?php
                }
                ?>
                  <form class="d-flex" role="search" action="search.php" method="get">
                    <input style="height: 34px;" class="form-control me-2" type="search" placeholder="Search"
                      aria-label="Search" name="search">
                    <button style="border-radius: 5px;" class="" type="submit">
                      <div class="user_option-box">
                        <i class="fa fa-search" aria-hidden="true"></i>

                      </div>
                    </button>
                  </form>


              </ul>

            </div>
          </nav>
        </div>
      </header>

      <div class="row">
        <?php
        foreach ($productList as $item) {
        ?>
        <div class="col-sm-6 col-xl-3">
          <div class="box">
            <a href="product.php?id=<?php echo $item['id']; ?>">
              <div class="img-box">
                <img src="./public/images/<?php echo $item['product_photo']; ?>" alt="" class="img-fluid"
                  style="border: solid grey 1px;border-radius: 10px;padding: 5px">
              </div>
              <div class="detail-box">
                <p id="id">
                  <?php echo $item['product_name']; ?>
                </p>

                <h6>
                  Giá:
                  <span>
                    <?php echo $item['product_price']; ?>
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  Best Seller
                </span>

              </div>


              <div class="new1">
                -50%
              </div>




            </a>
            <!-- Tâm An: Button giỏ hàng -->
            <form action="index.php" method="post">
              <?php
          //kiểm tra đã đăng nhập && Là khách hàng
          if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
              ?>
              <button type="submit" class="btn btn-danger" style="border-radius: 10px;"><i
                  class="fa fa-shopping-cart rung" style="font-size:24px; width: 220px;"></i>
                <?php
          } else {
                ?>
                <button type="button" class="btn btn-danger" style="border-radius: 10px;"><i
                    class="fa fa-shopping-cart rung" style="font-size:24px; width: 220px;"></i>
                  <?php
          }
                  ?>
                </button>
                <input type="hidden" name="productID" value="<?php echo $item['id']; ?>">
            </form>

            <div id="box1">
              <p style="margin-left: 130px;font-size: 14px; margin-bottom: 0px;">
                Lượt xem
                <span style="margin-left: 1.8px;padding: 3.625px 5.2px;" class="badge text-bg-warning"><i
                    class="bi bi-eye-fill"></i>
                  <?php echo " " . $item['product_view']; ?>
                </span>
              </p>


              <form action="index.php" method="post">
                <input type="hidden" name="likedId" id="likedId" value="<?php echo $item['id']; ?>">
                <p style="margin-left:130.5px;font-size: 14px;">
                  Yêu thích
                  <button class="submit btn badge text-bg-danger"><i class="bi bi-heart-fill"></i>
                    <?php echo $item['product_like']; ?>
                  </button>
                </p>

              </form>
            </div>

          </div>
        </div>
        <?php
        }
        ?>

      </div>
      <div class="btn-box">
        <a href="index.php">View All</a>
      </div>
      <nav style="margin-top: 30px;" class="d-flex justify-content-center" aria-label="Page navigation example">
        <ul class="pagination">
          <?php
          if ($page > 1) {


          ?>

          <li class="page-item">
            <a class="page-link" href="index.php?page=<?php echo ($page - 1) ?>">Previous </a>
          </li>
          <?php } ?>
          <?php
          for ($i = 1; $i <= $totalPage; $i++) {
          ?>
          <li class="page-item">
            <a class="page-link" href="index.php?page=<?php echo $i ?>">
              <?php echo $i ?>
            </a>
          </li>
          <?php
          }
          ?>
          <?php if ($page < $totalPage) {
          ?>
          <li class="page-item">
            <a class="page-link" href="index.php?page=<?php echo ($page + 1) ?>">Next</a>
          </li>
          <?php
          }
          ?>

        </ul>
      </nav>
      <div class="row">
        <div class="col-md-5">
          <h5><b> VỪA XEM</b></h5>
          <table style="text-align: center" class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>Hình ảnh:</th>
                <th>Tên sản phẩm:</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($viewedProductList as $viewedItem) {
              ?>
              <tr>
                <td> <a href="product.php?id=<?php echo $viewedItem['id']; ?>"><img style="border-radius: 10px"
                      width=67.125px; height=81.25px; src="public/images/<?php echo $viewedItem['product_photo']; ?>"
                      alt=""></a></td>
                <td><a href="product.php?id=<?php echo $viewedItem['id']; ?>">
                    <h6><?php echo $viewedItem['product_name']; ?></h6>
                  </a></td>
              </tr>
              <?php
              }
              ?>
            </tbody>


          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- end shop section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 col-lg-5 ">
          <div class="img-box">
            <img src="public/images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6 col-lg-7">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Us
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. All
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- feature section -->

  <section class="feature_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Features Of Our Watches
        </h2>
        <p>
          Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="public/images/f1.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Fitness Tracking
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="public/images/f2.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Alerts & Notifications
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="public/images/f3.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Messages
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="public/images/f4.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Bluetooth
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box">
        <a href="">
          View More
        </a>
      </div>
    </div>
  </section>

  <!-- end feature section -->

  <!-- contact section -->

  <section class="contact_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <div class="heading_container">
              <h2>
                Contact Us
              </h2>
            </div>
            <form action="">
              <div>
                <input type="text" placeholder="Full Name " />
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="text" placeholder="Phone number" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" />
              </div>
              <div class="d-flex ">
                <button>
                  SEND
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="img-box">
            <img src="public/images/contact-img.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

  <!-- client section -->
  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Testimonial
        </h2>
      </div>
      <div class="carousel-wrap ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="public/images/lionel.jpg" alt="">
              </div>
              <div class="detail-box">
                <div class="client_info">
                  <div class="client_name">
                    <h5>
                      Messi
                    </h5>
                    <h6>
                      Customer
                    </h6>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
                <p>
                  Product is very good.
                  Great material. Wear it
                  out to go out, go to work,
                  the price is expensive but
                  reflects the quality.
                  Truly a beautiful watch.
                </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="public/images/ro.jpg" alt="">
              </div>
              <div class="detail-box">
                <div class="client_info">
                  <div class="client_name">
                    <h5>
                      Ronaldo
                    </h5>
                    <h6>
                      Customer
                    </h6>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
                <p>
                  Product is very good.
                  Great material. Wear it
                  out to go out, go to work,
                  the price is expensive but
                  reflects the quality.
                  Truly a beautiful watch.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end client section -->

  <!-- Co the ban se thich -->
  <!-- <div class="maybe">
    <h4>Có thể bạn sẽ thích</h4>
  </div>
   -->
  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_detail">
            <h4>
              About
            </h4>
            <p>
              Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin
              words, combined with
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_contact">
            <h4>
              Reach at..
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_contact">
            <h4>
              Subscribe
            </h4>
            <form action="#">
              <input type="text" placeholder="Enter email" />
              <button type="submit">
                Subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </div>
  </footer>
  <div class='lentop'>
    <div>
      <img
        src='https://1.bp.blogspot.com/-k6sikOdzFXQ/VwqCKDosmEI/AAAAAAAAKxE/nLxLhkTIO6o3iE5ZWmtxo2bf4QHdzPQNQ/s1600/top.png' />
    </div>
  </div>
  <div class="footer"> <a class="btn-top" href="javascript:void(0);" title="Top" style="display: inline;"></a> </div>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

  <script>
    $(function () {
      $(window).scroll(function () {
        if ($(this).scrollTop() > 100) $(".lentop").fadeIn();
        else $(".lentop").fadeOut();
      });
      $(".lentop").click(function () {
        $("body,html").animate({ scrollTop: 0 }, "slow");
      });
    });
  </script>

</body>

</html>