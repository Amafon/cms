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
                                $query = "UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id = {$comment_post_id}";
                                $update_comment_count_query = mysqli_query($connection, $query);
                                if(!$update_comment_count_query) die('Query Failed' . mysqli_error($connection));
                            }
                        } else{
                            echo "<script>alert('Fields cannot be empty');</script>";
                        }
                    }

                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                        $post_author = $_GET['author'];
                        $query = "SELECT * FROM posts WHERE post_author = '$post_author'";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        if(!$select_all_posts_query) die('Query Failed');

                        
                        while($row=mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        // $post_content = $row['post_content'];
                        $post_content = substr($row['post_content'], 0, 100);
                        echo 
                            "
                                <!-- First Blog Post -->
                                <h2><a href='post.php?p_id={$post_id}'>{$post_title}</a></h2>
                                <p class='lead'>by <a href='index.php'>{$post_author}</a></p>
                                <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>
                                <hr>
                                <img class='img-responsive' src='images/{$post_image}' alt=''>
                                <hr>
                                <p>{$post_content}...</p><hr>
                            ";
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