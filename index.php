<?php

include('include/db.php');

echo MYSQL_HOST . ", " . MYSQL_USER . ", " . MYSQL_PASS . ", " . MYSQL_DB . ", " . MYSQL_PORT . "<br>"; 

$mysqli = mysqli_connect( MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB, MYSQL_PORT );
$mysqli_close( $mysqli );

echo "OK";


?>

<!DOCTYPE html>

<html>

<head> 

    <meta charset="utf-8" />        
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>TEST WITH MYSQL</title>

    <!-- Favicon -->
    <meta name="msapplication-TileImage"content="images/favicons/tile.png"> <!-- Windows 8 -->
    <meta name="msapplication-TileColor" content="#00CCFF"/> <!-- Windows 8 color -->
    <!--[if IE]><link rel="shortcut icon" href="images/favicons/favicon.ico"><![endif]-->
    <link rel="icon" type="image/png" href="images/favicons/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicons/apple-touch-icon-precomposed-144x144.png"><!-- iPad Retina-->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicons/apple-touch-icon-precomposed-114x114.png"><!--iPhone Retina -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicons/apple-touch-icon-precomposed-72x72.png"><!-- iPad 1 e 2 -->
    <link rel="apple-touch-icon-precomposed" href="images/favicons/apple-touch-icon-precomposed-57x57.png"><!-- iPhone, iPod e Android 2.2+ -->

    <!-- jq/jqm/css3 stack libraries -->

    <link rel="stylesheet" href="js/jquery.mobile-1.4.5.css" />
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>    
    <script type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    
    <link rel="stylesheet" href="css/custom-jqm.css"/>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">

    <!-- jquery ui plugin -->
    <link rel="stylesheet" href="js/jquery-ui.min.css">
    <link rel="stylesheet" href="js/jquery-ui.theme.css">      
    <script src="js/jquery-ui.min.js"></script>

    <!-- data tables plugin -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.jqueryui.min.js"></script>

    <!-- extra animations -->
    <link rel="stylesheet" href="js/animate.css"/> 

    <style>

    /* marker classes used for dynamic view purposes */         
        
    .blink_me {
      animation: blinker 1s linear infinite;
    }

    @keyframes blinker {  
      50% { opacity: 0; }
    }   

    th {
        text-align: left;
        border-top: 1px black solid;        
    }

    </style>


    <script type="text/javascript">

        function msgbox(message, title, success, transition) {
            var target = success ? '#confirm-box' : '#msg-box';
            $(target + '-message').html(message);
            $(target + '-title').html(title ? title : "Avviso");        
            $('#confirm-box-ok').on("click", success ? success : function() {});        
            $(target).popup (
                "open", 
                {
                    allowSamePageTransition: true, 
                    transition: transition ? transition : 'pop' 
                }
            );      
        }

        function test2() {
            msgbox( "Alert body message", "Alert title" );
        }

        function test3() {
            msgbox( "Confirm body message", "Confirm title", function() { console.log('OK pressed'); } );   
        }

    </script>

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

            window.stop();
            getLocation();
            
            document.getElementById('uptime').innerHTML = new Date();
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

                    var x = event.acceleration.x;
                    if (!x) return;
                    var y = event.acceleration.y;
                    var z = event.acceleration.z;

                    document.getElementById("dmx").innerHTML = x.toFixed(4);
                    document.getElementById("dmy").innerHTML = y.toFixed(4);
                    document.getElementById("dmz").innerHTML = z.toFixed(4);

                }, true);

            }
            else {

                document.getElementById("dmx").innerHTML = 'N/A'; 
                document.getElementById("dmy").innerHTML = 'N/A';
                document.getElementById("dmz").innerHTML = 'N/A';

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

<body
    class="ui-mobile-viewport ui-overlay-c" 
    onload="init()">

<div id="page1" data-role="page">

    <div data-role="header" data-id="foo1" data-position="fixed">
            
        <div class="ui-bar-b" style="height: 46px; text-align: center; padding-top: 22px;">Device Information</div>          

        <div data-role="navbar">
            <ul>
                <li>
                    <a href="#menu" 
                            data-icon="bullets" 
                            data-iconpos="left" 
                            data-theme="b"                                 
                            class="ui-btn-icon-top ui-fullsize "
                            onclick="$('html, body').animate({ scrollTop: '0px'}, 200);">
                        button 1         
                     </a>
                </li>
                <li>
                    <a href="javascript:test2()" 
                            data-icon="gear" 
                            data-iconpos="left" 
                            data-theme="b"                                 
                            class="ui-btn-icon-top ui-fullsize "
                            onclick="$('html, body').animate({ scrollTop: '0px'}, 800);">
                        button 2         
                     </a>
                </li>
            </ul>
        </div>

    </div>


    <div data-role="main" class="ui-content" data-theme="a">
    
        <h3>Device info</h3>
        <i id="uptime"></i>
        <hr>
        
        <table>
        
            <tr>
                <th colspan="3" id="pos">Position</th>
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
                <th colspan="3" id="pos">Device Orientation</th>
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
                <th colspan="3" id="pos">Motion</th>
            </tr> 
            <tr>
                <td><i>x</i></td>
                <td id="dmx" align="right"></td>
            </tr>
            <tr>
                <td><i>y</i></td>
                <td id="dmy" align="right"></td>
            </tr>
            <tr>
                <td><i>z</i></td>
                <td id="dmz" align="right"></td>
            </tr>

            <tr>
                <th colspan="3" id="pos">Battery</th>
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
                <th colspan="3" id="pos">Light sensors</th>
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
                <th colspan="3" id="pos">Proximity</th>
            </tr> 
            <tr>
                <td>proximity 1</td>
                <td id="prox1" align="right"></td>
            </tr>
            <tr>
                <td>proximity 2</td>
                <td id="prox2" align="right"></td>
            </tr>
            
        </table>

<hr>

<?php

    echo getenv('OPENSHIFT_MYSQL_DB_HOST') . "<br>"; 
    echo getenv('OPENSHIFT_MYSQL_DB_USERNAME') . "<br>";
    echo getenv('OPENSHIFT_MYSQL_DB_HOST') . "<br>";
    echo getenv('OPENSHIFT_MYSQL_DB_PASSWORD') . "<br>";
    echo getenv('OPENSHIFT_MYSQL_DB_PORT') . "<br>";

?>

    </div>

    <div data-role="footer" data-id="foo2" data-position="fixed">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="javascript:test3()"                             
                            data-rel="popup" 
                            data-position-to="window" 
                            data-transition="slideup"
                            data-icon="edit" 
                            data-iconpos="left" 
                            data-theme="b"                                 
                            class="ui-btn-icon-top ui-fullsize ">
                        button 3
                     </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- popup management -->

    <div id="msg-box"               
            data-role="popup"              
            data-overlay-theme="b" 
            data-theme="b" 
            data-dismissible="false" 
            data-history="false">   
        <div data-role="header" data-theme="a">
            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            <h1 id="msg-box-title"></h1>
        </div>              
        <div role="main" class="ui-content">
            <h3 id="msg-box-message"></h3>
            <div style="text-align: center;">               
                <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Chiudi</a>
            </div>
        </div>
    </div>

    <div id="confirm-box"               
            data-role="popup"              
            data-overlay-theme="b" 
            data-theme="b" 
            data-dismissible="false" 
            data-history="false">   
        <div data-role="header" data-theme="a">
            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            <h1 id="confirm-box-title"></h1>
        </div>              
        <div role="main" class="ui-content">
            <h3 id="confirm-box-message"></h3>  
            <div style="text-align: center;">               
                <a href="#" id="confirm-box-ok" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" style="width: 100px;">Conferma</a>
                <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" style="width: 100px;" data-transition="flow">Annulla</a>  
            </div>              
        </div>
    </div>

    <!-- navigation menu -->

    <div id="menu" 
            data-theme="b" 
            data-role="panel" 
            data-position="left" 
            data-display="reveal">

        <div style="margin-top: 40px;">             
            <ul data-role="listview">
                <li><a data-ajax="false" href="?fleet=Prova">MENU 1</a></li>
                <li><a data-ajax="false" href="?fleet=Mercurio">MENU 2</a></li>
                <li><a data-ajax="false" href="?fleet=Gugel">MENU 3</a></li>
            </ul>
        </div>

    </div>


</div>

</body>

</html>
