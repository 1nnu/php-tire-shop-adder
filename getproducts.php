<?php

function getProduct(){
    $url = 'http://api.latakko.eu/api/Articles?OnlyStockItems=false&OnlyLocalStockItems=true&IncludeCarTyres=true&IncludeMotorcycleTyres=true&IncludeTruckTyres=true&IncludeEarthmoverTyres=true&IncludeAlloyRims=false&IncludeSteelRims=false&IncludeAccessories=false&IncludeOils=false&IncludeBatteries=false';
    $token = file_get_contents("htdocs/shop/wp-content/plugins/tire-shop/token.json");
    $tokencontents = json_decode($token);
    $accesstoken = $tokencontents->access_token;
    $tokentype = $tokencontents->token_type;
    $curlarray = [
        'Authorization: '.$tokentype.' '.$accesstoken,
        'X-Requested-With: XMLHttpRequest',
    ];
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $curlarray);
    $result = curl_exec($ch);
    curl_close($ch);
    file_put_contents("htdocs/shop/wp-content/plugins/tire-shop/allproducts.json", $result);
}
getProduct()
?>