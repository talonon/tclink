<?php namespace Talonon\Tclink\API\Postauth;

use Talonon\Tclink\API\HasTransID;
use Talonon\Tclink\API\Response;

class PostauthResponse extends Response {

  use HasTransID;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->_status = $data['status'] ?? 'error';
    $this->_transid = $data['transid'] ?? null;
  }

  const STATUS_ACCEPTED = 'accepted';
  const STATUS_BADDATA = 'baddata';
  const STATUS_ERROR = 'error';

  /**
   * @var string
   */
  private $_status = '';

  /**
   * @return string
   */
  public function GetStatus(): string {
    return $this->_status;
  }

  public function Successful(): bool {
    return $this->_status === self::STATUS_ACCEPTED;
  }

  public function toArray() : array {
    return [
      'status'  => $this->_status,
      'transid' => $this->_transid
    ];
  }

}