
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
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    $extra1 = isset($cedula) && !empty($cedula) && $cedula>0 ? "/$cedula" : "";
    //create form
    echo form_open("/monitores/save{$extra1}");
    //si es update or save
    echo form_hidden("update", $update);

    foreach ($monitor as $key => $column) {


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
            echo form_input($column);
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