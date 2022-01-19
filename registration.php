<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<?php 

if(isset($_POST['register'])) {

  $user_username   = trim($_POST['reg_username']);  // The trim() function removes whitespace and other predefined characters from both sides of a string.
  $user_password   = trim($_POST['reg_password']);
  $user_email      = trim($_POST['reg_email']);

  
  registerUser($user_username, $user_password, $user_email);




}

?>




<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Register</h1>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="" class="sr-only">Username</label>
                <input type="text" name="reg_username" id="username" class="form-control" placeholder="Enter Username" autocomplete="on">
              </div>

              <div class="form-group">
                <label for="" class="sr-only">Password</label>
                <input type="password" name="reg_password" id="key" class="form-control" placeholder="Enter Password">
              </div>

              <div class="form-group">
                <label for="" class="sr-only">Email</label>
                <input type="email" name="reg_email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on">
              </div>

              <input type="submit" name="register" id="btn-login" class="btn btn-lg btn-primary btn-block" value="Register">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php";?>
