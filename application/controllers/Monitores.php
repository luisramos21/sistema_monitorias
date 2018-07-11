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
        //$this->load->library("pagination");
        $this->load->model('monitores_model');
    }

    /* index funtion todos los monitores */

    public function index() {
        $data = $this->monitores_model->get(0);
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
        $action = "Nuevo";

        if (!$this->input->post()) {
            //load columns name in view
            if ($cedula > 0) {
                $action = "Editar";
                $this->monitores_model->set($cedula);
            }

            $data['monitor'] = $this->monitores_model->columns;
            $data['action'] = $action;
            //view for formulario save
            $this->load->view('monitores/save', $data);
        } else if ($this->input->post()) {
            //echo $this->input->post('cedula');
            if ($this->monitores_model->save($this->input->post(), false)) {
                //redireccionar a index si se guardar correctamente
                redirect('monitores/index');
            } else {
                //error
            }
        }
        //footer of view
        $this->load->view('footer');
    }
    
    function delete($cedula = 0) {
        $data = $this->monitores_model->get($cedula);
        if(!empty($data) && $data !=FALSE){
           $this->monitores_model->delete($cedula);
        }else{
            
        }
    }

}

?>