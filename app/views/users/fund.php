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
        <!-- Info boxes -->
        <div class="row">
            <?php

            $cryptos = $this->db->get('crypto_token')->result_array();
            /* 
            Group cryptos by short_name 
            */
            $grouped_cryptos = [];
            foreach ($cryptos as $crypto) {
                $grouped_cryptos[$crypto['short_name']][] = $crypto;
            }
            ?>
            <script>
                function updateAddress(selectElement) {
                    var selectedNetwork = selectElement.value;
                    var cryptoShortName = selectElement.closest('.box').querySelector('h3').innerText.split(' ')[2];
                    var cryptoGroup = <?php echo json_encode($grouped_cryptos); ?>;
                    var selectedCrypto = cryptoGroup[cryptoShortName].find(c => c.network === selectedNetwork);
                    if (selectedCrypto) {
                        document.getElementById(cryptoShortName + '-address').innerText = selectedCrypto.address;
                        document.querySelector('.box img').src = "https://api.qrserver.com/v1/create-qr-code/?data=" + selectedCrypto.address + "&size=150x150";
                    }
                }
            </script>
            <?php
            foreach ($grouped_cryptos as $crypto_group) {
                $crypto = $crypto_group[0]; ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box no-border">
                        <div class="box-header with-border">
                            <h3 class="text-center">Pay With <?php echo $crypto['short_name']; ?></h3>
                        </div>
                        <div class="box-body">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $crypto['address']; ?>&amp;size=150x150" width="150" height="150" class="center-block">
                            <div class="well top-2x text-center">
                                <p class="no-display" id="<?php echo $crypto['short_name']; ?>-address"><?php echo $crypto['address']; ?></p>
                                <p class="text-bold">Wallet Address</p>
                                <?php echo $crypto['address']; ?>
                            </div>
                        </div>
                        <!-- Select Wallet Address Network -->
                        <div class="form-group">
                            <label>Select Wallet Address Network</label>
                            <!-- on network select should change the address -->
                            <select class="form-control" name="network" required onchange="updateAddress(this)">
                                <option value="">-Select Network-</option>
                                <!-- each crypto_group -->
                                <?php foreach ($crypto_group as $crypto) { ?>
                                    <option value="<?php echo $crypto['network']; ?>"><?php echo $crypto['network']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard($(this), $('#<?php echo $crypto['short_name']; ?>-address'))"><i class='fa fa-copy'></i> Click To Copy Address</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div> <!--/.row-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box no-border">
                    <div class="box-header with-border">
                        <h2 class="box-title">
                            Account Funding Form <small>Make sure to fill immediately after payment</small>
                        </h2>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <?php echo form_open(base_url() . "home/book_funding"); ?>
                            <div class="form-group">
                                <label>Select Payment Method</label>
                                <select class="form-control" name="method">
                                    <option class="">-Select payment method-</option>
                                    <option class="usdt">USDT</option>
                                    <option class="Bitcoin">Bitcoin</option>
                                    <option class="Etherium">Ethereum</option>
                                    <option class="Ripple">Ripple (XRP)</option>
                                    <option class="Stella">Stella (XLM)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Transaction ID</label>
                                <input class="form-control" name="trans_id" placeholder="Enter transaction ID" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Amount (USD)</label>
                                <input class="form-control" name="amount" placeholder="Enter the amount in USD" autocomplete="off">
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-flat btn-block" type="submit">Book Funding</button>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="col-xs-12">
                            <div class="alert alert-info top-2x bottom-2x">
                                <p>Your funded amount will be credited within 12 hours of booking</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>