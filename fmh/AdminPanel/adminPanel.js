var active_menu = 0;
var menuList = document.querySelectorAll('.menu-option');
var contentList = document.querySelectorAll('.content');

var darkBackground = document.getElementsByClassName('dark-background')[0];
darkBackground.style = "visibility:hidden";

menuList[0].style = "font-weight:bold";
contentList[1].style = "display:none";
contentList[2].style = "display:none";

menuList[0].addEventListener('click', function () {
    menuList[0].style = "font-weight:bold";
    menuList[1].style = "font-weight:normal";
    menuList[2].style = "font-weight:normal";

    contentList[0].style = "display:block";
    contentList[1].style = "display:none";
    contentList[2].style = "display:none";
});

menuList[1].addEventListener('click', function () {
    menuList[0].style = "font-weight:normal";
    menuList[1].style = "font-weight:bold";
    menuList[2].style = "font-weight:normal";

    contentList[0].style = "display:none";
    contentList[1].style = "display:block";
    contentList[2].style = "display:none";
});

menuList[2].addEventListener('click', function () {
    menuList[0].style = "font-weight:normal";
    menuList[1].style = "font-weight:normal";
    menuList[2].style = "font-weight:bold";

    contentList[0].style = "display:none";
    contentList[1].style = "display:none";
    contentList[2].style = "display:block";
});

var replyBox = document.getElementsByClassName('feedback-reply-box')[0];

function viewFeedbackReply() {
    darkBackground.style = "visibility:visible";
    replyBox.style = "display:block";
}

function closeFeedbackReply() {
    darkBackground.style = "visibility:hidden";
    replyBox.style = "display:none";
}

var userBox = document.getElementsByClassName('user-detail-popup')[0];
userBox.style = "display:none";

function showUserDetail(){
    userBox.style = "display:flex";
    darkBackground.style = "visibility:visible";
}

function closeUserDetail(){
    userBox.style = "display:none";
    darkBackground.style = "visibility:hidden";
}

// slider
var current_user = "landlord";
var temp = document.getElementsByClassName('user-slider')[0];

function changeUser(){    
    if(current_user == "landlord"){
        temp.style = "margin-left:25px"
        current_user ="tenant";
    }else{
        temp.style = "margin-left:0px"
        current_user ="landlord";
    }
}