<?php include('include.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home : Landlord</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/pageNumber.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/roomLandlord.css">
    <link rel="stylesheet" href="../CSS/seeMoreLandlord.css">
    <link rel="stylesheet" href="../CSS/editRoomLandlord.css">
    <link rel="stylesheet" href="../CSS/homeLandlord.css">

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
    <!-- common navbar -->
    <?php include 'navbarLandlord.php'; ?>
    <!-- <nav class="navbar"> </nav> -->

    
                <!-- room details appear here -->
                <div id="articleHomeLandlord">
                    <h3>Your Rooms</h3>
                    <div id="roomContaineer">
                    <?php
                        $landlordId = 1; //Let
                        $sql = "SELECT * FROM `fmh`.`tbl_room` WHERE `f_id` = '$landlordId' ORDER BY `r_id` DESC";
                        $res = mysqli_query($conn, $sql);
                        $resCount = mysqli_num_rows($res);
                        if($resCount != 0){
                            while($getLandlordData = mysqli_fetch_assoc($res)){
                        ?>
                        <div class="roomBox">
                            <div class="roomImage">
                                <?php
                                    $temp_rid = $getLandlordData['r_id'];
                                    $img_sql = "SELECT `image` FROM `fmh`.`tbl_img` WHERE `r_id` = '$temp_rid'";
                                    $img_res = mysqli_query($conn, $img_sql);
                                    $getImgRows = mysqli_num_rows($img_res);
                                    if($getImgRows != 0){
                                        while($getImg = mysqli_fetch_array($img_res)){
                                            ?>
                                                <img src="<?php echo $getImg[0];?>" alt="room image">
                                            <?php
                                            break;
                                        }
                                        
                                    }
                                    else{
                                        // No Data Found
                                        ?>
                                            <img src="../Assests/Image/noImage.jpg" alt="room image">
                                        <?php
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
                                            <p class="roomDescription"><?php echo $getLandlordData['bhk'];?></p>
                                        </div>
                                    </div>

                                    <div class="roomDetailAtom">
                                        <div class="roomTitles">
                                            <p class="roomTitle">Floor</p>
                                        </div>
                                        <div class="roomDescriptions">
                                            <p class="roomDescription"><?php echo $getLandlordData['floor'];?></p>
                                        </div>
                                    </div>

                                    <div class="roomDetailAtom">
                                        <div class="roomTitles">
                                            <p class="roomTitle">Price</p>
                                        </div>
                                        <div class="roomDescriptions">
                                            <p class="roomDescription">Rs. <?php echo $getLandlordData['price'];?></p>
                                        </div>
                                    </div>

                                    <div class="roomDetailAtom">
                                        <div class="roomTitles">
                                            <p class="roomTitle">Location</p>
                                        </div>
                                        <div class="roomDescriptions">
                                            <p class="roomDescription"><?php echo $getLandlordData['location'];?></p>
                                        </div>
                                    </div>

                                    <div class="roomDetailAtom">
                                        <div class="roomTitles">
                                            <p class="roomTitle">Rating</p>
                                        </div>
                                        <div class="roomDescriptions">
                                            <p class="roomDescription"><?php echo $getLandlordData['rating'];?></p>
                                        </div>
                                    </div>

                                </div>

                                <form action="" method="post">
                                    <div class="roomButton">
                                        <div class="roomButtonA">
                                            <input type="submit" value="Edit" name="editRoom" id="editRoom">
                                        </div>

                                        <div class="roomButtonB">
                                            <input type="submit" value="More" name="seeMore" id="seeMore">
                                            <!-- onclick="openSeeMoreFunction()" -->
                                        </div>
                                    </div>

                                    <div id="removeRoomBox">
                                        <abbr title="Remove room">
                                        <button class="img_btn" name="removeRoom"><img src="../Assests/remove.png" alt="Remove room" id="removeRoomIcon"
                                                onclick=""></button>
                                        </abbr>
                                    </div>
                                    <input type="hidden" value="<?php echo $getLandlordData['r_id'];?>" name="room_id">
                                </form>
                            </div>

                            <!-- <div id="removeRoomBox">
                                <abbr title="Remove room">
                                    <img src="../Assests/remove.png" alt="Remove room" id="removeRoomIcon"
                                        onclick="alert('Remove This Room!')">
                                </abbr>
                            </div> -->
                        </div>                    
                    <?php
                }
            }
            else{
                // No Data Found
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
        
    <!-- edit section -->
    <?php 
        if(isset($_POST['editRoom'])){
            $room_id = $_POST['room_id'];          
            $md_r_sql = "SELECT * FROM `tbl_room` WHERE `r_id` = $room_id";                
            $coun_img = 0;
            $md_r_res = mysqli_query($conn, $md_r_sql) or die(mysqli_close($conn));
            while($md_r_rows = mysqli_fetch_assoc($md_r_res)){        
        ?>
        <!-- Viewing room details on clicking [See More] -->
        <div class="seeMoreDarkBackground" id="seeMoreDarkBackgroundId" style="visibility: visible;"> </div>
        <!-- Update room room section -->
        <div class="updateRoomContaineer" id="updateRoomContaineerId" style="visibility: visible;">
            <!-- left section : [image & google map], occupied, change image -->
            <div class="updateLeftSection">
                <!-- room picture -->
                <div class="updateLeftSectionImage">
                    <div class="updateImage">
                        <?php
                            $md_img_sql = "SELECT `image` FROM `tbl_img` WHERE `r_id` = $room_id";
                            $md_img_res = mysqli_query($conn, $md_img_sql);
                            $md_img_rows_count = mysqli_num_rows($md_img_res);
                            // while($md_img_rows = mysqli_fetch_array($md_img_res)){
                            $md_img_rows = mysqli_fetch_all($md_img_res);
                                if(($md_img_rows_count > 0)){
                        ?>                        
                                    <img src="<?php echo $md_img_rows[0][0];?>" alt="Room image" id="updateActiveImage">
                        <?php
                                }
                                else{
                        ?>
                                    <img src="../Assests/Image/noImage.jpg" alt="roomImage" id="seeMoreActiveImage">
                        <?php
                                }
                        ?>
                    </div>

                    <!-- new picture selection -->
                    <div class="newRoomPicture">
                        <div class="newRoomLabel">
                            <label for="roomPhoto">Choose room photo</label>
                        </div>
                        <!-- <input type="file" id="roomPhoto" name="file[]" accept=".jpg, jpeg" multiple> -->

                        <div class="newRoomInputSection">
                            <input type="file" id="roomPhoto1" name="file1" accept=".jpg, jpeg">
                            <input type="file" id="roomPhoto2" name="file2" accept=".jpg, jpeg">
                            <input type="file" id="roomPhoto3" name="file3" accept=".jpg, jpeg">
                            <input type="file" id="roomPhoto4" name="file4" accept=".jpg, jpeg">
                        </div>
                    </div>

                    <!-- existing image section -->
                    <div class="updateLeftSectionImageCollection">
                        <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(1)">
                            <?php
                                    if(($md_img_rows_count > 0)){
                            ?>
                                        <img src="<?php echo $md_img_rows[0][0];?>" alt="room image 1" id="existingImage1">
                            <?php
                                    }
                                    else{
                            ?>
                                        <img src="../Assests/Image/noImage.jpg" alt="room image 1" id="existingImage1">
                            <?php
                                    }
                            ?>
                        </div>

                        <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(2)">
                            <?php
                                    if(($md_img_rows_count > 1)){
                            ?>
                                        <img src="<?php echo $md_img_rows[1][0];?>" alt="room image 2" id="existingImage2">
                            <?php
                                    }
                                    else{
                            ?>
                                        <img src="../Assests/Image/noImage.jpg" alt="room image 2" id="existingImage2">
                            <?php
                                    }
                            ?>
                        </div>

                        <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(3)">
                            <?php
                                    if(($md_img_rows_count > 2)){
                            ?>
                                        <img src="<?php echo $md_img_rows[2][0];?>" alt="room image 3" id="existingImage3">
                            <?php
                                    }
                                    else{
                            ?>
                                        <img src="../Assests/Image/noImage.jpg" alt="room image 3" id="existingImage3">
                            <?php
                                    }
                            ?>
                        </div>

                        <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(4)">
                            <?php
                                    if(($md_img_rows_count > 3)){
                            ?>
                                        <img src="<?php echo $md_img_rows[3][0];?>" alt="room image 4" id="existingImage4">
                            <?php
                                    }
                                    else{
                            ?>
                                        <img src="../Assests/Image/noImage.jpg" alt="room image 4" id="existingImage4">
                            <?php
                                    }
                                // }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- google map will appear here -->
                <div class="updateLocation">
                    <!-- <img src="../Assests/Sample map.png" alt="Room image"> -->
                    <div id="map" style="height: 100%;">
                    </div>
                </div>
            </div>

            <?php
                $foreign_key = $md_r_rows['f_id'];
                $md_to_sql = "SELECT * FROM `tbl_to` WHERE `to_id` = $foreign_key";
                $md_to_res = mysqli_query($conn, $md_to_sql);
                $md_to_rows = mysqli_fetch_assoc($md_to_res);
            ?>

            <!-- right section : all other details -->
            <div class="updateRightSection">
                <p id="closeEditRoomButton" onclick="hideEditSection()">&times;</p>
                <h3>Only change the desired ones!</h3>
                <p id="updateMessage" style="color:tomato">Message area</p>
                <hr>

                <!-- <form action="core.php" method="post" enctype="multipart/form-data"></form> -->
                <form action="" method="post" autocomplete="off" id="updateRoomForm">
                    <input type="hidden" value="<?php echo $room_id;?>" name="room_id">
                    <!-- change room picture -->
                    <input type="button" value="Change picture" id="updateChangePicture" onclick="updateLoadDiv(1)">

                    <!-- room occupied/ unoccupied -->
                    <select name="occupy" id="">
                        <option value="<?php echo ucwords($md_r_rows['occupy']);?>" selected hidden><?php echo ucwords($md_r_rows['occupy']);?></option>
                        <option value="occupied">Occupied</option>
                        <option value="not occupied">Not occupied</option>
                    </select>

                    <!-- room type -->
                    <select name="type" id="">
                        <option value="<?php echo ucwords($md_r_rows['type']);?>" selected hidden><?php echo ucwords($md_r_rows['type']);?></option>
                        <option value="flat">Flat</option>
                        <option value="single room">Single Room</option>
                    </select>

                    <!-- if room type = flat -->
                    <input type="number" name="bhk" id="roomBhk" placeholder="BHK" value="<?php echo $md_r_rows['bhk'];?>">

                    <select name="roomSize" id="roomSize">
                        <option value="<?php echo ucwords($md_r_rows['roomSize']);?>" disabled selected hidden><?php echo ucwords($md_r_rows['roomSize']);?></option>
                        <option value="large">Large [22*28 (616)]</option>
                        <option value="medium">Medium [16*20 (320)]</option>
                        <option value="small">Small [12*18 (216)]</option>
                        <option value="verysmall">Very Small [10*12 (120)]</option>
                    </select>

                    <!-- floor of a room -->
                    <input type="number" name="floor" value="<?php echo $md_r_rows['floor'];?>" id="" placeholder="Floor" pattern="/^-?\d+\.?\d*$/"
                        onKeyPress="if(this.value.length==1) return false;">

                    <!-- is room furnished or not -->
                    <select name="furnished" id="furnishing">
                        <option value="<?php echo ucwords($md_r_rows['furnishing']);?>" disabled selected hidden><?php echo ucwords($md_r_rows['furnishing']);?></option>
                        <option value="full furnished">Fully furnished</option>
                        <option value="semi furnished">Semi furnished</option>
                        <option value="not furnished">Not furnished</option>
                    </select>

                    <!-- location of room -->
                    <input type="hidden" id="lat" name="lat" value="<?php echo $md_r_rows['latitude'];?>">
                    <input type="hidden" id="lng" name="lng" value="<?php echo $md_r_rows['longitude'];?>">
                    <script>
                        gett(<?php echo $md_r_rows['latitude'];?>, <?php echo $md_r_rows['longitude'];?>);
                    </script>
                    <input type="text" id="location" name="location" placeholder="Location" onclick="updateLoadDiv(2)" value="<?php echo $md_r_rows['location'];?>">

                    <!-- services -->
                    <!-- <input type="text" name="services" placeholder="Services"> -->

                    <div id="dropCheckbox">
                        <div id="optionIncluder">
                            <input type="text" name="services" value="<?php echo $md_r_rows['services'];?>" placeholder="Services to provide" id="includerTextBox"
                                onclick="showOptions()" onkeypress="return false;">
                            <img src="../Assests/drop-down-arrow.png" alt="" id="optionDropdown" onclick="showOptions()">
                        </div>

                        <div id="options">
                            <div class="optionAtom">
                                <div class="optionCheck">
                                    <input type="checkbox" name="" id="opt1" onchange="changeFinalText()">
                                </div>
                                <div class="optionTitle" id="optionTitle1" onclick="checkForChange(1)">
                                    <label id="label1">Drinking Water</label>
                                </div>
                            </div>

                            <div class="optionAtom">
                                <div class="optionCheck">
                                    <input type="checkbox" name="" id="opt2" onchange="changeFinalText()">
                                </div>
                                <div class="optionTitle" id="optionTitle2" onclick="checkForChange(2)">
                                    <label id="label2">Security</label>
                                </div>
                            </div>

                            <div class="optionAtom">
                                <div class="optionCheck">
                                    <input type="checkbox" name="" id="opt3" onchange="changeFinalText()">
                                </div>
                                <div class="optionTitle" id="optionTitle3" onclick="checkForChange(3)">
                                    <label id="label3">Internet</label>
                                </div>
                            </div>

                            <div class="optionAtom">
                                <div class="optionCheck">
                                    <input type="checkbox" name="" id="opt4" onchange="changeFinalText()">
                                </div>
                                <div class="optionTitle" id="optionTitle4" onclick="checkForChange(4)">
                                    <label id="label4">Waste</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of service section -->

                    <!-- rent amount -->
                    <input type="number" name="price" placeholder="Rent Amount" value="<?php echo $md_r_rows['price'];?>">

                    <!-- rent type : monthly or annual -->
                    <select name="per">
                        <option value="<?php echo $md_r_rows['per'];?>" disabled selected hidden><?php echo $md_r_rows['per'].'ly';?></option>
                        <option value="month">Monthly</option>
                        <option value="year">Annual</option>
                    </select>

                    <!-- price negotiable or not -->
                    <select name="nego" id="">
                        <option value="<?php echo ucwords($md_r_rows['negotiable']);?>" disabled selected hidden><?php echo ucwords($md_r_rows['negotiable']);?></option>
                        <option value="Negotiable">Negotiable</option>
                        <option value="Non Negotiable">Non-negotaible</option>
                    </select>

                    <!-- additional note for room -->
                    <textarea name="note" id="" value="<?php echo $md_to_rows['note'];?>" placeholder="<?php echo $md_to_rows['note'];?>" style="height:60px; resize:none"></textarea>

                    <div class="updateButtonSection">
                        <div class="updateButtonSectionA">
                            <input type="submit" value="Reset" name="resetRoom" id="updateResetButton">
                        </div>

                        <div class="updateButtonSectionB">
                            <input type="submit" value="Update" name="update" id="updateUpdateButton" onclick="showNotification('Room detail has been updated.')">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <?php } } ?>

    <!-- edit -> reset section -->
    <?php 
        if(isset($_POST['resetRoom'])){
            $room_id = $_POST['room_id'];
            $md_r_sql = "SELECT * FROM `tbl_room` WHERE `r_id` = $room_id";                
            $coun_img = 0;
            $md_r_res = mysqli_query($conn, $md_r_sql) or die(mysqli_close($conn));
            while($md_r_rows = mysqli_fetch_assoc($md_r_res)){        
        ?>
            <!-- Viewing room details on clicking [See More] -->
            <div class="seeMoreDarkBackground" id="seeMoreDarkBackgroundId" style="visibility: visible;"> </div>
            <!-- Update room room section -->
            <div class="updateRoomContaineer" id="updateRoomContaineerId" style="visibility: visible;">
                <!-- left section : [image & google map], occupied, change image -->
                <div class="updateLeftSection">
                    <!-- room picture -->
                    <div class="updateLeftSectionImage">
                        <div class="updateImage">
                            <?php
                                $md_img_sql = "SELECT `image` FROM `tbl_img` WHERE `r_id` = $room_id";
                                $md_img_res = mysqli_query($conn, $md_img_sql);
                                $md_img_rows_count = mysqli_num_rows($md_img_res);
                                // while($md_img_rows = mysqli_fetch_array($md_img_res)){
                                $md_img_rows = mysqli_fetch_all($md_img_res);
                                    if(($md_img_rows_count > 0)){
                            ?>                        
                                        <img src="<?php echo $md_img_rows[0][0];?>" alt="Room image" id="updateActiveImage">
                            <?php
                                    }
                                    else{
                            ?>
                                        <img src="../Assests/Image/noImage.jpg" alt="roomImage" id="seeMoreActiveImage">
                            <?php
                                    }
                            ?>
                        </div>

                        <!-- new picture selection -->
                        <div class="newRoomPicture">
                            <div class="newRoomLabel">
                                <label for="roomPhoto">Choose room photo</label>
                            </div>
                            <!-- <input type="file" id="roomPhoto" name="file[]" accept=".jpg, jpeg" multiple> -->

                            <div class="newRoomInputSection">
                                <input type="file" id="roomPhoto1" name="file1" accept=".jpg, jpeg">
                                <input type="file" id="roomPhoto2" name="file2" accept=".jpg, jpeg">
                                <input type="file" id="roomPhoto3" name="file3" accept=".jpg, jpeg">
                                <input type="file" id="roomPhoto4" name="file4" accept=".jpg, jpeg">
                            </div>
                        </div>

                        <!-- existing image section -->
                        <div class="updateLeftSectionImageCollection">
                            <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(1)">
                                <?php
                                        if(($md_img_rows_count > 0)){
                                ?>
                                            <img src="<?php echo $md_img_rows[0][0];?>" alt="room image 1" id="existingImage1">
                                <?php
                                        }
                                        else{
                                ?>
                                            <img src="../Assests/Image/noImage.jpg" alt="room image 1" id="existingImage1">
                                <?php
                                        }
                                ?>
                            </div>

                            <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(2)">
                                <?php
                                        if(($md_img_rows_count > 1)){
                                ?>
                                            <img src="<?php echo $md_img_rows[1][0];?>" alt="room image 2" id="existingImage2">
                                <?php
                                        }
                                        else{
                                ?>
                                            <img src="../Assests/Image/noImage.jpg" alt="room image 2" id="existingImage2">
                                <?php
                                        }
                                ?>
                            </div>

                            <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(3)">
                                <?php
                                        if(($md_img_rows_count > 2)){
                                ?>
                                            <img src="<?php echo $md_img_rows[2][0];?>" alt="room image 3" id="existingImage3">
                                <?php
                                        }
                                        else{
                                ?>
                                            <img src="../Assests/Image/noImage.jpg" alt="room image 3" id="existingImage3">
                                <?php
                                        }
                                ?>
                            </div>

                            <div class="updateLeftSectionImageAtom" onclick="changeUpdateImage(4)">
                                <?php
                                        if(($md_img_rows_count > 3)){
                                ?>
                                            <img src="<?php echo $md_img_rows[3][0];?>" alt="room image 4" id="existingImage4">
                                <?php
                                        }
                                        else{
                                ?>
                                            <img src="../Assests/Image/noImage.jpg" alt="room image 4" id="existingImage4">
                                <?php
                                        }
                                    // }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- google map will appear here -->
                    <div class="updateLocation">
                        <!-- <img src="../Assests/Sample map.png" alt="Room image"> -->
                        <div id="map" style="height: 100%;">
                        </div>
                    </div>
                </div><?php }?>

                <!-- right section : all other details -->
                <div class="updateRightSection">
                    <p id="closeEditRoomButton" onclick="hideEditSection()">&times;</p>
                    <h3>Only change the desired ones!</h3>
                    <p>Message area</p>
                    <hr>

                    <!-- <form action="core.php" method="post" enctype="multipart/form-data"></form> -->
                    <form action="" method="" autocomplete="off" id="updateRoomForm">
                        <input type="hidden" value="<?php echo $room_id;?>" name="room_id">
                        <!-- change room picture -->
                        <input type="button" value="Change picture" id="updateChangePicture" onclick="updateLoadDiv(1)">

                        <!-- room occupied/ unoccupied -->
                        <select name="occupy" id="">
                            <option value="" selected hidden>Room occupied/ unoccupied</option>
                            <option value="occupied">Occupied</option>
                            <option value="unoccupied">Unoccupied</option>
                        </select>

                        <!-- room type -->
                        <select name="type" id="">
                            <option value="" selected hidden>Room type</option>
                            <option value="room">Room</option>
                            <option value="flat">Flat</option>
                        </select>

                        <!-- if room type = flat -->
                        <input type="number" name="bhk" id="roomBhk" placeholder="BHK">

                        <select name="room_size" id="room_size">
                            <option value="" disabled selected hidden>Room Size [FT.+(AREA)]</option>
                            <option value="large">Large [22*28 (616)]</option>
                            <option value="medium">Medium [16*20 (320)]</option>
                            <option value="small">Small [12*18 (216)]</option>
                            <option value="verysmall">Very Small [10*12 (120)]</option>
                        </select>

                        <!-- floor of a room -->
                        <input type="number" name="floor" id="" placeholder="Floor" pattern="/^-?\d+\.?\d*$/"
                            onKeyPress="if(this.value.length==1) return false;">

                        <!-- is room furnished or not -->
                        <select name="furnished" id="furnished">
                            <option value="" disabled selected hidden>Furnishing</option>
                            <option value="full">Fully furnished</option>
                            <option value="semi">Semi furnished</option>
                            <option value="not">Not furnished</option>
                        </select>

                        <!-- location of room -->
                        <input type="text" name="location" placeholder="Location" onclick="updateLoadDiv(2)">

                        <!-- services -->
                        <!-- <input type="text" name="services" placeholder="Services"> -->

                        <div id="dropCheckbox">
                            <div id="optionIncluder">
                                <input type="text" name="services" placeholder="Services to provide" id="includerTextBox"
                                    onclick="showOptions()" onkeypress="return false;">
                                <img src="../Assests/drop-down-arrow.png" alt="" id="optionDropdown" onclick="showOptions()">
                            </div>

                            <div id="options">
                                <div class="optionAtom">
                                    <div class="optionCheck">
                                        <input type="checkbox" name="" id="opt1" onchange="changeFinalText()">
                                    </div>
                                    <div class="optionTitle" id="optionTitle1" onclick="checkForChange(1)">
                                        <label id="label1">Drinking Water</label>
                                    </div>
                                </div>

                                <div class="optionAtom">
                                    <div class="optionCheck">
                                        <input type="checkbox" name="" id="opt2" onchange="changeFinalText()">
                                    </div>
                                    <div class="optionTitle" id="optionTitle2" onclick="checkForChange(2)">
                                        <label id="label2">Security</label>
                                    </div>
                                </div>

                                <div class="optionAtom">
                                    <div class="optionCheck">
                                        <input type="checkbox" name="" id="opt3" onchange="changeFinalText()">
                                    </div>
                                    <div class="optionTitle" id="optionTitle3" onclick="checkForChange(3)">
                                        <label id="label3">Internet</label>
                                    </div>
                                </div>

                                <div class="optionAtom">
                                    <div class="optionCheck">
                                        <input type="checkbox" name="" id="opt4" onchange="changeFinalText()">
                                    </div>
                                    <div class="optionTitle" id="optionTitle4" onclick="checkForChange(4)">
                                        <label id="label4">Waste</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of service section -->

                        <!-- rent amount -->
                        <input type="number" name="price" placeholder="Rent Amount">

                        <!-- rent type : monthly or annual -->
                        <select name="rentType">
                            <option value="" disabled selected hidden>Rent Type</option>
                            <option value="month">Monthly</option>
                            <option value="year">Annual</option>
                        </select>

                        <!-- price negotiable or not -->
                        <select name="negotiable" id="">
                            <option value="" disabled selected hidden>Negotiable/ Non-negotiable</option>
                            <option value="yes">Negotiable</option>
                            <option value="no">Non-negotaible</option>
                        </select>

                        <!-- additional note for room -->
                        <textarea name="note" id="" placeholder="Write Something about the room..."
                            style="height:60px; resize:none"></textarea>
                    </form>

                    <div class="updateButtonSection">
                        <div class="updateButtonSectionA">
                            <input type="submit" value="Reset" name="resetRoom" id="updateResetButton">
                        </div>

                        <div class="updateButtonSectionB">
                            <input type="submit" value="Update" name="update" id="updateUpdateButton">
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    ?>

    <!-- edit -> update section -->
    <?php
        if((isset($_POST['upadate'])) && (($_POST['price']) == "" || ($_POST['per']) == "" || ($_POST['nego']) == "" || ($_POST['room_size']) == "" || ($_POST['type']) == "" || ($_POST['furnished']) == "")){
            $_SESSION['comment'] = "<span class='fail'><center>Please fill up all boxes first</center></span>";              
            ?><script>
                location.href = "/fmh/html/homelandlord.php";                    
            </script><?php
        }
        elseif(isset($_POST['update'])){
            $room_id = $_POST['room_id'];
            $note = ucfirst($_POST['note']);
            $location = strtolower($_POST['location']);
            $location = ucwords($location);
            ?><script>
                location.href = "/fmh/html/homelandlord.php";                    
            </script><?php
            $price = ($_POST['price']);
            $per = ucfirst($_POST['per']);
            if($per == ""){
                $per = "Month";
            }
            $nego = ucfirst($_POST['nego']);
            if($nego == ""){
                $nego = "Negotiable";
            }
            $room_size = ucwords($_POST['room_size']);
            if($room_size == ""){
                $room_size = "Medium";
            }
            
            $type = ucfirst($_POST['type']);
            $floor = ($_POST['floor']);
            // if
            // If the owner has flat
            
            if((($type == "Flat") && ($_POST['bhk'] == "") || ($type == "Single Room"))){
                $bhk = 1;
            }
            elseif(($type == "Flat") && ($_POST['bhk'] != "")){
                $bhk = $_POST['bhk'];
            }
            elseif($type==""){
                $type="Room";
            }
            $furnished = ucwords($_POST['furnished']);
            if($furnished == ""){
                $furnished = "Not Furnished";
            }
            // $message = strtolower($_POST['message']);
            // $message = ucfirst($message);
            // if($message == ""){
            //     $message = "It\'s not how big the house is, It\'s how happy you are ..";
            // }
            // else{
            //     $message = str_ireplace('"', '\"', $message);
            //     $message = str_ireplace("'", "\'", $message);
            // }
            $services = strtolower($_POST['services']);
            $services = ucwords($services);
            $services = str_ireplace('"', '\"',$services);
            $services = str_ireplace("'", "\'",$services);

            $latitude = $_POST['lat'];
            $longitude = $_POST['lng'];

            $occupy = ucwords($_POST['occupy']);

            $conn = mysqli_connect('localhost','root','','fmh');

            $sql = "UPDATE `tbl_room` SET `occupy`='$occupy',`location`='$location',`latitude`='$latitude',`longitude`='$longitude',`type`='$type',`roomSize`='$room_size',`price`='$price',`per`='$per',`negotiable`='$nego',`furnishing`='$furnished',`services`='$services',`floor`='$floor',`bhk`='$bhk' WHERE `r_id` = $room_id";
            $sql_to = "UPDATE `tbl_to` SET `note` = '$note' WHERE `to_id` = 1"; // here, to_id is supposed
            $res_to = mysqli_query($conn, $sql_to);
            $res = mysqli_query($conn, $sql) ;

            if($res == true && $res_to == true){
                $statusMsg = "<span class='success'><center>Your details have been submitted to Database</center></span><br>";
                $_SESSION['ownerComment'] = $statusMsg;
            }
            else{
                $statusMsg = "<span class='fail'><center>Error in Query</center></span><br>";
                $_SESSION['comment'] = $statusMsg;
            }
            ?><script>
                location.href = "/fmh/html/homelandlord.php";
            </script><?php
        }
    ?>

    <!-- seemore section -->
    <?php if(isset($_POST['seeMore'])){?>
        <!-- Viewing room details on clicking [See More] -->
        <div class="seeMoreDarkBackground" id="seeMoreDarkBackgroundId" style="visibility: visible;"> </div>
        <!-- showing room details using See More -->
        <div class="seeMoreLandlordContaineer" id="seeMoreLandlordContaineerId" style="visibility: visible;">
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
                                <img src="../Assests/Image/noImage.jpg" alt="roomImage" id="seeMoreActiveImage">
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
                        <p class="seeMoreTitle">Floor</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['floor'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Room Size</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['roomSize'];?></p>
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
                        <p class="seeMoreTitle">Status</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['occupy'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Required Marital Status</p>
                        <p class="seeMoreDescription">: <?php echo $md_to_rows['marital_status'];?></p>
                    </div>

                    <div class="detailSectionAtom">
                        <p class="seeMoreTitle">Additional Note</p>
                        <p class="seeMoreDescription" style="height:100px; overflow:hidden">: <?php echo $md_to_rows['note'];?></p>
                    </div>
                    <form action="" method="post">
                        <div id="buttonSection">
                            <input type="submit" value="Remove Room" name="removeRoom" id="removeMyRoom" onclick="showNotification('Room has been removed successfully.')">
                        </div>
                        <input type="hidden" value="<?php echo $room_id;?>" name="room_id">
                    </form>
                </div>
            </div>
        
        <?php 
            }
        ?>
        </div>
        <?php
        }
    ?>
    
    <!-- removeroom -->
    <?php
        if(isset($_POST['removeRoom'])){
            $room_id = $_POST['room_id'];
            $sql = "DELETE FROM `tbl_room` WHERE `r_id` = '$room_id'";
            $res = mysqli_query($conn, $sql);
            ?><script>
                location.href = "/fmh/html/homelandlord.php";                   
            </script><?php
        }
    ?>

    <!-- sign in/ sign out section -->
    <div class="signOutConfirmationContaineer" id="signOutConfirmationContaineerId">
        <div class="signOutHeading">
            <h4 id="warningComment"></h4>
        </div>

        <div class="signOutButton">
            <a href="signIn.php"><input type="submit" value="Yes"></a>
            <input type="submit" value="No" onclick="visibleWarning(2, '')">
        </div>
    </div>

    <!-- user option menu -->
    <div class="userOptionMenu" id="userMenuBox">
        <ul>
            <a href="profileLandlord.php">
                <li>My Profile </li>
            </a>
            <a href="#" onclick="visibleWarning(1, 'Are you sure you want to sign out?');">
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
    <?php include 'extentedMenuLandlord.php'; ?>
    <!-- <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside> -->

    <!-- common social-share section -->
    <?php include 'socialshare.php'; ?>
    <!-- <div class="socialMainContaineer"> </div> -->

    <!-- common footer -->
    <?php include 'footer.php'; ?>
    <!-- <footer class="footerbar"> </footer> -->

    <!-- scrips -->
    <script>
        function visibleWarning(get, message){
            // alert("a");
            if(get == 1){
                document.getElementById('userMenuBox').style.visibility = 'hidden';
                document.getElementById('warningComment').innerHTML = message;
                document.getElementById('signOutConfirmationContaineerId').style.visibility = 'visible';
            }
            else{
                // document.getElementById('signOutConfirmationContaineerId').style.visibility = 'hidden';
                location.href = '/fmh/html/homelandlord.php';
            }
            
        }
        var div_1, div_2;
        var optionBoxStatus = false;

        // for showing details on clicking see more
        closeSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackgroundId').style = "visibility:hidden";
            document.getElementById('seeMoreLandlordContaineerId').style = "visibility:hidden";
        }

        openSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackgroundId').style = "visibility:visible";
            document.getElementById('seeMoreLandlordContaineerId').style = "visibility:visible";
        }

        // edit section
        hideEditSection = () => {
            document.getElementById('seeMoreDarkBackgroundId').style = "visibility:hidden";
            document.getElementById('updateRoomContaineerId').style = "visibility:hidden";
            document.getElementsByClassName('updateLocation')[0].style = "visibility:hidden";
            document.getElementsByClassName('updateLeftSection')[0].style = "visibility:hidden";
            document.getElementsByClassName('updateLeftSectionImage')[0].style = "visibility:hidden";

            if (optionBoxStatus == true) {
                box.style = "visibility:hidden;";

                myArrow.style = "transform:rotate(0deg); transition:0.3s";

                triggerBox.style = "border-bottom-left-radius:6px; border-bottom-right-radius:6px";

                document.getElementById('options').style = "visibility:hidden";
                optionBoxStatus = false;
            }
        }

        showEditSection = () => {
            document.getElementById('seeMoreDarkBackgroundId').style = "visibility:visible";
            document.getElementById('updateRoomContaineerId').style = "visibility:visible;";
            document.getElementsByClassName('updateLeftSectionImage')[0].style = "visibility:visible";
            document.getElementsByClassName('updateLocation')[0].style = "visibility:hidden";
        }

        // loading image update section on left side 
        div_1 = document.getElementsByClassName('updateLeftSectionImage')[0];
        div_2 = document.getElementsByClassName('updateLocation')[0];
        updateLoadDiv = (which_div) => {
            if (which_div == 1) {
                div_1.style = "visibility:visible";
                div_2.style = "visibility:hidden";
            } else {
                div_1.style = "visibility:hidden";
                div_2.style = "visibility:visible";
            }
        }


        // editing details
        roomTypeFunction = (roomType) => {
            if (roomType == 'flat') {
                document.getElementById('roomBhk').style = "visibility:visible; display:block";
            } else {
                document.getElementById('roomBhk').style = "visibility:hidden; display:none";
            }
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

        // changinf update >> imgae
        changeUpdateImage = (image_number) => {
            var image_target_id = document.getElementById('updateActiveImage');
            var active_image;
            var active_input;
            var input_target_id;

            if (image_number == 1) {
                active_input = 1;
                input_target_id = document.getElementById('roomPhoto1');
                active_image = document.getElementById('existingImage1');
            }else if(image_number==2){
                active_input = 2;
                input_target_id = document.getElementById('roomPhoto2');
                active_image = document.getElementById('existingImage2');
            }else if( image_number==3){
                active_input = 3;
                input_target_id = document.getElementById('roomPhoto3');
                active_image = document.getElementById('existingImage3');
            }else{
                active_input = 4;
                input_target_id = document.getElementById('roomPhoto4');
                active_image = document.getElementById('existingImage4');
            }
            
            // loading image
            image_target_id.src = active_image.src;

            // toggling input:file
            document.getElementById('roomPhoto1').style="display:none";
            document.getElementById('roomPhoto2').style="display:none";
            document.getElementById('roomPhoto3').style="display:none";
            document.getElementById('roomPhoto4').style="display:none";
            
            if(active_input==1){
                document.getElementById('roomPhoto1').style="display:block";
            } else if(active_input==1){
                document.getElementById('roomPhoto2').style="display:block";
            } else if(active_input==1){
                document.getElementById('roomPhoto3').style="display:block";
            }else{
                document.getElementById('roomPhoto4').style="display:block";
            }
        }
    </script>

    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPeDFdvyDNf8b0BsJLlxM-7sYnp50mNss&callback=initMap"> </script>
    
    <script>
        // Script for map    
        let y,z;

        function mapTour(y, z){
            let map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: { lat: y, lng: z }
            });
            var marker = new google.maps.Marker({
                position: { lat: y, lng: z },
                map: map,
                draggable: true,
                icon: 'pinn.png'
            });

            google.maps.event.addListener(marker, 'position_changed',
                function(){
                    window.setTimeout(() => {
                        map.panTo(marker.getPosition());
                    }, 10);                        
                    y = marker.position.lat();
                    z = marker.position.lng();
                    gett(y, z);        
                    document.getElementById('lat').value = y;
                    document.getElementById('lng').value = z;
                }
            )
            
            google.maps.event.addListener(map, 'click',
                function(event){
                    // icon: 'pinn.png';
                    pos = event.latLng;
                    marker.setPosition(pos);                        
                    map.setZoom(16);
                }
            )
        }
        
        async function get(){
            let city = document.getElementById('location').value;
            if(city!=""){                
                let appKey = "bdcb5525200245816b639037cce9b2c7";
                //Retriving the weather of given location
                let response = await fetch("https://api.openweathermap.org/data/2.5/weather?q="
                + city 
                +",NP&units=metric&lang=en&appid="
                + appKey
                );  

                let jsonResponse = await response.json();
                if(response.ok){ 
                    const {lon, lat} = jsonResponse.coord;  
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lon; 
                    y = lat;
                    z = lon;
                    mapTour(lat, lon);
                }
                else{
                    document.getElementById('lat').value = "Error";
                    document.getElementById('lng').value = "Error";
                }
            }
        }        

        async function gett(lat, lng){
            let appKey = "bdcb5525200245816b639037cce9b2c7";
            //Retriving the weather of given location
            let response = await fetch("https://api.openweathermap.org/data/2.5/weather?lat="
            +lat
            +"&lon="
            +lng
            +"&units=metric&lang=en&appid="
            + appKey
            );
            let jsonResponse = await response.json();
            document.getElementById('location').value = jsonResponse.name;
        }

        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

            function showPosition(position) {
                y = position.coords.latitude;
                z = position.coords.longitude;
                document.getElementById('lat').value = y;
                document.getElementById('lng').value = z;
                gett(y, z);
                mapTour(y, z);
            }                              
        }
    </script>

    <!-- linking js files -->
    <script src="../Javascript/commonJs.js"></script>
    <script src="../Javascript/serviceBox.js"></script>
    <!-- <script src="../Javascript/landlord_common_file_includer.js"></script> -->
</body>

</html>