<?php
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->db->query("SET NAMES 'utf8'");
        //$this->data['bootstrap_dir'] = base_url("public/theme/default/bootstrap-3.3.5")."/";
        //$this->data['theme'] = "public/theme/default/bootstrap-3.3.7/";
        
        $this->controller = ($this->uri->segment(1))? $this->uri->segment(1) : "app" ;
        $this->method = ($this->uri->segment(2))? $this->uri->segment(2) : "index";
                
        
        /*if($seg1 == "admin" and $seg2==""){
            redirect("admin/index");
        }*/
        
    }
}