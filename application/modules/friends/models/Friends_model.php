<?php
class Friends_model extends CI_Model
{
    public function add_friend()
    {           
        $picture = $this->input->post('userfile');
        $config['upload_path']='./uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES["userfile"]['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('userfile');
        $data = $this->upload->data();
        $image=$data[file_name];
        
        //end of file upload code
        $data = array(
            "friend_name" => $this->input->post("first_name"),
            "friend_age" => $this->input->post("age"),
            "friend_gender" => $this->input->post("gender"),
            "friend_hobby" => $this->input->post("hobby"),
            "friend_picture" => $image,
        );
               
        if ($this->db->insert("friend", $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function get_single_friend($friend_id)
    {
        $this->db->where("friend_id", $friend_id);
        return $this->db->get("friend");
    }
    
    public function get_update_friend($friend_id)
    {
        $picture = $this->input->post('userfile');
        $config['upload_path']='./uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES["userfile"]['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('userfile');
        $data = $this->upload->data();
        $image=$data[file_name];

        $data = array(
            "friend_name" => $this->input->post("first_name"),
            "friend_age" => $this->input->post("age"),
            "friend_gender" => $this->input->post("gender"),
            "friend_hobby" => $this->input->post("hobby"),
            "friend_picture" => $image,
        );
        
        $this->db->where("friend_id",$friend_id);        
        $this->db->set($data);
        $this->db->update('friend');
        return $this->db->get("friend");
    }

    public function get_delete_friend($friend_id)
    {
        $this->db->where("friend_id",$friend_id);        
        $this->db->set('deleted','1');
        $this->db->update('friend');
        return $this->db->get("friend");
    }

    public function get_deactivate_friend($friend_id)
    {
        $this->db->where("friend_id",$friend_id);        
        $this->db->set('friend_status','0');
        $this->db->update('friend');
        return $this->db->get("friend");
    }

    public function get_activate_friend($friend_id)
    {
        $this->db->where("friend_id",$friend_id);        
        $this->db->set('friend_status','1');
        $this->db->update('friend');
        return $this->db->get("friend");
    }

    // pagination functions
    public function get_total()
    {
        return $this->db->count_all("friend");
    }

    public function get_friend($limit, $start) 
    {   
        $where = "deleted = 0";
        $this->db->where($where);
        $this->db->limit($limit, $start);
        $query = $this->db->get("friend");
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
    // Search function
    public function get_results($search_term='default')
    {
        // Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->from('friend');
        $this->db->like('friend_name',$search_term);
        $this->db->or_like('friend_hobby', $search_term);

        // Execute the query.
        $query = $this->db->get();

        // Return the results.
        return $query->result_array();
    }
}
