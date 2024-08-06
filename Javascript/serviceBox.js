var temp;
var finalText;
var checkBox = [];
var services = [];
var box = document.getElementById('options');
var myArrow = document.getElementById('optionDropdown');
var triggerBox = document.getElementById('includerTextBox');
var initialText = triggerBox.value;

services[0] = document.getElementById('label1').innerHTML;
services[1] = document.getElementById('label2').innerHTML;
services[2] = document.getElementById('label3').innerHTML;
services[3] = document.getElementById('label4').innerHTML;

function showOptions() {
    if (optionBoxStatus === false) {
        box.style = "visibility:visible;";
        myArrow.style = "transform:rotate(180deg);";
        triggerBox.style = "border-bottom-left-radius:0px; border-bottom-right-radius:0px";
        optionBoxStatus = true;
    } else {
        box.style = "visibility:hidden;";
        myArrow.style = "transform:rotate(0deg); transition:0.3s";
        triggerBox.style = "border-bottom-left-radius:6px; border-bottom-right-radius:6px";
        optionBoxStatus = false;
    }
}

function changeFinalText() {
    // check for initial text
    checkBox[0] = document.getElementById('opt1');
    checkBox[1] = document.getElementById('opt2');
    checkBox[2] = document.getElementById('opt3');
    checkBox[3] = document.getElementById('opt4');

    finalText = "";
    if (checkBox[0].checked == true) {
        finalText += services[0];
    }
    if (checkBox[1].checked == true) {
        if (finalText != "") {
            finalText += ", " + services[1];
        } else {
            finalText += " " + services[1];
        }
    }
    if (checkBox[2].checked == true) {
        if (finalText != "") {
            finalText += ", " + services[2];
        } else {
            finalText += " " + services[2];
        }
    }
    if (checkBox[3].checked == true) {
        if (finalText != "") {
            finalText += ", " + services[3];
        } else {
            finalText += " " + services[3];
        }
    }
    triggerBox.value = finalText;
}

checkForChange = (target_option) => {
    if (target_option == 1) {
        temp = document.getElementById('opt1');
        if (temp.checked == true) {
            temp.checked = false;
        } else {
            temp.checked = true;
        }
        changeFinalText();
    } else if (target_option == 2) {
        temp = document.getElementById('opt2');
        if (temp.checked == true) {
            temp.checked = false;
        } else {
            temp.checked = true;
        }
        changeFinalText();
    }
    else if (target_option == 3) {
        temp = document.getElementById('opt3');
        if (temp.checked == true) {
            temp.checked = false;
        } else {
            temp.checked = true;
        }
        changeFinalText();
    } else {
        temp = document.getElementById('opt4');
        if (temp.checked == true) {
            temp.checked = false;
        } else {
            temp.checked = true;
        }
        changeFinalText();
    }
}