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


    function index($msg = NULL)
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


        $data['npk'] = $npk;
        $data['role'] = $role;


        $mulai = 20210701;
        $selesai = 20210728;
        $gm = 1;
        $deptart = 'MIS';
        $download = 0;


        $data['tgl_mulai'] = substr($mulai, 0, 4) . '-' . substr($mulai, 4, 2) . '-' . substr($mulai, 6, 2); //untuk merubah format dari 20210701 menjadi 2021-07-01
        $data['tgl_selesai'] = substr($selesai, 0, 4) . '-' . substr($selesai, 4, 2) . '-' . substr($selesai, 6, 2);
        $data['cek_gm'] = $gm;
        $data['dept'] = $deptart;
        $data['status_download'] = $download;


        $data['data_download'] = $this->download_spkl_m->get($mulai, $selesai, $gm, $deptart, $download);


        // $no_spkl = 2021070776;
        // $data['detail_data_download'] = $this->download_spkl_m->detail_m($no_spkl);


        $data['content'] = 'aorta/download_spkl/manage_download_spkl_v'; // NAMA VIEW 
        $this->load->view($this->layout, $data);
    }

    function search($msg = NULL)
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


        $data['npk'] = $npk;
        $data['role'] = $role;


        $mulai = $this->input->post("tgl_mulai");
        $selesai = $this->input->post("tgl_selesai");
        $gm = $this->input->post("cek_gm");
        $deptart = $this->input->post("dept");
        $download = $this->input->post("status_download");


        $data['tgl_mulai'] = $mulai; //mengambil value 2021-07-01 dari view
        $data['tgl_selesai'] = $selesai;
        $data['cek_gm'] = $gm;
        $data['dept'] = $deptart;
        $data['status_download'] = $download;



        $mulai = str_replace("-", "", "$mulai"); //untuk merubah format date dari 2021-07-01 menjadi 20210701
        $selesai = str_replace("-", "", "$selesai");



        $data['data_download'] = $this->download_spkl_m->get($mulai, $selesai, $gm, $deptart, $download);


        $data['content'] = 'aorta/download_spkl/manage_download_spkl_v'; // NAMA VIEW 
        $this->load->view($this->layout, $data);
    }

    // function index_lama($cek_gm = NULL, $dept = NULL, $section = null, $msg = NULL)
    // {

    //     if ($msg == 1) {
    //         $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Creating success </strong> The data is successfully created </div >";
    //     } elseif ($msg == 2) {
    //         $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Updating success </strong> The data is successfully updated </div >";
    //     } elseif ($msg == 3) {
    //         $msg = "<div class = 'alert alert-info'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Deleted success </strong> The data is successfully deleted </div >";
    //     } elseif ($msg == 13) {
    //         $msg = "<div class = 'alert alert-danger'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Delete failed !</strong> Quota ini sudah disetujui / dalam proses persetujuan, tidak bisa didelete </div >";
    //     } elseif ($msg == 15) {
    //         $msg = "<div class = 'alert alert-danger'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Executing error !</strong> Template Anda Salah atau sudah diubah, Silahkan Coba Lagi Dengan Template Yang Benar </div >";
    //     } elseif ($msg == 12) {
    //         $msg = "<div class = 'alert alert-danger'><button type = 'button' class = 'close' data-dismiss = 'alert'>&times;</button><strong>Executing error !</strong> Something error with parameter </div >";
    //     }

    //     $data['app'] = $this->role_module_m->get_app();
    //     $data['module'] = $this->role_module_m->get_module();
    //     $data['function'] = $this->role_module_m->get_function();
    //     $data['sidebar'] = $this->role_module_m->side_bar(356);
    //     $data['news'] = $this->news_m->get_news();
    //     $data['title'] = 'Download SPKL';
    //     $data['msg'] = $msg;


    //     $user_session = $this->session->all_userdata();
    //     $npk = $user_session['NPK'];
    //     $role = $user_session['ROLE'];
    //     $id_dept = $user_session['DEPT'];
    //     $id_group = $user_session['GROUPDEPT'];
    //     $id_division = $user_session['DIVISION'];

    //     // if ($period == NULL) {
    //     //     $period = date('Ym');
    //     // }

    //     if ($role == 25) {
    //         if ($dept == NULL) {
    //             $dept = $this->dept_m->get_top_data_dept_by_division($id_division)->row()->CHR_DEPT;
    //         } else {
    //             $dept = $dept;
    //         }
    //         $data['all_dept'] = $this->dept_m->get_dept_by_division_id($id_division);
    //     } else if ($role == 33) {
    //         if ($dept == NULL) {
    //             $dept = $this->dept_m->get_top_data_dept_by_groupdept($id_group)->row()->CHR_DEPT;
    //         } else {
    //             $dept = $dept;
    //         }
    //         $data['all_dept'] = $this->dept_m->get_dept_by_groupdept($id_group);
    //     } else {
    //         if ($dept == NULL) {
    //             $dept = $this->dept_m->get_data_dept($id_dept)->row()->CHR_DEPT;
    //         } else {
    //             $dept = $dept;
    //         }
    //         $data['all_dept'] = $this->dept_m->get_data_dept($id_dept)->result();
    //     }


    //     if ($cek_gm == NULL) {
    //         $cek_gm = 1;
    //     }

    //     $data['all_gm'] = $this->download_spkl_m->get_gm_m();



    //     // $mulai = $this->input->POST("tgl_mulai");
    //     // $selesai = $this->input->POST("tgl_selesai");



    //     // $data['dept'] = $dept;
    //     // $data['period'] = $period;
    //     $data['npk'] = $npk;
    //     $data['role'] = $role;
    //     $data['dept'] = trim($dept);
    //     $data['section'] = $section;

    //     $data['cek_gm'] = $cek_gm;




    //     $data['data_download'] = $this->download_spkl_m->get($cek_gm, $data['dept']);

    //     $data['content'] = 'aorta/download_spkl/manage_download_spkl_v'; // NAMA VIEW 
    //     $this->load->view($this->layout, $data);
    // }
    //filter wtih get


    function belum_GM($period = null, $dept = null, $section = null, $msg = NULL)
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


        $data['belum_GM_data_download'] = $this->download_spkl_m->belum_GM_m();
        // $data['data_if'] = $this->download_spkl_m->get_concat();
        // print_r($data['data_download']);
        // exit;

        $data['content'] = 'aorta/download_spkl/belum_GM_download_spkl_v'; // NAMA VIEW 
        $this->load->view($this->layout, $data);
    }


    function show($no_spkl)
    {

        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(356);
        $data['news'] = $this->news_m->get_news();
        $data['title'] = 'Detail SPKL';



        $user_session = $this->session->all_userdata();
        $npk = $user_session['NPK'];
        $role = $user_session['ROLE'];
        $id_dept = $user_session['DEPT'];
        $id_group = $user_session['GROUPDEPT'];
        $id_division = $user_session['DIVISION'];


        $data['npk'] = $npk;
        $data['role'] = $role;
        // $data['SPKL'] = $this->download_spkl_m->excel_m($no_spkl);

        $data['detail_data_download'] = $this->download_spkl_m->detail_m($no_spkl);
        $data['belum_GM_data_download'] = $this->download_spkl_m->detail_m($no_spkl);


        $data['content'] = 'aorta/download_spkl/detail_download_spkl_v'; // NAMA VIEW 
        $this->load->view($this->layout, $data);
    }


    public function excel($no_spkl, $status_spkl)
    {
        $data['data_download'] = $this->download_spkl_m->status_m($status_spkl);
        $data['data_download'] = $this->download_spkl_m->excel_m($no_spkl);

        $this->load->library('Excel');


        $object = new PHPExcel();

        $object->getProperties()->setCreator("Aisin Indonesia");
        $object->getProperties()->setLastModifiedBy("Aisin Indonesia");
        $object->getProperties()->setTitle("SPKL");
        $object->getProperties()->setSubject("SPKL");
        $object->getProperties()->setDescription("SPKL");

        // $object->setActiveSheetIndex(0);

        //SETUP EXCEL
        $object->setActiveSheetIndex();
        $worksheet = $object->getActiveSheet();
        // $worksheet->setTitle($period . "_" . $dept);

        //WIDTH
        $worksheet->getColumnDimension('A')->setWidth(12.14);
        $worksheet->getColumnDimension('B')->setWidth(18.29);
        $worksheet->getColumnDimension('C')->setWidth(13.71);
        $worksheet->getColumnDimension('D')->setWidth(16.14);
        $worksheet->getColumnDimension('E')->setWidth(17.57);
        $worksheet->getColumnDimension('F')->setWidth(17.29);
        $worksheet->getColumnDimension('G')->setWidth(16.14);
        $worksheet->getColumnDimension('H')->setWidth(21.29);
        $worksheet->getColumnDimension('I')->setWidth(8.43);

        $worksheet->getStyle("A:I")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        // $worksheet->getStyle("A1:I1")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $styleArray = [
            'font' => [
                'size'  =>  10,
                'name'  =>  'Arial'
            ],

        ];
        $worksheet->getStyle("A:I")->applyFromArray($styleArray);

        //HEADER
        $worksheet->setCellValue('A1', 'reference no');
        $worksheet->setCellValue('B1', 'employee ID');
        $worksheet->setCellValue('C1', 'overtime date');
        $worksheet->setCellValue('D1', 'reference date');
        $worksheet->setCellValue('E1', 'overtime in date');
        $worksheet->setCellValue('F1', 'overtime in time');
        $worksheet->setCellValue('G1', 'overtime out date');
        $worksheet->setCellValue('H1', 'overtime out time');
        $worksheet->setCellValue('I1', 'remark');


        $baris = 2;


        foreach ($data['data_download'] as  $isi) {
            $worksheet->setCellValue('A' . $baris, $isi->Reference);
            $worksheet->setCellValue('B' . $baris, $isi->NPK);
            $worksheet->setCellValue('C' . $baris, $isi->TGL_OVERTIME);
            $worksheet->setCellValue('D' . $baris, $isi->TGL_ENTRY);
            $worksheet->setCellValue('E' . $baris, $isi->TGL_OVERTIME);
            $worksheet->setCellValue('F' . $baris, $isi->OVT_IN_TIME);
            $worksheet->setCellValue('G' . $baris, $isi->OVT_OUT_DATE);
            $worksheet->setCellValue('H' . $baris, $isi->OVT_OUT_TIME);
            $worksheet->setCellValue('I' . $baris, $isi->Remark);


            $baris++;
        }


        $filename = $no_spkl  . ".xlt";
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . trim($filename) . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        $writer->save('php://output');

        exit;
    }

    public function excel_all()
    {

        // $data['data_download'] = $this->download_spkl_m->excel_all();
        $data_all = $this->download_spkl_m->get();

        $this->load->library('Excel');
        foreach ($data_all as  $vall) {
            $no_spkl = $vall->SPKL;
            $this->excel($no_spkl);
        }
    }
}







        // if ($period == NULL) {
        //     $period = date('Ym');
        // }


        // if ($role == 25) {
        //     if ($dept == NULL) {
        //         $dept = $this->dept_m->get_top_data_dept_by_division($id_division)->row()->CHR_DEPT;
        //     } else {
        //         $dept = $dept;
        //     }
        //     $data['all_dept'] = $this->dept_m->get_dept_by_division_id($id_division);
        // } else if ($role == 33) {
        //     if ($dept == NULL) {
        //         $dept = $this->dept_m->get_top_data_dept_by_groupdept($id_group)->row()->CHR_DEPT;
        //     } else {
        //         $dept = $dept;
        //     }
        //     $data['all_dept'] = $this->dept_m->get_dept_by_groupdept($id_group);
        // } else {
        //     if ($dept == NULL) {
        //         $dept = $this->dept_m->get_data_dept($id_dept)->row()->CHR_DEPT;
        //     } else {
        //         $dept = $dept;
        //     }
        //     $data['all_dept'] = $this->dept_m->get_data_dept($id_dept)->result();
        // }


        // if ($cek_gm == NULL) {
        //     $cek_gm = 1;
        // }

        // $data['all_gm'] = $this->download_spkl_m->get_gm_m();



        // $mulai = $this->input->POST("tgl_mulai");
        // $selesai = $this->input->POST("tgl_selesai");














    // /* public function excel() {
    //     $data['content'] = 'aorta/download_spkl/manage_download_spkl_v';
    //     $this->load->view($this->layout, $data);

    //     require(APPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
    //     require(APPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    //     $object = new PHPExcel();

    //     $object->getProperties()->setCreator("Aisin Indonesia");
    //     $object->getProperties()->setLastModifiedBy("Aisin Indonesia");
    //     $object->getProperties()->setTitle("SPKL");
        
    //     $object->setActiveSheetIndex(0);

    //     $object->getActiveSheet()->setCellVallue('A1', 'No');
    //     $object->getActiveSheet()->setCellVallue('B1', 'No SPKL');

    //     $baris = 2;
    //     $no = 1;
        
    //     foreach ($data['content'] as  $data) {
    //         $object->getActiveSheet()->setCellValue('A' .$baris, $no++);
    //         $object->getActiveSheet()->setCellValue('b' .$baris, $data->no_spkl);
            
    //         $baris++;
    //     }
            
    //         $object->getActiveSheet()->setTitle("SPKL");

    //         $object>getActiveSheet()->setTitle("SPKL");

    //         header('Content->Type: application/ vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //         header('Content-Disposition: attachment;filename="'.$filename.'"');
    //         header('Cache-Control: max-age=0');
        
    //         $writer=PHPExcel_IOFactory::createwriter($object, 'excel2007');
    //         $writer->save('php://output');

    //         exit;
    // }

   /* public function excel()
    {
        header ("Content-type: application/x-msexcel");
        header ("Content-type: application/octet-stream");
        header ("Content-Disposition: attachment; filename=Name_file.xls");
        $data['content'] = 'aorta/download_spkl/excel';
        $this->load->view($this->layout, $data);
        
        
    } */


    // ------------------------------------------------------------------------------------------------------


    
        // require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        // require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        // $data['no_spkl'] = $no_spkl;
        // $isi->SPKL
        // $colors = array("red", "green", "blue", "yellow"); 

        // foreach ($colors as $value) {
        // echo "$value <br>";



        // $object->getActiveSheet()->setCellValue('A1', 'Reference No');
        // $object->getActiveSheet()->setCellValue('B1', 'Employee ID');
        // $object->getActiveSheet()->setCellValue('C1', 'Overtime Date');
        // $object->getActiveSheet()->setCellValue('D1', 'Reference Date');
        // $object->getActiveSheet()->setCellValue('E1', 'Overtime In Date');
        // $object->getActiveSheet()->setCellValue('F1', 'Overtime In Time');
        // $object->getActiveSheet()->setCellValue('G1', 'Overtime Out Date');
        // $object->getActiveSheet()->setCellValue('H1', 'Overtime Out Time');
        // $object->getActiveSheet()->setCellValue('I1', 'Remark');

    

            // $object->getActiveSheet()->setCellValue('A' . $baris, $isi->Reference);
            // $object->getActiveSheet()->setCellValue('B' . $baris, $isi->NPK);
            // $object->getActiveSheet()->setCellValue('C' . $baris, $isi->TGL_OVERTIME);
            // $object->getActiveSheet()->setCellValue('D' . $baris, $isi->TGL_ENTRY);
            // $object->getActiveSheet()->setCellValue('E' . $baris, $isi->TGL_OVERTIME);
            // $object->getActiveSheet()->setCellValue('F' . $baris, $isi->OVT_IN_TIME);
            // $object->getActiveSheet()->setCellValue('G' . $baris, $isi->OVT_OUT_DATE);
            // $object->getActiveSheet()->setCellValue('H' . $baris, $isi->OVT_OUT_TIME);
            // $object->getActiveSheet()->setCellValue('I' . $baris, $isi->Remark);




                        // 'borders' => array[
            //     'allborders' => array(
            //         'style' => PHPExcel_Style_Border::BORDER_THIN,
            //         'color' => array('rgb' => 'DDDDDD')
            // ]

    
        // $filename = "SPKL" . date("d-m-Y-H-i-s") . '.xlsx';

        // $object->getActiveSheet()->setTitle("SPKL");

        // header('Content->Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="' . $filename . '"');
        // header('Cache-Control: max-age=0');

        // $writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        // $writer->save('php://output');


        

        // $data['data_download'] = $this->download_spkl_m->get($tgl_mulai, $tgl_selesai);


        // $data['data_if'] = $this->download_spkl_m->get_concat();
        // print_r($data['data_download']);
        // exit;
