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
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;     /* Firefox */
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        body::-webkit-scrollbar {
            display: none;
        }

        /* Main content wrapper */
        .main-wrapper {
            flex: 1;
            padding: 2rem 0;
            margin-top: 100px; /* Add space for fixed header */
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            max-width: 1400px;
            padding: 2rem;
            width: 100%;
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

        /* Profile Sidebar */
        .profile-sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100vh;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1031;
            display: flex;
            flex-direction: column;
        }

        .profile-sidebar.active {
            right: 0;
        }

        .user-profile-section {
            padding: 20px;
            background-color: var(--background-overlay);
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile-section img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-scrollable {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .sidebar-scrollable::-webkit-scrollbar {
            display: none;
        }

        .dropdown-header {
            padding: 0.5rem 1rem;
            margin-top: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-header i {
            color: var(--primary-color);
            width: 20px;
            text-align: center;
        }

        .dropdown-item {
            padding: 0.7rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
            text-decoration: none;
        }

        .dropdown-item i {
            color: var(--secondary-color);
            width: 20px;
            text-align: center;
        }

        .dropdown-item .fa-chevron-right {
            margin-left: auto;
            font-size: 0.8rem;
            color: #999;
        }

        /* Footer adjustments */
        footer {
            background-color: var(--primary-color);
            color: var(--text-light);
            padding: 2rem 0;
            margin-top: auto;
        }

        footer h6 {
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        footer .social-links a {
            color: var(--text-light);
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        footer .social-links a:hover {
            color: var(--accent-color);
        }

        .qr-code {
            max-width: 100px;
            transition: transform 0.3s ease;
        }

        .qr-code:hover {
            transform: scale(1.1);
        }

        /* Remove default scrollbar */
        body {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;     /* Firefox */
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        body::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for sidebar content */
        .sidebar-scrollable {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .sidebar-scrollable::-webkit-scrollbar {
            display: none;
        }

        /* Calculator Styles */
        .calculator-section {
            max-width: 900px;
            margin: 0 auto;
        }

        .calculator-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary-color);
        }

        .calculator-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .calculator-header h2 {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .calculator-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        .calculate-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.8rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
        }

        .calculate-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }

        /* Results Styles */
        .results-card {
            background: #f8f9fa;
            border-radius: 12px;
            margin-top: 2rem;
            border-left: 4px solid var(--secondary-color);
        }

        .results-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid #eee;
            background: white;
            border-radius: 12px 12px 0 0;
        }

        .results-header h4 {
            color: var(--primary-color);
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .results-body {
            padding: 1.5rem;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem;
            background: white;
            border-radius: 8px;
            margin-bottom: 0.8rem;
        }

        .result-item:last-child {
            margin-bottom: 0;
        }

        .result-label {
            color: #555;
            font-weight: 500;
        }

        .result-value {
            font-weight: 600;
            color: var(--primary-color);
        }

        .amortization-table {
            margin-top: 1.5rem;
        }

        .table {
            background: white;
            border-radius: 8px;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #e0e0e0;
            color: #555;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .table td {
            vertical-align: middle;
            color: #555;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/members">
                <img src="/images/logo.jpg" alt="KADA Logo" style="height: 40px;" class="me-2">
                <div>
                    <div class="fw-bold text-success">Koperasi Kakitangan KADA</div>
                    <div class="small text-muted">Panel Ahli</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/members">
                            <i class="fas fa-home me-1"></i> Laman Utama
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="toggleProfileSidebar(); return false;">
                            <i class="fas fa-user me-1"></i> Profil
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Sidebar -->
    <div class="profile-sidebar" id="profileSidebar">
        <div class="sidebar-content">
            <!-- User Profile Section at Top -->
            <div class="user-profile-section">
                <img src="<?= $user['profile_picture'] ?? '/images/default-avatar.png' ?>" alt="Pengguna" class="rounded-circle">
                <div class="user-info">
                    <?php
                    // Get member data from the session or database
                    $memberModel = new \App\Models\Member();
                    $memberData = $memberModel->getPendingRegistration($_SESSION['user_id']);
                    $memberName = $memberData ? htmlspecialchars($memberData['name']) : 'Nama Pengguna';
                    ?>
                    <div class="user-name"><?= $memberName ?></div>
                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Keluar</a>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="sidebar-scrollable">
                <!-- Profile Section -->
                <div class="dropdown-header">
                    <i class="fas fa-user"></i> Profil
                </div>
                <a class="dropdown-item" href="/members/profile">
                    <i class="fas fa-id-card"></i>
                    <span>Lihat Profil</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>

                <!-- Dashboard Section -->
                <div class="dropdown-header">
                    <i class="fas fa-th-large"></i> Papan Pemuka
                </div>
                <a class="dropdown-item" href="/members/dashboard">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Status Permohonan</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>

                <!-- Finance Section -->
                <div class="dropdown-header">
                    <i class="fas fa-wallet"></i> Kewangan
                </div>
                <a class="dropdown-item" href="/members/saving_acc">
                    <i class="fas fa-piggy-bank"></i>
                    <span>Akaun Simpanan</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main content wrapper -->
    <div class="main-wrapper">
        <div class="container">
            <div class="content-container">
                <!-- Main Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light main-nav">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="mainNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/members">UTAMA</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/members/m_info">MAKLUMAT</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/members/benefits">MANFAAT AHLI</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">PINJAMAN</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/members/loans">Jenis Pinjaman</a></li>
                                        <li><a class="dropdown-item" href="/members/m_loanCalc">Kalkulator Pinjaman</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/members/customerService">PERKHIDMATAN PELANGGAN</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Calculator Content -->
                <div class="calculator-section">
                    <div class="calculator-card">
                        <div class="calculator-header">
                            <h2>Kalkulator Pinjaman KADA</h2>
                        </div>
                        <div class="calculator-body">
                            <form id="loanCalculatorForm" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loan_amount" class="form-label">Jumlah Pinjaman (RM)</label>
                                            <input type="number" class="form-control" id="loan_amount" required step="500" min="500" placeholder="Contoh: 10000">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="interest_rate" class="form-label">Kadar Faedah (%)</label>
                                            <input type="number" class="form-control" id="interest_rate" value="4.2" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loan_term" class="form-label">Tempoh Pinjaman (Tahun)</label>
                                            <select class="form-select" id="loan_term" required>
                                                <option value="">Pilih tempoh</option>
                                                <option value="1">1 tahun</option>
                                                <option value="2">2 tahun</option>
                                                <option value="3">3 tahun</option>
                                                <option value="4">4 tahun</option>
                                                <option value="5">5 tahun</option>
                                                <option value="6">6 tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="calculate-btn">Kira Pinjaman</button>
                            </form>
                        </div>
                    </div>

                    <div id="calculationResults" class="results-card" style="display: none;">
                        <div class="results-header">
                            <h4>Keputusan Pengiraan</h4>
                        </div>
                        <div class="results-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="result-item">
                                        <span class="result-label">Jumlah Pinjaman</span>
                                        <span class="result-value" id="resultLoanAmount">RM 0.00</span>
                                    </div>
                                    <div class="result-item">
                                        <span class="result-label">Kadar Faedah</span>
                                        <span class="result-value">4.2%</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="result-item">
                                        <span class="result-label">Tempoh Pinjaman</span>
                                        <span class="result-value" id="resultLoanTerm">0 tahun</span>
                                    </div>
                                    <div class="result-item">
                                        <span class="result-label">Bayaran Bulanan</span>
                                        <span class="result-value" id="resultMonthlyPayment">RM 0.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="amortization-table">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-end">Principal Dibayar</th>
                                            <th class="text-end">Faedah Dibayar</th>
                                            <th class="text-end">Baki</th>
                                        </tr>
                                    </thead>
                                    <tbody id="amortizationTable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loan Information -->
                <div class="card mt-4 shadow">
                    <div class="card-body">
                        <h4 class="card-title">Maklumat Pinjaman</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-info-circle text-success me-2"></i>
                                Kadar faedah tetap pada 4.2% setahun
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-clock text-success me-2"></i>
                                Tempoh pinjaman maksimum 6 tahun
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-money-bill-wave text-success me-2"></i>
                                Jumlah pinjaman maksimum bergantung kepada kelayakan
                            </li>
                        </ul>
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
                        <i class="fas fa-phone"></i> +09-7447088 samb. 5339 @ 5312<br>
                        <i class="fas fa-envelope"></i> koperasi_kada@yahoo.com
                    </address>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Imbas QR</h6>
                    <img src="/images/qr.jpg" alt="QR Code" class="qr-code" 
                         style="max-width: 70px; cursor: pointer;" 
                         onclick="openQRModal(this.src)">
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Ikuti Kami</h6>
                    <div class="social-links">
                        <a href="https://www.facebook.com/koperasi.kada" class="text-light">
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleProfileSidebar() {
            const sidebar = document.getElementById('profileSidebar');
            sidebar.classList.toggle('active');
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('profileSidebar');
            const profileButton = document.querySelector('.nav-link[onclick*="toggleProfileSidebar"]');
            
            if (!sidebar.contains(event.target) && event.target !== profileButton && !profileButton.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });

        // Add Loan Calculator functionality
        const form = document.getElementById('loanCalculatorForm');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const loanAmount = parseFloat(document.getElementById('loan_amount').value);
            const interestRate = 4.2; // Fixed at 4.2%
            const loanTerm = parseInt(document.getElementById('loan_term').value);
            
            // Calculate total interest and monthly payment using flat rate
            const totalInterest = loanAmount * (interestRate / 100) * loanTerm;
            const totalRepayment = loanAmount + totalInterest;
            const monthlyPayment = totalRepayment / (loanTerm * 12);
            
            // Update results
            document.getElementById('resultLoanAmount').textContent = `RM ${loanAmount.toLocaleString('en-MY', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            document.getElementById('resultLoanTerm').textContent = `${loanTerm} tahun`;
            document.getElementById('resultMonthlyPayment').textContent = `RM ${monthlyPayment.toLocaleString('en-MY', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            
            // Generate amortization table
            const tableBody = document.getElementById('amortizationTable');
            tableBody.innerHTML = ''; // Clear existing rows
            
            let balance = loanAmount;
            const monthlyInterest = totalInterest / (loanTerm * 12);
            const monthlyPrincipal = monthlyPayment - monthlyInterest;
            
            for (let year = 1; year <= loanTerm; year++) {
                const annualPrincipal = monthlyPrincipal * 12;
                const annualInterest = monthlyInterest * 12;
                balance -= annualPrincipal;
                
                const row = `
                    <tr>
                        <td class="text-center">${year}</td>
                        <td class="text-end">RM ${annualPrincipal.toLocaleString('en-MY', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                        <td class="text-end">RM ${annualInterest.toLocaleString('en-MY', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                        <td class="text-end">RM ${Math.max(0, balance).toLocaleString('en-MY', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            }
            
            // Show results
            document.getElementById('calculationResults').style.display = 'block';
        });

        function openQRModal(imgSrc) {
            // Add your QR modal functionality here
        }

        function handleLogout(event) {
            event.preventDefault();
            if (typeof caches !== 'undefined') {
                caches.keys().then(names => {
                    names.forEach(name => {
                        caches.delete(name);
                    });
                });
            }
            localStorage.clear();
            sessionStorage.clear();
            window.location.replace("/logout");
        }
    </script>

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

    <!-- Update script section -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Existing profile sidebar code...

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