<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Monitores
 *
 * @author Luis Ramos
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitores extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model('monitores_model');
    }

    /* index funtion todos los monitores */

    public function index() {
        $data = $this->monitores_model->get(0, false);
        $this->load->view('defaut');
        $this->load->view('monitores/index', array('data' => $data));
        $this->load->view('footer');
    }

    /*
      Metodo para guardar en o editar monitores
     *      */

    public function save($cedula = 0, $extraData = array()) {
        //set defaut view
        $this->load->view('defaut');
        $action = "Nuevo Monitor";
        $request = $this->input->post();

        if ($cedula >= 0 && empty($request)) {
            //load columns name in view
            if ($cedula > 0) {
                $action = "Editar Monitor #$cedula";
                $this->monitores_model->set($cedula);
            }

            $data['monitor'] = $this->monitores_model->columns;
            $data['action'] = $action;
            $data['cedula'] = $cedula;
            $data['update'] = $cedula > 0 ? 1 : 0;
            //view for formulario save
            $this->isValidFormMonitor($data);
        } else if (!empty($request)) {
            $mensaje = "No se pudo Guardar el monitor.";
            $estado = 0;
            $this->monitores_model->setData($request);
            $data['monitor'] = $this->monitores_model->columns;
            $data['action'] = $action;
            $data['cedula'] = $cedula;
            $data['update'] = $request['update'];
            $validate = $this->isValidFormMonitor($data);
            //si es valido el formulario
            if ($validate) {
                if ($this->monitores_model->save($request)) {
                    //redireccionar y enviar mensaje a index si se guardar correctamente
                    if (isset($request['update']) && !$request['update']) {
                        $mensaje = "Se ha Guardado el monitor";
                    } else {
                        $mensaje = "Se ha Actualizado el monitor #{$request['cedula']}";
                    }
                    $estado = 1;
                }
                $this->session->set_flashdata('Mensaje', $mensaje);
                $this->session->set_flashdata('Estado', $estado);

                redirect('monitores/');
            }
        }
        //footer of view
        $this->load->view('footer');
    }

    /*
      delete of the monitor  for id
     */

    function delete($id = 0) {
        $mensaje = "No se pudo Eliminar el monitor #" . $id;
        $estado = 0;
        $data = $this->monitores_model->get($id);
        //ok . se eliminó correctamnete
        if (!empty($data) && $data != FALSE) {
            $estado = $this->monitores_model->delete($id) ? 1 : 0;
            if ($estado == 1) {
                $mensaje = "Se ha eliminado correctamente el monitor.";
            }
        } else {

            if ($id <= 0) {
                $mensaje = "$id Incorrecta";
            }
        }
        $this->session->set_flashdata('Mensaje', $mensaje);
        $this->session->set_flashdata('Estado', $estado);
        redirect('monitores/');
    }

    /*
      verifica si el los campos sean validos
     */

    private function isValidFormMonitor($data) {
        // basic required field
        foreach ($this->monitores_model->columns as $key => $column) {

            if (isset($column['label'])) {
                $label = str_replace(":", '', $column['label']);
                $this->form_validation->set_rules(
                        $column['name'], "Campo - ", 'required', array('required' => "Campo {$label} es Requerido."));
            }
        }
        //valido formulario
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('monitores/save', $data);
            return false;
        }
        //get number cedula
        $cedula = $data['monitor'][1]['value'];

        #verifico que el numero de cedula sea válida y no sea repetida
        $validCedula = $this->monitores_model->get($cedula, true, true);

        if (!empty($validCedula)) {

            if (((bool) $data['update'] && $cedula != $data['cedula'] ) && $cedula == $validCedula[0]['cedula'] || (bool) $data['update'] == FALSE && $cedula == $validCedula[0]['cedula']) {
                $data['Invalid'] = "Número de cédula ya existe por favor digite otro.";
                $action = "Nuevo Monitor";
                if ($data['cedula'] > 0) {
                    $action = $data['action'] = "Editar Monitor #{$data['cedula']}";
                }
                $data['action'] = $action;
                $this->load->view('monitores/save', $data);
                return FALSE;
            }
        }
        return true;
    }

}

?>