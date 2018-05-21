<?php namespace Talonon\Tclink\API;
class ErrorResponse implements ResponseInterface {

  public function __construct(array $data) {
    $this->_offenders = explode(',', $data['offenders'] ?? '<unknown>');
    $this->_message = $data['error'] ?? '<unknown>';
  }

  private $_offenders = [];
  private $_message = null;

  public function GetOffenders(): array {
    return $this->_offenders;
  }

  public function GetMessage(): string {
    return $this->_message;
  }

  public function GetError(): ErrorResponse {
    return $this;
  }

  public function Successful(): bool {
    return false;
  }

  public function toArray() {
    return [
      'message'   => $this->_message,
      'offenders' => $this->_offenders
    ];
  }

}