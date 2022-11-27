<?php
    
    //source code reference https://www.youtube.com/watch?v=h5ghlfvU3S8

    $message_sent = false;

    if(isset($_POST['email']) && $_POST['email'] != ''){

        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            //submit the form (pag ayaw ng request try $_POST)
        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $messageSubject = $_POST['subject'];
        $message = $_POST['message'];
    
        $to = //"Company email";
        $body = "";
    
        $body .= "From: ".$userName. "\r\n";
        $body .= "Email: ".$userEmail. "\r\n";
        $body .= "Message: ".$message. "\r\n";
        
        ini_set($to, $body);

        $message_sent = true;

        }
        else{
            $invalid_class_name = "form-invalid";
        }
    }

   
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script >
        $(function() {
   
        $(".form-control").on('focus', function(){

       $(this).parents(".form-group").addClass('focused');

        });

        $(".form-control").on('blur', function(){

       $(this).parents(".form-group").removeClass('focused');

         });

        });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script >
        $(function() {
   
        $(".form-control").on('focus', function(){

       $(this).parents(".form-group").addClass('focused');

        });

        $(".form-control").on('blur', function(){

       $(this).parents(".form-group").removeClass('focused');

         });

        });
    </script>
<!-- updated ver for bg -->
<div class="c-image">
  <div class="hero-text">
  <hr class="my-10">
        <div class="container h-100"><br><br>
            <div class="row h-100 align-items-center justify-content-center text-center">
                <h1 class="text-uppercase text-white font-weight-bold">Contact Us</h1>
				<hr class="divider my-4" />                 
            </div>
        </div>
    </div>
</div>

    <?php
        if($message_sent):
            echo "<script> alert('Thanks for messaging us, we'll' get back to you soon.'); 
            window.location.href = 'index.php'; </script>";
            
    ?>
    
    <!--<h3>Thanks for messaging us, we will send you a reply immediately</h3>-->

    <?php 
        else:
    ?>

    <div class="container" style="margin-top: 4rem; margin-bottom: 4rem;">
        <form action="index.php?page=contact_us" method="POST" class="form">
            <div class="form-group">
                <label for="name" class="form-label">Your Name</label>
                <input  type="text" class="form-control <?= isset($invalid_class_name) ? $invalid_class_name : "" ?>" id="name" name="name" placeholder="Juan dela Cruz" tabindex="1" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="juan@cruz.com" tabindex="2" required>
            </div>
            <div class="form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Hello There!" tabindex="3" required>
            </div>
            <div class="form-group">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" rows="5" cols="50" id="message" name="message" placeholder="Enter Message..." tabindex="4"></textarea>
            </div>
            <div>
                <button class="btn btn-primary" type="submit" class="btn">Send Message</button>
            </div>
        </form>
    </div>
    <?php
        endif;
    ?>
    <section class="page-section">
        <div class="container">
             <h3>Hotel Room Reservations</h3>
            <p><span style="color: #474747;">Mobile: +63 917 809 12 89 | +63 917 845 5847 | +63 917 834 3302</span><br />
            <span style="color: #474747;">Telephone: +632 8 464 7888 </span><br />
            <span style="color: #474747;">Email: victorsSecret@gmail.com</span></p>
        </div>
        </section><br>