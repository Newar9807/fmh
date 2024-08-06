<nav class="navbar">
    <div class="navContaineer">
        <!-- logo section -->
        <div class="navLogo">
            <a href="homeTenant1.php">
                <h3>FindMe<span style="color: orange; font-family: 'Script mt';">Home</span></h3>
            </a>
        </div>

        <!-- nav-section -->
        <div class="navLinkContaineer">
            <div class="navLink">
                <ul>
                    <a href="homeTenant1.php">
                        <li> Home </li>
                    </a>
                    <a href="wishlist.php">
                        <li>Wishlist </li>
                    </a>
                    <a href="tutorialTenant.php">
                        <li> Tutorial </li>
                    </a>
                </ul>
            </div>
        </div>

        <!-- user-menu_selection -->
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