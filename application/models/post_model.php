<?php

class Post_model extends My_Model {
    public function getWithUserId($id) {
        $this->db->select('p.id as post_id, p.user_id,p.post_type,p.quality_level,p.rate,p.description,p.asr,p.acd,p.country,p.created_at,p.updated_at,p.views,p.status,m.name,m.email,m.show_contact_info');
        $this->db->from('posts as p');
        $this->db->join("members as m", "p.user_id=m.id");
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function getAllWithUser($date) {
        $this->db->select('p.id as post_id, p.user_id,p.post_type,p.quality_level,p.rate,p.description,p.asr,p.acd,p.country,p.created_at,p.updated_at,p.views,p.status,m.name,m.email,m.show_contact_info');
        $this->db->from('posts as p');
        $this->db->join("members as m", "p.user_id=m.id");
        $this->db->where('p.created_at >',$date);
        $query = $this->db->get();
        return $query->result();
    }
    public function compare($id) {
        $post = $this->get($id);
        $ub = $post->rate + ($post->rate * 0.05);
        $lb = $post->rate - ($post->rate * 0.05);
        $where['rate >'] = $lb;
        $where['rate <'] = $ub;
        $where['country'] = $post->country;
        $where['created_at >'] = date("Y-m-d", strtotime("-10 day"));
        $where['post_type'] = ($post->post_type == 'PUSH') ? 'TARGET' : 'PUSH';
        $where['quality_level'] = $post->quality_level;
        return $this->get_all($where);
    }
}