<!--Done by Dana AlOtabi and Shahad Alfaddagh -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>Flora Land</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
    <script defer src="contact.js"></script>
    
</head>
<body>
    
<?php 
    include('includes/header.php');
    include('includes/db-con.php');
    ?>	
    <div class="contact-wrap">
        <div class="contact-in">
            <h1>Contact Info</h1>
            <h2><i class="fa fa-phone" aria-hidden="true"></i> Phone</h2>
            <p>0505122000</p>
            <h2><i class="fa fa-envelope" aria-hidden="true"></i>Email</h2>
            <p>Floraland@gmail.com</p>
            <h2><i class="fa fa-map-marker" aria-hidden="true"></i>Address</h2>
            <p>Pipse street, Khober, Saudi Arabia</p>
            <ul>
                <li><a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
   
    
        <div class="contact-in">
            
        <form id="form" action="/">
            <h1>Send a Message</h1>
            <div class="input-control">
                <label for="username">Full Name</label>
                <input id="username" name="username" type="text" placeholder="Enter your name">
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text"  placeholder="Mohammed@gmail.com" >
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Type your message...</label>
                <textarea id="messages" name="text" name="messages" placeholder="Type your message here ..."></textarea>
                <div class="error"></div>
            </div>
            <div class="input-control">
            <input type="submit" name="Submit">
            </div>
        </form>

        </div>
        <div class="contact-in">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2598907.1506781634!2d48.903060660590775!3d24.775134954829287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49e839e8ef58d9%3A0xef778812d8b6aad1!2z2KfZhNiu2KjYsQ!5e0!3m2!1sar!2ssa!4v1646388174041!5m2!1sar!2ssa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> 
        </div>
    </div>
   
    <?php include('includes/footer.html');?>
     
</body>
</html>