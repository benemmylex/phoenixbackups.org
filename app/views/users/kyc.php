<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            KYC Verification
            <small>Complete your KYC to invest securely</small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" id="msg">
                <?php echo $this->session->userdata('msg'); ?>
            </div>
        </div>
        <?php
        $kyc = $this->db->order_by('created_at', 'DESC')->get_where('kyc', ['user_id' => $this->session->userdata(UID)])->row_array();
        if ($kyc) {
            if ($kyc['status'] == 'pending') {
        ?>
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h2 class="box-title">KYC Pending</h2>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-warning">
                            <strong>Your KYC is under review.</strong><br>
                            Please contact support at <a href="mailto:<?php echo $this->Util_model->get_option('site_email'); ?>"><?php echo $this->Util_model->get_option('site_email'); ?></a> for immediate assistance.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            } elseif ($kyc['status'] == 'approved') {
        ?>
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h2 class="box-title">KYC Approved</h2>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-success">
                            <strong>Congratulations!</strong> Your KYC has been approved. You can now access all investment features.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
        ?>
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-6">
                <div class="box no-border">
                    <div class="box-header with-border">
                        <h2 class="box-title">KYC Form</h2>
                    </div>
                    <div class="box-body">
                        <form id="kycForm" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>users/submit_kyc">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control" name="full_name" placeholder="Enter your full name" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="dob" required>
                            </div>
                            <div class="form-group">
                                <label>Nationality</label>
                                <input class="form-control" name="nationality" placeholder="Enter your nationality" required>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option value="">-Select gender-</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" name="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="form-group">
                                <label>Residential Address</label>
                                <input class="form-control" name="address" placeholder="Enter your address" required>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" name="city" placeholder="Enter your city" required>
                            </div>
                            <div class="form-group">
                                <label>State/Province</label>
                                <input class="form-control" name="state" placeholder="Enter your state or province" required>
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input class="form-control" name="country" placeholder="Enter your country" required>
                            </div>
                            <div class="form-group">
                                <label>Postal/Zip Code</label>
                                <input class="form-control" name="postal_code" placeholder="Enter your postal or zip code" required>
                            </div>
                            <div class="form-group">
                                <label>Upload Government ID (Passport, National ID, or Driver's License)</label>
                                <input type="file" name="gov_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Upload Proof of Address (Utility Bill, Bank Statement, etc.)</label>
                                <input type="file" name="proof_address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Upload a Selfie (holding your ID)</label>
                                <input type="file" name="selfie" class="form-control" required>
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-flat btn-block" type="submit">Submit KYC</button>
                        </form>
                        <div class="alert alert-info top-2x bottom-2x iq-mt-20">
                            <p>Your KYC will be reviewed within 24-48 hours. You will be notified once your verification is complete. Kindly contact support at <?php echo $this->Util_model->get_option("site_email"); ?> for immediate assistance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
</div>