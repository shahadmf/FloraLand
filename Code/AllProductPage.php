<!--Done by Rahaf Alhajri-->
<?php
//session start
session_start();

$product_ids = array();

if (isset($_POST['add'])){
//cart session
if(isset($_SESSION['shopping_cart'])) {
    //Keep track of how many products are in the shopping cart
    $count = count($_SESSION['shopping_cart']);
    //array that matches array index with product id
    $product_ids = array_column($_SESSION['shopping_cart'], 'pid');
//products doesn't exist in the cart
    if (!in_array($_GET['pid'], $product_ids)){
        
        $_SESSION['shopping_cart'][$count] = array(
        'pid' => $_GET['pid'],
        'pstock'=>$_GET['pstock'],
        'pname' => $_POST['pname'],
        'pprice' => $_POST['pprice'],
        'quantity' => $_POST['quantity'],
        'pimg' => $_POST['pimg']);    
    }
    else{//product already exist in the cart
        for( $i=0 ; $i< count($product_ids) ; $i++){
            if ($product_ids[$i] == $_GET['pid']){
                //update the quantity value
                $_SESSION['shopping_cart'][$i]['quantity']+= $_POST['quantity'];
            }
        }
    }
}else{//if the cart is empty then this will be the first value with index 0
    $_SESSION['shopping_cart'][0] = array(
        'pid' => $_GET['pid'],
        'pstock'=>$_GET['pstock'],
        'pname' => $_POST['pname'],
        'pprice' => $_POST['pprice'],
        'quantity' => $_POST['quantity'],
        'pimg' => $_POST['pimg']
    );
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AllProducts.css">
    <title>Flora Land</title>
</head>
<body>
 <!-- the header and the connection with the database include-->
<?php  include('includes/header.php'); ?>
<?php  include('includes/db-con.php'); ?>
    
<!--  viewing the PLANTS products-->
    <section id="second">
        <div class="container">
                <h2 class="title"; id="plants">Plants</h2>
                <div class="product-container">
        <?php 

        $sql = "SELECT * FROM Products where PCategory='Plants';";
        $result= mysqli_query($conn, $sql);
        $num=mysqli_num_rows($result);

        echo "<div style='display: grid; grid-template-columns: auto auto auto auto;'>";

            for($i=1;$i<=$num;$i++){
            $row = mysqli_fetch_assoc($result);
            $pid = $row['PID'];
            $imgUrl = "img/".$row['Pic1'];
            $pname = $row['PName'];
            $pprice = $row ['PPrice'];
            $pstock= $row['PStock'];


        echo "

        <div style='margin-top: 20px' class='product-card'>
                <div class='product-img'>
                    <a href='productDetails.php?pid=".$pid."'><img src=$imgUrl alt=$pname></a>
                </div>
                <h3 class='card-name'>$pname</h3>
                <form action='AllProductPage.php?pid=".$pid."&pstock=".$pstock."' method='post' style='border:0px;'> 
                <input type='hidden' name='pname' value=$pname>
                <input type='hidden' name='pprice' value=$pprice>
                <input type='hidden' name='pimg' value=$imgUrl>
                <input type='hidden' name='quantity' value=1>
                <button class='card-btn' name='add' type='submit'>Add to Cart</button>
                </form>
                <h4 class='price'>$$pprice</h4></div>
        
                ";
        
        
        
        }
                    echo"</div>";

        
        ?>

        </div>
    <!-- viewing the CARE TOOLS product -->
        <br><br><br>
            <h2 class="title"; id="tools">Care tools</h2>
            <div class="product-container">
        
        <?php 

        $sql = "SELECT * FROM Products where PCategory='Care Tools';";
        $result= mysqli_query($conn, $sql);
        $num=mysqli_num_rows($result);
    
        echo "<div style='display: grid; grid-template-columns: auto auto auto auto;'>";
        
        
            for($i=1;$i<=$num;$i++){
            $row = mysqli_fetch_assoc($result);
            $pid = $row['PID'];
            $imgUrl = "img/".$row['Pic1'];
            $pname = $row['PName'];
            $pprice = $row ['PPrice'];
            $pstock=$row['PStock'];

        echo "<div  style='margin-top: 20px' class='product-card'>
                <div  class='product-img'>
                    <a href='productDetails.php?pid=".$pid."'><img src=$imgUrl alt=$pname></a>
                </div>
                <h3 class='card-name'>$pname</h3>
                <form action='AllProductPage.php?pid=".$pid."&pstock=".$pstock."' method='post' style='border:0px;'> 
                <input type='hidden' name='pname' value=$pname>
                <input type='hidden' name='pprice' value=$pprice>
                <input type='hidden' name='pimg' value=$imgUrl>
                <input type='hidden' name='quantity' value=1>
                <button class='card-btn' name='add' type='submit'>Add to Cart</button>
                </form>
                <h4 class='price'>$$pprice</h4>
            </div>";
        }
            echo"</div>";
        ?>
            </div>     
    
    
    
    <br><br><br><br>
            <!-- footer -->
    <footer>
    <hr><br><br>
    <div class="row">
        <div class="col">
            <p  class="title" style="font-size:15px; margin-bottom: 20px;font-weight: bold;  text-decoration: none;">FLORA <span>LAND</span></p>
            <ul class="pages">
                <li><a href="index.php">Home</a></li>
                <li><a href="AllProductPage.php">Products</a></li>
                <li><a href="contact.php">Contact us</a></li>
            </ul>
        </div>
        <div class="col">
            <p class="title" style="font-size:15px; margin-bottom: 20px;font-weight: bold;  text-decoration: none;">NEWS<span>LETTER</span></p>
            <p class="col2-txt">Subscribe to our weekly newsletter </p>
            <form>
                <img src="img/letter.png" alt="newsletter">
                <input id="email" name="email" type="email" placeholder="Enter Your Email" required is-email>
                <input type="submit" value="Send" style="color: black;" onclick="ValidateEmail()">
                <script>
                    function ValidateEmail()
                        {
                        inputText = document.getElementById("email");
                        var mailformat = "[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$";
                        if(inputText.value.match(mailformat))
                        alert("Thank You! You have been added to our newsletter list.");    //The pop up alert for a valid email address
                        else
                        alert("You have entered an invalid email address.");    //The pop up alert for an invalid email address
                        
                        }
                </script>
            </form>
        </div>
        <div class="col">
            <p class="title" style="font-size:15px; margin-bottom: 20px;font-weight: bold;  text-decoration: none; display: inline;">FOLLOW <span style="display: inline;">US</span></p>
            <div class="social">
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/"><img src="img/facebook.png" alt="facebook"></a></li>
                    <li><a href="https://www.instagram.com/"><img src="img/instagram.png" alt="Instagram"></a></li>
                    <li><a href="https://twitter.com/?lang=en"><img src="img/twitter.png" alt="Twitter"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<hr><br><br>
<p class="copyright"><strong>&copy; 2022 Flora Land, All Rights Reserved</strong></p>
               </div>
    </section>
</body>
</html>