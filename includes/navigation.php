   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">


      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS HOME</a>

      </div>


      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">

          <?php 

          $query = "SELECT * FROM categories LIMIT 6";
          $select_all_categories_query = mysqli_query($connection,$query);

          while($row = mysqli_fetch_assoc($select_all_categories_query)) {
           $cat_title = $row['cat_title'];
           $cat_id = $row['cat_id'];

           

           echo "<li><a  href='/cmsDemo/category.php?category={$cat_id}'>{$cat_title}</a></li>";

         }

         ?>

         

         <?php 

     /*    if (isset($_SESSION['user_role'])) {

          if ($_SESSION['user_role'] == 'admin') {

           echo "<li><a  href='./admin/index.php'>Admin</a></li>;";

         }

       }  */

       if (isLoggedIn()):  ?>          <!-- Si esta Logeado ya sea user o admin que aparezcan los links -->  


       <li>
        <a href="/cmsDemo/admin/index.php">Admin</a>
      </li>

      <li>
        <a href="/cmsDemo/includes/logout.php">Logout</a>
      </li>


      <?php else: ?>


        <li>
          <a href="/cmsDemo/login.php">Login</a>
        </li>


      <?php endif; ?>

    

    ?>


    <!--   <li><a  href="./admin/index.php">Admin</a></li>;  -->


    <li><a  href="./registration.php">Registration</a></li>;

    <li><a  href="./contact.php">Contact</a></li>;

    <li><a  href="./login.php">Login</a></li>;



  </ul>



</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
