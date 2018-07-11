<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of monitores_model
 *
 * @author Luis Ramos
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class monitorias_model extends CI_Model {

    private $table = 'listado_monitorias'; //name of table
    public $ColumnIndex = 'id'; //name of primary key of the table 
    public $columns = array(
        array(
            'name' => 'id',
            'value' => 0,
            'type' => 'hidden'
        ),
        array(
            'name' => 'materia',
            'label' => 'Materia : ',
            'placeholder' => 'Escribe una materia',
            'value' => 'PHP',
        ),
        array(
            'name' => 'monitor_id',
            'label' => 'Selecciona un Monitor : ',
            'type' => 'select'
        ),
        array(
            'name' => 'fecha',
            'label' => 'Fecha de Monitoria : ',
            'type' => 'date'
        ),
        array(
            'name' => 'salon',
            'label' => 'Salon Monitor : ',
            'placeholder' => 'Escribe un Salon',
            'value' => 5
        )
    );

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get($celula = 0, $strict = false) {

        $json = array();
        if ($celula > 0) {
            $this->db->where($this->ColumnIndex, $celula);
        }

        $data = $this->db->get($this->table);
        if ($data->num_rows() > 0) {

            foreach ($data->result() as $row) {
                $json[] = (array) $row;
                if ($strict) {
                    break;
                }
            }
        }
        return $json;
    }

    /* buscar y guardar en la propiedad column */

    function set($cedula) {
        $data = $this->get($cedula, true);

        if (!empty($data) && count($data) == 1) {
            foreach ($this->columns as $keyColum => $column) {
                foreach ($data[0] as $key => $value) {
                    if ($column['name'] == $key) {
                        $this->columns[$keyColum]['value'] = $value;
                    }
                }
            }
            return true;
        }
        return false;
    }

    /*
      metodo es para guardar o actualizar los datos del los monitores
     */

    function save($data = array()) {
        $update = false;        

        //si es actualizar elimino el registro
        if (isset($data['update']) && $data['update'] && isset($data[$this->ColumnIndex])) {
            $update = true;
            $this->db->where($this->ColumnIndex, $data[$this->ColumnIndex]);
            unset($data[$this->ColumnIndex]);
        }
        unset($data['update']);
        
        if (!$update) {
            return $this->db->insert($this->table, $data);
        } else {
            return $this->db->update($this->table, $data);
        }
    }

    /*
      metodo es para eliminar los datos del los monitores
     */

    function delete($celula = 0) {
        if ($celula <= 0) {
            return false;
        }
        return $this->db->delete($this->table, array($this->ColumnIndex => $celula));
    }

}

?>