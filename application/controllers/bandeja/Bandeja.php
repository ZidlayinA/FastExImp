<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bandeja extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('bandeja/index');
    }

    public function dashboard(){
        $this->load->view('app/dashboard');
    }
}