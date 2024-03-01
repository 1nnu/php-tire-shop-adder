<?php
function getImages(){
    $url = 'http://api.latakko.eu/api/ArticleImages/';
    $allproducts = file_get_contents("allproducts.json");
    $products = json_decode($allproducts);
    $token = file_get_contents("token.json");
    $tokencontents = json_decode($token);
    $accesstoken = $tokencontents->access_token;
    $tokentype = $tokencontents->token_type;
    $curlarray = [
            'Authorization: '.$tokentype.' '.$accesstoken,
        ];
    $totalcount = file_get_contents("counter.txt");
    $fp = fopen("counter.txt", "r");
    $line = fgets($fp);
    $val = intval($line);
    if($val == 999999){
        return;
    }
    $newcount = intval($totalcount) + 400;
    $keys = array_keys($products);
    $last_key = end(array_keys($products));
    $do_twice = 0;
    while($totalcount <= $newcount){
        if($keys[$totalcount] == $last_key ){
            $newcount = 999999;
            file_put_contents("counter.txt", $newcount);
            return;
        }
        $imageid = $products[$keys[$totalcount]]->ImageId;
        $imageurl = $url.$imageid;
        $filename = "/www/apache/domains/www.rettum.ee/htdocs/shop/wp-content/uploads/productimages/".$imageid.".jpeg";
        if(file_exists($filename)){
            echo "Replacing duplicate";
            $newcount++;
            $totalcount++;
            continue;
        }
        $ch=curl_init($imageurl);
        $fp = fopen($filename, "wb");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlarray);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $res = curl_exec($ch);
        if($ch == false){
            $logs = fopen("logs.txt", "a");
            fwrite($logs,"Error has occured on ".$totalcount);
            fclose($logs);
            $totalcount--;
            $newcount--;
            continue;
        }
        curl_close($ch);
        if($do_twice == 1){
            $totalcount++;
            $do_twice = 0;
            continue;
        }
        if($res === false){
            $totalcount--;
            $newcount--;
            $do_twice = 1;
            continue;
        }
        fclose($fp);
        $totalcount++;
        sleep(1);
        $do_twice = 0;
    }
    file_put_contents("counter.txt", $newcount);
}
getImages();
?>