<?php 

  ////   FUNCIONES DE AYUDA    //////// 



function redirect($location) {


  header("Location:" . $location);
  exit;

}


function query($query) {
 global $connection;
 $result = mysqli_query($connection, $query);
 confirmQuery($result);
 return $result;

}  


function confirmQuery($result) {

  global $connection;

  if(!$result) {

    die("QUERY FAILED ." . mysqli_error($connection));
    
  }
}



function fetchRecords($result) {

 return mysqli_fetch_array($result);

}


function countRecords($result) {

 return mysqli_num_rows($result);

}




function ifItIsMethod($method=null){

  if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

    return true;

  }

  return false;

}  


function isLoggedIn() {

  if(isset($_SESSION['user_role'])){

    return true;

  }

  return false;

}  



function loggedInUserId() {

  if (isLoggedIn()) {

   $result = query("SELECT * FROM users WHERE user_username='" . $_SESSION['user_username'] . "'");
   confirmQuery($result);
   $user = mysqli_fetch_array($result);
   return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;

 }
 
 return false;

}



function userLikedThisPost($post_id) {

  $result = query("SELECT * FROM likes WHERE user_id = " .loggedInUserId() . " AND post_id = {$post_id} ");
  confirmQuery($result);
  return mysqli_num_rows($result) >= 1 ? true : false;

}



function getPostLikes($post_id) {

 $result = query("SELECT * FROM likes WHERE post_id = $post_id");
 confirmQuery($result);
 echo mysqli_num_rows($result);

}



function getAllUserPosts() {

  return query("SELECT * FROM posts WHERE user_id =".loggedInUserId()."");

}


function getAllPostUserComments() {

  return query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id =".loggedInUserId()."");

}


function getAllUserCategories() {

  return query("SELECT * FROM categories WHERE user_id =".loggedInUserId()."");

}


function getAllUserPublishedPosts() {

  return query("SELECT * FROM posts WHERE user_id =".loggedInUserId()." AND post_status = 'published'");

}



function getAllUserDraftPosts() {

 return query("SELECT * FROM posts WHERE user_id =".loggedInUserId()." AND post_status = 'draft'");

}



function getAllUserApprovedPostsComments() {

  return query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id =".loggedInUserId()." AND comment_status = 'approved'"); 

}


function getAllUserUnapprovedPostsComments() {

  return query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id =".loggedInUserId()." AND comment_status = 'unapproved'"); 

}





function checkIfUserIsLoggedInAndRedirect($redirectLocation=null) {

  if(isLoggedIn()){

    redirect($redirectLocation);

  }

}  



function email_exists($email){

  global $connection;


  $query = "SELECT user_email FROM users WHERE user_email = '$email'";
  $result = mysqli_query($connection, $query);
  

  if(mysqli_num_rows($result) > 0) {

    return true;

  } else {

    return false;

  }
}


function insertCategories() {

                    //////////////// Agregar categorias   ////////////////////

	global $connection;            // Una variable global significa que siempre están accesibles, independientemente de su alcance, y se puede acceder a ellas desde cualquier función, clase o archivo sin tener que hacer nada especial.

	if (isset($_POST['submit'])) {

		$cat_title = $_POST['cat_title'];


		if ($cat_title == "" || empty($cat_title)) {

			echo "<h3> No puede estar vacio! </h3>";

		} else {



			$stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES (?) ");

      mysqli_stmt_bind_param($stmt, 's' , $cat_title);

      mysqli_stmt_execute($stmt);



      if (!$stmt) {

        die('QUERY FAILED ' . mysqli_error($connection));
      }

    }

  }

}



function findAllCategories() {

	global $connection;

               /////// Busca todas las categorias    ////////////////

	$query = "SELECT * FROM categories";
	$select_categories = mysqli_query($connection, $query);

	while($row = mysqli_fetch_assoc($select_categories)) {
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];


		echo "<tr>";
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>Eliminar</a></td>";
		echo "<td><a href='categories.php?edit={$cat_id}'>Editar</a></td>";
		echo "</tr>";

	}


}

  /// Function que evita que haya usuarios duplicados en el registro /////

function checkUsernameExist($user_username) {

 global $connection;
 $query = "SELECT user_username FROM users WHERE user_username = '$user_username'";
 $result = mysqli_query($connection, $query);

 if (!$result) {

  die('QUERY FAILED ' . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {

  return true;

} else {

  return false;
}

}


/// Function que detecta si ya existe el email ingresado  ///////

function checkEmailExist($user_email) {

 global $connection;

 $query = "SELECT user_email FROM users WHERE user_email = '$user_email'";
 $result = mysqli_query($connection, $query);

 if (!$result) {

  die('QUERY FAILED ' . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {

  return true;

} else {

  return false;
}

}




function registerUser($user_username, $user_email, $user_password) {

 global $connection;

 if (!empty($user_username) && (!empty($user_password) && (!empty($user_email)))) {  


  $user_username   = mysqli_real_escape_string($connection, $user_username);
  $user_password   = mysqli_real_escape_string($connection, $user_password);
  $user_email      = mysqli_real_escape_string($connection, $user_email);
    $user_password   = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 12));  // Encriptacion del password rapida y segura ///  


    if (checkUsernameExist($user_username) || checkEmailExist($user_email)) {

      echo $message = "<p class='bg-warning'> Usuario Existente!</p>";

    } else {

     $query = "INSERT INTO users (user_username, user_password, user_email, user_role) ";
     $query .= "VALUES('{$user_username}','{$user_password}','{$user_email}','subscriber') "; 

     $register_user_query = mysqli_query($connection, $query);  


     if (!$register_user_query) {

      die('QUERY FAILED ' . mysqli_error($connection));

    } 

    echo "<p class='bg-success'> Usuario Registrado!</p>";

  }

} else {

  echo "<p class='bg-warning'> Debe completar los datos! </p>";

}   

}


function deleteCategories() {

	global $connection;

	if (isset($_GET['delete'])) {

		$delete_id = $_GET['delete'];
		$query = "DELETE FROM categories WHERE cat_id = {$delete_id}";
		$delete_query = mysqli_query($connection, $query);
                    header("Location: categories.php");   // Metodo manual para refrescar la pagina. Sino hay que clickear dos veces para eliminar una categoria
                  }
                }


                function deletePost() {

                 global $connection;

                 $delete_post_id = escape($_GET['delete']);
                 $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
                 $delete_query = mysqli_query($connection, $query);

                 if (!$delete_query) {

                  die('QUERY FAILED ' . mysqli_error($connection));
                }

                header("Location: posts.php");   // Metodo manual para refrescar la pagina. Sino hay que clickear dos veces para eliminar un post

              }


              function deleteUser() {

               global $connection;

               $delete_user_id = escape($_GET['delete']);
               $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
               $delete_query = mysqli_query($connection, $query);

               if (!$delete_query) {

                die('QUERY FAILED ' . mysqli_error($connection));
              }

                header("Location: users.php");   // Metodo manual para refrescar la pagina. Sino hay que clickear dos veces para eliminar un post

              }





              function deleteComment() {

               global $connection;

               $delete_comment_id = $_GET['delete'];
               $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
               $delete_query = mysqli_query($connection, $query);
                header("Location: comments.php");   // Metodo manual para refrescar la pagina. Sino hay que clickear dos veces para eliminar un comentario

              }


              function unapproveComment() {

               global $connection;

               $unapprove_comment_id = $_GET['unapprove'];
               $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = {$unapprove_comment_id}";
               $unapprove_query = mysqli_query($connection, $query);
                header("Location: comments.php");   // Metodo manual para refrescar la pagina. Sino hay que clickear dos veces para eliminar un comentario

                if (!$unapprove_query) {
                	die("QUERY FAILED" . mysql_error($connection));

                }

              }


              function approveComment() {

               global $connection;

               $approve_comment_id = $_GET['approve'];
               $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = {$approve_comment_id}";
               $approve_query = mysqli_query($connection, $query);
                header("Location: comments.php");   // Metodo manual para refrescar la pagina. Sino hay que clickear dos veces para eliminar un comentario

                if (!$approve_query) {
                	die("<h1>QUERY FAILED</h1>" . mysql_error($connection));

                }
              }


            /// Esta funcion refactorea el contador de post, comentarios, users, etc //////

              function recordCount($table) {

                global $connection;

                $query = "SELECT * FROM " . $table;
                $select_all_posts = mysqli_query($connection, $query);

                $result = mysqli_num_rows($select_all_posts);

                if (!$result) {
                  die("<h1>QUERY FAILED</h1>" . mysql_error($connection));

                }

                return $result;
              }



              function escape($string){ 

               global $connection;

               return mysqli_real_escape_string($connection, trim($string));  /// Esta función se usa para crear una cadena SQL legal que se puede usar en una sentencia SQL. La cadena dada es codificada a una cadena SQL escapada, tomando en cuenta el conjunto de caracteres actual de la conexión. Se usa para evitar la inyeccion sql

             }



             function checkStatus($table, $column, $status) {

              global $connection;

              $query = "SELECT * FROM $table WHERE $column = 'status'";
              $result = mysqli_query($connection, $query);

              if (!$result) {
                die("<h1>QUERY FAILED</h1>" . mysql_error($connection));

              }

              return mysqli_num_rows($result); 

            }   


            /// ----- Funcion Autenticacion  ------- //

            function isAdmin($user_username) {

              global $connection;

              if (isLoggedIn()) {

                $result = query("SELECT user_role FROM users WHERE user_username = '$user_username'");

                $row = mysqli_fetch_array($result);

                if($row['user_role'] == 'admin'){

                  return true;

                } else {


                  return false;
                }

              }

            }



            function login_user($user_username, $user_password) {

             global $connection;

             $user_username = trim($user_username);
             $user_password = trim($user_password);

             $user_username = mysqli_real_escape_string($connection, $user_username);
             $user_password = mysqli_real_escape_string($connection, $user_password);


             $query = "SELECT * FROM users WHERE user_username = '{$user_username}' ";
             $select_user_query = mysqli_query($connection, $query);
             if (!$select_user_query) {

               die("QUERY FAILED" . mysqli_error($connection));

             }


             while ($row = mysqli_fetch_array($select_user_query)) {

               $db_user_id = $row['user_id'];
               $db_user_username = $row['user_username'];
               $db_user_password = $row['user_password'];
               $db_user_firstname = $row['user_firstname'];
               $db_user_lastname = $row['user_lastname'];
               $db_user_role = $row['user_role'];


               if (password_verify($user_password,$db_user_password)) {

                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['user_username'] = $db_user_username;
                $_SESSION['user_firstname'] = $db_user_firstname;
                $_SESSION['user_lastname'] = $db_user_lastname;
                $_SESSION['user_role'] = $db_user_role;



                redirect("/cmsDemo/admin");


              } else {


               return false;

             }

           }

           return true;

         }




        ///////////     Usuarios online: el contador suma cuando se abren varios navegadores  //////////////////////


         function users_online() {

          if (isset($_GET['onlineusers'])) {
            global $connection;
            if (!$connection) {
              session_start();

              require_once "../includes/db.php";

              $session = session_id();
              $time = time();
              $time_out_in_second = 30;
              $time_out = $time - $time_out_in_second;
              $query = "SELECT * FROM users_online WHERE session = '$session' ";
              $send_query = mysqli_query($connection, $query);
              $count = mysqli_num_rows($send_query);

              if ($count == null) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
              } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
              }

              $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
              echo $count_users_online = mysqli_num_rows($users_online_query);

            }

          } 
        }


        users_online();


        ?>