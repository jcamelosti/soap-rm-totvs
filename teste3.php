<?php

$soapParams = array(
'login'          => '',
'password'       => '',
'authentication' => SOAP_AUTHENTICATION_BASIC,
'trace'          => 1,
'exceptions'     => 0, 
);

$params = array();
$client = new SoapClient('https://portal.unifacemp.com.br/TOTVSBusinessConnect/wsconsultasql.asmx?wsdl', $soapParams);

$params = array(
  'codSentenca'   => 'EDU.0014',
  'codColigada'   => '1',
  'codSistema'    => 'Q',
  //'parameters'    => '?'
);

var_dump($params) . "</br></BR>";

$result = $client->ReadView($params);

echo "response:\n" . $client->__getLastResponse() . "<br><br>";
echo "<br>";
echo "REQUEST:\n" . $client->__getLastRequest() . "<br><br>";
echo "REQUEST HEADERS:\n" . $client->__getLastRequestHeaders() . "<br><br>";
echo "REQUEST HEADERS:\n" . $client->__getLastResponseHeaders() . "<br><br>";

var_dump($client->__getTypes()). "<br><br>";
var_dump($client->__getFunctions());