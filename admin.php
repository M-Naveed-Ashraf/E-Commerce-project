<?PHP
          $con = mysqli_connect('localhost','root','','e-commerce');
          $query = "SELECT name FROM admin where id='8597'";
          $query_run = mysqli_query($con, $query) or die("query not executed");
          $admin = mysqli_fetch_array($query_run);
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
    <title>Admin</title>
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
        <li class="nav-items"></li>
        <li class="nav-items"></li>
        <li class="nav-items"></li>
        <li class="nave-items"><a href="" class="nav-link mynav"><?php echo $admin["name"]; ?></a></li>
      </ul>
    </div>
    </nav>
          <!-- Navigation end -->
<div class="segment-one" style = "text-align:center"><h3>Welcome <?php echo $admin["name"]; ?></h3></div>
<div class="container">
  <h6>you can insert, update or products in database. just click on bellow relative button</h6> <br>
          <!-- Data Trigger -->
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-12">
    <button type="button" class="btn btn-success btn-lg d-block" data-toggle="modal" data-target="#Insert-Modal">Insert the Product</button>
    <br><p class="d-block">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo deserunt maiores, omnis autem aliquid placeat aperiam quae distinctio amet eligendi! Iure iste error tempore laboriosam libero, delectus molestias eligendi accusamus!</p>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12">
    <button type="button" class="btn btn-warning btn-lg d-block" data-toggle="modal" data-target="#Update-Modal">Update the Product</button>
    <br><p class="d-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, sunt? Beatae sequi asperiores aliquam odit optio deleniti nobis animi corporis quae! Fugit temporibus quasi odio, vitae repellendus veritatis optio labore.</p>
  </div>
  <div class="col-lg-4 col-md-6 col-sm12">
    <button type="button" class="btn btn-danger btn-lg d-block" data-toggle="modal" data-target="#Delete-Modal">Delete the Product</button>
    <br><p class="d-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum aspernatur, repudiandae dolorem asperiores voluptatem deleniti sequi fugiat? Obcaecati nesciunt reprehenderit facere, sed aspernatur voluptates sequi, voluptas, sint nihil saepe natus.</p>
  </div>
</div>
          <!-- Insert Modal Start -->
<div class="modal fade" id="Insert-Modal" tabindex="-1" role="dialog" aia-label="InsertModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InsertModalLabel">Insert the Prduct</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <!-- Form Start -->
      <form action="addToDB.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="InputProductName">Book Name</label>
            <input type="text" name="InputName" class="form-control" id="InputProductName" placeholder="Book Name">
          </div>
          <div class="form-group">
            <label for="InputProductPrice">Price details</label>
            <input type="text" name="InputPrice" class="form-control" id="InputProductPrice" placeholder="Price e.g 200">
          </div>
          <div class="form-group">
            <label for="InputProductDiscount">Discount %</label>
            <input type="text" name="InputDiscount" class="form-control" id="InputProductDiscount" placeholder="e.g 50%">
          </div>
          <div class="form-group">
            <label for="InsertProductImage">Product Image</label>
            <input type="file" name="InputImage" id="InsertProductImage">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="InsertProduct" class="btn btn-primary">Submit</button>
      </div>
      </form>
              <!-- Form end -->
    </div>
  </div>
</div>
              <!-- Insert Modal end -->
<script src="js/jquery-3.4.1.js"></script>
<script src="js/bootstrap.min.js"></script>
        <!-- Modal fcus -->
    <script>
      $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })
    </script>
</body>
</html>