<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Member extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        //load required model
        $this->load->model("auth/auth_model");
        $this->load->model("site/site_model");
        $this->load->model("member/member_model");
    }

    // A function that displays all members
    public function index()
    {
        $v_data["all_members"] = $this->member_model->get_members();

        $data = array("title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("member/all_members", $v_data, true),

        );
        $this->load->view("site/layouts/layout", $data);
    }

    // A function that adds a new member
    public function new_member()
    {

        $this->form_validation->set_rules("member_national_id", "National id", "required");
        $this->form_validation->set_rules("firstname", "First Name", "required");
        $this->form_validation->set_rules("lastname", "Last Name", "required");
        $this->form_validation->set_rules("bank_name", "Select Bank", "required");
        $this->form_validation->set_rules("employer_name", "Select Employer", "required");
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("phone_number", "Phone number", "required");
        $this->form_validation->set_rules("account_number", "Account number", "required");
        $this->form_validation->set_rules("postal_address", "Postal address", "required");
        $this->form_validation->set_rules("postal_code", "Postal code", "required");
        $this->form_validation->set_rules("member_number", "Member number", "required");
        $this->form_validation->set_rules("member_payroll_number", "Member Payroll number", "required");
        $this->form_validation->set_rules("location", "Location", "required");

        $bank_details = $this->member_model->get_bank_details();
        $employer_details = $this->member_model->get_employer_details();
        if ($this->form_validation->run()) {
            $saved_members = $this->member_model->save_members();
            if ($saved_members) {
                //    echo "save member";
                $this->session->set_flashdata("success", "Successfully saved");

            } else {
                $this->session->set_flashdata("error", "Error when saving");
            }
            redirect("member");
        }
        $v_data = array(
            "add_member" => "member/Member_model",
            "bank_details" => $bank_details,
            "employer_details" => $employer_details,
        );
        $data = array("title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("member/add_member", $v_data, true),
        );
        //var_dump($data);die();
        $this->load->view("site/layouts/layout", $data);
    }

    // A function that activates a member
    public function activate($member_id)
    {
        if ($this->member_model->activate($member_id)) {
            $this->session->set_flashdata("success", "Successfully activated");
        } else {
            $this->session->set_flashdata("error", "Cannot be activated");
        }
        redirect('member');
    }

    // A function that deactivates a member
    public function deactivate($member_id)
    {
        if ($this->member_model->deactivate($member_id)) {
            $this->session->set_flashdata("success", "Successfully deactivated");
        } else {
            $this->session->set_flashdata("error", "Cannot be deactivated");
        }
        redirect('member');
    }

    // A function that deletes a member
    public function delete_member($member_id)
    {
        if ($this->member_model->delete($member_id)) {
            $this->session->set_flashdata("success", "Successfully deleted");
        } else {
            $this->session->set_flashdata("error", "Cannot be deleted");
        }
        redirect('member');
    }
    public function display_edit_form($member_id)
    {

        $this->form_validation->set_rules("member_national_id", "National id", "required");
        $this->form_validation->set_rules("firstname", "First Name", "required");
        $this->form_validation->set_rules("lastname", "Last Name", "required");
        $this->form_validation->set_rules("bank_name", "Select Bank", "required");
        $this->form_validation->set_rules("employer_name", "Select Employer", "required");
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("phone_number", "Phone number", "required");
        $this->form_validation->set_rules("account_number", "Account number", "required");
        $this->form_validation->set_rules("postal_address", "Postal address", "required");
        $this->form_validation->set_rules("postal_code", "Postal code", "required");
        $this->form_validation->set_rules("member_number", "Member number", "required");
        $this->form_validation->set_rules("member_payroll_number", "Member Payroll number", "required");
        $this->form_validation->set_rules("location", "Location", "required");

        //if the edit form is submitted do this
        if ($this->form_validation->run()) {
            $member_id = $this->member_model->update_member($member_id);
            redirect("member");
        } else {
            $validation_errors = validation_errors();
            if (!empty($validation_errors)) {
                $this->session->set_flashdata("error", $validation_errors);
            }
        }

        //1. get data for the member with the passed member_id from the model

        $single_member_data = $this->member_model->get_single_member($member_id);
        if ($single_member_data->num_rows() > 0) {
            $row = $single_member_data->row();
            $member_id = $row->member_id;
            $first_name = $row->member_first_name;
            $last_name = $row->member_last_name;
            $national_id = $row->member_national_id;
            $email = $row->member_email;
            $location = $row->member_location;
            $postal_address = $row->member_postal_address;
            $postal_code = $row->member_postal_code;
            $member_number = $row->member_number;
            $member_payroll_number = $row->member_payroll_number;
            $employer_id = $row->employer_id;
            $employer_name = $row->employer_name;
            $bank_id = $row->bank_id;
            $bank_name = $row->bank_name;
            $phone_number = $row->member_phone_number;
            $bank_account_number = $row->member_bank_account_number;
        }
        $v_data = array(
            "member_id " => $member_id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "national_id" => $national_id,
            "email" => $email,
            "location" => $location,
            "postal_address" => $postal_address,
            "postal_code" => $postal_code,
            "member_number" => $member_number,
            "member_payroll_number" => $member_payroll_number,
            "employer_name" => $employer_name,
            "phone_number" => $phone_number,
            "bank_account_number" => $bank_account_number,
            "bank_id" => $bank_name,

        );
        // var_dump($v_data);die();
        //2. Load view with the data from step 1
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("member/edit_member", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
    }
    // public function import_members()
    // {

    //     $this->load->library('excel');

    //     if ($this->form_validation->run()) {
    //         $path = './uploads/';
    //         require_once APPPATH . "/third_party/PHPExcel.php";
    //         $config['upload_path'] = $path;
    //         $config['allowed_types'] = 'xlsx|xls';
    //         $config['remove_spaces'] = TRUE;
    //         $this->load->library('upload', $config);
    //         $this->upload->initialize($config);            
    //         if (!$this->upload->do_upload('uploadFile')) {
    //             $error = array('error' => $this->upload->display_errors());
    //         } else {
    //             $data = array('upload_data' => $this->upload->data());
    //         }
    //         if(empty($error)){
    //           if (!empty($data['upload_data']['file_name'])) {
    //             $import_xls_file = $data['upload_data']['file_name'];
    //         } else {
    //             $import_xls_file = 0;
    //         }
    //         $inputFileName = $path . $import_xls_file;
            
    //         try {   
    //             $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    //             $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    //             $objPHPExcel = $objReader->load($inputFileName);
    //             $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    //             $flag = true;
    //             $i=0;
    //             foreach ($allDataInSheet as $value) {
    //               if($flag){
    //                 $flag =false;
    //                 continue;
    //               }
    //               $inserdata[$i]['member_national_id'] = $value['member_national_id'];
    //               $inserdata[$i]['member_first_name'] = $value['member_first_name'];
    //               $inserdata[$i]['member_last_name'] = $value['member_last_name'];
    //               $inserdata[$i]['employer_id'] = $value['employer_id'];
    //               $inserdata[$i]['member_email'] = $value['member_email'];
    //               $inserdata[$i]['member_phone_number'] = $value['member_phone_number'];
    //               $inserdata[$i]['member_bank_account_number'] = $value['member_bank_account_number'];
    //               $inserdata[$i]['member_postal_address'] = $value['member_postal_address'];
    //               $inserdata[$i]['member_postal_code'] = $value['member_postal_code'];
    //               $inserdata[$i]['member_location'] = $value['member_location'];
    //               $inserdata[$i]['member_number'] = $value['member_number'];
    //               $inserdata[$i]['member_payroll_number'] = $value['member_payroll_number'];
    //               $inserdata[$i]['member_status'] = $value['member_status'];
    //               $inserdata[$i]['created_by'] = $value['created_by'];
    //               $i++;
    //             }               
    //             $result = $this->member_model->importdata($inserdata);   
    //             if($result){
    //               echo "Imported successfully";
    //             }else{
    //               echo "ERROR !";
    //             }             
 
    //         } 
    //         catch (Exception $e) {
    //            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
    //                     . '": ' .$e->getMessage());
    //         }
    //       }
    //       else{
    //           echo $error['error'];
    //         }
    //         $this->load->view('member/all_members', $data);
    //     }
        
    //     // // start displaying the upload excel form
    //     // $v_data = array(
    //     //     "add_member" => "member/Member_model",
    //     // );
    //     // $data = array(
    //     //     "title" => $this->site_model->display_page_title(),
    //     //     "content" => $this->load->view("member/import_member", $v_data, true),
    //     // );
    //     // //end of displaying the upload excel form

    //     // $this->load->view("site/layouts/layout", $data);
    // }
    public  function import_csv_members(){
        $file = $this->input->post("userfile");
        // var_dump($file);die();
        $this->form_validation->set_rules("userfile","Select file", "required");

        if($this->form_validation->run()){
            // var_dump("waat");die();
            $this->member_model->save_csv_import();
            // redirect("member/all_members");
        }
        // start displaying the upload excel form
        $v_data = array(
            "add_member" => "member/Member_model",
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("member/import_member", $v_data, true),
        );
        //end of displaying the upload excel form

        $this->load->view("site/layouts/layout", $data);
        
        
    }
}
