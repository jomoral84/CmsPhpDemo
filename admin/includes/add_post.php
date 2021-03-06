
<?php


if (isset($_POST['create_post'])) {

  $post_title         = escape($_POST['post_title']);
  $post_category_id   = $_POST['post_category'];
  $post_user          = $_POST['post_user'];
  $post_author        = $_POST['post_author'];
  $post_status        = $_POST['post_status'];
  $post_image         = $_FILES['image']['name'];
  $post_image_temp    = $_FILES['image']['tmp_name'];
  $post_tags          = $_POST['post_tags'];
  $post_content       = $_POST['post_content'];
  $post_date          = date('d-m-y');
  

 move_uploaded_file($post_image_temp, "../images/$post_image" );     // Mueve la imagen a un espacio temporal en el servidor antes de enviarse


 $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_author, post_date, post_image, post_content, post_tags, post_status) ";
 $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}', '{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 

 $create_post_query = mysqli_query($connection, $query);  

 if (!$create_post_query) {

  die('QUERY FAILED ' . mysqli_error($connection));

} else {

 echo "<p class='bg-success'> Post Creado: " . " " . "<a href='posts.php'>Mostrar Posts</a></p>";
}


}

?>


<form action="" method="post" enctype="multipart/form-data">    


  <div class="form-group">
   <label for="title">Post Title</label>
   <input type="text" class="form-control" name="post_title">
 </div>

 <div class="form-group">
   <label for="category">Category</label>
   <select name="post_category" id="">


 <?php   /// Elige de las categorias existentes //////


 $query = "SELECT * FROM categories";
 $select_categories = mysqli_query($connection,$query);

 if (!$select_categories) {

  die('QUERY FAILED ' . mysqli_error($connection));
}

while($row = mysqli_fetch_assoc($select_categories )) {
  $cat_id = $row['cat_id'];
  $cat_title = $row['cat_title'];

  echo "<option value='$cat_id'>{$cat_title}</option>";
}   


?>

</select>

</div>


<div class="form-group">
 <label for="users">User</label>
 <select name="post_user" id="">


  <?php   

  $users_query = "SELECT * FROM users";
  $select_users = mysqli_query($connection,$users_query);

  
  while($row = mysqli_fetch_assoc($select_users)) {
    $user_id = $row['user_id'];
    $user_username = $row['user_username'];


    echo "<option value='{$user_username}'>{$user_username}</option>";
  }    

  
  ?>

</select>

</div>

<div class="form-group">
 <label for="title">Post Author</label>
 <input type="text" class="form-control" name="post_author">
</div> 



<div class="form-group">
 <label for="title">Post Status</label>
 <select name="post_status" id="" value="">
   <option value="draft">Select Option</option>
   <option value="published">Published</option>
   <option value="draft">Draft</option>
 </select>
</div>



<div class="form-group">
 <label for="post_image">Post Image</label>
 <input type="file"  name="image">
</div>

<div class="form-group">
 <label for="post_tags">Post Tags</label>
 <input type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
 <label for="post_content">Post Content</label>
 <textarea class="form-control "name="post_content" id="body" cols="30" rows="20"></textarea>
</div>



<div class="form-group">
  <input class="btn btn-primary" type="submit" name="create_post" value="Publicar Post">
</div>


</form>
