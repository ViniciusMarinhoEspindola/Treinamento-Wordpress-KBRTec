<style>
    .my-table {
        border-top: 2px solid #f0ad4e;
        border-bottom: 2px solid #f0ad4e;
        border-collapse: collapse;
    }
    .my-table tbody tr td {
        padding: 8px;
        max-width: 300px;
        word-wrap: break-word;
    }
    .my-table thead tr th {
        padding: 20px;
        font-family: verdana;
        text-transform: uppercase;
        margin: 0px !important;
        color: #f0ad4e;
        cursor: pointer;
    }

    .my-table .table-image {
        max-width: 150px;
        box-shadow: 0px 0px 5px black
    }
    .my-table thead tr {
        border-bottom: 2px solid #f0ad4e;
    }
    .my-table tbody tr{
        border-bottom: 1px solid rgba(0,0,0,.2);
    }
    .my-table tbody tr:hover{
        background-color: #f0f0f0;

    }
    .my-table button {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .my-table button:hover, .my-table button:focus {
        text-decoration: none;
        cursor: pointer;
    }

    .my-table button:focus, .my-table button.focus {
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .my-table button {
        color: #fff;
        background-color: #f0ad4e;
        border-color: #f0ad4e;
    }

    .my-table button:hover {
        color: #fff;
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .my-table button:focus, .my-table button.focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.5);
    }
    .my-table tbody tr:hover {
        background-color: rgba(240, 173, 78, 0.075);
    }
    .my-table td{
        text-align: center;
    }
    center {
       margin-top: 100px;

    }
    .alert {
        position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

</style>

<?php
    if(isset($_GET['id']))
        $where = ' WHERE p.ID = '.$_GET['id'];
    else
        $where = '';
    
    
    if (isset($_POST['usuario']) && $_POST['usuario'])
    {
?>
        <div class="alert alert-success"><?php excluir_inscrito(); ?></div>
<?php
    }
    global $wpdb; 
    $inscritos = $wpdb->get_results("SELECT id_usuario,post_title, dt_inscricao, nome, email FROM usuarios_wp u INNER JOIN wp_posts p ON u.treinamento_id = p.ID".$where." ORDER BY id_usuario DESC"); 
?>


<center id="pag">
    <table class="my-table" id="table">
        <thead>
            <tr>
                <th>Curso</th>
                <th>Data de inscrição</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Vizualizar</th>
                <th>Excluir</th>
            </tr>
        </thead>
<?php 
    foreach ($inscritos as $inscrito)
    {
?>
        <tr>
            <td><?php echo $inscrito->post_title; ?></td>
            <td><?php echo date('d/m/Y', strtotime($inscrito->dt_inscricao)); ?></td>
            <td><?php echo $inscrito->nome; ?></td>
            <td><?php echo $inscrito->email; ?></td>
            <td><button value="<?php echo $inscrito->id_usuario; ?>" class="vizualizar">Vizualizar</button></td>
            <form action="#" method="POST">
                <input type="hidden" value="<?php echo $inscrito->id_usuario; ?>" id="id_inscrito" name="usuario">
                <td><button type="submit">Excluir</button></td>
            </form>
        </tr>
<?php
    } 
?>
    </table>
</center>



<?php get_footer(); ?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    // DataTable
    $(document).ready(function () {
        $('#table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "order": [[0, 'desc']],
            "lengthMenu": [[5, 10], [5, 10]],
            
        });
    });

    $(".vizualizar").click(function( e ){
        var href = "./vizualizar?id=" + $(this).val();
        $("#pag").load( href +" #pag");
    });
</script>