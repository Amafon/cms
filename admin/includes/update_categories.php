<!-- EDIT CATEGORY FORM -->
<form action="" method="POST">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php
            if(isset($_GET['edit'])){
                global $connection;
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
                $select_categories_id = mysqli_query($connection, $query);
                if(!$select_categories_id) die('Query Failed' . mysqli_error($connection));
                while($row=mysqli_fetch_assoc($select_categories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
        ?>
                <input class="form-control" type="text" value="<?= $cat_title ;?>" name="cat_title" id="">
        <?php 
                }
            }
        ?>

        <!-- UPDATE QUERY -->
        <?php
            if(isset($_POST['update_category'])){
                global $connection;
                $the_cat_title = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title='$the_cat_title' WHERE cat_id = '$cat_id'";
                $update_query = mysqli_query($connection, $query);
                if(!$update_query) die('Query Failed' . mysqli_error($connection));
                header('Location: categories.php');
            }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update Category" name="update_category">
    </div>
</form>