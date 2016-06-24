<?php

/**
 * Eventbrite API Client v3
 * @author korotkov@ud
 */
namespace UsabilityDynamics {

  /**
   * Class EventbriteClient
   * @package UsabilityDynamics
   */
  class EventbriteClient {

    private $endpoint = 'https://www.eventbriteapi.com/v3/';
    private $token = null;
    private $uri = array();
    private $http_client = null;

    /**
     * EventbriteClient constructor.
     * @param $oauth_token
     */
    public function __construct($oauth_token) {
      $this->http_client = $this->get_http_client();
      $this->token = $oauth_token;
    }

    /**
     * @param $method
     * @param $args
     * @return $this
     */
    public function __call( $method, $args ) {
      $this->uri[] = $method;
      return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function id( $id ) {
      $this->uri[] = $id;
      return $this;
    }

    /**
     * @param array $args
     * @return array|mixed|object
     * @throws \Exception
     */
    public function get( $args = array() ) {
      $response = $this->http_client->get( $this->build_url( $args ), array( "Authorization: Bearer " . $this->token ) );

      if ( !$response = json_decode( $response ) ) {
        throw new \Exception( 'Invalid API Response JSON' );
      }

      if ( !empty( $response->error ) ) {
        throw new \Exception( $response->error_description );
      }

      return $response;
    }

    /**
     * @param $data
     * @return array|mixed|object
     * @throws \Exception
     */
    public function post( $data ) {
      $response = $this->http_client->post( $this->build_url(), $data, array( "Authorization: Bearer " . $this->token ) );

      if ( !$response = json_decode( $response ) ) {
        throw new \Exception( 'Invalid API Response JSON' );
      }

      if ( !empty( $response->error ) ) {
        throw new \Exception( $response->error_description );
      }

      return $response;
    }

    /**
     * @param array $args
     * @return string
     */
    private function build_url( $args = array() ) {
      $url = $this->endpoint . implode( '/', $this->uri ) . '/';

      if ( !empty( $args ) && is_array( $args ) ) {
        $url .= '?' . http_build_query( $args, null, '&' );
      }

      $this->uri = array();
      return $url;
    }

    /**
     * @return Curl_HTTP_Client|WP_HTTP_Client
     * @throws \Exception
     */
    private function get_http_client() {

      // Curl
      if ( function_exists( 'curl_init' ) ) {
        return new Curl_HTTP_Client();
      }

      throw new \Exception( 'HTTP Client could not be found' );
    }

  }
}
