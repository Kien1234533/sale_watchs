<?php
session_start();
require_once './config/database.php';
spl_autoload_register(function ($className)
{
   require_once "./app/models/$className.php";
});
//chi tiet san pham
$productModel = new ProductModel();
$productList = $productModel->getAllProducts();
//Cac loai dong ho
$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<style>
    #id2:hover{
      background: #ccffff;
    }
    #id3:hover{
      background: #ffcccc;
    }
    
  </style>
  <link rel="stylesheet" href="public/styles.css">
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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              Switzerland
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="watches.php"> Watches <span class="sr-only">(current)</span></a>
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
    if(isset($_SESSION['username'])){
    ?>
    <span style="font-style: italic;
    font-weight: 700;"><?php echo "WELCOME TO ".$_SESSION['username']." !"?></span>
    
    <a id="id3" style="border: dashed red 1px;
             padding: 5px 10px;
             border-radius: 10px;
             color: red;" href="logout.php">
             <i class="fa fa-user" aria-hidden="true"></i>
              Logout
             </a>         
    <?php
    }else{
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
             
          
              <a href="">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-search" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- shop section -->
  <div>
  <img class="img-fluid" src="public/images/banner-website.jpg" alt="">
</div>
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Watches
        </h2>
      </div>
      
      <!-- chi tiet san pham -->
      <header class ="id" class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">

         

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
            <li  class="nav-item">
              <a class="nav-link" href="watches.php">Tất cả</a>
              </li>
              <?php
                foreach ($categoryList as $item) {
                ?>
              <li id="id1"  class="nav-item">
              <a class="nav-link" href="categoryWatch.php?id=<?php echo $item['id'];?>"><?php echo $item['category_name']; ?></a>
              </li>
              <?php
                }
                ?>
              <form class="d-flex" role="search" action="search.php" method="get">
                <input style="height: 34px;" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
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
                <img src="./public/images/<?php echo $item['product_photo']; ?>"alt=""class="img-fluid"style="border: solid grey 1px;border-radius: 10px;padding: 5px">
              </div>
              <div class="detail-box">
                <p id="id">
                <?php echo $item['product_name'];?>
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
          </div>
        </div>
        <?php
                    }
                    ?>
     
      </div>
      <div class="btn-box">
        <a href="watches.php">
          View All
        </a>
      </div>
    </div>
  </section>

  <!-- end shop section -->

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
              Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
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
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>