<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Home : Tenant 2 </title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/roomTenant.css">
    <link rel="stylesheet" href="../CSS/pageNumber.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/seeMoreTenant.css">
    <link rel="stylesheet" href="../CSS/homeTenant2.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">
</head>

<body>
    <!-- navigation bar -->
    <!-- <?php include 'navbarLandlord.php';?> -->
    <nav class="navbar"> </nav>

    <!-- Google map -->
    <div class="mapContaineerClass">
        <div class="mapAreaClass">
            <div id="map"></div>
            <input type="hidden" id="lat" name="lat" value="Latitude">
            <input type="hidden" id="lng" name="lng" value="Longitude">
        </div>

        <div class="mapFilterClass">
            <div class="weather loading" id="weather">
                <div class="city" id="city">
                    <div class="city_name" id="city_name">
                        <h2 class="city" id="city_n">
                            <center></center>
                        </h2>
                    </div>

                    <img src="" alt="." class="icon" id="icon">

                    <span class="temp" id="temp"></span>

                    <div class="city_info" id="city_info">
                        <div class="description" id="description"></div>
                        <hr>
                        <div class="humidity" id="humidity"></div>
                        <div class="pressure" id="pressure"></div>
                        <div class="lat" id="latt"></div>
                        <div class="lon" id="lon"></div>
                        <div class="wind" id="wind"></div>
                        <div class="dt">
                            <span class="time" id="date">
                                <script>
                                    let current = new Date();
                                    document.getElementById('date').innerHTML = "Date: " + current.toLocaleDateString();
                                </script>
                            </span>
                            ||
                            <span class="time" id="time">
                                <script>
                                    setInterval(() => {
                                        let current = new Date();
                                        document.getElementById('time').innerHTML = "Time: " + (current.toLocaleTimeString());
                                    }, 1000);
                                </script>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <a href="homeTenant1.html"> Use normal filter </a>
            <input type="number" placeholder="Enter range in km.." id="range">
            <input type="submit" value="Check" onclick="get(document.getElementById('range').value)">
        </div>
    </div>

    <!-- main body area : room details appear here -->
    <div class="articleHomeTenant">
        <h3>Available Room Details</h3>
        <div id="roomContaineer">
            <div class="roomBox">
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
                        <abbr title="Add to wishlist">
                            <img src="../Assests/favorite.png" alt="" id="wishlistIcon"
                                onclick="alert('Added to wishlist')">
                        </abbr>
                    </div>
                </div>
            </div>

            <div class="roomBox"></div>
            <div class="roomBox"></div>
            <div class="roomBox"></div>
            <div class="roomBox"></div>
            <div class="roomBox"></div>
            <div class="roomBox"></div>
            <div class="roomBox"></div>
            <div class="roomBox"></div>
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

    <!-- see more section -->
    <!-- dark background -->
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

                <input type="submit" value="Submit Rating" name="submit_rating" id="submitRatingButton">
            </div>
        </div>
    </div>


    <!-- user option menu -->
    <div class="userOptionMenu" id="userMenuBox">
        <ul>
            <a href="profileTenant.html">
                <li>My Profile </li>
            </a>
            <a href="signIn.html">
                <li>Sign In</li>
            </a>
        </ul>
    </div>

    <!-- extented user menu : common -->
    <!-- <?php include 'extentedMenuLandlord.php';?> -->
    <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside>

    <!-- common social-share section -->
    <!-- <?php include 'commonsocialshare.php';?> -->
    <div class="socialMainContaineer"> </div>

    <!-- common footer -->
    <!-- <?php include 'commonFooter.php';?> -->
    <footer class="footerbar"> </footer>

    <!-- javascript section -->
    <script>
        // functions for toggling the [see-more-containeer]
        closeSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackground').style.visibility = "hidden";
            document.getElementById('seeMoreLandlordContaineerId').style.visibility = "hidden";
        }

        openSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackground').style.visibility = "visible";
            document.getElementById('seeMoreLandlordContaineerId').style.visibility = "visible";
        }

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
    <script src="../Javascript/tenant_common_file_includer.js"></script>
</body>

</html>