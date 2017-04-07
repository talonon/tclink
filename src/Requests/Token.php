<?php namespace Talonon\Tclink\Requests;
class Token implements RequestInterface {
  private $_customerID;
  private $_password;
  private $_action;
  private $_returnUrl;

  /**
   * @return mixed
   */
  public function GetCustomerID() {
    return $this->_customerID;
  }

  /**
   * @param mixed $customerID
   * @return Token
   */
  public function SetCustomerID(string $customerID) {
    $this->_customerID = $customerID;
    return $this;
  }

  /**
   * @return mixed
   */
  public function GetPassword() {
    return $this->_password;
  }

  /**
   * @param mixed $password
   * @return Token
   */
  public function SetPassword(string $password) {
    $this->_password = $password;
    return $this;
  }

  /**
   * @return mixed
   */
  public function GetAction() {
    return $this->_action;
  }

  /**
   * @param mixed $action
   * @return Token
   */
  public function SetAction(string $action) {
    $this->_action = $action;
    return $this;
  }

  /**
   * @return mixed
   */
  public function GetReturnUrl() {
    return $this->_returnUrl;
  }

  /**
   * @param mixed $returnUrl
   * @return Token
   */
  public function SetReturnUrl(string $returnUrl) {
    $this->_returnUrl = $returnUrl;
    return $this;
  }

  public function GetRequestEndpoint(): string {
    return '/trusteeapi/token.php';
  }

  public function GetRequestMethod() {
    return 'POST';
  }

  /**
   * Array keys defined by the Trust Commerce "Requesting Transaction Tokens" API
   * @return array
   */
  public function toArray() {
    return [
      'custid'    => $this->GetCustomerID(),
      'password'  => $this->GetPassword(),
      'action'    => $this->GetAction(),
      'returnurl' => $this->GetReturnUrl(),
    ];
  }
}