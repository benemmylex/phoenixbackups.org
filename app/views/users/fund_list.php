<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fund List
            <small>All transaction history</small>
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
                    <div class="box-header">
                        <h3 class="box-title">All Transactions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table id="transTable" class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>status</th>
                                <th>Date</th>
                                <th>Payment Method (Account Details)</th>
                            </tr>
                            <?php
                            $s = $this->Db_model->selectGroup("*", "user_wallet", "WHERE creditor=".$this->session->userdata(UID)." OR debitor=".$this->session->userdata(UID)." ORDER BY id DESC");
                            if ($s->num_rows() > 0) {
                                $count = 0;
                                foreach ($s->result_array() as $row) {
                                    $count++;
                                    if ($row['status'] == 1) {
                                        $status = "<span class='label label-success'>Approved</span>";
                                    } else if ($row['status'] == 2) {
                                        $status = "<span class='label label-danger'>Denied</span>";
                                    } else {
                                        $status = "<span class='label label-warning'>Pending</span>";
                                    }
                                    if ($row['creditor'] == $this->session->userdata(UID)) {
                                        $color = "class='text-green'";
                                    } else {
                                        $color = "class='text-red'";
                                    }
                                    echo "
                                    <tr $color>
                                        <td>$count.</td>
                                        <td>$row[ref]</td>
                                        <td>\$".number_format($row['amount'], 2)."</td>
                                        <td>$status</td>
                                        <td>$row[date]</td>
                                        <td>$row[extra]</td>
                                    </tr>
                                    ";
                                }

                            } else {
                                echo "
                                <tr>
                                    <td colspan='8' class='text-danger'>No transaction found</td>
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

        <div class="row">
            <div class="col-xs-12">
                <div class="box no-border">
                    <div class="box-header">
                        <h3 class="box-title">Card Funding Transactions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>User</th>
                                <th>Card Type</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Transaction ID</th>
                                <th>Payment Proof</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            $uid = $this->session->userdata(UID);
                            $card_fundings = $this->Db_model->selectGroup("*", "user_fund_card", "WHERE  uid = $uid ORDER BY id DESC");
                            if ($card_fundings->num_rows() > 0) {
                                $count = 0;
                                foreach ($card_fundings->result_array() as $row) {
                                    $count++;
                                    $user = isset($row['uid']) ? $this->Util_model->get_user_info($row['uid']) : '-';
                                    $proof = !empty($row['payment_proof']) ? '<a href="'.base_url($row['payment_proof']).'" target="_blank">View</a>' : '-';
                                    if ($row['status'] == 1) {
                                        $status = "<span class='label label-success'>Approved</span>";
                                    } else if ($row['status'] == 2) {
                                        $status = "<span class='label label-danger'>Denied</span>";
                                    } else {
                                        $status = "<span class='label label-warning'>Pending</span>";
                                    }
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>$user</td>
                                        <td>".ucfirst($row['card_type'])."</td>
                                        <td>".ucfirst($row['payment_method'])."</td>
                                        <td>$".htmlspecialchars($row['amount'])."</td>
                                        <td>".htmlspecialchars($row['trans_id'])."</td>
                                        <td>$proof</td>
                                        <td>".date('Y-m-d', strtotime($row['date']))."</td>
                                        <td>$status</td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='9' class='text-danger'>No card funding transaction found</td>
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

        <div class="row">
            <div class="col-xs-12">
                <div class="box no-border">
                    <div class="box-header">
                        <h3 class="box-title">QFS Mobile Transactions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>User</th>
                                <th>Quantity</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Transaction ID</th>
                                <th>Payment Proof</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            $uid = $this->session->userdata(UID);
                            $card_fundings = $this->Db_model->selectGroup("*", "user_qfs_mobile", "WHERE  uid = $uid ORDER BY id DESC");
                            if ($card_fundings->num_rows() > 0) {
                                $count = 0;
                                foreach ($card_fundings->result_array() as $row) {
                                    $count++;
                                    $user = isset($row['uid']) ? $this->Util_model->get_user_info($row['uid']) : '-';
                                    $proof = !empty($row['payment_proof']) ? '<a href="'.base_url($row['payment_proof']).'" target="_blank">View</a>' : '-';
                                    if ($row['status'] == 1) {
                                        $status = "<span class='label label-success'>Approved</span>";
                                    } else if ($row['status'] == 2) {
                                        $status = "<span class='label label-danger'>Denied</span>";
                                    } else {
                                        $status = "<span class='label label-warning'>Pending</span>";
                                    }
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>$user</td>
                                        <td>".ucfirst($row['quantity'])."</td>
                                        <td>".ucfirst($row['payment_method'])."</td>
                                        <td>$".htmlspecialchars($row['amount'])."</td>
                                        <td>".htmlspecialchars($row['trans_id'])."</td>
                                        <td>$proof</td>
                                        <td>".date('Y-m-d', strtotime($row['date']))."</td>
                                        <td>$status</td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='9' class='text-danger'>No card funding transaction found</td>
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
        <!--/.row-->
    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>