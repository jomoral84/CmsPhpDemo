<?php session_start() ?>
<?php include "includes/admin_header.php"; ?>


<body>

  <div id="wrapper">

    <!-- Navigation -->
    <?php

    include "includes/admin_navigation.php";

    ?>


    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Welcome Admin <small><?php echo $_SESSION['user_username']; ?></small></h1>


          </div>
        </div>
        <!-- /.row -->


        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-file-text fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">

                    <?php


                    $query = "SELECT * FROM posts";
                    $select_all_posts = mysqli_query($connection, $query);
                    $posts_count = mysqli_num_rows($select_all_posts);

                    ?>

                    <div class='huge'><?php echo $posts_count = recordCount('posts'); ?></div>
                    <div>Posts</div>
                  </div>
                </div>
              </div>
              <a href="posts.php">
                <div class="panel-footer">
                  <span class="pull-left">Ver Detalles</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">


                    <?php

                    $query = "SELECT * FROM comments";
                    $select_all_comments = mysqli_query($connection, $query);
                    $comments_count = mysqli_num_rows($select_all_comments);

                    ?>

                    <div class='huge'><?php echo $comments_count = recordCount('comments'); ?></div>
                    <div>Comments</div>
                  </div>
                </div>
              </div>
              <a href="comments.php">
                <div class="panel-footer">
                  <span class="pull-left">Ver Detalles</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">

                    <?php

                    $query = "SELECT * FROM users";
                    $select_all_users = mysqli_query($connection, $query);
                    $users_count = mysqli_num_rows($select_all_users);

                    ?>


                    <div class='huge'><?php echo $users_count = recordCount('users'); ?></div>
                    <div> Users</div>
                  </div>
                </div>
              </div>
              <a href="users.php">
                <div class="panel-footer">
                  <span class="pull-left">Ver Detalles</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-list fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">


                    <?php

                    $query = "SELECT * FROM categories";
                    $select_all_categories = mysqli_query($connection, $query);
                    $categories_count = mysqli_num_rows($select_all_categories);

                    ?>


                    <div class='huge'><?php echo $categories_count = recordCount('categories'); ?></div>
                    <div>Categories</div>
                  </div>
                </div>
              </div>
              <a href="categories.php">
                <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>

          <?php

          $query = "SELECT * FROM posts WHERE post_status = 'published'";
          $select_all_active_posts = mysqli_query($connection, $query);
          $post_published_count = mysqli_num_rows($select_all_active_posts);


          $query = "SELECT * FROM posts WHERE post_status = 'draft'";
          $select_all_draft_posts = mysqli_query($connection, $query);
          $post_draft_count = mysqli_num_rows($select_all_draft_posts);


          $query = "SELECT * FROM comments WHERE comment_status = 'unapprove' ";
          $unapproved_comments_query = mysqli_query($connection, $query);
          $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);


          $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
          $select_all_subscribers = mysqli_query($connection, $query);
          $subscriber_count = mysqli_num_rows($select_all_subscribers);


          //     $post_published_count = checkStatus('posts','post_status','published'); 
          //     $post_draft_count = checkStatus('posts','post_status','draft');
          //     $unapproved_comment_count = checkStatus('comments','comment_status','unapproved'); 
          //      $approved_comment_count = checkStatus('comments','comment_status','approved');   

          ?>




          <div class="row">

            <script type="text/javascript">
              // Este script se bajo de la pagina de Google Charts para los graficos de barras  //

              google.load("visualization", "1.1", {
                packages: ["bar"]
              });
              google.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Data', 'Counts'],


                  <?php

                  $element_text   =   ['Posts', 'Comments', 'Users', 'Categories', 'Published Posts', 'Draft Posts', 'Unapproved Comments', 'Subscribers'];
                  $element_count  =   [$posts_count, $comments_count, $users_count, $categories_count, $post_published_count, $post_draft_count, $unapproved_comment_count, $subscriber_count];


                  for ($x = 0; $x < 8; $x++) {

                    echo "['{$element_text[$x]}'" . "," . "{$element_count[$x]}],";
                  }

                  ?>



                ]);

                var options = {
                  chart: {
                    title: '',
                    subtitle: '',
                  }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
              }
            </script>

          </div>


          <div id="columnchart_material" style="width: 1500px; height: 500px;"></div>





        </div>
        <!-- /.row -->






      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

  </div>
  <!-- /#wrapper -->







  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>