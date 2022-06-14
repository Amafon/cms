<?php include "db.php";?>
<?php include "../admin/functions.php";?>

<?php
  if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query  = mysqli_query($connection, $query);
    confirm($select_user_query);
    while($row = mysqli_fetch_assoc($select_user_query)){
      $db_user_id         = $row['user_id'];
      $db_username        = $row['username'];
      $db_user_passowrd   = $row['user_password'];
      $db_user_firstname  = $row['user_firstname'];
      $db_user_lastname   = $row['user_lastname'];
      $db_user_role       = $row['user_role'];
      $db_user_email      = $row['user_email'];
      $randSalt           = $row['randSalt'];
    }

    // $password = crypt($password, $randSalt);

    if($username === $db_username && password_verify($password, $db_user_passowrd)){
      session_start();
      $_SESSION['username']     = $db_username;
      $_SESSION['firstname']    = $db_user_firstname;
      $_SESSION['lastname']     = $db_user_lastname;
      $_SESSION['user_role']    = $db_user_role;
      header('Location: ../admin');      
    } else {
      header('Location: ..');
    }
    
  }
?>