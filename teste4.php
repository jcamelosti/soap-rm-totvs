<?php
	try{
		$wsdlUrl = 'https://portal.unifacemp.com.br/TOTVSBusinessConnect/wsconsultasql.asmx?wsdl';
		$opts = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			),
		);
		$context = stream_context_create($opts);
		
		libxml_disable_entity_loader(false);

		$soapClient = new \SoapClient($wsdlUrl, [
			'version' => SOAP_1_1,
			'stream_context' => $context,
			'cache_wsdl' => WSDL_CACHE_NONE
		]);
		
		$params = array(
		  "codSentenca" => 'EDU.0014', //string
		  "codColigada" => 1,//int
		  "codAplicacao" => "Q",//string  - nao obrigatorio
		  "codUsuario" => null,//string - nao obrigatorio
		  "parameters" => null//string  - nao obrigatorio
		);
		$response = $soapClient->RealizarConsultaSQL($params);
			
		echo "<pre>";
		//print_r($response);
		//print_r($soapClient->__getLastRequest());
		exit;
	}catch(SoapFault $fault){
	  print_r($fault->getMessage()."<br /><hr />");
	  exit;
	}catch(Exception $e){
		print_r($e->getMessage());
		exit;
	}