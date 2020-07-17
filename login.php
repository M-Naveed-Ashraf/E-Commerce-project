
<?php
    session_start();

          // Admin Login
    $con = mysqli_connect('localhost','root','','e-commerce');

    if(isset($_POST['AdminLogin'])){
      $user = $_POST['user'];
      $password = $_POST['password'];

      $query = "SELECT * FROM admin WHERE name='$user' && password='$password'";
      $query_run = mysqli_query($con,$query) or die('query ot executed');
      
      $result = mysqli_fetch_array($query_run);

      if($result['name'] == $user && $result['password'] == $password){
        header('location:admin.php');
      }
      else{
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
      }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/97f7f89241.js"></script>
    <title>login/signup | E-Books</title>
    <link rel="icon" href="Images/title-icon.png" type="image/icon">
</head>
<body>
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
      <ul class="navbar-nav nav-tabs ml-auto">
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
          <!-- Login Start -->
    <div class="container login-container">
        <div class="row">
            <div class="col-lg-6 login-form-1">
                <h3>Admin Login</h3>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label>Username:</label> <input type="text" name="user" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password:</label><input type="password" name="password" class="form-control" placeholder="Your Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="AdminLogin" class="btnSubmit" value="Login">
                    </div>
                    <div class="form-group">
                        <a href="#" class="ForgetPwd">Forget Password?</a>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 login-form-2">
                <h3>User Login</h3>
                <form action="login.php" method="POST">
                    <div class="form-group">
                       <label>Username:</label> <input type="text" name="user" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password:</label> <input type="password" name="password" class="form-control" placeholder="Your Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login">
                    </div>
                    <div class="form-group">
                        <a href="#" class="ForgetPwd">Forget Password?</a>
                    </div>
                </form>
                <h6 style="text-align: center; color:#fff">Don't Have an account?</h6>
                        <!-- Button trigger modal -->
                    <button type="button" class="btnSubmit" data-toggle="modal" data-target="#ModalCenter">
                        Sign Up
                    </button>

                        <!-- Modal -->
                <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLongTitle">Sign Up</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="register.php" method="post">
                                    <div class="form-group">
                                        <label>Username:</label> <input type="text" name="user" class="form-control" placeholder="Username" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Email:</label> <input type="email" name="email" class="form-control" placeholder="abc@gmail.com">
                                    </div> -->
                                    <div class="form-group">
                                        <label>Password:</label><input type="password" name="password" class="form-control" placeholder="Your Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Register">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
          <!-- Login end -->
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