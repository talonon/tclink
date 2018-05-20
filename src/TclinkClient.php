<?php namespace Talonon\Tclink;

use GuzzleHttp\Client;
use Talonon\Tclink\API\RequestInterface;
use Talonon\Tclink\API\ResponseInterface;

class TclinkClient {
  /**
   * TclinkRequest constructor.
   * @param RequestInterface $request
   */
  public function __construct(RequestInterface $request, array $config) {
    $this->_request = $request;
    $this->_url = $config['url'] ?? 'https://vault.trustcommerce.com/trans/';
    $this->_custid = $config['custid'] ?? null;
    $this->_password = $config['password'] ?? null;

    $this->_version .= php_uname('s') . '-' . php_uname('m');
  }

  private $_custid;

  private $_password;

  private $_version = '4.2.1-PHP-';

  /**
   * @var string
   */
  private $_url;

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
  public function GetResponse() : ResponseInterface {
    /*$result = $this->_sendRequest();
    $this->_lastHeaders = $result->getHeaders();
    $this->_lastStatusCode = $result->getStatusCode();
    $body = $result->getBody()->getContents();*/
    $body = <<<___MOCK___
"""
transid=123-1234567890
status=accepted\n
"""
___MOCK___;

    $body = trim($body, '"');
    $parts = array_filter(explode("\n", $body));

    $result = [];
    foreach ($parts as $keyValuePair) {
      $out = [];
      parse_str($keyValuePair, $out);
      $result = array_merge($result, $out);
    }
    return $this->_request->BuildResponse($result);
  }

  private function _sendRequest() {
    $params = $this->_getParams();
    $url = $this->_buildUrl() . '?' . $params;
    $method = $this->_request->GetRequestMethod();

    $client = new Client();
    return $client->request($method, $url);
  }

  private function _buildUrl(): string {
    $url = rtrim($this->_url, '/');
    return $url;
  }

  private function _getParams(): string {
    $params = [];

    $data = array_merge(
      [
        'custid' => null,
        'password' => null,
      ], $this->_request->toArray());
    foreach ($data as $key => $value) {
      switch ($key) {
        case 'BEGIN':
        case 'END':
        case 'version':
          continue;
      }
      $params[$key] = $value;
    }

    $params['version'] = $this->_version;
    $params['custid'] = $this->_custid;
    $params['password'] = $this->_password;
    $params['action'] = $this->_request->GetAction();

    return http_build_query($params);
  }

}