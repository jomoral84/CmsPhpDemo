<?php


if (ifItIsMethod('post')) {


  if (isset($_POST['login'])) {


    if (isset($_POST['user_username']) && isset($_POST['user_password'])) {

      login_user($_POST['user_username'], $_POST['user_password']);
    } else {

      redirect('/cmsDemo/index.php');
    }
  }
}

?>



<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">





  <!-- Search -->
  <div class="well">
    <h4>Buscar</h4>
    <form action="search.php" method="post">
      <div class="input-group">
        <input name="search" type="text" class="form-control" placeholder="Ingrese Palabra">
        <span class="input-group-btn">
          <button class="btn btn-primary" name="submit" type="submit">Buscar</button>
        </span>

      </div>
    </form><!--search form-->
    <!-- /.input-group -->
  </div>



  <!--Login -->
  <div class="well">




    <?php

    //// Cuando se loguea aparece el boton de desloguear  /////   

    if (isset($_SESSION['user_role'])) :

    ?>

      <h4>Logeado como <?php echo $_SESSION['user_username'] ?></h4>

      <a href="includes/logout.php" class="btn btn-primary">Logout</a>

    <?php else : ?>

      <h4>Login</h4>

      <form method="post" action="includes/login.php">

        <div class="form-group">
          <input name="user_username" type="text" class="form-control" placeholder="Enter Username">
        </div>

        <div class="input-group">
          <input name="user_password" type="password" class="form-control" placeholder="Enter Password">
          <span class="input-group-btn">
            <button class="btn btn-primary" name="login" type="submit">Enviar</button>
          </span>
        </div>

        <div class="form-group">
          <a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Olvide mi Password</a>
        </div>

      </form><!--search form-->
      <!-- /.input-group -->



    <?php endif; ?>



  </div>






  <!-- Blog Categories Well -->
  <div class="well">

    <?php
    $query = "SELECT * FROM categories LIMIT 6";
    $select_categories_sidebar = mysqli_query($connection, $query);
    ?>


    <h4>Blog Categories</h4>
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled">

          <?php

          while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
          }

          ?>

        </ul>
      </div>

    </div>
    <!-- /.row -->
  </div>

  <!-- Side Widget Well -->
  <?php include "widget.php"; ?>

</div>