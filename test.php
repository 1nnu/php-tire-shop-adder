<?php
$file = fopen("htdocs/shop/wp-content/plugins/tire-shop/logs.txt","w");
$response = "The test ran successfully!";
fwrite($file, $response);
fclose($file);