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

class monitores_model extends CI_Model {

    private $table = 'monitores'; //name of table
    public $ColumnIndex = 'id'; //name of primary key of the table 
    public $columns = array(
        array(
            'name' => 'id',
            'value' => 0,
            'type' => 'hidden'
        ),
        array(
            'name' => 'cedula',
            'label' => 'Número de Cedula : ',
            'placeholder' => 'Escribe un número de cedula',
            'type' => 'number'
        ),
        array(
            'name' => 'nombres',
            'label' => 'Nombres : ',
            'placeholder' => 'Escribe un Nombre',
            'required' => 'required'
        ),
        array(
            'name' => 'apellidos',
            'label' => 'Apellidos : ',
            'placeholder' => 'Escribe un Apellido',
            'required' => 'required'
        ),
        array(
            'name' => 'programa_academico',
            'label' => 'Programa Acádemico : ',
            'placeholder' => 'Escribe un Programa Acádemico',
            'required' => 'required'
        ),
        array(
            'name' => 'semestre',
            'type' => 'number',
            'label' => 'Semestre : ',
            'placeholder' => 'Escribe un semestre',
            'required' => 'required'
        ),
        array(
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email : ',
            'placeholder' => 'Escribe un Email',
            'required' => 'required'
        ),
        array(
            'name' => 'telefono',
            'type' => 'number',
            'label' => 'Número Telefono : ',
            'placeholder' => 'Escribe un Telefono',
            'required' => 'required'
        ),
        array(
            'name' => 'celular',
            'type' => 'number',
            'label' => 'Número de Celular : ',
            'placeholder' => 'Escribe una Número de celular',
            'required' => 'required'
        ),
        array(
            'name' => 'direccion',
            'label' => 'Dirección : ',
            'placeholder' => 'Escribe una Dirección',
            'required' => 'required'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get($cedula = 0, $strict = false, $Forcebeetween = false) {

        $json = array();
        if ($cedula > 0) {
            $this->db->where('cedula', $cedula);
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

    function setData($data = array()) {
        if (!empty($data)) {
            foreach ($this->columns as $keyColum => $column) {
                foreach ($data as $key => $value) {
                    if ($column['name'] == $key) {
                        $this->columns[$keyColum]['value'] = $value;
                    }
                }
            }
        }
    }

    /*
      metodo es para guardar o actualizar los datos del los monitores
     */

    function save($data = array()) {
        $update = false;
        if (empty($data) || !isset($data["cedula"])) {
            return false;
        }
        
        //si es actualizar elimino el registro
        if (isset($data['update']) && $data['update'] && isset($data['id'])) {
            $update = true;
            $this->db->where($this->ColumnIndex, $data['id']);
            unset($data['id']);
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

    function delete($id = 0) {
        $this->db->where($this->ColumnIndex, $id);
        return $this->db->delete($this->table);
    }

}

?>