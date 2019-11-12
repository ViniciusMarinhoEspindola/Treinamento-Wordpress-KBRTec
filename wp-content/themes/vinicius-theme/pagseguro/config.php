<?php
define("URL", "http://localhost/wordpress-crud/");

$sandbox = true;
if($sandbox){
    define("EMAIL_PAGSEGURO", "vm_espindola@hotmail.com");
    define("TOKEN_PAGSEGURO", "27797FEBE7804E098D2A1EB3525F67A9");
    define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
}else{
    define("TOKEN_PAGSEGURO", "Seu token no PagSeguro");
    define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
}