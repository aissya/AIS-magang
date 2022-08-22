<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('basis/home_m');
        $this->load->model('basis/log_m');
        $this->load->model('basis/role_module_m');
    }

    function check_session() {
        $user_session = $this->session->all_userdata();
        if ($user_session['NPK'] == '') {
            redirect(base_url('index.php/login_c'));
        }
    }

    function index($msg = null) {
        $this->check_session();
        $user_session = $this->session->all_userdata();
        $row = $this->home_m->get_role($user_session['ROLE'])->row();
        if (($user_session['ROLE'] == '1') or ($user_session['ROLE'] == '2')) {
            $data['logs'] = $this->log_m->get_last_logs();
        } else {
            $data['logs'] = null;
        }
        $title = $row->CHR_ROLE . ' Dashboard';
        $content = 'dashboard/budget1';
        $data['msg'] = $msg;
        $data['title'] = $title;
        $data['content'] = $content;

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(0);
        
        $this->load->view('/template/head', $data);
    }

}

?>
