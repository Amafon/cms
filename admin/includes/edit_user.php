<?php
  if(isset($_POST['edit_user'])){
    // Get forms submitted values
    $user_id        = mysqli_real_escape_string($connection, $_GET['user_id']);
    $username       = mysqli_real_escape_string($connection, $_POST['username']);
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname  = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_email     = mysqli_real_escape_string($connection, $_POST['user_email']);
    $user_role      = mysqli_real_escape_string($connection, $_POST['user_role']);
    $user_password  = mysqli_real_escape_string($connection, $_POST['user_password']);

    if(!empty($user_password)){
      $query_password = "SELECT user_password FROM users WHERE user_id = $user_id";
      $get_user_query = mysqli_query($connection, $query_password);
      confirm($get_user_query);
      $row = mysqli_fetch_assoc($get_user_query);
      $db_user_password = $row['user_password'];

      if($db_user_password !== $user_password){
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
      }

      // Set the query
      $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}', user_password='{$hashed_password}' WHERE user_id = {$user_id}";
      // Execute the query
      $update_query = mysqli_query($connection, $query);
      // Check for errors
      if(!$update_query) die('Query Failed' . mysqli_error($connection));

      echo "User Updated - " . "<a href='users.php'>View Users?</a>";
    }

  }

  if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query) die('Query Failed' . mysqli_error($connection));
    while($row = mysqli_fetch_assoc($select_user_query)){
      $username         = $row['username'];
      $user_password    = $row['user_password'];
      $user_firstname   = $row['user_firstname'];
      $user_lastname    = $row['user_lastname'];
      $user_email       = $row['user_email'];
      $user_image       = $row['user_image'];
      $user_role        = $row['user_role'];
      $randSalt         = $row['randSalt'];
?>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="user_firstname">User Firstname</label>
          <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="Firstname" value="<?php echo $user_firstname;?>" required>
        </div>
        <div class="form-group">
          <label for="user_lastname">User Lastname</label>
          <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="Lastname" value="<?php echo $user_lastname;?>" required>
        </div>
        <div class="form-group">
          <label for="user_role">User Role</label>
          <input type="text" name="user_role" id="user_role" value="<?php echo $user_role;?>" class="form-control" readonly>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo $username;?>" required>
        </div>
        </div>
        <div class="form-group">
          <label for="user_email">User Email</label>
          <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email" value="<?php echo $user_email;?>" required>
        </div>
        <div class="form-group">
          <label for="user_password">User Password</label>
          <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Edit User" class="btn btn-primary" name="edit_user">
        </div>
      </form>
<?php
    }
  } else{
    header('Location: index.php');
  }
?>