<?php  
class MY_Model extends CI_Model {
    var $user;
    var $userArray;
    
    function __construct()
    {
        parent::__construct();  
        //$this->load->helper("db");
        
        //$this->user =  $_SESSION['SUPPLYNET_arrUser']; 
        //pre($this->user,"user-model.. ");
        //$this->dbReporte = $this->load->database('dbrep', TRUE);
    }
    
    function add_track( $table, $id, $data, $action ){
        $user = $this->session->userdata("arrUser");
        $this->db->insert("sys_track",array('table'=>$table, 'row_id'=>$id, 'row_data'=>  json_encode($data) ,
                                            'action'=>$action, 'sys_user_id'=>$user['id']));
    }
    
    function get_cbo($table="", $select="id,nombre", $where="", $order_by="", $opInicial=""){
        $this->db->select($select,FALSE);
        if(is_array($where)) $this->db->where($where, "",false);        
        if($order_by) $this->db->order_by($order_by);
        $query = $this->db->get($table);
        
        //pre($this->db->last_query());
        
        $arr = array();
        if($opInicial) $arr[] = $opInicial;
        if($query->num_rows >0 ) 
            foreach($query->result_array() as $row )
                $arr[$row['id']] = $row['nombre'];
        
        return $arr;
    }

    function get_table_structure() {
        // Obtén la instancia del controlador
        //$CI =& get_instance();

        $database_name = $this->db->database; // Obtener el nombre de la base de datos
            
        // Obtén el nombre de la tabla desde la propiedad $this->tabla
        $table_name = $this->tabla;
            
        // Consulta para obtener la información de los campos incluyendo los comentarios y NOT NULL
        $query = $this->db->query("
            SELECT COLUMN_NAME, COLUMN_TYPE, CHARACTER_MAXIMUM_LENGTH, COLUMN_DEFAULT, COLUMN_KEY, COLUMN_COMMENT, IS_NULLABLE
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = '$database_name' AND TABLE_NAME = '$table_name'
        ");
            
        $result = [];
        foreach ($query->result() as $row) {
            $result[] = [
                'name' => $row->COLUMN_NAME,
                'type' => $row->COLUMN_TYPE,
                'max_length' => $row->CHARACTER_MAXIMUM_LENGTH,
                'default' => $row->COLUMN_DEFAULT,
                'primary_key' => $row->COLUMN_KEY === 'PRI',
                'comment' => $row->COLUMN_COMMENT,
                'not_null' => $row->IS_NULLABLE === 'NO'
            ];
        }
        return $result;
    }
}
