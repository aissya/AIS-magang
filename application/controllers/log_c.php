<?php
class log_c extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('basis/log_m');
        $this->load->model('basis/role_module_m');
    }
    private $layout = '/template/head';
    function index($msg = NULL) {
        $this->role_module_m->authorization('23');
       $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(23);

        $data['title'] = 'User Logs';
        $data['data'] = $this->log_m->get_last_month_logs();
        $data['content'] = 'log/log_v';
        $this->load->view($this->layout, $data);
    }
}

?>
