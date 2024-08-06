<div class="socialMainContaineer">
    <div class="socialContaineer" id="socialContaineerId">
        <div class="socialClass1" id="socialId1" onmouseover="socialToggle(1, 'c1')"
            onmouseleave="socialToggle(0, 'c1')">
            <a href="#">
                <p id="socialLink1">F</p>
            </a>
        </div>

        <div class="socialClass2" id="socialId2" onmouseover="socialToggle(1, 'c2')"
            onmouseleave="socialToggle(0, 'c2')">
            <a href="#">
                <p id="socialLink2"> I </p>
            </a>
        </div>

        <div class="socialClass3" id="socialId3" onmouseover="socialToggle(1, 'c3')"
            onmouseleave="socialToggle(0, 'c3')">
            <a href="#">
                <p id="socialLink3"> G </p>
            </a>
        </div>

        <div class="socialClass4" id="socialId4" onmouseover="socialToggle(1, 'c4')"
            onmouseleave="socialToggle(0, 'c4')">
            <a href="#">
                <p id="socialLink4"> P </p>
            </a>
        </div>
    </div>
</div>

<link rel="stylesheet" href="../CSS/socialShare.css">

<script>
    var target_div, target_link;


    socialToggle = (currentEvent, x) => {
        if (x == 'c1') {
            target_div = document.getElementById('socialId1');
            target_link = document.getElementById('socialLink1');
        } else if (x == 'c2') {
            target_div = document.getElementById('socialId2');
            target_link = document.getElementById('socialLink2');
        } else if (x == 'c3') {
            target_div = document.getElementById('socialId3');
            target_link = document.getElementById('socialLink3');
        } else {
            target_div = document.getElementById('socialId4');
            target_link = document.getElementById('socialLink4');
        }

        if (currentEvent == 1) {
            target_div.style = "left:-117px; width:150px";

            if (x == 'c1') {
                target_link.innerHTML = "Share on Facebook";
            } else if (x == 'c2') {
                target_link.innerHTML = "Share on Instgram";
            } else if (x == 'c3') {
                target_link.innerHTML = "Share on Gmail";
            } else {
                target_link.innerHTML = "Share on Pinterest";
            }

        } else if (currentEvent == 0) {
            target_div.style = "left:0px; width:32px";

            if (x == 'c1') {
                target_link.innerHTML = "F";
            } else if (x == 'c2') {
                target_link.innerHTML = "I";
            } else if (x == 'c3') {
                target_link.innerHTML = "G";
            } else {
                target_link.innerHTML = "P";
            }
        }
    }
</script>