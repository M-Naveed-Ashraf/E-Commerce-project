<?php
    $con = mysqli_connect('localhost','root','','e-commerce');
    if ($con){
        echo "connection Successful";
    }
    else{
        echo "db not connected";
    }
    $name = $_POST{'user'};
    $pass = $_POST{'password'};
            // Check wheather the user already exists or not in database
    $query = " SELECT * FROM user_login where name = '$name' && password = '$pass' ";

    $run = mysqli_query($con,$query) or die("query not executed");
    $num = mysqli_num_rows($run);
    if($num == 1){
        echo "<script> alert('User already exists') </script>";
        echo "<script> window.location = 'login.php' </script>";
    }
    else{
        $insert = "INSERT into user_login(name , password) values ('$name' , '$pass')";
        mysqli_query($con,$insert);
    }
?>