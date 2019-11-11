<?php get_header(); ?>
<?php
    $args = array('post_type' => 'treinamento'); 
    $items = new WP_Query($args);
?>
    <div id="conteudo">
        <div id="artigos">
         
            <?php if (  $items->have_posts() ) : while (  $items->have_posts() ) :  $items->the_post(); ?>
                <div class="artigo">
                    <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
                    <p><?php the_content(); ?></p>
                </div>
            <?php endwhile; else: ?>
                <div class="artigo">
                    <h2>Nada Encontrado</h2>
                    <p>Erro 404</p>
                    <p>Lamentamos mas não foram encontrados artigos.</p>
                </div>            
            <?php endif; ?>
             
        </div>
        
    </div>
<?php get_footer(); ?>