<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/pageNumber.css">
    <link rel="stylesheet" href="../CSS/roomTenant.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/seeMoreTenant.css">
    <link rel="stylesheet" href="../CSS/wishlist.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">
</head>

<body>
    <!-- common nav bar -->
    <?php include 'navbarTenant.php' ?>
    <!-- <nav class="navbar"> </nav> -->

    <!-- main body area -->
    <div class="article">
        <h3>Rooms from your wishlist</h3>

        <div id="roomContaineer">
            <!-- <div class="roomBox">
                <div class="roomImage">
                    <img src="../Assests/Image/Architecture (1).jpg" alt="room image">
                </div>

                <div class="roomInfo">
                    <div class="roomDetail">
                        <div class="roomDetailAtom">
                            <div class="roomTitles">
                                <p class="roomTitle">BHK</p>
                            </div>
                            <div class="roomDescriptions">
                                <p class="roomDescription">1</p>
                            </div>
                        </div>

                        <div class="roomDetailAtom">
                            <div class="roomTitles">
                                <p class="roomTitle">Floor</p>
                            </div>
                            <div class="roomDescriptions">
                                <p class="roomDescription">8</p>
                            </div>
                        </div>

                        <div class="roomDetailAtom">
                            <div class="roomTitles">
                                <p class="roomTitle">Price</p>
                            </div>
                            <div class="roomDescriptions">
                                <p class="roomDescription">Rs. 47,000</p>
                            </div>
                        </div>

                        <div class="roomDetailAtom">
                            <div class="roomTitles">
                                <p class="roomTitle">Rating</p>
                            </div>
                            <div class="roomDescriptions">
                                <p class="roomDescription">4.5</p>
                            </div>
                        </div>

                        <div class="roomDetailAtom">
                            <div class="roomTitles">
                                <p class="roomTitle">Location</p>
                            </div>
                            <div class="roomDescriptions">
                                <p class="roomDescription">Anamnagar-3</p>
                            </div>
                        </div>
                    </div>

                    <div class="roomButton">
                        <div class="roomButtonB">
                            <input type="submit" value="More" id="seeMore" onclick="openSeeMoreFunction()">
                        </div>
                    </div>

                    <div id="wishlistBox">
                        <abbr title="Remove from wishlist">
                            <img src="../Assests/remove.png" alt="" id="wishlistIcon" onclick="showNotification('Room removed from your wishlist')">
                        </abbr>
                    </div>
                </div>
            </div> -->
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
            <?php include('wish.php');?>
        </div>

        <!-- page changer section -->
        <div id="pageChanger">
            <div class="pageAlternators" id="previousPage">
                <abbr title="Load previous"> <img src="../Assests/previous.png" alt="previous.png"> </abbr>
            </div>

            <!-- can contain multiple ids -->
            <div id="pageNumberContaineer">
                <div class="pageNumber" id="currentPageNumber">
                    <p>01</p>
                </div>

                <!-- duplicated sections -->
                <div class="pageNumber">
                    <p>02</p>
                </div>

                <div class="pageNumber">
                    <p>03</p>
                </div>

                <div class="pageNumber">
                    <p>04</p>
                </div>
            </div>

            <div class="pageAlternators" id="nextPage">
                <abbr title="Load next"> <img src="../Assests/next.png" alt="next.png"> </abbr>
            </div>
        </div>
    </div>

    <!-- user option menu -->
    <div class="userOptionMenu" id="userMenuBox">
        <ul>
            <a href="profileTenant.php">
                <li>My Profile </li>
            </a>
            <a href="signIn.php">
                <li>Sign In</li>
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

    <!-- background -->
    <div class="seeMoreDarkBackground" id="seeMoreDarkBackground"> </div>

    <!-- showing room details using See More -->
    <div class="seeMoreLandlordContaineer" id="seeMoreLandlordContaineerId">
        <abbr title="close">
            <p id="closeSeeMore" onclick="closeSeeMoreFunction()">&times;</p>
        </abbr>

        <div class="seeMoreImageSection">
            <div class="seeMoreImageSectionUp">
                <img src="../Assests/Image/Architecture (1).jpg" alt="Room image" id="seeMoreActiveImage">
            </div>

            <div class="seeMoreImageSectionDown">
                <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(1)">
                    <img src="../Assests/Image/Architecture (1).jpg" alt="first image" id="seeMoreFirstImage">
                </div>

                <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(2)">
                    <img src="../Assests/Image/Architecture (2).jpg" alt="second image" id="seeMoreSecondImage">
                </div>

                <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(3)">
                    <img src="../Assests/Image/Architecture (3).jpg" alt="third image" id="seeMoreThirdImage">
                </div>

                <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(4)">
                    <img src="../Assests/Image/Architecture (4).jpg" alt="fourth image" id="seeMoreFourthImage">
                </div>
            </div>
        </div>

        <div id="detailContaineer">
            <div id="detailSection">
                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Room Type</p>
                    <p class="seeMoreDescription">Flat</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">BHK</p>
                    <p class="seeMoreDescription">2</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Room Size</p>
                    <p class="seeMoreDescription">Large</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Floor</p>
                    <p class="seeMoreDescription">5</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Furnishing</p>
                    <p class="seeMoreDescription">Fully Furnished</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Address</p>
                    <p class="seeMoreDescription">Anamnagar, Kathmandu</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Services</p>
                    <p class="seeMoreDescription">Internet, TV, Drinking Water</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Price</p>
                    <p class="seeMoreDescription">Rs. 59,000</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Rent Type</p>
                    <p class="seeMoreDescription">Monthly</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Rating</p>
                    <p class="seeMoreDescription">3.8</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Required Marital Status</p>
                    <p class="seeMoreDescription">Married</p>
                </div>

                <div class="detailSectionAtom">
                    <p class="seeMoreTitle">Additional Note</p>
                    <p class="seeMoreDescription" style="height:100px; overflow:hidden">Additional notes about the
                        room..
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit possimus a vel accusamus,
                        explicabo error nihil et natus omnis libero assumenda, rerum dolorum odio placeat velit fuga
                        quod delectus quis?
                    </p>
                </div>

                <div class="ratingSection">
                    <div class="ratingLabelSection">
                        <p>Rate this room</p>
                    </div>

                    <div class="ratingSelect">
                        <select name="" id="" id="rating">
                            <option value="" selected hidden>Rate the room</option>
                            <option value="0"> 0 </option>
                            <option value="0.5"> 0.5 </option>
                            <option value="1"> 1 </option>
                            <option value="1.5"> 1.5 </option>
                            <option value="2"> 2 </option>
                            <option value="2.5"> 2.5 </option>
                            <option value="3"> 3 </option>
                            <option value="3.5"> 3.5 </option>
                            <option value="4"> 4 </option>
                            <option value="4.5"> 4.5 </option>
                            <option value="5"> 5 </option>
                        </select>
                    </div>
                </div>

                <input type="submit" value="Submit Rating" name="submit_rating" id="submitRatingButton" onclick="showNotification('Rating submitted')">
            </div>
        </div>
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
    <?php include 'extentedMenuLandlord.php'; ?>
    <!-- <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside> -->

    <!-- common social-share section -->
    <?php include 'socialshare.php'; ?>
    <!-- <div class="socialMainContaineer"> </div> -->

    <!-- common footer -->
    <?php include 'footer.php'; ?>
    <!-- <footer class="footerbar"> </footer> -->

    <!-- javascript section -->
    <script>
        closeSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackground').style = "visibility:hidden";
            document.getElementById('seeMoreLandlordContaineerId').style = "visibility:hidden";
        }

        openSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackground').style = "visibility:visible";
            document.getElementById('seeMoreLandlordContaineerId').style = "visibility:visible";
        }

        // changinf the images
        // changing see more >> image
        changeSeeMoreImage = (image_number) => {
            var target_id = document.getElementById('seeMoreActiveImage');
            var active_image;

            if (image_number == 1) {
                active_image = document.getElementById('seeMoreFirstImage');
                target_id.src = active_image.src;
            } else if (image_number == 2) {
                active_image = document.getElementById('seeMoreSecondImage');
                target_id.src = active_image.src;
            } else if (image_number == 3) {
                active_image = document.getElementById('seeMoreThirdImage');
                target_id.src = active_image.src;
            } else {
                active_image = document.getElementById('seeMoreFourthImage');
                target_id.src = active_image.src;
            }
        }
    </script>
    <!-- linking javascript files -->
    <script src="../Javascript/commonJs.js"></script>
    <!-- <script src="../Javascript/tenant_common_file_includer.js"></script> -->
</body>

</html>