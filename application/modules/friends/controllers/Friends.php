<?php
class Friends extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("site/site_model");
        $this->load->model("friends_model");

        // load pagination library
        $this->load->library('pagination');

        // load form (multipart) and URL helper
        $this->load->helper(array('url', 'form','html'));

        // load upload library
        $this->load->library('upload');
    }
    public function index()
    {
        // Pagination

        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->friends_model->get_total();
        $config = array();
        $limit_per_page = 2;

        // get current page records
        $config['base_url'] = base_url() . 'friends/index';
        $config['total_rows'] = $total_records;
        $config['per_page'] = 2;
        $config["uri_segment"] = 3;
        $config['num_links'] = 1;

        $this->pagination->initialize($config);

        // build paging links
        $params = array('links' => $this->pagination->create_links(),
            'all_friends' => $this->friends_model->get_friend($limit_per_page, $start_index),
            'page' => $start_index);

        $data = array("title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("friends/all_friends", $params, true));
        $this->load->view("site/layouts/layout", $data);
    }

    public function execute_search()
    {
        // Retrieve the posted search term.
        $search_term = $this->input->post('search');

        // Use a model to retrieve the results.
        $data['results'] = $this->friends_model->get_results($search_term);

        // Pass the results to the view.

        $data = array("title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("friends/search_results", $data, true));
        $this->load->view("site/layouts/layout", $data);

    }

    public function welcome($friend_id)
    {

        $my_friend = $this->friends_model->get_single_friend($friend_id);

        if ($my_friend->num_rows() > 0) {
            $row = $my_friend->row();
            $friend = $row->friend_name;
            $age = $row->friend_age;
            $gender = $row->friend_gender;
            $hobby = $row->friend_hobby;
            $data = array(
                "friend_name" => $friend,
                "friend_age" => $age,
                "friend_gender" => $gender,
                "friend_hobby" => $hobby,

            );
            // $this->load->view("welcome_here", $data);

            $view = array("title" => $this->site_model->display_page_title(),
                "content" => $this->load->view("welcome_here", $data, true));
            $this->load->view("site/layouts/layout", $view);
        } else {

            $this->session->set_flash_data("error_message", "could not find you friend");
            redirect('friends');
        }

    }

    public function new_friend()
    {
        //form validation
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("age", "Age", "required|numeric");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("hobby", "Hobby", "required");

        if ($this->form_validation->run()) {
            $friend_id = $this->friends_model->add_friend();
            if ($friend_id > 0) {
                $this->session->set_flashdata("success_message", "new friend has been added");
                redirect("friends");
            } else {
                $this->session->set_flashdata("error_message", "unable to add friend");
            }
        }
        $data["form_error"] = validation_errors();
        // $this->load->view("add_friend", $data);

        $v_data["add_friend"] = "friends/Friends_model";
        $data = array("title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("friends/add_friend", $v_data, true),

        );
        $this->load->view("site/layouts/layout", $data);

    }

    public function delete($friend_id)
    {
        $my_friend = $this->friends_model->get_delete_friend($friend_id);
        if($my_friend > 0){
            $this->session->set_flashdata("success_message", "friend deleted");
            redirect("friends");
        }
        else{
            $this->session->set_flashdata("error_message", "unable to delete");
            redirect("friends");
        }
    }

    public function deactivate($friend_id)
    {
        $my_friend = $this->friends_model->get_deactivate_friend($friend_id);
        if($my_friend > 0){
            $this->session->set_flashdata("success_message", "friend deactivated successfully");
            redirect("friends");
        }
        else{
            $this->session->set_flashdata("error_message", "unable to deactivate friend");
            redirect("friends");
        }
    }

    public function activate($friend_id)
    {
        $my_friend = $this->friends_model->get_activate_friend($friend_id);
        if($my_friend > 0){
            $this->session->set_flashdata("success_message", "friend activated successfully");
            redirect("friends");
        }
        else{
            $this->session->set_flashdata("error_message", "unable to activate friend");
            redirect("friends");
        }
    }

    public function edit($friend_id)
    {
        $my_friend = $this->friends_model->get_single_friend($friend_id);

        if ($my_friend->num_rows() > 0) {
            $row = $my_friend->row();
            $id = $row->friend_id;
            $friend = $row->friend_name;
            $age = $row->friend_age;
            $gender = $row->friend_gender;
            $image = $row->friend_picture;
            $hobby = $row->friend_hobby;
            $data = array(
                "friend_name" => $friend,
                "friend_age" => $age,
                "friend_gender" => $gender,
                "friend_picture" => $image,
                "friend_hobby" => $hobby,
                "friend_id" => $id,
            );

            $view = array("title" => $this->site_model->display_page_title(),
                "content" => $this->load->view("edit_friend", $data, true));
            $this->load->view("site/layouts/layout", $view);

        }
    }

    public function edit_friend($friend_id)
    {
        //form validation
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("age", "Age", "required|numeric");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("hobby", "Hobby", "required");

        if ($this->form_validation->run()) {
            $pal_id = $this->friends_model->get_update_friend($friend_id);
            if ($pal_id > 0) {
                $this->session->set_flashdata("success_message", "Your friend" . $friend_id . "has been edited");
                redirect("friends");
            } else {
                $this->session->set_flashdata("error_message", "unable to edit friend");
            }
        }
    }
}
