<!--Done by Dana AlOtabi-->
<?php
session_start();

$product_ids = array();

if (isset($_POST['add'])){

if(isset($_SESSION['shopping_cart'])) {
    //Keep track of how many products are in the shopping cart
    $count = count($_SESSION['shopping_cart']);
    //array that matches array index with product id
    $product_ids = array_column($_SESSION['shopping_cart'], 'pid');

    if (!in_array($_GET['pid'], $product_ids)){
        
        $_SESSION['shopping_cart'][$count] = array(
        'pid' => $_GET['pid'],
        'pname' => $_POST['pname'],
        'pprice' => $_POST['pprice'],
        'pstock' => $_POST['pstock'],
        'quantity' => $_POST['quantity'],
        'pimg' => $_POST['pimg']);    
    }
    else{//product already exist in the cart
        for( $i=0 ; $i< count($product_ids) ; $i++){
            if ($product_ids[$i] == $_GET['pid']){
                //Add submitted qty to the existing qty
                $_SESSION['shopping_cart'][$i]['quantity']+= $_POST['quantity'];
            }
        }
    }
}else{
    $_SESSION['shopping_cart'][0] = array(
        'pid' => $_GET['pid'],
        'pname' => $_POST['pname'],
        'pprice' => $_POST['pprice'],
        'pstock' => $_POST['pstock'],
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
    <link rel="stylesheet" href="./product.css">
    <title>Flora Land</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <?php 
    include('includes/header.php');
    include('includes/db-con.php');
    include('includes/helpPopup.php');
    ?>	

    <?php 
            $pid = $_GET['pid'];
            $sql = "SELECT * FROM Products WHERE PID= $pid;";
            $result= mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $imgUrl = "img/".$row['Pic1'];
            $PDes = $row['P_Description'];
            $PName = $row['PName'];
            $PPrice = $row['PPrice'];
            $PStock = $row['PStock'];
            $PCategory = $row['PCategory'];
    echo "
        <section class='product-section'>
        <div class='left'>
        <div class='big-img'>
            <img src=$imgUrl alt=$PName>
            </div>";

        $sql = "SELECT Pic2, Pic3, Pic4, Pic5 FROM products WHERE PID= $pid;";
        $result= mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        
        echo "<div class='images'>";
        for($i=0 ; $i<=3; $i++){
            echo"
                <div class='smll-img'>
                    <img src='img/".$row[$i]."' onclick='showImg(this.src)' >
                </div>";
        }
        echo "        
        </div> 
        </div> 
        
            <div class='product-detail' style='width: 50vw;'>
                <h1 class='product-title'> $PName </h1>
                <p class='product-des'> $PDes</p>
                <p class='prices'>$$PPrice</p>
                <div class='quantity' style='width: 12.5vw;'>
                
                <form action='productDetails.php?pid=".$pid."' id='prodForm' method='post' style='width: 30vw;'> 
                    <button  id='decrement' onclick='stepper(this)' type='button'> - </button>
                    <input type='number' name='quantity' id='my-input'  min='1' max= $PStock step='1' value='1' readonly> 
                    <button id='increment' onclick='stepper(this)' type='button'> + </button>
                    <input type='hidden' name='pname' value=$PName>
                    <input type='hidden' name='pprice' value=$PPrice>
                    <input type='hidden' name='pstock' value=$PStock>
                    <input type='hidden' name='pimg' value=$imgUrl>
                </div>
                <div class='btn-container'>
                    <input class='product-btn buy-btn' name='add' type='submit' value='Add to Cart'>
                    </form>
                    <a href='cart.php?action=buy-now&pid=".$pid."&pname=".$PName."&pstock=".$PStock."&pprice=".$PPrice."&pimg=".$imgUrl."' id= 'buy-link'><button class='product-btn buy-btn' id='buy-btn' type='button' onclick='quantity()'>buy now </button></a>
                </div>

            </div>
        </section> ";
        ?>
    <?php if (strcmp($PCategory,"Plants")==0) { ?>
  <section class="details-des">
        
        <h1 class="titles"><i class="fa fa-heart" aria-hidden="true"></i> <?php echo $PName; ?> Likes<br></h1><br><br>
        <table class="table-venues">
        
            <tr>
            <th class="section-title">Humidity</th>
            <th class="section-title">Medium light</th>
            <th class="section-title">Regular watering</th>
            </tr>
            <tr>
                <td class="des">She loves moist air, so she’ll be very happy living in a bathroom. If that’s not possible, mist her every other day.</td>
                <td class="des">She’s happy enough in light shade, but loves bright, soft light. Harsh sun will scorch her delicate leaves.</td>
                <td class="des">As with most ferns, she likes moist conditions. Check her frequently and water her if the top inch of soil is dry.</td>
            </tr>
            
        </table>
        
        
    </section>
  
    <?php } ?>
        <br><br><br><br>
     
   
    
<section id="second">
    <div class="container">
        <h2 class="title">Suggested Products</h2>
        <div class="product-container">
        <?php 

        $sql = "SELECT * FROM Products order by rand();";
        $result= mysqli_query($conn, $sql);
        for($i=1 ; $i<=4; $i++){
            $row = mysqli_fetch_assoc($result);
            $pid = $row['PID'];
            $imgUrl = "img/".$row['Pic1'];
            $pname = $row['PName'];
            $pprice = $row ['PPrice'];

        echo "<div class='product-card'>
                <div class='product-img'>
                    <a href='productDetails.php?pid=".$pid."'><img src=$imgUrl alt=$pname></a>
                </div>
                <h3 class='card-name'>$pname</h3>
                <form action='index.php?pid=".$pid."' method='post' style='border:0px;'> 
                <input type='hidden' name='pname' value=$pname>
                <input type='hidden' name='pprice' value=$pprice>
                <input type='hidden' name='pimg' value=$imgUrl>
                <input type='hidden' name='quantity' value=1>
                <button class='card-btn' name='add' type='submit'>Add to Cart</button>
                </form>
                <h4 class='price'>$$pprice</h4>
            </div>";
        }
        ?>
    </div>
    </div>
</section>

    <br><br><br><br>
    <footer>
    <hr><br><br>
    <div class="row">
        <div class="col">
            <p class="title">FLORA <span>LAND</span></p>
            <ul class="pages">
                <li><a href="index.php">Home</a></li>
                <li><a href="AllProductPage.php">Products</a></li>
                <li><a href="contact.php">Contact us</a></li>
            </ul>
        </div>
        <div class="col">
            <p class="title">NEWS<span>LETTER</span></p>
            <p class="col2-txt">Subscribe to our weekly newsletter </p>
            <form>
                <img src="img/letter.png" alt="newsletter">
                <input id="email" name="email" type="email" placeholder="Enter Your Email" required is-email>
                <input type="button" value="Send" style="color: black;">
            </form>
        </div>
        <div class="col">
            <p class="title">FOLLOW<span> US</span></p>
            <div class="social">
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/"><img src="img/facebook.png" alt="facebook"></a></li>
                    <li><a href="https://www.instagram.com/"><img src="img/instagram.png" alt="Instagram"></a></li>
                    <li><a href="https://twitter.com/?lang=en"><img src="img/twitter.png" alt="Twitter"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr><br><br>
    <p class="copyright"><strong>&copy; 2022 Flora Land, All Rights Reserved</strong></p>
</footer>

    <script >
         let bigImg= document.querySelector('.big-img img');
         function showImg(pic){
            bigImg.src = pic;
        }
    </script>
    <script src="script.js"></script>
    <script src="qty.js"></script>

</body>
</html>