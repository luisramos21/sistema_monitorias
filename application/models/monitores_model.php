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
    public $ColumnIndex = 'cedula'; //name of primary key of the table 
    public $columns = array(
        array(
            'name' => 'cedula',
            'label' => 'Cedula',
            'placeholder' => 'Escribe un número de cedula',
            'value' => '123456789'
        ),
        array(
            'name' => 'nombres',
            'label' => 'Nombre',
            'placeholder' => 'Escribe un Nombre',
            'value' => '123456789'
        ),
        array(
            'name' => 'apellidos',
            'label' => 'Apellidos',
            'placeholder' => 'Escribe un Apellido',
            'value' => '123456789'
        ),
        array(
            'name' => 'programa_academico',
            'label' => 'Programa Academico',
            'placeholder' => 'Escribe un Programa Acádemico',
            'value' => '123456789'
        ),
        array(
            'name' => 'semestre',
            'type' => 'number',
            'label' => 'Semestre',
            'placeholder' => 'Escribe un semestre',
            'value' => '123456789'
        ),
        array(
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'placeholder' => 'Escribe un Email',
            'value' => 'ls@gmail.com'
        ),
        array(
            'name' => 'telefono',
            'type' => 'number',
            'label' => 'Número Telefono',
            'placeholder' => 'Escribe un Telefono',
            'value' => '018000515'
        ),
        array(
            'name' => 'direccion',
            'label' => 'Dirección',
            'placeholder' => 'Escribe una Dirección',
            'value' => 'DST sas'
        ),
        array(
            'name' => 'celular',
            'type' => 'number',
            'label' => 'Número de Celular',
            'placeholder' => 'Escribe una Número de celular',
            'value' => '78999999999'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get($celula = 0) {

        $filter = array();
        if ($celula > 0) {
            $filter[$this->ColumnIndex] = $celula;
        }

        $data = $this->db->get($this->table, $filter);
        if ($data->num_rows() > 0) {
            $json = array();
            foreach ($data->result() as $row) {
                $json[] = (array)$row;
            }
            return $json;
        }
        return FALSE;
    }

    /*
      metodo es para guardar o actualizar los datos del los monitores
     */

    function save($data = array(), $update = false) {

        if (empty($data) || !isset($data[$this->ColumnIndex])) {
            return false;
        }
        $id_monitor = array($this->ColumnIndex => $data[$this->ColumnIndex]);

        if (!$update) {

            return $this->db->insert($this->table, $data);
        } else {
            return $this->db->update($this->table, $data, $id_monitor);
        }
    }

    /*
      metodo es para eliminar los datos del los monitores
     */

    function delete($celula = 0) {
        if ($celula <= 0) {
            return false;
        }

        $this->db->delete($this->table, array($this->ColumnIndex => $celula));
    }

}

?>