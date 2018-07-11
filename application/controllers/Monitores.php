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

        $this->load->helper(array('form','url'));
        //$this->load->library("pagination");
        $this->load->model('monitores_model');
    }
    /*index funtion todos los monitores*/
    public function index() {
        $data = $this->monitores_model->get(0);
        $this->load->view('defaut');
        $this->load->view('monitores/index', array('data'=>$data));
        $this->load->view('footer');
    }
    /*
        Metodo para guardar en o editar monitores
     *      */
    public function save() {
        //set defaut view
        $this->load->view('defaut');       
        
        if (!$this->input->post()){
        //load columns name in view
            $data['mi'] = $this->monitores_model->columns;
            //view for formulario save
            $this->load->view('monitores/save', $data);
        }else {
            //echo $this->input->post('cedula');
            if($this->monitores_model->save($this->input->post(),false)){
                //redireccionar a index si se guardar correctamente
                redirect('monitores/index');
            }else{
                //error
            }
        }
        //footer of view
        $this->load->view('footer');
    }

}

?>