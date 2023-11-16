<?php
require_once('./config/database.php');
// autoloading
spl_autoload_register(function ($className) {
  require_once("./app/models/$className.php");
});
session_start();
// if(isset($_POST['username'])){
//     $userModel = new UserModel();
//     if($userModel->login($_POST['username'], $_POST['password'])){
//         $_SESSION['username']= $_POST['username'];

//          header('Location: index');
//     } else{       
//          header('Location: login');      
//     }
// }

if (isset($_POST['username'])) {
  $userModel = new UserModel();
  // Tâm An: Lấy role user
  $role = $userModel->login($_POST['username'], $_POST['password']);

  // user && password đúng
  if ($role != -1) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['role'] = $role;
    $_SESSION['idUser'] = $userModel->getIdByUsername($_SESSION['username']);
    // $_SESSION['countProductsInCart'] = $userModel->countProductsInCart($_SESSION['idUser']);
    header('Location: index');
  } else {
    header('Location: login');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="public/styleLogin.css">
</head>

<body>

  <div class="login-page">
    <div class="form">

      <form action="login.php" method="post" class="login-form">
        <input type="text" id="username" name="username" placeholder="Username" />
        <input type="password" id="password" name="password" placeholder="Password" />
        <button>login</button>
        <p class="message">Not registered? <a href="register.php">Create an account</a></p>
      </form>
    </div>
  </div>
  <script>
    $('.message a').click(function () {
      $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
    });
  </script>
</body>

</html>