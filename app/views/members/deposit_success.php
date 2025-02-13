<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berjaya - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .success-card {
            max-width: 600px;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .success-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
            text-align: center;
        }
        .success-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }
        .transaction-amount {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 1rem 0;
        }
        .success-body {
            padding: 2rem;
            background: white;
            border-radius: 0 0 15px 15px;
        }
        .transaction-detail {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }
        .transaction-detail:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #666;
            font-weight: 500;
        }
        .detail-value {
            font-weight: 600;
            text-align: right;
        }
        .merchant-info {
            text-align: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #eee;
        }
        .merchant-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .btn-download {
            background: #28a745;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }
        .btn-download:hover {
            background: #218838;
        }
        .btn-back {
            background: #6c757d;
            border: none;
            padding: 1rem;
        }
        .success-message {
            color: #28a745;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        .reference-number {
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-family: monospace;
            font-size: 1.1rem;
        }
        .timestamp {
            color: #666;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="success-card">
            <div class="success-header">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="mb-2">TRANSAKSI BERJAYA</h4>
                <div class="transaction-amount">
                    RM <?= number_format($amount, 2) ?>
                </div>
            </div>
            <div class="success-body">
                <div class="merchant-info">
                    <div class="merchant-name">KOPERASI ANGGOTA KADA</div>
                    <div>Deposit Akaun Simpanan</div>
                </div>

                <div class="success-message text-center mb-4">
                    <i class="fas fa-check-circle me-2"></i>Transaksi anda telah berjaya diproses
                </div>

                <div class="transaction-details">
                    <div class="transaction-detail">
                        <span class="detail-label">No. Rujukan</span>
                        <span class="detail-value reference-number"><?= $transaction_id ?></span>
                    </div>

                    <div class="transaction-detail">
                        <span class="detail-label">Jenis Transaksi</span>
                        <span class="detail-value">Deposit</span>
                    </div>

                    <div class="transaction-detail">
                        <span class="detail-label">Kaedah Pembayaran</span>
                        <span class="detail-value"><?= ucfirst($payment_method) ?></span>
                    </div>

                    <div class="transaction-detail">
                        <span class="detail-label">Tarikh & Masa</span>
                        <span class="detail-value"><?= (new DateTime($timestamp))->format('d/m/Y H:i') ?></span>
                    </div>

                    <?php if (isset($remarks) && $remarks): ?>
                    <div class="transaction-detail">
                        <span class="detail-label">Catatan</span>
                        <span class="detail-value"><?= htmlspecialchars($remarks) ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="alert alert-light border mt-4">
                    <div class="text-center">
                        <small class="text-muted">Sila simpan No. Rujukan untuk rujukan masa hadapan</small>
                    </div>
                </div>

                <div class="d-grid gap-3 mt-4">
                    <a href="/members/saving_acc" class="btn btn-secondary btn-back">
                        <i class="fas fa-home me-2"></i>Kembali ke Akaun Simpanan
                    </a>
                </div>

                <div class="timestamp text-center mt-4">
                    <small class="text-muted">
                        <?= (new DateTime())->format('d/m/Y H:i') ?>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 