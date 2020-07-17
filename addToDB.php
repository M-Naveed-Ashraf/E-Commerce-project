<?php
     $con = mysqli_connect('localhost','root','','e-commerce');
            // Check the connection through bellow comment section
    //  if($con){
    //      echo "connection established";
    //  }
    //  else{
    //      echo "connection is not established";
    //  }

        // get the values from admin.php page
    if(isset($_POST["InsertProduct"])){
        $ProductName = $_POST["InputName"];
        $ProductPrice = $_POST["InputPrice"];
        $ProductDiscount = $_POST["InputDiscount"];
                // file name with a random number so that similar dont get replaced
        $ProductImage = rand(1000,10000)."-".$_FILES["InputImage"]["name"];
                // it breaks a string into an array
        $nameparts = explode(".",$ProductImage);
                // extension name
        $extension = end($nameparts);
                // Temporary file name to store file
        $tname = $_FILES["InputImage"]["tmp_name"];
                // Upload directtory path
        $upload_dir = 'Images/';
                // to move the uploaded file to the specific location
        move_uploaded_file($tname, $upload_dir.'/'.$ProductImage);

        $query = "INSERT INTO products (name,image,price,discount) VALUES ('$ProductName','$ProductImage','$ProductPrice','$ProductDiscount')";
        $query_run = mysqli_query($con,$query) or die("query not executed");

        if($query_run){
            echo '<script> alert("Product has been added succesfully in the Database")</script>';
            echo "<script> window.location = 'admin.php' </script>";
        }
        else{
            echo '<script> alert("Product cannot be added. try again") </script>';
            echo "<script> window.location = 'admin.php' </script>";
        }
    }
?>