<?php
//session_start();
$c_count=0;
if(isset($_SESSION['shopping_cart'])){
   $c_count=count($_SESSION['shopping_cart']);  
}
?>

<nav>
        <ul class="nav-items">
            
            <li class="effect"><a href="index.php">Home</a></li>
            <li class="products effect"><a href="AllProductPage.php">Products <img src="img/dropdown.png" alt="products"></a>
                <ul class="sublist">
                    <li><a href="AllProductPage.php#plants">Plants</a></li> <!--to plants section in product page -->
                    <li><a href="AllProductPage.php#tools">Care Tools</a></li> <!--to care tools section in product page -->
                </ul>
            </li>
            <img src="img/logo.png" alt="Logo" class="logo">
            <li class="effect"><a href="contact.php">Contact us</a></li>
            <li class="user effect"><a href="signin.php"><img class="usr-img" src="img/user.png" alt="admin"><h6>Admin</h6></a></li>
            <li class="effect"><a href="cart.php"><img class="cart" src="img/cart.png" alt="cart">
                <p style="display:inline; margin-top:50px;">(<?php echo $c_count ?>)</p></a></li>
        </ul>
    </nav>
