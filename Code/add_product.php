<!--ADD PRODUCTS FORM, DONE BY FATIMA M. ALNASSER, 2190003750, CS MAJGOR LEVEL 8 GROUP 1.-->

<!--HTML & PHP Part-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Product</title>
    <link rel="stylesheet" type="text/css" href="admin-forms.css?<?php echo time(); ?>">
    <!--LINK TO STYLESHEET-->
    <script type="text/javascript" src="admin-forms.js"></script>
</head>

<!--BODY-->

<body>

    <!--HEADER-->
    <header>

        <!--BACK BUTTON-->
        <button class="back_button">
            <a href="admin.php"><img src="img/back.png" alt="Back Button" width="25px" height="25px"></a>
        </button>

        <!--FORM TITLE-->
        <h2>Add a New Product</h2>

    </header>
    <!--END OF HEADER-->

    <!--ADD FORM-->
    <div class="background">
        <form id="form" method="post" action="code.php">
            <p>
                <label>Product Name:</label>
                <input type="text" placeholder="Type a product name..." id="product_name" name="product_name" size="25"
                    autofocus><br>
                <small id="helpText1"></small>
            </p>

            <p>
                <label>Product Category:</label><br>
                <select name="category" id="category">
                    <option disabled selected value> -- Select an Option -- </option>
                    <option>Plants</option>
                    <option>Care Tools</option>
                </select><br>
                <small id="helpText2"></small>
            </p>

            <p>
                <label>Product In-stock:</label>
                <input type="number" placeholder="Type a number..." id="product_stock" name="product_stock" step="1"><br>
                <small id="helpText3"></small>
            </p>

            <p>
                <label>Product Price:</label>
                <input type="number" placeholder="Type a price..." id="product_price" name="product_price" min="1"
                    step="1"><br>
                <small id="helpText4"></small>
            </p>

            <p>
                <label> Uplode Product Image 1:</label>
                <input type="file" accept="image/*" id="product_pic1" name="product_pic1"><br>
                <small id="helpText5"></small>
            </p>

            <p>
                <label> Uplode Product Image 2:</label>
                <input type="file" accept="image/*" id="product_pic2" name="product_pic2"><br>
                <small id="helpText6"></small>
            </p>

            <p>
                <label> Uplode Product Image 3:</label>
                <input type="file" accept="image/*" id="product_pic3" name="product_pic3"><br>
                <small id="helpText7"></small>
            </p>

            <p>
                <label> Uplode Product Image 4:</label>
                <input type="file" accept="image/*" id="product_pic4" name="product_pic4"><br>
                <small id="helpText8"></small>
            </p>

            <p>
                <label> Uplode Product Image 5:</label>
                <input type="file" accept="image/*" id="product_pic5" name="product_pic5"><br>
                <small id="helpText9"></small>
            </p>

            <p>
                <label>Product Description: </label><br>
                <textarea name="product_desc" id="product_desc" cols="50" rows="5"
                    placeholder="Type a description for the product..."></textarea><br>
                <small id="helpText10"></small>
            </p>

            <div class="submit_area">
                <input type="submit" id="submit" value="ADD Product" name="add_product">
                <input type="reset" id="reset" value="Clear">
            </div>
        </form>
        <!--END OF ADD FORM-->

    </div>


</body>
<!--END OF BODY-->

<!--PHP include statement for footer.-->
<?php include('includes/admin-footer.html');?>

</html>