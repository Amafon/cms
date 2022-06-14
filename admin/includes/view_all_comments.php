<?php 
  delete_comment();

  unapprove_comment();

  approve_comment();
?>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Email</th>
      <th>Comment</th>
      <th>Status</th>
      <th>In response to</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $query = isset($_GET['p_id']) ? "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['p_id']) . "" : "SELECT * FROM comments";
        
        $select_comments_query = mysqli_query($connection, $query);
        if(!$select_comments_query) die('Query Failed' . mysqli_error($connection));
        while($row = mysqli_fetch_assoc($select_comments_query)){
          $comment_id = $row['comment_id'];
          $comment_post_id = $row['comment_post_id'];
          $comment_author = $row['comment_author'];
          $comment_email = $row['comment_email'];
          $comment_content = $row['comment_content'];
          $comment_status = $row['comment_status'];
          $comment_date = $row['comment_date'];
        ?>
          <tr>
            <td><?php echo $comment_id ;?></td>
            <td><?php echo $comment_author ;?></td>
            <td><?php echo $comment_email ;?></td>
            <td><?php echo $comment_content ;?></td>
            <td><?php echo $comment_status ;?></td>
            <?php 
              $query_post = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
              $select_post_id_query = mysqli_query($connection, $query_post);
              if(!$select_post_id_query) die('Query Failed' . mysqli_error($connection));
              while($row = mysqli_fetch_assoc($select_post_id_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
            ?>
              <td><a href="../post.php?p_id=<?php echo $post_id ;?>"><?php echo $post_title ;?></a></td>
            <?php
              }
            ?>
            <td><?php echo $comment_date ;?></td>
            <td><a href="comments.php?approve=<?php echo $comment_id ;?>">Approve</a></td>
            <td><a href="comments.php?unapprove=<?php echo $comment_id ;?>">Unapprove</a></td>
            <td><a href="comments.php?delete=<?php echo $comment_id ;?>">Delete</a></td>
          </tr>
      <?php 
        }
      ?>
  </tbody>
</table>