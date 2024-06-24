
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="../publicUser\img\logo_1.png">
    <title>BrightEyes | Project</title>

    <!-- Google Font -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style> 
/* textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
} */

.categories__text a {
	font-size: 28px;
	color: #111111;
	text-transform: uppercase;
	font-weight: 600;
	position: relative;
	padding: 0 0 3px;
	display: inline-block;
}

</style>
</head>
<body>
<?php

    if(isset($_SESSION['cart'])){
            $count=count($_SESSION['cart']);

    }else{
        $count=0;
    }  
?>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="./shop-cart.html"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.php"><img src="img/logo_1.png" alt="logo" style="width:50px"></a>
        </div>
        
        <div id="mobile-menu-wrap"></div>
                            <?php if(isset($_SESSION['name'])) :?>
                            <div class="header__right__auth">
                                <a href="./user_prof.php" style="font-size:1em">Account</a>  
                            </div>
                            <?php endif ?>
                            <?php if(!isset($_SESSION['name'])) :?>
                            <div class="header__right__auth">
                                <a href="./Login.php" style="font-size:1em">Login</a>
                                <a href="./Register.php" style="font-size:1em">Register</a>
                            </div>
                            <?php endif ?>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">

                        <a href="./index.php"><img src="./img/logo_1.png" alt="" style="width:50px"></a> 
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="#">Categories</a>
                                <ul class="dropdown">
                                        <li><a href="./shop.php?id=1">Cat Eye Glass</a></li>
                                        <li><a href="./shop.php?id=4">Kid's Eyeglasses</a></li>
                                        <li><a href="./shop.php?id=2">Mirrored Sunglasses</a></li>
                                        <li><a href="./shop.php?id=5">Sunglass Cases</a></li>
                                        <li><a href="./shop.php?id=3">Sunglass chain</a></li>
                                 </ul>   
                                </li>                              
                            <li><a href="./shop.php">SHOP</a></li>
                            <li><a href="./contact.php">Contact</a></li>
                            <li><a href="./about.php">About us</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <?php if(isset($_SESSION['name'])) :?>
                            <div class="header__right__auth">
                                <a href="./user_prof.php" style="font-size:1em">Account</a>  
                                <a href="./index.php?logout=<?php echo $_SESSION['id']; ?>" style="font-size:1em">Logout</a>  
                            </div>
                            <?php endif ?>
                            <?php


                            if(isset($_GET['logout'])){
                                unset($_SESSION['id']);
                                session_destroy();
                                echo "<script>window.location='index.php'</script>";}; ?>
                            <?php if(!isset($_SESSION['name'])) :?>
                            <div class="header__right__auth">
                                <a href="./Login.php" style="font-size:1em">Login</a>
                                <a href="./Register.php" style="font-size:1em">Register</a>
                            </div>
                            <?php endif ?>
                        

                        <ul class="header__right__widget">
                            <!-- <li><span class="icon_search search-switch"></span></li>
                            <li><a href="#"><span class="icon_heart_alt"></span>
                                <div class="tip">2</div>
                            </a></li> -->
                            <li><a href="./cart.php"><span class="icon_bag_alt"></span>
                                <div class="tip"><?php echo $count ?></div>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->