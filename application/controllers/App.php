<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->layout->setLayout("app/carbon_layout");
        $this->load->model('usuario_model');
        $this->load->library('session');
    }
    
    public function index() {
        $this->load->view('app/login');            
        
    }

    function login($url = "") {
        $this->data['alerta']["Activado"] = 0;
        $post = $this->input->post('login');
        
        if ($post['usuario'] && $post['contrasena']) {
            $arrUser = $this->usuario_model->get_usuario($post['usuario'], $post['contrasena']);
            
            // Si no se encuentra el usuario, configurar alerta
            if (count($arrUser) == 0) {
                $this->data['alerta']["Activado"] = 1;
                $this->data['alerta']["icon"] = "error";
                $this->data['alerta']["title"] = "El nombre de usuario o contraseña son incorrectos";
                $this->data['alerta']["text"] = "Por favor, verifica tus datos e intenta nuevamente.";
            } else {
                redirect(site_url("/bandeja/bandeja/index"));
            }
        }
    
        $this->load->view('app/login', $this->data);
    }
    
    public function logout(){   
        $this->session->set_userdata("arrUser", null);
        $this->load->view('app/login');
    }

}