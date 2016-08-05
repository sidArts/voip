<?php 

class My_Model extends CI_Model {

	protected $_table;
	public $before_create = array();
	public function __construct() {
        parent::__construct();
        $this->load->helper("inflector");
        if(!$this->_table){
            $this->_table = strtolower(plural(str_replace("_model", "", get_class($this))));
        }
	}

	function count_records() {
		return $this->db->count_all($this->_table);
	}

	public function get() {
        $args = func_get_args();
        if(isset($args[0])) {
        	if(count($args) > 1 || is_array($args[0])) {
                $this->db->where($args[0]);
	        } else {
                $this->db->where("id", $args[0]);
	        }
        }        
        return $this->db->get($this->_table)->row();
	}

	public function get_all() {
		$args = func_get_args();
		if(isset($args[0])) {
			if(count($args) > 1 || is_array($args[0])) {
				$this->db->where($args[0]);
			} else {
				$this->db->where("id", $args[0]);
			}
		}
		return $this->db->get($this->_table)->result();
	}

	public function by() {
	    $args = func_get_args();
        if(is_array($args[0]) || count($args[0]) > 1) {
            $this->db->where($args[0]);
        } else {
            $this->db->where($args[0], $args[1]);
        }
		return $this;
	}

	public function insert($data) {
		$data["created_at"] = $data["updated_at"] = date("Y-m-d H:i:s");
		$success = $this->db->insert($this->_table, $data);
		if($success) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function update() {
		$args = func_get_args();
		$args[1]["updated_at"] = date("Y-m-d H:i:s");
		if(is_array($args[0])) {
			$this->db->where($args[0]);
		} else {
			$this->db->where("id", $args[0]);
		}
		return $this->db->update($this->_table, $args[1]);
	}

	public function delete() {
		$args = func_get_args();
		if(count($args) > 1 || is_array($args[0])) {
			$this->db->where($args[0]);
		} else {
			$this->db->where("id", $args[0]);
		}
		return $this->db->delete($this->_table);		
	}

}

?>