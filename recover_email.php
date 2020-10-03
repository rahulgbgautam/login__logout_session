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
                <h3 text-align="center"> Recover Your Account </h3>
                <br>
             
                <form action=" <?php echo htmlentities($_SERVER["PHP_SELF"]); ?> " method="POST">

                    <div class="form-group">
                        <label for="eid"> Email ID </label>
                        <input type="text" name="eid" class="form-control" autocomplete="off" required>
                    </div>

                    <input type="submit" name="submit" value="send mail" class="btn btn-success">

                </form>

            </div>


        </div>

    </div>


    <?php



    if (isset($_POST['submit'])) {
        include 'dbcon.php';

        $eid = mysqli_real_escape_string($con, $_POST['eid']);


        $token = bin2hex(random_bytes(15));  


        $emailquery = "select * from registration where email='$eid'";

        $query = mysqli_query($con, $emailquery);

        $emailcount = mysqli_num_rows($query);


        if ($emailcount>0) {

            $userdata=mysqli_fetch_array($query);

            $name= $userdata['name'];
            $token= $userdata['token'];

            $subject = " Password Reset ";
            $body = "Hi, $name . click here to Reset your Password
                
            http://localhost/Projects/theother/proj/reset_password.php?token=$token";

            $sender_email = "From: rahulgbgautam.com";

            if (mail($eid, $subject, $body, $sender_email)) {
                $_SESSION['msg'] = "check your mail to Reset your Password $eid";
                header('location:login.php');
            } else {

                    ?>
                        <script>
                            alert("Email sending failed...");
                        </script>
                    <?php
            }

        }else{
              
                ?>
                    <script>
                        alert("No Email Found");
                    </script>
                <?php
    }
}

    ?>
</body>

</html>