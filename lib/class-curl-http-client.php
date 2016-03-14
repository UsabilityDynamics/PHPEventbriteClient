<?php

/**
 * Simple Curl based Http Client
 */
namespace UsabilityDynamics {

  /**
   * Class Curl_HTTP_Client
   * @package UsabilityDynamics
   */
  class Curl_HTTP_Client {

    /**
     * @param $url
     * @param $headers
     * @return mixed
     */
    public function get( $url, $headers ) {

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );

      $output = curl_exec($ch);
      curl_close($ch);

      return $output;
    }

    /**
     * @param $url
     * @param $data
     * @param $headers
     * @return mixed
     */
    public function post( $url, $data, $headers ) {

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '&') );

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );

      $output = curl_exec($ch);
      curl_close($ch);

      return $output;

    }

  }

}