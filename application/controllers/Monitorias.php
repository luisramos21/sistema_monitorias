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

class Monitorias extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model(array('monitorias_model', 'monitores_model'));
    }

    /* index funtion todos los monitores */

    public function index() {
        $data = $this->monitorias_model->get(0, false);
        $this->load->view('defaut');
        $this->load->view('monitorias/index', array('data' => $data));
        $this->load->view('footer');
    }

    /*
      Metodo para guardar en o editar monitores
     *      */

    public function save($cedula = 0) {
        //set defaut view
        $this->load->view('defaut');
        $action = "Crear Monitoria";
        $request = $this->input->post();

        if ($cedula >= 0 && empty($request)) {
            //load columns name in view
            if ($cedula > 0) {
                $action = "Cambiar Monitoria #$cedula";
                $this->monitorias_model->set($cedula);
            }

            $data['monitorias'] = $this->monitorias_model->columns;
            $data['action'] = $action;
            $data['update'] = $cedula > 0 ? 1 : 0;
            $monitoresArray = $this->monitores_model->get(0, false);
            $monitores = array();
            foreach ($monitoresArray as $value) {
                $monitores[] = $value['nombres'] . " ".$value['apellidos'];
            }

            $data['opciones_monitores'] = $monitores; //todos los monitores
            //view for formulario save
            $this->load->view('monitorias/save', $data);
        } else if (!empty($request)) {
            $mensaje = "No se pudo Guardar la monitoria.";
            $estado = 0;
            
            if ($this->monitorias_model->save($request)) {
                //redireccionar y enviar mensaje a index si se guardar correctamente
                if (isset($request['update']) && !$request['update']) {
                    $mensaje = "Se ha Guardado la monitoria";
                } else {
                    $mensaje = "Se ha Actualizado el monitoria";
                }
                $estado = 1;
            }
            $this->session->set_flashdata('Mensaje', $mensaje);
            $this->session->set_flashdata('Estado', $estado);            
            redirect('monitorias/');
        }
        //footer of view
        $this->load->view('footer');
    }

    function delete($id = 0) {
        $mensaje = "No se pudo Eliminar la monitoria #" . $id;
        $estado = 0;
        $data = $this->monitorias_model->get($id);
        //ok . se eliminó correctamnete
        if (!empty($data) && $data != FALSE) {
            $estado = $this->monitorias_model->delete($id) ? 1 : 0;
            $mensaje = "Se ha eliminado correctamente la monitoria.";
        } else {

            if ($id <= 0) {
                $mensaje = "Index $id Incorrecto";
            }
        }
        $this->session->set_flashdata('Mensaje', $mensaje);
        $this->session->set_flashdata('Estado', $estado);
        redirect('monitorias/');
    }

}

?>