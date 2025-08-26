<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fund Card
            <small>Order and fund your debit/credit card</small>
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
                        <h2 class="box-title">Card Types</h2>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <iframe src="<?php echo base_url(); ?>cards-template"
                                style="width:99%; height: 400px; border: none;">
                            </iframe>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button id="orderCardBtn" class="btn btn-success btn-flat btn-lg" style="margin-top:20px;"><i class="fa fa-download"></i> Order Card</button>
                            </div>
                        </div>
                        <style>
                            .custom-card {
                                width: 100%;
                                max-width: 220px;
                                height: 140px;
                                border-radius: 18px;
                                color: #fff;
                                margin: 0 auto 10px auto;
                                padding: 18px 18px 10px 18px;
                                position: relative;
                                box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.18);
                                font-family: 'Segoe UI', Arial, sans-serif;
                                overflow: hidden;
                                display: flex;
                                flex-direction: column;
                                justify-content: space-between;
                                background: linear-gradient(135deg, #b9932f 0%, #f2e09f 100%);
                            }

                            .platinum-card {
                                background: linear-gradient(135deg, #b8b8b8 0%, #e6e6e6 100%);
                                color: #222;
                            }

                            .gold-card {
                                background: linear-gradient(135deg, #b9932f 0%, #f2e09f 100%);
                            }

                            .card-chip {
                                width: 36px;
                                height: 24px;
                                background: #e0c36b;
                                border-radius: 6px;
                                margin-bottom: 10px;
                                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
                            }

                            .platinum-card .card-chip {
                                background: #d1d1d1;
                            }

                            .card-logo {
                                position: absolute;
                                bottom: 16px;
                                right: 18px;
                                display: flex;
                                align-items: center;
                            }

                            .mc-circle {
                                display: inline-block;
                                width: 28px;
                                height: 28px;
                                border-radius: 50%;
                                background: #f79e1b;
                                margin-right: -10px;
                                border: 2px solid #fff;
                            }

                            .mc-right {
                                background: #eb001b;
                                margin-right: 0;
                            }

                            .card-type {
                                font-size: 1.1em;
                                font-weight: 600;
                                margin-bottom: 2px;
                            }

                            .card-amount {
                                font-size: 1.2em;
                                font-weight: 700;
                                margin-bottom: 8px;
                            }

                            .card-user {
                                font-size: 1em;
                                font-weight: 400;
                                letter-spacing: 1px;
                                margin-top: 18px;
                            }

                            .card-project {
                                font-size: 0.95em;
                                font-weight: 600;
                                letter-spacing: 1px;
                                margin-bottom: 2px;
                                color: #fffbe6;
                                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
                            }

                            .platinum-card .card-project {
                                color: #222;
                                text-shadow: none;
                            }
                        </style>
                    </div>
                    <!-- Step 1 Modal: Select Card Type -->
                    <div class="modal fade" id="selectCardTypeModal" tabindex="-1" role="dialog" aria-labelledby="selectCardTypeModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="selectCardTypeModalLabel">Select Card Type</h4>
                                </div>
                                <div class="modal-body">
                                    <select class="form-control" id="modal_card_type">
                                        <option value="">-Select card type-</option>
                                        <option value="gold">Gold Virtual Card ($<?php echo $this->Util_model->get_option("gold_card_wallet_amount"); ?>)</option>
                                        <option value="silver">Silver Virtual Card ($<?php echo $this->Util_model->get_option("silver_card_wallet_amount"); ?>)</option>
                                        <option value="platinum">Platinum Virtual Card ($<?php echo $this->Util_model->get_option("platinum_card_wallet_amount"); ?>)</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="cardTypeNextBtn">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step 2 Modal: Payment QR -->
                    <div class="modal fade" id="paymentQRModal" tabindex="-1" role="dialog" aria-labelledby="paymentQRModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="paymentQRModalLabel">Make Payment</h4>
                                </div>
                                <div class="modal-body">
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
                                                var cryptoShortName = selectElement.id.split('-')[0];
                                                var cryptoGroup = <?php echo json_encode($grouped_cryptos); ?>;
                                                var selectedCrypto = cryptoGroup[cryptoShortName].find(c => c.network === selectedNetwork);
                                                if (selectedCrypto) {
                                                    document.getElementById(cryptoShortName + '-address').innerText = selectedCrypto.address;
                                                    document.getElementById(cryptoShortName + '-address-text').innerText = selectedCrypto.address;
                                                    document.getElementById(cryptoShortName + '-img').src = "https://api.qrserver.com/v1/create-qr-code/?data=" + selectedCrypto.address + "&size=150x150";
                                                }
                                            }
                                        </script>
                                        <?php
                                        foreach ($grouped_cryptos as $crypto_group) {
                                            $crypto = $crypto_group[0]; ?>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="box no-border">
                                                    <div class="box-header with-border">
                                                        <h3 class="text-center">Pay With <?php echo $crypto['long_name']; ?> (<?php echo $crypto['short_name']; ?>)</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <img id="<?php echo $crypto['short_name']; ?>-img" src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $crypto['address']; ?>&amp;size=150x150" width="150" height="150" class="center-block">
                                                        <div class="well top-2x text-center">
                                                            <p class="no-display" id="<?php echo $crypto['short_name']; ?>-address"><?php echo $crypto['address']; ?></p>
                                                            <p class="text-bold">Wallet Address</p>
                                                            <span id="<?php echo $crypto['short_name']; ?>-address-text">
                                                                <?php echo $crypto['address']; ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!-- Select Wallet Address Network -->
                                                    <div class="form-group">
                                                        <label>Select Wallet Address Network</label>
                                                        <!-- on network select should change the address -->
                                                        <select id="<?php echo $crypto['short_name']; ?>-select" class="form-control" name="network" required onchange="updateAddress(this)">
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

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="iHavePaidBtn">I have Paid</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="paymentFormSectionModal" tabindex="-1" role="dialog" aria-labelledby="selectCardTypeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="paymentQRModalLabel">Submit Payment Detail</h4>
            </div>
            <div class="modal-body">
                <div id="paymentFormSection">
                    <form id="fundCardForm" method="post" enctype="multipart/form-data"
                        action="<?php echo base_url(); ?>home/fund_card">
                        <div class="form-group">
                            <label>Select Payment Method</label>
                            <select class="form-control" name="payment_method" id="payment_method">
                                <option class="">-Select payment method-</option>
                                <option class="usdt">USDT</option>
                                <option class="Bitcoin">Bitcoin</option>
                                <option class="Etherium">Ethereum</option>
                                <option class="Ripple">Ripple (XRP)</option>
                                <option class="Stella">Stella (XLM)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Card Type</label>
                            <select class="form-control" name="card_type" id="card_type" required>
                                <option value="">-Select card type-</option>
                                <option value="gold">Gold Virtual Card ($<?php echo $this->Util_model->get_option("gold_card_wallet_amount"); ?>)</option>
                                <option value="silver">Silver Virtual Card ($<?php echo $this->Util_model->get_option("silver_card_wallet_amount"); ?>)</option>
                                <option value="platinum">Platinum Virtual Card ($<?php echo $this->Util_model->get_option("platinum_card_wallet_amount"); ?>)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input class="form-control" name="trans_id" placeholder="Enter transaction ID"
                                autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Amount (USD)</label>
                            <input class="form-control" name="amount" placeholder="Enter the amount in USD"
                                autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Attach Payment Proof (optional):</label>
                            <input type="file" name="payment_proof" class="form-control">
                        </div>
                        <hr>
                        <button class="btn btn-primary btn-flat btn-block" type="submit">Submit Card
                            Funding</button>
                    </form>
                    <div class="alert alert-info top-2x bottom-2x iq-mt-20">
                        <p>Your card will be processed within 24 hours after payment confirmation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        // Step 1: Order Card button
        $('#orderCardBtn').on('click', function() {
            $('#selectCardTypeModal').modal('show');
        });
        // Step 2: Card type selection
        $('#cardTypeNextBtn').on('click', function() {
            if ($('#modal_card_type').val()) {
                $('#card_type').val($('#modal_card_type').val())
                $('#selectCardTypeModal').modal('hide');
                setTimeout(function() {
                    $('#paymentQRModal').modal('show');
                }, 400);
            } else {
                $('#modal_card_type').focus();
            }
        });
        // Step 3: I have Paid
        $('#iHavePaidBtn').on('click', function() {
            $('#paymentQRModal').modal('hide');
            setTimeout(function() {
                $('#paymentFormSectionModal').modal('show');
            }, 400);
        });
    });
</script>