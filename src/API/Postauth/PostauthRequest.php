<?php namespace Talonon\Tclink\API\Postauth;

use Talonon\Tclink\API\HasTransID;
use Talonon\Tclink\API\RequestInterface;
use Talonon\Tclink\API\ResponseInterface;

class PostauthRequest implements RequestInterface {

  use HasTransID;

  /**
   * @var int
   */
  private $_amount;

  public function BuildResponse(array $response): ResponseInterface {
    return new PostauthResponse($response);
  }

  public function GetAction(): string {
    return 'postauth';
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
    ];
  }
}