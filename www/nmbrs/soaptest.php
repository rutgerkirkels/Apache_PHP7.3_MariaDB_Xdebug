<?php
ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);




$wsdl = 'https://api.nmbrs.nl/soap/v2.1/CompanyService.asmx?WSDL';

$headerbody = [

        'Username' => 'r.bekkers@atention.nl',
        'Token' => 'bd9298bf0abf41af9b92d69325fd4a55'

];
$header = new SOAPHeader('https://api.nmbrs.nl/soap/v2.1/CompanyService', 'AuthHeader', $headerbody);

$options = [
    'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
    'style'=>SOAP_1_2,
    'use'=>SOAP_ENCODED,
    'soap_version'=>SOAP_1_2,
    'cache_wsdl'=>WSDL_CACHE_NONE,
    'connection_timeout'=>15,
    'trace'=>true,
    'encoding'=>'UTF-8',
    'exceptions'=>false,
];
try {
    $soap = new SoapClient($wsdl, $options);
    $soap->__setSoapHeaders($header);

    $data = $soap->List_GetAll();
}
catch(Exception $e) {

    echo $e->getMessage();
}
var_dump($data->List_GetAllResult->Company);
die;