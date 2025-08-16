<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/28/2017
 * Time: 5:24 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public function register($inputs)
    {
        $success = 0;

        $success += ($this->Db_model->insert("user_main", $inputs['main'])) ? 1 : 0;
        $success += ($this->Db_model->insert("user_profile", $inputs['profile'])) ? 1 : 0;

        if ($success == 2) {
            $pro = $inputs['profile'];
            if ($pro['ref_id'] != 0)
                $this->General_model->award_point($pro['ref_id'], 'referral');
            return true;
        } else {
            $main = $inputs['main'];
            $this->db->where("uid", $main['uid']);
            $this->db->delete(array("user_main", "user_profile"));
            return false;
        }
    }

    public function login($inputs)
    {
        $q = $this->Db_model->selectGroup("*", "user_profile", "WHERE email='$inputs[user]'");
        if ($q->num_rows() == 0) {
            $return = 0;
        } else {
            $pro = $q->row_array();
            if ($pro['password'] != $inputs['pass']) {
                $return = 0;
            } else {
                $main = $this->Db_model->select("*", "user_main", "WHERE uid=$pro[uid]");
                switch ($main['status']) {
                    case '0':
                        $_SESSION['email'] = $pro['email'];
                        $return = 1;
                        break;
                    case '1':
                        $_SESSION[UID] = $pro['uid'];
                        $return = 2;
                        break;
                    case '2':
                        $return = 3;
                        break;
                }
            }
        }
        return $return;
    }

    public function lockscreen () {
        $protocol = (strstr($_SERVER['SERVER_PROTOCOL'],"HTTPS")) ? "HTTPS://" : "HTTP://";
        set_flashdata('redirect',$protocol.get_url());
        redirect(base_url().'associate/lock');
    }

    public function unlockscreen ($passkey) {
        //$passkey = md5($passkey);
        if ($this->Util_model->row_count("associates_main","WHERE uid=".get_sessdata(UID)." AND passkey='$passkey'") == 1) {
            set_tempdata(A_UID,get_sessdata(UID),(15*60));
            redirect(base_url()."associate");
        }
    }

    public function check_associate () {
        if ($this->Util_model->row_count("associates_main","WHERE uid=".get_sessdata(UID)) == 1) {
            if (!is_tempdata(A_UID)) {
                if (!strstr($_SERVER['REQUEST_URI'],'lock')) {
                    $this->lockscreen();
                }
            } else {
                set_tempdata(A_UID,get_sessdata(UID),(15*60));
            }
        } else {
            redirect(base_url()."base");
        }
    }

    public function sign_out($redirect=true)
    {
        drop_sess(UID);
        drop_tempdata(UID);
        drop_tempdata(A_UID);
        session_destroy();

        if (!$redirect) {
            redirect(base_url()."sign-in");
        }
    }

}