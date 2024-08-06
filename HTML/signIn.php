<?php include('include.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/signIn.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">
</head>

<body>
    <!-- <div class="close-log-in">&times;</div> -->
    <div id="signInMainContaineer">
        <div class="websiteDetail">
            <h3>FindMe<span style="color:orange; font-family: Script Mt;">Home<span></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Obcaecati, quis.
            </p>
        </div>

        <div id="signInContaineer">
            <div id="signInBox">
                <div id="headingId">
                    <h2>Fill the details below to sign in</h2>
                    <p id="signInUserMsg">
                        <?php
                            if(isset($_SESSION['comment'])){
                                echo ($_SESSION['comment']);
                                unset($_SESSION['comment']);
                            }
                        ?>
                    </p>
                </div>

                <div id="appImageClass">
                    <abbr title="Home">
                        <a href="homeTenant1.php">
                            <img src="../Assests/logo.png" alt="">
                        </a>
                    </abbr>
                </div>


                <div id="signInForm">
                    <form action="signIn.php" method="post" autocomplete="off">
                        <!-- room type selection section  -->
                        <div id="userTypeContaineer">
                            <div id="userTypeTitle">
                                <p>Sign In as</p>
                            </div>

                            <div id="userTypeBox">
                                <div id="userTypeLabel">
                                    <div id="userTypeLabel1">
                                        <p id="d1">Landlord</p>
                                    </div>

                                    <div id="userTypeLabel2">
                                        <p id="d2">Tenant</p>
                                    </div>
                                </div>
                                <input type="hidden" name="role" id="role" value="tenant">
                                <div id="userTypeSlider" onclick="userTypeSlider()"> </div>
                            </div>
                        </div>

                        <input type="email" name="email" id="signInEmailId" placeholder="Email address">

                        <div id="passwordBox">
                            <input type="password" name="password" id="signInPasswordId" placeholder="Password">
                            <input type="checkbox" name="" id="passwordVisibilityToggle" onclick="passwordVisibilityToggler(signInPasswordId)">
                        </div>

                        <input type="submit" value="Sign In" name="btn" id="signInButtonId" >
                    </form>
                </div>

                <a href="passwordRecovery.php" name="fp"> Forgot Password? </a>
                <a href="signUp.php"> Don't have account? </a>
            </div>
        </div>
    </div>

    <script>
        var userType = "Tenant";
        var ele1 = document.getElementById('userTypeSlider');

        signInValidation = (receivedMsg) => {
            // success or fail determination

            // document.getElementById('signInUserMsg').innerHTML = "Success";
            document.getElementById('signInUserMsg').style = "display:block; color:green";

            // document.getElementById('signInUserMsg').innerHTML = "fail";
            document.getElementById('signInUserMsg').style = "display:block; color:red";
            document.getElementById('signInUserMsg').innerHTML = receivedMsg;
        }

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
    <script src="../Javascript/commonJs.js"></script>
</body>

</html>

<?php
    if(isset($_POST['btn'])){
        $role = ucfirst($_POST['role']);
        $email = strtolower($_POST['email']);
        $password = md5($_POST['password']);        
        //Declaring Query
        $sql = "SELECT `role`, `email`, `password` FROM tbl_to";
        //Operating Query
        $res = mysqli_query($conn, $sql);
        //Checking Operation
        if($res == true){
            //Query Operated Successfully
            $chk = false;
            while($str = mysqli_fetch_array($res)){
                if($str[0] == $role && $str[1] == $email && $str[2] == $password){
                    $sqlMax = "SELECT MAX(`to_id`) AS 'Thulo' FROM `tbl_to`";
                    $resMax = mysqli_query($conn, $sqlMax);
                    $max = mysqli_fetch_array($res);
                    $_SESSION['online'] = $max[0];
                    if($role == "Owner"){
                        $_SESSION['ownerComment'] = "<span class='success'><center><b>Sign In Successfull</b></center></span>";
                        ?> 
                        <script>
                            location.replace("http://localhost/fmh/html/homelandlord.php");
                        </script>
                        <?php
                    }
                    elseif($role == "Tenant"){
                        $_SESSION['tenantComment'] = "<span class='success'><center><b>Sign In Successfull</b></center></span>";
                        ?> 
                        <script>
                            location.replace("http://localhost/fmh/html/homeTenant1.php");
                        </script>
                        <?php
                    }
                    $chk = true;
                    break;
                }
            }
            if($chk == false){
                ?> 
                <script>
                    signInValidation("<span class='fail'><b>Something is mismatched !!! Please try again</b><br></span>");
                </script>
                <?php
            }
        }
        else{
            //Failed to Opereate Query
            ?> 
            <script>
                signInValidation("<span class='fail'><b>Error while executing query..</b><br></span>");
            </script>
            <?php
        }

    }
?>