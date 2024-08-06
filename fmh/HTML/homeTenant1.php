<?php include('include.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Home : Tenant 1 </title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/roomTenant.css">
    <link rel="stylesheet" href="../CSS/pageNumber.css">
    <link rel="stylesheet" href="../CSS/seeMoreTenant.css">
    <link rel="stylesheet" href="../CSS/homeTenant1.css">

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
    <!-- common nav  -->
    <?php include 'navbarTenant.php';?>
    <!-- <nav class="navbar"> </nav> -->

    <!-- main containeer -->
    <div class="tenantHomeContaineer">
        <!-- filter area -->
        <div class="filterClass">
        <form action="" method="post" id="tenant1Form">
                <h3 style="text-align: center; margin-top: -5px;line-height:32px;border-bottom: 2px solid gray;">Filter
                </h3> <br>

            <select name="location" id="filterLocationId" onclick="if(this.value == ''){document.getElementById('byBhk').removeAttribute('checked');}else{document.getElementById('byLocation').setAttribute('checked', 'checked');}">
                <option value="" hidden>Location</option>
                <?php 
                    $r_sql = "SELECT DISTINCT(`location`) FROM `tbl_room`";
                    $r_res = mysqli_query($conn, $r_sql) or die(mysqli_close($conn));
                    // $count_rows = mysqli_num_rows($r_res);

                    if($r_res == true){  
                        //Query Operated Successfully
                        while($rows = mysqli_fetch_assoc($r_res)){
                            // $loc = $rows['location'];
                    ?>
                            <option value="<?php echo $rows['location'];?>"><?php echo $rows['location'];?></option>
                    <?php
                            }
                        }
                        else{
                            //Query Operation Failed
                    ?>
                            <option value="">ERROR WITH DATABASE</option>
                    <?php
                            mysqli_close($conn);
                        }
                    ?>               
                </select>

                <input type="number" class="filterTextBox" id="filterBhk" name="bhk" placeholder="BHK" onkeydown="filterAutoTrigger(filterBhk)" onkeyup="if(this.value == ''){document.getElementById('byBhk').removeAttribute('checked');}else{document.getElementById('byBhk').setAttribute('checked', 'checked');}">
                <input type="number" class="filterTextBox" id="filterFloor" name="floor" placeholder="Floor" onkeyup="if(this.value == ''){document.getElementById('byFloor').removeAttribute('checked');}else{document.getElementById('byFloor').setAttribute('checked', 'checked');}">
                <input type="number" class="filterTextBox" id="filterMinPrice" name="minPrice" placeholder="Min Price" onkeyup="if(this.value == ''){document.getElementById('byPrice').removeAttribute('checked');}else{document.getElementById('byPrice').setAttribute('checked', 'checked');}">
                <input type="number" class="filterTextBox" id="filterMaxPrice" name="maxPrice" placeholder="Max Price" onkeyup="if(this.value == ''){document.getElementById('byPrice').removeAttribute('checked');}else{document.getElementById('byPrice').setAttribute('checked', 'checked');}">
                <br>
                <br>

                <hr style="margin-bottom: 4px;">

                <input type="checkbox" value="byLocation" id="byLocation" name="chk_location" >
                <label for="byLocation" id="labelParameterId">Location</label> <br>
                <input type="checkbox" value="byBhk" id="byBhk" name="chk_bhk"> <label for="byBhk" id="labelParameterId">BHK</label>
                <br>

                <input type="checkbox" value="byFloor" id="byFloor" name="chk_floor" >
                <label for="byFloor" id="labelParameterId">Floor</label> <br>

                <input type="checkbox" value="byPrice" id="byPrice" name="chk_price" >
                <label for="byPrice" id="labelParameterId">Price</label> <br> <br>

                <input type="submit" value="Filter" name="filter" id="filterButton">

                <!-- <a href="homeTenant2.php" id="filterUsingMapTrigger">Filter using map </a> -->
                <a href="/fmh/html/homeTenant2.php" id="filterUsingMapTrigger">Filter using map </a>
                <!-- <Button id="filterButton" style="font-size: 14px;">Filter</Button> -->
            </form>
        </div>

        <!-- main body area -->
        <!-- <article> -->
        <div class="articleHomeTenant">
        <h3 id="avaTitle">Available Room Details</h3>
        <div id="roomContaineer">
        <!-- Fetches the room details from database -->
        <?php
            // $r_sql= "SELECT * FROM `tbl_room`";
            $r_sql= "SELECT * FROM `tbl_room` ORDER BY `r_id` DESC";
            $r_res = mysqli_query($conn, $r_sql) or die(mysqli_close($conn));

            if($r_res == true){
                //Query executed successfully
                while($rows = mysqli_fetch_assoc($r_res)){
                    // Filter
                    if(isset($_POST['filter'])){
                        // foreach(checkbox as ) -> This could simplified using foreach loop
                        if(isset($_POST['chk_location'])){
                            if($rows['location'] != $_POST['location']){                                
                                continue;
                            }
                            if($_POST['location'] == ""){
                                goto a;
                            }
                        }                                                   
                        a:
                        if(isset($_POST['chk_bhk'])){
                            if($rows['bhk'] != $_POST['bhk']){                                
                                continue;
                            }
                            if($_POST['bhk'] == ""){
                                goto b;
                            }
                        }
                        b:
                        if(isset($_POST['chk_floor'])){
                            if($rows['floor'] != $_POST['floor']){                                
                                continue;
                            }
                            if($_POST['floor'] == ""){
                                goto c;
                            }
                        }
                        c:
                        if(isset($_POST['chk_price'])){
                            
                            if($_POST['minPrice'] == ""){
                                goto d;
                            }
                            else{
                                if($rows['price'] < $_POST['minPrice']){
                                    continue;
                                }
                            }
                            d:
                            if($_POST['maxPrice'] == ""){
                                goto e;
                            }
                            else{
                                if($rows['price'] > $_POST['maxPrice']){
                                    continue;
                                }
                            }                                                    
                        }                    
                    }
                e:
                ?>                  
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
            }
        ?>
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
    <!-- notification section -->
    <div class="notificationContaineer" id="notificationContaineerId">
        <div class="notificationCloseSection">
            <p id="closeNotification" onclick="closeNotification()">&times;</p>
        </div>
    
        <div class="notificationTextSection">
            <p id="notificationText"></p>
                <!-- <script>setTimeout(document.getElementById('notificationContaineerId').style.visibility = "hidden", 3000);</script> -->
            
        </div>
    </div>

    <!-- extented user menu : common -->
    <?php include 'extentedMenuLandlord.php';?>
    <!-- <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside> -->

    <!-- common social-share section -->
    <?php include 'socialshare.php';?>
    <!-- <div class="socialMainContaineer"> </div> -->

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
                if(($stored_wish_rows['r_id'] == $room_id) && ($stored_wish_rows['to_id'] ==  $tenant_id)){                         
                    $wish_chk = true;
                    break;
                }
            }
            if($wish_chk == false){
                $wish_sql = "INSERT INTO `fmh`.`tbl_wishlist`(`to_id`, `r_id`) VALUES ('$tenant_id', '$room_id')";
                $wish_res = mysqli_query($conn, $wish_sql) or die(mysqli_close($conn));
                $_SESSION['tenantComment'] = 'Room has been added to your wishlist';
                // header("Location:".TENANT1);
                ?>
                <script> 
                    location.href = "/fmh/html/homeTenant1.php";
                </script>                
                <?php
                
            }
            else{
                $wish_sql = "DELETE FROM `tbl_wishlist` WHERE `to_id` = '$tenant_id' AND `r_id` = '$room_id'";
                $wish_res = mysqli_query($conn, $wish_sql) or die(mysqli_close($conn));
                $_SESSION['tenantComment'] = 'Room has been removed from your wishlist';
                // header("Location:".TENANT1);
                ?>
                <script>
                    location.href = "/fmh/html/homeTenant1.php";
                </script>
                <?php
            }
        }
    ?>
    <!-- common footer -->
    <?php include 'footer.php';?>
    <!-- <footer class="footerbar"> </footer> -->

    <!-- javascript section -->
    <script>
        // functions for toggling the [see-more-containeer]
        closeSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackground').style = "visibility:hidden";
            document.getElementById('seeMoreLandlordContaineerId').style = "visibility:hidden";
        }

        openSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackground').style = "visibility:visible";
            document.getElementById('seeMoreLandlordContaineerId').style = "visibility:visible";
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

    <!-- linking js files -->
    <script src="../Javascript/commonJs.js"></script>
    
    <?php if(isset($_SESSION['tenantComment'])){
        ?>
        <script> 
            showNotification("<?php echo $_SESSION['tenantComment']; ?>");
        </script>
        <?php     
        // unset($_SESSION['tenantComment']);
    }
    ?>  
    <!-- <script src="../Javascript/tenant_common_file_includer.js"></script> -->
</body>

</html>

`