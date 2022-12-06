<?php


ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);
ini_set("xdebug.var_display_max_depth", -1);
set_time_limit(0);

$URL = 'https://portal.unifacemp.com.br/TOTVSBusinessConnect/wsconsultasql.asmx?wsdl';
//$URL = 'https://portal.unifacemp.com.br//TOTVSBusinessConnect/wsDataServer.asmx?wsdl';

$Soap = array(
    'login'                 => '',                        // CREDENCIAIS
    'password'              => '',                       // CREDENCIAIS
    'authentication'        => SOAP_AUTHENTICATION_BASIC,
    'trace'                 => 1,
    'exceptions'            => 0,
    'connection_timeout'    => 500000000000000000000,
    'cache_wsdl'            => WSDL_CACHE_NONE,
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        ),
);

// var_dump($Soap);

$params = array();
$client = new SoapClient($URL, $Soap);

if ($client == true) {
    // echo "connected";
}

$params = array(
    // 'DataServerName'    => 'TstPessoasProvaData',
    // 'Filtro'            => "1=1",
    // 'Contexto'          => "CodUsuario=mestre,CodColigada=1,CodSistema=G"

"codSentenca" => 'EDU.0014', //string
"codColigada" => 0,         //int
"codAplicacao" => "G"
);

// var_dump($params);

$result = $client->RealizarConsultaSQL($params);
var_dump($result->RealizarConsultaSQLResult);
// exit;

$filepath = $result->RealizarConsultaSQLResult;
# Removing the tabs, returns and the newlines
$filechange = str_replace(array("\n", "\r", "\t", '&', '&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), '', $filepath);
# The trailing and leading spaces are trimmed to make sure the XML is parsed properly by a simple XML function.
$filetrim = trim(str_replace('"', "'", $filechange));
# The simplexml_load_string() function is called to load the contents of the XML file.
$resultxml = simplexml_load_string($filetrim);
# The final conversion of XML to JSON is done by calling the json_encode() function.
$resultjson = json_encode($resultxml);

$obj = json_decode($resultjson);

// var_dump($obj);

foreach($obj->Resultado as $teste){

    echo $teste->_x0028_Candidato_x0029__x0020_Nome;

}