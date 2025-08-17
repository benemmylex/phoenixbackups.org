<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quantum Finance System Mobile Phone
            <small>Order a qfs mobile phone with quantum encryption</small>
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
                        <h2 class="box-title">VERTU Quantum Flip: Exclusive Luxury Phone with Quantum Encryption</h2>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <img src="<?php echo base_url(); ?>assets/img/qfs_mobile.jpeg" alt="QFS Mobile" class="img-responsive center-block" style="width:80%; border: none;" />
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button id="orderCardBtn" class="btn btn-success btn-flat btn-lg" style="margin-top:20px;"><i class="fa fa-download"></i> Order Mobile</button>
                            </div>
                        </div>
                    </div>
                    <!-- Step 1 Modal: Select Card Type -->
                    <div class="modal fade" id="selectCardTypeModal" tabindex="-1" role="dialog" aria-labelledby="selectCardTypeModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="selectCardTypeModalLabel">How many Quantum Finance Mobile Phones would you like to order?</h4>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" name="quantity" id="modal_quantity" placeholder="Enter quantity"
                                        autocomplete="off" value="1" required>
                                    <div>You will pay <i class="fa fa-usd"></i> <span id="modal_total_price"><?php echo $this->Util_model->get_option('qfs_mobile_amount'); ?></span></div>
                                    <div class="alert alert-info top-2x bottom-2x iq-mt-20">
                                        Please note that each mobile phone comes with quantum encryption for enhanced security.
                                    </div>
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
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="box no-border">
                                                <div class="box-header with-border">
                                                    <h3 class="text-center">Pay With USDT</h3>
                                                </div>
                                                <div class="box-body">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $this->Util_model->get_option("usdt_address"); ?>&amp;size=150x150" width="150" height="150" class="center-block">
                                                    <div class="well top-2x text-center">
                                                        <p class="no-display" id="usdt-address"><?php echo $this->Util_model->get_option("usdt_address"); ?></p>
                                                        <p class="text-bold">Wallet Address</p>
                                                        <?php echo $this->Util_model->get_option("usdt_address"); ?>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard($(this), $('#usdt-address'))"><i class='fa fa-copy'></i> Click To Copy Address</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="box no-border">
                                                <div class="box-header with-border">
                                                    <h3 class="text-center">Pay With Bitcoin</h3>
                                                </div>
                                                <div class="box-body">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $this->Util_model->get_option("btc_address"); ?>&amp;size=150x150" width="150" height="150" class="center-block">
                                                    <div class="well top-2x text-center">
                                                        <p class="no-display" id="btc-address"><?php echo $this->Util_model->get_option("btc_address"); ?></p>
                                                        <p class="text-bold">Wallet Address</p>
                                                        <?php echo $this->Util_model->get_option("btc_address"); ?>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard($(this), $('#btc-address'))"><i class='fa fa-copy'></i> Click To Copy Address</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="box no-border">
                                                <div class="box-header with-border">
                                                    <h3 class="text-center">Pay With Ethereum</h3>
                                                </div>
                                                <div class="box-body">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $this->Util_model->get_option("eth_address"); ?>&amp;size=150x150" width="150" height="150" class="center-block">
                                                    <div class="well top-2x text-center">
                                                        <p class="no-display" id="eth-address"><?php echo $this->Util_model->get_option("eth_address"); ?></p>
                                                        <p class="text-bold">Wallet Address</p>
                                                        <?php echo $this->Util_model->get_option("eth_address"); ?>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard($(this), $('#eth-address'))"><i class='fa fa-copy'></i> Click To Copy Address</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="box no-border">
                                                <div class="box-header with-border">
                                                    <h3 class="text-center">Pay With Ripple (XRP)</h3>
                                                </div>
                                                <div class="box-body">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $this->Util_model->get_option("xrp_address"); ?>&amp;size=150x150" width="150" height="150" class="center-block">
                                                    <div class="well top-2x text-center">
                                                        <p class="no-display" id="xrp-address"><?php echo $this->Util_model->get_option("xrp_address"); ?></p>
                                                        <p class="text-bold">Wallet Address</p>
                                                        <?php echo $this->Util_model->get_option("xrp_address"); ?>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard($(this), $('#xrp-address'))"><i class='fa fa-copy'></i> Click To Copy Address</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="box no-border">
                                                <div class="box-header with-border">
                                                    <h3 class="text-center">Pay With Stella (XLM)</h3>
                                                </div>
                                                <div class="box-body">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $this->Util_model->get_option("xlm_address"); ?>&amp;size=150x150" width="150" height="150" class="center-block">
                                                    <div class="well top-2x text-center">
                                                        <p class="no-display" id="xlm-address"><?php echo $this->Util_model->get_option("xlm_address"); ?></p>
                                                        <p class="text-bold">Wallet Address</p>
                                                        <?php echo $this->Util_model->get_option("xlm_address"); ?>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard($(this), $('#xlm-address'))"><i class='fa fa-copy'></i> Click To Copy Address</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="box no-border">
                    <div class="box-header with-border">
                        <h3 class="text-center">Pay With Perfect Money</h3>
                    </div>
                    <div class="box-body">
                        <img src="<?php echo base_url(); ?>assets/img/cryptocurrency/pm.png" class="center-block">
                        <div class="well top-2x text-center">
                            <p class="no-display" id="pm-address">1NAwNogPNeu8AXS2Sm1MbZcQ9GLbZv9z00</p>
                            <p class="text-bold">Wallet Address</p>
                            1NAwNogPNeu8AXS2Sm1MbZcQ9GLbZv9z00
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard($(this), $('#pm-address'))"><i class='fa fa-copy'></i> Click To Copy Address</button>
                    </div>
                </div>
            </div>-->
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
                        action="<?php echo base_url(); ?>home/qfs_mobile">
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
                            <label>Quantity</label>
                            <input class="form-control" name="quantity" id="quantity" placeholder="Enter quantity"
                                autocomplete="off" value="1" required>
                        </div>
                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input class="form-control" name="trans_id" placeholder="Enter transaction ID"
                                autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Actual Deposited Amount (USD)</label>
                            <input class="form-control" type="number" name="amount" placeholder="Enter the amount in USD"
                                autocomplete="off" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label>Attach Payment Proof (optional):</label>
                            <input type="file" name="payment_proof" class="form-control">
                        </div>
                        <hr>
                        <button class="btn btn-primary btn-flat btn-block" type="submit">Book Mobile</button>
                    </form>
                    <div class="alert alert-info top-2x bottom-2x iq-mt-20">
                        <p>Your shipping will be processed within 24 hours after payment confirmation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        // Get the unit price from PHP
        var unitPrice = parseFloat('<?php echo $this->Util_model->get_option('qfs_mobile_amount'); ?>');

        // Update total price when quantity changes
        $('#modal_quantity').on('input change', function() {
            var qty = parseInt($(this).val(), 10);
            if (isNaN(qty) || qty < 1) qty = 1;
            var total = (unitPrice * qty).toFixed(2);
            $('#modal_total_price').text(total);
        });


        // Step 1: Order Card button
        $('#orderCardBtn').on('click', function() {
            $('#selectCardTypeModal').modal('show');
        });
        // Step 2: Card type selection
        $('#cardTypeNextBtn').on('click', function() {
            if ($('#modal_quantity').val()) {
                $('#quantity').val($('#modal_quantity').val())
                $('#selectCardTypeModal').modal('hide');
                setTimeout(function() {
                    $('#paymentQRModal').modal('show');
                }, 400);
            } else {
                $('#modal_quantity').focus();
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