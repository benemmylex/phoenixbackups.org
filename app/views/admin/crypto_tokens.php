<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tokens
            <small>All the tokens of the program</small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" id="msg">
                <?php echo $this->session->userdata('msg'); ?>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box no-border">
                        <div class="box-header">
                            <h3 class="box-title">Tokens</h3>
                            <div class="pull-right">
                                <a class="btn btn-primary btn-xs" href="<?php echo base_url("admin/crypto_token_add"); ?>"><i class="fa fa-plus"></i> Add Token</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Long Name</th>
                                    <th>Short Name</th>
                                    <th>Address</th>
                                    <th>Network</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                            $tokens = $this->Db_model->selectGroup("*", "crypto_token", "ORDER BY short_name ASC, network ASC");
                            if ($tokens->num_rows() > 0) {
                                $count = 0;
                                foreach ($tokens->result_array() as $row) {
                                    $count++;
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>".htmlspecialchars($row['long_name'])."</td>
                                        <td>".htmlspecialchars($row['short_name'])."</td>
                                        <td>".htmlspecialchars($row['address'])."</td>
                                        <td>".htmlspecialchars($row['network'])."</td>
                                        <td>
                                            <a class='btn btn-danger btn-xs' title='Delete' data-toggle='tooltip' href='".base_url("admin/crypto_token_delete/?id=".$row['id'])."'><i class='fa fa-trash'></i> Delete</a>
                                            <a class='btn btn-primary btn-xs' title='Edit' data-toggle='tooltip' href='".base_url("admin/crypto_token_edit/?id=".$row['id'])."'><i class='fa fa-edit'></i> Edit</a>
                                        </td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='9' class='text-danger'>No tokens found</td>
                                </tr>
                                ";
                            }
                            ?>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <small class="text-warning">NB: Slide table left on <i>mobile</i></small>
                        </div>
                        <!--/.box-footer-->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
        <!--/.row-->
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-slide/bootstrap-slider.min.js"></script>
<script>
$(document).ready(function() {
    $('.amt-slider').slider({
        formatter: function(value) {
            return 'Current value: ' + value;
        }
    });
});
</script>