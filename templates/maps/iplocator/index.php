<?php
header("Access-Control-Allow-Origin: *");
?>

<!DOCTYPE html>

<html>

<head> 

    <meta charset="utf-8" />        
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>IP locator</title>

    <!-- jq/jqm/css3 stack libraries -->

    <script type="text/javascript" src="../../../js/jquery-1.11.3.min.js"></script>    
    
    <script type="text/javascript">

    function cr_( indent ) {
        var TAB_SIZE = 4;
        var s = '<br/>';
        while (indent-- > 0) {
            for (var k = 0; k < TAB_SIZE; k ++) {
                s += '&nbsp;';
            }            
        }
        return s;
    }

    function format_json( data ) {
        var text = '';
        var str = JSON.stringify(data);
        var length = str.length;
        var status = 0, indent = 0;
        for (var i = 0; i < length; i ++) {
            var do_before = do_after = false;
            var c = str.charAt(i);
            switch (status) {                
                case 0:
                    if (c == '{') indent ++;
                    if (c == '}') indent --;
                    if (c == '[') indent ++;
                    if (c == ']') indent --;                    
                    if (c == ':') c = " : ";
                    if (c == '"') status = 1;
                    if (c == ',') do_after = true;
                    if (c == '{') do_after = true;
                    if (c == '}') do_before = true;  
                    if (c == '[') do_after = true;
                    if (c == ']') do_before = true;                    
                break;                
                case 1: 
                    if (c == '"') status = 0;
                break;           
            }

            if ( do_after ) {
                text += c;
                text += cr_(indent);
            }
            else if ( do_before ) { 
                text += cr_(indent);
                text += c;
            }
            else { 
                text += c;
            }
               
        }

        return text;

    } 

    function find_ip_location( ) {

		var url = "https://ip-api.io/json/";
		url += $("#address").val().trim();

		$.ajax ({
                type: "GET",                
                url: url,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success: function( data ) {
                	//debugger;
                    $('#results').html( format_json( data ) );
                    //$('#address').val( data.query );
                },
                error: function( data ) {
                	//debugger;
                	$('#results').html( '<i style="color:red;">' + format_json( data ) + '</i>');		
                }
        });

    }


    </script>

</head>

<body onload="find_ip_location()">

<h3>IP Locator</h3>
IP Address: <input type="text" id="address" value="<?php echo $_SERVER['HTTP_X_FORWARDED_FOR']; ?>"> 
<input type="button" value="Geolocate IP" onclick="find_ip_location()">
<br>
<pre id="results" style="overflow: scroll;">
finding location ...	
</pre>

</body>
</html>



