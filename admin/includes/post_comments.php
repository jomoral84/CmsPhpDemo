	<table class ="table table-bordered">
		
		<tr>
			<th>Id</th>
			<th>Post Id</th>
			<th>Author</th>
			<th>Email</th>
			<th>Content</th>
			<th>Status</th>
			<th>En respuesta de</th>
			<th>Date</th>
			<th>Aprobado</th>
			<th>Desaprobado</th>
			<th>Delete</th>
		</tr>
		

		<tbody>

			<?php 



			$query = "SELECT * FROM comments";
			$select_comments = mysqli_query($connection, $query);

			while($row = mysqli_fetch_assoc($select_comments)) {
				$comment_id = $row['comment_id'];
				$comment_post_id = $row['comment_post_id'];
				$comment_author = $row['comment_author'];
				$comment_email = $row['comment_email'];
				$comment_content = $row['comment_content'];
				$comment_status = $row['comment_status'];
				$comment_date = $row['comment_date'];



				
				echo "<td>$comment_id</td>";
				echo "<td>$comment_post_id</td>";
				echo "<td>$comment_author</td>";

     /*

				$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
				$select_categories_id = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($select_categories_id)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];



					echo "<td>$cat_title</td>";

				}       */


				echo "<td>$comment_email</td>";
				echo "<td>$comment_content</td>";
				echo "<td>$comment_status</td>";

				$query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
				$select_post_id_query = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_assoc($select_post_id_query)) {

					$post_id = $row['post_id'];
					$post_title = $row['post_title'];

					echo "<td>$post_title</td>";


				}   


				echo "<td>$comment_date</td>";
				echo "<td><a href='comments.php?approve=$comment_id'>Aprobar</a></td>";
				echo "<td><a href='comments.php?unapprove=$comment_id'>Desaprobar</a></td>";
				echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
				echo "</tr>";

			}

			?>


		</tbody>
	</table>



	<?php 

	if (isset($_GET['delete'])) {

		deleteComment();
	}

	if (isset($_GET['approve'])) {

		approveComment();
	}

	if (isset($_GET['unapprove'])) {

		unapproveComment();
	}

	
	?>