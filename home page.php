
<?php
  // Session start for cart products
  session_start();

  if(isset($_POST["add_to_cart"])){ 
    $_SESSION["quantity"] = $_POST["quantity"]; // this will pass the quantity
    // below line check whether the id fecthes or not
    // print_r($_POST['product_id']);
    // cart variable will contain the specific product which will click as add to cart
    // The array_column() function returns the values from a single column of the input array and identified by the column_key.
    if(isset($_SESSION["cart"])){
    // print_r($_SESSION["cart"]);
      $product_array_id = array_column($_SESSION["cart"],"product_id");
      // this if condition checks whether product is already added or not
      if(in_array($_POST['product_id'],$product_array_id)){
        echo "<script>alert('Product is already added in the cart')</script>";
        echo "<script>window.location = 'home page.php'</script>";
      }
      else{
        $count = count($_SESSION["cart"]);
        $products_array = array(
          'product_id' => $_POST["product_id"]
        );
        $_SESSION["cart"][$count] = $products_array;
      }
    }
    else{

      $products_array = array(
        'product_id' => $_POST["product_id"]
      );
        // New session variable will be created
        $_SESSION["cart"][0] = $products_array;
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/materialize.min.css"> -->
    <link rel="stylesheet" href="css/home-style.css">
    <script src="https://kit.fontawesome.com/97f7f89241.js"></script>
    <title>E-Books</title>
    <link rel="icon" href="Images/title-icon.png" type="image/icon">
</head>
<body class="container-fluid">
        <!--Header-->
      <!--Navigation Bar-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a href="home page.php" class="navbar-brand"><i class="fas fa-book-reader"></i> E-Books</a>
              <!-- data-target will target the div of nav items-->
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav nav-tabs ml-auto" >
        <li class="nav-items"><a href="#" class="nav-link mynav">Authors</a></li>
        <li class="nav-items"><a href="#" class="nav-link mynav">Category</a></li>
        <li class="nav-items"><a href="#" class="nav-link mynav">Subjects</a></li>
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
        <div class="searchbar">
          <input type="search" placeholder="Search">
          <div class="icon"><i class="fas fa-search"></i></div>
        </div>
    </div>
    </nav>
          <!-- Navigation end -->
          <!-- Slider start -->
    <div id="slideshow" class="carousel slide carousel-fade" data-ride="carousel">
      <ol class="carousel-indicators">
        <li class="active" data-target="#slideshow" data-slide-to="0"></li>
        <li data-target="#slideshow" data-slide-to="1"></li>
        <li data-target="#slideshow" data-slide-to="2"></li>
        <li data-target="#slideshow" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Images/e-book1.jpg" class="d-block w-100">
          <div class="carousel-caption">
            <h4>Let's Explore E-Books</h4>
          </div>
        </div>
        <div class="carousel-item">
          <img src="Images/e-book2.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="Images/e-book3.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="Images/e-book4.jpg" class="d-block w-100">
        </div>
      </div>
      <a href="#slideshow" class="carousel-control-prev" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a href="#slideshow" class="carousel-control-next" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
            <!-- Slider end -->
            <!-- Products -->
      <h1 style="text-align:center; color:#c65039">Most Poppular</h1>
      <div class="row">
        <?PHP
          $con = mysqli_connect('localhost','root','','e-commerce');
          $query = "SELECT * FROM `products`";
          $query_run = mysqli_query($con, $query) or die("query not executed");
          $num = mysqli_num_rows($query_run);
          if($num > 0){
            while($product = mysqli_fetch_array($query_run)){
        ?>
                <!-- Getting the products in cards -->
        <div class="col-lg-3 col-md-6 col-sm-12">
              <form action="home page.php" method="POST">
                <div class="card">
                    <h6 class="card-title bg-dark text-white p-2 text-uppercase text-center"> <?PHP echo $product['name']; ?></h6>
                    <div class="card-body">
                      <img src="<?PHP echo $product['image']; ?>" alt="Book Image" height="120px" class="img-fluid mb-2">
                      <h6>Rs: <?PHP echo $product['price']; ?>
                      <span>(<?PHP echo $product['discount']; ?>% off)</span></h6>
                      <h6 class="badge badge-success">4.4 <i class="fas fa-star"></i></h6>
                      <input type="number" name="quantity" class="form-control" value="1" min="1" max="10" placeholder="Quantity">
                    </div>
                    <div class="btn-group d-flex">
                      <button type="submit" name="add_to_cart" class="btn btn-success flex-fill">Add to Cart</button>
                      <!-- <button type="submit" name="buy" class="btn btn-warning flex-fill text-white">Buy Now</button> -->
                      <!-- For session we will create a hidden input feild with id of the product -->
                      <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                      <!-- <input type="hidden" name="hidden_name" value="<?PHP echo $product['name']; ?>"> -->
                    </div>
                </div>
              </form>
        </div>
        <?PHP
            }
          }
        ?>
      </div>
            <!-- Footer -->
    <footer>
      <div class="footer-top">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12 segment-one md-mb-30 sm-mb-30">
            <h3>About US</h3>
            <p>This era forced us to bring E-Books to our Education System. We'll help you to do this through our collection. We give you the E-books on each subject you want to read with fair price.</p>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12 segment-two md-mb-30 sm-mb-30">
            <h3 class="h3">Important Links</h3>
            <ul>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">Events</a></li>
              <li><a href="#">Categories</a></li>
            </ul>
          </div>
          <div class="col-md-3 colsm-6 colxs-12 segment-three sm-mb-30">
            <h3 class="h3">Follow Us</h3>
            <p>Please follow us on our social media profiles in order to keep updated.</p>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
          </div>
          <div class="col-md-3 colsm-6 colxs-12 segment-four sm-mb-30">
            <h3 class="h3">Our Newsletter</h3>
            <form action="">
              <input type="email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
      <p class="footer-bottom-text">All Right reserved by &copy;E-Book,2020</p>
    </footer>
            <!-- Footer end -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
             <!-- Expanding Searchbar through jquery -->
          <script>
            $(document).ready(function(){
              $(".fa-search").click(function(){
                $(".icon").toggleClass("active");
                $("input[type='search']").toggleClass("active");
              });
            });
          </script>
</body>
</html>