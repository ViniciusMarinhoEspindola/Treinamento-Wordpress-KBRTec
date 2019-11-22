<?php
/** Template Name: Pagamento */


include 'config.php';

$url = URL_PAGSEGURO . "sessions";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("email" => EMAIL_PAGSEGURO, "token" => TOKEN_PAGSEGURO), '', '&'));
$retorno = curl_exec($curl);
//var_dump($retorno);die;
curl_close($curl);
$xml = simplexml_load_string($retorno);
echo json_encode($xml);