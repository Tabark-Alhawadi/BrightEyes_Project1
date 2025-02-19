<?php
  session_start();
// if(isset($_SESSION['name'])){
//     header("location:./index.php");
// }
?>
<?php require('../config.php'); ?>

<?php 




if(isset($_GET['logout'])){
    unset($_SESSION['id']);
    session_destroy();
    echo "<script>window.location='./login.php'</script>";}

if(isset($_POST['submit'])){

$email=$_POST['email'];
$password=$_POST['password'];

$error="";

$db = crud::connect()->prepare("SELECT * FROM users WHERE Email=:email and Password = :password ");
$db->bindValue(':email' , $email);
$db->bindValue(':password' , $password);
$db->execute();
$d= $db->fetch(PDO::FETCH_ASSOC);
$notAdmin="";
$notMatch="";
if(!empty($_POST['email'])&&!empty($_POST['password'])){
    
    if($d){
            if($d['Role'] == 1){
                $_SESSION['name']=$d["FullName"];
                $_SESSION['email']=$d["Email"];
                $_SESSION['pass']=$d["Password"];
                $_SESSION['role']=$d["Role"];
                $_SESSION['id']=$d["id"];
                $_SESSION['img']=$d["image"];
                $_SESSION['validate']=true;
                    
                header("location:./index.php");

                //add date last log in use now() function
                $sql="UPDATE  users SET  LastLogin =now() WHERE id=". $_SESSION['id'];
                $db = crud::connect()->prepare( $sql);
                $db->execute();
            }else{
                $notAdmin=1;
            }
  
 
 
    }else{
        $notMatch=1;          
            
        }  
   
} else{
 $notMatch = "error";  
}   
  
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="./images/RIGHT-EYES.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">

                                <!-- يظهر في حال لم يكن المستخدم ادمن  alert  -->
                                <?php if( !empty ($notAdmin)):?>
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                <span class="badge badge-pill badge-danger">Failed</span>
                                                You do not have permission to access the site.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                <?php endif;?>

                                <!-- يظهر في حال لم تكن البيانات صحيحة  alert  -->
            
                                <?php if( !empty ($notMatch)):?>
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                <span class="badge badge-pill badge-danger">Success</span>
                                                Email or password not match.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                <?php endif;?>

                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" name="submit">sign in</button>

                            </form>
                            <div class="register-link">
                                <!-- <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->