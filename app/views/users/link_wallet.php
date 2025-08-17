<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Link Wallet
            <small>Link your crypto wallet to your account</small>
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
                    <div class="box-header with-border row">
                        <div class="col-xs-6">
                            <h2 class="box-title">View Linked Wallets</h2>
                        </div>
                        <div class="col-xs-6">
                            <button class="btn btn-success btn-flat btn-block" type="button" id="openLinkWalletModal"><i class="fa fa-plus"></i> Save Wallet</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Wallet Name</th>
                                        <th>Recovery Phrase</th>
                                        <th>Image</th>
                                        <th>Date Linked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $uid = $this->session->userdata(UID);
                                    $wallets = $this->Db_model->selectGroup("*", "user_linked_wallet", "WHERE uid = $uid ORDER BY id DESC");
                                    if ($wallets->num_rows() > 0): ?>
                                        <?php foreach ($wallets->result_array() as $i => $wallet): ?>
                                            <tr>
                                                <td><?= $i + 1; ?></td>
                                                <td><?= htmlspecialchars($wallet['wallet_name']); ?></td>
                                                <td>
                                                    <span class="masked-recovery" style="letter-spacing:2px;">**** **** ****</span>
                                                    <span class="real-recovery" style="display:none;"><?= htmlspecialchars($wallet['wallet_recovery_phrase']); ?></span>
                                                    <button type="button" class="btn btn-xs btn-default toggle-recovery" style="margin-left:5px;">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
</section>
<script>
    $(document).ready(function() {
        $('#openLinkWalletModal').on('click', function() {
            $('#linkWalletModal').modal('show');
        });
        // Mask/unmask recovery phrase per row
        $('.table').on('click', '.toggle-recovery', function() {
            var $row = $(this).closest('td');
            var $masked = $row.find('.masked-recovery');
            var $real = $row.find('.real-recovery');
            var $icon = $(this).find('i');
            if ($real.is(':visible')) {
                $real.hide();
                $masked.show();
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                $real.show();
                $masked.hide();
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
</script>
                                                <td>
                                                    <?php if (!empty($wallet['wallet_image'])): ?>
                                                        <img src="<?= base_url($wallet['wallet_image']); ?>" width="60" />
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= date('Y-m-d', strtotime($wallet['date'])); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No wallets linked yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Link New Wallet -->
        <div class="modal fade" id="linkWalletModal" tabindex="-1" role="dialog" aria-labelledby="linkWalletModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="linkWalletModalLabel">Link New Wallet</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart(base_url() . "home/link_wallet"); ?>
                        <div class="form-group">
                            <label>Wallet Name:</label>
                            <input class="form-control" name="wallet_name" placeholder="e.g. My MetaMask, TrustWallet" required>
                        </div>
                        <div class="form-group">
                            <label>Recovery Phrase:</label>
                            <textarea class="form-control" name="wallet_recovery_phrase" placeholder="Enter wallet recovery phrase" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Attach Image (optional):</label>
                            <input type="file" name="wallet_image" class="form-control">
                        </div>
                        <button class="btn btn-primary btn-flat btn-block" type="submit">Proceed and Link Wallet</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#openLinkWalletModal').on('click', function() {
                $('#linkWalletModal').modal('show');
            });
        });
    </script>
    </section>
</div>