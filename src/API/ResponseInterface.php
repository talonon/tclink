<?php namespace Talonon\Tclink\API;
interface ResponseInterface {
  public function Successful(): bool;

  /**
   * @return ErrorResponse|null
   */
  public function GetError();

  public function toArray() : array;

}