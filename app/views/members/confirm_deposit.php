<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengesahan Deposit - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2E7D32;    /* Dark green */
            --secondary-color: #4CAF50;  /* Medium green */
            --accent-color: #81C784;     /* Light green */
            --text-dark: #1B5E20;        /* Dark green text */
            --text-light: #E8F5E9;       /* Light green text */
            --background-overlay: rgba(255, 255, 255, 0.95);
        }

        body {
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        .main-wrapper {
            flex: 1;
            padding: 2rem 4rem;
            margin-top: 100px;
            min-height: calc(100vh - 200px);
            display: flex;
            flex-direction: column;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            width: 60%;
            padding: 2rem 4rem;
            flex: 1;
        }

        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        .transaction-card {
            width: 100%;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .transaction-header {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
            text-align: center;
        }

        .transaction-body {
            padding: 3rem 4rem;
            background: white;
        }

        .transaction-detail {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
            margin: 0.5rem 0;
        }

        .detail-label {
            color: #666;
            font-weight: 500;
            font-size: 1.1rem;
            flex: 0 0 20%;
        }

        .detail-value {
            font-weight: 600;
            text-align: right;
            font-size: 1.1rem;
            flex: 0 0 75%;
            margin-left: 2rem;
        }

        .alert {
            width: 100%;
            margin: 1.5rem auto;
            padding: 1.25rem;
            font-size: 1.1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
        }

        .d-grid {
            width: 100%;
            margin: 0 auto;
        }

        @media (max-width: 1200px) {
            .content-container {
                width: 80%;
            }
        }

        @media (max-width: 768px) {
            .content-container {
                width: 95%;
            }
            .main-wrapper {
                padding: 2rem 1rem;
            }
            .content-container {
                padding: 2rem 1rem;
            }
            .transaction-body {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <!-- Top Bar -->
        <div class="logo-section">
            <div class="container">
                <div class="row align-items-center py-2">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <img src="/images/logo.jpg" alt="Logo KADA" class="img-fluid me-3" style="max-height: 70px; width: auto;">
                            <div class="d-flex flex-column">
                                <h1 class="mb-0 fs-4 fw-bold text-success">Lembaga Kemajuan Pertanian Kemubu</h1>
                                <span class="text-secondary fs-6">KADA</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="#" id="profileButton" class="nav-link">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content wrapper -->
        <div class="main-wrapper">
            <div class="content-container">
                <div class="transaction-card">
                    <div class="transaction-header">
                        <h4 class="mb-0">Pengesahan Deposit</h4>
                    </div>
                    <div class="transaction-body">
                        <div class="transaction-details">
                            <div class="transaction-detail">
                                <span class="detail-label">No. Rujukan</span>
                                <span class="detail-value"><?= htmlspecialchars($transaction_id) ?></span>
                            </div>
                            
                            <div class="transaction-detail">
                                <span class="detail-label">Nama Ahli</span>
                                <span class="detail-value"><?= htmlspecialchars($member_name) ?></span>
                            </div>

                            <div class="transaction-detail">
                                <span class="detail-label">No. Ahli</span>
                                <span class="detail-value"><?= htmlspecialchars($member_number) ?></span>
                            </div>

                            <div class="transaction-detail">
                                <span class="detail-label">Jumlah Deposit</span>
                                <span class="detail-value">RM <?= number_format($amount, 2) ?></span>
                            </div>

                            <div class="transaction-detail">
                                <span class="detail-label">Kaedah Pembayaran</span>
                                <span class="detail-value"><?= htmlspecialchars($payment_method) ?></span>
                            </div>

                            <?php if (isset($description) && $description): ?>
                            <div class="transaction-detail">
                                <span class="detail-label">Catatan</span>
                                <span class="detail-value"><?= htmlspecialchars($description) ?></span>
                            </div>
                            <?php endif; ?>

                            <div class="transaction-detail">
                                <span class="detail-label">Tarikh & Masa</span>
                                <span class="detail-value"><?= (new DateTime($timestamp))->format('d/m/Y H:i') ?></span>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4">
                            <small>
                                <i class="fas fa-info-circle me-2"></i>
                                Baki akaun semasa: RM <?= number_format($current_balance, 2) ?>
                            </small>
                        </div>

                        <div class="d-grid gap-3 mt-4">
                            <form action="/members/confirm-deposit" method="POST">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <button type="submit" class="btn btn-primary w-100 mb-2">
                                    <i class="fas fa-check-circle me-2"></i>Sahkan Pembayaran
                                </button>
                            </form>
                            <a href="/members/saving_acc" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-times-circle me-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-light py-3">
            <div class="container">
                <div class="row justify-content-center text-center g-4">
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-2">Hubungi Kami</h6>
                        <address class="small mb-0">
                            Lembaga Kemajuan Pertanian Kemubu<br>
                            Peti Surat 127, Bandar Kota Bharu,<br>
                            15710 Kota Bharu, Kelantan<br>
                            <i class="fas fa-phone"></i> +60 97455388<br>
                            <i class="fas fa-envelope"></i> prokada@kada.gov.my
                        </address>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-2">Imbas QR</h6>
                        <img src="/images/QR.jpg" alt="QR Code" class="qr-code" style="max-width: 70px; cursor: pointer;">
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-2">Ikuti Kami</h6>
                        <div class="social-links">
                            <a href="https://www.facebook.com/kadakemubu/" class="text-light">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </div>
                        <div class="mt-2 small">
                            <small>&copy; 2023 KADA. Semua hak terpelihara.</small>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>