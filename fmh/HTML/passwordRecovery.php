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
                        if(isset($_SESSION['recoveryComment'])){
                            echo ($_SESSION['recoveryComment']);
                            unset($_SESSION['recoveryComment']);
                        }
                    ?>
                </p>
                <hr>

                <div class="appImageClass">
                    <abbr title="Go Home">
                        <a href="homeTenant1.php">
                            <img src="../Assests/logo.png" alt="">
                        </a>
                    </abbr>
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
                    <!-- <input type="button" value="Send Pin Number" name="proceed" onclick="recoveryFunction(1)"> -->
                    <input type="submit" value="Submit" name="" onclick="postDisplay()">
                    <!-- <input type="submit" value="Submit" name="submitBtn" onclick="postDisplay()"> -->
                </form>

                <a href="signIn.php"> Back to sign in </a>
            </div>

            <div class="pinContaineer" id="pinContaineerId" style="visibility:hidden;">
                <form action="passwordRecovery.php" method="post" id="pinBox">
                    <h2 class="recoveryHeading">Enter the pin sent to your email address</h2>
                    <p id="recoveryAlert">Alert Message Section</p>
                    <hr>
                    <div class="appImageClass">
                        <abbr title="Go Home">
                            <a href="homeTenant1.php">
                                <img src="../Assests/logo.png" alt="">
                            </a>
                        </abbr>
                    </div>

                    <input type="number" name="" placeholder="Enter pin here">
                    <input type="submit" name="verifyPinBtn" value="Verify Pin" >
                </form>
            </div>

            <div class="resetPasswordContaineer" id="resetPasswordContaineerId" style="visibility:hidden;">
                <form action="passwordRecovery.php" method="post">
                    <h2 class="recoveryHeading">New Password</h2>
                    <p id="recoveryAlert2"></p>
                    <hr>
                    <div class="appImageClass">
                        <abbr title="Go Home">
                            <a href="homeTenant1.php">
                                <img src="../Assests/logo.png" alt="">
                            </a>
                        </abbr>
                    </div>
                    <input type="password" class="passwordBox" name="new" placeholder="Enter the password">
                    <input type="password" class="passwordBox" name="confirm" placeholder="Enter password again for confirmation">
                    <!-- <input type="submit" value="Reset Password" onclick="recoveryFunction(3)"> -->
                    <input type="submit" value="Reset Password" name="resetPwBtn">
                    <input type="checkbox" name="" id="passwordTogglerCheckBox" onclick="changePwVisibility(document.getElementsByClassName('passwordBox')[0], document.getElementsByClassName('passwordBox')[1])">
                </form>
            </div>
        </div>
    </div>

    <script>
        // if(filter == 0){
        //     document.getElementById('forgotPasswordContaineerId').style = "visibility:visible;";
        //     document.getElementById('pinContaineerId').style = "visibility:hidden;";
        //     document.getElementById('resetPasswordContaineerId').style = "visibility:hidden";
        // }

        // recoveryFunction = (step, displayMsg) => {
        //     document.getElementById('recoveryAlert').innerHTML = "displayMsg";
        //     if (step == 1) {
        //         document.getElementById('forgotPasswordContaineerId').style = "visibility:hidden";
        //         document.getElementById('pinContaineerId').style = "visibility:visible";
        //         document.getElementById('resetPasswordContaineerId').style = "visibility:hidden";
        //         step++;
        //     } else if (step == 2) {
        //         document.getElementById('forgotPasswordContaineerId').style = "visibility:hidden";
        //         document.getElementById('pinContaineerId').style = "visibility:hidden";
        //         document.getElementById('resetPasswordContaineerId').style = "visibility:visible";
        //         step++;
        //     }
        //     // alert(displayMsg);
            
        // }

        function postDisplay(){
            document.getElementById('forgotPasswordContaineerId').style = "visibility:hidden";
            document.getElementById('pinContaineerId').style = "visibility:hidden";
            document.getElementById('resetPasswordContaineerId').style = "visibility:visible";
        }

        displayMsg = (place, displayMsg) => {
            document.getElementById(place).innerHTML = displayMsg;
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

    <!-- linking external js file -->
    <script src="../Javascript/commonJs.js"></script>
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
                ?>
                    <script type="text/javascript">
                        displayMsg("recoveryAlert", "<span class='fail'><b>Provided informations doesnot matches with our record</b></span>");
                    </script>
                <?php               
            }
            elseif($chk == true){
                // $_SESSION["recoveryComment"] = "<span class='success'><b>Provided informations matches with our record</b><br></span>" ;
                ?>
                    <script type="text/javascript">
                        // location.replace("http://localhost/fmh/html/passwordRecovery.php");
                        // alert("Provided informations matches with our record");
                        displayMsg("recoveryAlert2", "<span class='success'><center><b>Provided informations matches with our record</b></center></span>");
                        postDisplay();
                    </script>
                <?php
            }

        }
        else{
            ?>
                <script type="text/javascript">
                    displayMsg("recoveryAlert", "<span class='fail'><b>Error while executing query</b><br></span>");
                </script>
            <?php 
        }
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
                $_SESSION["comment"] = "<span class='success'><b>Your password has been reset<br></b></span>";
                // $_SESSION["cook"] = "<span class='success'>Your password has been reset<br></span>";
                // header('location:'.SIGNIN);
            }
            else{ 
                $_SESSION["comment"] = "<span class='fail'><b>Error while executing query<br></b></span>";
                // $err = "<span class='fail'>Error while executing query<br></span>";
                // $_SESSION["cook"] = $err;
                // header('location:'.SIGNIN);
            }
            ?>
                <script>
                    location.replace("http://localhost/fmh/html/signin.php");
                </script>
            <?php
        }
        else{
            // $_SESSION["recoveryComment"] = "<span class='fail'><b>Please check your entered passwords</b><br></span>" ;
            ?>
                <script type="text/javascript">
                    displayMsg("recoveryAlert2", "<span class='fail'><b><center>Please check your entered passwords</center></b></span>");
                    postDisplay();
                </script>
            <?php
        }
    }
?>