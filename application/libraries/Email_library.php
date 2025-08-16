<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_library {

    protected $CI;

    public function __construct() {
        // Load the CodeIgniter instance so we can access its resources
        $this->CI =& get_instance();
        
        // Load the email library
        $this->CI->load->library('email');
        
        // Set email preferences
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'finfxvalue.com'; //'premium176.web-hosting.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'support@finfxvalue.com';
        $config['smtp_pass'] = 'Administrator2024';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['smtp_crypto'] = 'ssl';
        $config['newline'] = '\r\n';
        
        // Initialize the email configuration
        $this->CI->email->initialize($config);
    }

    // Method to send an email
    public function send_email($to, $subject, $message, $from, $label) {
        // Set email details
        $this->CI->email->from($from, $label);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        // Send the email and return the result
        if ($this->CI->email->send()) {
            return true;
        } else {
            show_error($this->CI->email->print_debugger());
            return false;
        }
    }
}

?>