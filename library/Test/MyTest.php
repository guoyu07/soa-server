<?php

namespace Test;

class MyTest extends \PHPUnit_Framework_TestCase {

  protected $token = '85e4a615f62c711d3aac0e7def5b4903';
  protected $curl_url;

  public function testOne() {
    $this->curl_url = 'http://soatest.dev/testeorm';

    $ch = $this->initCurl($this->curl_url);

    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    //$this->assertEquals(200, $code);
    return print_r($response);
  }
  function initCurl($url) {
      // initialize curl
      $ch = curl_init();
      // set curl to return the response back to us after curl_exec
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch,CURLOPT_HTTPHEADER, array(
          'Authorization: ' . $this->token
      ));
      return $ch;
  }
}