<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Lembaga Kemajuan Pertanian Kemubu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin: -1rem 1rem 2rem 1rem;
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

        /* Quick links adjustments */
        .quick-links {
            margin: 2rem 0;
        }

        .quick-link-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 1rem;
        }

        .quick-link-item:hover {
            transform: translateY(-5px);
        }

        .quick-link-item i {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        /* Footer adjustments */
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

        .info-label {
            color: #1a237e;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .info-content {
            background: #ffffff;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.25rem;
            border-left: 3px solid #2e7d32;
        }

        .contact-icon {
            color: #2e7d32;
            margin-right: 0.75rem;
            font-size: 1rem;
        }

        .bank-list {
            list-style: none;
            padding: 0;
        }

        .bank-list li {
            background: #ffffff;
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-radius: 6px;
            border-left: 3px solid #2e7d32;
        }

        .table-primary {
            background: #e8f5e9 !important;
        }

        .table-primary td {
            color: #1b5e20;
            font-weight: 600;
        }

        .table thead th {
            background: #f8faf8;
            color: #1b5e20;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.875rem;
            border-bottom: 2px solid #e8f5e9;
        }

        /* Profile Sidebar Styles from dashboard */
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

        .sidebar-content {
            height: 100%;
            display: flex;
            flex-direction: column;
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

        .sidebar-scrollable {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }

        .dropdown-header {
            padding: 0.5rem 1.25rem;
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            color: var(--primary-color);
        }

        .dropdown-item span {
            flex: 1;
        }

        .dropdown-item .ms-auto {
            font-size: 0.8rem;
        }

        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-success:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
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
                    <img src="/images/default-avatar.png" alt="Pengguna" class="rounded-circle">
                    <div class="user-info">
                        <?php
                        // Get member data from the session or database
                        $memberModel = new \App\Models\Member();
                        $memberData = $memberModel->getPendingRegistration($_SESSION['user_id']);
                        $memberName = $memberData ? htmlspecialchars($memberData['name']) : 'Nama Pengguna';
                        ?>
                        <div class="user-name"><?= $memberName ?></div>
                        <a href="/logout" class="btn btn-success">Log Keluar</a>
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

                <!-- Quick Links Section with Header -->
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="quick-links">
                            <!-- Section Header -->
                            <div class="section-header mb-4">
                                <h2 class="text-success fw-bold mb-2">Menu Utama</h2>
                                <p class="text-muted">
                                    Akses pantas ke fungsi-fungsi utama sistem koperasi kakitangan KADA. Pilih menu di bawah untuk mula:
                                </p>
                                <hr class="bg-success opacity-25">
                            </div>

                            <!-- Quick Links Cards -->
                            <div class="row g-4">
                                <!-- Profile Quick Link -->
                                <div class="col-md-3">
                                    <div class="quick-link-item p-4 h-100 d-flex flex-column">
                                        <div class="text-center mb-3">
                                            <i class="fas fa-user-circle fa-3x text-success"></i>
                                        </div>
                                        <h4 class="text-center mb-3">Profil Anda</h4>
                                        <div class="text-muted text-center mb-4 flex-grow-1">
                                            <p class="mb-0">Urus profil anda dan kemaskini maklumat peribadi untuk memastikan rekod anda sentiasa terkini.</p>
                                        </div>
                                        <div class="text-center mt-auto">
                                            <a href="/members/profile" class="btn btn-outline-success">
                                                <i class="fas fa-arrow-right me-2"></i>Urus Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dashboard Quick Link -->
                                <div class="col-md-3">
                                    <div class="quick-link-item p-4 h-100 d-flex flex-column">
                                        <div class="text-center mb-3">
                                            <i class="fas fa-tachometer-alt fa-3x text-success"></i>
                                        </div>
                                        <h4 class="text-center mb-3">Papan Pemuka</h4>
                                        <div class="text-muted text-center mb-4 flex-grow-1">
                                            <p class="mb-2">Semak status permohonan dan muat turun resit permohonan keahlian dan pinjaman anda di sini.</p>
                                        </div>
                                        <div class="text-center mt-auto">
                                            <a href="/members/dashboard" class="btn btn-outline-success">
                                                <i class="fas fa-arrow-right me-2"></i>Lihat Status
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Savings Account Quick Link -->
                                <div class="col-md-3">
                                    <div class="quick-link-item p-4 h-100 d-flex flex-column">
                                        <div class="text-center mb-3">
                                            <i class="fas fa-piggy-bank fa-3x text-success"></i>
                                        </div>
                                        <h4 class="text-center mb-3">Akaun Simpanan</h4>
                                        <div class="text-muted text-center mb-4 flex-grow-1">
                                            <p class="mb-0">Urus kewangan anda dengan mudah. Semak baki, buat deposit, dan urus transaksi anda.</p>
                                        </div>
                                        <div class="text-center mt-auto">
                                            <a href="/members/saving_acc" class="btn btn-outline-success">
                                                <i class="fas fa-arrow-right me-2"></i>Urus Kewangan
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Loans Quick Link -->
                                <div class="col-md-3">
                                    <div class="quick-link-item p-4 h-100 d-flex flex-column">
                                        <div class="text-center mb-3">
                                            <i class="fas fa-hand-holding-usd fa-3x text-success"></i>
                                        </div>
                                        <h4 class="text-center mb-3">Pembiayaan</h4>
                                        <div class="text-muted text-center mb-4 flex-grow-1">
                                            <p class="mb-0">Terokai pelbagai pilihan pembiayaan yang tersedia untuk memenuhi keperluan anda.</p>
                                        </div>
                                        <div class="text-center mt-auto">
                                            <a href="/members/loans" class="btn btn-outline-success">
                                                <i class="fas fa-arrow-right me-2"></i>Mohon Pembiayaan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Application Options Modal -->
                <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="applicationModalLabel">Pilih Halaman</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p class="mb-4">Sila pilih salah satu pilihan di bawah untuk meneruskan:</p>
                                <a href="/members/loans" class="btn btn-primary w-100 mb-2" style="font-size: 1.1rem; padding: 0.75rem;">Jenis Pinjaman</a>
                                <a href="/members/profile" class="btn btn-secondary w-100" style="font-size: 1.1rem; padding: 0.75rem;">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer stays outside wrapper -->
    <footer class="bg-dark text-light py-3" id="contactInfo">
        <div class="container">
            <div class="row justify-content-center text-center g-4">
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Hubungi Kami</h6>
                    <address class="small mb-0">
                        D/A Lembaga Kemajuan Pertanian Kemubu<br>
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

    <!-- Bootstrap JS and dependencies -->
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

    <script>
        // Update all logout links to show confirmation modal
        document.addEventListener('DOMContentLoaded', function() {
            const logoutLinks = document.querySelectorAll('a[href="/logout"]');
            logoutLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const logoutModal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));
                    logoutModal.show();
                });
            });
        });

        // Function to clear cache and handle logout
        function clearCacheAndLogout(event) {
            // Clear browser cache
            window.location.replace('/logout');
            
            // Prevent browser back button
            if (window.history && window.history.pushState) {
                window.history.pushState('', '', '/userlogin');
                window.onpopstate = function () {
                    window.history.pushState('', '', '/userlogin');
                };
            }
            
            // Clear localStorage if any
            localStorage.clear();
            
            // Clear sessionStorage
            sessionStorage.clear();
            
            return true;
        }
    </script>

        <!-- Add QR Modal -->
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

    <!-- Add QR click handler script -->
    <script>
    function openQRModal(imgSrc) {
        document.getElementById('modalQRImage').src = imgSrc;
        new bootstrap.Modal(document.getElementById('qrModal')).show();
    }
    </script>
</body>
</html>