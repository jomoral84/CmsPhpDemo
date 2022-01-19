
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>



<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>



<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->

		<div class="col-md-8">

			<?php

			if (isset($_GET['category'])) {

				$post_category_id = $_GET['category'];



				if (isset($_SESSION['user_username']) && isAdmin($_SESSION['user_username'])) {

					// Prepared Statements: A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
					// Mejora la seguridad de la pagina

					$stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");


				} else {



					$stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ?");

					$published = 'published';

				}


				if (isset($stmt1)) {

					mysqli_stmt_bind_param($stmt1, "i" , $post_category_id);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

					$stmt = $stmt1;

				} else {

					mysqli_stmt_bind_param($stmt2, "is" , $post_category_id, $published);
					mysqli_stmt_execute($stmt2);
					mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

					$stmt = $stmt2;

				}



	//			$select_all_posts_query = mysqli_query($connection,$query);

	//			if (mysqli_stmt_num_rows($stmt) ===  0) {

		//			echo "<h2 class='text-center'>No hay posts</h2>";

	//			} 




				while(mysqli_stmt_fetch($stmt)) {
					


					?>



					<!-- First Blog Post -->



					<h2>
						<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
					</h2>
					<p class="lead">
						por <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
					</p>
					<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
					<hr>


					<a href="post.php?p_id=<?php echo $post_id; ?>">
						<img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
					</a>



					<hr>
					<p><?php echo $post_content ?></p>
					<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

					<hr>


				<?php  }  } else {

					header("Locations: index.php");

				}   ?>



			</div>



			<!-- Blog Sidebar Widgets Column -->


			<?php include "includes/sidebar.php";?>


		</div>
		<!-- /.row -->

		<hr>


		<ul class="pager">

			<?php 

			$count = 0;

			$number_list = array();


			for($i =1; $i <= $count; $i++) {


				if($i == $page) {

					echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";


				}  else {

					echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";

				}
			}


			?>


		</ul>

		<?php include "includes/footer.php";?>
