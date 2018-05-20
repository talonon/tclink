<?php namespace Talonon\Tclink\API;
interface ResponseInterface {
  public function Successful(): bool;

  public function GetError();

}