<?php get_header(); ?>

<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'treinamento',
        'paged' => $paged,
        's' => $_GET['s']
    ); 
    $items = new WP_Query($args);
   
?>

<h1 class="text-center display-4 text-warning mb-5">Treinamentos</h1>

<div class="container">
    <div class="row">
        <div class="col-12 mb-5"><?php get_search_form(); ?></div>

        <?php if ( $items->have_posts() ) : while ( $items->have_posts() ) : $items->the_post(); ?>
            <?php $num_vagas = get_field('numero_de_vagas') - $wpdb->get_var( "SELECT COUNT(id_usuario) FROM usuarios_wp WHERE treinamento_id = $post->ID" ); ?>
            <div class="col-3 mb-3">
                <a href="<?php the_permalink() ?>">
                    <div class="card pb-5 pt-3" style="min-height: 335px !important; ">
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
                                <h2 class="text-center mb-3" ><?php the_title(); ?></h2> 
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
        <?php
            echo paginate_links( array(
                'base' => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $items->max_num_pages,
                'prev_next' => true,
                'prev_text' => 'Página Anterior',
                'next_text' => 'Próxima Página',
                'before_page_number' => '-',
                'after_page_number' => '>',
                'show_all' => false,
                'mid_size' => 3,
                'end_size' => 1
             ));
             wp_reset_postdata();
        ?>
        
        <?php else: ?>
            <h1 class="col-12 text-center text-muted">Não há treinamentos disponíveis</h1>
        <?php endif; ?>
       
    </div>
</div>
<?php get_footer(); ?>
    