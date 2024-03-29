<script>
	var cadastrado = false;
</script>
<?php
/** Template Name: Pagseguro */

get_header();
//Incluir o arquivo de configuração
include 'config.php';
$valor = get_field('valor', $_POST['treinamento_id']);

if(!isset($_POST['nome'])){
?>
    <div class="alert alert-danger">Cadastre-se primeiro em algum treinamento antes de tentar pagar</div>
    <script>
        cadastrado = true;
    </script>
<?php
}

if(!unique_value('email')) {
?>
    <div class="alert alert-danger">Esse E-mail já está cadastrado neste treinamento</div>
    <script>
        cadastrado = true;
    </script>
<?php
}
if(!unique_value('cpf')) {
?>
    <div class="alert alert-danger">Esse CPF já está cadastrado neste treinamento</div>
    <script>
        cadastrado = true;
    </script>
<?php
}
?>
<div class="container">  
    <div class="row">
        <div id="msg-status" class="col-12"></div>
        <h1 class="col-12 text-warning my-3 text-center">Informações de pagamento</h1>

       <span class="endereco" data-endereco="<?php echo URL; ?>"></span>
       <span class="amount" data-amount="<?php echo $valor; ?>"></span> 

       <form name="formPagamento" class="col-6" action="" id="formPagamento">
            <input type="hidden" value="<?php echo $_POST['nome'] ?>" name="nome">
            <input type="hidden" value="<?php echo $_POST['nascimento'] ?>" name="nascimento">
            <input type="hidden" value="<?php echo $_POST['cpf'] ?>" name="cpf">
            <input type="hidden" value="<?php echo $_POST['email'] ?>" name="email">
            <input type="hidden" value="<?php echo $_POST['cep'] ?>" name="cep">
            <input type="hidden" value="<?php echo $_POST['endereco'] ?>" name="endereco">
            <input type="hidden" value="<?php echo $_POST['numero'] ?>" name="numero">
            <input type="hidden" value="<?php echo $_POST['complemento'] ?>" name="complemento">
            <input type="hidden" value="<?php echo $_POST['bairro'] ?>" name="bairro">
            <input type="hidden" value="<?php echo $_POST['cidade'] ?>" name="cidade">
            <input type="hidden" value="<?php echo $_POST['estado'] ?>" name="estado">
            <input type="hidden" value="<?php echo $_POST['telefone'] ?>" name="telefone">
            <input type="hidden" value="<?php echo $_POST['celular'] ?>" name="celular">
            <input type="hidden" value="<?php echo $_POST['treinamento_id'] ?>" name="treinamento_id">
            
            <div class="form-group">
                <label for='numCartao'>Número do cartão</label>
                <input type="text" class="form-control" name="numCartao" maxlength="16" id="numCartao">
                
                <span id="msg"></span>
                <div class="bandeira-cartao"></div>
            </div>

            <div class="form-group">
                <label>Bandeira do cartão</label>
                <input type="text" class="form-control" name="bandeiraCartao" id="bandeiraCartao">
            </div>

            <div class="form-group">
                <label>CVV do cartão</label>
                <input type="text" class="form-control" name="cvvCartao" id="cvvCartao" maxlength="3">
                </div>
            
            <div class="form-group">
                <label>Mês de validade</label>
                <input type="text" class="form-control" name="mesValidade" id="mesValidade" maxlength="2">
            </div>
            
            <div class="form-group">
                <label>Ano de validade</label>
                <input type="text" class="form-control" name="anoValidade" id="anoValidade" maxlength="4">
            </div>
            
            <div class="form-group" id="qtParcelas">
                <label>Quantidades de Parcelas</label>
                <select class="form-control" name="qntParcelas" id="qntParcelas" class="select-qnt-parcelas">
                    <option value="">Selecione</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Valor Parcelas</label>
                <input type="text" class="form-control" name="valorParcelas" id="valorParcelas">
            </div>
            
            <div class="form-group">
                <input type="hidden" class="form-control" name="tokenCartao" id="tokenCartao">
                <input type="hidden" class="form-control" name="hashCartao" id="hashCartao">
            </div>
            
            <div class="form-group">
                <input type="submit" name="btnComprar" class="btn btn-warning text-light" id="btnComprar" value="Comprar">
            </div>
        </form>
        
		<div class="col-6 meio-pag"></div>
    </div>
</div>

<?php get_footer(); ?>

<script type="text/javascript" src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>

<script> 
    // validate
    $(document).ready(function(){
        $.ajax({
            url: "https://ws.sandbox.pagseguro.uol.com.br/sessions?email=vm_espindola@hotmail.com&token=27797FEBE7804E098D2A1EB3525F67A9",
            method: 'post',
            success: function(response)
            {
                console.log(response);
            }
        })
        var cadastrado = false;
        $("#formPagamento").validate({
            rules:{
                numCartao:{
                    required:true,
                    creditcard: true
                },
                cvvCartao:{
                    required:true
                },
                mesValidade:{
                    required:true
                },
                anoValidade:{
                    required:true
                },
                qntParcelas:{
                    required:true
                }
            },
            messages:{
                numCartao:{
                    required:"*Este campo é obrigatório!",
                    creditcard:"*Digite um número de cartão válido!"
                },
                cvvCartao:{
                    required:"*Este campo é obrigatório!"
                },
                mesValidade:{
                    required:"*Este campo é obrigatório!"
                },
                anoValidade:{
                    required:"*Este campo é obrigatório!"
                },
                qntParcelas:{
                    required:"*Este campo é obrigatório!"
                }
            }
        });
    });

    var successSend = true;
    var amount = $('.amount').attr("data-amount");
    pagamento();
    $('#qtParcelas').hide();

    function pagamento() {
        var endereco = jQuery('.endereco').attr("data-endereco");
        $.ajax({
            url: endereco + "pagamento",
            type: 'POST',
            dataType: 'json',
            success: function (retorno) {
                PagSeguroDirectPayment.setSessionId(retorno.id);
                console.log(retorno);
            },
            error: function (retorno) {
                console.log(retorno);
            },
            complete: function (retorno) {
                listarMeiosPag();
            }
        });
    }

    function listarMeiosPag() {
        PagSeguroDirectPayment.getPaymentMethods({
            amount: amount,
            success: function (retorno) {
                $('.meio-pag').append("<div class='mt-4'>Cartão de Crédito</div>");
                $.each(retorno.paymentMethods.CREDIT_CARD.options, function (i, obj) {
                    $('.meio-pag').append("<span class='img-band p-3'><img src='https://stc.pagseguro.uol.com.br" + obj.images.SMALL.path + "'></span>");
                });
            },
            error: function(){
                $('#msg-status').html('<div class="alert alert-danger col-12">Falha ao receber Informações de pagamento</div>');
            },
        });
    }

    $('#numCartao').on('keyup', function () {
        var numCartao = $(this).val();
        var qntNumero = numCartao.length;

        if (qntNumero == 6) {
            PagSeguroDirectPayment.getBrand({
                cardBin: numCartao,
                success: function (retorno) {
                    $('#msg').empty();

                    var imgBand = retorno.brand.name;
                    
                    $('.bandeira-cartao').html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/" + imgBand + ".png'>");
                    $('#bandeiraCartao').val(imgBand);
                    
                    recupParcelas(imgBand);
                },
                error: function (retorno) {
                    //Enviar para o index a mensagem de erro
                    $('.bandeira-cartao').empty();
                    $('#msg').html("Cartão inválido");
                }
            });
        }
    });

    function recupParcelas(bandeira) {
        PagSeguroDirectPayment.getInstallments({
            amount: amount,
            //Quantidade de parcelas sem juro
            maxInstallmentNoInterest: 2,
            //Tipo da bandeira
            brand: bandeira,
            success: function (retorno) {
                $.each(retorno.installments, function (ia, obja) {
                    $.each(obja, function (ib, objb) {
                        //Converter o preço para o formato real com JavaScript
                        var valorParcela = objb.installmentAmount.toFixed(2).replace(".", ",");

                        $('#qtParcelas').show();
                        //Apresentar quantidade de parcelas e o valor das parcelas para o usuário no campo SELECT
                        $('#qntParcelas').append("<option value='" + objb.quantity + "' data-parcelas='" + objb.installmentAmount + "'>" + objb.quantity + " parcelas de R$ " + valorParcela + "</option>");
                    });
                });
            },
            error: function(){
                $('#msg-status').html('<div class="alert alert-danger col-12">Falha ao receber Inscrição</div>');
            }
        });
    }

    $('#qntParcelas').change(function () {
        $('#valorParcelas').val($('#qntParcelas').find(':selected').attr('data-parcelas'));
    });
    

    //Recuperar o token do cartão de crédito
    $("#formPagamento").on("submit", function (event) {
        event.preventDefault();
        // $("#btnComprar").val("ENVIANDO...");
        // $("#btnComprar").attr("disabled", true);    
        PagSeguroDirectPayment.createCardToken({
            cardNumber: $('#numCartao').val(), // Número do cartão de crédito
            brand: $('#bandeiraCartao').val(), // Bandeira do cartão
            cvv: $('#cvvCartao').val(), // CVV do cartão
            expirationMonth: $('#mesValidade').val(), // Mês da expiração do cartão
            expirationYear: $('#anoValidade').val(), // Ano da expiração do cartão, é necessário os 4 dígitos.
            success: function (retorno) {
                $('#tokenCartao').val(retorno.card.token);
                successSend = true;
            },
            error: function(){
                $('#msg-status').html('<div class="alert alert-danger col-12">Falha ao receber Inscrição</div>');
                successSend = false;
                return false;
            },
            complete: function (retorno) {
                recupHashCartao();
            }
        });
    });

    //Recuperar o hash do cartão
    function recupHashCartao() {
        PagSeguroDirectPayment.onSenderHashReady(function (retorno) {
            if (retorno.status == 'error') {
                console.log(retorno.message);
                return false;
            } else {
                $("#hashCartao").val(retorno.senderHash);
                var dados = $("#formPagamento").serialize();
                if(successSend) {
                    $.ajax({
                        url: "./pagar/checkout/",
                        type:"POST",
                        cache: false,
                        data: dados,
                        //dataType: "json",
                        beforeSend : function(){
                            $("#btnComprar").val("ENVIANDO...");
                            $("#btnComprar").attr("disabled", true);
                            //setTimeout($('html, body').animate({scrollTop:0}, 'slow'), 3000); //slow, medium, fast
                            $('#msg-status').html('<div class="alert alert-info col-12">Recebendo inscrição...</div>');
                        },
                        success: function(response) {
                            if(response == "ERRO"){
                                $('#msg-status').html('<div class="alert alert-danger col-12">Domínio de e-mail inválido para efetuar a transação</div>');
                                successSend = false;
                                return false;    
                            } else {
                                console.log(response);
                                $('#msg-status').html('<div class="alert alert-success col-12">Inscrição Recebida</div>');
                                window.setTimeout("location.href='./'",1000);
                            }
                        },
                        error: function(response) {
                            console.log(response);
                            $('#msg-status').html('<div class="alert alert-danger col-12">Falha ao receber Inscrição</div>');
                        },
                        complete: function() {
                            $("#btnComprar").val("Enviado");
                            $("#btnComprar").attr("disabled", false);
                            
                        }
                    });
                }
                successSend = true;
            }
        });
    }

    if (cadastrado) {
        $('form input').attr("disabled", true);
    }
</script>