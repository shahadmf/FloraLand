<!--Done by Rahaf Alhajri-->
    <?php   
//session start
session_start();
//database connection
include('includes/db-con.php');
    if (isset($_GET['action'])){
       $product_ids = array();
        // adding items to the cart action
        if ($_GET['action']=='add'){         
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
        'pname' => $_GET['pname'],
        'pprice' => $_GET['pprice'],
        'quantity' => $_GET['quantity'],
        'pimg' => $_GET['pimg'],
        );  
             

            
    }
    else{//product already exist in the cart
        for( $i=0 ; $i< count($product_ids) ; $i++){
            if ($product_ids[$i] == $_GET['pid']){
                //update the quantity value
                $_SESSION['shopping_cart'][$i]['quantity']+= $_GET['quantity'];
            }
     
        }
     
    }
      
}
            else{//if the cart is empty then this will be the first value with index 0
    $_SESSION['shopping_cart'][0] = array(
        'pid' => $_GET['pid'],
        'pstock'=>$_GET['pstock'],
        'pname' => $_GET['pname'],
        'pprice' => $_GET['pprice'],
        'quantity' => $_GET['quantity'],
        'pimg' => $_GET['pimg'],
    
    );
    }

        }
        // perform action buy now button from product details page 
            if ($_GET['action']=='buy-now'){
if(isset($_SESSION['shopping_cart'])) {
    //Keep track of how many products are in the shopping cart
    $count = count($_SESSION['shopping_cart']);
    //array that matches array index with product id
    $product_ids = array_column($_SESSION['shopping_cart'], 'pid');

    if (!in_array($_GET['pid'], $product_ids)){
        
        $_SESSION['shopping_cart'][$count] = array(
        'pid' => $_GET['pid'],
        'pname' => $_GET['pname'],
        'pprice' => $_GET['pprice'],
        'pstock' => $_GET['pstock'],
        'quantity' => $_GET['quantity'],
        'pimg' => $_GET['pimg']);    
    }
    else{//product already exist in the cart
        for( $i=0 ; $i< count($product_ids) ; $i++){
            if ($product_ids[$i] == $_GET['pid']){
                //update the quantity values
                $_SESSION['shopping_cart'][$i]['quantity']+= $_GET['quantity'];
            }
        }
    }
}else{
    $_SESSION['shopping_cart'][0] = array(
        'pid' => $_GET['pid'],
        'pname' => $_GET['pname'],
        'pprice' => $_GET['pprice'],
        'pstock' => $_GET['pstock'],
        'quantity' => $_GET['quantity'],
        'pimg' => $_GET['pimg']
    );
    }
    }
        // to delete all the items in the cart
        if ($_GET['action']=='clear'){
       
            $_SESSION['shopping_cart']=NULL;
           
            
        }
        // to delete single item in the cart
        if ($_GET['action']=='delete'){
           
    if(isset($_SESSION['shopping_cart'])) {
    
    $count = count($_SESSION['shopping_cart']);
        
        if($count>0){
           
    $product_ids = array_column($_SESSION['shopping_cart'], 'pid');
        for( $i=0 ; $i< count($product_ids) ; $i++){
            if ($product_ids[$i] == $_GET['pid']){
                unset($_SESSION['shopping_cart'][$i]);
                $count=$count-1;
                $_SESSION['shopping_cart']=array_values($_SESSION['shopping_cart']);
                
        }
        }
        
         
        
        }
        if($count<=0){$_SESSION['shopping_cart']=NULL;}
    }
        
           
        
        }
        
        //checkout action and cookie
      if ($_GET['action']=='buy'){
         $count = count($_SESSION['shopping_cart']);
            for ($i=0 ;$i<$count ;$i++){
            $pid = $_SESSION['shopping_cart'][$i]['pid'];
            $query1= "SELECT PStock FROM Products where PID= $pid;";
            $result= mysqli_query($conn, $query1);
            $row = mysqli_fetch_assoc($result);
            $old_qty= $row["PStock"];
            $new_qty = $old_qty - $_SESSION['shopping_cart'][$i]['quantity'];
            $query2 = "UPDATE products SET PStock='$new_qty' WHERE PID='$pid' ";
            $query_run = mysqli_query($conn, $query2);                
            }
            setcookie('purchased', json_encode($_SESSION['shopping_cart']));
            $_SESSION['shopping_cart'] = NULL;

            
        }
         
    }

//changing quantity by the buttons in the cart
 if($_SERVER['REQUEST_METHOD']=='POST'){
     
     if(isset($_POST['Mod_Q']))
     {
    $count = count($_SESSION['shopping_cart']);
    $product_ids = array_column($_SESSION['shopping_cart'], 'pid');
         for( $i=0 ; $i< count($product_ids) ; $i++){
            if ($product_ids[$i] == $_POST['pid']){
                $_SESSION['shopping_cart'][$i]['quantity']= $_POST['Mod_Q'];
            }
     
     }
 }
 }


    ?> 

<!DOCTYPE html>
<html lang="en">
<head>
     
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CartStyle.css">
    <!-- include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    
    
    <title>Flora Land Cart</title>
</head>
<body>
    <!-- include header -->
    <?php include('includes/header.php');?>
    
    <section id="second">
    <br><br>
    <div class="wrapper">
        <h2 class="title">Shopping Cart<a onclick='javascript:confirmationDelete($(this));return false;' href='cart.php?action=clear'><button class="buttonc buttonc1">Clear All</button></a></h2>
<!-- products listed in the cart -->
    <div class="project">
        <div class="shop">
            <?php 
            $flag=1;
            if (isset($_SESSION['shopping_cart'])){
                $count = count($_SESSION['shopping_cart']);
             
                for ($i=0 ;$i<$count ;$i++){
                    $pid= $_SESSION['shopping_cart'][$i]['pid'];
                    $pstack1=  $_SESSION['shopping_cart'][$i]['pstock'];
                    $pname =  $_SESSION['shopping_cart'][$i]['pname'];
                    $pprice = $_SESSION['shopping_cart'][$i]['pprice'];
                    $quantity = $_SESSION['shopping_cart'][$i]['quantity'];
                    $imgUrl = $_SESSION['shopping_cart'][$i]['pimg'];
                    

                    echo "
                    <div class='box'>
                        <img src=$imgUrl>
                        <div class='content'>
                            <h3>$pname</h3>
                            <h4 style='margin:0;'>Price: $$pprice</h4>
                            <br>
                            <h4 style='margin:0;display:inline;text-align:left;'>Total:</h4>
                           <h4 style='margin:0; display:inline;text-align:left;' class='itotal'></h4>
                            
                             <input type='hidden' class='iprice' value='$pprice'>
                             
                            
                            
                        <form action='cart.php' method='POST'> 
                           <h4 class='unit'><br>Quantity: 
                          <input class='iquantity' name='Mod_Q' onchange='this.form.submit();' style=' background-color:#ecede8; cursor: default;color: transparent; text-shadow: 0px 0px black; width:50px;' type='number' onkeydown='return false' name='qty' value=$quantity min=1 max=$pstack1>
                           </h4>
                           <input type='hidden' name='pid' value='$pid'> 
                        </form>
                            
                            <p class='btn-area'><i aria-hidden='true' class='fa fa-trash'></i> <a onclick='javascript:confirmationDelete2($(this));return false;' style='color:white;'href='cart.php?action=delete&pid=$pid' ><span class='btn2'>Remove</span></a></p>
                        </div>
                    </div>
                    ";
                    if($quantity>$pstack1)
                    { 
                     $flag=0;
                     $fname=$pname;
                     $fstack=$pstack1;
                    } 
                }
            }
            else {
                echo'<p style="font-size:28px; color:gray; text-align: center; margin-top:100px;">Your Cart is Empty</p><p style="text-align: center; margin-top:15px;"> <img src="./img/em2.png"><p> ';
                $count=0;
            }
            ?>
            
        </div>
        
<!-- right bar for the cart which includes the item number and the price with the checkout button -->
			<div class="right-bar" style=" height: 550px;">
                <br>
				<p><span><?php echo $count; ?> Items</span></p>
				<hr style="width: 100%">
				<p><span>Subtotal</span><span style="margin:0px" id="gtotal"></span></p>
				<hr style="width: 100%">
				<p><span>Tax (15%)</span><span id="gtax"></span></p>
				<hr style="width: 100%">
				<p><span>Grand Total</span><span id="ggtotal"></span></p>
                <span>Select delivery method:<div style="text-align: left;margin-top:10%">
<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch1">
    <label class="onoffswitch-label" for="myonoffswitch1">
        <div class="onoffswitch-inner">
            <div class="onoffswitch-active">
                <div class="onoffswitch-switch">Pick-up</div>
            </div>
            <div class="onoffswitch-inactive">
                <div class="onoffswitch-switch">Delivery</div>
            </div>
        </div>
    </label>
</div>
<br><br><br>
</div></span>
        <!-- checking that the product quantity is less that or equal the stock value  -->
       <?php 
                if($flag!=0&&$count!=0)
                    echo'<i class="fa fa-shopping-cart"></i><a href="#ex1" rel="modal:open">Checkout</a>';
                else if($count==0)
                    {echo'<p style="color:gray;">Add products to be able to checkout</p>';} 
                else if($flag==0)
                    echo'<p style="color:red; display:inline;">Product </p><p style="color:red; display:inline;text-decoration: underline; font-weight: bold;">'.$fname.'<p style="color:red; display:inline;"> is out of stock please try to reduce the quantity.</p><br><p style="color:black;">Available items:'.$fstack.'</p>';
                 ?>
        </div>
              
        </div>
        <a href="AllProductPage.php" class="cs">&#8592; Continue Shopping</a>
        
      </div>
        
<!-- thank you window -->
<style>
        .modal a.close-modal {
    position: absolute;
    top: -12.5px;
    right: -12.5px;
    display: block;
    width: 0px;
    height: 0px;
    text-indent: -9999px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center center;
}
}
        </style>
      
<div id="ex1" class="modal" style="display:none;">
    
        <img src="img/party.png" align="left" width="150" height="150"><br>
  <p style="display:inline; font-family:monaco; font-size: 20px;font-weight: bold; "><br> Thank you for shopping...</p>
    <a href="cart.php?action=buy" style="color:black;" >
        <p style="display:inline; color:#DC143C; font-family:monaco; font-size: 20px;font-weight: bold;"><br><br> Click here to close the window</p>
        </a>
</div>
<!-- javaScript part for changing the total and subtotal dynamically -->
        
    </section>
    <script>
        function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete all items?');
   if(conf)
      window.location=anchor.attr("href");
}
    </script>
    <script>
        function confirmationDelete2(anchor)
{
   var conf = confirm('Are you sure want to delete this item?');
   if(conf)
      window.location=anchor.attr("href");
}
    </script>
    <script>
        
    var gt=0,tax=0,ggt=0;    
     var iprice=document.getElementsByClassName('iprice');
     var iquantity=document.getElementsByClassName('iquantity');
     var itotal=document.getElementsByClassName('itotal');  
     var gtotal=document.getElementById('gtotal');
     var gtax=document.getElementById('gtax');
     var ggtotal=document.getElementById('ggtotal');
        
    function subToltal()
        {
            gt=0;
            for(i=0;i<iprice.length;i++){
              
                itotal[i].innerText="$"+((iprice[i].value)*(iquantity[i].value));
                gt=gt+(iprice[i].value)*(iquantity[i].value);
            }
            
            
          gtotal.innerText="$"+gt;
          gtax.innerText="$"+(gt*0.15);
          ggtotal.innerText="$"+(gt+(gt*0.15));
            
        }
        
        subToltal();
    
    </script>
      <br><br><br><br>
    <!-- footer include -->
    <?php include('includes/footer.html'); ?>
</body>
</html>
