<?php

class download_spkl_m extends CI_Model
{

    private $tabel = 'TT_KRY_OVERTIME';
    private $temp_tabel = 'TW_KRY_OVERTIME';

    function jointable()
    {
        $aortadb = $this->load->database("aorta", TRUE);

        $query = $aortadb->query("SELECT TOP 10 NO_SEQUENCE,NPK, CEK_GM, TGL_OVERTIME, TGL_ENTRY, REAL_MULAI_OV_TIME, REAL_SELESAI_OV_TIME,
        (RTRIM(NPK)+'/'+TGL_OVERTIME+'/01') AS Reference, 
        (NO_SEQUENCE+''+CLOSE_TRANS) AS Remark,
		LEFT(REAL_MULAI_OV_TIME, 4) AS OVT_IN_TIME,
		LEFT(REAL_SELESAI_OV_TIME, 4) AS OVT_OUT_TIME,

		CASE 
		WHEN REAL_MULAI_OV_TIME > REAL_SELESAI_OV_TIME 
		THEN CONVERT(VARCHAR (8), DATEADD(DAY, 1, TGL_OVERTIME), 112)
		ELSE TGL_OVERTIME
		END AS OVT_OUT_DATE


        FROM TT_KRY_OVERTIME 
		WHERE CEK_GM = 1 
		ORDER BY NO_SEQUENCE DESC");

        return $query->result();
    }

    // SELECT RTRIM (LTRIM (' JKL ')) AS Trimmed
    // function get_concat()
    // {
    //     $aortadb = $this->load->database("aorta", TRUE);

    //     $query = $aortadb->query("SELECT TOP 100 (NO_SEQUENCE+''+CLOSE_TRANS) AS Remark FROM TT_KRY_OVERTIME ");
    //     return $query->result();

    //     // print_r($query);
    //     // exit;
    // }



    /* function exportexcel()
    {
        $aortadb = $this->load->database("aorta", TRUE)
        $query = $aortadb->query("SELECT * " & _ "FROM [DB_AORTA]. [dbo].[TT_KRY_OVERTIME]" & _ "WHERE" & _ "TGL_OVERTIME BETWEEN '" & strDATE
    } */

    // public function GetDownloadspkl () {
    //     return $this->db->get('TT_KRY_OVERTIME')->result_array();
    // }
}
