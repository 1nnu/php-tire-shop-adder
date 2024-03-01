<?php
function counterreset(){
    $totalcount = file_get_contents("htdocs/shop/wp-content/plugins/tire-shop/counter.txt");
    if($totalcount == 999999){
        $newcount = 0;
        file_put_contents("htdocs/shop/wp-content/plugins/tire-shop/counter.txt", $newcount);
    }
}
counterreset();
?>