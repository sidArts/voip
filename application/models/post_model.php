<?php

class Post_model extends My_Model {
    public function getWithUserId($id) {
        $this->db->select();
        $this->db->select('m.username, m.name');
        $this->db->from('posts as p');
        $this->db->join("members as m", "p.user_id=m.id");
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}