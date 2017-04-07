<?php
  return [
    'url' => 'https://vault.trustcommerce.com',
    // Its not recommended that you store your customerid and password in a config file.  According to the TrustCommerce
    // API DOCS --
    // • Never store credentials on a web server
    // • Do not email CustIDs and passwords together
    // • Always provide passwords verbally in-person or over the telephone. Do not leave password information as a voice mail message
    // This library wont cover the security of the login credentials.  Custid/password will have to be passed into the
    // requests when necessary, the developer will need to implement their own way of maintaining the login credentials.
  ];
