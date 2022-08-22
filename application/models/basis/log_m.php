<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class log_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_ip_client() {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            //check for ip from share internet
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            // Check for the Proxy User
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        // This will print user's real IP Address
        // does't matter if user using proxy or not.
        return $ip;
    }

    public function add_log($activity, $object) {
        // $user_session = $this->session->all_userdata();
        // $log = array(
        //     'CHR_TIME' => date('ymdHis'),
        //     'CHR_NPK' => $user_session['NPK'],
        //     'INT_ID_ACTIVITY' => $activity,
        //     'CHR_OBJECT' => $object,
        //     'CHR_CPU' => $this->get_ip_client()
        // );

        // $this->db->insert('TT_LOG', $log);
    }

    public function get_last_logs() {
        $this->db->limit(7);
        $this->db->order_by('CHR_TIME', 'desc');
        return $this->db->get('TT_LOG')->result();
    }
    
    function get_last_month_logs(){
        $m=date('ymdHis')-100000000;
        return $this->db->query("select a.CHR_TIME,e.CHR_USERNAME,c.CHR_ACTION,d.CHR_DATA,a.CHR_OBJECT,a.CHR_CPU, f.CHR_APP
                                from TT_LOG a, TT_ACTIVITY b, TM_ACTION c, TM_DATA d, TM_USER e, TM_APPLICATION f
                                where a.INT_ID_ACTIVITY=b.INT_ID_ACTIVITY and b.INT_ID_ACTION=c.INT_ID_ACTION  and d.INT_ID_APP=f.INT_ID_APP
                                and b.INT_ID_DATA=d.INT_ID_DATA and a.CHR_NPK=e.CHR_NPK and CHR_TIME > $m
                                 order by a.CHR_TIME desc" )->result();
    }

}

?>
