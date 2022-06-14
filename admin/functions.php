<?php 
  include "../includes/db.php";

  function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
  }

  function confirm($result){
    global $connection;
    if(!$result) die('Query Failed 🔥🔥🔥' . mysqli_error($connection) . " " . mysqli_errno($connection));
  }

  function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
      $cat_title = $_POST['cat_title'];
      if($cat_title == "" || empty($cat_title)){
          echo "<p>This field should not be empty</p>";
      } else{
          $query = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
          $create_category_query = mysqli_query($connection, $query);
          if(!$create_category_query) die("Query Failed" . mysqli_error($connection));
          header('Location: categories.php');
      }
    }
  }

  function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    if(!$select_categories) die('Query Failed' . mysqli_error($connection));
    while($row=mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
  }

  function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
      $the_cat_id = $_GET['delete'];
      $query = "DELETE FROM categories WHERE cat_id = '$the_cat_id'";
      $delete_query = mysqli_query($connection, $query);
      if(!$delete_query) die('Query Failed' . mysqli_error($connection));
      header('Location: categories.php');
    }
  }

  function approve_comment(){
    if(isset($_GET['approve'])){
      global $connection;
      $the_comment_id = $_GET['approve'];
      $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
      $approve_comment_query = mysqli_query($connection, $query);
      confirm($approve_comment_query);
    };
  }

  function unapprove_comment(){
    if(isset($_GET['unapprove'])){
      global $connection;
      $the_comment_id = $_GET['unapprove'];
      $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
      $unapprove_comment_query = mysqli_query($connection, $query);
      confirm($unapprove_comment_query);
    };
  }

  function delete_comment(){
    if(isset($_GET['delete'])){
      global $connection;
      $the_comment_id = $_GET['delete'];
      $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
      $delete_comment_query = mysqli_query($connection, $query);
      confirm($delete_comment_query);
    };
  }

  function delete_user(){
    if(isset($_GET['delete'])){
      if(isset($_SESSION['user_role']) && $_SESSION['user_role']==='admin'){
        global $connection;
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
        $delete_user_query = mysqli_query($connection, $query);
        confirm($delete_user_query);
      } else{
        header('Location: ../index.php');
      }
    };
  }

  function createUser(){
    global $connection;
    if(isset($_POST['create_user'])){
      $username           = escape($_POST['username']);
      $user_firstname     = escape($_POST['user_firstname']);
      $user_lastname      = escape($_POST['user_lastname']);
      $user_role          = escape($_POST['user_role']);
      $user_email         = escape($_POST['user_email']);
      $user_password      = escape($_POST['user_password']);

      $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
  
      $query = "INSERT INTO users(username, user_firstname, user_lastname, user_role, user_email, user_password) VALUES('$username', '$user_firstname', '$user_lastname', '$user_role', '$user_email', '$password')";
  
      $create_user_query = mysqli_query($connection, $query);
      confirm($create_user_query);
      echo "<p>User Created: " . "<a href='users.php'>View Users</a></p>";
      // header('Location: posts.php');
    }
  }

  function changeToAdmin(){
    global $connection;
    if(isset($_GET['change_to_admin'])){
      $user_id = $_GET['change_to_admin'];
      $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id}";
      $update_query = mysqli_query($connection, $query);
      if(!$update_query) die('Query Failed' . mysqli_error($connection));
    }
  }

  function changeToSubscriber(){
    global $connection;
    if(isset($_GET['change_to_subscriber'])){
      $user_id = $_GET['change_to_subscriber'];
      $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id}";
      $update_query = mysqli_query($connection, $query);
      if(!$update_query) die('Query Failed' . mysqli_error($connection));
    }
  }

  function deletePost(){
    if(isset($_GET['delete'])){
      global $connection;
      $post_id = mysqli_real_escape_string($connection, $_GET['delete']);
      $query = "DELETE FROM posts WHERE post_id = '$post_id'";
      $delete_post_query = mysqli_query($connection, $query);
      confirm($delete_post_query);
    };
  }

  function resetPost(){
    if(isset($_GET['reset'])){
      global $connection;
      $post_id = $_GET['reset'];
      $reset = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$post_id}";
      $reset_views_query = mysqli_query($connection, $reset);
      confirm($reset_views_query);
    }
  }

  function users_online(){
    
    if(isset($_GET['onlineusers'])){
      include "../includes/db.php";
      if(!$connection){
        global $connection;
        session_start();

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        if(!$send_query) die("Query Failed " . mysqli_error($connection));
        $count = mysqli_num_rows($send_query);
        if($count === 0){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', $time)");
        } else{
            mysqli_query($connection, "UPDATE users_online SET time = $time WHERE session = '$session'");
        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > $time_out");
        $count_user = mysqli_num_rows($users_online_query);
        echo $count_user;
      }
    }
  }

  users_online();
?>