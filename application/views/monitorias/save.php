
<div class="container">
    <h2><?php echo $action; ?></h2>
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    $types = array('number', 'email', 'date');
    //create form
    echo form_open("/monitorias/save");
    //si es update or save
    echo form_hidden("update", $update);

    foreach ($monitorias as $key => $column) {
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
                case 'date':
                    echo form_input($column);
                    break;
                case 'select':
                    echo form_dropdown('monitor_id', $opciones_monitores, array(), array('class' => 'form-control'));
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
        location.href = "<?php echo base_url(); ?>index.php/monitores/index";
    }
</script>