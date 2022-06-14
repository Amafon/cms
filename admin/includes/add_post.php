<?php 
  if(isset($_POST['create_post'])){
    $post_title = escape($_POST['title']);
    $post_author = escape($_POST['author']);
    $post_user = escape($_POST['post_user']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POST['post_status']);
    
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($post_image_tmp, "../images/" . $post_image);
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    // $post_comment_count = 4;

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status) VALUES($post_category_id, '$post_title', '$post_author', '$post_user', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";

    $create_post_query = mysqli_query($connection, $query);
    confirm($create_post_query);
    echo "<p class='bg-success'>Post Created: " . "<a href='posts.php'>View Posts</a></p>";
    // header('Location: posts.php');
  }
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post-title">Post Title</label>
    <input type="text" name="title" id="post-title" class="form-control">
  </div>
  <div class="form-group">
    <label for="post-category-id">Post Category</label>
    <select name="post_category_id" id="post_category_id" class="form-control">
    <?php
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        confirm($select_categories);
        while($row=mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
    ?>
              <option value="<?php echo $cat_id;?>"><?php echo $cat_title;?></option>
    <?php 
        }
    ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post-author">Post Author</label>
    <input type="text" name="author" id="post-author" class="form-control">
  </div>
    <div class="form-group">
    <label for="post_user">Post User</label>
    <select name="post_user" id="post_user" class="form-control" required>
      <option value="" disabled selected>Select a user</option>
      <?php
          $query = "SELECT * FROM users";
          $select_users = mysqli_query($connection, $query);
          confirm($select_users);
          while($row=mysqli_fetch_assoc($select_users)){
              $user_id = $row['user_id'];
              $username = $row['username'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
      ?>
                <option value="<?php echo $username;?>"><?php echo $user_firstname . " " . $user_lastname;?></option>
      <?php 
          }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post-status">Post Status</label>
    <!-- <input type="text" name="post_status" id="post-status" class="form-control"> -->
    <select name="post_status" id="" class="form-control">
      <option value="draft">Select an option</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
    </select>
  </div>
  <div class="form-group">
    <label for="post-status">Post Image</label>
    <input type="file" name="image" id="image" class="form-control">
  </div>
  <div class="form-group">
    <label for="post-tags">Post Tags</label>
    <input type="text" name="post_tags" id="post-tags" class="form-control">
  </div>
  <div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea id="body" name="post_content" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" value="Publish Post" class="btn btn-primary" name="create_post">
  </div>
</form>