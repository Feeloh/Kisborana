<?php
if ( ! defined ('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model
{
    public function get_bank_details(){
       $query = $this->db->get('bank');
       return $query;
    }
    public function get_employer_details(){
        $query = $this->db->get('employer');
        return $query;
    }
    public function save_members(){
        $data = array(
            "bank_id" => $this->input->post("bank_name"),
            "member_national_id" => $this->input->post("member_national_id"),
            "member_first_name" => $this->input->post("firstname"),
            "member_last_name" => $this->input->post("lastname"),
            "employer_id" => $this->input->post("employer_name"),
            "member_phone_number" => $this->input->post("phone_number"),
            "member_account_number" => $this->input->post("account_number"),
            "member_email" => $this->input->post("email"),
            "member_postal_address" => $this->input->post("postal_address"),
            "member_postal_code" => $this->input->post("postal_code"),
            "member_location" => $this->input->post("location"),
            "member_number" => $this->input->post("member_number"),
            "member_payroll_number" => $this->input->post("member_payroll_number"),
            "created_by" => 1,
            "created_on" => date('Y-m-d H:i:s'),
        );
        //var_dump($data);die();
        $query = $this->db->insert("member", $data);
        return $query;
    }
    public function get_members(){
        // $this->db->select('employer_name');
        // $this->db->from('employer');
        // $this->db->join('member', 'member.employer_id = employer.employer_id');
        //$query = $this->db->get();
        $this->db->where("deleted", 0);
        $query = $this->db->get('member');
        return $query;
    }
    public function deactivate($member_id){
        $this->db->where("member_id", $member_id);
        $this->db->set("member_status", 0);
        $query = $this->db->update("member");
        return $query;
       
    }
    public function activate($member_id){
        $this->db->where("member_id", $member_id);
        $this->db->set("member_status",1);
        $query = $this->db->update("member");
        return $query;
       
    }
    public function delete($member_id){
        $this->db->where("member_id", $member_id);
        $data = array(
            "deleted"=>1,
            "deleted_by" => 1,
            "deleted_on" => date('Y-m-d H:i:s')
        );
        $this->db->set($data);
        $query = $this->db->update("member");
        return $query;
    }
    public function update_member($member_id){
        $data = array(
            "bank_id" => $this->input->post("bank_name"),
            "member_national_id" => $this->input->post("member_national_id"),
            "member_first_name" => $this->input->post("firstname"),
            "member_last_name" => $this->input->post("lastname"),
            "employer_id" => $this->input->post("employer_name"),
            "member_phone_number" => $this->input->post("phone_number"),
            "member_bank_account_number" => $this->input->post("account_number"),
            "member_email" => $this->input->post("email"),
            "member_postal_address" => $this->input->post("postal_address"),
            "member_postal_code" => $this->input->post("postal_code"),
            "member_location" => $this->input->post("location"),
            "member_number" => $this->input->post("member_number"),
            "member_payroll_number" => $this->input->post("member_payroll_number"),
            "modified_by" => 1,
            "modified_on" => date('Y-m-d H:i:s'),
        );
        $this->db->where("member_id",$member_id);
        if ($this->db->update("member", $data)) {
            $this->session->set_flashdata("success","successfuly updated");
            return true;
        } else {
            $this->session->set_flashdata("error","failed to update");

            return false;
        }
    }

    //'SELECT * FROM member JOIN bank ON member.bank_id=bank.bank_id WHERE member.member_id='.$member_id
    public function get_single_member($member_id){
        // 'SELECT * FROM member JOIN bank ON member.bank_id = BANK.BANK_ID where member.member_id='. $member_id;
        $this->db->select('member.*, bank_name, employer_name');
        $this->db->from('member');
        $this->db->join('bank', 'member.bank_id = bank.bank_id');
        $this->db->join('employer', 'member.employer_id = employer.employer_id');
        $this->db->where('member.member_id = '. $member_id);
        $query = $this->db->get();
        return $query;
    }
    public function importdata($data) {
 
        $res = $this->db->insert_batch('member',$data);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
 
    }
    public function save_csv_import(){
        $file_csv = $this->input->post('userfile');

            $config['upload_path']='./assets/uploads/';
            $config['allowed_types'] = 'csv';
            $config['file_name'] = $_FILES["userfile"]['name'];
            $filename = $config['file_name'];
            var_dump($filename);die();
            
            $this->load->library('upload', $config);
            // $this->load->library('csvimport');
            $this->upload->initialize($config);
            $this->upload->do_upload('userfile');
            $data = $this->upload->data();

            $count=0;
            $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
            while($csv_line = fgetcsv($fp,1024))
            {
                $count++;
                if($count == 1)
                {
                    continue;
                }//keep this if condition if you want to remove the first row
                for($i = 0, $j = count($csv_line); $i < $j; $i++)
                {
                    $insert_csv = array();
                    $insert_csv['member_national_id'] = $csv_line[0];
                    $insert_csv['member_first_name'] = $csv_line[1];
                    $insert_csv['member_last_name'] = $csv_line[2];
                    $insert_csv['employer_id'] = $csv_line[3];
                    $insert_csv['member_email'] = $csv_line[4];
                    $insert_csv['member_phone_number'] = $csv_line[5];
                    $insert_csv['member_bank_account_number'] = $csv_line[6];
                    $insert_csv['member_postal_address'] = $csv_line[7];
                    $insert_csv['member_postal_code'] = $csv_line[8];
                    $insert_csv['member_location'] = $csv_line[9];
                    $insert_csv['member_number'] = $csv_line[10];
                    $insert_csv['member_payroll_number'] = $csv_line[11];
                    $insert_csv['member_status'] = $csv_line[12];
                    $insert_csv['created_by'] = $csv_line[13];
                }
                $i++;
                $data = array(
                    'member_national_id' => $insert_csv['member_national_id'],
                    'member_first_name' => $insert_csv['member_first_name'],
                    'member_last_name' => $insert_csv['member_last_name'],
                    'employer_id' => $insert_csv['employer_id'],
                    'member_email' => $insert_csv['member_email'],
                    'member_phone_number' => $insert_csv['member_phone_number'],
                    'member_bank_account_number' => $insert_csv['member_bank_account_number'],
                    'member_postal_address' => $insert_csv['member_postal_address'],
                    'member_postal_code' => $insert_csv['member_postal_code'],
                    'member_location' => $insert_csv['member_location'],
                    'member_number' => $insert_csv['member_number'],
                    'member_payroll_number' => $insert_csv['member_payroll_number'],
                    'member_status' => $insert_csv['member_status'],
                    'created_by' => $insert_csv['lcreated_by'],
                );
                $data['crane_features']=$this->db->insert('member', $data);
            }
            fclose($fp) or die("can't close file");
            $data['success']="success";
            return $data;
    }
}
?>