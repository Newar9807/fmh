<?php include('include.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/roomTenant.css">
    <link rel="stylesheet" href="../CSS/pageNumber.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/seeMoreTenant.css">
    <link rel="stylesheet" href="../CSS/wishlist.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">
</head>

<body>
    <!-- common nav bar -->
    <?php include 'navbarTenant.php';?>

    <!-- main body area -->
    <div class="article">
        <h2 style="margin-left: 10px; line-height: 34px;">Rooms from your wishlist</h2>

        <div class="roomContaineer">
            <!-- Fetches the room details from database -->
            <?php

                $wish_sql = "SELECT r_id FROM `tbl_wishlist`";
                $wish_res = mysqli_query($conn, $wish_sql) or die(mysqli_close($conn));
                
                $r_sql= "SELECT * FROM `tbl_room`";
                $r_res = mysqli_query($conn, $r_sql) or die(mysqli_close($conn));            

                if(($r_res == true) && ($wish_res == true)){
                    //Query executed successfully
                    $wish_rows = mysqli_fetch_all($wish_res);
                    if(empty($wish_rows)){                    
                        echo "<span class='fail'><b><center>Wishlist is Empty</center><b></span>";
                        goto skp;                 
                    }             
                        while($rows = mysqli_fetch_assoc($r_res)){
                            foreach($wish_rows as $wish_row){
                                $wish_room_chk = false;
                                if($wish_row[0] == $rows['r_id']){
                                    $wish_room_chk = true;
                                    break;
                                }
                            }                        
                            if($wish_room_chk == false){
                                continue;
                            }
                    
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
                                                <input type="submit" value="Remove" id="removeFromWishlist" name="removeFromWishlist">
                                            </div>

                                            <div class="roomButtonAtom">            
                                                <input type="submit" value="See More" name="seeMore" id="seemore" >
                                                <input type="hidden" value="<?php echo $rows['r_id'];?>" name="room_id">
                                            </div>
                                        </div>    
                                    </form>                        
                            </div>
                        </div>                                         
                    <?php
                    }
                }
                skp:
            ?>
        </div>

        <!-- page changer section -->
        <!-- <div id="pageChanger">
            <div class="pageAlternators" id="previousPage">
                <abbr title="Load previous"> <img src="../Assests/previous.png" alt="previous.png"> </abbr>
            </div>  

            <div id="pageNumberContaineer">
                <div class="pageNumber" id="currentPageNumber">
                    <p>01</p>
                </div>
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
        </div> -->
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

    <!-- extented user menu : common -->
    <?php include 'extentedMenuTenant.php';?>

    <!-- coomon social share section -->
    <?php include 'socialShare.php';?> 

    <!-- common footer -->
    <?php include 'footer.php';?>

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
                        <?php
                            $md_img_sql = "SELECT `image` FROM `tbl_img` WHERE `r_id` = $room_id";
                            $md_img_res = mysqli_query($conn, $md_img_sql);                                
                            while($md_img_rows = mysqli_fetch_array($md_img_res)){
                        ?>
                        <img src="<?php echo $md_img_rows[0];?>" alt="roomImage">
                        <?php
                            break;
                            }
                        ?>
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
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['room_size'];?></p>
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
                        <p class="seeMoreDescription">: Rs. <?php echo $md_r_rows['rate'];?></p>
                    </div class="seeMoreDetail">

                    <div class="seeMoreDetail">
                        <p class="seeMoreTitle">Rent Type</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['per']."ly";?></p>
                    </div>                

                    <div class="seeMoreDetail">
                        <?php
                            $foreign_key = $md_r_rows['f_id'];
                            $md_to_sql = "SELECT * FROM `tbl_to` WHERE `to_id` = $foreign_key";
                            $md_to_res = mysqli_query($conn, $md_to_sql);
                            $md_to_rows = mysqli_fetch_assoc($md_to_res);
                        ?>
                        <p class="seeMoreTitle">Required Marital Status</p>
                        <p class="seeMoreDescription">: <?php echo $md_to_rows['marital_status'];?></p>
                    </div>

                    <div class="seeMoreDetail">                    
                        <p class="seeMoreTitle">Landlord Name</p>
                        <p class="seeMoreDescription"><?php echo $md_to_rows['name'];?></p>
                    </div>

                    <div class="seeMoreDetail">
                        <p class="seeMoreTitle">Contact</p>
                        <p class="seeMoreDescription">+977 <?php echo $md_to_rows['phone'];?></p>
                    </div>

                    <div class="seeMoreDetail">
                        <p class="seeMoreTitle">Rating</p>
                        <p class="seeMoreDescription">: <?php echo $md_r_rows['rating'];?></p>
                    </div>

                    <div class="seeMoreDetail">
                        <p class="seeMoreTitle">Additional Note</p>
                        <p class="seeMoreDescription">: <?php echo $md_to_rows['note'];?></p>
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

                    <input type="submit" value="Submit Rating">
                
                    <form action="" method="post">
                        <div class="seeMoreButtonSection">
                            <button type="submit" name="removeFromWishlist" value="REMOVE" style="border:0px; background-color:white;">
                                <!-- <img src="../Assests/Wishlist1.png" alt="Wishlist Icon" id="addToWishlistIcon"
                                onclick="toggleWishlist('add', addToWishlistIcon)"> -->

                            </button>
                            <input type="hidden" value="<?php echo $room_id;?>" name="room_id">
                        </div>
                    </form>
                
                <?php
            }
        }
    ?>

    <!-- linking javascript files -->
    <script src="../Javascript/commonJs.js"></script>
    <script src="../Javascript/seeMore.js"></script>
</body>

</html>



<!-- Remove Wish List -->
<?php if(isset($_POST['removeFromWishlist'])){ ?>
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
        $stored_wish = "DELETE FROM `fmh`.`tbl_wishlist` WHERE `r_id` = $room_id";
        $stored_wish_res = mysqli_query($conn, $stored_wish) or die(mysqli_close($conn));
        
        if($stored_wish_res == true){                                                      
                ?> 
                <script>
                location.replace("http://localhost/findmehome/html/homeTenant1.php");                    
                </script>
                <?php      
            // Refreshes current page
            // header("Refresh:0");

            // Refreshes the url page
            // header_remove("location:".WISHLIST);
            // header("location:".TENANT1);
            // header("location:".TENANT1);

        }
    }
?>