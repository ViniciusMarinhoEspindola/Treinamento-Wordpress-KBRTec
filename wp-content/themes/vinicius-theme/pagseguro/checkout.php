<?php
/** Template Name: Checkout */

/*
$data['mode'] = 'default';
$data['currency'] = 'BRL';
$data['method'] = 'creditCard';
$data['hash'] = $_POST['hashCartao'];

$data['itemId1'] = '1';
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = 'Produto de Teste';
$data['itemAmount1'] = '600.00';

$url = 'https://ws.sendbox.pagseguro.uol.com.br/v2/transactions';

$data = http_build_query($data);
$data = 'paymentMode=default
&paymentMethod=creditCard
&currency=BRL
&extraAmount=0.00
&itemId1=0001
&itemDescription1=Notebook Prata
&itemAmount1=10300.00
&itemQuantity1=1
&itemId2=0002
&itemDescription2=Notebook Azul
&itemAmount2=10000.00
&itemQuantity2=1
&reference=REF1234
&senderName=Jose Comprador
&senderCPF=22111944785
&senderAreaCode=11
&senderPhone=56273440
&senderEmail=vm_espindola@hotmail.com
&senderHash='.$_POST['hashCartao'].'
&shippingAddressStreet=Av. Brig. Faria Lima
&shippingAddressNumber=1384
&shippingAddressComplement=5o andar
&shippingAddressDistrict=Jardim Paulistano
&shippingAddressPostalCode=01452002
&shippingAddressCity=Sao Paulo
&shippingAddressState=SP
&shippingAddressCountry=BRA
&shippingType=1
&shippingCost=01.00
&creditCardToken='.$_POST['tokenCartao'].'
&installmentQuantity=7
&installmentValue=3030.94
&noInterestInstallmentQuantity=5
&creditCardHolderName=Jose Comprador
&creditCardHolderCPF=22111944785
&creditCardHolderBirthDate=27/10/1987
&creditCardHolderAreaCode=11
&creditCardHolderPhone=56273440
&billingAddressStreet=Av. Brig. Faria Lima
&billingAddressNumber=1384
&billingAddressComplement=5o andar
&billingAddressDistrict=Jardim Paulistano
&billingAddressPostalCode=01452002
&billingAddressCity=Sao Paulo
&billingAddressState=SP
&billingAddressCountry=BRA';
*/
/*
$TokenCard=$_POST['tokenCard'];
$HashCard=$_POST['hashCard'];
$celular = $_POST['celular'];
$telefone = $_POST['telefone'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$post = $_POST['post_id'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$data = date('Y-m-d', $_POST['data']);
$titulo = $_POST['titulo'];
$numero = $_POST['numero'];
*/
$QtdParcelas=filter_input(INPUT_POST,'qntParcelas',FILTER_SANITIZE_SPECIAL_CHARS);
$ValorParcelas=filter_input(INPUT_POST,'ValorParcelas',FILTER_SANITIZE_SPECIAL_CHARS);
//$preco= number_format($_POST['preco'], 2, '.', '');
//$data = substr($data, 8, 2)."/".substr($data, 5, 2)."/".substr($data, 0, 4);
$data["email"]="c97117229501352768733@sandbox.pagseguro.com.br";
$data["token"]="27797FEBE7804E098D2A1EB3525F67A9";
$data["paymentMode"]="default";
$data["paymentMethod"]="creditCard";
$data["receiverEmail"]="vm_espindola@hotmail.com";
$data["currency"]="BRL";
$data["itemId1"] = 'camisa';
$data["itemDescription1"] = 'camisa';
$data["itemAmount1"] = '600.00';
$data["itemQuantity1"] = 1;
$data["notificationURL="]="http://ambiente-dev5.provisorio.ws/Paulo/Wordpress/notificacao/";
$data["reference"]='46176112826';
$data["senderName"]= 'Vinicius Marinho';
$data["senderCPF"]='45176112826';
$data["senderAreaCode"]= '13';
$data["senderPhone"]='991144322';
$data["senderEmail"]='vm_espindola@hotmail.com';
$data["senderHash"]=$_POST['hashCard'];
$data["shippingType"]="1";
$data["shippingAddressStreet"]='Av. Diamantino Cruz Ferreira Mourão';
$data["shippingAddressNumber"]='8896';
$data["shippingAddressComplement"]='';
$data["shippingAddressDistrict"]='jd. Princesa';
$data["shippingAddressPostalCode"]='11711125';
$data["shippingAddressCity"]="Praia Grande";
$data["shippingAddressState"]="SP";
$data["shippingAddressCountry"]="BRA";
$data["shippingCost"]="0.00";
$data["creditCardToken"]=$_POST['tokenCard'];
$data["installmentQuantity"]=$QtdParcelas;
$data["installmentValue"]=$ValorParcelas;
$data["noInterestInstallmentQuantity"]=2;
$data["creditCardHolderName"]='Vinicius';
$data["creditCardHolderCPF"]='46176112826';
$data["creditCardHolderBirthDate"]='05/12/200';
$data["creditCardHolderAreaCode"]='13';
$data["creditCardHolderPhone"]='13';
$data["billingAddressStreet"]='Av. Diamantino Cruz Ferreira Mourão';
$data["billingAddressNumber"]='8896';
$data["billingAddressComplement"]='';
$data["billingAddressDistrict"]='jd. Princesa';
$data["billingAddressPostalCode"]='11711125';
$data["billingAddressCity"]='Praia Grande';
$data["billingAddressState"]='SP';
$data["billingAddressCountry"]="BRA";


$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($xml);
var_dump($xml);

