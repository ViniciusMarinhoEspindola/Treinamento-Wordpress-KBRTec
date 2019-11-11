<?php
/** Template Name: Cadastro */

get_header();
$post = get_post($_GET['id']);

?>
<div class="container">
    <div class="row">
        <h1 class="text-center text-warning display-4 col-12">Cadastrar-se no treinamento: <br> <?php echo $post->post_title; ?></h1>
            
            <div class='col-3'></div>

            <form class="col-6 mt-4" action="./cadastrar" method="POST">
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="treinamento_id">
                <div class="form-group">
                    <label for="nome">Nome completo</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <div class="form-group">
                    <label for="valor">Data de nascimento</label>
                    <input type="date" class="form-control" id="nascimento" name="nascimento">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco">
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade">
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="number" class="form-control" id="telefone" name="telefone">
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="number" class="form-control" id="celular" name="celular">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Enviar">
                    <input type="reset" class="btn btn-outline-warning" value="Limpar">
                </div>
            </form>
        
    </div>
</div>
<?php
get_footer();
?>