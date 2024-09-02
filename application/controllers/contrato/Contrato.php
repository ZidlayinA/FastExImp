<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Contrato extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('contrato/index');
    }
}