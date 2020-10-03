<?php

session_start();
ob_start();
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

                <p> <?php  
                
                if(isset($_SESSION['passmsg'])){

                    echo $_SESSION['passmsg'] ;
                }else{

                        echo $_SESSION['passmsg']=" ";
                }
                
                ?></p>

                <form action="" method="POST">


                    <div class="form-group">
                        <label for="pa"> New Password </label>
                        <input type="password" name="pa" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="cpa"> Confirm Password </label>
                        <input type="password" name="cpa" class="form-control" autocomplete="off" required>
                    </div>

                    <input type="submit" name="submit" value="Reset Password" class="btn btn-success">


                </form>

            </div>


        </div>

    </div>


    <?php



    if (isset($_POST['submit'])) {
        include 'dbcon.php';


        if (isset($_REQUEST['token'])) {
            $token= $_REQUEST['token'];


            $pa = mysqli_real_escape_string($con, $_POST['pa']);
            $cpa = mysqli_real_escape_string($con, $_POST['cpa']);

            
            $password = password_hash($pa, PASSWORD_BCRYPT);
            $cpassword = password_hash($cpa, PASSWORD_BCRYPT);

            if($pa === $cpa){

                $updatequery="update registration set password='$password' where token='$token'";






            /*elseif (($password === $cpassword)) {
            echo " Enter ";
            $insertquery = "INSERT INTO login_register (name , phone_no,email,password,cpassword) VALUES ('$na','$pn','$eid','$password','$cpassword')";

            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
                ?>
                <script>
                    alert("Inserted successful");
                </script>
            <?php
            } else {
                ?>
                <script>
                    alert("NO Inserted");
                </script>
            <?php

         */

            

            $iquery = mysqli_query($con, $updatequery);

            if($iquery){

                $_SESSION['msg']=" Your Password has been updated";
                header('location:login.php');
            }else{

                $_SESSION['passmsg']  = " your password is not updated ";

                header('location:reset_password.php');                
            }
        }

            }
 
else{
                echo " No Token Found ";
        }
    }

    ?>
</body>

</html>