<?php

function enviarRequisicao($xmlAssinado, $function){
	$wsdl       = 'https://portal.unifacemp.com.br/TOTVSBusinessConnect/wsconsultasql.asmx?wsdl';
	$endPoint   = 'https://portal.unifacemp.com.br/TOTVSBusinessConnect/wsconsultasql.asmx?wsdl';
	
	$options = [
		'location' => $endPoint,
		'keep_alive' => true,
		'trace' => true,
		//'local_cert' => $certificado,
		//'passphrase' => $passwordCert,
		'cache_wsdl' => 0
	];

	try {
		$client = new \SoapClient($wsdl, $options);
		/*echo "<pre>";
		var_dump($client->__getFunctions()); 
		var_dump($client->__getTypes()); */
		
		/*$function = $function;
		$arguments = [$function => [
				'xml' => $xmlAssinado
			]
		];
		$options = [];
		$result = $client->__soapCall($function, $arguments, $options);
		return $result;*/
		
		$params = array(
		  "codSentenca" => 'EDU.0014', //string
		  "codColigada" => 1,//int
		  //"codAplicacao" => "Q",//string  - nao obrigatorio
		  //"codUsuario" => 500,//string - nao obrigatorio
		  //"parameters" => null//string  - nao obrigatorio
		);
		$response = $client->__soapCall($function, array($params));
		
		echo "<pre>";
		print_r($response);
		exit;
	} catch (\Exception $e) {
		echo "<pre>";
		print_r($e->getMessage());
		exit;
	}
}

/*
<s:element name="RealizarConsultaSQL">
<s:complexType>
<s:sequence>
<s:element minOccurs="0" maxOccurs="1" name="codSentenca" type="s:string"/>
<s:element minOccurs="1" maxOccurs="1" name="codColigada" type="s:int"/>
<s:element minOccurs="0" maxOccurs="1" name="codAplicacao" type="s:string"/>
<s:element minOccurs="0" maxOccurs="1" name="codUsuario" type="s:string"/>
<s:element minOccurs="0" maxOccurs="1" name="parameters" type="s:string"/>
</s:sequence>
</s:complexType>
</s:element>
*/

//xml a ser enviado
$xml = '<RealizarConsultaSQL xmlns="http://www.totvs.com.br/br/">
  <codSentenca>EDU.0014</codSentenca>
  <codColigada>1</codColigada>
</RealizarConsultaSQL>
';
      
$resposta = enviarRequisicao($xml, 'RealizarConsultaSQL');
print_r($resposta);
exit;

//$xmlCompleto = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $resposta->RealizarConsultaSQLResult);
//$xml   = simplexml_load_string($xmlCompleto, 'SimpleXMLElement', LIBXML_NOCDATA);
//$array = json_decode(json_encode($xml), TRUE);
//return $array;