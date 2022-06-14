<?php include "includes/admin_header.php";?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                    <!-- Page Heading 1 -->
                        <h1 class="page-header">Welcome to Admin<small> <?php if(isset($_SESSION['firstname'])) echo $_SESSION['firstname'] ;?> </small></h1>
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
                                                    $select_all_post = mysqli_query($connection, $query);
                                                    if(!$select_all_post) die("Query Failed" . mysqli_error($connection));
                                                    $posts_count = mysqli_num_rows($select_all_post);
                                                    echo "<div class='huge'>{$posts_count}</div>";
                                                ?>
                                                <div>Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
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
                                                    if(!$select_all_comments) die("Query Failed" . mysqli_error($connection));
                                                    $comments_count = mysqli_num_rows($select_all_comments);
                                                    echo "<div class='huge'>{$comments_count}</div>";
                                            ?>
                                            <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
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
                                                    if(!$select_all_users) die("Query Failed" . mysqli_error($connection));
                                                    $users_count = mysqli_num_rows($select_all_users);
                                                    echo "<div class='huge'>{$users_count}</div>";
                                                ?>
                                                <div> Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
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
                                                    if(!$select_all_categories) die("Query Failed" . mysqli_error($connection));
                                                    $categories_count = mysqli_num_rows($select_all_categories);
                                                    echo "<div class='huge'>{$categories_count}</div>";
                                                ?>
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
                        </div>

                        <?php
                            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                            $select_all_draft_post = mysqli_query($connection, $query);
                            if(!$select_all_draft_post) die("Query Failed" . mysqli_error($connection));
                            $posts_draft_count = mysqli_num_rows($select_all_draft_post);
                           
                            $query = "SELECT * FROM posts WHERE post_status = 'published'";
                            $select_all_published_post = mysqli_query($connection, $query);
                            if(!$select_all_published_post) die("Query Failed" . mysqli_error($connection));
                            $posts_published_count = mysqli_num_rows($select_all_published_post);

                            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                            $select_unapproved_comments = mysqli_query($connection, $query);
                            if(!$select_unapproved_comments) die("Query Failed" . mysqli_error($connection));
                            $unapproved_comment_count = mysqli_num_rows($select_unapproved_comments);

                            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                            $select_subscribers_users = mysqli_query($connection, $query);
                            if(!$select_subscribers_users) die("Query Failed" . mysqli_error($connection));
                            $subscribers_user_count = mysqli_num_rows($select_subscribers_users);
                        ?>

                        <!-- /.row -->
                        <div class="row">
                            <script type="text/javascript">
                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        ['Data', 'Count'],
                                        <?php
                                            $elements_text = ['All Post', 'Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscribers Users', 'Categories'];
                                            $elements_count = [$posts_count, $posts_published_count, $posts_draft_count,  $comments_count, $unapproved_comment_count, $users_count, $subscribers_user_count, $categories_count];
                                            for($i=0;$i<8;$i++){
                                                echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
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

                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawChart);

                            </script>
                            <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
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
