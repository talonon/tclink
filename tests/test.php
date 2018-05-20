<?php

  use Talonon\Tclink\API\Credit\CreditRequest;
  use Talonon\Tclink\TclinkClient;

  require_once __DIR__ . '/../vendor/autoload.php';

  $request =( new CreditRequest())
    ->SetAmount(100)
    ->SetTransid('411-1111111111');
  $tclink = new TclinkClient($request, ['custid' => '', 'password' => '']);

  $result = $tclink->GetResponse();

  print 'Successful : ' . $result->Successful();
  dd($result);
