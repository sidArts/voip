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
    public function compare($id) {
        $post = $this->get($id);
        $ub = $post->rate + ($post->rate * 0.05);
        $lb = $post->rate - ($post->rate * 0.05);
        $where['rate >'] = $lb;
        $where['rate <'] = $ub;
        $where['country'] = $post->country;
        $where['created_at >'] = date("Y-m-d", strtotime("-10 day"));
        $where['post_type'] = ($post->post_type == 'PUSH') ? 'TARGET' : 'PUSH';
        return $this->get_all($where);
    }
}