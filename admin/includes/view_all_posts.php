<?php
include "delete_modal.php";
deletePost();
resetPost();
if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $postValueId) {
    $bulk_options = $_POST['bulk_options'];
    switch ($bulk_options) {
      case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_published = mysqli_query($connection, $query);
        confirm($update_to_published);
        echo "<p class='bg-success'>Post id number {$postValueId} has been published.</p>";
        break;
      case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_draft = mysqli_query($connection, $query);
        confirm($update_to_draft);
        echo "<p class='bg-success'>Post id number {$postValueId} has been sent to draft.</p>";
        break;
      case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
        $update_delete_post = mysqli_query($connection, $query);
        confirm($update_delete_post);
        echo "<p class='bg-success'>Post id number {$postValueId} has been deleted.</p>";
        break;
      case 'clone':
        $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
        $select_posts_query = mysqli_query($connection, $query);
        confirm($select_posts_query);
        while ($row = mysqli_fetch_array($select_posts_query)) {
          $post_author = mysqli_real_escape_string($connection, $row['post_author']);
          $post_title = mysqli_real_escape_string($connection, $row['post_title']);
          $post_category_id = mysqli_real_escape_string($connection, $row['post_category_id']);
          $post_content = mysqli_real_escape_string($connection, $row['post_content']);
          $post_status = mysqli_real_escape_string($connection, $row['post_status']);
          $post_image = mysqli_real_escape_string($connection, $row['post_image']);
          $post_tags = mysqli_real_escape_string($connection, $row['post_tags']);
          $post_comment_count = mysqli_real_escape_string($connection, $row['post_comment_count']);
          $post_date = mysqli_real_escape_string($connection, $row['post_date']);

          $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";
          $copy_query = mysqli_query($connection, $query);
          confirm($copy_query);
        }
        echo "<p class='bg-success'>Posts have been copied.</p>";
        break;
      default:
        break;
    }
  }
}
?>

<form action="" method="post">
  <table class="table table-bordered table-hover">
    <div id="bulkOptionsContainer" class="col-xs-4">
      <select name="bulk_options" id="" class="form-control" required>
        <option selected disabled value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
      </select>
    </div>
    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a href="posts.php?source=add-post" class="btn btn-primary" value="Apply">Add New</a>
    </div>
    <thead>
      <tr>
        <th><input type="checkbox" name="" id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Users</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Reset Views</th>
        <th>View Count</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM posts ORDER BY post_id DESC";
      $select_posts_query = mysqli_query($connection, $query);
      if (!$select_posts_query) die('Query Failed' . mysqli_error($connection));
      while ($row = mysqli_fetch_assoc($select_posts_query)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];

        $query_comment_count = mysqli_query($connection, "SELECT * FROM comments WHERE comment_post_id = {$post_id}");
        if (!$query_comment_count) die('Query Failed' . mysqli_error($connection));
        $row_comment = mysqli_fetch_assoc($query_comment_count);
        $post_comment_count = mysqli_num_rows($query_comment_count);

        $post_date = $row['post_date'];
        $post_views_count = $row['post_views_count'];
      ?>
        <tr>
          <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $row['post_id']; ?>" class="checkBoxes"></td>
          <td><?php echo $post_id; ?></td>
          <td><?php echo isset($post_author) && !empty($post_author) ? $post_author : (isset($post_user) && !empty($post_user) ? $post_user : ''); ?></td>
          <td><?php echo $post_title; ?></td>
          <?php

          $query_cat = "SELECT * FROM categories WHERE cat_id = '$post_category_id'";
          $select_categories_id = mysqli_query($connection, $query_cat);
          if (!$select_categories_id) die('Query Failed' . mysqli_error($connection));
          while ($row_cat = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row_cat['cat_id'];
            $cat_title = $row_cat['cat_title'];


          ?>
            <td><?php echo $cat_title; ?></td>
          <?php
          }
          ?>
          <td><?php echo $post_status; ?></td>
          <td><img style="width:100px;" src="../images/<?php echo $post_image; ?>" alt="Image of Javascripte date"></td>
          <td><?php echo $post_tags; ?></td>
          <td><a href="comments.php?p_id=<?php echo $post_id; ?>"><?php echo $post_comment_count; ?></a></td>
          <td><?php echo $post_date; ?></td>
          <td><a href="../post.php?p_id=<?php echo $post_id; ?>">View</a></td>
          <td><a href="posts.php?source=edit_post&p_id=<?php echo $post_id; ?>">Edit</a></td>
          <!-- <td><a onclick="return confirm('Are you sure you wante to delete?')" href="posts.php?source=''&delete=<?php echo $post_id; ?>" class="delete-post">Delete</a></td> -->
          <td><a href="" class="delete_link">Delete</a></td>
          <td><a href="posts.php?source=''&reset=<?php echo $post_id; ?>">Reset</a></td>
          <td><?php echo $post_views_count; ?></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</form>