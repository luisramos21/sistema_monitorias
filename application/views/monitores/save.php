<h1>Agregar Monitores</h1>
<div class="container">
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

//ini form
//if (isset($columns)) {
    echo form_open("/monitores/save", array("class" => "form-horizontal"));
    foreach ($mi as $key => $column) {
        $column['id'] = $column['name'];
        //test
        if ($key == 'cedula') {
            $column['value'] = crc32(md5(date('Y-m-d H:s:i')));
        }
        ?>
        <div class="form-group">
            <?php
            echo form_label($column['label'], $column['label'], array(
                "class" => "control-label col-sm-2",
                "for" => $column['id']
                    )
            );
            ?>
            <div class="col-sm-10">
                <?php echo form_input($column); ?>
            </div>
        </div>

        <?php
    }

    echo form_submit('', 'Guardar', array("class" => 'btn btn-default'));
    echo form_close(); //end form
    ?>
</div>