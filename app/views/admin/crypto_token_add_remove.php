<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fund Account
            <small>Fund your account in less than 3 minutes</small>
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

        <div class="row">
            <div class="col-xs-12">
                <div class="box no-border">
                    <div class="box-header with-border">
                        <h2 class="box-title">
                            Create or Add Crypto Token
                        </h2>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <?php echo form_open(base_url() . "admin/" . $url); ?>
                            <div class="form-group">
                                <label>Long name</label>
                                <input class="form-control" required value="<?php echo $long_name; ?>" name="long_name" placeholder="Enter the crypto long name e.g Bitcoin">
                            </div>
                            <div class="form-group">
                                <label>Short name</label>
                                <input class="form-control" required value="<?php echo $short_name; ?>" name="short_name" placeholder="Enter the crypto short name e.g BTC">
                            </div>
                            <div class="form-group">
                                <label>Network</label>
                                <input class="form-control" required value="<?php echo $network; ?>" name="network" placeholder="Enter the crypto network e.g TRC20, BEP20">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" required value="<?php echo $address; ?>" name="address" placeholder="Enter the crypto wallet address e.g 0x123...abc">
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-flat btn-block" type="submit">Continue</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>