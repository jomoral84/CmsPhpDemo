
<?php


if (isset($_POST['create_user'])) {

  $user_username   = $_POST['user_username'];
  $user_password   = $_POST['user_password'];
  $user_firstname  = $_POST['user_firstname'];
  $user_lastname   = $_POST['user_lastname'];
  $user_email      = $_POST['user_email'];
  $user_image      = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];
  $user_role       = $_POST['user_role'];
  

  $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 10));  // Encriptacion del password rapida y segura /// 


 move_uploaded_file($user_image_temp, "../images/$user_image" );     // Mueve la imagen a un espacio temporal en el servidor antes de enviarse


 $query = "INSERT INTO users(user_username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
 $query .= "VALUES('{$user_username}','{$user_password}','{$user_firstname}', '{$user_lastname}','{$user_email}','{$user_image}','{$user_role}') "; 

 $create_user_query = mysqli_query($connection, $query);  


 if (!$create_user_query) {

  die('QUERY FAILED ' . mysqli_error($connection));

} else {

 echo "<p class='bg-success'> Usuario Creado: " . " " . "<a href='users.php'>Mostrar Usuarios</a></p>";

}


}

?>


<form action="" method="post" enctype="multipart/form-data">    


  <div class="form-group">
   <label for="title">Username</label>
   <input type="text" class="form-control" name="user_username">
 </div>

 <div class="form-group">
   <label for="category">Password</label>
   <input type="password" class="form-control" name="user_password">

 </div>


 <div class="form-group">
   <label for="users">Firstname</label>
   <input type="text" class="form-control" name="user_firstname">
 </div>


 <div class="form-group">
   <label for="users">Lastname</label>
   <input type="text" class="form-control" name="user_lastname">
 </div>



 <div class="form-group">
   <label for="title">Email</label>
   <input type="email" class="form-control" name="user_email">
 </div> 


 <div class="form-group">
  <label for="post_image">User Image</label>
  <input type="file"  name="user_image" >
</div>

<div class="form-group">
 <label for="post_tags">User Role</label>
 <select name="user_role" id="">
  <option value="subscriber">Select Options</option>
  <option value="admin">Admin</option>
  <option value="subscriber">Subscriber</option>
</select>
</div>


<div class="form-group">
  <input class="btn btn-primary" type="submit" name="create_user" value="Crear Usuario">
</div>


</form>
