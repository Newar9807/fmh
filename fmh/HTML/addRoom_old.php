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
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/socialShare.css">   
    
    <link rel="stylesheet" href="../CSS/footer.css">
    

    <link rel="icon" type="image/x-icon" href="../Assests/salad.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery/min/js"></script>

    <!-- Script to connect API -->
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPeDFdvyDNf8b0BsJLlxM-7sYnp50mNss"></script>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
        body{
            display: flex;
            justify-content: center;
            /* text-align: right; */
            align-items: center;
            height: 100vh;
            margin: 0px;  
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .addRoomClass {
            width: 360px;
            padding: 10px 10px 5px 10px;
            margin: auto;
            border-radius: 0px;
            float: right;
            transition: .3s ease-in-out;
            /* border: 0px solid snow; */
        }
        footer {
            visibility: hidden;
            color: white;
            /* height: 100px; */
            height: 150px;
            width: 100%;
            bottom: 0px;
            margin-top: 105px;
            position: fixed;
            background-color: #323131;
        }
        div#map {
            margin-right: 11px;
            height: 100%;
            /* z-index: -1; */            
            width: 1100px;
            border: 0px solid snow;
            transition: .3s ease-in-out; 
            /* filter: invert(100%); */
        }
        div#map:hover{
            box-shadow: -2px 2px 2px 2px #b6b3b3;
        }
        .addRoomClass:hover{
            box-shadow: -2px 2px 2px 2px #b6b3b3;
        }
        .blk{
            display: inherit;
        }
    </style>
    

</head>

<body>
    <!-- navigation bar -->
    <nav>
        <!-- nav >> logo area -->
        <div class="navLogoClass">
            <a href="homeLandlord.html">
                <h3>FindMe<span>Home</span></h3>
            </a>
        </div>

        <!-- nav >> links -->
        <div class="navLinkClass">
            <ul>
                <li><a href="homeLandlord.html"> My Rooms </a></li>
                <li><a href="addRoom.html"> Add Room </a></li>
                <li><a href="tutorialLandlord.html"> Tutorial </a></li>
            </ul>
        </div>

        <!-- mav >> user menu -->
        <div class="navProfileClass" id="navProfileId">
            <abbr title="User Profile">
                <img src="../assests/salad.png" alt="" id="navUserId" onclick="showUserMenu()">
            </abbr>
        </div>
    </nav>

    
    <div class="blk">
        <div class="mapAreaClass">
            <div id="map">Map</div>
            <form action="room_core.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" id="lat" name="lat" value="Latitude">
            <input type="hidden" id="lng" name="lng" value="Longitude">
        </div>

        <div class="addRoomClass" id="addRoomId">
            
            <!-- <form action="" method="" autocomplete="off"> -->
                <h3 id="formHeadingId">Add New Room</h3>
                
                <?php
                    if(isset($_SESSION['comment'])){
                        echo $_SESSION['comment'];
                        unset($_SESSION['comment']);
                    }
                ?>
                <hr>

                <!-- room type -->
                <div class="roomTypeClass">
                    <div style="margin-left:2px; margin-right: 42px;">
                        <p>Type</p>
                    </div>

                    <div class="roomTypeFLat">
                        <input type="radio" name="type" id="flat" value="flat" onclick="roomTypeFunction('flat')">
                        <label for="flat">Flat</label>
                    </div>

                    <div class="roomTypeRoom">
                        <input type="radio" name="type" id="room" value="room" onclick="roomTypeFunction('room')">
                        <label for="room">Room</label>
                    </div>
                </div>
                <!-- picture of a room -->
                <div style="display: flex; height: 30px;">
                    <label for="roomPhoto">Choose room photo</label>
                    <input type="file" id="roomPhoto" name="files[]" accept=".jpg, jpeg" multiple>
                </div>

                <!-- if room type = flat -->
                <input type="number" name="bhk" id="roomBhk" placeholder="BHK" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" style="display: none;">

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

                <!-- required marital status -->
                <!-- <select name="" id="">
                    <option value="" disabled selected hidden>Marital Status</option>
                    <option value="">Unmarried</option>
                    <option value="">Married</option>
                    <option value="">Don't Care</option>
                </select> -->

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
                <input type="text" name="services" placeholder="Services">

                <!-- rent amount -->
                <input type="number" name="price" id="" placeholder="Rent Amount" style="display: inline; width: 165px;">

                <!-- rent type : monthly or annual -->
                <select name="per" id="" style="display: inline; width: 129px;">
                    <option value="" disabled selected hidden>Rent Type</option>
                    <option value="month">Monthly</option>
                    <option value="annual">Annual</option>
                </select>

                <!-- price negotiable or not -->
                <select name="nego" id="">
                    <option value="" disabled selected hidden>Negotiable/ Non-negotiable</option>
                    <option value="Negotiable">Negotiable</option>
                    <option value="Non Negotiable">Non-negotaible</option>
                </select>

                <!-- additional note for room -->
                <!-- <textarea name="message" id="" cols="30" rows="10" placeholder="Write Something about the room..."></textarea> -->
                
                <div class="buttonAreaClass">
                    <!-- <button name="reset" id="resetBtnId">Reset</button>
                    <button name="add" id="btn">Add</button> -->
                    <input type="submit" value="Reset" id="resetBtnId" name="reset" class="sub"></input>
                    <input type="submit" value="Add" id="btn" name="add" class="sub" onclick=""></input>
                </div>
            </form>
        </div>
    </div>



    <!-- sharing on social medias : facebook, instagram -->
    <!-- <div class="socialShareClass" id="socialShareId">
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
    </div> -->


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
        var roomType;

        function roomTypeFunction(roomType) {
            if (roomType == "room") {
                document.getElementById('roomBhk').style = "display:none";
            } else {
                document.getElementById('roomBhk').style = "display:block";
            }
        }
    </script>

    <!-- Script to connect API -->
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPeDFdvyDNf8b0BsJLlxM-7sYnp50mNss&callback=initMap"> </script>
    <!-- Script for map -->
    <script>
        let y,z;

        function mapTour(y, z){
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 14,center: { lat: y, lng: z },});
            var marker = new google.maps.Marker({
                position: { lat: y, lng: z },
                map: map,
                draggable: true,
                icon: 'pinn.png',
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

    <script src="../Javascript/socialShare.js"></script>
    <script src="../Javascript/commonJs.js"></script>
</body>

</html>