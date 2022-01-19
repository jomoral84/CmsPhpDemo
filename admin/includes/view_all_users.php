<?php    include("includes/delete_modal.php"); ?>	

<table class ="table table-bordered">

	<tr>
		<th>User Id</th>
		<th>Username</th>
		<th>Password</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Email</th>
		<th>Image</th>
		<th>Role</th>
		<th>Edit</th>
		<th>Delete</th>



	</tr>


	<tbody>

		<?php 



		$query = "SELECT * FROM users";
		$select_comments = mysqli_query($connection, $query);

		while($row = mysqli_fetch_assoc($select_comments)) {
			$user_id = $row['user_id'];
			$user_username = $row['user_username'];
			$user_password = $row['user_password'];
			$user_firstname = $row['user_firstname'];
			$user_lastname = $row['user_lastname'];
			$user_email = $row['user_email'];
			$user_image = $row['user_image'];
			$user_role = $row['user_role'];





			echo "<td>$user_id</td>";
			echo "<td>$user_username</td>";
			echo "<td>$user_password</td>";

     /*

				$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
				$select_categories_id = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($select_categories_id)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];



					echo "<td>$cat_title</td>";

				}       */


				echo "<td>$user_firstname</td>";
				echo "<td>$user_lastname</td>";
				echo "<td>$user_email</td>";
				echo "<td><img width='100' src='../images/$user_image'></td>";
				echo "<td>$user_role</td>";

				echo "<td><a href='users.php?source=edit_user&p_id={$user_id}'>Edit</a></td>";
		//		echo "<td><a onClick=\"javascript: return confirm('Desea Eliminar?'); \" href='users.php?delete=$user_id'>Delete</a></td>";
				echo "<td><a href='javascript:void(0)' rel='$user_id' class='delete_link'>Delete</a></td>";
				echo "</tr>";

			}

			?>


		</tbody>
	</table>


	<script>

     /// Script del modal para eliminar un post

     $(document).ready(function(){

     	$(".delete_link").on('click', function(){

     		var id = $(this).attr("rel");

     		var delete_url = "users.php?delete=" + id + " ";

     		$(".modal_delete_link").attr("href", delete_url);

     		$("#myModal").modal('show');


     	});
     });

 </script> 



 <?php 

 if (isset($_GET['delete'])) {

//		if (isset($_SESSION['user_role'])) {           /// Evita que se borre un usuario desde la barra de direccion del navegador

	//		if ($_SESSION['user_role'] == 'admin') {

				deleteUser();
			}
//		}
//	}

	
	
	?>