<?php include("include.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Tenant</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/profile.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">
</head>

<body>
    <!-- common nav bar -->
    <?php include 'navbarTenant.php';?>
    <!-- <nav class="navbar"> </nav> -->

    <?php 
        $sql = "SELECT * FROM `tbl_to` WHERE `to_id` = 1";
        $res = mysqli_query($conn, $sql);
        $getRows = mysqli_num_rows($res);
        if($getRows != 0){
            $fetchedData = mysqli_fetch_assoc($res);
            ?>
                <!-- main body area -->
                <div class="containeer">
                    <div class="userDetailImageClass">
                        <img src="<?php echo $fetchedData['dp']?>" alt="" id="userImageId">
                        <a href="#">Change Profile Picture</a>
                    </div>
                    <hr>
                    
                    <div class="userDetailMainClass">
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Username</p>
                            <p class="userDescriptionClass" id="username">: <?php echo $fetchedData['name']?></p>
                        </div>

                        <div class="userDetailClass">
                            <p class="userDetailTitle">Gender</p>
                            <p class="userDescriptionClass" id="gender">: <?php echo $fetchedData['gender']?></p>
                        </div>

                        <div class="userDetailClass">
                            <p class="userDetailTitle">Date of Birth</p>
                            <p class="userDescriptionClass" id="dob">: <?php echo $fetchedData['dob']?></p>
                        </div>
                        
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Marital Status</p>
                            <p class="userDescriptionClass" id="maritalStatus">: <?php echo $fetchedData['marital_status']?></p>
                        </div>

                        <div class="userDetailClass">
                            <p class="userDetailTitle">Address</p>
                            <p class="userDescriptionClass" id="address">: <?php echo $fetchedData['address']?></p>
                        </div>
                        
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Contact</p>
                            <p class="userDescriptionClass" id="contact">: <?php echo $fetchedData['phone']?></p>
                        </div>
                        
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Email Address</p>
                            <p class="userDescriptionClass" id="email">: <?php echo $fetchedData['email']?></p>
                        </div>

                    </div>

                    <div class="detailManipulationSection">
                        <input type="submit" value="Edit Details" id="editProfileBtn">
                        <a href="#" id="accountDeletion" onclick="showNotification('Your account has been successfully deleted.')">Permanently delete account</a>
                    </div>
                </div>
            
            <?php

        }
        else{
            // no data found
            ?>
                <!-- main body area -->
                <div class="containeer">
                    <div class="userDetailImageClass">
                        <img src="../Assests/dp.jpg" alt="" id="userImageId">
                        <a href="#">Change Profile Picture</a>
                    </div>
                    <hr>
                    
                    <div class="userDetailMainClass">
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Username</p>
                            <p class="userDescriptionClass" id="username">xxx</p>
                        </div>

                        <div class="userDetailClass">
                            <p class="userDetailTitle">Gender</p>
                            <p class="userDescriptionClass" id="gender">xxx</p>
                        </div>

                        <div class="userDetailClass">
                            <p class="userDetailTitle">Date of Birth</p>
                            <p class="userDescriptionClass" id="dob">xxx</p>
                        </div>
                        
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Marital Status</p>
                            <p class="userDescriptionClass" id="maritalStatus">xxx</p>
                        </div>

                        <div class="userDetailClass">
                            <p class="userDetailTitle">Address</p>
                            <p class="userDescriptionClass" id="address">xxx</p>
                        </div>
                        
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Contact</p>
                            <p class="userDescriptionClass" id="contact">xxx</p>
                        </div>
                        
                        <div class="userDetailClass">
                            <p class="userDetailTitle">Email Address</p>
                            <p class="userDescriptionClass" id="email">xxx</p>
                        </div>

                    </div>

                    <div class="detailManipulationSection">
                        <input type="submit" value="Edit Details" id="editProfileBtn">
                        <a href="#" id="accountDeletion" onclick="showNotification('Your account has been successfully deleted.')">Permanently delete account</a>
                    </div>
                </div>
            <?php
        }
    ?>

    <!-- user option menu -->
    <div class="userOptionMenu" id="userMenuBox">
        <ul>
            <a href="profileTenant.php">
                <li>My Profile </li>
            </a>
            <a href="signIn.php">
                <li>Sign In/ Sign Out</li>
            </a>
        </ul>
    </div>

    <!-- notification section -->
    <div class="notificationContaineer" id="notificationContaineerId">
        <div class="notificationCloseSection">
            <p id="closeNotification" onclick="closeNotification()">&times;</p>
        </div>
    
        <div class="notificationTextSection">
            <p id="notificationText">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum laborum
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum laborum
            </p>
        </div>
    </div>

    <!-- extented user menu : common -->
    <?php include 'extentedMenuTenant.php';?>
    <!-- <div class="socialMainContaineer"> </div> -->

    <!-- common social-share section -->
    <?php include 'socialshare.php';?>
    <!-- <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside> -->

    <!-- common footer -->
    <?php include 'footer.php';?>
    <!-- <footer class="footerbar"> </footer> -->

    <!-- js section -->
    <script> </script>

    <!-- linking to external js file -->
    <script src="../Javascript/commonJs.js"></script>
    <!-- <script src="../Javascript/tenant_common_file_includer.js"></script> -->
</body>

</html>