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

                <div>
                    <p class="bg-success text-white px-4"> <?php

                        if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                            } else {
                                    
                                    }
                        ?> 
                    </p>


                </div>

                <form action=" <?php echo htmlentities($_SERVER["PHP_SELF"]); ?> " method="POST">

                    <div class="form-group">
                        <label for="eid"> Email ID </label>
                        <input type="text" name="eid" class="form-control" value="" autocomplete="off"required>
                    </div>


                    <div class="form-group">
                        <label for="pa"> Password </label>

                        <input type="password" name="pa" class="form-control" value="" autocomplete="off"required>
                    </div>

                    <!---------------------------  Forgot Password  ------------------------------------>


                    <p> Forgot Password <a href="recover_email.php"> Click Here </a></p>

                    <p> Not Have An Account <a href="index.php"> Sign UP </a></p>

                    <input type="submit" name="submit" value="Login" class="btn btn-success">




                </form>

            </div>


        </div>

    </div>



    <?php

    include 'dbcon.php';

    if (isset($_POST['submit'])) {
        $eid =  $_POST['eid'];
        $pa = $_POST['pa'];

        $email_search = "select * from registration where email='$eid'";
        $query = mysqli_query($con, $email_search);
        $email_count = mysqli_num_rows($query);


        if ($email_count) {


            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['password'];

            $_SESSION['name'] = $email_pass['name'];

            $pass_decode = password_verify($pa, $db_pass);

            if ($pass_decode) {
                echo "Login Successful";

                header('location:home.php');


            } else {
                
                       ?>
                 <script>
                    alert(" Password Is Wrong ");
                </script>
            <?php

            }

        } else {
            ?>

                 <script>
                    alert(" Invalid Email");
                </script>

            <?php
        }
    }
    ?>

</body>

</html>