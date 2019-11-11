<?php get_header(); ?>

<?php
    $args = array('post_type' => 'treinamento'); 
    $items = new WP_Query($args);
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
        </div>
                    <div class="card-body">
                        <p class=""><?php the_content(); ?></p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-warning text-light">Cadastrar-se no curso</button>
                    </div>
                </div>
            </div>    
        <?php } ?>
    
    </div>
</div>

<?php get_footer(); ?>