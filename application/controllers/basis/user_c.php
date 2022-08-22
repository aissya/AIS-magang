<?php

class user_c extends CI_Controller {

    private $layout = '/template/head';
    private $back_to_manage = 'basis/user_c/index/';

    public function __construct() {
        parent::__construct();
        $this->load->model('organization/company_m');
        $this->load->model('organization/division_m');
        $this->load->model('organization/groupdept_m');
        $this->load->model('organization/dept_m');
        $this->load->model('organization/section_m');
        $this->load->model('organization/subsection_m');
        $this->load->model('basis/user_m');
        $this->load->model('basis/role_module_m');
        $this->load->model('basis/role_m');
        $this->load->model('basis/log_m');
    }

    //show all data
    function index($msg = NULL) {
        $this->role_module_m->authorization('14');
        if ($msg == 1) {
            $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Creating success </strong> The data is successfully created </div >";
        } elseif ($msg == 2) {
            $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Updating success </strong> The data is successfully updated </div >";
        } elseif ($msg == 3) {
            $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Deleted success </strong> The data is successfully deleted </div >";
        } elseif ($msg == 12) {
            $msg = "<div class = 'alert alert-danger'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Executing error !</strong> Something error with parameter </div >";
        }
        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(14);

        $data['title'] = 'Manage User';
        $data['msg'] = $msg;
        $data['data'] = $this->user_m->get_user();
        $data['content'] = 'basis/user/manage_user_v';
        $this->load->view($this->layout, $data);
    }

    //view by id
    function select_by_id_user($id) {
        $this->role_module_m->authorization('14');

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(14);

        $data['data'] = $this->user_m->get_data($id)->row();
        $data['content'] = 'basis/user/view_user_v';
        $data['title'] = 'View User';
        $this->load->view($this->layout, $data);
    }

    //prepare to create
    function create_user() {
        $this->role_module_m->authorization('14');

        $data['data_section'] = $this->section_m->get_section();
        $data['data_dept'] = $this->dept_m->get_dept();
        $data['data_groupdept'] = $this->groupdept_m->get_groupdept();
        $data['data_div'] = $this->division_m->get_division();
        $data['data_company'] = $this->company_m->get_company();
        $data['data_subsection'] = $this->subsection_m->get_subsection();

        $data['data_role'] = $this->role_m->select_role();

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(14);

        $data['title'] = 'Create User';
        $data['content'] = 'basis/user/create_user_v';

        $this->load->view($this->layout, $data);
    }

    //saving data
    function save_user() {
        $this->form_validation->set_rules('CHR_NPK', 'NPK', 'required|min_length[6]|max_length[6]|callback_check_npk|trim');
        $this->form_validation->set_rules('CHR_USERNAME', 'Username', 'required|callback_check_username|trim');
        $this->form_validation->set_rules('CHR_PASS', 'Password', 'required|min_length[7]|trim');
        $this->form_validation->set_rules('CHR_PASS_CONFIRM', 'Password Confirm', 'required|matches[CHR_PASS]|callback_password_check');
        $code_pass = trim(md5($this->input->post('CHR_PASS') . date("Ymd")));

        $session = $this->session->all_userdata();

        if ($this->form_validation->run() == FALSE) {
            $this->create_user();
        } else {
            $data = array(
                'CHR_NPK' => $this->input->post('CHR_NPK'),
                'CHR_USERNAME' => $this->input->post('CHR_USERNAME'),
                'CHR_PASS' => $code_pass,
                'INT_ID_ROLE' => $this->input->post('INT_ID_ROLE'),
                'INT_ID_COMPANY' => $this->input->post('INT_ID_COMPANY'),
                'INT_ID_DIVISION' => $this->input->post('INT_ID_DIVISION'),
                'INT_ID_GROUP_DEPT' => $this->input->post('INT_ID_GROUP_DEPT'),
                'INT_ID_DEPT' => $this->input->post('INT_ID_DEPT'),
                'INT_ID_SECTION' => $this->input->post('INT_ID_SECTION'),
                'INT_ID_SUB_SECTION' => $this->input->post('INT_ID_SUB_SECTION'),
                'CHR_REGIS_DATE' => date("Ymd"),
                'CHR_EXP_DATE' => date("Ymd"),
                'BIT_STATUS' => 0,
                'CHR_CREATE_BY' => $session['USERNAME'],
                'CHR_CREATE_DATE' => date("Ymd"),
                'CHR_CREATE_TIME' => date("His"),
                'BIT_FLG_ACTIVE' => 0,
                'BIT_FLG_DEL' => 0
            );
            $this->user_m->save($data);
            $this->log_m->add_log('54', $this->input->post('CHR_NPK'));
            redirect($this->back_to_manage . $msg = 1);
        }
    }

    //cek kesamaan username
    function check_username($username) {
        $return_value = $this->user_m->check_username($username);
        if ($return_value) {
            $this->form_validation->set_message('check_username', 'Sorry, This username is already used by another user please select another one');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //cek kesamaan username
    function check_npk($npk) {
        $return_value = $this->user_m->check_npk($npk);
        if ($return_value) {
            $this->form_validation->set_message('check_npk', 'Sorry, This npk is already used by another user please select another one');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function password_check($str) {
        if (!preg_match('/[A-Z]/', $str)) {
            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one uppercase character');
            return false;
        } if (!preg_match('/[a-z]/', $str)) {
            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one lowercase character');
            return false;
        } if (!preg_match('/[0-9]/', $str)) {
            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one number');
            return false;
        } if (!preg_match('/[!._@#$%`~*&^%$(){}?]/', $str)) {
            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one special character');
            return false;
        } else {
            return true;
        }
    }

    //prepare to editing
    function edit_user($id) {
        $this->role_module_m->authorization('14');
        $data['data'] = $this->user_m->get_data($id)->row();
        $data['content'] = 'basis/user/edit_user_v';
        $data['data_subsection'] = $this->subsection_m->get_subsection();
        $data['data_section'] = $this->section_m->get_section();
        $data['data_dept'] = $this->dept_m->get_dept();
        $data['data_groupdept'] = $this->groupdept_m->get_groupdept();
        $data['data_division'] = $this->division_m->get_division();
        $data['data_company'] = $this->company_m->get_company();

        $data['data_role'] = $this->role_m->select_role();

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(14);

        $data['title'] = 'Edit User';
        $this->load->view('/template/head', $data);
    }

    //updating data
    function update_user() {
        $id = $this->input->post('CHR_NPK');
        $date = $this->input->post('CHR_REGIS_DATE');

        $this->form_validation->set_rules('CHR_USERNAME', 'Username', 'required');
        $this->form_validation->set_rules('CHR_PASS', 'Password', 'required|min_length[7]|trim');
        $this->form_validation->set_rules('CHR_PASS_CONFIRM', 'Password Confirm', 'required|matches[CHR_PASS]|callback_password_check');
        $session = $this->session->all_userdata();
        $code_pass = trim(md5($this->input->post('CHR_PASS') . $date));

        if ($this->form_validation->run() == FALSE) {
            $this->edit_user($id);
        } else {
            $data = array(
                'CHR_USERNAME' => $this->input->post('CHR_USERNAME'),
                'CHR_PASS' => $code_pass,
                'INT_ID_ROLE' => $this->input->post('INT_ID_ROLE'),
                'INT_ID_GROUP' => $this->input->post('INT_ID_GROUP'),
                'CHR_EXP_DATE' => date("Ymd"),
                'CHR_MODI_BY' => $session['USERNAME'],
                'CHR_MODI_DATE' => date("Ymd"),
                'CHR_MODI_TIME' => date("His"),
            );
            $this->user_m->update($data, $id);
            $this->log_m->add_log('55', $id);
            redirect($this->back_to_manage . $msg = 2);
        }
    }

    //deleting data
    function delete_user($id) {
        $this->role_module_m->authorization('14');
        $this->user_m->delete($id);
        $this->log_m->add_log('56', $id);
        redirect($this->back_to_manage . $msg = 3);
    }

}
