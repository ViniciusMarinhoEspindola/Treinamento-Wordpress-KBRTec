<?php
/** Template Name: Checkout */

$treinamento = get_post($_POST['treinamento_id']);
$treinamentos = get_fields($_POST['treinamento_id']);
$virgula = (substr($_POST['valorParcelas'], -2, 1) == '.') ? "0" : "";

$data["email"]="vm_espindola@hotmail.com";
$data["token"]="27797FEBE7804E098D2A1EB3525F67A9";
$data["paymentMode"]="default";
$data["paymentMethod"]="creditCard";
$data["currency"]="BRL";
$data["itemId1"] = $treinamento->ID;
$data["itemDescription1"] = $treinamento->post_title;
$data["itemAmount1"] = $treinamentos['valor'];
$data["itemQuantity1"] = 1;
$data["senderName"]= $_POST['nome'];
$data["senderCPF"]= str_replace(['.','-'], "", $_POST['cpf']);
$data["senderAreaCode"]= substr($_POST['telefone'], 1, 2);
$data["senderPhone"]= str_replace('-', "", substr($_POST['telefone'], 5));
$data["senderEmail"]=$_POST['email'];
$data["senderHash"]=$_POST['hashCard'];
$data["shippingAddressRequired"] = False;
$data["creditCardToken"]=$_POST['tokenCartao'];
$data["installmentQuantity"]=$_POST['qntParcelas'];
$data["installmentValue"]= $_POST['valorParcelas'].$virgula;
$data["noInterestInstallmentQuantity"]=2;
$data["creditCardHolderName"]=$_POST['nome'];
$data["creditCardHolderCPF"]= str_replace(['.','-'], "", $_POST['cpf']);
$data["creditCardHolderBirthDate"]= date('d/m/Y', strtotime($_POST['nascimento']));
$data["creditCardHolderAreaCode"]= substr($_POST['telefone'], 1, 2);
$data["creditCardHolderPhone"]= str_replace('-', "", substr($_POST['telefone'], 5));
$data["billingAddressStreet"]=$_POST['endereco'];
$data["billingAddressNumber"]= $_POST['numero'];
$data["billingAddressComplement"]= isset($_POST['complemento']) ? $_POST['complemento'] : '';
$data["billingAddressDistrict"]=$_POST['bairro'];
$data["billingAddressPostalCode"]=$_POST['cep'];
$data["billingAddressCity"]=$_POST['cidade'];
$data["billingAddressState"]=$_POST['estado'];
$data["billingAddressCountry"]="BRA";
$data["notificationURL"] = "http://localhost/wordpress-crud/";
//
wp_mail( [$_POST['email']], "Inscrição Recebida!", "Sua inscrição no treinamento foi recebida, assim que o pagamento for feito sua inscrição será efetivada!" );

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions';

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($xml);
cadastrar_inscritos($xml->code);
echo $xml->code;
