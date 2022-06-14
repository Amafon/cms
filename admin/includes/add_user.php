<?php 
  createUser();
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstname">User Firstname</label>
    <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="Firstname" required>
  </div>
  <div class="form-group">
    <label for="user_lastname">User Lastname</label>
    <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="Lastname" required>
  </div>
  <div class="form-group">
    <label for="user_role">User Role</label>
    <select name="user_role" id="user_role" class="form-control">
      <option value="subscriber">Select options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
  </div>
  </div>
  <div class="form-group">
    <label for="user_email">User Email</label>
    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email" required>
  </div>
  <div class="form-group">
    <label for="user_email">User Password</label>
    <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password" required>
  </div>
  <div class="form-group">
    <input type="submit" value="Add User" class="btn btn-primary" name="create_user">
  </div>
</form>