
<!-- Viewing room details on clicking [See More] -->
<div class="seeMoreDarkBackground" id="seeMoreDarkBackgroundId"> </div>

<!-- showing room details using See More -->
<div class="seeMoreLandlordContaineer" id="seeMoreLandlordContaineerId">
    <abbr title="close">
        <p id="closeSeeMore" onclick="closeSeeMoreFunction()">&times;</p>
    </abbr>

    <div class="seeMoreImageSection">
        <div class="seeMoreImageSectionUp">
            <img src="../Assests/Image/Architecture (1).jpg" alt="Room image" id="seeMoreActiveImage">
        </div>

        <div class="seeMoreImageSectionDown">
            <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(1)">
                <img src="../Assests/Image/Architecture (1).jpg" alt="first image" id="seeMoreFirstImage">
            </div>

            <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(2)">
                <img src="../Assests/Image/Architecture (2).jpg" alt="second image" id="seeMoreSecondImage">
            </div>

            <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(3)">
                <img src="../Assests/Image/Architecture (3).jpg" alt="third image" id="seeMoreThirdImage">
            </div>

            <div class="seeMoreImageCollection" onclick="changeSeeMoreImage(4)">
                <img src="../Assests/Image/Architecture (4).jpg" alt="fourth image" id="seeMoreFourthImage">
            </div>
        </div>
    </div>

    <div id="detailContaineer">
        <div id="detailSection">
            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Room Type</p>
                <p class="seeMoreDescription">Flat</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">BHK</p>
                <p class="seeMoreDescription">2</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Room Size</p>
                <p class="seeMoreDescription">Large</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Floor</p>
                <p class="seeMoreDescription">5</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Furnishing</p>
                <p class="seeMoreDescription">Fully Furnished</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Address</p>
                <p class="seeMoreDescription">Anamnagar, Kathmandu</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Services</p>
                <p class="seeMoreDescription">Internet, TV, Drinking Water</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Price</p>
                <p class="seeMoreDescription">Rs. 59,000</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Rent Type</p>
                <p class="seeMoreDescription">Monthly</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Rating</p>
                <p class="seeMoreDescription">3.8</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Required Marital Status</p>
                <p class="seeMoreDescription">Married</p>
            </div>

            <div class="detailSectionAtom">
                <p class="seeMoreTitle">Additional Note</p>
                <p class="seeMoreDescription" style="height:100px; overflow:hidden">Additional notes about the
                    room..
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit possimus a vel accusamus,
                    explicabo error nihil et natus omnis libero assumenda, rerum dolorum odio placeat velit fuga
                    quod delectus quis?
                </p>
            </div>
        </div>

        <div id="buttonSection">
            <input type="submit" value="Remove Room" id="removeMyRoom" onclick="showNotification('Room has been removed successfully.')">
        </div>
    </div>
</div>