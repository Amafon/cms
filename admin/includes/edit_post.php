<?php 
  if(isset($_POST['create_post'])){
    $post_title = mysqli_real_escape_string($connection, $_POST['title']);
    $post_author = mysqli_real_escape_string($connection, $_POST['author']);
    $post_category_id = mysqli_real_escape_string($connection, $_POST['post_category_id']);
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($post_image_tmp, "../images/" . $post_image);
    
    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', $post_comment_count, '$post_status')";

    $create_post_query = mysqli_query($connection, $query);
    confirm($create_post_query);
    // header('Location: posts.php');
  }

  if(isset($_POST['update_post'])){
    global $connection;
    $the_post_id = $_GET['p_id'];

    $post_title = mysqli_real_escape_string($connection, $_POST['title']);
    $post_author = mysqli_real_escape_string($connection, $_POST['author']);
    $post_user = mysqli_real_escape_string($connection, $_POST['user']);
    $post_category_id = mysqli_real_escape_string($connection, $_POST['post_category']);
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($post_image_tmp, "../images/" . $post_image);
    
    if(empty($post_image)){
      $query = "SELECT * FROM posts WHERE post_id='$the_post_id'";
      $select_image = mysqli_query($connection, $query);
      confirm($select_image);
      while($row = mysqli_fetch_assoc($select_image)){
        $post_image=$row['post_image'];
      }
    }
    
    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);

    $query = "UPDATE posts SET post_category_id = '$post_category_id', post_title = '$post_title', post_date = now(), post_author = '$post_author', post_user = '$post_user', post_status = '$post_status', post_tags = '$post_tags', post_content = '$post_content', post_image = '$post_image' WHERE post_id = $the_post_id";

    $update_post = mysqli_query($connection, $query);
    confirm($update_post);
    echo "<p class='bg-success'>Post Edited: " . "<a href='../post.php?p_id={$the_post_id}'>View Post</a> - <a href='posts.php'>View Others Post</a></p>";
  }

  if(isset($_GET['p_id'])){
    global $connection;
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = '$the_post_id'";
        $select_posts_by_id = mysqli_query($connection, $query);
        if(!$select_posts_by_id) die('Query Failed' . mysqli_error($connection));
        while($row = mysqli_fetch_assoc($select_posts_by_id)){
          $post_title = $row['post_title'];
          $post_category_id = $row['post_category_id'];
          $post_author = $row['post_author'];
          $post_user = $row['post_user'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_content = $row['post_content'];
?>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="post-title">Post Title</label>
              <input type="text" name="title" id="post-title" class="form-control" value="<?php echo $post_title ;?>">
            </div>
            <div class="form-group">
              <label for="post-category-id">Post Category</label>
              <select name="post_category" id="post_category" class='form-control'>
                <?php
                  $query = "SELECT * FROM categories";
                  $select_categories = mysqli_query($connection, $query);
                  confirm($select_categories);
                  while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    $selected = $post_category_id == $cat_id ? 'selected':'';
                    echo "<option value={$cat_id} {$selected}>{$cat_title}</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="post-author">Post Author</label>
              <input type="text" name="author" id="post-author" class="form-control" value="<?php echo $post_author ;?>">
            </div>
            <div class="form-group">
              <label for="post-user">Post User</label>
              <input type="text" name="user" id="post-user" class="form-control" value="<?php echo $post_user ;?>" readonly>
            </div>
            <div class="form-group">
              <label for="post-status">Post Status</label>
              <select name="post_status" id="post_status" class="form-control">
                <option value="<?php echo $post_status ;?>" selected><?php echo $post_status ;?></option>
                <option value="<?php echo $post_status==='draft'?'published':'draft' ;?>"><?php echo $post_status==='draft'?'published':'draft' ;?></option>
              </select>
            </div>
            <div class="form-group">
              <label for="post-status" style="display: block;">Post Image</label>
              <img src="../images/<?php echo $post_image;?>" alt="Image" width="100">
              <input type="file" name="image">
            </div>
            <div class="form-group">
              <label for="post-tags">Post Tags</label>
              <input type="text" name="post_tags" id="post-tags" class="form-control" value="<?php echo $post_tags ;?>">
            </div>
            <div class="form-group">
              <label for="post-content">Post Content</label>
              <textarea type="text" name="post_content" id="body" class="form-control" cols="30" rows="10"  ><?php echo $post_content ;?></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Update Post" class="btn btn-primary" name="update_post">
            </div>
          </form>
<?php
    }
  }
?>