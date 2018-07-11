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
        $this->load->library('session');
        $this->load->library('form_validation');
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

    public function save($cedula = 0) {
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
            $data['update'] = $cedula > 0 ? 1 : 0;
            //view for formulario save
            $this->load->view('monitores/save', $data);
        } else if (!empty($request)) {
            $mensaje = "No se pudo Guardar el monitor.";
            $estado = 0;
            
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
            print_r($request);
            redirect('monitores/');
        }
        //footer of view
        $this->load->view('footer');
    }

    function delete($cedula = 0) {
        $mensaje = "No se pudo Eliminar el monitor " . $cedula;
        $estado = 0;
        $data = $this->monitores_model->get($cedula);
        //ok . se eliminó correctamnete
        if (!empty($data) && $data != FALSE) {
            $estado = $this->monitores_model->delete($cedula) ? 1 : 0;
            $mensaje = "Se ha eliminado correctamente el monitor.";
        } else {

            if ($cedula <= 0) {
                $mensaje = "Número de Cedula $cedula Incorrecta";
            }
        }
        $this->session->set_flashdata('Mensaje', $mensaje);
        $this->session->set_flashdata('Estado', $estado);
        redirect('monitores/');
    }

}

?>