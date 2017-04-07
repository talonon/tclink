<?php namespace Talonon\Tclink\Requests;
interface RequestInterface {
  public function GetRequestEndpoint();

  public function GetRequestMethod();

  public function toArray();
}