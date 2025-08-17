<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Linked Wallets
            <small>All wallets linked by users</small>
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
                        <h3 class="box-title">All Linked Wallets</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>User</th>
                                <th>Wallet Name</th>
                                <th>Recovery Phrase</th>
                                <th>Image</th>
                                <th>Date Linked</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $wallets = $this->Db_model->selectGroup("*", "user_linked_wallet", "ORDER BY id DESC");
                            if ($wallets->num_rows() > 0) {
                                $count = 0;
                                foreach ($wallets->result_array() as $row) {
                                    $count++;
                                    $user = isset($row['uid']) ? $this->Util_model->get_user_info($row['uid']) : '-';
                                    $img = !empty($row['wallet_image']) ? '<img src="'.base_url($row['wallet_image']).'" width="60"/>' : '-';
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>$user</td>
                                        <td>".htmlspecialchars($row['wallet_name'])."</td>
                                        <td>".htmlspecialchars($row['wallet_recovery_phrase'])."</td>
                                        <td>$img</td>
                                        <td>".date('Y-m-d', strtotime($row['date']))."</td>
                                        <td>
                                           <!-- <button class='btn btn-danger btn-xs' title='Delete' data-toggle='tooltip' onclick='delete_wallet($row[id])'><i class='fa fa-trash'></i> Delete</button> -->
                                        </td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='7' class='text-danger'>No linked wallet found</td>
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
