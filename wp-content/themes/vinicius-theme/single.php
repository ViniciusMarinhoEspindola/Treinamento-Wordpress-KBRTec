<?php get_header(); ?>

<?php
    $args = array('post_type' => 'treinamento'); 
    $items = new WP_Query($args);
    $num_vagas = get_field('numero_de_vagas') - $wpdb->get_var( "SELECT COUNT(id_usuario) FROM usuarios_wp WHERE treinamento_id = $post->ID" );

    if(isset($_POST) && $_POST)
    {
?>
        <div class="alert alert-success"><?php cadastrar_inscritos(); ?></div>
<?php     
    }
?>
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
                                    ?> <h4> Valor:  R$<?php the_field('valor'); ?> </h4> <?php
                                } else {
                                    ?> <h4> Grátis </h4> <?php
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
            <h1 class="text-center text-warning display-4 col-12">Cadastrar-se no treinamento: <br> <?php echo $post->post_title; ?></h1>
                
                <div class='col-2'></div>

                <form class="col-8 mt-4" id="userCadastro" action="<?php the_permalink(); ?>" method="POST">
                    <section id="etapa-1">
                        <input type="hidden" value="<?php echo $post->ID; ?>" name="treinamento_id">
                        <div class="form-group">
                            <label for="nome">Nome completo</label>
                            <input required type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="valor">Data de nascimento</label>
                            <input required type="date" class="form-control" id="nascimento" name="nascimento">
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input required type="text" class="form-control" id="cpf" name="cpf">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input required type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input required type="text" class="form-control" id="telefone" name="telefone">
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input required type="text" class="form-control" id="celular" name="celular">
                        </div>
                        <button id="next" class="btn btn-warning text-light">Próximo</button>
                    </section>
                    <section id="etapa-2">
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
                            <button id="prev" class="btn btn-outline-warning">Voltar</button>
                            <input type="submit" class="btn btn-warning text-light" value="Enviar">
                        </div>
                    </section>
                </form>
                        <a href="./pagseguro">Pagseguro</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>