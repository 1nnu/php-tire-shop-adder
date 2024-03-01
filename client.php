<?php
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    '', // Your store URL
    '', // Your consumer key
    '', // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3', // WooCommerce WP REST API version
        'timeout'=> 400,
    ]
);
?>