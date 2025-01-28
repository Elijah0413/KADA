<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Kalkulator Pinjaman</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2E7D32;    /* Dark green */
            --secondary-color: #4CAF50;  /* Medium green */
            --accent-color: #81C784;     /* Light green */
            --text-dark: #1B5E20;        /* Dark green text */
            --text-light: #E8F5E9;       /* Light green text */
            --background-overlay: rgba(255, 255, 255, 0.95); /* Light overlay */
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Main content wrapper */
        .main-wrapper {
            flex: 1;
            padding: 2rem 0 2rem 0;  /* Added bottom padding */
            margin-top: 100px;
            display: flex;
            flex-direction: column;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;    /* Restored full border radius */
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            max-width: 1400px;
            padding: 2rem;
            width: 100%;
            flex: 1;
        }

        /* Header adjustments */
        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        .logo-section h1 {
            color: var(--primary-color);
            line-height: 1.2;
        }

        .logo-section .text-secondary {
            color: var(--secondary-color) !important;
        }

        /* Navigation adjustments */
        .main-nav {
            background-color: var(--primary-color);
            border-radius: 8px;
            margin: -1rem 0 2rem 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .main-nav .nav-link {
            color: var(--text-light) !important;
            padding: 1rem 1.5rem !important;
            font-weight: 400;
            transition: all 0.3s ease;
        }

        .main-nav .nav-link:hover {
            background-color: var(--secondary-color);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 4px;
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }

        /* Calculator specific styles */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-control {
            padding: 0.75rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .calculation-results {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e9ecef;
        }

        .alert-success {
            background-color: #e8f5e9;
            border-color: #c8e6c9;
            color: var(--text-dark);
        }

        .table {
            margin-top: 2rem;
        }

        .table th {
            background-color: #f8f9fa;
            color: var(--text-dark);
            font-weight: 600;
        }

        /* Footer adjustments */
        footer {
            background-color: var(--primary-color);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
            width: 100%;
            margin-top: 2rem;      /* Added margin-top */
            padding: 1.5rem 0;
        }

        footer h6 {
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        footer address {
            font-size: 0.85rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        footer .social-links a {
            background: rgba(255,255,255,0.1);
            padding: 0.4rem;
            border-radius: 50%;
            margin: 0 0.3rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        footer .social-links a:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        footer .qr-code {
            transition: transform 0.3s ease;
        }

        footer .qr-code:hover {
            transform: scale(1.05);
        }
         /* Login button */
         .btn-outline-light {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Modal styles */
        .modal-content {
            border: none;
            border-radius: 8px;
        }

        .modal-body {
            padding: 2rem;
        }

        .btn-secondary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 2rem;
        }

        .btn-secondary:hover {
            background-color: var(--secondary-color);
        }

        /* Container consistency */
        .container {
            max-width: 1400px;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
            margin: 0 auto;
            padding-bottom: 1rem;  /* Added bottom padding */
        }

        .navbar > .container {
            padding-left: 1rem;  /* Add consistent padding */
            padding-right: 1rem;
        }
    </style>
</head>
<body>
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
                    <a href="/userlogin" class="btn btn-outline-light">
                        <i class="fas fa-sign-in-alt me-2"></i>Log Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content wrapper -->
    <div class="main-wrapper">
        <div class="content-container">
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light main-nav">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/">UTAMA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/info_user">MAKLUMAT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/benefits_user">MANFAAT AHLI</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">PINJAMAN</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/loan_user">Jenis Pinjaman</a></li>
                                    <li><a class="dropdown-item" href="/loan_calculator">Kalkulator Pinjaman</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="showLoginMessage(event)">PERKHIDMATAN PELANGGAN</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Calculator Content -->
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="card shadow">
                            <div class="card-header">
                                <h3 class="card-title mb-0 text-center">Kalkulator Pinjaman</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/loanCalculator" class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <label for="loan_amount" class="form-label">Jumlah Pinjaman (RM)</label>
                                            <input type="number" class="form-control" id="loan_amount" name="loan_amount" required step="500" min="500" placeholder="Contoh: 10000" value="<?php echo isset($_POST['loan_amount']) ? htmlspecialchars($_POST['loan_amount']) : ''; ?>">
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="interest_rate" class="form-label">Kadar Faedah (%)</label>
                                            <input type="number" class="form-control" id="interest_rate" name="interest_rate" required step="0.01" min="0" placeholder="Contoh: 3.0" value="<?php echo isset($_POST['interest_rate']) ? htmlspecialchars($_POST['interest_rate']) : ''; ?>">
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="loan_term" class="form-label">Tempoh Pinjaman (Tahun)</label>
                                            <input type="number" class="form-control" id="loan_term" name="loan_term" required min="1" placeholder="Contoh: 5" value="<?php echo isset($_POST['loan_term']) ? htmlspecialchars($_POST['loan_term']) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Kira Pinjaman</button>
                                    </div>
                                </form>

                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && 
                                    isset($_POST['loan_amount']) && 
                                    isset($_POST['interest_rate']) && 
                                    isset($_POST['loan_term'])) {
                                    
                                    // Validate inputs
                                    $loan_amount = filter_var($_POST['loan_amount'], FILTER_VALIDATE_FLOAT);
                                    $interest_rate = filter_var($_POST['interest_rate'], FILTER_VALIDATE_FLOAT);
                                    $loan_term = filter_var($_POST['loan_term'], FILTER_VALIDATE_INT);
                                    
                                    if ($loan_amount === false || $interest_rate === false || $loan_term === false) {
                                        echo '<div class="alert alert-danger mt-3">Sila masukkan nilai yang sah.</div>';
                                    } else {
                                        // Calculate using flat rate method
                                        $total_profit = $loan_amount * ($interest_rate / 100) * $loan_term;
                                        $total_repayment = $loan_amount + $total_profit;
                                        $monthly_repayment = $total_repayment / ($loan_term * 12);
                                    
                                        // Round to 2 decimal places for currency
                                        $monthly_repayment = round($monthly_repayment, 2);

                                        // Display the summary results
                                        echo '<div class="calculation-results">
                                                <div class="alert alert-success">
                                                    <h4 class="alert-heading mb-4">Keputusan Pengiraan</h4>
                                                    <div class="row g-4">
                                                        <div class="col-sm-6">
                                                            <p class="mb-2"><strong>Jumlah Pinjaman:</strong><br>
                                                            <span class="fs-5">RM ' . number_format($loan_amount, 2) . '</span></p>
                                                            <p class="mb-2"><strong>Kadar Faedah:</strong><br>
                                                            <span class="fs-5">' . $interest_rate . '%</span></p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p class="mb-2"><strong>Tempoh Pinjaman:</strong><br>
                                                            <span class="fs-5">' . $loan_term . ' tahun</span></p>
                                                            <p class="mb-2"><strong>Bayaran Bulanan:</strong><br>
                                                            <span class="fs-5 text-primary">RM ' . number_format($monthly_repayment, 2) . '</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Tahun</th>
                                                                <th class="text-center">Principal Dibayar</th>
                                                                <th class="text-center">Faedah Dibayar</th>
                                                                <th class="text-center">Baki</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                        
                                        // For the amortization table
                                        $balance = $loan_amount;
                                        $annual_principal = 0;
                                        $annual_interest = 0;
                                        
                                        // Calculate yearly amortization
                                        for ($year = 1; $year <= $loan_term; $year++) {
                                            $annual_principal = 0;
                                            $annual_interest = 0;
                                            
                                            // Calculate monthly payments for each year
                                            for ($month = 1; $month <= 12; $month++) {
                                                // Monthly interest is total profit divided by total months
                                                $interest_payment = $total_profit / ($loan_term * 12);
                                                $principal_payment = $monthly_repayment - $interest_payment;
                                                
                                                $annual_principal += $principal_payment;
                                                $annual_interest += $interest_payment;
                                                $balance -= $principal_payment;
                                            }
                                            
                                            echo '<tr>
                                                    <td>' . $year . '</td>
                                                    <td>RM ' . number_format($annual_principal, 2) . '</td>
                                                    <td>RM ' . number_format($annual_interest, 2) . '</td>
                                                    <td>RM ' . number_format(max(0, $balance), 2) . '</td>
                                                  </tr>';
                                        }
                                        
                                        echo '</tbody>
                                            </table>
                                        </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-3" id="contactInfo">
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
                    <img src="/images/QR.jpg" alt="QR Code" class="qr-code" 
                         style="max-width: 70px; cursor: pointer;" 
                         onclick="openQRModal(this.src)">
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

    <!-- Modals and Scripts -->
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-body text-center p-4">
                    <i class="fas fa-info-circle text-success mb-3" style="font-size: 2rem;"></i>
                    <h5 class="mb-3">Notis</h5>
                    <p class="mb-4">Sila log masuk untuk menggunakan fungsi ini.</p>
                    <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <img src="" id="modalQRImage" class="img-fluid" alt="QR Code Large">
                    <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function showLoginMessage(event) {
        event.preventDefault();
        new bootstrap.Modal(document.getElementById('loginModal')).show();
    }

    function openQRModal(imgSrc) {
        document.getElementById('modalQRImage').src = imgSrc;
        new bootstrap.Modal(document.getElementById('qrModal')).show();
    }
    </script>
</body>
</html>