   
<?php

/**
 * Created by PhpStorm.
 * User: testing
 * Date: 8/15/2019
 * Time: 12:57 AM
 */
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->Util_model->log_redirect();
        if (!$this->session->has_userdata(A_UID) || $this->session->userdata(A_UID) != $this->session->userdata(UID)) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
        </ol>
        ';
        $this->load->model('users/Users_model', 'users');
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "users";
        $data['main_content'] = 'admin/users';
        $this->load->view('layouts/main', $data);
    }


    public function wallets()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-bitcoin"></i> Wallets</a></li>
        </ol>
        ';
        $this->load->model('users/Users_model', 'users');
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "wallets";
        $data['main_content'] = 'admin/wallets';
        $this->load->view('layouts/main', $data);
    }


    public function cards()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-credit-card"></i> Cards</a></li>
        </ol>
        ';
        $this->load->model('users/Users_model', 'users');
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "cards";
        $data['main_content'] = 'admin/cards';
        $this->load->view('layouts/main', $data);
    }

    public function crypto_tokens()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-bitcoin"></i> Crypto Tokens</a></li>
        </ol>
        ';
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "crypto_tokens";
        $data['main_content'] = 'admin/crypto_tokens';
        $this->load->view('layouts/main', $data);
    }

    public function crypto_token_edit()
    {
        $id = $this->input->get("id");
        /* if post method perform token update */
        if ($this->input->post()) {
            $data = [
                'long_name' => $this->input->post("long_name"),
                /* short_name should be uppercased */
                'short_name' => strtoupper($this->input->post("short_name")),
                /* network should be uppercased */
                'network' => strtoupper($this->input->post("network")),
                'address' => $this->input->post("address"),
            ];
            /* catch possible update error and set_flashdata if any */
            if ($this->db->where('id', $id)->update('crypto_token', $data)) {
                $this->session->set_flashdata('success', 'Token updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update token.');
            }
            return redirect(base_url() . "admin/crypto_tokens");
        }

        if (empty($id) || !is_numeric($id) || $this->Util_model->row_count("crypto_token", "WHERE id='$id'") == 0) {
            return redirect(base_url() . "admin/crypto_tokens");
        }

        $token = $this->db->where('id', $id)->get('crypto_token')->row();
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-bitcoin"></i> Crypto Tokens</a></li>
        </ol>
        ';
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "crypto_tokens";
        $data['url'] = "crypto_token_edit?id=" . $id;
        $data['long_name'] = $token->long_name;
        $data['short_name'] = $token->short_name;
        $data['network'] = $token->network;
        $data['address'] = $token->address;
        $data['main_content'] = 'admin/crypto_token_add_remove';
        $this->load->view('layouts/main', $data);
    }

    public function crypto_token_delete()
    {
        $id = $this->input->get("id");

        if (!empty($id) && is_numeric($id) && $this->Util_model->row_count("crypto_token", "WHERE id='$id'") > 0) {
            $this->db->where('id', $id)->delete('crypto_token');
            $this->session->set_flashdata('success', 'Token deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete token.');
        }

        return redirect(base_url() . "admin/crypto_tokens");
    }

    public function crypto_token_add()
    {
        /* if post method perform token creation */
        if ($this->input->post()) {
            $data = [
                'long_name' => $this->input->post("long_name"),
                /* short_name should be uppercased */
                'short_name' => strtoupper($this->input->post("short_name")),
                /* network should be uppercased */
                'network' => strtoupper($this->input->post("network")),
                'address' => $this->input->post("address"),
            ];
            /* catch possible error and set_flashdata if any */
            if ($this->db->insert('crypto_token', $data)) {
                $this->session->set_flashdata('success', 'Token added successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to add token.');
            }
            return redirect(base_url() . "admin/crypto_tokens");
        }

        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-bitcoin"></i> Crypto Tokens</a></li>
        </ol>
        ';
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "crypto_tokens";
        $data['url'] = "crypto_token_add";
        $data['long_name'] = "";
        $data['short_name'] = "";
        $data['network'] = "";
        $data['address'] = "";
        $data['main_content'] = 'admin/crypto_token_add_remove';
        $this->load->view('layouts/main', $data);
    }

    public function kycs()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-key"></i> KYCs</a></li>
        </ol>
        ';
        $this->load->model('users/Users_model', 'users');
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "kycs";
        $data['main_content'] = 'admin/kycs';
        $this->load->view('layouts/main', $data);
    }

    public function otps()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-key"></i> OTPs</a></li>
        </ol>
        ';
        // Load OTPs from the database
        $data['otps'] = $this->db->order_by('created_at', 'DESC')->get('user_otp')->result();
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "otps";
        $data['main_content'] = 'admin/otps';
        $this->load->view('layouts/main', $data);
    }

    public function transactions()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-exchange"></i> Transaction</a></li>
        </ol>
        ';
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "transactions";
        $data['main_content'] = 'admin/transactions';
        $this->load->view('layouts/main', $data);
    }

    public function options()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-gear"></i> Options</a></li>
        </ol>
        ';
        $data['tab'] = "options";
        $data['main_content'] = 'admin/options';
        $this->load->view('layouts/main', $data);
    }

    public function options_save()
    {
        $this->form_validation->set_rules("referral_bonus", "Referral bonus", "trim|numeric");
        $this->form_validation->set_rules("btc_address", "Bitcoin address", "trim");
        $this->form_validation->set_rules("eth_address", "Binance address", "trim");
        $this->form_validation->set_rules("usdt_address", "USDT address", "trim");
        $this->form_validation->set_rules("xrp_address", "Ripple (XRP) address", "trim");
        $this->form_validation->set_rules("xlm_address", "Stellar (XLM) address", "trim");
        $this->form_validation->set_rules("gold_card_wallet_amount", "Gold Virtual Card Wallet Amount", "trim|numeric");
        $this->form_validation->set_rules("silver_card_wallet_amount", "Silver Virtual Card Wallet Amount", "trim|numeric");
        $this->form_validation->set_rules("platinum_card_wallet_amount", "Platinum Virtual Card Wallet Amount", "trim|numeric");
        $this->form_validation->set_rules("qfs_mobile_amount", "QFS Mobile Amount", "trim|numeric");
        //$this->form_validation->set_rules("gold_card_wallet", "Gold Virtual Card Wallet", "trim");
        //$this->form_validation->set_rules("platinum_card_wallet", "Platinum Virtual Card Wallet", "trim");

        $this->form_validation->set_rules("bank_name", "Bank name", "trim");
        $this->form_validation->set_rules("account_name", "Account name", "trim");
        $this->form_validation->set_rules("account_number", "Account number", "trim");
        $this->form_validation->set_rules("account_type", "Bank branch", "trim");
        $this->form_validation->set_rules("branch", "Branch", "trim");
        $this->form_validation->set_rules("beneficiary_reference", "Beneficiary reference", "trim|numeric");

        //$this->form_validation->set_rules("pm_account", "Perfect Money account number", "trim");

        if ($this->form_validation->run() == true) {
            $this->Db_model->update("options", ["value" => $this->input->post("referral_bonus")], "WHERE name='referral_bonus'");
            $this->Db_model->update("options", ["value" => $this->input->post("btc_address")], "WHERE name='btc_address'");
            $this->Db_model->update("options", ["value" => $this->input->post("eth_address")], "WHERE name='eth_address'");
            $this->Db_model->update("options", ["value" => $this->input->post("usdt_address")], "WHERE name='usdt_address'");
            $this->Db_model->update("options", ["value" => $this->input->post("xrp_address")], "WHERE name='xrp_address'");
            $this->Db_model->update("options", ["value" => $this->input->post("xlm_address")], "WHERE name='xlm_address'");
            $this->Db_model->update("options", ["value" => $this->input->post("gold_card_wallet_amount")], "WHERE name='gold_card_wallet_amount'");
            $this->Db_model->update("options", ["value" => $this->input->post("silver_card_wallet_amount")], "WHERE name='silver_card_wallet_amount'");
            $this->Db_model->update("options", ["value" => $this->input->post("platinum_card_wallet_amount")], "WHERE name='platinum_card_wallet_amount'");
            $this->Db_model->update("options", ["value" => $this->input->post("qfs_mobile_amount")], "WHERE name='qfs_mobile_amount'");
            //$this->Db_model->update("options", ["value" => $this->input->post("gold_card_wallet")], "WHERE name='gold_card_wallet'");
            //$this->Db_model->update("options", ["value" => $this->input->post("platinum_card_wallet")], "WHERE name='platinum_card_wallet'");

            $this->Db_model->update("options", ["value" => $this->input->post("bank_name")], "WHERE name='bank_name'");
            $this->Db_model->update("options", ["value" => $this->input->post("account_name")], "WHERE name='account_name'");
            $this->Db_model->update("options", ["value" => $this->input->post("account_number")], "WHERE name='account_number'");
            $this->Db_model->update("options", ["value" => $this->input->post("account_type")], "WHERE name='account_type'");
            $this->Db_model->update("options", ["value" => $this->input->post("branch")], "WHERE name='branch'");
            $this->Db_model->update("options", ["value" => $this->input->post("beneficiary_reference")], "WHERE name='beneficiary_reference'");
            //$this->Db_model->update("options", ["value" => $this->input->post("pm_account")], "WHERE name='pm_account'");
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Options updated successfully", "alert-success", 1));
        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        redirect(base_url() . "admin/options");
    }

    public function bot_transactions()
    {
        $this->Main_model->bot_transaction();
        echo true;
    }

    public function add_bonus()
    {
        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("amount", "Amount", "required|trim");

        if ($this->form_validation->run() == TRUE) {
            if ($this->Util_model->row_count("user_profile", "WHERE username='$_POST[username]'") > 0) {
                $uid = $this->Util_model->get_info("user_profile", "uid", "WHERE username='$_POST[username]'");
                if ($this->Main_model->add_to_wallet($this->input->post("amount"), $uid, 0, "Account top up", "Account top up", "Bonus", "", "", 1)['return']) {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-checks-circle'></i> Bonus added successfully", "alert-success", 1));
                }
            } else {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> The user with that username doesn't exist", "alert-danger", 1));
            }
        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-money"></i> Add bonus</a></li>
        </ol>
        ';
        $data['tab'] = "bonus";
        $data['main_content'] = 'admin/add_bonus';
        $this->load->view('layouts/main', $data);
    }

    public function newsletter()
    {
        $this->form_validation->set_rules("receiver", "Receiver", "required|trim");
        $this->form_validation->set_rules("subject", "Subject", "required|trim");

        if ($this->form_validation->run() == TRUE) {
            $btn_href = (empty($this->input->post("button_href"))) ? base_url() : $this->input->post("button_href");
            $btn_text = (empty($this->input->post("button_label"))) ? "Visit Our Site" : $this->input->post("button_label");
            $markups = array(
                "[TEXT]" => $this->input->post("message"),
                "[BUTTON]" => "<a href='$btn_href'>$btn_text</a>",
                "[NAME]" => (empty($this->input->post("name"))) ? "Sir/Madam" : $this->input->post("name"),
                "[ADDITIONAL_TEXT]" => $this->input->post("additional_text")
            );

            $recipient = rtrim(trim($this->input->post('receiver')), ',');
            $label = (empty($this->input->post("label"))) ? SITE_TITLE : $this->input->post("label");
            if (strstr($recipient, ",")) {
                $success = 0;
                $recipient = explode(",", $recipient);
                foreach ($recipient as $to) {
                    if ($this->Mail_model->send_mail($to, $this->input->post("subject"), $markups, $label)) {
                        $success++;
                    }
                }
                if ($success == count($recipient)) {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-check-circle'></i> Message sent successfully to $success emails", "alert-success", 1));
                } else if ($success > 0) {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Message sent to only $success out of " . count($recipient), "alert-danger", 1));
                } else {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Error sending message. Please try again", "alert-danger", 1));
                }
            } else {
                if ($this->Mail_model->send_mail($recipient, $this->input->post("subject"), $markups, $label)) {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-check-circle'></i> Message sent successfully", "alert-success", 1));
                } else {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Error sending message", "alert-danger", 1));
                }
            }
        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-envelope"></i> Newsletter</a></li>
        </ol>
        ';
        $data['style'] = "<link href='https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css' rel='stylesheet'>";
        $data['tab'] = "newsletter";
        $data['main_content'] = 'admin/newsletter';
        $this->load->view('layouts/main', $data);
    }


    // AJAX: Update KYC status (approve/reject)
    public function update_kyc_status()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if (!$id || !in_array($status, ['approved', 'rejected'])) {
            echo json_encode(['success' => false, 'msg' => 'Invalid request']);
            return;
        }
        $this->db->where('id', $id);
        $this->db->update('kyc', [
            'status' => $status,
            'reviewed_at' => date('Y-m-d H:i:s'),
            'reviewed_by' => $this->session->userdata(UID)
        ]);
        echo json_encode(['success' => true]);
    }

    // Generate and send withdrawal OTP to a user
    public function generate_withdrawal_otp($uid = null)
    {
        if (!$uid) {
            $uid = $this->input->post('uid');
        }
        if (!$uid) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">User ID required.</div>');
            redirect(base_url('admin/kycs'));
            return;
        }
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));
        // Invalidate previous unused OTPs
        $this->db->where(['uid' => $uid, 'used' => 0])->update('user_otp', ['used' => 1]);
        // Save new OTP
        $this->db->insert('user_otp', [
            'uid' => $uid,
            'otp' => $otp,
            'expires_at' => $expires_at,
            'used' => 0
        ]);
        // Email OTP to user
        $email = $this->Util_model->get_user_info($uid, 'email', 'profile');
        $name = $this->Util_model->get_user_info($uid);
        $msg = "<p>Dear $name,</p><p>Your withdrawal OTP is: <strong>$otp</strong></p><p>This OTP is valid for 10 minutes. If you did not request this, please contact support immediately.</p>";
        $this->Mail_model->send_mail($email, 'Withdrawal OTP', $msg);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">OTP generated and sent to user email.</div>');
        redirect(base_url('admin/otps'));
    }
}

?>