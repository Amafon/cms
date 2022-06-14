<?php 
  delete_user();

  changeToAdmin();

  changeToSubscriber();
?>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role</th>
      <th>Edit</th>
      <th>Admin</th>
      <th>Subscriber</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $query = "SELECT * FROM users";
        $select_users_query = mysqli_query($connection, $query);
        if(!$select_users_query) die('Query Failed' . mysqli_error($connection));
        while($row = mysqli_fetch_assoc($select_users_query)){
          $user_id        = $row['user_id'];
          $username       = $row['username'];
          $user_password  = $row['user_password'];
          $user_firstname = $row['user_firstname'];
          $user_lastname  = $row['user_lastname'];
          $user_email     = $row['user_email'];
          $user_image     = $row['user_image'];
          $user_role      = $row['user_role'];
        ?>
          <tr>
            <td><?php echo $user_id ;?></td>
            <td><?php echo $username ;?></td>
            <td><?php echo $user_firstname ;?></td>
            <td><?php echo $user_lastname ;?></td>
            <td><?php echo $user_email ;?></td>
            <td><?php echo $user_role ;?></td>
            <td><a href="users.php?source=edit_user&user_id=<?php echo $user_id ;?>">Edit</a></td>
            <td><a href="users.php?change_to_admin=<?php echo $user_id ;?>">Admin</a></td>
            <td><a href="users.php?change_to_subscriber=<?php echo $user_id ;?>">Subscriber</a></td>
            <td><a href="users.php?delete=<?php echo $user_id ;?>" class="delete-post">Delete</a></td>
          </tr>
      <?php 
        }
      ?>
  </tbody>
</table>