<?php  include "includes/admin_header.php"; ?>



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
                        <h1 class="page-header">
                            Welcome Admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">

                         <?php 

                         insertCategories();

                         ?>

                         



                         <form action="" method="post">

                             <div class="form-group">

                                 <input class="form-control" type="text" name="cat_title">
                             </div>

                             <div class="form-group">

                              <input class="btn btn-primary" type="submit" name="submit" value="Add Category">

                          </div>

                      </form>


                      <?php 
                      
                      if (isset($_GET['edit'])) {
                        
                        $cat_id = escape($_GET['edit']);

                        include "includes/update_categories.php";
                        
                    }


                    ?>


                </div>

                <div class="col-xs-6">


                   <table class="table table-bordered">
                     <thead>
                         <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                       <?php  findAllCategories(); ?>
                       

                       <?php   deleteCategories(); ?>


                   </tbody>
               </table>


           </div>


       </div>
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
