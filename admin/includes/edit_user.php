<?php




if (isset($_GET['p_id'])) {

  $the_user_id = $_GET['p_id'];

}


$query = "SELECT * FROM users WHERE user_id = $the_user_id";
$select_users_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users_by_id)) {
  $user_id          = $row['user_id'];
  $user_username    = $row['user_username'];
  $user_password    = $row['user_password'];
  $user_firstname   = $row['user_firstname'];
  $user_lastname    = $row['user_lastname'];
  $user_email       = $row['user_email'];
  $user_image       = $row['user_image'];
  $user_role        = $row['user_role'];


}


if (isset($_POST['update_user'])) {


 $user_username   = $_POST['user_username'];
 $user_password   = $_POST['user_password'];
 $user_firstname  = $_POST['user_firstname'];
 $user_lastname   = $_POST['user_lastname'];
 $user_email      = $_POST['user_email'];
 $user_image      = $_FILES['user_image']['name'];
 $user_image_temp = $_FILES['user_image']['tmp_name'];
 $user_role       = $_POST['user_role'];



 move_uploaded_file($user_image_temp, "../images/$user_image" );  


    if(empty($user_image)) {     /// En caso que no halla imagen que modificar //////

      $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
      $select_image = mysqli_query($connection,$query);

      while($row = mysqli_fetch_array($select_image)) {

       $user_image = $row['user_image'];

     }


   }


   if(!empty($user_password)) {

    $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
    $get_user_query = mysqli_query($connection, $query_password);

    if (!$get_user_query) {

      die('QUERY FAILED ' . mysqli_error($connection));

    } 


    $row = mysqli_fetch_array($get_user_query);
    $db_user_password = $row['user_password'];


    if ($db_user_password != $user_password) {
      $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12 ));   // Encriptacion del password

    }
  }



  $query = "UPDATE users SET ";
  $query .= "user_username = '{$user_username}', ";
  $query .= "user_password = '{$hashed_password}', ";
  $query .= "user_firstname = '{$user_firstname}', ";
  $query .= "user_lastname = '{$user_lastname}', ";
  $query .= "user_email = '{$user_email}', ";
  $query .= "user_image = '{$user_image}', ";
  $query .= "user_role = '{$user_role}' ";
  $query .= "WHERE user_id = {$the_user_id}";


  $update_user = mysqli_query($connection, $query);  

  if (!$update_user) {

    die('QUERY FAILED ' . mysqli_error($connection));

  } else {

    echo "<p class='bg-success'> User Editado: " . " " . "<a href='users.php'>Mostrar Users</a></p>";
  } 

}






?>


<form action="" method="post" enctype="multipart/form-data">    


  <div class="form-group">
   <label for="user_username">Username</label>
   <input type="text" class="form-control" name="user_username" value="<?php echo $user_username; ?>">
 </div>

 <div class="form-group">
   <label for="user_password">Password</label>
   <input type="password" class="form-control" name="user_password" autocomplete="off">

 </div>


 <div class="form-group">
   <label for="user_firstname">Firstname</label>
   <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
 </div>


 <div class="form-group">
   <label for="user_lastname">Lastname</label>
   <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
 </div>



 <div class="form-group">
   <label for="user_email">Email</label>
   <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
 </div> 


 <div class="form-group">
  <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
  <input  type="file" name="user_image">
</div>


<div class="form-group">
 <label for="post_tags" value="<?php echo $user_role; ?>">User Role</label>
 <select name="user_role" id="">
  <option value="<?php echo  $user_role; ?>"><?php echo  $user_role; ?></option>
  <option value="admin">Admin</option>
  <option value="subscriber">Subscriber</option>
</select>
</div>



<div class="form-group">
  <input class="btn btn-primary" type="submit" name="update_user" value="Editar Usuario">
</div>


</form>
