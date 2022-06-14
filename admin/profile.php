<?php include "includes/admin_header.php";?>
<?php
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_profile_query = mysqli_query($connection, $query);
        if(!$select_user_profile_query) die("Query Failed" . mysqli_error($connection));
        while($row = mysqli_fetch_assoc($select_user_profile_query)){
            $user_id        = $row['user_id']; 
            $user_password  = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname  = $row['user_lastname'];
            $user_email     = $row['user_email'];
            $user_role      = $row['user_role'];
        }
    }

    if(isset($_POST['update_profile'])){
        $username       = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname  = $_POST['user_lastname'];
        $user_email     = $_POST['user_email'];
        $user_password  = $_POST['user_password'];
        $user_role      = $_POST['user_role'];

        // Set the query
        $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE username= '{$username}'";
        // Execute the query
        $update_query = mysqli_query($connection, $query);
        // Check for errors
        if(!$update_query) die('Query Failed' . mysqli_error($connection));
    }
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                    <!-- Page Heading 1 -->
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $username ?></small>
                        </h1>
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
                                <select name="user_role" id="user_role" class="form-control">
                                    <option value="<?php echo $user_role;?>"><?php echo strtoupper(substr($user_role, 0,1)) . strtolower(substr($user_role,  1,strlen($user_role)-1));?></option>
                                    <?php
                                        if($user_role == "admin"){
                                            echo "<option value='subscriber'>Subscriber</option>";
                                        } else{
                                            echo "<option value='admin'>Admin</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo $username;?>" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="user_email">User Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email" value="<?php echo $user_email;?>" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="user_email">User Password</label>
                                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password" value="<?php echo $user_password;?>" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update Profile" class="btn btn-primary" name="update_profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include "includes/admin_footer.php";?>
