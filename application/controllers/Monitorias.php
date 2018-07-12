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

    public function save($id = 0) {
        //set defaut view
        $this->load->view('defaut');
        $action = "Crear Monitoria";
        $request = $this->input->post();

        if ($id >= 0 && empty($request)) {
            //load columns name in view
            if ($id > 0) {
                $action = "Editar Monitoria #$id";
                $this->monitorias_model->set($id);
            }

            $data['monitoria'] = $this->monitorias_model->columns;
            $data['action'] = $action;
            $data['id'] = $id;
            $data['update'] = $id > 0 ? 1 : 0;
            $monitoresArray = $this->monitores_model->get(0, false);
            $monitores = array();
            foreach ($monitoresArray as $value) {
                $monitores[$value['id']] = $value['nombres'] . " " . $value['apellidos'];
            }
            
            $data['opciones_monitores'] = $monitores; //todos los monitores
            $data['seleccionar_monitor'] = isset($data['monitoria'][2]['value'])?$data['monitoria'][2]['value']:0; //seleccionar el monitor
            
            //view for formulario save
            $this->isValidFormMonitoria($data);
        } else if (!empty($request)) {
            $mensaje = "No se pudo Guardar la monitoria.";
            $estado = 0;
            $this->monitorias_model->setData($request);
            $data['monitoria'] = $this->monitorias_model->columns;
            $data['action'] = $action;
            $data['update'] = $request['update'];
            
            $statusForm = $this->isValidFormMonitoria($data);
            
            if ($statusForm) {
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
        }
        //footer of view
        $this->load->view('footer');
    }

    function delete($id = 0) {
        $mensaje = "No se pudo Eliminar la monitoria #" . $id;
        $estado = 0;
        $data = $this->monitorias_model->get($id, true);
        file_put_contents("monitoria.txt", print_r($data, TRUE));
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

    /*
      verifica si el los campos sean validos para la lista de monitoria
     */

    private function isValidFormMonitoria($data) {
        // basic required field
        foreach ($this->monitorias_model->columns as $key => $column) {

            if (isset($column['label'])) {
                $label = str_replace(":", '', $column['label']);
                $label = strpos($label,"Monitor")==FALSE?$label:"Monitor";
                $this->form_validation->set_rules(
                        $column['name'], "Campo - ", 'required', array('required' => "Campo {$label} es Requerido."));
            }
        }
        //valido formulario
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('monitorias/save', $data);
            return false;
        }

        return true;
    }

}

?>