<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller{    
    var $usuario_id = 0;
    var $intermediario_id=0;
    function __construct()
    {
        parent::__construct();
        $ci = &get_instance();
        $this->data['arrUser'] = $_SESSION['SUPPLYNET_arrUser']; 
        
        //pre($_SESSION['arrUser'],"--arrUser--"); 
        if(!$this->data['arrUser']){ //VALIDA QUE EXISTA USUARIO LOGEADO            
            redirect("app/index");
        } 
        $this->layout->setLayout("app/carbon_layout");
        //$this->load->model("catalogo_model");
        $this->load->model("usuario_model");
        //$this->load->model("cliente_model");
        $this->intermediario_id = (int)$this->data['arrUser']['gasnatural']['intermediario'];
        
        $this->data['error_warning'] = "";
        $this->data['success'] = "";

        if (isset($_SESSION['success'])) {
            $this->data['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }        
        if (isset($_SESSION['error'])) {
            $this->data['error_warning'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        
        //echo "AL FINAL DE LA CONSTRUCCION... <br>";
    }
    
    
    
    function set_permisos(){       
    }
       
    
    function check_contacto($tabla="", $tabla_id=0){
        
        $this->contacto_guardar($tabla, $tabla_id, 106, $this->input->post('contacto_telefono_id'),$this->input->post('contacto_telefono'), $this->input->post('contacto_telefono_borrar'));        
        $this->contacto_guardar($tabla, $tabla_id, 107, $this->input->post('contacto_celular_id'), $this->input->post('contacto_celular'), $this->input->post('contacto_celular_borrar'));        
        $this->contacto_guardar($tabla, $tabla_id, 108, $this->input->post('contacto_email_id'), $this->input->post('contacto_email'), $this->input->post('contacto_email_borrar'));        
    }
    
    function contacto_guardar($tabla, $tabla_id, $tipo_contacto, $arr_contacto_id, $arr_contacto, $arr_contacto_borrar){
                
        if($tabla_id > 0 and $arr_contacto_id){
            foreach($arr_contacto_id as $pos =>$id){
                $id = (int)$id;
                $info = null;
                $info['tabla'] = $tabla;
                $info['descripcion'] = $arr_contacto[$pos];

                if( $id == 0 and $info['descripcion']){
                    $info['tabla_id'] = $tabla_id;
                    $info['tipo_contacto'] = $tipo_contacto;                    
                    $this->contacto_model->insert($info);
                }else if( $id > 0 and  (int)$arr_contacto_borrar[$id] == $id){                    
                    $this->contacto_model->delete($id);
                }else if( $id > 0){
                    $info['id'] = $id;                    
                    $this->contacto_model->update($info);
                }                
            }
        }        
    }
}
