<?php namespace Talonon\Tclink\API;
trait HasTransid {
  /**
   * @var string
   */
  private $_transid;

  /**
   * @return string
   */
  public function GetTransID() {
    return $this->_transid ?: null;
  }

  /**
   * @param string $transid
   * @return self
   */
  public function SetTransID(string $transid): self {
    $this->_transid = $transid;
    return $this;
  }
}