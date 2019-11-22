<form action="<?php echo home_url( '/' ); ?>" class="col-4" method="get">
    <div class="form-row">
    <label for="search">Pesquisar Treinamento</label>
    <input class="form-control col-8" type="text" name="s" id="search" value="<?php the_search_query(); ?>"/>
    <input type="submit" class="col-3 ml-1 btn btn-outline-warning" value="Pesquisar">
    </div>
</form>