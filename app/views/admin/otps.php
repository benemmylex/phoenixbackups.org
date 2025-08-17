<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Withdrawal OTPs
            <small>View and manage withdrawal OTPs for users</small>
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
                        <h3 class="box-title">All Withdrawal OTPs</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>OTP</th>
                                <th>Expires At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $s = $this->Db_model->selectGroup("*", "user_otp", "ORDER BY expires_at DESC");
                            if ($s->num_rows() > 0) {
                                $count = 0;
                                foreach ($s->result_array() as $row) {
                                    $count++;
                                    $user = $this->Util_model->get_user_info($row['uid']);
                                    $email = $this->Util_model->get_user_info($row['uid'], 'email', 'profile');
                                    $otp = $row['otp'];
                                    $expires = date('Y-m-d H:i', strtotime($row['expires_at']));
                                    $status = $row['used'] ? '<span class="label label-default">Used</span>' : (strtotime($row['expires_at']) < time() ? '<span class="label label-danger">Expired</span>' : '<span class="label label-success">Active</span>');
                                    $action_btns = '';
                                    if (!$row['used'] && strtotime($row['expires_at']) > time()) {
                                        $action_btns = '<form method="post" action="'.base_url('admin/generate_withdrawal_otp').'" style="display:inline;"><input type="hidden" name="uid" value="'.$row['uid'].'"><button class="btn btn-xs btn-primary" type="submit">Regenerate OTP</button></form>';
                                    } else {
                                        $action_btns = '<form method="post" action="'.base_url('admin/generate_withdrawal_otp').'" style="display:inline;"><input type="hidden" name="uid" value="'.$row['uid'].'"><button class="btn btn-xs btn-success" type="submit">Generate OTP</button></form>';
                                    }
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>$user</td>
                                        <td>$email</td>
                                        <td>$otp</td>
                                        <td>$expires</td>
                                        <td>$status</td>
                                        <td>$action_btns</td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='7' class='text-danger'>No OTP found</td>
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

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-slide/bootstrap-slider.min.js"></script>
<script>
    $(document).ready(function () {
        $('.amt-slider').slider({
            formatter: function(value) {
                return 'Current value: ' + value;
            }
        });
    });
</script>