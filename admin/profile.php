<?php  include "includes/admin_header.php"; ?>

<?php session_start(); ?>


<div id="wrapper">

	<!-- Navigation -->

	<?php include "includes/admin_navigation.php" ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">

					<h1 class="page-header">
						Welcome to admin
						<small>Author</small>
					</h1>


					<?php  if (isset($_SESSION['user_username'])) {


						$user_username = $_SESSION['user_username'];

						$query = "SELECT * FROM users WHERE user_username = '$user_username'";

						$select_user_profile = mysqli_query($connection, $query);

						while($row = mysqli_fetch_assoc($select_user_profile)) {
							$user_id = $row['user_id'];
							$user_username = $row['user_username'];
							$user_password = $row['user_password'];
							$user_firstname = $row['user_firstname'];
							$user_lastname = $row['user_lastname'];
							$user_email = $row['user_email'];
							$user_image = $row['user_image'];
							$user_role = $row['user_role'];

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



							$query = "UPDATE users SET ";
							$query .= "user_username = '{$user_username}', ";
							$query .= "user_password = '{$user_password}', ";
							$query .= "user_firstname = '{$user_firstname}', ";
							$query .= "user_lastname = '{$user_lastname}', ";
							$query .= "user_email = '{$user_email}', ";
							$query .= "user_image = '{$user_image}', ";
							$query .= "user_role = '{$user_role}' ";
							$query .= "WHERE user_username = '{$user_username}'";


						}

						$update_user = mysqli_query($connection, $query);  

						if (!$update_user) {

							die('QUERY FAILED ' . mysqli_error($connection));
						} 


					} ?>


				</div>
			</div>
			<!-- /.row -->

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
					<label for="user_role">User Role</label>
					<input type="text" class="form-control" name="user_role" value="<?php echo $user_role; ?>">
				</div>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="update_user" value="Editar Profile">
				</div>


			</form>



		</div>
		<!-- /.container-fluid -->

	</div>


	<!-- /#page-wrapper -->

	<?php include "includes/admin_footer.php" ?>