
<div class="container">
    <h2><?php echo $action; ?> Monitor</h2>
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */


    echo form_open("/monitores/save");
    foreach ($monitor as $key => $column) {
        $column['id'] = $column['name'];
        $column['class'] = "form-control";
        //test
        if ($key == 'cedula' && $column['value']=='123456789') {
            $column['value'] = crc32(md5(date('Y-m-d H:s:i')));
        }
        ?>
        <div class="form-group">
            <?php
            echo form_label($column['label'], $column['id'], array(
                "for" => $column['id']
                    )
            );
            echo form_input($column);
            ?>

        </div>

        <?php
    }
    echo form_label('<span class="glyphicon glyphicon-floppy-saved"></span> &nbsp;&nbsp;Guardar Monitor', 'submit', array("class" => 'btn btn-success'));
    echo form_submit('', 'GO', array("class" => 'hidden', 'id' => 'submit'));
    echo form_button('', '<span class="glyphicon glyphicon-floppy-remove"></span> &nbsp;&nbsp;Cancelar', array("class" => 'btn btn-danger','onclick'=>'cancelar();'));
    echo form_close(); //end form
    ?>
</div>
<script>
function cancelar() {
    location.href = "<?php echo base_url(); ?>index.php/monitores/index";}
</script>