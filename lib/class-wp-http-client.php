<?php
/**
 * Created by PhpStorm.
 * User: evil
 * Date: 3/14/16
 * Time: 6:10 PM
 */

namespace UsabilityDynamics {

  class WP_HTTP_Client {

    public function get( $url ) {
      $response = wp_remote_get( $url );

      echo '<pre>';
      print_r( $response );
      echo '</pre>';
    }

    public function post( $url, $data ) {
      $response = wp_remote_post( $url, array( 'body' => $data ) );

      echo '<pre>';
      print_r( $response );
      echo '</pre>';
    }
  }
}