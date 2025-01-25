<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penyata Kewangan - KADA</title>
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
            padding-top: 120px; /* Add padding to account for fixed header */
        }

        .content-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 20px auto;
            max-width: 1400px;
        }

        .border {
            border: 1px solid #000 !important;
        }

        .table th {
            background-color: #f8f9fa;
        }
        .btn-action {
            background: #f0f0f0;
            border: none;
            color: #666;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;  
            font-weight: normal;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            margin-bottom: 40px;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .btn-action:hover {
            background: #e5e5e5;
            color: #666;
            text-decoration: none;
        }

        .btn-action i {
            margin-right: 8px;
            font-size: 0.9em;
        }

        
        .action-buttons-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding-right: 20px; 
        }

        /* Update button styles */
        .back-btn-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        /* Add header styles from benefits.php */
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
            font-size: 1rem;
        }

        /* Add footer styles from benefits.php */
        footer {
            background-color: var(--primary-color);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
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

        /* Add profile sidebar styles */
        .profile-sidebar {
            position: fixed;
            right: -300px;
            top: 0;
            width: 300px;
            height: 100vh;
            background-color: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1040;
        }

        .profile-sidebar.active {
            right: 0;
        }

        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .user-profile-section {
            padding: 1rem;
            background-color: white;
            color: #333;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-profile-section img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .user-name {
            font-weight: 500;
            color: #333;
            font-size: 1rem;
        }

        .user-info .btn-success {
            background-color: #2E7D32;
            border: none;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }

        .sidebar-scrollable {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }

        .dropdown-header {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            color: #666;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #333;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .dropdown-item .fa-chevron-right {
            margin-left: auto;
            font-size: 0.8em;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Copy header from benefits.php -->
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

    <div class="content-container">
        <!-- Back Button -->
        <a href="/members/saving_acc" class="btn btn-action">
            <i class="fas fa-arrow-left"></i>Kembali ke Halaman Utama
        </a>
    

        <!-- Member Information Box -->
        <div class="row align-items-center">
            <div class="col-3">
                <img src="/images/logo.jpg" alt="Logo" class="img-fluid" style="width: 100px; height: 100px;">
            </div>
            <div class="col-9">
                <div class="border p-3 rounded">
                    <div class="row">
                        <div class="col-9">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <label><b>NAMA: </b> <?= htmlspecialchars($member->name ?? '') ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label><b>NO. K/P: </b><?= htmlspecialchars($member->ic_no ?? '') ?></label>
                                </div>
                                <div class="col-6">
                                    <label><b>NO. PF: </b><?= htmlspecialchars($member->pf_number ?? '') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="border p-2 text-center">
                                <div class="mb-1">
                                    <label><b>NO. AHLI:</b></label>
                                </div>
                                <div>
                                    <?= htmlspecialchars($member->user_id ?? '') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p>Tuan/Puan, <br><br>
            <u>
                PENGESAHAN PENYATA KEWANGAN AHLI KOPERASI KAKITANGAN KADA KELANTAN BERHAD 
                <?php if ($reportType === 'yearly'): ?>
                    BAGI TAHUN BERAKHIR <?= htmlspecialchars($selectedYear) ?>
                <?php else: ?>
                    BAGI BULAN <?= date('F Y', strtotime($selectedMonth)) ?>
                <?php endif; ?>
            </u>
        <br><br>

        Untuk penentuan Juruaudit, kami dengan ini menyatakan bagi akaun tuan/puan adalah sebagaimana berikut: <br><br>

        
        <!-- Share Information -->
        <div class="mt-4">
            <u>MAKLUMAT SAHAM AHLI:</u>
            <div class="container mt-2">
                <div class="row">
                    <div class="col p-3 bg-white text-black">
                        <p>Modal Syer:<br><b>RM <?= number_format($account->share_capital ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Modal Yuran:<br><b>RM <?= number_format($account->fee_capital ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Simpanan Tetap:<br><b>RM <?= number_format($account->fixed_deposit ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Tabung Anggota:<br><b>RM <?= number_format($account->balance ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Simpanan Anggota:<br><b>RM <?= number_format($account->balance ?? 0, 2) ?></b></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Information -->
        <div class="mt-4">
            <u>MAKLUMAT PINJAMAN AHLI:</u>
            <div class="container mt-2">
                <div class="row">
                    <div class="col p-3 bg-white text-black">
                        <p>Pembiayaan Al Bai:<br><b>RM <?= number_format($loans->Pembiayaan_Al_Bai ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Pembiayaan Al Innah:<br><b>RM <?= number_format($loans->Pembiayaan_Al_Innah ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Pembiayaan Skim Khas:<br><b>RM <?= number_format($loans->Pembiayaan_Skim_Khas ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Pembiayaan Road Tax & Insuran:<br><b>RM <?= number_format($loans->Pembiayaan_RoadTaxInsuran ?? 0, 2) ?></b></p>
                    </div>
                    <div class="col p-3 bg-white text-black">
                        <p>Pembiayaan Al Qardhul Hasan:<br><b>RM <?= number_format($loans->Pembiayaan_Al_Qardhul_Hasan ?? 0, 2) ?></b></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-2">
            <hr class="border border-dark border-1">
        </div>

        <!-- Add empty space before the transaction history section -->
        <div style="margin-top: 100px;"></div> 

        <!-- Transaction History -->
        <div class="mt-4">
            <div class="card">
                <div class="card-header">
                    <h5>Sejarah Transaksi - <?= htmlspecialchars($displayDate ?? 'N/A') ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Tarikh</th>
                                    <th>Jenis</th>
                                    <th>Jumlah (RM)</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transactions)): ?>
                                    <?php foreach ($transactions as $transaction): ?>
                                        <tr>
                                            <td class="text-center"><?= htmlspecialchars($transaction->request_date ?? 'N/A') ?></td>
                                            <td class="text-center"><?= $transaction->transaction_type === 'deposit' ? 'Deposit' : 'Pengeluaran' ?></td>
                                            <td class="text-end"><?= number_format($transaction->amount, 2) ?></td>
                                            <td class="text-center">
                                                <?php
                                                $statusClass = match($transaction->status) {
                                                    'approved' => 'text-success',
                                                    'rejected' => 'text-danger',
                                                    default => 'text-warning'
                                                };
                                                ?>
                                                <span class="<?= $statusClass ?>">
                                                    <?= ucfirst($transaction->status) ?>
                                                </span>
                                            </td>
                                            <td class="text-center"><?= htmlspecialchars($transaction->remarks ?? 'N/A') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tiada rekod transaksi untuk <?= htmlspecialchars($displayDate ?? 'N/A') ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="margin-bottom: 50px;"></div> 
        <div class="container mt-2">
            <hr class="border border-dark border-1">
        </div>

        <!-- Add empty space before the transaction history section -->
        <div style="margin-top: 100px;"></div> 

        <!-- Loan Report Section -->
        <div class="mt-5">
            <div class="card">
                <div class="card-header">
                    <h5>Laporan Pinjaman - <?= htmlspecialchars($displayDate) ?></h5>
                </div>
                <div class="card-body">
                    <!-- Loan Summary -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-muted mb-3">Ringkasan Pinjaman</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Jenis Pinjaman</th>
                                            <th>Jumlah Pinjaman (RM)</th>
                                            <th>Tempoh (Bulan)</th>
                                            <th>Ansuran Bulanan (RM)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($loanApplications)): ?>
                                            <?php foreach ($loanApplications as $loan): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($loan['loan_type']) ?></td>
                                                    <td class="text-end"><?= number_format($loan['t_amount'], 2) ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($loan['period']) ?></td>
                                                    <td class="text-end"><?= number_format($loan['mon_installment'], 2) ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        $statusClass = match($loan['status']) {
                                                            'APPROVED' => 'text-success',
                                                            'REJECTED' => 'text-danger',
                                                            default => 'text-warning'
                                                        };
                                                        ?>
                                                        <span class="<?= $statusClass ?>">
                                                            <?= ucfirst(strtolower($loan['status'])) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Tiada rekod pinjaman untuk <?= htmlspecialchars($displayDate) ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Loan Details -->
                    <?php if (!empty($loanApplications)): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-muted mb-3">Maklumat Terperinci Pinjaman</h6>
                                <?php foreach ($loanApplications as $loan): ?>
                                    <?php 
                                    // Debug the loan status
                                    error_log("Loan status: " . $loan['status']);
                                    // Check for both uppercase and lowercase 'approved'
                                    if (strtoupper($loan['status']) === 'APPROVED' || strtolower($loan['status']) === 'approved'): 
                                    ?>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title"><?= htmlspecialchars($loan['loan_type']) ?></h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><strong>Jumlah Pinjaman:</strong> RM <?= number_format($loan['t_amount'], 2) ?></p>
                                                        <p><strong>Tempoh:</strong> <?= htmlspecialchars($loan['period']) ?> bulan</p>
                                                        <p><strong>Ansuran Bulanan:</strong> RM <?= number_format($loan['mon_installment'], 2) ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>Tarikh Kelulusan:</strong> <?= date('d/m/Y', strtotime($loan['created_at'])) ?></p>
                                                        <p><strong>Status:</strong> <span class="text-success">Diluluskan</span></p>
                                                        <?php if (!empty($loan['admin_remark'])): ?>
                                                            <p><strong>Catatan:</strong> <?= htmlspecialchars($loan['admin_remark']) ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Download Button -->
        <div class="text-end mt-3">
            <form action="/generate-pdf" method="POST" target="_blank">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($member->user_id ?? '') ?>">
                <input type="hidden" name="selected_month" value="<?= htmlspecialchars($selectedMonth ?? '') ?>">
                <input type="hidden" name="selected_year" value="<?= htmlspecialchars($selectedYear ?? '') ?>">
                <input type="hidden" name="report_type" value="<?= htmlspecialchars($reportType ?? '') ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Download Statement
                </button>
            </form>
        </div>
    </div>
    <div style="margin-bottom: 100px;"></div> 

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

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutConfirmModalLabel">Pengesahan Log Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Adakah anda pasti untuk log keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="/logout" class="btn btn-danger" onclick="clearCacheAndLogout(event)">Log Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Profile Sidebar HTML -->
    <div class="profile-sidebar" id="profileSidebar">
        <div class="sidebar-content">
            <!-- User Profile Section at Top (Fixed) -->
            <div class="user-profile-section">
                <img src="/images/default-avatar.png" alt="Pengguna" class="rounded-circle">
                <div class="user-info">
                    <div class="user-name"><?= htmlspecialchars($member->name ?? 'Nama Pengguna') ?></div>
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Keluar</a>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="sidebar-scrollable">
                <!-- Profile Section -->
                <div class="dropdown-header">
                    <i class="fas fa-user"></i>Profil
                </div>
                <a class="dropdown-item" href="/members/profile">
                    <i class="fas fa-id-card"></i>
                    <span>Lihat Profil</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>

                <!-- Dashboard Section -->
                <div class="dropdown-header">
                    <i class="fas fa-th-large"></i>Papan Pemuka
                </div>
                <a class="dropdown-item" href="/members/dashboard">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Status Permohonan</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>

                <!-- My Saving Account -->
                <div class="dropdown-header">
                    <i class="fas fa-piggy-bank"></i>Simpanan Saya
                </div>
                <a class="dropdown-item" href="/members/saving_acc">
                    <i class="fas fa-wallet"></i>
                    <span>Akaun Simpanan Saya</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Updated Profile Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const profileSidebar = document.getElementById('profileSidebar');
            
            profileButton.addEventListener('click', function(e) {
                e.preventDefault();
                profileSidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (!profileSidebar.contains(e.target) && !profileButton.contains(e.target)) {
                    profileSidebar.classList.remove('active');
                }
            });

            // Update all logout links to show confirmation modal
            const logoutLinks = document.querySelectorAll('a[href="/logout"]');
            logoutLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const logoutModal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));
                    logoutModal.show();
                });
            });
        });

        function openQRModal(imgSrc) {
            document.getElementById('modalQRImage').src = imgSrc;
            new bootstrap.Modal(document.getElementById('qrModal')).show();
        }

        function clearCacheAndLogout(event) {
            window.location.replace('/logout');
            
            if (window.history && window.history.pushState) {
                window.history.pushState('', '', '/userlogin');
                window.onpopstate = function () {
                    window.history.pushState('', '', '/userlogin');
                };
            }
            
            localStorage.clear();
            sessionStorage.clear();
            
            return true;
        }
    </script>
</body>
</html>