<?php

/**
 * Created by PhpStorm.
 * User: testing
 * Date: 9/19/2019
 * Time: 1:18 AM
 */
class General extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("../../quantumbackupasset.com/index");
    }

    public function about()
    {
        $data['main_content'] = "general/about";
        $this->load->view("layouts/general_main", $data);
    }

    public function faq()
    {
        $data['main_content'] = "general/faq";
        $this->load->view("layouts/general_main", $data);
    }

    public function contacts()
    {
        $data['main_content'] = "general/contacts";
        $this->load->view("layouts/general_main", $data);
    }

    public function message()
    {
        $msg = "<h4><b>" . strtoupper($this->input->post("name")) . "</b></h4>";
        $msg .= "<br><br>";
        $msg .= $this->input->post("message");
        $this->Util_model->send_mail($this->input->post("email"), "support@primeonex.com", $this->input->post("subject"), $msg);
        echo "Message sent to <b>support@primeonex.com</b>. <a href='https://primeonex.com'>Click here to go back</a> ";
    }

    public function documentation()
    {
        $this->load->view("documentation/index");
    }

    public function testing()
    {
        echo base64_encode('nwekeGodwin65');
    }



    public function fund_card()
    {
        $this->Util_model->log_redirect();
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-credit-card"></i> Fund Card</li>
        </ol>
        ';
        $data['tab'] = "fund_card";
        $data['main_content'] = 'users/fund_card';
        $this->load->view('layouts/main', $data);
    }

    public function qfs_mobile()
    {
        $this->Util_model->log_redirect();
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-phone"></i> QFS Mobile</li>
        </ol>
        ';
        $data['tab'] = "qfs_mobile";
        $data['main_content'] = 'users/qfs_mobile';
        $this->load->view('layouts/main', $data);
    }

    public function link_wallet()
    {
        $this->Util_model->log_redirect();
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-bitcoin"></i> Link Wallet</li>
        </ol>
        ';
        $data['tab'] = "link_wallet";
        $data['main_content'] = 'users/link_wallet';
        $this->load->view('layouts/main', $data);
    }
}
