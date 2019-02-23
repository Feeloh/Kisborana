<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
    class Member_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }
        function uploadData()
        {
            $file_csv = $this->input->post('userfile');
            $config['upload_path']='./assets/uploads/';
            $config['allowed_types'] = 'csv';
            $config['file_name'] = $_FILES["userfile"]['name'];
            $this->load->library('upload', $config);
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
                    $insert_csv['name'] = $csv_line[0];
                    $insert_csv['email'] = $csv_line[1];
                    $insert_csv['phone'] = $csv_line[2];
                    $insert_csv['status'] = $csv_line[3];
                }
                $i++;
                $data = array(
                    'id' => $insert_csv['id'] ,
                    'name' => $insert_csv['name'],
                    'email' => $insert_csv['email'],
                    'phone' => $insert_csv['phone'],
                    'status' => $insert_csv['status'],);
                $data['crane_features']=$this->db->insert('members', $data);
            }
            fclose($fp) or die("can't close file");
            $data['success']="success";
            return $data;
        }
    }