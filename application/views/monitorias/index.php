

<div class="container">
    <h2>Listado de Monitorias</h2>
    <a  href="<?php echo base_url(); ?>index.php/monitorias/save" class="btn btn-success">Nueva Monitoria</a>
    <a  href="<?php echo base_url(); ?>index.php/monitores/save" class="btn btn-info">Nuevo Monitor</a>
    <br>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Monitor</th>
                    <th>Programa Acádemico</th>
                    <th>Fecha Monitoria</th>
                    <th>Salón</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!empty($data)) {
                    
                    foreach ($data as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value['materia']; ?></td>
                            <td><?php echo $value['nombres'] . " " . $value['apellidos']; ?></td>
                            <td><?php echo $value['programa_academico']; ?></td>
                            <td><?php echo $value['fecha']; ?></td>
                            <td><?php echo $value['salon']; ?></td>
                            <td>
                                <a onclick="action('save', '<?php echo $value['id']; ?>', false)" href="#">
                                    <span class="glyphicon glyphicon-pencil " style="color:#003399;"></span> &nbsp;&nbsp;
                                </a>

                                <a onclick="action('delete', '<?php echo $value['id']; ?>', true)" href="#">
                                    <span class="glyphicon glyphicon-trash " style="color:#E13300;"></span> &nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No hay Monitorias</td>
                    </tr>
                    <?php
                }
                ?>

        </table>
    </div>

    <?php
    $mensaje = $this->session->flashdata('Mensaje');
    $estado = $this->session->flashdata('Estado');
    $class = $estado == 1 ? 'success' : 'danger';
    $status = $estado == 1 ? 'Correcto' : 'Error';
    if (isset($mensaje)) {
        ?>
        <div class="alert alert-<?php echo $class; ?>">
            <strong><?php echo $status; ?> !</strong> <?php echo $mensaje; ?>
        </div>
    <?php } ?>
</div>

<script>
    //redireccionar
    function action(action, parametro, confirmar) {
        var continued = false;
        if (confirmar) {
            continued = confirm("Estas Seguro de Eliminar este Monitor #" + parametro);
        } else {
            continued = true;
        }
        if (continued) {
            location.href = "<?php echo base_url(); ?>index.php/monitorias/" + action + "/" + parametro;
        }
    }

</script>