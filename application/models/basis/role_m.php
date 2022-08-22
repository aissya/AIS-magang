<?php

class role_m extends CI_Model {

    private $tabel = 'TM_ROLE';

    function select_all() {
        $hasil = $this->db->query("select * from TM_ROLE where BIT_FLG_DEL = 0");
        return $hasil->result();
    }

    function select_role() {
        $hasil = $this->db->query("select * from TM_ROLE where BIT_FLG_DEL = 0");
        return $hasil->result();
    }

    function save($data) {
        $this->db->insert($this->tabel, $data);
    }

    function get_data($id) {
        $this->db->where('INT_ID_ROLE', $id);
        return $this->db->get($this->tabel)->row();
    }

    function delete($id) {
        $data = array('BIT_FLG_DEL' => 1);

        $this->db->where('INT_ID_ROLE', $id);
        $this->db->update($this->tabel, $data);
    }

    function update($data, $id) {
        $this->db->where('INT_ID_ROLE', $id);
        $this->db->update($this->tabel, $data);
    }

    function check_id($id) {
        $find_id = $this->db->query("select * from TM_ROLE where INT_ID_ROLE = '" . $id . "'");
        if ($find_id->num_rows() > 0) {
            return $find_id->result();
        }
        return false;
    }
    

}
