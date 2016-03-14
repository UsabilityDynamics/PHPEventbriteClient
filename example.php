<?php
/**
 * Created by PhpStorm.
 * User: evil
 * Date: 3/14/16
 * Time: 5:33 PM
 */

require "lib/class-curl-http-client.php";
require "lib/class-wp-http-client.php";
require "lib/class-eventbrite-client.php";

$client = new \UsabilityDynamics\EventbriteClient( 'LFYL5DED5P42U5F2OLRU' );

$resp1 = $client->events()->id(23045703319)->discounts()->get();

$resp2 = $client->events()->id(23045703319)->discounts()->post(array(
  'discount.code' => 'CODE' . rand(0, 99999999),
  'discount.percent_off' => '5'
));

echo '<pre>';
print_r( $resp1 );
echo '</pre>';

echo '<pre>';
print_r( $resp2 );
echo '</pre>';