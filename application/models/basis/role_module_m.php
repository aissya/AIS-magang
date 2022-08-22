<?php

class role_module_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_role_module_for_edit($id) {
        $this->db->where('INT_ID_ROLE', $id);
        return $this->db->get('TT_ROLE_MODULE')->result();
    }

    function get_all_app() {
        return $this->db->query('select INT_ID_APP, CHR_APP from TM_APPLICATION order by CHR_APP')->result();
    }

    public function get_all_role() {
        $this->db->where('BIT_FLG_DEL !=', '1');
        return $this->db->get('TM_ROLE');
    }

    public function get_all_function() {
        return $this->db->query('select * from TM_FUNCTION order by INT_ID_MODULE asc')->result();
    }

    public function get_all_module() {
        return $this->db->query('select * from TM_MODULE')->result();
    }

    function get_new_id_role() {
        return $this->db->query('select max(INT_ID_ROLE) as a from TM_ROLE')->row()->a + 1;
    }

    function save($data) {
        $this->db->insert('TT_ROLE_MODULE', $data);
    }

    function save_role_module($role, $function, $module) {
        $session = $this->session->all_userdata();
        $this->db->set('INT_ID_ROLE', $role);
        $this->db->set('INT_ID_FUNCTION', $function);
        $this->db->set('INT_ID_MODULE', $module);
        $this->db->set('CHR_CREATE_BY', $session['USERNAME']);
        $this->db->set('CHR_CREATE_DATE', date('Ymd'));
        $this->db->set('CHR_CREATE_TIME', date('His'));
        $this->db->insert('TT_ROLE_MODULE');
    }

    function get_module_from_funct($function) {
        $this->db->where('INT_ID_FUNCTION', $function);
        return $this->db->get('TM_FUNCTION')->row();
    }

    function get_data_role($id) {
        return $this->db->query('select a.INT_ID_ROLE, a.INT_ID_FUNCTION, a.INT_ID_MODULE, c.CHR_FUNCTION, b.CHR_MODULE
                                from TT_ROLE_MODULE a, TM_FUNCTION c, TM_MODULE b
                                where a.INT_ID_FUNCTION=c.INT_ID_FUNCTION and a.INT_ID_MODULE=b.INT_ID_MODULE and a.INT_ID_ROLE=' . $id . '
                                order by b.CHR_MODULE asc')->result();
    }

    function check_auth($id, $function) {
        return $this->db->query("select INT_ID_FUNCTION 
                                from TT_ROLE_MODULE 
                                where INT_ID_ROLE='$id' and INT_ID_FUNCTION='$function'")->result();
    }

    function delete_role_module($role) {
        $this->db->where('INT_ID_ROLE', $role);
        $this->db->delete('TT_ROLE_MODULE');
    }

    function if_exist($id) {
        $this->db->where('INT_ID_ROLE', $id);
        $x = $this->db->get('TT_ROLE_MODULE');
        if ($x->num_rows() == 0) {
            return false;
        } else {
            return TRUE;
        }
    }

    public function authorization($function) {
        $session = $this->session->all_userdata();
        if ($session['ROLE'] == '') {
            redirect('login_c');
        }
        $rm = $this->check_auth($session['ROLE'], $function);
        if (count($rm) == 0) {
            redirect("fail_c/auth");
        }
    }

    public function which_active($function) {
        return $this->db->query('select b.INT_ID_MODULE as menu
                                from TM_FUNCTION a, TM_MODULE b
                                where a.INT_ID_MODULE=b.INT_ID_MODULE and a.INT_ID_FUNCTION=' . $function)->row()->menu;
    }

    public function get_app() {
        //get all app to compare
        $user_session = $this->session->all_userdata();
        return $this->db->query("select distinct a.INT_ID_APP, a.CHR_ICON, a.CHR_APP, e.CHR_ROLE
                                from TM_APPLICATION a, TM_MODULE b, TT_ROLE_MODULE c, TM_FUNCTION d, TM_ROLE e
                                where a.INT_ID_APP=b.INT_ID_APP and b.INT_ID_MODULE=d.INT_ID_MODULE
                                and c.INT_ID_FUNCTION=d.INT_ID_FUNCTION and e.INT_ID_ROLE=c.INT_ID_ROLE and c.INT_ID_ROLE=" . $user_session['ROLE'])->result();
    }

    public function get_module() {
        // get all modules from ROLE_MODULE distinct
        $user_session = $this->session->all_userdata();
        return $this->db->query("select distinct a.INT_ID_MODULE, a.CHR_MODULE, a.INT_ID_APP, a.INT_LEVEL
                                from TM_MODULE a, TM_FUNCTION b, TT_ROLE_MODULE c
                                where a.INT_ID_MODULE=b.INT_ID_MODULE and b.INT_ID_FUNCTION=c.INT_ID_FUNCTION and c.INT_ID_ROLE=" . $user_session['ROLE'] . "
                                order by a.CHR_MODULE")->result();
    }

    public function get_function() {
        //get all function to compare
        $user_session = $this->session->all_userdata();
        return $this->db->query("select b.INT_ID_MODULE, d.INT_ID_FUNCTION, c.CHR_URL, c.CHR_FUNCTION, b.CHR_MODULE
                                from TM_MODULE b, TM_FUNCTION c, TT_ROLE_MODULE d
                                where b.INT_ID_MODULE=c.INT_ID_MODULE
                                and c.INT_ID_FUNCTION=d.INT_ID_FUNCTION and d.INT_ID_ROLE=" . $user_session['ROLE'])->result();
    }

    function side_bar($fun) {
        return $this->db->query("select f.INT_ID_FUNCTION, m.INT_ID_MODULE, a.INT_ID_APP
                                    from TM_FUNCTION f, TM_MODULE m, TM_APPLICATION a
                                    where a.INT_ID_APP=m.INT_ID_APP and m.INT_ID_MODULE=f.INT_ID_MODULE 
                                    and f.INT_ID_FUNCTION=$fun")->row();
    }
    
    

}
?>

