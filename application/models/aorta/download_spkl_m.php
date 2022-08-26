<?php

class download_spkl_m extends CI_Model
{

    private $tabel = 'TT_KRY_OVERTIME';
    private $temp_tabel = 'TW_KRY_OVERTIME';

    function jointable()
    {
        $aortadb = $this->load->database("aorta", TRUE);

        $query = $aortadb->query("SELECT TOP 100 * FROM TT_KRY_OVERTIME ORDER BY NO_SEQUENCE DESC");
        return $query;
    }

   /* function exportexcel()
    {
        $aortadb = $this->load->database("aorta", TRUE)
        $query = $aortadb->query("SELECT * " & _ "FROM [DB_AORTA]. [dbo].[TT_KRY_OVERTIME]" & _ "WHERE" & _ "TGL_OVERTIME BETWEEN '" & strDATE
    } */

    public function GetDownloadspkl () {
        return $this->db->get('TT_KRY_OVERTIME')->result_array();
    }
}