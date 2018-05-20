<?php namespace Talonon\Tclink\API\Credit;

use Talonon\Tclink\API\HasTransid;
use Talonon\Tclink\API\RequestInterface;
use Talonon\Tclink\API\ResponseInterface;

class CreditRequest implements RequestInterface {

  use HasTransid;

  /**
   * @var int
   */
  private $_amount;

  /**
   * @return int
   */
  public function GetAmount(): int {
    return $this->_amount;
  }

  /**
   * @param int $amount
   * @return CreditRequest
   */
  public function SetAmount(int $amount): CreditRequest {
    $this->_amount = $amount;
    return $this;
  }

  /**
   * @return string
   */
  public function GetTransid(): string {
    return $this->_transid;
  }

  /**
   * @param string $transid
   * @return CreditRequest
   */
  public function SetTransid(string $transid): CreditRequest {
    $this->_transid = $transid;
    return $this;
  }

  public function BuildResponse(array $response): ResponseInterface {
    return new CreditResponse($response);
  }

  public function GetAction(): string {
    return 'credit';
  }

  public function GetRequestMethod(): string {
    return 'POST';
  }

  /**
   * Array keys defined by the Trust Commerce "Requesting Transaction Tokens" API
   * @return array
   */
  public function toArray(): array {
    return [
      'transid' => $this->GetTransid(),
      'amount'  => str_pad($this->GetAmount(), 3, '0', STR_PAD_LEFT)
    ];
  }
}