<?php namespace Talonon\Tclink\API;
abstract class Response implements ResponseInterface {

  public function __construct(array $data) {
    if (isset($data['error'])) {
      $this->_error = new ErrorResponse($data);
    }
  }
  private $_error;

  public function GetError() {
    return $this->_error;
  }

}