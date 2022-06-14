<?php include "includes/header.php";?>
<?php include "includes/db.php";?>

    <!-- Navigation -->
    <?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class='page-header'>Page Heading <small>Secondary Text</small></h1>

                <?php
                    if(isset($_POST['create_comment'])){
                        $comment_post_id = isset($_GET['p_id'])?$_GET['p_id']:'';
                        $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
                        $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
                        $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);

                        if(!empty($comment_post_id) && !empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            $query_comment = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                            $create_comment_query = mysqli_query($connection, $query_comment);
                            if(!$create_comment_query){
                                die('Query Failed' . mysqli_error($connection));
                            } else{
                                // $query = "UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id = {$comment_post_id}";
                                // $update_comment_count_query = mysqli_query($connection, $query);
                                // if(!$update_comment_count_query) die('Query Failed' . mysqli_error($connection));
                            }
                            header("Location: post.php?p_id={$comment_post_id}");
                        } else{
                            echo "<script>alert('Fields cannot be empty');</script>";
                        }
                    }

                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];

                        $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$post_id}";
                        $send_query = mysqli_query($connection, $view_query);
                        if(!$send_query) die('Query Failed');

                        $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        if(!$select_all_posts_query) die('Query Failed');

                        
                        while($row=mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        echo 
                            "
                                <!-- First Blog Post -->
                                <h2><a href='#'>{$post_title}</a></h2>
                                <p class='lead'>by <a href='index.php'>{$post_author}</a></p>
                                <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>
                                <hr>
                                <img class='img-responsive' src='images/{$post_image}' alt=''>
                                <hr>
                                <p>{$post_content}</p><hr>
                            ";
                        }
                    } else{
                        header("Location: index.php");
                    }
                    
                   
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author" placeholder="Firstname" id="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email" placeholder="Email" id="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Your comment</label>
                            <textarea class="form-control" name="comment_content" rows="3" placeholder="Comment here..." id="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];
                        $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status='approved' ORDER BY comment_date DESC";
                        $select_all_comments_query = mysqli_query($connection, $query);
                        if(!$select_all_comments_query) die('Query Failed');

                        while($row=mysqli_fetch_assoc($select_all_comments_query)){
                            $comment_id = $row['comment_id'];
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];

                ?>
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="https://via.placeholder.com/64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo  $comment_author;?>
                                        <small><?php echo  $comment_date;?></small>
                                    </h4>
                                    <?php echo  $comment_content;?>
                                </div>
                            </div>
                <?php
                        }
                    }
                    
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
            

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php";?>