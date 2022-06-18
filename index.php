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
            $count_post = "SELECT * FROM posts WHERE post_status = 'published'";
            $find_count = mysqli_query($connection, $count_post);
            if (!$find_count) die('Query Failed' . mysqli_error($connection));
            if ($find_count < 1) {
                echo "<h1>There is no post</h1>";
            } else {
                $num_rows = mysqli_num_rows($find_count);
                $per_page = 5;
                $post_per_page = ceil($num_rows / $per_page);
                if (isset($_GET['page'])) {
                    $page = +mysqli_real_escape_string($connection, $_GET['page']);
                } else {
                    $page = "";
                }

                if ($page === "" || $page === 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }

                $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT {$page_1}, {$per_page}";
                $select_all_posts_query = mysqli_query($connection, $query);
                if (!$select_all_posts_query) die('Query Failed' . mysqli_error($connection));
                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 100);
                    $post_status = $row['post_status'];
                    echo "
                                <!-- First Blog Post -->
                                <h2><a href='post.php?p_id={$post_id}'>{$post_title}</a></h2>
                                <p class='lead'>by <a href='author_posts.php?author={$post_author}&p_id={$post_id}'>{$post_author}</a></p>
                                <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>
                                <hr>
                                <a href='post.php?p_id={$post_id}'><img class='img-responsive' src='images/{$post_image}' alt=''></a>
                                <hr>
                                <p>{$post_content}...</p>
                                <a class='btn btn-primary' href='post.php?p_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                                <hr>";
                }

                echo "<ul class='pager'>";
                for ($i = 1; $i <= $post_per_page; $i++) {
                    $active = ($i === $page ? 'active_link' : '');
                    echo "<li><a class='{$active}' href='index.php?page={$i}'>{$i}</a></li>";
                };
                echo "</ul>";
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>


    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"; ?>