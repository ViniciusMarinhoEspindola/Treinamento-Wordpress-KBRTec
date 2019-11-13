   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.ajax({
                            url: "https://viacep.com.br/ws/"+cep+"/json/unicode/",
                            dataType: 'json',
                            success: function(dados) {
                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#endereco").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#estado").val(dados.uf);
                                } //end if.
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

        


        // Mascara
        $("input[name=cpf]").mask("000.000.000-00");
        $("input[name=celular]").mask("(00) 00000-0009");
        $("input[name=telefone]").mask("(00) 0000-0000");


        // validate
        $(document).ready(function(){
            $("#userCadastro").validate({
                rules:{
                    nome:{
                        required:true,
                        minlength:5
                    },
                    nascimento:{
                        required:true
                    },
                    cpf:{
                        required:true,
                        maxlength:14,
                        minlength:14,
                        cpfBR: true
                    },
                    email:{
                        required:true,
                        email:true
                    },
                    celular:{
                        required:true,
                        minlength:14,
                        maxlength:15
                    },
                    telefone:{
                        required:true
                    },
                    cep:{
                        required:true
                    },
                    endereco:{
                        required: true
                    },
                    bairro:{
                        required: true
                    },
                    cidade:{
                        required:true
                    },
                    estado:{
                        required:true
                    }
                },
                messages:{
                    nome:{
                        required:"*Este campo é obrigatório!",
                        minlength:"*Digite seu nome completo!"
                    },
                    nascimento:{
                        required:"*Este campo é obrigatório!"
                    },
                    cpf:{
                        required:"*Este campo é obrigatório!",
                        maxlength:"*Por favor digite um número de CPF válido!",
                        minlength:"*Por favor digite um número de CPF válido!",
                        cpfBR: "*Por favor digite um número de CPF válido"
                    },
                    email:{
                        required:"*Este campo é obrigatório!",
                        email:"*Digite um endereço de E-mail valido!"
                    },
                    celular:{
                        required:"*Este campo é obrigatório!",
                        minlength:"*Digite um número de celular valido!",
                        maxlength:"*Digite um número de celular valido!"
                    },
                    telefone:{
                        required:"*Este campo é obrigatório!"
                    },
                    cep:{
                        required:"*Este campo é obrigatório!"
                    },
                    endereco:{
                        required:"*Este campo é obrigatório!"
                    },
                    bairro:{
                        required:"*Este campo é obrigatório!"
                    },
                    cidade:{
                        required:"*Este campo é obrigatório!"
                    },
                    estado:{
                        required:"*Este campo é obrigatório!"
                    }
                }
            });
        });


        // Etapas do form
        $(document).ready(function () {
            $('form section').eq(1).hide();
        });

        $('#next').click(function (e) {

            var fields = $( "#etapa-1 input" ).serializeArray();
            $.each(fields,  function( i, field ) {
                
                if(field.value == "") {
                    field.focus();
                    return false;
                }
                return true;
            }); 
            
            e.preventDefault(); 
            $('form section').eq(0).hide();
            $('form section').eq(1).fadeIn();
            
        });

        $('#prev').click(function (e) {
            e.preventDefault();
            $('form section').eq(1).hide();
            $('form section').eq(0).fadeIn();
        });
    </script>
</body>
</html>