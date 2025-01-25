<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Permohonan Pinjaman - KOPERASI KAKITANGAN KADA KELANTAN BHD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Senarai Permohonan Pinjaman</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No. Rujukan</th>
                            <th>Tarikh Mohon</th>
                            <th>Jumlah (RM)</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loans as $loan): ?>
                        <tr>
                            <td><?= $loan['id'] ?></td>
                            <td><?= date('d/m/Y', strtotime($loan['created_at'])) ?></td>
                            <td><?= number_format($loan['t_amount'], 2) ?></td>
                            <td>
                                <span class="badge bg-<?= getStatusColor($loan['status']) ?>">
                                    <?= getStatusText($loan['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="/loan/view/<?= $loan['id'] ?>" class="btn btn-sm btn-info">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php
function getStatusText($status) {
    switch($status) {
        case 'pending':
            return 'Dalam Proses';
        case 'approved':
            return 'Diluluskan';
        case 'rejected':
            return 'Ditolak';
        default:
            return 'Tidak Diketahui';
    }
}

function getStatusColor($status) {
    switch($status) {
        case 'pending':
            return 'warning';
        case 'approved':
            return 'success';
        case 'rejected':
            return 'danger';
        default:
            return 'secondary';
    }
}
?>
