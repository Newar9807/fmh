// <!-- Script to connect API -->
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPeDFdvyDNf8b0BsJLlxM-7sYnp50mNss&callback=initMap"> </script>
    // <!-- Script for map -->
    
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
    