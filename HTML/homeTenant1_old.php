<?php include('include.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Home : Tenant 1 </title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/room.css">
    <link rel="stylesheet" href="../CSS/socialShare.css">
    <link rel="stylesheet" href="../CSS/homeTenant1.css">
    <link rel="stylesheet" href="../CSS/pageNumber.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/seeMore.css">

    <link rel="icon" type="image/x-icon" href="../Assests/salad.png">

    <style>
        .roomButton input[type=submit]{
            width: 100%;
            height: 32px;
            color: white;
            border: none;
            font-size: 12px;
            border-radius: 12px;
            background-color: #515151;
        }

        .roomButton input[type=submit]:hover{
            cursor: pointer;
            transition: 0.4s;
            background-color: #FF4045;
        }
        #filterButton {
            cursor: pointer;
        }
    </style>
</head>

<body>
    

    <!-- filter area -->
    <div class="filterClass">
        <form action="" method="post">
            <h3 style="text-align: center; margin-top: -5px;line-height:32px;border-bottom: 2px solid gray;">Filter
            </h3> <br>

            <select name="location" id="filterLocationId">
                <option value="" hidden>Location</option>
                <?php 
                    $r_sql = "SELECT DISTINCT(`location`) FROM `tbl_room`";
                    $r_res = mysqli_query($conn, $r_sql) or die(mysqli_close($conn));

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
                        mysqli_close($conn);
                ?>
                            <option value="">DataBase Connection Error</option>
                            
                <?php
                    }            
                ?>               
            </select>

            <input type="number" id="filterTextBoxId" placeholder="BHK" name="bhk" >
            <input type="number" id="filterTextBoxId" placeholder="Floor" name="floor" >
            <input type="number" id="filterTextBoxId" placeholder="Min Price" name="minPrice" >
            <input type="number" id="filterTextBoxId" placeholder="Max Price" name="maxPrice" > <br> <br>

            <hr> <br>

            <input type="checkbox" value="byLocation" id="byLocation" name="chk_location" >
            <label for="byLocation" id="labelParameterId">Location</label> <br>
            <input type="checkbox" value="byBhk" id="byBhk" name="chk_bhk"> <label for="byBhk" id="labelParameterId">BHK</label>
            <br>

            <input type="checkbox" value="byFloor" id="byFloor" name="chk_floor" >
            <label for="byFloor" id="labelParameterId">Floor</label> <br>

            <input type="checkbox" value="byPrice" id="byPrice" name="chk_price" >
            <label for="byPrice" id="labelParameterId">Price</label> <br> <br>

            <a href="homeTenant2.php">
                <p id="filterUsingMapTrigger">Filter using map</p>
            </a>

            <Button id="filterButton" style="font-size: 14px;" name="filter">Filter</Button>
        </form>
    </div>

    <!-- main body area -->
    <!-- <article> -->
    <div class="article">
        <h2 style="margin-left: 10px; line-height: 34px;">Available Room Details</h2>
        
        <div class="roomContaineer">
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
                                if($rows['rate'] < $_POST['minPrice']){
                                    continue;
                                }
                            }
                            d:
                            if($_POST['maxPrice'] == ""){
                                goto e;
                            }
                            else{
                                if($rows['rate'] > $_POST['maxPrice']){
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
                                        <p class="roomDescription">Rs. <?php echo $rows['rate'];?></p>
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

                                <div class="roomDetailAtom">
                                    <div class="roomTitles">
                                        <p class="roomTitle">Location</p>
                                    </div>
                                    <div class="roomDescriptions">
                                        <p class="roomDescription"><?php echo $rows['location'];?></p>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                                <div class="roomButton">
                                <div class="roomButtonAtom">            
                                        <input type="submit" value="See More" name="seeMore" id="seemore" >
                                        <input type="hidden" value="<?php echo $rows['r_id'];?>" name="room_id">
                                    </div>
                                    <div class="roomButtonAtom">
                                        <input type="submit" value="Add To Wishlist" id="addToWishlist" name="addToWishlist">
                                    </div>

                                </div>
                            </form>                        
                        </div>
                    </div>                                         
                <?php
                }
            }
        ?>
        </div>

        <div class="pageChangerClass">
            <abbr title="Load previous">
                <img src="../Assests/previous.png" alt="">
            </abbr>
            <p>01</p>
            <p id="currentPageNumber">02</p>
            <p>03</p>

            <abbr title="Load next">
                <img src="../Assests/next.png" alt="">
            </abbr>
        </div>
        </div>

        <!-- sharing on social medias : facebook, instagram -->
        <div class="socialShareClass" id="socialShareId">
            <a href="#">
                <div class="social1Class" id="social1Id">
                    <p id="social1ShortId">F</p>
                    <p id="social1MsgId">Share on facebook</p>
                </div>
            </a>

            <a href="#">
                <div class="social2Class" id="social2Id">
                    <p id="social2ShortId">I</p>
                    <p id="social2MsgId">Share on instagram</p>
                </div>
            </a>

            <a href="#">
                <div class="social3Class" id="social3Id">
                    <p id="social3ShortId">G</p>
                    <p id="social3MsgId">Share on gmail</p>
                </div>
            </a>

            <a href="#">
                <div class="social4Class" id="social4Id">
                    <p id="social4ShortId">P</p>
                    <p id="social4MsgId">Share on pinterest</p>
                </div>
            </a>
        </div>

        <!-- user option menu -->
        <div class="userOptionMenu" id="userMenuBox">
            <ul>
                <a href="profileTenant.html">
                    <li>My Profile </li>
                </a>
                <a href="signIn.html">
                    <li>Sign In/ Sign Out</li>
                </a>
            </ul>
        </div>

        </div>
                </div>
        

        <footer>
            <!-- <div class="footerSection">
            <div class="members">
                <h3>Member Section</h3>
                <p>Bishal Tamang</p>
                <p>Samir Shrestha</p>
                <p>Shristi Pradhan</p>
            </div>

            <div class="contact">
                <h3>Contact Section</h3>
                <p>9871425631</p>
                <p>Kantiput City College</p>
                <address> Putalisadak-2, Kathmandu </address>
            </div> -->
    </div>
    </footer>

    <script>        
        closeSeeMoreFunction = () => {
            document.getElementById('seeMoreDarkBackground').style = "visibility:hidden";
            document.getElementById('seeMoreDetailsId').style = "visibility:hidden";
            
        }
    </script>

    <script src="../Javascript/socialShare.js"></script>
    <script src="../Javascript/commonJs.js"></script>
    <!-- <script src="../Javascript/seeMore.js"></script> -->
</body>

</html>


 <!-- See More -->
 <?php if(isset($_POST['seeMore'])){ ?>
    <!-- background -->
    <div class="seeMoreDarkBackground" id="seeMoreDarkBackground" style="visibility: visible"> </div>

    <!-- showing room details using See More -->
    <div class="seeMoreDetailsClass" id="seeMoreDetailsId" style="visibility: visible">
        <abbr title="close">
            <p id="closeSeeMore" onclick="closeSeeMoreFunction()">&times;</p>
        </abbr>            
                
    <?php
        $room_id = $_POST['room_id'];          
        $md_r_sql = "SELECT * FROM `tbl_room` WHERE `r_id` = $room_id";                
        
        $md_r_res = mysqli_query($conn, $md_r_sql) or die(mysqli_close($conn));

        while($md_r_rows = mysqli_fetch_assoc($md_r_res)){
    ?>                
            <div class="seeMoreBasicSection">
            <div class="seeMoreImageSection">
            <div class="seeMoreImageSectionUp">                
                <?php
                        $md_img_sql = "SELECT `image` FROM `tbl_img` WHERE `r_id` = $room_id";
                        $md_img_res = mysqli_query($conn, $md_img_sql);
                        $md_img_rows_count = mysqli_num_rows($md_img_res);
                        while($md_img_rows = mysqli_fetch_array($md_img_res)){
                            if($md_img_rows_count > 0){
                    ?>
                                <img src="<?php echo $md_img_rows[0];?>" alt="roomImage" id="seeMoreActiveImage">
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
                            if($md_img_rows_count > 0){
                    ?>
                                <img src="<?php echo $md_img_rows[0];?>" alt="first image" id="seeMoreFirstImage">
                    <?php
                            }
                            else{
                    ?>
                                <img src="../Assests/Image/Architecture (1).jpg" alt="first image" id="seeMoreFirstImage">
                    <?php
                            }
                    ?>
                </div>

                <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(2)">
                    <?php
                            if($md_img_rows_count > 1){
                    ?>
                                <img src="<?php echo $md_img_rows[1];?>" alt="second image" id="seeMoreSecondImage">
                    <?php
                            }
                            else{
                    ?>
                                <img src="../Assests/Image/Architecture (2).jpg" alt="second image" id="seeMoreSecondImage">
                    <?php
                            }
                    ?>
                </div>

                <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(3)">
                    <?php
                            if($md_img_rows_count > 2){
                    ?>
                                <img src="<?php echo $md_img_rows[2];?>" alt="third image" id="seeMoreThirdImage">
                    <?php
                            }
                            else{
                    ?>
                                <img src="../Assests/Image/Architecture (3).jpg" alt="third image" id="seeMoreThirdImage">
                    <?php
                            }
                    ?>
                </div>

                <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(4)">
                    <?php
                            if($md_img_rows_count > 3){
                    ?>
                                <img src="<?php echo $md_img_rows[3];?>" alt="fourth image" id="seeMoreFourthImage">
                    <?php
                            }
                            else{
                    ?>
                                <img src="../Assests/Image/Architecture (4).jpg" alt="fourth image" id="seeMoreFourthImage">
                    <?php
                            }
                    ?>
                </div>
            </div>
        </div>
                
                <div class="basicDetailSection">
                    <div class="seeMoreDetail">
                        <?php
                            $foreign_key = $md_r_rows['f_id'];
                            $md_to_sql = "SELECT * FROM `tbl_to` WHERE `to_id` = $foreign_key";
                            $md_to_res = mysqli_query($conn, $md_to_sql);
                            $md_to_rows = mysqli_fetch_assoc($md_to_res);
                        ?>
                        <p class="seeMoreTitle"> Landlord Name</p>
                        <p class="seeMoreDescription"><?php echo $md_to_rows['name'];?></p>
                    </div>

                    <div class="seeMoreDetail">
                        <p class="seeMoreTitle">Contact</p>
                        <p class="seeMoreDescription">+977 <?php echo $md_to_rows['phone'];?></p>
                    </div>
                </div>
            </div>

            <div class="seeMoreDetailSection">
                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Room Type</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['type'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">BHK</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['bhk'];?></p>
                </div class="seeMoreDetail">

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Room Size</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['roomSize'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Floor</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['floor'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Furnishing</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['furnishing'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Address</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['location'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Services</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['services'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Price</p>
                    <p class="seeMoreDescription">: Rs. <?php echo $md_r_rows['price'];?></p>
                </div class="seeMoreDetail">

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Rent Type</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['per']."ly";?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Rating</p>
                    <p class="seeMoreDescription">: <?php echo $md_r_rows['rating'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Required Marital Status</p>
                    <p class="seeMoreDescription">: <?php echo $md_to_rows['marital_status'];?></p>
                </div>

                <div class="seeMoreDetail">
                    <p class="seeMoreTitle">Additional Note</p>
                    <p class="seeMoreDescription">: <?php echo $md_to_rows['note'];?></p>
                </div>

                <div class="ratingSection">
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
            
                <form action="" method="post">
                    <div class="seeMoreButtonSection">
                        <button id="seeMoreAddToWishlist" name="addToWishlist">Add to wishlist</button>
                        <input type="hidden" value="<?php echo $room_id;?>" name="room_id">
                    </div>
                </form>
            
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
            <script> alert("Successfully added to wish list"); </script>                
            <?php
        }
        else{
            ?>
            <script> alert("Already added to wish list"); </script>                
            <?php
        }
    }
?>
