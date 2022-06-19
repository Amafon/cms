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
            if (isset($_GET['category'])) $post_category_id = $_GET['category'];
    $query = "SELECT * FROM posts WHERE post_category_id = '$post_category_id' AND post_status='published'";
            $select_all_posts_query = mysqli_query($connection, $query);
            if (!$select_all_posts_query) die('Query Failed' . mysqli_error($connection));
            $number_category_post = mysqli_num_rows($select_all_posts_query);
            if ($number_category_post > 0) {
                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    echo "
                            <!-- First Blog Post -->
                            <h2>
                            <a href='post.php?p_id={$post_id}'>{$post_title}</a>
                            </h2>
                            <p class='lead'>by <a href='index.php'>{$post_author}</a></p>
                            <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>
                            <hr>
                            <img class='img-responsive' src='images/{$post_image}' alt=''>
                            <hr>
                            <p>" . substr($post_content, 0, 200) . "...</p>
                            <a class='btn btn-primary' href='post.php?p_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                            <hr>";
                }

                echo "<ul class='pager'>";
                echo "<li class='previous'>";
                echo "<a href='#'>&larr; Older</a>";
                echo "</li>";
                echo "<li class='next'>";
                echo "<a href='#'>Newer &rarr;</a>";
                echo "</li>";
                echo "</ul>";
            } else {
                echo "<h1 class='bg-warning text-center'>No Post Available for this category</h1>";;
            }

            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>


    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"; ?>