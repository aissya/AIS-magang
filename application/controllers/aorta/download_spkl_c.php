<?php

class download_spkl_c extends CI_Controller
{

    private $layout = '/template/head';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('aorta/download_spkl_m');
      
    }


    function index($period = null, $dept = null, $section = null, $msg = NULL)
    {


        $data['app'] = $this->role_module_m->get_app();
        $data['module'] = $this->role_module_m->get_module();
        $data['function'] = $this->role_module_m->get_function();
        $data['sidebar'] = $this->role_module_m->side_bar(356); 
        $data['news'] = $this->news_m->get_news();
        $data['title'] = 'Download SPKL';
        $data['msg'] = $msg;
        $data['data_download'] = $this->download_spkl_m->jointable()->result();

        $user_session = $this->session->all_userdata();
        $npk = $user_session['NPK'];
        $role = $user_session['ROLE'];
        $id_dept = $user_session['DEPT'];
        $id_group = $user_session['GROUPDEPT'];
        $id_division = $user_session['DIVISION'];
        
       
        $data['npk'] = $npk;
        $data['role'] = $role;
        $data['dept'] = $dept;
        $data['section'] = $section;
        $data['period'] = $period;

        $data['content'] = 'aorta/download_spkl/manage_download_spkl_v'; // NAMA VIEW 
        $this->load->view($this->layout, $data);
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
   
}