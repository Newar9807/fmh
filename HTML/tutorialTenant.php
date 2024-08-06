<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tutorial Tenant</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/tutorial.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">
</head>

<body>
    <!-- navigation bar -->
    <?php include 'navbarTenant.php';?>
    <!-- <nav class="navbar"> </nav> -->

    <!-- main body area -->
    <div id="videoPlayer">
        <div id="videoHeading">
            <div>
                <h3 id="videoTitle">Tutorial Title</h3>
            </div>

            <div>
                <p id="closeVideo" onclick="closeTutorial()">&times;</p>
            </div>
        </div>

        <video id="videoId" controls>
            <source src="../Assests/Tutorials/tutorial (1).mp4" type="video/mp4">
        </video>
    </div>

    <!-- tutorial containeer -->
    <div id="tutorialMaincontaineer">
        <h3>Tutorials</h3>
        <div id="tutorialContaineer">
            <div class="tutorialBox">
                <div class="tutorialThumbnail">
                    <img src="../Assests/Image/Architecture (1).jpg" alt="Tutorial thumbnail">
                </div>

                <div class="tutorialDescription">
                    <h3 id="videoTitleId">How to add room</h3>
                    <p id="videoDescriptionId">
                        Lorem ipsum dolor sit amet a asr consectetur adipisicing elit. Gerty Molestiae quo ex
                        quia fugiat lout minus beatae
                    </p>
                </div>

                <div class="tutorialButton">
                    <input type="button" value="Learn More" id="learnMoreButton" onclick="playTutorial()">
                </div>
            </div>

            <div class="tutorialBox"></div>
            <div class="tutorialBox"></div>
            <div class="tutorialBox"></div>
            <div class="tutorialBox"></div>
            <div class="tutorialBox"></div>
            <div class="tutorialBox"></div>
            <div class="tutorialBox"></div>
        </div>
    </div>
    

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

    <!-- sign in/ sign out section -->
    <div class="signOutConfirmationContaineer" id="signOutConfirmationContaineerId">
        <div class="signOutHeading">
            <h4>Are you sure you want to sign out?</h4>
        </div>

        <div class="signOutButton">
            <input type="submit" value="Yes">
            <input type="submit" value="No" onclick="closeSignOut()">
        </div>
    </div>


    <!-- extented user menu : common -->
    <!-- <?php include 'extentedMenuLandlord.php';?> -->
    <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside>

    <!-- common social-share section -->
    <!-- <?php include 'socialshare.php';?> -->
    <div class="socialMainContaineer"> </div>

    <!-- common footer -->
    <?php include 'footer.php';?> 
    <!-- <footer class="footerbar"> </footer> -->

    <!-- scripts -->
    <script>
        playTutorial = () => {
            document.getElementById('videoPlayer').style = "display:block";
            document.getElementById('videoId').play();
        }

        closeTutorial = () => {
            document.getElementById('videoPlayer').style = "display:none";
            document.getElementById('videoId').pause();
            document.getElementById('videoId').currentTime = 0;
        }
    </script>

    <!-- linking javasript files -->
    <script src="../Javascript/commonJs.js"></script>
    <!-- <script src="../Javascript/tenant_common_file_includer.js"></script> -->
</body>

</html>