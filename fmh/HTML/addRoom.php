<?php include('include.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>

    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/userOption.css">
    <link rel="stylesheet" href="../CSS/addRoom.css">
    <link rel="stylesheet" href="../CSS/serviceBox.css">
    <link rel="stylesheet" href="../CSS/extentedMenu.css">

    <link rel="icon" type="image/x-icon" href="../Assests/logo.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery/min/js"></script>

    <!-- Script to connect API -->
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPeDFdvyDNf8b0BsJLlxM-7sYnp50mNss"></script>
    
</head>

<body>
    <!-- common navbar -->
    <?php include 'navbarLandlord.php';?>
    <!-- <nav class="navbar"> </nav> -->

    <!-- room containeer -->
    <div id="addRoomContaineer">
        <!-- google map appears here -->
        <div class="addRoomLeftSection">
            <!-- <img src="../Assests/Sample map.png" alt=""> -->
            <div class="mapAreaClass">
            <div id="map" style="height: 555px;">Map</div>
        <form action="room_core.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" id="lat" name="lat" value="Latitude">
                <input type="hidden" id="lng" name="lng" value="Longitude">
            </div>
        </div>

        <div class="addRoomRightSection">
            <!-- <form action="room_core.php" method="post" enctype="multipart/form-data" autocomplete="off"> -->
                <h3 id="formHeadingId">Add New Room</h3>
                <p id="addRoomMessage">
                    <?php
                        if(isset($_SESSION['comment'])){
                            echo $_SESSION['comment'];
                            unset($_SESSION['comment']);
                        }
                    ?>
                </p>
                <hr>

                <!-- room type selection section  -->
                <div id="romTypeSection">
                    <div id="roomTypeLabel">
                        <p>Rooom type</p>
                    </div>

                    <div id="roomTypeOption">
                        <input type="radio" name="type" id="room_type_flat" value="flat" onchange="addRoom_roomType_trigger(0)" checked>
                        <label for="room_type_flat">Flat</label>

                        <input type="radio" name="type" id="room_type_separate" value="single room" onchange="addRoom_roomType_trigger(1)">
                        <label for="room_type_separate">Single</label>
                    </div>
                </div>

                <!-- picture of a room -->
                <div id="roomFile">
                    <label for="roomPhoto">Choose room photo</label>
                    <input type="file" id="roomPhoto" name="files[]" accept=".jpg, .jpeg" multiple>
                </div>

                <!-- if room type = flat -->
                <input type="number" name="bhk" id="roomBhk" placeholder="BHK" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;">

                <select name="room_size" id="room_size">
                    <option value="" disabled selected hidden>Room Size [FT.+(AREA)]</option>
                    <option value="large">Large [22*28 (616)]</option>
                    <option value="medium">Medium [16*20 (320)]</option>
                    <option value="small">Small [12*18 (216)]</option>
                    <option value="very small">Very Small [10*12 (120)]</option>
                </select>

                <!-- floor of a room -->
                <input type="number" name="floor" id="" placeholder="Floor" pattern="/^-?\d+\.?\d*$/"
                    onKeyPress="if(this.value.length==1) return false;">

                <!-- is room furnished or not -->
                <select name="furnished" id="furnished">
                    <option value="" disabled selected hidden>Furnishing</option>
                    <option value="full furnished">Fully furnished</option>
                    <option value="semi furnished">Semi furnished</option>
                    <option value="not furnished">Not furnished</option>
                </select>

                <!-- location of room -->
                <input type="text" name="location" id="location" placeholder="Location" onkeyup="get()">

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
                <input type="number" name="price" id="" placeholder="Rent Amount">

                <!-- rent type : monthly or annual -->
                <select name="per" id="">
                    <option value="" disabled selected hidden>Rent Type</option>
                    <option value="month">Monthly</option>
                    <option value="annual">Annually</option>
                </select>

                <!-- price negotiable or not -->
                <select name="nego" id="">
                    <option value="" disabled selected hidden>Negotiable/ Non-negotiable</option>
                    <option value="Negotiable">Negotiable</option>
                    <option value="Non Negotiable">Non-negotaible</option>
                </select>

                <!-- additional note for room -->
                <!-- <textarea name="message" id="note" cols="30" rows="10" placeholder="Write Something about the room..."></textarea> -->

                <div id="buttonSection">
                    <div class="buttonSectionAtom">
                        <input type="submit" value="Reset" name="reset" id="resetBtnId">
                    </div>
                    <div class="buttonSectionAtom">
                        <input type="submit" value="Add" name="add" id="addBtnId" onclick="showNotification('New room details have been added.')">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- user option menu -->
    <div class="userOptionMenu" id="userMenuBox">
        <ul>
            <a href="profile landlord.html">
                <a href="profileLandlord.html">
                    <li>My Profile </li>
                </a>
            </a>
            <a href="signIn.html">
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

    <!-- notification section -->
    <div class="notificationContaineer" id="notificationContaineerId">
        <div class="notificationCloseSection">
            <p id="closeNotification" onclick="closeNotification()">&times;</p>
        </div>
    
        <div class="notificationTextSection">
            <p id="notificationText"></p>
        </div>
    </div>

    <!-- extented user menu : common -->
    <?php include 'extentedMenuLandlord.php';?>
    <!-- <aside id="extentedUserMenu" class="extentedUserMenuClass"> </aside> -->

    <!-- common social-share section -->
    <?php include 'socialshare.php';?>
    <!-- <div class="socialMainContaineer"> </div> -->

    <!-- common footer section -->
    <?php include 'footer.php';?>
    <!-- <footer class="footerbar"> </footer> -->

    <script>
        var target_id;
        var optionBoxStatus = false;
        var room_type_number;

        addRoom_roomType_trigger = (room_type_number)=>{
            target_id = document.getElementById('roomBhk');
            if(room_type_number==1){
                target_id.style="display:none";
            }else{
                target_id.style="display:block";
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