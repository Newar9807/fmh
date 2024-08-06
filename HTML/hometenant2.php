<?php include("include.php");?>

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
    <style>
        .img_btn{
            cursor: pointer;
            background-color: transparent;
            border: 0;
        }
    </style>
</head>

<body>
    <!-- navigation bar -->
    <?php include 'navbarTenant.php';?>
    <!-- <nav class="navbar"> </nav> -->

    <!-- Google map -->
    <div class="mapContaineerClass">
        <div class="mapAreaClass">
            <div id="map">Map</div>
            <input type="hidden" id="lat" name="lat" value="Latitude">
            <input type="hidden" id="lng" name="lng" value="Longitude">
        </div>

        <div class="mapFilterClass">
            <div class="weather loading" id="weather">
                <div class="city" id="city">
                    <div class="city_name" id="city_name">
                        <h2 class="city" id="city_n">
                            <!-- <center></center> -->
                        </h2>
                    </div>
                    <hr style="margin-top: 10px;" id="hr_line">

                    <div class="weather-div">
                        <img src="" alt="." class="icon" id="icon">
                        <span class="temp" id="temp"></span>
                    </div>

                    <div class="city_info" id="city_info">
                        <div class="description city_info_content" id="description"></div>

                        <div class="humidity city_info_content" id="humidity"></div>
                        <div class="pressure city_info_content" id="pressure"></div>
                        <div class="lat city_info_content" id="latt"></div>
                        <div class="lon city_info_content" id="lon"></div>
                        <!-- <div class="wind" id="wind"></div> -->
                    </div>
                </div>
            </div>

            <a href="homeTenant1.php"> Use normal filter </a>
            <form action="" method="post" id="filterForm">
                <input type="text" placeholder="Location.." id="location">
                <input type="number" name="range" placeholder="Enter range in km.." id="range">            
                <input type="submit" name="submit" value="Check" onclick="get(document.getElementById('range').value)">
                <input type="hidden" name="lat" id="hiddenLat" value="">
                <input type="hidden" name="lon" id="hiddenLon" value="">
            </form>
        </div>
    </div>

    
    <?php
        if(isset($_POST['submit'])){
            if($_POST['range'] == ""){
                // Please enter the range
            }
            else{
                $sql = "SELECT latitude, longitude, r_id FROM tbl_room";
                $res = mysqli_query($conn, $sql);
                $getRows = mysqli_num_rows($res);
                if($getRows == 0){
                    // No Data Found
                    ?>
                    <!-- main body area : room details appear here -->
                    <div class="articleHomeTenant">
                    <h3>Sorry, Room cannot be found in this range</h3>
                    <?php
                }
                else{
                    ?>
                    <!-- main body area : room details appear here -->
                    <div class="articleHomeTenant">
                    <h3>Available Room Details</h3>
                    <div id="roomContaineer">
                    <!-- Fetches the room details from database -->
                    <?php
                    while($getData = mysqli_fetch_array($res)){
                        if($getData[0] == "Error" || $getData[1] == "Error" || $getData[0] == "" || $getData[1] == "" ){
                            continue;
                        }
                        $getRange = returnRange($_POST['lat'], $_POST['lon'], $getData[1], $getData[0]);
                        if($getRange <= $_POST['range']){
                            $id = $getData[2];
                            // $r_sql= "SELECT * FROM `tbl_room`";
                            $r_sql= "SELECT * FROM `tbl_room` WHERE `r_id` = $id";
                            $r_res = mysqli_query($conn, $r_sql) or die(mysqli_close($conn));            

                            if($r_res == true){
                                //Query executed successfully
                                while($rows = mysqli_fetch_assoc($r_res)){
                                ?> 
                                    <div class="roomBox">
                                        <div class="roomImage">
                                        <?php
                                            $img_sql = "SELECT `image` FROM `tbl_img` WHERE `r_id` = $id";
                                            $img_res = mysqli_query($conn, $img_sql) or die(mysqli_close($conn));
                                            while($img_rows = mysqli_fetch_array($img_res)){
                                        ?>
                                            <img src="<?php echo $img_rows[0];?>" alt="room_image">

                                        <?php
                                            break;
                                            }
                                        ?>
                                        </div>

                                        <div class="roomInfo">
                                            <div class="roomDetail">
                                                <div class="roomDetailAtom">
                                                    <div class="roomTitles">
                                                        <p class="roomTitle">BHK</p>
                                                    </div>
                                                    <div class="roomDescriptions">
                                                            <p class="roomDescription"><?php echo $rows['bhk'];?></p>
                                                    </div>
                                                </div>

                                                <div class="roomDetailAtom">
                                                    <div class="roomTitles">
                                                        <p class="roomTitle">Floor</p>
                                                    </div>
                                                    <div class="roomDescriptions">
                                                            <p class="roomDescription"><?php echo $rows['floor'];?></p>
                                                    </div>
                                                </div>

                                                <div class="roomDetailAtom">
                                                    <div class="roomTitles">
                                                        <p class="roomTitle">Price</p>
                                                    </div>
                                                    <div class="roomDescriptions">
                                                            <p class="roomDescription">Rs. <?php echo $rows['price'];?></p>
                                                    </div>
                                                </div>

                                                <div class="roomDetailAtom">
                                                    <div class="roomTitles">
                                                        <p class="roomTitle">Location</p>
                                                    </div>
                                                    <div class="roomDescriptions">
                                                            <p class="roomDescription"><?php echo $rows['location'];?></p>
                                                    </div>
                                                </div>

                                                <div class="roomDetailAtom">
                                                    <div class="roomTitles">
                                                        <p class="roomTitle">Rating</p>
                                                    </div>
                                                    <div class="roomDescriptions">
                                                            <p class="roomDescription"><?php echo $rows['rating'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="" method="post">
                                                <div class="roomButton">
                                                    <div class="roomButtonB">
                                                        <input type="submit" value="More" id="seeMore" name="seeMore">
                                                        <input type="hidden" value="<?php echo $rows['r_id'];?>" name="room_id">
                                                    </div>
                                                </div>

                                                <div id="wishlistBox">
                                                    <abbr title="Add to wishlist">
                                                        <?php
                                                            $detectWishSql = "SELECT `r_id` FROM `tbl_wishlist` WHERE `to_id` = 1";
                                                            $detectWishRes = mysqli_query($conn, $detectWishSql);
                                                            $checkRowSql = mysqli_num_rows($detectWishRes);
                                                            if($checkRowSql != 0){
                                                                $fetchWishRoom = mysqli_fetch_all($detectWishRes);
                                                                $roomCheck = false;
                                                                for($i = 0; $i < count($fetchWishRoom); $i++){
                                                                    if($rows['r_id'] == $fetchWishRoom[$i][0]){
                                                                        ?>
                                                                            <button class="img_btn" name="addToWishlist"><img src="../Assests/redheart.png" alt="" id="wishlistIcon"></button>
                                                                        <?php
                                                                        $roomCheck = true;
                                                                        break;
                                                                    }
                                                                }
                                                                if($roomCheck === false){
                                                                    ?>
                                                                        <button class="img_btn" name="addToWishlist"><img src="../Assests/favorite.png" alt="" id="wishlistIcon"></button>
                                                                    <?php
                                                                }
                                                            }
                                                            else{
                                                                // No Data Found
                                                                ?>
                                                                    <button class="img_btn" name="addToWishlist"><img src="../Assests/favorite.png" alt="" id="wishlistIcon"></button>
                                                                <?php
                                                            }
                                                        ?>
                                                        
                                                    </abbr>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        }
                    }
                    ?></div><?php
                }
            } 
        }
        else{
                // $r_sql= "SELECT * FROM `tbl_room`";
                $r_sql= "SELECT * FROM `tbl_room` ORDER BY `r_id` DESC";
                $r_res = mysqli_query($conn, $r_sql) or die(mysqli_close($conn));
                $r_row_count = mysqli_num_rows($r_res);
                if($r_row_count != 0){
            ?>
                <!-- main body area -->
                <!-- <article> -->
                <div class="articleHomeTenant">
                <h3 id="avaTitle">Available Room Details</h3>
                <div id="roomContaineer">
                        <?php
                            while($rows = mysqli_fetch_assoc($r_res)){
                                ?> 
                                <!-- Fetches the room details from database -->
                                <div class="roomBox">
                                <div class="roomImage">
                                <?php

                                $id = $rows['r_id'];
                                $img_sql = "SELECT `image` FROM `tbl_img` WHERE `r_id` = $id";
                                $img_res = mysqli_query($conn, $img_sql) or die(mysqli_close($conn));
                                while($img_rows = mysqli_fetch_array($img_res)){
                        ?>
                                <img src="<?php echo $img_rows[0];?>" alt="room_image">
                        <?php
                                break;
                                }
                        ?>
                        </div>

                        <div class="roomInfo">
                            <div class="roomDetail">
                                <div class="roomDetailAtom">
                                    <div class="roomTitles">
                                        <p class="roomTitle">BHK</p>
                                    </div>
                                    <div class="roomDescriptions">
                                        <p class="roomDescription"><?php echo $rows['bhk'];?></p>
                                    </div>
                                </div>

                                <div class="roomDetailAtom">
                                    <div class="roomTitles">
                                        <p class="roomTitle">Floor</p>
                                    </div>
                                    <div class="roomDescriptions">
                                        <p class="roomDescription"><?php echo $rows['floor'];?></p>
                                    </div>
                                </div>

                                <div class="roomDetailAtom">
                                    <div class="roomTitles">
                                        <p class="roomTitle">Price</p>
                                    </div>
                                    <div class="roomDescriptions">
                                        <p class="roomDescription">Rs. <?php echo $rows['price'];?></p>
                                    </div>
                                </div>

                                <div class="roomDetailAtom">
                                    <div class="roomTitles">
                                        <p class="roomTitle">Location</p>
                                    </div>
                                    <div class="roomDescriptions">
                                        <p class="roomDescription"><?php echo $rows['location'];?></p>
                                    </div>
                                </div>

                                <div class="roomDetailAtom">
                                    <div class="roomTitles">
                                        <p class="roomTitle">Rating</p>
                                    </div>
                                    <div class="roomDescriptions">
                                        <p class="roomDescription"><?php echo $rows['rating'];?></p>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                                <div class="roomButton">
                                    <div class="roomButtonB">
                                        <input type="submit" value="More" id="seeMore" name="seeMore">
                                        <input type="hidden" value="<?php echo $rows['r_id'];?>" name="room_id">
                                    </div>
                                </div>

                                <div id="wishlistBox">
                                    <abbr title="Add to wishlist">
                                        <?php
                                            $detectWishSql = "SELECT `r_id` FROM `tbl_wishlist` WHERE `to_id` = 1";
                                            $detectWishRes = mysqli_query($conn, $detectWishSql);
                                            $checkRowSql = mysqli_num_rows($detectWishRes);
                                            if($checkRowSql != 0){
                                                $fetchWishRoom = mysqli_fetch_all($detectWishRes);
                                                $roomCheck = false;
                                                for($i = 0; $i < count($fetchWishRoom); $i++){
                                                    if($rows['r_id'] == $fetchWishRoom[$i][0]){
                                                        ?>
                                                            <button class="img_btn" name="addToWishlist"><img src="../Assests/redheart.png" alt="" id="wishlistIcon"></button>
                                                        <?php
                                                        $roomCheck = true;
                                                        break;
                                                    }
                                                }
                                                if($roomCheck === false){
                                                    ?>
                                                        <button class="img_btn" name="addToWishlist"><img src="../Assests/favorite.png" alt="" id="wishlistIcon"></button>
                                                    <?php
                                                }
                                            }
                                            else{
                                                // No Data Found
                                                ?>
                                                    <button class="img_btn" name="addToWishlist"><img src="../Assests/favorite.png" alt="" id="wishlistIcon"></button>
                                                <?php
                                            }
                                        ?>
                                    </abbr>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php
        }
    }

        function returnRange($latitudeFrom, $longitudeFrom, $longitudeTo, $latitudeTo){
            $longitudeFrom = (float)$longitudeFrom;
            $latitudeFrom = (float)$latitudeFrom;
            $longitudeTo = (float)$longitudeTo;
            $latitudeTo = (float)$latitudeTo;
            $long1 = deg2rad($longitudeFrom);
            $long2 = deg2rad($longitudeTo);
            $lat1 = deg2rad($latitudeFrom);
            $lat2 = deg2rad($latitudeTo);

            $dlong = $long2 - $long1;
            $dlat = $lat2 - $lat1;

            return(6371 * 2 * asin(sqrt(pow(sin($dlat/2),2) + cos($lat1) * cos($lat2) * pow(sin($dlong/2),2))));
        }
    ?>
    

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

    <!-- See More -->
    <?php if(isset($_POST['seeMore'])){ ?>
        <!-- background -->
        <div class="seeMoreDarkBackground" id="seeMoreDarkBackground" style="visibility: visible"> </div>

        <!-- showing room details using See More -->
        <div class="seeMoreLandlordContaineer" id="seeMoreLandlordContaineerId" style="visibility: visible">
            <abbr title="close">
                <p id="closeSeeMore" onclick="closeSeeMoreFunction()">&times;</p>
            </abbr>

        <?php
            $room_id = $_POST['room_id'];          
            $md_r_sql = "SELECT * FROM `tbl_room` WHERE `r_id` = $room_id";                
            $coun_img = 0;
            $md_r_res = mysqli_query($conn, $md_r_sql) or die(mysqli_close($conn));

            while($md_r_rows = mysqli_fetch_assoc($md_r_res)){
        ?>                
                <!-- <div class="seeMoreBasicSection"> -->
            <div class="seeMoreImageSection">
                <div class="seeMoreImageSectionUp">                
                    <?php
                        $md_img_sql = "SELECT `image` FROM `tbl_img` WHERE `r_id` = $room_id";
                        $md_img_res = mysqli_query($conn, $md_img_sql);
                        $md_img_rows_count = mysqli_num_rows($md_img_res);
                        // while($md_img_rows = mysqli_fetch_array($md_img_res)){
                        $md_img_rows = mysqli_fetch_all($md_img_res);
                            if(($md_img_rows_count > 0)){
                    ?>
                                <img src="<?php echo $md_img_rows[0][0];?>" alt="roomImage" id="seeMoreActiveImage">
                    <?php
                            }
                            else{
                    ?>
                                <img src="../Assests/Image/Architecture (1).jpg" alt="roomImage" id="seeMoreActiveImage">
                    <?php
                            }
                    ?>
                </div>

                <div class="seeMoreImageSectionDown">
                    <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(1)">
                        <?php
                                if(($md_img_rows_count > 0)){
                        ?>
                                    <img src="<?php echo $md_img_rows[0][0];?>" alt="first image" id="seeMoreFirstImage">
                        <?php
                                }
                                else{
                        ?>
                                    <img src="../Assests/Image/noImage.jpg" alt="first image" id="seeMoreFirstImage">
                        <?php
                                }
                        ?>
                    </div>

                    <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(2)">
                        <?php
                                if(($md_img_rows_count > 1)){
                        ?>
                                    <img src="<?php echo $md_img_rows[1][0];?>" alt="second image" id="seeMoreSecondImage">
                        <?php
                                }
                                else{
                        ?>
                                    <img src="../Assests/Image/noImage.jpg" alt="second image" id="seeMoreSecondImage">
                        <?php
                                }
                        ?>
                    </div>

                    <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(3)">
                        <?php
                                if(($md_img_rows_count > 2)){
                        ?>
                                    <img src="<?php echo $md_img_rows[2][0];?>" alt="third image" id="seeMoreThirdImage">
                        <?php
                                }
                                else{
                        ?>
                                    <img src="../Assests/Image/noImage.jpg" alt="third image" id="seeMoreThirdImage">
                        <?php
                                }
                        ?>
                    </div>

                    <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(4)">
                        <?php
                                if(($md_img_rows_count > 3)){
                        ?>
                                    <img src="<?php echo $md_img_rows[3][0];?>" alt="fourth image" id="seeMoreFourthImage">
                        <?php
                                }
                                else{
                        ?>
                                    <img src="../Assests/Image/noImage.jpg" alt="fourth image" id="seeMoreFourthImage">
                        <?php
                                }
                            // }
                        ?>
                    </div>
                </div>
            </div>

            <div id="detailContaineer">
                <div id="detailSection">
                    <div class="detailSectionAtom">
                        <?php
                            $foreign_key = $md_r_rows['f_id'];
                            $md_to_sql = "SELECT * FROM `tbl_to` WHERE `to_id` = $foreign_key";
                            $md_to_res = mysqli_query($conn, $md_to_sql);
                            $md_to_rows = mysqli_fetch_assoc($md_to_res);
                        ?>
                        <p class="seeMoreTitle">Room Type</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['type'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">BHK</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['bhk'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Room Size</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['roomSize'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Floor</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['floor'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Furnishing</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['furnishing'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Address</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['location'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Services</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['services'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Price</p>
                        <p class="seeMoreDescription">: Rs. <?php echo $md_r_rows['price'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Rent Type</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['per']."ly";?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Rating</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['rating'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Required Marital Status</p>
                        <p class="seeMoreDescription">: <?php echo $md_to_rows['marital_status'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Additional Note</p>
                        <p class="seeMoreDescription" style="height:100px; overflow:hidden">: <?php echo $md_to_rows['note'];?></p>
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

                    <input type="submit" value="Submit Rating" name="submit_rating" id="submitRatingButton" onclick="showNotification('Rating has been submitted.')">
                </div>
            </div>
        </div>
        <?php
            }
        }
    ?>

    <!-- Wish List -->
    <?php if(isset($_POST['addToWishlist'])){ ?>
        <!-- <script>
            if(document.getElementById('addToWishlist').style.backgroundColor == '#515151'){
                document.getElementById('addToWishlist').style.backgroundColor = '#FF4045';
            }else{
                document.getElementById('addToWishlist').style.backgroundColor = '#515151';
            }
        </script> -->
        <?php
            $room_id = $_POST['room_id'];
            $tenant_id = 1; //[Let]
            $stored_wish = "SELECT * FROM `fmh`.`tbl_wishlist` WHERE `to_id` = $tenant_id";
            $stored_wish_res = mysqli_query($conn, $stored_wish) or die(mysqli_close($conn));
            $wish_chk = false;
            while($stored_wish_rows = (mysqli_fetch_assoc($stored_wish_res))){
                if(($stored_wish_rows['r_id'] == $room_id)){                         
                    $wish_chk = true;
                    break;
                }
            }
            if($wish_chk == false){
                $wish_sql = "INSERT INTO `fmh`.`tbl_wishlist`(`to_id`, `r_id`) VALUES ('$tenant_id', '$room_id')";
                $wish_res = mysqli_query($conn, $wish_sql) or die(mysqli_close($conn));
                ?>
                <script>
                    alert("Successfully added to wish list"); 
                    location.href = "/fmh/html/homeTenant2.php";
                </script>                
                <?php
            }
            else{
                $wish_sql = "DELETE FROM `tbl_wishlist` WHERE `to_id` = '$tenant_id' AND `r_id` = '$room_id'";
                $wish_res = mysqli_query($conn, $wish_sql) or die(mysqli_close($conn));
                ?>
                <script> 
                    alert("Successfully removed from wish list");
                    location.href = "/fmh/html/homeTenant2.php";
                    </script>                
                <?php
            }
        }
    ?>

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
    <?php include 'extentedMenuLandlord.php';?>
    <!-- <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside> -->

    <!-- common social-share section -->
    <?php include 'socialshare.php';?>
    <!-- <div class="socialMainContaineer"> </div> -->

    <!-- common footer -->
    <?php include 'footer.php';?>
    <!-- <footer class="footerbar"> </footer> -->

    <!-- javascript section -->
    <script>
        // functions for toggling the [see-more-containeer]
        // function closeSeeMoreFunction(){
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
    <!-- <script src="../Javascript/tenant_common_file_includer.js"></script> -->

    <!-- Script to connect API -->
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPeDFdvyDNf8b0BsJLlxM-7sYnp50mNss&callback=initMap"> </script>
    
    <!-- Script for map -->
    <script>
        let y, z, pos;
        function initMap() {
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

            function showPosition(position) {
                y = position.coords.latitude;
                z = position.coords.longitude;
                get(y, z);
                document.getElementById('lat').value = y
                document.getElementById('lng').value = z
            
                var options = {
                    zoom: 14,
                    center: { lat: y, lng: z },
                };
                map = new google.maps.Map(document.getElementById('map'), options);

                marker = new google.maps.Marker({
                    position: { lat: y, lng: z },
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(marker, 'position_changed',
                    function(){
                        window.setTimeout(() => {
                            map.panTo(marker.getPosition());
                        }, 10);                        
                        y = marker.position.lat();
                        z = marker.position.lng();
                        get(y, z);                    
                        document.getElementById('lat').value = y
                        document.getElementById('lng').value = z
                    }
                )
                
                google.maps.event.addListener(map, 'click',
                    function(event){
                        pos = event.latLng
                        marker.setPosition(pos)                        
                        map.setZoom(15);
                    }
                )                                 
            }                              
        }
    
    // Script to fetch weather info
    
        async function get (range){
            let get_lat = document.getElementById('lat').value,
            get_lng = document.getElementById('lng').value;
            // get_lat = 
                

            // // let appKey = "cbef622b2e9e8789be0f54104c36483f";
            // let appKey = "bdcb5525200245816b639037cce9b2c7";
            // //Retriving the weather of given location
            // let response = await fetch("https://api.openweathermap.org/data/2.5/weather?q="
            // + city 
            // +",NP&units=metric&lang=en&appid="
            // + appKey
            // );   
            // // let response = await fetch("https://geocoder.ls.hereapi.com/6.2/geocoder.json?seatchtext="+city+"&gen=9&apiKey="+appKey);
            // let jsonResponse = await response.json();
            // //Filters whether provided location exists or not
            // if(response.ok){ 
            //     // //Fetching data from json
            //     const name = city.toUpperCase();
            //     const {lon, lat} = jsonResponse.coord;              
            //     // //Passing Info. to frontend
            //     document.getElementById("city_n").innerHTML = "Weather In <br>" + name ;
            //     document.getElementById("icon").src = "https://openweathermap.org/img/wn/" + icon + ".png";
            //     document.getElementById("temp").innerHTML = "  " + temp + "°C";
            //     document.getElementById("description").innerHTML = description.toUpperCase();
            //     document.getElementById("humidity").innerHTML = "Humidity: " + humidity + "%";
            //     document.getElementById("pressure").innerHTML = "Pressure: " + pressure.toLocaleString("en-US") + " Pascal" ;
            //     document.getElementById("wind").innerHTML = "Wind: " + ((speed*1000).toLocaleString("en-US")) + " m/s || " + deg + "°C";        
                // document.getElementById("all").style.height = 'auto';
                // document.getElementById("city_info").style.visibility = 'visible';
            }       

        async function get (lat, lon){
            let appKey = "bdcb5525200245816b639037cce9b2c7";
            let response = await fetch("https://api.openweathermap.org/data/2.5/weather?lat="
            +lat
            +"&lon="
            +lon
            +"&units=metric&lang=en&appid="
            + appKey
            );
            let jsonResponse = await response.json();
            if(response.ok){ 
                const name = jsonResponse.name.toUpperCase();
                // const {speed, deg} = jsonResponse.wind;                
                const {icon, description} = jsonResponse.weather[0];
                const {temp, humidity, pressure} = jsonResponse.main;                 
                document.getElementById("city_n").innerHTML = "<center>" + name + "</center>";
                document.getElementById("icon").src = "https://openweathermap.org/img/wn/" + icon + ".png";
                document.getElementById("temp").innerHTML = "  " + temp + "°C";
                document.getElementById("description").innerHTML = description.toUpperCase();
                document.getElementById("humidity").innerHTML = "Humidity: " + humidity + "%";
                document.getElementById("pressure").innerHTML = "Pressure: " + pressure.toLocaleString("en-US") + " Pa." ;
                // document.getElementById("wind").innerHTML = "Wind: " + ((speed).toLocaleString("en-US")) + " km/s || " + deg + "°";        
                document.getElementById("latt").innerHTML = "Latitude: " + lat;
                document.getElementById("lon").innerHTML = "Longitude: " + lon;
                document.getElementById("hiddenLat").value = lat;
                document.getElementById("hiddenLon").value = lon;
                console.log(document.getElementById("hiddenLat").value);
                console.log(document.getElementById("hiddenLon").value);
            }
        }
    </script>

</body>

</html>
