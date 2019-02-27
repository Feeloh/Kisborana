<?php
class loans_model extends CI_Model
{
    //getting member name
    public function get_member_details(){
        $query = $this->db->get('member');
        return $query;

    }

    //getting loan_type_details
    public function get_loan_type_details(){
       $query = $this->db->get('loan_type');
        return $query;
       //var_dump($query->result());die();

    }

    //getting single loan_type_details
    public function get_single_loan_type_details($loan_type_id){
        $this->db->where("loan_type_id", $loan_type_id);
        $query = $this->db->get('loan_type');
        return ($query);
 
     }
    public function add_loan()
    {           
        $data = array(
            "loan_name" => $this->input->post("loan_name"),
            "maximum_loan_amount" => $this->input->post("maximum_loan_amount"),
            "minimum_loan_amount" => $this->input->post("minimum_loan_amount"),
            "custom_loan_amount" => $this->input->post("custom_loan_amount"),
            "maximum_number_of_installments" => $this->input->post("maximum_number_of_installments"),            
            "minimum_number_of_installments" => $this->input->post("minimum_number_of_installments"),            
            "custom_number_of_installments" => $this->input->post("custom_number_of_installments"),            
            "maximum_number_of_guarantors" => $this->input->post("maximum_number_of_guarantors"),            
            "minimum_number_of_guarantors" => $this->input->post("minimum_number_of_guarantors"),            
            "custom_number_of_guarantors" => $this->input->post("custom_number_of_guarantors"),            
            "interest_rate" => $this->input->post("interest_rate"),
        );
               
        if ($this->db->insert("loan", $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function get_single_loan($loan_id)
    {
        $this->db->where("loan_id", $loan_id);
        return $this->db->get("loan");
    }
    
    public function get_update_loan($loan_id)
    {
            $data = array(
            "loan_name" => $this->input->post("loan_name"),
            "maximum_loan_amount" => $this->input->post("maximum_loan_amount"),
            "minimum_loan_amount" => $this->input->post("minimum_loan_amount"),
            "custom_loan_amount" => $this->input->post("custom_loan_amount"),
            "maximum_number_of_installments" => $this->input->post("maximum_number_of_installments"),            
            "minimum_number_of_installments" => $this->input->post("minimum_number_of_installments"),            
            "custom_number_of_installments" => $this->input->post("custom_number_of_installments"),            
            "maximum_number_of_guarantors" => $this->input->post("maximum_number_of_guarantors"),            
            "minimum_number_of_guarantors" => $this->input->post("minimum_number_of_guarantors"),            
            "custom_number_of_guarantors" => $this->input->post("custom_number_of_guarantors"),            
            "interest_rate" => $this->input->post("interest_rate"),
        );
        
        $this->db->where("loan_id",$loan_id);        
        $this->db->set($data);
        $this->db->update('loan');
        return $this->db->get("loan");
    }

    public function get_delete_loan($loan_id)
    {
        $this->db->where("loan_id",$loan_id);        
        $this->db->set('deleted','1');
        $this->db->update('loan');
        return $this->db->get("loan");
    }

    public function get_deactivate_loan($loan_id)
    {
        $this->db->where("loan_id",$loan_id);        
        $this->db->set('loan_status','0');
        $this->db->update('loan');
        return $this->db->get("loan");
    }

    public function get_activate_loan($loan_id)
    {
        $this->db->where("loan_id",$loan_id);        
        $this->db->set('loan_status','1');
        $this->db->update('loan');
        return $this->db->get("loan");
    }

    // pagination functions
    public function get_total()
    {
        return $this->db->count_all("loan");
    }

    public function get_loan($limit, $start) 
    {   
        $where = "deleted = 0";
        $this->db->where($where);
        $this->db->limit($limit, $start);
        $query = $this->db->get("loan");
         return  $query;
           
    }
    // Search function
    public function get_results($search_term='default')
    {
        // Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->from('loan');
        $this->db->like('loan_name',$search_term);
        $this->db->or_like('loan_hobby', $search_term);

        // Execute the query.
        $query = $this->db->get();

        // Return the results.
        return $query->result_array();
    }
}
