<?php namespace Talonon\Tclink\API\Credit;

use Talonon\Tclink\API\HasTransid;
use Talonon\Tclink\API\Response;

class CreditResponse extends Response {

  use HasTransid;

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