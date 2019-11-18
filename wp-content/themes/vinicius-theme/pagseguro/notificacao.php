<?php
/** Template Name: Notification */
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

if(!isset($_POST['notificationCode']) || $_POST['notificationCode'] === ''){
    header('Location: ../');
    exit;
}

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

$codigo = $xml->code;
$status = $xml->status;

switch($status) {
    case 1:
        $status = 'Aguardando pagamento';
        break;
    case 2:
        $status = 'Em análise';
        break;
    case 3:
        $status = 'Paga';
        break;
    case 4:
        $status = 'Disponível';
        break;
    case 5:
        $status = 'Em disputa';
        break;
    case 6:
        $status = 'Devolvida';
        break;
    case 7:
        $status = 'Cancelada';
        break;
}

//var_dump($xml);
global $wpdb; 
$inscrito = $wpdb->get_row("SELECT * FROM usuarios_wp WHERE cd_pagamento = '".$codigo."'");
$wpdb->update( 'usuarios_wp', ['status_pagamento' => $status], ['cd_pagamento' => $codigo]);
wp_mail( [$inscrito->email], "Pagamento Recebido!", "Olá ".$inscrito->nome.", recebemos seu pagamento e sua inscrição foi efetivada com sucesso!");