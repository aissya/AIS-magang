<?php

class user_m extends CI_Model {

    private $tabel = 'TM_USER';

    function get_user() {
        $hasil = $this->db->query("select a.CHR_NPK, a.CHR_USERNAME,c.CHR_ROLE, c.INT_ID_ROLE,
            d.CHR_DEPT,e.CHR_GROUP_DEPT,f.CHR_SECTION,g.CHR_SUB_SECTION,h.CHR_COMPANY ,b.CHR_DIVISION
            from TM_USER a,TM_DEPT d, TM_ROLE c,TM_SECTION f,TM_GROUP_DEPT e,TM_SUB_SECTION g,TM_COMPANY h,TM_DIVISION b
            where a.INT_ID_ROLE = c.INT_ID_ROLE and a.BIT_FLG_DEL = 0 and a.INT_ID_SECTION = f.INT_ID_SECTION
            and a.INT_ID_DEPT = d.INT_ID_DEPT and a.INT_ID_GROUP_DEPT = e.INT_ID_GROUP_DEPT and a.INT_ID_DIVISION = b.INT_ID_DIVISION
            and a.INT_ID_COMPANY = h.INT_ID_COMPANY and a.INT_ID_SUB_SECTION = g.INT_ID_SUB_SECTION");
        return $hasil->result();
    }

    function save($data) {
        $this->db->insert($this->tabel, $data);
    }

    function get_data($id) {
        $hasil = $this->db->query("select a.CHR_NPK,a.CHR_REGIS_DATE, a.CHR_USERNAME,c.CHR_ROLE,c.INT_ID_ROLE,f.INT_ID_SECTION,
            d.INT_ID_DEPT, e.INT_ID_GROUP_DEPT, b.INT_ID_DIVISION, h.INT_ID_COMPANY, g.INT_ID_SUB_SECTION,
            d.CHR_DEPT,e.CHR_GROUP_DEPT,f.CHR_SECTION,g.CHR_SUB_SECTION,h.CHR_COMPANY ,b.CHR_DIVISION
            from TM_USER a,TM_DEPT d, TM_ROLE c,TM_SECTION f,TM_GROUP_DEPT e,TM_SUB_SECTION g,TM_COMPANY h,TM_DIVISION b
            where a.INT_ID_ROLE = c.INT_ID_ROLE and a.BIT_FLG_DEL = 0 and a.INT_ID_SECTION = f.INT_ID_SECTION
            and a.INT_ID_DEPT = d.INT_ID_DEPT and a.INT_ID_GROUP_DEPT = e.INT_ID_GROUP_DEPT and a.INT_ID_DIVISION = b.INT_ID_DIVISION
            and a.INT_ID_COMPANY = h.INT_ID_COMPANY and a.INT_ID_SUB_SECTION = g.INT_ID_SUB_SECTION and a.CHR_NPK = '" . $id . "'");
        return $hasil;
    }
    
    function get_dept_by_npk($npk){
        $query = $this->db->query("select INT_ID_DEPT from TM_USER where CHR_NPK = '" . $npk . "'")->row_array();
        $part_of = $query['INT_ID_DEPT'];
        return $part_of;
    }

    function delete($id) {
        $data = array('BIT_FLG_DEL' => 1);

        $this->db->where('CHR_NPK', $id);
        $this->db->update($this->tabel, $data);
    }

    function update($data, $id) {
        $this->db->where('CHR_NPK', $id);
        $this->db->update($this->tabel, $data);
    }

    public function check_username($username) {
        $this->db->where('CHR_USERNAME', $username);
        $find_user = $this->db->get($this->tabel);
        return $find_user->result();
    }

    public function check_npk($npk) {
        $this->db->where('CHR_NPK', $npk);
        $find_npk = $this->db->get($this->tabel);
        return $find_npk->result();
    }

}
