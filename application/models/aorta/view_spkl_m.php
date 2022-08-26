<?php

class view_spkl_m extends CI_Model
{

    private $tabel = 'TT_KRY_OVERTIME';
    private $temp_tabel = 'TW_KRY_OVERTIME';


    function get_join_table_nama($dept, $period)
    {
        $aortadb = $this->load->database("aorta", TRUE);


        $query = $aortadb->query("SELECT TOP 1000  * FROM TT_KRY_OVERTIME 
        INNER JOIN TM_KRY ON TT_KRY_OVERTIME.NPK = TM_KRY.NPK
         where LEFT(TT_KRY_OVERTIME.TGL_OVERTIME,6) = '$period'  and TT_KRY_OVERTIME.KD_DEPT = '$dept' 
         ORDER BY TGL_OVERTIME DESC");
        // return $query;
        return $query->result();
    }
    function get_option_filter_dept()
    {
        $aortadb = $this->load->database("aorta", TRUE);


        $query = $aortadb->query("SELECT * from TM_DEP ORDER BY KODE ASC");
        return $query;
    }

    // function get_data_request_quota_employee($dept, $section, $period)
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);

    //     if ($section == 'ALL') {
    //         return $aortadb->query("SELECT Q.ID_DOC, Q.TAHUNBULAN, Q.TGL_DOC, K.KD_DEPT, 
    //         COUNT(Q.NPK) AS TOT_MP,
    //         SUM(CAST(REPLACE(QUANTITY_QUOTA_PR,',','.') AS DECIMAL(10,2))) AS QUOTA_PR,
    //         SUM(CAST(REPLACE(QUANTITY_QUOTA_IM,',','.') AS DECIMAL(10,2))) AS QUOTA_IM,
    //         Q.KADEP_APPROVE, Q.GM_APPROVE, Q.DIR_APPROVE, Q.FLG_FINISH_APPROVE STAT,
    //         CASE WHEN Q.FLG_FINISH_APPROVE = 1 THEN '(Selesai)' ELSE '-' END AS FLG_FINISH_APPROVE , Q.ALASAN
    //         FROM TT_QUOTA_HIS Q INNER JOIN TM_KRY K ON Q.NPK = K.NPK 
    //         WHERE TAHUNBULAN = '$period' AND K.KD_DEPT = '$dept' AND Q.FLG_DELETE = 0
    //         GROUP BY Q.ID_DOC, Q.TAHUNBULAN, Q.TGL_DOC, K.KD_DEPT,  Q.KADEP_APPROVE, Q.GM_APPROVE, Q.DIR_APPROVE, 
    //         Q.FLG_FINISH_APPROVE, Q.ALASAN
    //         ORDER BY Q.KADEP_APPROVE")->result();
    //     } else {
    //         return $aortadb->query("SELECT Q.ID_DOC, Q.TAHUNBULAN, Q.TGL_DOC, K.KD_DEPT, 
    //         COUNT(Q.NPK) AS TOT_MP,
    //         SUM(CAST(REPLACE(QUANTITY_QUOTA_PR,',','.') AS DECIMAL(10,2))) AS QUOTA_PR,
    //         SUM(CAST(REPLACE(QUANTITY_QUOTA_IM,',','.') AS DECIMAL(10,2))) AS QUOTA_IM,
    //         Q.KADEP_APPROVE, Q.GM_APPROVE, Q.DIR_APPROVE, Q.FLG_FINISH_APPROVE STAT,
    //         CASE WHEN Q.FLG_FINISH_APPROVE = 1 THEN '(Selesai)' ELSE '-' END AS FLG_FINISH_APPROVE , Q.ALASAN
    //         FROM TT_QUOTA_HIS Q INNER JOIN TM_KRY K ON Q.NPK = K.NPK 
    //         WHERE TAHUNBULAN = '$period' AND K.KD_DEPT = '$dept' AND K.KD_SECTION = '$section' AND Q.FLG_DELETE = 0
    //         GROUP BY Q.ID_DOC, Q.TAHUNBULAN, Q.TGL_DOC, K.KD_DEPT,  Q.KADEP_APPROVE, Q.GM_APPROVE, Q.DIR_APPROVE, 
    //         Q.FLG_FINISH_APPROVE, Q.ALASAN
    //         ORDER BY Q.KADEP_APPROVE")->result();
    //     }
    // }

    // where TT_KRY_OVERTIME.KD_DEPT = '$dept'

    // function filter_dept()
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);


    //     $query = $aortadb->query("SELECT * from TM_DEP ORDER BY KODE ASC");
    //     return $query;
    // }



    // function check_ot_by_section($section, $tanggal)
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);
    //     $query = $aortadb->query("SELECT * FROM TT_KRY_OVERTIME WHERE KD_SECTION = '$section' AND TGL_OVERTIME = '$tanggal'");

    //     if ($query->num_rows() > 0) {
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }

    // function check_ot_by_npk($npk, $tanggal)
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);
    //     $query = $aortadb->query("SELECT * FROM TW_KRY_OVERTIME WHERE NPK = '$npk' AND TGL_OVERTIME = '$tanggal'");

    //     if ($query->num_rows() > 0) {
    //         return $query->row();
    //     } else {
    //         return false;
    //     }
    // }


    // function get_data_view_spkl($dept, $period, $section)
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);

    //     if ($section == 'ALL') {
    //         return $aortadb->query("SELECT NO_SEQUENCE, TGL_OVERTIME, COUNT(NPK) AS TOT_MP, SUM(CAST(RENC_DURASI_OV_TIME AS DECIMAL(10,2)))/60 AS RENC_DURASI_OV_TIME, CEK_GM, CEK_KADEP, KD_DEPT, KD_SECTION, ALASAN
    //         FROM TT_KRY_OVERTIME WHERE TGL_OVERTIME LIKE '$period%' AND KD_DEPT = '$dept' AND FLG_DELETE = 0
    //             GROUP BY CEK_GM, CEK_KADEP, KD_SECTION, NO_SEQUENCE, TGL_OVERTIME, KD_DEPT, ALASAN
    //             ")->result();
    //     } else {
    //         return $aortadb->query("SELECT NO_SEQUENCE, TGL_OVERTIME, COUNT(NPK) AS TOT_MP, SUM(CAST(RENC_DURASI_OV_TIME AS DECIMAL(10,2)))/60 AS RENC_DURASI_OV_TIME, CEK_GM, CEK_KADEP, KD_DEPT, KD_SECTION, ALASAN
    //         FROM TT_KRY_OVERTIME WHERE TGL_OVERTIME LIKE '$period%' AND KD_DEPT = '$dept' AND KD_SECTION = '$section' AND FLG_DELETE = 0
    //             GROUP BY CEK_GM, CEK_KADEP, KD_SECTION, NO_SEQUENCE, TGL_OVERTIME, KD_DEPT, ALASAN
    //             ")->result();
    //     }
    // }

    // function get_data_overtime($dept, $period, $section)
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);

    //     if ($section == 'ALL') {
    //         return $aortadb->query("SELECT NO_SEQUENCE, TGL_OVERTIME, COUNT(NPK) AS TOT_MP, SUM(CAST(RENC_DURASI_OV_TIME AS DECIMAL(10,2)))/60 AS RENC_DURASI_OV_TIME, CEK_GM, CEK_KADEP, KD_DEPT, KD_SECTION, ALASAN
    //         FROM TT_KRY_OVERTIME WHERE TGL_OVERTIME LIKE '$period%' AND KD_DEPT = '$dept' AND FLG_DELETE = 0
    //             GROUP BY CEK_GM, CEK_KADEP, KD_SECTION, NO_SEQUENCE, TGL_OVERTIME, KD_DEPT, ALASAN
    //             ")->result();
    //     } else {
    //         return $aortadb->query("SELECT NO_SEQUENCE, TGL_OVERTIME, COUNT(NPK) AS TOT_MP, SUM(CAST(RENC_DURASI_OV_TIME AS DECIMAL(10,2)))/60 AS RENC_DURASI_OV_TIME, CEK_GM, CEK_KADEP, KD_DEPT, KD_SECTION, ALASAN
    //         FROM TT_KRY_OVERTIME WHERE TGL_OVERTIME LIKE '$period%' AND KD_DEPT = '$dept' AND KD_SECTION = '$section' AND FLG_DELETE = 0
    //             GROUP BY CEK_GM, CEK_KADEP, KD_SECTION, NO_SEQUENCE, TGL_OVERTIME, KD_DEPT, ALASAN
    //             ")->result();
    //     }
    // }

    // function get_section_overtime($dept)
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);
    //     $query = $aortadb->query("SELECT RTRIM(KODE) KODE, RTRIM(NAMA_SECTION) NAMA_SECTION, RTRIM(KASIE_NPK) KASIE_NPK, RTRIM(KODE_DEP) KODE_DEP FROM TM_SECTION WHERE KODE_DEP = '$dept'")->result();
    //     return $query;
    // }

    // $query = $this->db->query("SELECT INT_ID_DEPT, CHR_DEPT, CHR_DEPT_DESC from TM_DEPT where CHR_DEPT <> ''")->result();
    // return $query;

    // $aortadb->select('top 100 *');
    // $aortadb->from('TT_KRY_OVERTIME');
    // $aortadb->join('TM_KRY', 'TT_KRY_OVERTIME.NPK = TM_KRY.NPK');

    // $query =  $aortadb->get();

    // return $query;

    // $this->db->select('*');
    // $this->db->from('TT_KRY_OVERTIME');
    // $this->db->join('TM_KRY', 'TT_KRY_OVERTIME.NPK = TM_KRY.NPK');
    // if ($npk != null) {
    //     $aortadb->where('NPK', $npk);
    // }
    // $query = $this->db->get();

    // return $query;
}
