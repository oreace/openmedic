<?php    
function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
 $PublicIP = get_client_ip(); 
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$PublicIP));

echo $query['country'].', '.$query['city'].', '.$query['regionName'];

$lon = $query['lon'];
$lat = $query['lat'];

 $json  = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&key=AIzaSyACPaOOU5ZbcaMuozqRQFtBpq-i9askOsU");
 $json  =  json_decode($json ,true);
 echo "<br>";
 print_r($json);
 //$country =  $json['country_name'];
// $region= $json['region_name'];
// $city = $json['city'];

 ?>
