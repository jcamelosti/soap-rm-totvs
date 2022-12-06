<?php
	ini_set("soap.wsdl_cache_enabled", "0");
	libxml_disable_entity_loader(false);
	
	$wsdl       = 'https://portal.unifacemp.com.br/TOTVSBusinessConnect/wsconsultasql.asmx';
	$endPoint   = 'https://portal.unifacemp.com.br/TOTVSBusinessConnect/wsconsultasql.asmx';
	
	$options = [
		'soap_version' => SOAP_1_2,
		'login' => '',
		'password' => '',
		'location' => $endPoint,
		'keep_alive' => true,
		'trace' => true,
		'cache_wsdl' => 0,
		"exception" => 0
	];

	try {
		$client = new \SoapClient($wsdl, $options);		
		$params = array(
		  "codSentenca" => 'EDU.0014', //string
		  "codColigada" => 1,//int
		  //"codAplicacao" => "Q",//string  - nao obrigatorio
		  //"codUsuario" => 500,//string - nao obrigatorio
		  //"parameters" => null//string  - nao obrigatorio
		);
		$response = $client->__soapCall('RealizarConsultaSQL', array($params));
		echo "<h1>Sucesso</h1>";
		echo "<pre>";
		print_r($response);
		exit;
	} catch (\Exception $e) {
		echo "<h1>Falha</h1>";
		echo "<pre>";
		print_r($e->getMessage());
		exit;
	}