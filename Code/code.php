<!--CODE PAGE. DONE BY FATIMA M. ALNASSER, 2190003750, CS MAJGOR LEVEL 8 GROUP 1.-->
<!--This page is used as intermediate of the add, update, and delete processes.-->

<?php
        //Start session firs
        session_start();

        include('includes/db-con.php'); //Database Connection
        
        //Update Operation
         if(isset($_POST['update']))
        {
            $id = $_POST['product_ID'];
            $pname = $_POST['product_name'];
            $pprice = $_POST['product_price'];
            $pstock = $_POST['product_stock'];
            $pcate = $_POST['category'];
            $pdesc = $_POST['product_desc'];
            // $ppic2 = $_FILES['product_pic2'];
            // $ppic3 = $_FILES['product_pic3'];
            // $ppic4 = $_FILES['product_pic4'];
            // $ppic5 = $_FILES['product_pic5'];

            $files1=$_FILES['product_pic1']['tmp_name'];     
            $image1=addslashes(file_get_contents($_FILES['product_pic1']['tmp_name']));
            $image_name1= addslashes($_FILES['product_pic1']['name']);          
            move_uploaded_file($_FILES["product_pic1"]["tmp_name"],"img/" . $_FILES["product_pic1"]["name"]);          
            $location1=$_FILES["product_pic1"]["name"];  
            
            $files2=$_FILES['product_pic2']['tmp_name'];     
            $image2=addslashes(file_get_contents($_FILES['product_pic2']['tmp_name']));
            $image_name2= addslashes($_FILES['product_pic2']['name']);          
            move_uploaded_file($_FILES["product_pic2"]["tmp_name"],"img/" . $_FILES["product_pic2"]["name"]);          
            $location2=$_FILES["product_pic2"]["name"];  

            $files3=$_FILES['product_pic3']['tmp_name'];     
            $image3=addslashes(file_get_contents($_FILES['product_pic3']['tmp_name']));
            $image_name3= addslashes($_FILES['product_pic3']['name']);          
            move_uploaded_file($_FILES["product_pic3"]["tmp_name"],"img/" . $_FILES["product_pic3"]["name"]);          
            $location3=$_FILES["product_pic3"]["name"];  

            $files4=$_FILES['product_pic4']['tmp_name'];     
            $image4=addslashes(file_get_contents($_FILES['product_pic4']['tmp_name']));
            $image_name4= addslashes($_FILES['product_pic4']['name']);          
            move_uploaded_file($_FILES["product_pic4"]["tmp_name"],"img/" . $_FILES["product_pic4"]["name"]);          
            $location4=$_FILES["product_pic4"]["name"];  

            $files5=$_FILES['product_pic5']['tmp_name'];     
            $image5=addslashes(file_get_contents($_FILES['product_pic5']['tmp_name']));
            $image_name5= addslashes($_FILES['product_pic5']['name']);          
            move_uploaded_file($_FILES["product_pic5"]["tmp_name"],"img/" . $_FILES["product_pic5"]["name"]);          
            $location5=$_FILES["product_pic5"]["name"];  

            $query = "UPDATE products SET PName='$pname', PPrice='$pprice', PStock='$pstock', P_Description='$pdesc', PCategory='$pcate', Pic1='$location1', Pic2='$location2', Pic3='$location3', Pic4='$location4', Pic5='$location5' WHERE PID='$id' ";
            $query_run = mysqli_query($conn, $query);

                if($query_run)
                {
                    $_SESSION['success'] = "The Record Have been Updated Successfully.";
                    header('Location: admin.php');
                }
                else
                {
                    $_SESSION['status'] = "The Record Have NOT been Updated.";
                    header('Location: admin.php'); 
                }                   
        }
        

        //Delete Operation
        if(isset($_POST['delete_button']))
        {
            $id = $_POST['delete_id'];

            $query = "DELETE FROM products WHERE products.PID='$id'";
            $query_run = mysqli_query($conn, $query);
            
            if($query_run)
            {
                $_SESSION['success'] = "The Record Have been Deleted Successfully.";
                header('Location: admin.php');
            }
            else
            {
                $_SESSION['status'] = "The Record Have NOT been Deleted.";
                header('Location: admin.php'); 
            } 
        }

        //Add Operation
        if(isset($_POST['add_product']))
        {
            $pname = $_POST['product_name'];
            $pprice = $_POST['product_price'];
            $pstock = $_POST['product_stock'];
            $pdesc = $_POST['product_desc'];
            $pcate = $_POST['category'];
            $ppic1 = $_POST['product_pic1'];
            $ppic2 = $_POST['product_pic2'];
            $ppic3 = $_POST['product_pic3'];
            $ppic4 = $_POST['product_pic4'];
            $ppic5 = $_POST['product_pic5'];

            $query = "INSERT INTO products (PName, PPrice, PStock, PCategory, P_Description, Pic1, Pic2, Pic3, Pic4, Pic5) VALUES ('$pname', '$pprice', '$pstock', '$pcate', '$pdesc', '$ppic1', '$ppic2', '$ppic3', '$ppic4', '$ppic5')";
            $query_run = mysqli_query($conn, $query);
            if($query_run)
            {
                echo 'Saved';
                $_SESSION['success'] = "The Record Have been Added Successfully.";
                header('Location: admin.php');
            }
            else
            {
                echo 'Not Saved';
                $_SESSION['status'] = "The Record Have NOT been Added.";
                header('Location: admin.php'); 
            }                   
        }
    ?>
<!--END OF PHP CODE-->