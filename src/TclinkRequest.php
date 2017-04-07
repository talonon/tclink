<?php namespace Talonon\Tclink;

use GuzzleHttp\Client;
use Talonon\Tclink\Requests\RequestInterface;

class TclinkRequest {
  /**
   * TclinkRequest constructor.
   * @param RequestInterface $request
   */
  public function __construct(RequestInterface $request) {
    $this->_request = $request;
  }

  /**
   * @var RequestInterface
   */
  private $_request;

  /**
   * @var string[][]
   */
  private $_lastHeaders = [];

  /**
   * @var int
   */
  private $_lastStatusCode = 0;

  public function GetHeaders(): array {
    return $this->_lastHeaders;
  }

  /**
   * @return int
   */
  public function GetStatusCode(): int {
    return $this->_lastStatusCode;
  }

  /**
   * @return string|array
   */
  public function GetResult() {
    $result = $this->_sendRequest();
    $this->_lastHeaders = $result->getHeaders();
    $this->_lastStatusCode = $result->getStatusCode();
    $body = $result->getBody()->getContents();
    if (starts_with($result->getHeader('content-type'), 'application/json')) {
      $body = json_decode($body, true);
    }
    unset($result);
    return $body;
  }

  private function _sendRequest() {
    $params = $this->_getParams();
    $url = $this->_buildUrl();
    $method = $this->_request->GetRequestMethod();

    $client = new Client();
    return $client->request(
      $method, $url, [
      ['form_params' => $params]
    ]);
  }

  private function _buildUrl(): string {
    $url = rtrim(config('tclink.url', 'https://vault.trustcommerce.com'), '/');
    return $url . $this->_request->GetRequestEndpoint();
  }

  private function _getParams(): array {
    return $this->_request->toArray();
  }

}