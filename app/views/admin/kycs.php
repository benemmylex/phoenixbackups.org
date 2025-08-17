<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            KYC Submissions
            <small>Review and manage user KYC verifications</small>
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
                        <h3 class="box-title">All KYC Submissions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Submitted</th>
                                <th>Status</th>
                                <th>Gov ID</th>
                                <th>Proof of Address</th>
                                <th>Selfie</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $s = $this->Db_model->selectGroup("*", "kyc", "ORDER BY created_at DESC");
                            if ($s->num_rows() > 0) {
                                $count = 0;
                                foreach ($s->result_array() as $row) {
                                    $count++;
                                    $user = $this->Util_model->get_user_info($row['user_id']);
                                    $email = $row['email'];
                                    $phone = $row['phone'];
                                    $status = ucfirst($row['status']);
                                    $created = date('Y-m-d H:i', strtotime($row['created_at']));
                                    $gov_id = $row['gov_id'] ? '<a href="'.base_url().'uploads/kyc/'.$row['gov_id'].'" target="_blank">View</a>' : '-';
                                    $proof_address = $row['proof_address'] ? '<a href="'.base_url().'uploads/kyc/'.$row['proof_address'].'" target="_blank">View</a>' : '-';
                                    $selfie = $row['selfie'] ? '<a href="'.base_url().'uploads/kyc/'.$row['selfie'].'" target="_blank">View</a>' : '-';
                                    $action_btns = '';
                                    if ($row['status'] == 'pending') {
                                        $action_btns = '<button class="btn btn-success btn-xs" onclick="update_kyc_status('.$row['id'].',\'approved\')">Approve</button> ';
                                        $action_btns .= '<button class="btn btn-danger btn-xs" onclick="update_kyc_status('.$row['id'].',\'rejected\')">Reject</button>';
                                    } else {
                                        $action_btns = '<span class="label label-default">No Action</span>';
                                    }
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>$user</td>
                                        <td>$email</td>
                                        <td>$phone</td>
                                        <td>$created</td>
                                        <td>$status</td>
                                        <td>$gov_id</td>
                                        <td>$proof_address</td>
                                        <td>$selfie</td>
                                        <td>$action_btns</td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='10' class='text-danger'>No KYC submission found</td>
                                </tr>
                                ";
                            }
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <small class="text-warning">NB: Slide table left on <i>mobile</i></small>
                        <script>
                        function update_kyc_status(id, status) {
                            if (!confirm('Are you sure you want to ' + status + ' this KYC?')) return;
                            $.post('<?php echo base_url('admin/update_kyc_status'); ?>', {id: id, status: status}, function(res) {
                                location.reload();
                            });
                        }
                        </script>
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