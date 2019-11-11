<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php $values = get_post_custom( $post->ID ); ?>
<?php $text = isset( $values['chamada'] ) ? esc_attr( $values['chamada'][0] ) : ''; ?>

<div class="row">
    <div class="form-group col-3">
        <label for="gratuito_sim">Gratuito</label> <br>
        <input type="radio" class="form-control" id="gratuito_sim" name="gratuito"> <label for="gratuito_sim">Sim</label>
        <input type="radio" class="form-control" id="gratuito_nao" name="gratuito"> <label for="gratuito_nao">Não</label>
    </div>
    <div class="form-group col-3" id="preco">
        <label for="valor">Valor</label>
        <input type="number" class="form-control" value="" id="valor" name="valor">
    </div>
    <div class="form-group col-3">
        <label for="chamada">Chamada</label>
        <input type="text" class="form-control" id="chamada" name="chamada">
    </div>
    <div class="form-group col-3">
        <label for="num_vagas">Número de vagas</label>
        <input type="number" class="form-control" id="num_vagas" name="num-vagas">
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#preco').hide();
    });

    $('#gratuito_sim').change(function (){
        $('#preco').hide();
    });
    $('#gratuito_nao').change(function (){
        $('#preco').show();
    });
</script>
<?php wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); ?>