<?php

class download_spkl_c extends CI_Controller
{

    private $layout = '/template/head';
    private $back_to_approve_mgr = '/aorta/quota_employee_c/prepare_approve_quota_by_mgr/';
    private $back_to_approve_gm = '/aorta/quota_employee_c/prepare_approve_quota_by_gm/';
    private $back_to_approve_dir = '/aorta/quota_employee_c/prepare_approve_quota_by_dir/';
    private $back_to_upload = '/aorta/quota_employee_c/create_quota_employee/';
    private $back_to_balance = '/aorta/quota_employee_c/balancing_quota/';
    private $back_to_reupload = '/aorta/quota_employee_c/edit_quota_employee/';
    private $back_to_manage = '/aorta/quota_employee_c/index/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('aorta/download_spkl_m');
        $this->load->model('aorta/master_data_m');
        $this->load->model('organization/dept_m');
        $this->load->model('organization/section_m');
        $this->load->model('aorta/overtime_m');
        $this->load->model('aorta/history_m');
        $this->load->model('organization/groupdept_m');
        $this->load->model('organization/dept_m');
    }

    public function check_session()
    {
        $user_session = $this->session->all_userdata();
        if ($user_session['NPK'] == '') {
            redirect(base_url('index.php/login_c'));
        }
    }


    function index($period = null, $dept = null, $section = null, $msg = NULL)
    {

        if ($msg == 1) {
            $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Creating success </strong> The data is successfully created </div >";
        } elseif ($msg == 2) {
            $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Updating success </strong> The data is successfully updated </div >";
        } elseif ($msg == 3) {
            $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Deleted success </strong> The data is successfully deleted </div >";
        } elseif ($msg == 13) {
            $msg = "<div class = 'alert alert-danger'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Delete failed !</strong> Quota ini sudah disetujui / dalam proses persetujuan, tidak bisa didelete </div >";
        } elseif ($msg == 15) {
            $msg = "<div class = 'alert alert-danger'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Executing error !</strong> Template Anda Salah atau sudah diubah, Silahkan Coba Lagi Dengan Template Yang Benar </div >";
        } elseif ($msg == 12) {
            $msg = "<div class = 'alert alert-danger'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Executing error !</strong> Something error with parameter </div >";
        }

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(356);
        $data['news'] = $this->news_m->get_news();
        $data['title'] = 'Download SPKL';
        $data['msg'] = $msg;


        $user_session = $this->session->all_userdata();
        $npk = $user_session['NPK'];
        $role = $user_session['ROLE'];
        $id_dept = $user_session['DEPT'];
        $id_group = $user_session['GROUPDEPT'];
        $id_division = $user_session['DIVISION'];

        if ($period == NULL) {
            $period = date('Ym');
        }

        $data['npk'] = $npk;
        $data['role'] = $role;
        $data['dept'] = $dept;
        $data['section'] = $section;
        $data['period'] = $period;

        $data['data_download'] = $this->download_spkl_m->jointable();
        // $data['data_if'] = $this->download_spkl_m->get_concat();
        // print_r($data['data_if']);
        // exit;

        $data['content'] = 'aorta/download_spkl/manage_download_spkl_v'; // NAMA VIEW 
        $this->load->view($this->layout, $data);
    }
}


    /* public function excel() {
        $data['content'] = 'aorta/download_spkl/manage_download_spkl_v';
        $this->load->view($this->layout, $data);

        require(APPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        $object->getProperties()->setCreator("Aisin Indonesia");
        $object->getProperties()->setLastModifiedBy("Aisin Indonesia");
        $object->getProperties()->setTitle("SPKL");
        
        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellVallue('A1', 'No');
        $object->getActiveSheet()->setCellVallue('B1', 'No SPKL');

        $baris = 2;
        $no = 1;
        
        foreach ($data['content'] as  $data) {
            $object->getActiveSheet()->setCellValue('A' .$baris, $no++);
            $object->getActiveSheet()->setCellValue('b' .$baris, $data->no_spkl);
            
            $baris++;
        }
            
            $object->getActiveSheet()->setTitle("SPKL");

            $object>getActiveSheet()->setTitle("SPKL");

            header('Content->Type: application/ vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
        
            $writer=PHPExcel_IOFactory::createwriter($object, 'excel2007');
            $writer->save('php://output');

            exit;
    }

   /* public function excel()
    {
        header ("Content-type: application/x-msexcel");
        header ("Content-type: application/octet-stream");
        header ("Content-Disposition: attachment; filename=Name_file.xls");
        $data['content'] = 'aorta/download_spkl/excel';
        $this->load->view($this->layout, $data);
        
        
    } */