<!--CODE DONE BY DALIA ALZAHRANI-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <title>Flora Land</title>
</head>

<body>
    <nav>
        <ul class="nav-items">
            <img src="img/logo.png" alt="Logo" class="logo">
            <li><a href="index.php" class="logout effect"><img class="logout-img" src="img/logout.png" alt="logout"></a></li>
        </ul>

    </nav>
    <section id="slogan">
        <div class="container">
            <div class="slogan-content">
                <h4>Bring Freshness To Your Architecture</h4>
                <h1>Healthy Plants, Happy People</h1>
                <a href="admin.php" class="slogan-button" type="button">Manage Products</a>
            </div>
        </div>
    </section>
    <!-- LEARN MORE SECTION -->
    <section id="first">
        <div class="container">
            <div class="left">
                <h1>Explore The <span>Flora Land</span></h1>
                <p>Bringing the natural world in to your home, office, or outdoor space will increase your quality of
                    life. <br> <br> At Flora Land, we are designers and horticulturists with a mission: to bring the
                    beauty of nature indoors to create more
                    comfortable, attractive, and productive places to live and work.</p>
                <br><br><br>
                <a href="contact.php" class="button" type="button">Learn More</a>
            </div>
            <div class="right">
                <img src="img/plant.png" alt="plant" autoplay>
            </div>
        </div>
    </section>

    <?php include('includes/db-con.php'); ?>
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

        echo "<div class='product-card'>
                <div class='product-img'>
                    <a href='productDetails.php?pid=".$pid."'><img src=$imgUrl alt=$pname></a>
                </div>
                <h3 class='card-name'>$pname</h3>
                <h4 class='price'>$$pprice</h4>
            </div>";
        }
        ?>
    
            </div>
        </div>
    </section>

    <br><br><br><br>
    <?php include('includes/footer.html'); ?>
</body>

</html>