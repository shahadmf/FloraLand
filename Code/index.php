<!--CODE DONE BY DALIA ALZAHRANI & NOUF ALALI-->
<?php
session_start();

$product_ids = array();

if (isset($_POST['add'])){ //Check if 'Add to cart' button is clicked
    // SESSION EXISTS
    if(isset($_SESSION['shopping_cart'])) {
    //Keep track of how many products are in the shopping cart
    $count = count($_SESSION['shopping_cart']);
    //array that matches array index with product id
    $product_ids = array_column($_SESSION['shopping_cart'], 'pid');

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
                //Add submitted qty to the existing qty
                $_SESSION['shopping_cart'][$i]['quantity']+= $_POST['quantity'];
            }
        }
    }
}else{
    // NO SESSION EXIST, CREATE NEW SESSION
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
    <link rel="stylesheet" href="./style.css">
    <title>Flora Land</title>
</head>
<body>
    <!-- INCLUDES -->
<?php  include('includes/header.php'); ?>
<?php  include('includes/db-con.php'); ?>
<section id="slogan">
    <div class="container">
        <div class="slogan-content">
            <h4>Bring Freshness To Your Architecture</h4>
            <h1>Healthy Plants, Happy People</h1>
            <a href="AllProductPage.php" class="slogan-button" type="button">Shop Now</a>
        </div>
    </div>
</section>
<!-- LEARN MORE SECTION -->
<section id="first">
    <div class="container">
        <div class="left">
            <h1>Explore The <span>Flora Land</span></h1>
            <p>Bringing the natural world in to your home, office, or outdoor space will increase your quality of life. <br> <br> At Flora Land, we are designers and horticulturists with a mission: to bring the beauty of nature indoors to create more
            comfortable, attractive, and productive places to live and work.</p>
            <br><br><br>
            <a href="contact.php" class="button" type="button">Learn More</a>
        </div>
        <div class="right">
            <img src="img/plant.png" alt="plant">
        </div>
    </div>
</section>

<section id="second">
    <div class="container">
    <h2 class="title">Buy it again</h2>
    <div class="product-container">
        <button class="pre-btn"><img src="img/left-arrow.png" alt="scroll-left"></button>
        <button class="nxt-btn"><img src="img/left-arrow.png" alt="scroll-right"></button>
        <!-- Display Content of cookie for 'BUY AGAIN'  -->
    <?php
    if (!empty($_COOKIE['purchased'])){
        $purchased = json_decode($_COOKIE['purchased'],true);
        $cookie_count = count($purchased);

        for($i=0 ;$i<$cookie_count ;$i++){

        $pid = $purchased[$i]['pid'];
        $pname = $purchased[$i]['pname'];
        $imgUrl = $purchased[$i]['pimg'];
        $pprice = $purchased[$i]['pprice'];
        $query1= "SELECT PStock FROM Products where PID= $pid;";
        $result= mysqli_query($conn, $query1);
        $row = mysqli_fetch_assoc($result);
        $pstock= $row["PStock"];

        echo "<div class='product-card'>
            <div class='product-img'>
                <a href='productDetails.php?pid=".$pid."'><img src=$imgUrl alt=$pname></a>
            </div>
            <h3 class='card-name'>$pname</h3>
        
            <form action='index.php?pid=".$pid."&pstock=".$pstock."' method='post' style='border:0px;'> 
            <input type='hidden' name='pname' value=$pname>
            <input type='hidden' name='pprice' value=$pprice>
            <input type='hidden' name='pimg' value=$imgUrl>
            <input type='hidden' name='quantity' value=1>
            <button class='card-btn' name='add' type='submit'>Add to Cart</button>
            </form>
            <h4 class='price'>$$pprice</h4>
            </div>";
        }}else{
        // If cookie array is empty display random products
        $sql = "SELECT * FROM Products;";
        $result= mysqli_query($conn, $sql);
        for($i=1 ; $i<=4; $i++){

        $row = mysqli_fetch_assoc($result);
        $pid = $row['PID'];
        $imgUrl = "img/".$row['Pic1'];
        $pname = $row['PName'];
        $pprice = $row ['PPrice'];
        $pstock = $row ['PStock'];
        echo "<div class='product-card'>
            <div class='product-img'>
                <a href='productDetails.php?pid=".$pid."'><img src=$imgUrl alt=$pname></a>
            </div>
            <h3 class='card-name'>$pname</h3>
        
            <form action='index.php?pid=".$pid."&pstock=".$pstock."' method='post' style='border:0px;'> 
            <input type='hidden' name='pname' value=$pname>
            <input type='hidden' name='pprice' value=$pprice>
            <input type='hidden' name='pimg' value=$imgUrl>
            <input type='hidden' name='quantity' value=1>
            <button class='card-btn' name='add' type='submit'>Add to Cart</button>
            </form>
            <h4 class='price'>$$pprice</h4>
            </div>";
        }}
    ?>
                
            
    </div>
    </div>
</section>
<!-- NEW ARRIVALS SECTION -->
<section id="second">
    <div class="container">
        <h2 class="title">New Arrivals</h2>
        <div class="product-container">
        <?php 

        $sql = "SELECT * FROM Products;";
        $result= mysqli_query($conn, $sql);
        for($i=1 ; $i<=4; $i++){
            $row = mysqli_fetch_assoc($result);
            $pid = $row['PID'];
            $imgUrl = "img/".$row['Pic1'];
            $pname = $row['PName'];
            $pprice = $row ['PPrice'];
            $pstock = $row ['PStock'];

        echo "<div class='product-card'>
                <div class='product-img'>
                <a href='productDetails.php?pid=".$pid."'><img src=$imgUrl alt=$pname></a>
                </div>
                <h3 class='card-name'>$pname</h3>
                <form action='index.php?pid=".$pid."&pstock=".$pstock."' method='post' style='border:0px;'> 
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
    <!-- JS code For SLIDER Used in 'BUY AGAIN' Section -->
    <script>
        const productContainers = [...document.querySelectorAll('.product-container')];
        const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
        const preBtn = [...document.querySelectorAll('.pre-btn')];

        productContainers.forEach((item,i)=>{
            let containerDimension = item.getBoundingClientRect();
            let containerWidth = containerDimension.width;

            nxtBtn[i].addEventListener('click', ()=>{
                item.scrollLeft+=containerWidth;
            })

            preBtn[i].addEventListener('click', ()=>{
                item.scrollLeft -=containerWidth;
            })
        })
    </script>

    <br><br><br><br>
    <?php include('includes/footer.html'); ?>
</body>
</html>