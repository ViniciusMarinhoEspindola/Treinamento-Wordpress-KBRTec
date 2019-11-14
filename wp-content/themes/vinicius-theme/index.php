<?php get_header(); ?>

<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'treinamento',
        'paged' => $paged
    ); 
    $items = new WP_Query($args);
   
?>

<h1 class="text-center display-4 text-warning mb-5">Treinamentos</h1>

<div class="container">
    <div class="row">
        <?php if ( $items->have_posts() ) : while ( $items->have_posts() ) : $items->the_post(); ?>
            <?php $num_vagas = get_field('numero_de_vagas') - $wpdb->get_var( "SELECT COUNT(id_usuario) FROM usuarios_wp WHERE treinamento_id = $post->ID" ); ?>
            <div class="col-3 mb-3">
                <a href="<?php the_permalink() ?>">
                    <div class="card pb-5 pt-3">
                        <figure>
                            <div class="card-top">
                                <div class="card-img-top">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </div>
                                <div class="text-center">
                                    <h5 class="card-title text-warning mt-5"><?php the_title(); ?></h5>
                                </div>
                            </div>
                            
                            <figcaption>
                                <h2 class="text-center mb-3"><?php the_title(); ?></h2> 
                                <p class="mb-5"><?php the_field('chamada'); ?></p>
                                
                                <?php if ($num_vagas > 0) { ?>
                                    <p>Vagas restantes: <?php echo $num_vagas; ?></p>
                                <?php } else { ?>
                                    <p>Não há mais vagas restantes</p>
                                <?php } ?>

                                <?php
                                    if(get_field('gratis') == 'Não') {
                                        ?> <h4> Valor:  R$<?php the_field('valor'); ?> </h4> <?php
                                    } else {
                                        ?> <h4> Grátis </h4> <?php
                                    }
                                ?>
                                
                                <p class="text-center leia-mais"><a href="<?php the_permalink() ?>" class="text-light">Leia Mais</a></p>
                            </figcaption>
                        </figure>
                        
                    </div>
                </a>
            </div>
        <?php endwhile; ?>

        <?php echo get_next_posts_link( 'Próximo', $items->max_num_pages ); ?>
        <?php echo get_previous_posts_link( 'Anterior', $items->max_num_pages ); ?>
        <?php else: ?>
            <h1 class="text-muted">Não há treinamentos disponíveis</h1>
        <?php endif; ?>
       
    </div>
</div>
<?php get_footer(); ?>
    