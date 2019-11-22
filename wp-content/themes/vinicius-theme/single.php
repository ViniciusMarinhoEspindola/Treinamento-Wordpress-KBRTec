<?php get_header(); ?>

<?php
    $args = array('post_type' => 'treinamento'); 
    $items = new WP_Query($args);
    $num_vagas = get_field('numero_de_vagas') - $wpdb->get_var( "SELECT COUNT(id_usuario) FROM usuarios_wp WHERE treinamento_id = $post->ID" );

    if(isset($_POST) && $_POST)
    {
        if (unique_value('email') && unique_value('cpf')) {
            wp_mail( [$_POST['email']], "Inscrição Confirmada com sucesso!", "Sua inscrição no treinamento foi realizada com sucesso!" );
?>
            <div class="alert alert-success"><?php cadastrar_inscritos(); ?></div>
<?php   
        } else {
            if(!unique_value('email')) {
?>
                <div class="alert alert-danger">E-mail já cadastrado</div>
<?php
            }
            if(!unique_value('cpf')) {
?>
                <div class="alert alert-danger">CPF já cadastrado</div>
<?php
            }
        }
    }
?>
<a class="btn btn-warning text-light mx-3" href="<?php echo site_url(); ?>">Voltar</a>
<h1 class="text-center display-4 text-warning mb-5">Descrição do treinamento</h1>

<div class="container">
    
    <div class="row">
        <?php if ( $items->have_posts() ) { ?>
        <?php the_post(); ?>
            <div class="col-12 mb-3">
                <div class="card pb-5 pt-3">
                    <div class="card-img-top">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="text-center">
                        <h2 class="card-title text-warning mt-5"><?php the_title(); ?></h2>
                        <h4><?php the_field('chamada'); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class=""><?php the_content(); ?></p>
                    </div>
                    <div class="card-footer">
                        <div style="color:#f0ad4e;position: absolute; bottom: 50px; right: 18px;">
                            <?php
                                if(get_field('gratis') == 'Não') {
                            ?> 
                                    <h4> Valor:  R$<?php the_field('valor'); ?> </h4> 
                                    
                            <?php
                                    $location = "../../pagar";
                                } else {
                            ?> 
                                    <h4> Grátis </h4> 
                            <?php
                                    $location = get_permalink();
                                }
                            ?>
                        </div>
                       <?php if ($num_vagas > 0) { ?>
                            <button data-toggle="modal" data-target="#cadastrar-se" class="btn btn-warning text-light">Cadastrar-se no treinamento</button>
                            <p class="mt-2 text-danger">Restam <?php echo $num_vagas; ?> vagas</p>
                       <?php } else { ?>
                            <p class="text-danger">Não há mais vagas restantes</p>
                       <?php } ?>
                    </div>
                </div>
            </div>    
        <?php } ?>
    
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cadastrar-se" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <h1 class="text-center text-warning col-12">Cadastrar-se no treinamento: <br> <?php echo $post->post_title; ?></h1>
                
                <div class='col-2'></div>

                <form class="col-8 mt-4" id="userCadastro" action="<?php echo $location; ?>" method="POST">
                    <section id="etapa-1">
                        <input type="hidden" value="<?php echo $post->ID; ?>" name="treinamento_id">
                        <div class="form-group">
                            <label for="nome">Nome completo</label>
                            <input required type="text" class="form-control" value="<?php echo preenche_form()['nome']; ?>" id="nome" placeholder="Nome de exemplo" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="valor">Data de nascimento</label>
                            <input required type="date" class="form-control" value="<?php echo preenche_form()['nascimento'] ?>" id="nascimento" placeholder="11/11/1111" name="nascimento">
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input required type="text" class="form-control" value="<?php echo preenche_form()['cpf'] ?>" id="cpf" placeholder="111.111.111-11" name="cpf">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input required type="email" class="form-control" value="<?php echo preenche_form()['email'] ?>" id="email" placeholder="exemplo@hotmail.com" name="email">
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input required type="text" class="form-control" value="<?php echo preenche_form()['telefone'] ?>" id="telefone" placeholder="(11) 3411-1111" name="telefone">
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input required type="text" class="form-control" value="<?php echo preenche_form()['celular'] ?>" id="celular" placeholder="(11) 99111-1111" name="celular">
                        </div>
                        <button id="next" class="btn btn-warning text-light">Próximo</button>
                    </section>
                    <section id="etapa-2">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" value="<?php echo preenche_form()['cep'] ?>" id="cep" placeholder="11111-111" name="cep">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-9">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" value="<?php echo preenche_form()['endereco'] ?>" id="endereco" placeholder="Av. Exemplo Exemplo Exemplo, Número 1111" name="endereco">
                            </div>
                            <div class="form-group col-3">
                                <label for="numero">Número</label>
                                <input type="number" class="form-control" value="<?php echo preenche_form()['numero'] ?>" id="numero" placeholder="1111" name="numero">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" value="<?php echo preenche_form()['complemento'] ?>" id="complemento" placeholder="Casa 12" name="complemento">
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" value="<?php echo preenche_form()['bairro'] ?>" id="bairro" placeholder="Bairro Exemplo" name="bairro">
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" value="<?php echo preenche_form()['cidade'] ?>" id="cidade" placeholder="São Paulo" name="cidade">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" value="<?php echo preenche_form()['estado'] ?>" id="estado" placeholder="SP" name="estado">
                        </div>
                       
                        <div class="form-group">
                            <button id="prev" class="btn btn-outline-warning">Voltar</button>
                            <input type="submit" class="btn btn-warning text-light" value="Enviar">
                        </div>
                    </section>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>