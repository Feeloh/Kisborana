<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Members extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
    }
    function index()
    {
        $data = '';
        $this->load->view('add_member',$data);
    }
    function uploadData()
    {
        $this->member_model->uploadData();
        redirect('members');
    }
}
?>