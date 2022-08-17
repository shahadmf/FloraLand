<!--MANAGE PRODUCTS PAGE. DONE BY FATIMA M. ALNASSER, 2190003750, CS MAJGOR LEVEL 8 GROUP 1.-->

<!--Start session first-->
<?php session_start();?>

<!--HTML & PHP Part-->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Flora Land</title>
        <link rel="stylesheet" type="text/css" href="admin-style-sheet.css"><!--LINK TO STYLESHEET-->
    </head>

    <!--BODY-->
    <body>

        <!--HEADER-->
        <header>

            <!--BACK BUTTON-->
            <button class="back_button">
                <a href="admin-home.php"><img src="img/back.png" alt="Back Button" title="Back Button" width="25px" height="25px"></a>
            </button>

            <!--LOGO-->
            <img src="img/logo.png" alt="Flora Land Logo" title="Flora Land Logo" width="70" height="70" class="logo">
           
            <!--SEARCHBAR-->
            <form action="admin.php" method="post" autocomplete="on">
                <div class="searchbar">
                    <input  type="text" name="search" id="search" placeholder="Search by Product ID, Name, or Category" title="Search by Product ID, Name, or Category" size="25" autocomplete="on" value=""/>
                </div>  
                <input type="submit" name="search_button" value="Search" class="search_button" title="Search Button"/>
            </form>
            <!--END OF SEARCHBAR-->

        </header>
        <!--END OF HEADER-->

        <main>
            <div class="panel_container">
                <div class="panel_title">
                    <p>Manage Products</p>
                    <!--PHP code to display session mesaages and feedback.-->
                    <?php
                        if (isset($_SESSION['success']) && $_SESSION['success'] !='')
                        {
                        echo '<p style="color: green;"> ' .$_SESSION['success']. '</p>';
                        unset ($_SESSION["success"]);
                        }
                        if (isset($_SESSION['status']) && $_SESSION['status'] !='')
                        {
                        echo '<p style="color: red;">' .$_SESSION["status"]." </p>";
                        unset ($_SESSION['status']);
                        }
                    ?>
                    <!--ADD PRODUCT BUTTON-->
                    <a href="add_product.php" class="add_button" name="add_button">+ ADD PRODUCT</a>
                </div>

                <!--PHP code to display search results.-->
                <?php
                    if(isset($_POST['search_button']) )
                    {
                        $search_value = $_POST['search'];
                        $query = "SELECT * FROM products WHERE CONCAT(PID, PName, PCategory) LIKE '%".$search_value."%'";
                        $search_result = filterTable($query);
                    }
                    else
                    {
                    $query = "SELECT PID, PName, PPrice, PStock, PCategory, P_Description, Pic1, Pic2, Pic3, Pic4, Pic5 FROM products";
                    $search_result = filterTable($query);
                    }
                ?>

                <!--TABLE OF SEARCH RESULTS/PRODUCTS-->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>PRICE</th>
                            <th>STOCK</th>
                            <th>CATAGORY</th>
                            <th>DESCRIPTION</th>
                            <th>PICTURES</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                    <!--PHP code to retrive the data from the database.-->                      
                    <?php
                        if(mysqli_num_rows($search_result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($search_result))
                            {
                    ?>
                        <tr>
                            <td><?php echo $row['PID'];?></td>
                            <td><?php echo $row['PName'];?></td>
                            <td><?php echo $row['PPrice'];?></td>
                            <td><?php echo $row['PStock'];?></td>
                            <td><?php echo $row['PCategory'];?></td>
                            <td style=" text-overflow: ellipsis;
                                        overflow: hidden;
                                        white-space: nowrap;
                                        max-height: 10px;
                                        max-width: 30px;
                                        line-clamp: 3;" title="<?php echo $row['P_Description'];?>">
                                <?php echo $row['P_Description'];?></td>
                            <td style=" text-overflow: ellipsis;
                                        overflow: hidden;
                                        white-space: nowrap;
                                        max-height: 10px;
                                        max-width: 30px;
                                        line-clamp: 3;" title="<?php echo $row['Pic1']." ".$row['Pic2']." ".$row['Pic3']." ".$row['Pic4']." ".$row['Pic5']." ";?>">
                                        <?php echo $row['Pic1']." ".$row['Pic2']." ".$row['Pic3']." ".$row['Pic4']." ".$row['Pic5']." ";?></td>
                            <td>
                            <form action="edit_product.php" method="post">
                                <input type="hidden" name="edit_id" value="<?php echo $row['PID'];?>">
                                <button type="submit" name="edit_button" class="edit_button">EDIT</a>
                            </form>
                            <form action="code.php" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $row['PID'];?>">
                                <button type="submit" name="delete_button" class="delete_button" onclick="checker()">DELETE</a>
                            </form>
                            <script>
                                function checker(){
                                    var result = confirm('Are you sure you want to delete this record?');
                                    if (result == false){
                                        event.preventDefault();
                                    }
                                }
                            </script>
                            </td>
                        </tr>
                    <?php
                            }
                        }
                        else{
                            echo "<p style='margin-left: 20px; color: grey;'>No Records Found.</p>";
                        }
                    function filterTable($query)
                    {
                        include('includes/db-con.php'); //Database Connection
                        $filter_result = mysqli_query($conn, $query);
                        return $filter_result;
                    }
                    ?>
                        </tbody>
                </table>
                <!--End of PHP code to retrive the data from the database.--> 

                <!--PHP code to retrive count/number of products from the database.--> 
                <div class="tinfo">Total Number of Products
                    <?php
                        $query = "SELECT PID FROM products ORDER BY PID";
                        $search_result = filterTable($query);
                        $rowi = mysqli_num_rows($search_result);
                        echo '<p>'.$rowi.' Products</p>';
                    ?>
                </div>
            </div>
        </main>
    </body>
    <!--END OF BODY--> 

    <!--PHP include statement for footer.--> 
    <?php include('includes/admin-footer.html');?>

</html>