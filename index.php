<?php

//phpinfo();

?>

<!DOCTYPE html>

<html>

<head> 

    <meta charset="utf-8" />        
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>Home page</title>

    <!-- Favicon -->
    <meta name="msapplication-TileImage"content="images/favicons/tile.png"> <!-- Windows 8 -->
    <meta name="msapplication-TileColor" content="#00CCFF"/> <!-- Windows 8 color -->
    <!--[if IE]><link rel="shortcut icon" href="images/favicons/favicon.ico"><![endif]-->
    <link rel="icon" type="image/png" href="images/favicons/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicons/apple-touch-icon-precomposed-144x144.png"><!-- iPad Retina-->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicons/apple-touch-icon-precomposed-114x114.png"><!--iPhone Retina -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicons/apple-touch-icon-precomposed-72x72.png"><!-- iPad 1 e 2 -->
    <link rel="apple-touch-icon-precomposed" href="images/favicons/apple-touch-icon-precomposed-57x57.png"><!-- iPhone, iPod e Android 2.2+ -->

    <script type="text/javascript">

        function getLocation() {
            try {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            console.log('position detection ok');
                            var lat = position.coords.latitude;
                            var lon = position.coords.longitude;
                            document.getElementById("lat").innerHTML = lat.toFixed(6);
                            document.getElementById("lon").innerHTML = lon.toFixed(6);
                        },
                        function () {
                            console.log('position detection fail!');
                            document.getElementById("pos").innerHTML = "position N/A";
                        }
                    );
                } else {
                    document.getElementById("pos").innerHTML = "Geolocation is not supported by this browser.";
                }                
            }
            catch(e) {
                document.getElementById("pos").innerHTML = "error: " + e;    
            }
        }


        function reload() {            

            getLocation();
            setTimeout('reload()', 2000);  
        }

        function init() {

            // see https://girliemac.com/presentation-slides/html5-mobile-approach/deviceAPIs.html
            
            //
            // Battery
            //

            var battery = navigator.battery || navigator.webkitBattery;

            if (battery) {

                battery.addEventListener('chargingchange', function () {
                    document.getElementById("blev").innerHTML = '' + battery.level * 100 + ' %';
                });

                battery.addEventListener('levelchange', function () {
                    document.getElementById("bstat").innerHTML = battery.charging ? 'charging ...' : 'NOT charging';
                });

            }
            else {

                document.getElementById("blev").innerHTML = 'N/A'; 
                document.getElementById("bstat").innerHTML = 'N/A';

            }

            //
            // Device orientation
            //

            if (window.DeviceOrientationEvent) {

              window.addEventListener('deviceorientation', function(e) {
                
                a = Math.floor(e.alpha);
                b = Math.floor(e.beta);
                g = Math.floor(e.gamma);
            
                document.getElementById("doa").innerHTML = a; 
                document.getElementById("dob").innerHTML = b;
                document.getElementById("dog").innerHTML = g;


                //el.style.transform = 'rotateZ('+a+'deg) 
                //                   rotateX('+b+'deg) rotateY('+g+'deg)';
                //... }, true);
              
              });
            

            }
            else {

                document.getElementById("doa").innerHTML = 'N/A'; 
                document.getElementById("dob").innerHTML = 'N/A';
                document.getElementById("dog").innerHTML = 'N/A';

            }

            //
            // Motion
            // 
            if (window.DeviceMotionEvent) {
                
                window.addEventListener('devicemotion', function () {
                    document.getElementById("dmx").innerHTML = event.acceleration.x;
                    document.getElementById("dmy").innerHTML = event.acceleration.y;
                }, true);

            }
            else {

                document.getElementById("dmx").innerHTML = 'N/A'; 
                document.getElementById("dmy").innerHTML = 'N/A';

            } 

            //
            // Light sensors
            //

            window.addEventListener('devicelight', function(e) {                
                document.getElementById("lux1").innerHTML = e.value; // value in double
                //< 400   Indoor
                //400-1000    Office lighting. Outdoor (in foggy San Francisco)
                //> 1000  Outdoor daylight (anywhere else in California)
            }); 
           

            window.addEventListener('lightlevel', function(e) {
                document.getElementById("lux2").innerHTML = e.value; // value in double
                //dim < 50 lux    dark enough that the light produced by a white background is eye-straining or distracting
                //normal  50-10000 lux    office building hallway, very dark overcast day, office lighting, sunrise or sunset on a clear day, overcast day, or similar
                //bright  > 10000 lux direct sunlight, or similarly bright conditions that make it hard to see things that aren't high-contrast
            }); 

            //
            // Proximity sensors
            //

            window.addEventListener('deviceproximity', function(e) {
                document.getElementById("prox1").innerHTML = e.value; // value in double
            }, function(e) {
                document.getElementById("prox1").innerHTML = "N/A"; 
            });

            window.addEventListener('userproximity', function(e) {
               document.getElementById("prox2").innerHTML = e.value; // value in double
            }); 

            //
            // Continuously monitoring functions
            //

            reload(); 


        }


    </script>

</head>

<body onload="init()">

<div>
    
    <h3>Device info</h3>
    
    <table>
    
        <tr>
            <td colspan="2" id="pos"><b>Position</b></td>
        </tr> 
        <tr>
            <td>Latitude</td>
            <td id="lat" align="right"></td>
        </tr>
        <tr>
            <td>Longitude</td>
            <td id="lon" align="right"></td>
        </tr>

        <tr>
            <td colspan="2" id="pos"><b>Battery</b></td>
        </tr> 
        <tr>
            <td>status</td>
            <td id="bstat" align="right"></td>
        </tr>
        <tr>
            <td>level</td>
            <td id="blev" align="right"></td>
        </tr>   

        <tr>
            <td colspan="2" id="pos"><b>Device Orientation</b></td>
        </tr> 
        <tr>
            <td>&alpha;</td>
            <td id="doa" align="right"></td>
        </tr>
        <tr>
            <td>&beta;</td>
            <td id="dob" align="right"></td>
        </tr>
        <tr>
            <td>&gamma;</td>
            <td id="dog" align="right"></td>
        </tr>

        <tr>
            <td colspan="2" id="pos"><b>Light sensors</b></td>
        </tr> 
        <tr>
            <td>light 1</td>
            <td id="lux1" align="right"></td>
        </tr>
        <tr>
            <td>light 2</td>
            <td id="lux2" align="right"></td>
        </tr>

        <tr>
            <td colspan="2" id="pos"><b>Proximity</b></td>
        </tr> 
        <tr>
            <td>proximity 1</td>
            <td id="prox1" align="right"></td>
        </tr>
        <tr>
            <td>proximity 2</td>
            <td id="prox2" align="right"></td>
        </tr>

        <tr>
            <td colspan="2" id="pos"><b>Motion</b></td>
        </tr> 
        <tr>
            <td>X</td>
            <td id="dmx" align="right"></td>
        </tr>
        <tr>
            <td>Y</td>
            <td id="dmy" align="right"></td>
        </tr>
        
    </table>

</div>

</body>

</html>
