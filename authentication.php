<?php
function getAuthentication(){
    $url = ''; //URL for api request
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ""); // Password and username fields added as parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/x-www-form-urlencoded.',
        )
    );

    $result = curl_exec($ch);
    curl_close($ch);
    $json = strstr($result, '{');
    $contents = json_decode($result);
    file_put_contents("htdocs/shop/wp-content/plugins/tire-shop/token.json", $result);
}

getAuthentication();
?>