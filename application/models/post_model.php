<?php

class Post_model extends My_Model {
    public function getWithUserId($id) {
        $this->db->select('p.id as post_id, p.user_id,p.post_type,p.quality_level,p.rate,p.description,p.asr,p.acd,p.country,p.created_at,p.updated_at,p.views,p.status,m.name,m.email,m.email_visible,m.phone_visible');
        $this->db->from('posts as p');
        $this->db->join("members as m", "p.user_id=m.id");
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function getAllWithUser() {
        $date = date("Y-m-d", strtotime("-".$this->getPostDays()." day"));
        $this->db->select('p.id as post_id, p.user_id,p.post_type,p.quality_level,p.rate,p.description,p.asr,p.acd,p.country,p.created_at,p.updated_at,p.views,p.status,m.name,m.email,m.email_visible,m.phone_visible');
        $this->db->from('posts as p');
        $this->db->join("members as m", "p.user_id=m.id");
        $this->db->where('p.created_at >',$date);
        if(!empty(func_get_args()[0]) && is_array(func_get_args()[0])) :
            foreach (func_get_args()[0] as $key => $value):
                $this->db->where($key,$value);
            endforeach;
        endif;
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
    public function getPostDays() {
        return $this->db->query('SELECT count FROM `post_days`')->row()->count;
    }
    public function updatePostDays($days) {
        return $this->db->query("UPDATE `post_days` SET `count`=$days WHERE id=1");
    }
}