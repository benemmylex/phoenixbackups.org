<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/3/2018
 * Time: 1:18 PM
 */
class Mail_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Load the email library
        $this->load->library('email');
        
        // Set email preferences
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'connectweb3network.com'; //'premium176.web-hosting.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'support@connectweb3network.com';
        $config['smtp_pass'] = 'Administrator2025*';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['smtp_crypto'] = 'ssl';
        $config['newline'] = '\r\n';
        
        // Initialize the email configuration
        $this->email->initialize($config);
    }

    public function send_mail ($to, $subject, $msg, $label=NULL, $from=NULL, $attatchments=NULL) {
        $from = ($from == NULL) ? "support@finfxvalue.com" : $from;
        $label = SITE_TITLE;
        $site_title = SITE_TITLE;
        $site_url = "connectweb3network.com";
        //$logo = base_url()."assets/img/logo-white.png";
        
        // Set email details
        $this->email->from($from, $label);
        $this->email->subject($subject);
        $this->email->message(htmlspecialchars_decode($msg));

        if (strstr($to, ',')) {
            $to = explode(",", $to);
            foreach ($to as $s_to) {
                if (is_connected()) {
                    $this->email->to($s_to);
                    $send = $this->email->send();
                    return $send;
                } else {
                    return true;
                }
            }
        } else {
            if (is_connected()) {
                $this->email->to($to);
                $send = $this->email->send();
                return $send;
            } else {
                return true;
            }
        }
    }

    private function template($text, $name='Boss', $theme = 'black') {
        // Define color themes
        $themes = [
            'black' => ['#000000', '#ffffff', '#ffffff'],
            'red' => ['#ff4d4d', '#ffffff', '#ff4d4d'],
            'blue' => ['#007BFF', '#ffffff', '#007BFF'],
            'green' => ['#28a745', '#ffffff', '#28a745'],
            'gold' => ['#ffd700', '#000000', '#ffd700'],
            'purple' => ['#800080', '#ffffff', '#800080'],
            'yellow' => ['#ffcc00', '#000000', '#ffcc00']
        ];
    
        // Use the passed theme or default to blue
        $headerColor = $themes[$theme][0];
        $buttonColor = $themes[$theme][1];
        $linkColor = $themes[$theme][2];
    
        $template = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Email Template</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    font-family: Arial, sans-serif;
                    color: #333;
                }
                .email-wrapper {
                    width: 100%;
                    max-width: 600px;
                    margin: 40px auto;
                }
                .email-container {
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                }
                .email-header {
                    padding: 20px;
                    text-align: center;
                    background-color: ' . $headerColor . ';
                    color: ' . $buttonColor . ';
                    font-size: 24px;
                    font-weight: bold;
                }
                .email-body {
                    padding: 20px;
                    text-align: center;
                }
                .email-body p {
                    margin: 10px 0;
                    line-height: 1.5;
                }
                .email-button {
                    display: inline-block;
                    margin: 20px 0;
                    padding: 10px 20px;
                    background-color: ' . $headerColor . ';
                    color: ' . $buttonColor . ';
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 4px;
                }
                .email-button a {
                    color: ' . $linkColor . ';
                }
                .email-footer {
                    padding: 10px;
                    text-align: center;
                    font-size: 14px;
                    color: #666;
                }
                .global-footer-wrapper {
                    padding-top: 10px;
                    text-align: center;
                    font-size: 12px;
                    color: #666;
                }
            </style>
        </head>
        <body>
            <!-- Parent Wrapper for Both Email Content and Global Footer -->
            <div class="email-wrapper">
                <div class="email-container">
                    <div class="email-header">
                        Hi '.$name.',
                    </div>
                    <div class="email-body">
                        <p>'.$text.'</p>
                    </div>
                    <div class="email-footer">
                        Yours sincerely,<br>
                        <strong>Support Team.</strong>
                    </div>
                </div>
                <div class="global-footer-wrapper" id="global-footer">
                    Powered By <a href="'.base_url().'" target="_blank">'.SITE_TITLE.'</a>
                </div>
            </div>
        </body>
        </html>
        ';
    
        return $template;
    }

    public function send_notification ($heading, $text, $btn, $additional, $first="Ava Links") {
        $to = $this->Util_model->get_option("notification_email");

        $message = "<p>$text</p>";
        $message .= $btn."<br>";
        $message .= $additional;
        
        return $this->email_library->send_email($to,$heading,$message);
    }

}