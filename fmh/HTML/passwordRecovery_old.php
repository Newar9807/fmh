<?php include('include.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/passwordRecovery.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">
</head>

<body>

    <div id="passwordRecoveryMainContaineer">
        <div class="websiteDetail">
            <h3>FindMe<span style="color:orange; font-family: Script Mt;">Home<span></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Obcaecati, quis.
            </p>
        </div>

        <div class="forgotPasswordContaineer" id="forgotPasswordContaineerId">
            <div id="forgotPasswordBox">
                <h2 class="recoveryHeading">Password Recovery</h2>
                <p id="recoveryAlert">
                    <?php
                        if(isset($_SESSION['comment1'])){
                            echo ($_SESSION['comment1']);
                            unset($_SESSION['comment1']);
                        }
                    ?>
                </p>
                <hr>

                <div class="appImageClass">
                    <img src="../Assests/logo.png" alt="">
                </div>

                <form action="passwordRecovery.php" method="post" autocomplete="off">
                    <!-- room type selection section  -->
                    <div id="userTypeContaineer">
                        <div id="userTypeTitle">
                            <p>Select Role</p>
                        </div>

                        <div id="userTypeBox">
                            <div id="userTypeLabel">
                                <div id="userTypeLabel1">
                                    <p>Landlord</p>
                                </div>
                                <div id="userTypeLabel2">
                                    <p>Tenant</p>
                                </div>
                            </div>

                            <div id="userTypeSlider" onclick="userTypeSlider()"> </div>
                            <input type="hidden" name="role" id="role" value="tenant">
                        </div>
                    </div>

                    <input type="email" placeholder="Email address" name="email">
                    <input type="number" placeholder="Phone number" name="phone">
                    <input type="date" name="dob">
                    <!-- <input type="submit" value="Send Pin Number" name="proceed" onclick="recoveryFunction(1)"> -->
                    <input type="submit" value="Submit" name="submitBtn">
                </form>

                <a href="signIn.php"> Back to sign in </a>
                    <!-- <p id="backToSignIn" style="text-align: left; line-height:12px"> Back to sign in </p> -->
            </div>

            <div class="pinContaineer" id="pinContaineerId">
                <form action="passwordRecovery.php" method="post" id="pinBox">
                    <h2 class="recoveryHeading">Enter the pin sent to your email address</h2>
                    <p id="recoveryAlert">Alert Message Section</p>
                    <hr>
                    <div class="appImageClass">
                        <img src="../Assests/logo.png" alt="">
                    </div>
                    <input type="number" name="" placeholder="Enter pin here">
                    <input type="submit" name="verifyPinBtn" value="Verify Pin" >
                </form>
            </div>

            <div class="resetPasswordContaineer" id="resetPasswordContaineerId">
                <form action="passwordRecovery.php" method="post">
                    <h2 class="recoveryHeading">New Password</h2>
                    <p id="recoveryAlert"></p>
                    <hr>
                    <div class="appImageClass">
                        <img src="../Assests/logo.png" alt="">
                    </div>
                    <input type="password" name="new" placeholder="Enter the password">
                    <input type="password" name="confirm" placeholder="Enter password again for confirmation">
                    <!-- <input type="submit" value="Reset Password" onclick="recoveryFunction(3)"> -->
                    <input type="submit" value="Reset Password" name="resetPwBtn">
                </form>
            </div>
        </div>
    </div>

    <script>
        var step = 1;
        var containeer_1 = document.getElementById('forgotPasswordContaineerId');
        var containeer_2 = document.getElementById('pinContaineerId');
        var containeer_3 = document.getElementById('resetPasswordContaineerId');

        containeer_1.style = "visibility:visible;";
        containeer_2.style = "visibility:hidden;";
        containeer_3.style = "visibility:hidden";

        recoveryFunction = (step) => {
            if (step == 1) {
                containeer_1.style = "visibility:hidden";
                containeer_2.style = "visibility:visible";
                containeer_3.style = "visibility:hidden";
                step++;
            } else if (step == 2) {
                containeer_1.style = "visibility:hidden";
                containeer_2.style = "visibility:hidden";
                containeer_3.style = "visibility:visible";
                document.getElementById('recoveryAlert').innerHTML = "<span class='success'><b>Provided informations matches with our record<br>Please reset your password</b></span>";
                step++;
            } else {
                // alert("Password Reset Successful")
            }
        }

        var userType = "Tenant";
        var ele1 = document.getElementById('userTypeSlider');

        function userTypeSlider() {
            if (userType == "Tenant") {
                ele1.style = "left:77.5px; width:70px";
                userType = "Landlord";
                document.getElementById('role').value = "owner";
            } else {
                ele1.style = "left:3px; width:80px";
                userType = "Tenant";
                document.getElementById('role').value = "tenant";
            }
        }
    </script>
</body>

</html>

<?php                                                 
    $chk = false;            
    if(isset($_POST['submitBtn'])){
        $role = ucfirst($_POST['role']);
        $email = strtolower($_POST['email']);
        // setcookie("email", $email, time() + (3600), "/");
        $dob = $_POST['dob'];
        $phone = $_POST['phone'];
        $sql = "SELECT `to_id`, `role`, `email`, `dob`, `phone` FROM tbl_to";
        //Operating Query
        $res = mysqli_query($conn, $sql);
        //Checking Operation
        if($res == true){
            //Query Operated Successfully
            
            while($str = mysqli_fetch_array($res)){
                if($str[1] == $role && $str[2] == $email && $str[3] == $dob && $str[4] == $phone){                   
                    $_SESSION['id'] = $str[0];
                    $chk = true;
                    break;
                }
            }
            if($chk == false){
                $_SESSION["comment1"] = "<span class='fail'><b>Provided informations doesnot matches with our record</b><br></span>";
                directHeader();                
            }
            elseif($chk == true){
                ?>
                    <script type="text/javascript">
                        recoveryFunction(2);
                    </script>
                <?php
            }

        }
        else{
            $err = "<span class='fail'><b>Error while executing query</b><br></span>";
            $_SESSION["comment1"] = $err;
            directHeader();
        }

    }

    function directHeader(){
        ?> 
        <script>
            location.replace("http://localhost/findmehome/html/passwordRecovery.php");                    
        </script>
        <?php
    }               
?>

<?php
    if(isset($_POST['resetPwBtn'])){
        if(($_POST['new'] === $_POST['confirm']) && (($_POST['new'] || $_POST['confirm']) != "")){
            $id = ($_SESSION['id']);
             $enc_pw = md5($_POST['confirm']);
            $sql = "UPDATE `tbl_to` SET `password` = '$enc_pw' WHERE `to_id` = '$id'";   
            $res = mysqli_query($conn, $sql);
            if($res == true){                        
            ?>
                <script>
                    alert("Your password has been reset");
                    location.replace("http://localhost/findmehome/html/signin.php");                    
                </script>
            <?php
                // $_SESSION["cook"] = "<span class='success'>Your password has been reset<br></span>";
                // header('location:'.SIGNIN);
            }
            else{ 
            ?>
                <script>
                    alert("Error while executing query");
                </script>
            <?php
                // $err = "<span class='fail'>Error while executing query<br></span>";
                // $_SESSION["cook"] = $err;
                // header('location:'.SIGNIN);
            }
        }
        else{
            ?>
                <script>
                    alert("Please check your entered passwords");
                    recoveryFunction(2);
                </script>
            <?php

            // $_SESSION["cook"] = "<span class='fail'>Please check your entered passwords<br></span>";
            // // header('location:'.FORGOT);
        }
    }
?>