<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<?php 



if(isset($_POST['submit'])) {

  ini_set("SMTP","smtp.gmail.com");
  ini_set("sendmail_from","jomoral2013@gmail.com>");


 $to = "jomoral2013@gmail.com";
 $subject = wordwrap($_POST['subject']);
 $body = $_POST['body'];
 $header =  "From: " . $_POST['email'];
 

 $send = mail($to, $subject, $body, $header);




 if($send == true) {

  echo "<p class='bg-success'> Mensaje Enviado! </p>";

} else {

  echo "<p class='bg-warning'> Error en el envio! </p>";
}  

}  

?>




<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Contact</h1>
            <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
              </div>

              <div class="form-group">
                <label for="" class="sr-only">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
              </div>

              <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="70" rows="10"></textarea>
              </div>

              <input type="submit" name="submit" id="btn-login" class="btn btn-lg btn-primary btn-block" value="Enviar">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php";?>
