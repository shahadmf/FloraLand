<!-- Maram Alfaraj -->
<!DOCTYPE html>
<html lang="en">

<head>
<!--CSS code-->
<style>

  .HelpRelLink{
    width: 60px;
    height: 60px;
    position: fixed;
    bottom: 17px;
    right: 20px;
    }
    
    .HelpImage{
        width: 100%;
        height: 100%;
        filter: opacity(0.3) drop-shadow(0 0 0 rgb(144, 158, 130)); 
        z-index: 9;
    }

    .HelpRelLink:hover{
        transform: scale(1.1);
    }
  
    .HelpRelLink#blur.active{
        filter: blur(20px);
        pointer-events: none;
        user-select: none;
    }
  
    .h2Help{
        font-weight: 600;
        margin-bottom: 10px;
        color: black;
    }
  
    .aHelp{
        position: relative;
        padding: 5px 20px;
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: black;  
        background-color: white;
        border: 1px solid black;
        border-radius: 5px;
    }

    .aHelp:hover{
        color: white;  
        background-color: black;
    }
  
    #popup{
        position: fixed;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        padding: 50px;
        background: #fff;
        visibility: hidden;
        opacity: 0;
        transition: 0.5s;
        box-shadow: 0 0 80px #CCC;
        z-index: 9;
    }
  
    #popup.active{
        top: 50%;
        visibility: visible;
        opacity: 1;
        transition: 0.5s;
    }

    .contactLink{
        color: black;
        text-decoration: underline;
    }
  
</style>

</head>

<body>

    <!--Help popup image link-->
    <a class ="HelpRelLink" id="blur" href="#" onclick="toggle()"><img class="HelpImage" src="img/helpImg.png" alt="Help"></a>
        <!--Help popup content-->
        <!--Help popup will be displayed after pressing the help image-->
        <div id="popup" >
            <h2 class="h2Help">Need Help?</h2>
            <p>When You add a product to the cart, checkout option will become available to you. To add a product to the cart, click on "Add to cart" button of the desired product and you can view it in the cart.<br><a class="contactLink" href="contact.php" onclick="toggle()">Contact us</a> for more information.</p>
            <a class="aHelp" href="#" onclick="toggle()">Close</a>
        </div>
        
    <!--Javascript code-->
    <!--Help popup toggle function to show and hide the popup-->
    <script>
        function toggle(){
        var blur = document.getElementById('blur');
        blur.classList.toggle('active');
        var popup = document.getElementById('popup');
        popup.classList.toggle('active');
        }       
    </script>

</body>
</html>