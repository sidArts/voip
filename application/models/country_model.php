<?php
class Country_model extends  MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->_table = "country";
    }

    /*public function get_all() {
        $this->db->order_by("id");
        $query = $this->db->get("country");
        return $query->result_array();
    }*/
}