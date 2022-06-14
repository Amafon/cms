<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
    function sendEmail(){
        global $connection;
        if(isset($_POST['submit'])){
            $header     = "From: " . mysqli_real_escape_string($connection, $_POST['email']);
            $to         = "support@freddyamafon.com";
            $subject    = wordwrap(mysqli_real_escape_string($connection, $_POST['subject']), 70);
            $body       = mysqli_real_escape_string($connection, $_POST['body']);

            $response = mail($to, $subject, $body, $header);

            if($response){
                echo "<p class='text-primary'>Message Sent Successfully to $to.</p>";
            } else{
                echo "<p class='text-danger'>Something went wrong</p>";
            }
            
        }
    }
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Us</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <?php sendEmail(); ?>
                        <!-- <div class="form-group">
                            <label for="name" class="sr-only">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                        </div> -->
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email: somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="name" class="sr-only">Subject</label>
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                        </div>
                         <div class="form-group">
                            <label for="body" class="sr-only">Message</label>
                            <textarea class="form-control" name="body" id="body" rows="10" placeholder="Enter your message here"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
