<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Options
            <small>Set up options</small>
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
                    <div class="box-body table-responsive top-pad-3x bottom-pad-3x">
                        <?php echo form_open(base_url()."admin/options-save"); ?>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Referral bonus</label>
                                <input class="form-control" name="referral_bonus" type="number" value="5">
                            </div><!-- 
                            <div class="form-group">
                                <label>Bitcoin address</label>
                                <input class="form-control" name="btc_address" type="text" value="<?php echo $this->Util_model->get_option('btc_address'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Ethereum address</label>
                                <input class="form-control" name="eth_address" type="text" value="<?php echo $this->Util_model->get_option('eth_address'); ?>">
                            </div>
                            <div class="form-group">
                                <label>USDT address</label>
                                <input class="form-control" name="usdt_address" type="text" value="<?php echo $this->Util_model->get_option('usdt_address'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Ripple (XRP) address</label>
                                <input class="form-control" name="xrp_address" type="text" value="<?php echo $this->Util_model->get_option('xrp_address'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Stella (XLM) address</label>
                                <input class="form-control" name="xlm_address" type="text" value="<?php echo $this->Util_model->get_option('xlm_address'); ?>">
                            </div> -->
                            <div class="form-group">
                                <label>Gold Virtual Card Wallet Amount</label>
                                <input class="form-control" name="gold_card_wallet_amount" type="text" value="<?php echo $this->Util_model->get_option('gold_card_wallet_amount'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Silver Virtual Card Wallet Amount</label>
                                <input class="form-control" name="silver_card_wallet_amount" type="text" value="<?php echo $this->Util_model->get_option('silver_card_wallet_amount'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Platinum Virtual Card Wallet Amount</label>
                                <input class="form-control" name="platinum_card_wallet_amount" type="text" value="<?php echo $this->Util_model->get_option('platinum_card_wallet_amount'); ?>">
                            </div>
                            <div class="form-group">
                                <label>QFS Mobile Amount</label>
                                <input class="form-control" name="qfs_mobile_amount" type="text" value="<?php echo $this->Util_model->get_option('qfs_mobile_amount'); ?>">
                            </div>
                            <!-- <div class="form-group">
                                <label>Gold Virtual Card Wallet</label>
                                <input class="form-control" name="gold_card_wallet" type="text" value="<?php echo $this->Util_model->get_option('gold_card_wallet'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Platinum Virtual Card Wallet</label>
                                <input class="form-control" name="platinum_card_wallet" type="text" value="<?php echo $this->Util_model->get_option('platinum_card_wallet'); ?>">
                            </div> -->
                            <div class="form-group">
                                <label>Perfect Money Account Number</label>
                                <input class="form-control" name="pm_account" type="text" value="<?php echo $this->Util_model->get_option('pm_account'); ?>">
                            </div>
                            <button class="btn btn-success btn-block" type="submit">Save Options</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.row-->
    </section>
</div>