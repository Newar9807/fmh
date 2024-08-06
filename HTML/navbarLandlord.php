<nav class="navbar">
    <div class="navContaineer">
        <!-- logo section -->
        <div class="navLogo">
            <a href="homeLandlord.php">
                <h3>FindMe<span style="color: orange; font-family: 'Script mt';">Home</span></h3>
            </a>
        </div>

        <!-- link section -->
        <div class="navLinkContaineer">
            <div class="navLink">
                <ul>
                    <a href="homeLandlord.php">
                        <li> My Rooms </li>
                    </a>
                    <a href="addRoom.php">
                        <li> Add Room</li>
                    </a>
                    <a href="tutorialLandlord.php">
                        <li> Tutorial </li>
                    </a>
                </ul>
            </div>
        </div>

        <!-- user-menu section -->
        <div class="navProfile" id="navProfileId">
            <abbr title="User Profile">
                <img src="../assests/Image/Architecture (1).jpg" alt="" id="navUserId" onclick="showUserMenu()">
                <img src="../assests/menu-icon.png" alt="" id="navMenuId">
            </abbr>
        </div>
    </div>
</nav>


<link rel="stylesheet" href="../CSS/navbar.css">

<!-- js section -->
<script>
    const miniMenuEvent = document.querySelectorAll('.navProfile img')[1];

    miniMenuEvent.addEventListener('click', function() {
        userMenuBox.style = "visibility:hidden";
        if (mini_menu_status == 0) {
            document.getElementById('extentedUserMenu').style = "visibility:visible";
            mini_menu_status = 1;
        } else {
            document.getElementById('extentedUserMenu').style = "visibility:hidden";
            mini_menu_status = 0;
        }
    })
</script>