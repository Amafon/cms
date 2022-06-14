<?php include "includes/admin_header.php";?>
<?php include "../includes/db.php";?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">  
                    <!-- Page Heading 1 -->
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                            <!-- Insert a new Catagory -->
                            <?php insert_categories(); ?>

                            <!-- ADD CATEGORY FORM -->
                            <form action="categories.php" method="POST">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title" id="">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Add Category" name="submit">
                                </div>
                            </form>

                            <!-- UPDATE CATEGORY FORM -->
                            <?php 
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];
                                    include "includes/update_categories.php";
                                } 
                            ;?>
                            
                        </div>

                        <div class="col-xs-6">
                            
                           <table class="table table-bordered table-hover">
                               <thead>
                                   <tr>
                                       <th>Id</th>
                                       <th>Category Title</th>
                                       <th colspan="2">Actions</th>
                                       <!-- <th>Delete</th> -->
                                   </tr>
                               </thead>
                               <tbody>
                                   <!-- FIND ALL CATEGORIES QUERY -->
                                    <?php findAllCategories() ;?>

                                    <!-- DELETE CATEGORY QUERY -->
                                    <?php deleteCategories(); ?>
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
<?php include "includes/admin_footer.php";?>
