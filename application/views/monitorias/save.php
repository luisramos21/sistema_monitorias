
<div class="container">
    <h2><?php echo $action; ?></h2>
    <div class="form_error">
        <?php echo validation_errors(); ?>
        <?php
        if (isset($Invalid)) {
            if (is_array($Invalid)) {
                foreach ($Invalid as $value) {
                    ?><p><?php echo $value; ?></p><?php
                }
            } else if (is_string($Invalid)) {
                ?><p><?php echo $Invalid; ?></p><?php
            }
        }
        ?>
    </div>
    <div class="form_warning">
        <p><?php echo empty($opciones_monitores) ? "No hay Monitores Disponibles.<br> <a  class='btn btn-info' href='". base_url()."index.php/monitores/save'>Agregar Monitor</a>" : "" ?></p>
    </div>
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    $types = array('number', 'email', 'date');
    //create form

    $id = !isset($id) || $id <= 0 ? "" : "/$id";
    echo form_open("/monitorias/save{$id}");
    //si es update or save
    echo form_hidden("update", $update);

    foreach ($monitoria as $key => $column) {
        $column['id'] = $column['name'];
        $column['class'] = "form-control";
        ?>
        <div class="form-group">
            <?php
            if (isset($column['label'])) {
                echo form_label($column['label'], $column['id'], array(
                    "for" => $column['id']
                        )
                );
                unset($column['label']);
            }

            if (!isset($column['type'])) {
                $column['type'] = 'text';
            }

            switch ($column['type']) {
                case 'text':
                case 'number':
                case 'hidden':
                case 'date':
                    echo form_input($column);
                    break;
                case 'select':
                    echo form_dropdown('monitor_id', isset($opciones_monitores) ? $opciones_monitores : array(), isset($seleccionar_monitor) ? $seleccionar_monitor : array(), array('class' => 'form-control'));
                    break;
            }
            ?>

        </div>

        <?php
    }
    echo form_label('<span class="glyphicon glyphicon-floppy-saved"></span> &nbsp;&nbsp;Guardar Monitor', 'submit', array("class" => 'btn btn-success'));
    echo form_submit('', 'GO', array("class" => 'hidden', 'id' => 'submit'));
    echo form_button('', '<span class="glyphicon glyphicon-floppy-remove"></span> &nbsp;&nbsp;Cancelar', array("class" => 'btn btn-danger', 'onclick' => 'cancelar();'));
    echo form_close(); //end form
    ?>
</div>
<script>
    function cancelar() {
        location.href = "<?php echo base_url(); ?>index.php/monitorias";
    }
</script>