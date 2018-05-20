<?php namespace Talonon\Tclink\API;
interface RequestInterface {
  public function GetRequestMethod() : string;

  public function GetAction() : string;

  public function BuildResponse(array $response) : ResponseInterface;

  public function toArray() : array;
}