<?php
/** Template Name: Notification */


$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

$data['token'] ='27797FEBE7804E098D2A1EB3525F67A9';
$data['email'] = 'vm_espindola@hotmail.com';

$data = http_build_query($data);

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);

$reference = $xml->reference;
$status = $xml->status;

/* Conectar com o banco e mudar o status
if($reference && $status){
 include_once 'conecta.php';
 $conn = new conecta();

 $rs_pedido = $conn->consultarPedido($reference);

 if($rs_pedido){
 $conn->atualizaPedido($reference,$status);
 }
}
*/