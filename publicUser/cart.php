<?php session_start();?>
<?php require('../config.php');?>
<?php include('./include/header.php'); ?>

<?php 


$user_id=$_SESSION['id'];
if(isset($_SESSION['cart'])) {
    $product_id=array_column($_SESSION['cart'], 'product_id');

}

// ------------------- delet from cart 


if(isset($_GET['action'])){
  
    $id=$_GET['id'];
    $sql="DELETE FROM cart WHERE user_id=:user_id AND product_id=:product_id";
    $db=crud::connect()->prepare($sql);
    $db->bindValue(':user_id',$user_id);
    $db->bindValue(':product_id',$id);
    $db->execute();
    


    // print_r($_SESSION['cart']);
    foreach($_SESSION['cart'] as $key => $value ){
        if($value['product_id'] == $id){
            unset($_SESSION['cart'][$key]);
            echo "<script>alert('you are shure')</script>";

        }
    }
   
}
//===================================================

// لتعديل كمية المنتجات في الداتا بس حسب رقم المنتج

if(isset($_POST['submit'])){
    $quantity=$_POST['quantity'];
    $product_id=$_POST['id'];

    $sqll="UPDATE  cart SET quantity=$quantity WHERE user_id=$user_id AND product_id=$product_id";
    $con=crud::connect()->prepare($sqll);
    $con->execute();



}

//===================================================

// حسب رقم المستخدم product وجدول ال  cart  لعرض المنتجات من جدول ال 
$db=crud::selectcartTable();
$db->bindValue(':id',$user_id);
$db->execute();
$data= $db->fetchAll(PDO::FETCH_ASSOC);



?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $total=0 ?>
                            <?php foreach($data as $value):?>
                                <?php if($value['discount']== 0){?>

                                <?php 
                                    // if(in_array($value['id'],$product_id)):
                                    ?>

                                <tr>
                                    <td class="cart__product__item">
                                        <img src="../image/<?php echo $value['image']?>" alt="" style="width:100px">
                                        <div class="cart__product__item__title">
                                            <h6><?php echo $value['title']?><br>
                                            <?php echo $value['productName']?>
                                                </h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="cart__price"><?php echo $value['price']?> JD</td>
                                    <td class="cart__quantity">
                                        <div >
                                            <form action="" method='post'>

                                            <input type="number" name="quantity" value="<?php echo $value['quantity']?>" style="width:40px;border-radius:3px" >
                                            <input type="hidden" name="id" value="<?php echo $value['id']?>">
                                            <button type="submit" name="submit" style="border:none;background-color:red;color:white;border-radius:5px;padding:3px">Update</button>
                                            </form>


                                        </div>
                                    </td>
                                    <!-- <td>
                                    <button type="submit" name="submit">ubdate</button>
                                    </td> -->
                                    <td class="cart__total"><?php echo $value['price']*$value['quantity']?> JD</td>
                                    <td class="cart__close"><a href="./cart.php?action=remove&id=<?php echo $value['id']?>"><span class="icon_close"></span></a></td>
                                </tr>
                                <?php $total+=$value['price']*$value['quantity'];?>
                                <?php 
                                }else{?>
                                  <tr>
                                    <td class="cart__product__item">
                                        <img src="../image/<?php echo $value['image']?>" alt="" style="width:100px">
                                        <div class="cart__product__item__title">
                                            <h6><?php echo $value['title']?><br>
                                            <?php echo $value['productName']?>
                                                </h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="cart__price"><?php echo $value['new_Price']?> JD</td>
                                    <td class="cart__quantity">
                                        <div >
                                            <form action="" method='post'>

                                            <input type="number" name="quantity" value="<?php echo $value['quantity']?>" style="width:40px;border-radius:3px" >
                                            <input type="hidden" name="id" value="<?php echo $value['id']?>">
                                            <button type="submit" name="submit" style="border:none;background-color:red;color:white;border-radius:5px;padding:3px">Update</button>
                                            </form>


                                        </div>
                                    </td>
                                    <!-- <td>
                                    <button type="submit" name="submit">ubdate</button>
                                    </td> -->
                                    <td class="cart__total"><?php echo $value['new_Price']*$value['quantity']?> JD</td>
                                    <td class="cart__close"><a href="./cart.php?action=remove&id=<?php echo $value['id']?>"><span class="icon_close"></span></a></td>
                                </tr>
                                <?php $total+=$value['new_Price']*$value['quantity'];?>
                                <?php }?>
                                <?php endforeach;?>
                                <?php $_SESSION['totalPrice']= $total;?>
                                <!-- <tr>
                                    <td class="cart__product__item">
                                        <img src="img/shop-cart/cart2K4.jpg" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>Besty<br>
                                                Round Blue Eyeglasses
                                                </h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">59.00 JD</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </td>
                                    <td class="cart__total">59.00 JD</td>
                                    <td class="cart__close"><span class="icon_close"></span></td>
                                </tr>
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="img/shop-cart/cart3M4.jpg" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>Marlowe
                                                Cat Eye Rose Gold<br> Sunglasses
                                                </h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">49.00 JD</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </td>
                                    <td class="cart__total">49.00 JD</td>
                                    <td class="cart__close"><span class="icon_close"></span></td>
                                </tr>
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="img/shop-cart/cart4M6.jpg" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>Cotton Shirt</h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">55.00 JD</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </td>
                                    <td class="cart__total">55.00 JD</td>
                                    <td class="cart__close"><span class="icon_close"></span></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="./shop.php">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <!-- <div class="cart__btn update__btn">
                        <form action="" method="post">
                        <button type="submit" name="empty" ><span class="icon_loading">Update cart</span> </button>

                        </form>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div> -->
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <!-- <li>Subtotal <span> JD</span></li> -->
                            <li>Total <span><?php echo $total?> JD</span></li>
                        </ul>
                        <a href="./checkout.php" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->

    <!-- Instagram Begin -->
    <!-- <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Instagram End -->


<?php include('./include/footer.php'); ?>