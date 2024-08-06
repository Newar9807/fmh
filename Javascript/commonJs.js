var wishlist_event_dummy = 1;
var mini_menu_status = 0;

showUserMenu = () => {
    document.getElementById('extentedUserMenu').style = "visibility:hidden";
    if (mini_menu_status == 0) {
        userMenuBox.style = "visibility:visible";
        mini_menu_status = 1;
    } else {
        userMenuBox.style = "visibility:hidden";

        mini_menu_status = 0;
    }
}


// password toggler : single case
passwordVisibilityToggler = (whose) => {
    if (whose.type == "password") {
        whose.type = "text";
    } else {
        whose.type = "password";
    }
}

// password toggler : dual case
changePwVisibility = (whose1, whose2) => {
    if (whose1.type == "password") {
        whose1.type = "text";
        whose2.type = "text";
    } else {
        whose1.type = "password";
        whose2.type = "password";
    }
}

// function to add/remove room to/from wishlist
function toggleWishlist(wishlist_event, addToWishlistButton) {
    if (wishlist_event == 1) {
        wishlist_event = 2;
        addToWishlistButton.src = "../Assests/redheart.png";
        showNotification('Room has been added to your wishlist');
    } 
    else {
        wishlist_event = 1;
        addToWishlistButton.src = "../Assests/favorite.png";
        showNotification('Room has been removed from your wishlist');
    }
}

// close sign out confirmation containeer
function closeSignOut(){
    document.getElementById('seeMoreDarkBackgroundId').style.visibility = "hidden";
    document.getElementById('signOutConfirmationContaineerId').style.visibility = "hidden";
}

// close notification containeer
function closeNotification(){
    document.getElementById('notificationContaineerId').style.visibility = "hidden";
}

// showing message as a notification
var notification_timer;
showNotification = (notification_text) =>{
    clearTimeout(notification_timer);
    document.getElementById('notificationContaineerId').style.visibility = "visible";
    document.getElementById('notificationText').innerText = notification_text;

    notification_timer = setTimeout(hideNotification, 4000);
}

function hideNotification(){
    document.getElementById('notificationContaineerId').style.visibility = "hidden";
    clearTimeout(notification_timer);
}