<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>


    </style>
</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-lg-8 m-auto d-block">

                <br>

                    <h3 class="text-center"> Registration Form </h3>

                <form action=" <?php echo htmlentities($_SERVER["PHP_SELF"]); ?> " method="POST">

                    <div class="form-group">
                        <label for="na"> Name </label>
                        <input type="text" name="na" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="pn"> Phone No </label>
                        <input type="text" name="pn" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="cna"> Company Name </label>
                        <input type="text" name="cna" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="gst"> GST NO </label>
                        <input type="text" name="gst" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="eid"> Email ID </label>
                        <input type="text" name="eid" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="pa"> Password </label>
                        <input type="password" name="pa" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="cpa"> Confirm Password </label>
                        <input type="password" name="cpa" class="form-control" autocomplete="off" required>
                    </div>

                    <p> Click Here To Login <a href="login.php"> Log In </a></p>

                    <input type="submit" name="submit" value="create Account" class="btn btn-success">


                </form>

            </div>


        </div>

    </div>


    <?php



    if (isset($_POST['submit'])) {
        include 'dbcon.php';


        $na = mysqli_real_escape_string($con, $_POST['na']);
        $pn  =  mysqli_real_escape_string($con, $_POST['pn']);
        $cna  =  mysqli_real_escape_string($con, $_POST['cna']);
        $gst  =  mysqli_real_escape_string($con, $_POST['gst']);
        $eid = mysqli_real_escape_string($con, $_POST['eid']);
        $pa = mysqli_real_escape_string($con, $_POST['pa']);
        $cpa = mysqli_real_escape_string($con, $_POST['cpa']);


        $password = password_hash($pa, PASSWORD_BCRYPT);
        $cpassword = password_hash($cpa, PASSWORD_BCRYPT);


        $token = bin2hex(random_bytes(15)); 


        $emailquery = "select * from registration where email='$eid'";

        $query = mysqli_query($con, $emailquery);

        $emailcount = mysqli_num_rows($query);


        if ($emailcount > 0) {

                ?>
                    <script>
                        alert(" Email Id already used try with different email id ");
                    </script>
                <?php

        } elseif($pa === $cpa){

                       $insertquery = "INSERT INTO registration (name , phone_no,cname,gstno,email,password,cpassword,token) VALUES ('$na','$pn','$cna','gst','$eid','$password','$cpassword','$token')";

            $iquery = mysqli_query($con, $insertquery);


              // for sending mail
                
            $subject = " Password And User Name ";
            $body = "User Name is , $na . And Password is $pa";

            $sender_email = "From: rahulgbgautam.com";

            if (mail($eid, $subject, $body, $sender_email)) {
                $_SESSION['newmsg'] = "check your mail to Reset your Password $eid";
                } else {

                    ?>
                        <script>
                            alert("Email sending failed...");
                        </script>
                    <?php
            }



    ?>
            <script>
                alert(" Your Details are Inserted And Password and User Name are send to the Email");
            </script>
    <?php
        }else{

            ?>
                <script>
                    alert("You Have Not Enter Same Password");
                </script>
            <?php

        }

}

 

    ?>
</body>

</html>







