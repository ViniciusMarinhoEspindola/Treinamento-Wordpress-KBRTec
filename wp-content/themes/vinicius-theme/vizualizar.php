<?php
/** Template Name: Vizualizar Inscritos */
?>
<div id="pag">
<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        global $wpdb; 
        $inscritos = $wpdb->get_results("SELECT * FROM usuarios_wp u WHERE id_usuario = ".$id);
?>
        <table class="my-table my-5" id="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Data de inscrição</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($inscritos as $inscrito)
                    {
                ?>
                        <tr>
                            <td><?php echo $inscrito->nome; ?></td>
                            <td><?php echo $inscrito->email; ?></td>
                            <td><?php echo $inscrito->cpf; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($inscrito->dt_inscricao)); ?></td>
                            <td><?php echo $inscrito->telefone; ?></td>
                            <td><?php echo $inscrito->celular; ?></td>
                            
                        </tr>
                <?php
                    } 
                ?>
            </tbody>
        </table>
        <table class="my-table my-5" id="table">
            <thead>
                <tr>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>data de inscrição</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($inscritos as $inscrito)
                    {
                ?>
                        <tr>
                            <td><?php echo $inscrito->cep; ?></td>
                            <td><?php echo $inscrito->endereco; ?></td>
                            <td><?php echo $inscrito->bairro; ?></td>
                            <td><?php echo $inscrito->cidade; ?></td>
                            <td><?php echo $inscrito->estado; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($inscrito->dt_inscricao)); ?></td>
                            <td><?php echo $inscrito->status_pagamento; ?></td>
                        </tr>
                <?php
                    } 
                ?>
            </tbody>
        </table>
<?php
    }
?>
</div>