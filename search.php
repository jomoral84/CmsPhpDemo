 <?php include "includes/db.php"; ?>
 <?php include "includes/header.php"; ?>


 <!-- Navigation -->

 <?php include "includes/navigation.php"; ?>


 <!-- Page Content -->
 <div class="container">

 	<div class="row">

 		<!-- Blog Entries Column -->

 		<div class="col-md-8">


 			<?php

				if (isset($_POST['submit'])) {

					$search = $_POST['search'];
					$query = "SELECT * FROM posts WHERE post_title LIKE '%$search%'";      // Busca en los titulos de cada post (post_title) la palabra buscada 
					$search_query = mysqli_query($connection, $query);

					if (!$search_query) {
						die("ERROR" . mysqli_error($connection));
					}

					$count = mysqli_num_rows($search_query);

					if ($count == 0) {

						echo "<h1> Sin resultados</h1>";
					} else {


						while ($row = mysqli_fetch_assoc($search_query)) {
							$post_id = $row['post_id'];
							$post_title = $row['post_title'];
							$post_author = $row['post_user'];
							$post_date = $row['post_date'];
							$post_image = $row['post_image'];
							$post_content = substr($row['post_content'], 0, 400);
							$post_status = $row['post_status'];
						}


				?>



 					<!-- First Blog Post -->



 					<h2>
 						<a href="post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
 					</h2>
 					<p class="lead">
 						por <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
 					</p>
 					<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
 					<hr>


 					<a href="post.php?p_id=<?php echo $post_id; ?>">
 						<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
 					</a>



 					<hr>
 					<p><?php echo $post_content ?></p>
 					<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

 					<hr>

 			<?php }
				}   ?>

 		</div>



 		<!-- Blog Sidebar Widgets Column -->


 		<?php include "includes/sidebar.php"; ?>


 	</div>
 	<!-- /.row -->


 	<?php include "includes/footer.php"; ?>