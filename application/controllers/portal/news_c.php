<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class news_c extends CI_Controller {
    
    private $layout = '/template/head';

    public function __construct() {
        parent::__construct();
        $this->load->model('basis/home_m');
        $this->load->model('basis/log_m');
        $this->load->model('basis/role_module_m');
        
        // $this->load->model('portal/news_m');
;
    }

    function check_session() {
        $user_session = $this->session->all_userdata();
        if ($user_session['NPK'] == '') {
            redirect(base_url('index.php/login_c'));
        }
    }

    function index($msg = null) {
        
        $title = 'News & Event';
        $content = 'portal/news_v';
        
        $data['msg'] = $msg;
        $data['title'] = $title;
        $data['content'] = $content;

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(40);
        $data['news'] = null;
        $data['news_top'] = $this->news_m->findBySql('SELECT   TOP 1  a.INT_ID_NEWS, a.CHR_NEWS_TITLE, a.CHR_NEWS_DESC, a.CHR_WRITTEN_BY, b.CHR_USERNAME, a.CHR_FLG_DEL
                                                    FROM         TT_PORTAL_NEWS AS a INNER JOIN
                                                                          TM_USER AS b ON a.CHR_WRITTEN_BY = b.CHR_NPK ORDER BY INT_ID_NEWS DESC');
        
        $this->load->view($this->layout, $data);
    }
    
    function detil($id = null) {
        
        $title = 'News & Event';
        $content = 'portal/news_detil_v';
        
        //$data['msg'] = $msg;
        $data['title'] = $title;
        $data['content'] = $content;

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(40);
        $data['news'] = null;
        $news_id_data = $this->news_m->get_by_id($id);
        $data['news_id_title'] = $news_id_data[0]->CHR_NEWS_TITLE;
        $data['news_id'] = $news_id_data;
        
        $this->load->view($this->layout, $data);
    }
    
    function maintain_news($msg = null) {
        
        $this->role_module_m->authorization('41');

        
        $data_content = 'portal/maintain_news_v';
        $content =  $this->news_m->findBySql('SELECT   a.INT_ID_NEWS, a.CHR_NEWS_TITLE, a.CHR_NEWS_DESC, a.CHR_WRITTEN_BY, b.CHR_USERNAME, a.CHR_FLG_DEL, a.CHR_DATETIME
                                                    FROM         TT_PORTAL_NEWS AS a INNER JOIN
                                                                          TM_USER AS b ON a.CHR_WRITTEN_BY = b.CHR_NPK ORDER BY INT_ID_NEWS DESC');

        $data['msg'] = $msg;
        $data['data'] = $content;
        $data['content'] = $data_content;
        $data['title'] = 'Manage News Event';

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(41);
        $data['news'] = null;

        $this->load->view($this->layout, $data);
        
    }
    
}
?>