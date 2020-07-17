
    <?PHP
        session_start();
        $quantity= $_SESSION['quantity'];
        $con = mysqli_connect('localhost','root','','e-commerce');
        if(isset($_POST['remove'])){
           if($_GET['action']=='remove'){
               foreach($_SESSION['cart'] as $keys => $values){
                   if($values["product_id"] == $_GET['product_id']){
                       unset($_SESSION['cart'][$keys]);
                       echo "<script>alert('Product has been Removed...!')</script>";
                       echo "<script>window.location = 'cart.php' </script>";
                   }
               }
           }
           if(isset($_POST['order'])){
               header('location:login.php');
           }
        }
        if(isset($_POST['dec'])){
            $quantity = $quantity - 1;
        }
        elseif(isset($_POST['Inc'])){
            $quantity = $quantity + 1;
        }
        else{
            $quantity = $_SESSION['quantity'];
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home-style.css">
    <script src="https://kit.fontawesome.com/97f7f89241.js"></script>
    <title>Cart</title>
</head>
<body class="bg-light">
          <!--Navigation Bar-->
          <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a href="home page.php" class="navbar-brand"><i class="fas fa-book-reader"></i> E-Books</a>
              <!-- data-target will target the div of nav items -->
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav nav-tabs ml-auto" >
        <li class="nav-items">
          <a href="login.php" class="nav-link mynav">
          Login/Signup
          <i class="fas fa-sign-in-alt"></i>
        </a>
        </li>
        <li class="nav-items">
          <a href="cart.php" class="nav-link mynav">
          <i class="fas fa-cart-plus"></i> Cart
          <?php 
            if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]);
              echo "<span id='cart_count' class='text-warning bg-light'>$count</span>";
            }
            else{
              echo "<span id='cart_count' class='text-warning bg-light'>0</span>";
            }
          ?>
        </a>
        </li>
      </ul>
    </div>
    </nav>
          <!-- Navigation end -->
    <h2 class="text-center py-5"><i class="fas fa-shopping-basket"></i>
    My cart</h2>
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <?php
                    $discount = 0;
                    $total = 0;
                    if(isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'],'product_id');
                        $query = "SELECT * FROM `products`";
                        $query_run = mysqli_query($con, $query) or die("query not executed");
                        while($row = mysqli_fetch_assoc($query_run)){
                            foreach ($product_id as $id){
                                if($row['id']==$id){
                                    ?>
                                    <form action="cart.php?action=remove&product_id=<?php echo $row['id']; ?>" method="POST" class="cart-items">
                                        <div class="border-rounded">
                                            <div class="row bg-white">
                                                <div class="col-md-3">
                                                    <img src="<?PHP echo "Images/".$row['image']; ?>" alt="" height="100px" class="image-fluid">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="pt-2"><?PHP echo $row['name']; ?></h5>
                                                    <h5 class="pt-2">Rs.<?PHP echo $row['price']; ?>
                                                    <span>(<?PHP echo $row['discount']; ?> off)</span>
                                                    </h5>
                                                    <!-- <input type="hidden" name="id" value=""> -->
                                                    <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                                                </div>
                                                <div class="col-md-3 py-5">
                                                    <button type="submit" name="dec" class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
                                                    <input type="text" name="quantity" value="<?php echo $quantity; ?>" class="form-control w-25 d-inline">
                                                    <button type="submit" name="Inc" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    $discount = $discount + ((int)$row['price'] * ((int)$row['discount'] / 100));
                                    $total = $total + (int)$row['price'];
                                }
                            }
                        }
                    }
                    else{
                        echo "<h5> Cart is Empty... </h5>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-sm-6">
                            <?php
                                if(isset($_SESSION['cart'])){
                                    $count = count($_SESSION['cart']);
                                    $items = $count + ($quantity-1);
                                    echo "<h6>Price($items items)</h6>";
                                }
                                else{
                                    echo "<h6>Price (0 items)</h6>";
                                }
                            ?>
                            <h6>Discount</h6>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-sm-6">
                            <h6>Rs.<?php echo $total;?></h6>
                            <h6>Rs.<?php echo $discount;?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>Rs.<?php echo $payable = $total - $discount;?></h6><br>
                            <a href="login.php" name="order" value="order" class="btn btn-success btn-lg">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>