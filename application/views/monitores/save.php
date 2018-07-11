<h1>Agregar Monitores</h1>

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//ini form
//if (isset($columns)) {
echo form_open("/monitores/save");
foreach ($mi as $key => $column) {
    
    //test
    if($key=='cedula'){
        $column['value'] = crc32(md5(date('Y-m-d H:s:i')));
    }
    
    echo form_label($column['label'], $column['label']);
    echo " : ";
    echo form_input($column);
    echo "<br><br><br>";
}

echo form_submit('','Guardar');
echo form_close(); //end form
?>