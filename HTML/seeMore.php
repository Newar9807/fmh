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
                    <div id="buttonSection">
                        <input type="submit" value="Remove Room" id="removeMyRoom" onclick="showNotification('Room has been removed successfully.')">
                    </div>
                </div>
            </div>

        <?php
            }
        }
    ?>
        </div>