<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Skim Pembiayaan Ahli</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2E7D32;
            --secondary-color: #4CAF50;
            --accent-color: #81C784;
            --text-dark: #1B5E20;
            --text-light: #E8F5E9;
            --background-overlay: rgba(255, 255, 255, 0.95);
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

        /* Hide scrollbar for sidebar content */
        .sidebar-scrollable {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .sidebar-scrollable::-webkit-scrollbar {
            display: none;
        }

        /* Profile Sidebar Styles */
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

        /* Main content wrapper */
        .main-wrapper {
            flex: 1;
            padding: 2rem 0;
            margin-top: 100px;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            max-width: 1400px;
            padding: 2rem;
        }

        /* Modern Loan Cards */
        .loans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }

        .loan-container {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }

        .loan-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .loan-title {
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .loan-features {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
        }

        .loan-features li {
            padding: 0.5rem 0;
            color: #555;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .loan-features li i {
            color: var(--secondary-color);
            font-size: 0.8rem;
        }

        .button-group {
            display: flex;
            gap: 0.75rem;
        }

        .learn-more-button, .apply-button {
            flex: 1;
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .learn-more-button {
            background-color: #f5f5f5;
            color: var(--primary-color);
        }

        .apply-button {
            background-color: var(--primary-color);
            color: white;
        }

        .learn-more-button:hover {
            background-color: #e5e5e5;
            text-decoration: none;
        }

        .apply-button:hover {
            background-color: var(--secondary-color);
            text-decoration: none;
            color: white;
        }

        /* Modal styles */
        .modal-content {
            border: none;
            border-radius: 8px;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .loan-details h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .loan-details ul {
            padding-left: 20px;
        }

        .loan-details ul ul {
            margin-top: 10px;
        }

        .loan-details li {
            margin-bottom: 8px;
        }

        /* Add styles for header, navigation, and sidebar */
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

        /* Footer styles */
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        footer .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.2rem;
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
                        <a class="nav-link" href="#" id="profileButton">
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
                    <div class="user-name"><?= $pendingData['name'] ?? 'Nama Pengguna' ?></div>
                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Keluar</a>
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

                <!-- Finance Section -->
                <div class="dropdown-header">
                    <i class="fas fa-wallet"></i>Kewangan
                </div>
                <a class="dropdown-item" href="/members/saving_acc">
                    <i class="fas fa-piggy-bank"></i>
                    <span>Akaun Simpanan</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>
            </div>
        </div>
    </div>

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

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h2 class="mb-0 text-center">Skim Pembiayaan Untuk Ahli</h2>
                            </div>
                            <div class="card-body">
                                <div class="loans-grid">
                                    <!-- Al-Baiubithaman Ajil Loan -->
                                    <div class="loan-container">
                                        <h3 class="loan-title">Pembiayaan Al-Baiubithaman Ajil</h3>
                                        <ul class="loan-features">
                                            <li><i class="fas fa-check-circle"></i> Kadar keuntungan: 4.2% setahun</li>
                                            <li><i class="fas fa-check-circle"></i> Tempoh: 1 - 10 tahun</li>
                                            <li><i class="fas fa-check-circle"></i> Jumlah: sehingga RM15,000</li>
                                        </ul>
                                        <div class="button-group">
                                            <a href="#" class="learn-more-button" onclick="showDetails('albaiubithaman')">Maklumat Lanjut</a>
                                            <a href="#" class="apply-button" onclick="checkProfileStatus()">Mohon</a>
                                        </div>
                                    </div>

                                    <!-- Bai Al-Inah Loan -->
                                    <div class="loan-container">
                                        <h3 class="loan-title">Pembiayaan Bai Al-Inah</h3>
                                        <ul class="loan-features">
                                            <li><i class="fas fa-check-circle"></i> Kadar keuntungan: 4.2% setahun</li>
                                            <li><i class="fas fa-check-circle"></i> Tempoh: 1 - 10 tahun</li>
                                            <li><i class="fas fa-check-circle"></i> Jumlah: sehingga RM10,000</li>
                                        </ul>
                                        <div class="button-group">
                                            <a href="#" class="learn-more-button" onclick="showDetails('baialinah')">Maklumat Lanjut</a>
                                            <a href="#" class="apply-button" onclick="checkProfileStatus()">Mohon</a>
                                        </div>
                                    </div>

                                    <!-- Vehicle Repair Loan -->
                                    <div class="loan-container">
                                        <h3 class="loan-title">Pembiayaan Membaikpulih Kenderaan</h3>
                                        <ul class="loan-features">
                                            <li><i class="fas fa-check-circle"></i> Kadar keuntungan: 4.2% setahun</li>
                                            <li><i class="fas fa-check-circle"></i> Tempoh: 1 - 5 tahun</li>
                                            <li><i class="fas fa-check-circle"></i> Jumlah: sehingga RM2,000</li>
                                        </ul>
                                        <div class="button-group">
                                            <a href="#" class="learn-more-button" onclick="showDetails('kenderaan')">Maklumat Lanjut</a>
                                            <a href="#" class="apply-button" onclick="checkProfileStatus()">Mohon</a>
                                        </div>
                                    </div>

                                    <!-- Education Loan -->
                                    <div class="loan-container">
                                        <h3 class="loan-title">Skim Khas Pembelajaran</h3>
                                        <ul class="loan-features">
                                            <li><i class="fas fa-check-circle"></i> Pembayaran tunai</li>
                                            <li><i class="fas fa-check-circle"></i> Untuk pembelajaran anak</li>
                                            <li><i class="fas fa-check-circle"></i> Jumlah: sehingga RM2,000</li>
                                        </ul>
                                        <div class="button-group">
                                            <a href="#" class="learn-more-button" onclick="showDetails('pembelajaran')">Maklumat Lanjut</a>
                                            <a href="#" class="apply-button" onclick="checkProfileStatus()">Mohon</a>
                                        </div>
                                    </div>

                                    <!-- Share-Based Loan -->
                                    <div class="loan-container">
                                        <h3 class="loan-title">Road Tax & Insuran</h3>
                                        <ul class="loan-features">
                                        <li><i class="fas fa-check-circle"></i> Tanpa keuntungan</li>
                                            <li><i class="fas fa-check-circle"></i> Atau dengan dua penjamin</li>
                                            <li><i class="fas fa-check-circle"></i> Jumlah: sehingga RM1,000</li>
                                        </ul>
                                        <div class="button-group">
                                            <a href="#" class="learn-more-button" onclick="showDetails('berjaminsaham')">Maklumat Lanjut</a>
                                            <a href="#" class="apply-button" onclick="checkProfileStatus()">Mohon</a>
                                        </div>
                                    </div>

                                    <!-- Al-Qardhul Hasan Emergency Loan -->
                                    <div class="loan-container">
                                        <h3 class="loan-title">Pinjaman Kecemasan (Al-Qardhul Hasan)</h3>
                                        <ul class="loan-features">
                                            <li><i class="fas fa-check-circle"></i> Tanpa keuntungan</li>
                                            <li><i class="fas fa-check-circle"></i> Tempoh bayaran fleksibel</li>
                                            <li><i class="fas fa-check-circle"></i> Jumlah: sehingga RM500</li>
                                        </ul>
                                        <div class="button-group">
                                            <a href="#" class="learn-more-button" onclick="showDetails('kecemasan')">Maklumat Lanjut</a>
                                            <a href="#" class="apply-button" onclick="checkProfileStatus()">Mohon</a>
                                        </div>
                                    </div>

                                    
                                </div>
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

    <!-- Loan Details Modal -->
    <div class="modal fade" id="loanDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title fw-bold" id="modalTitle"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="modalContent" class="loan-details">
                        <!-- Content will be inserted here by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Add this modal for profile status -->
    <div class="modal fade" id="profileStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title fw-bold">Status Profil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p id="profileStatusMessage" class="text-danger fw-bold"></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loanInfo = {
            albaiubithaman: {
                title: "Pembiayaan Al-Baiubithaman Ajil",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Al-Baiubithaman Ajil</h3>
                    <p>Pembiayaan patuh Syariah untuk keperluan anda:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah maksimum: RM15,000</li>
                        <li>Dokumen yang diperlukan:
                            <ul>
                                <li>Salinan Kad Pengenalan</li>
                                <li>Slip gaji 3 bulan terkini</li>
                                <li>Penyata bank 3 bulan terkini</li>
                            </ul>
                        </li>
                    </ul>`
            },
            baialinah: {
                title: "Pembiayaan Bai Al-Inah",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Bai Al-Inah</h3>
                    <p>Penyelesaian kewangan patuh Syariah:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah maksimum: RM10,000</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Proses kelulusan yang cepat</li>
                                <li>Bayaran bulanan tetap</li>
                                <li>Terma yang fleksibel</li>
                            </ul>
                        </li>
                    </ul>`
            },
            kenderaan: {
                title: "Pembiayaan Membaikpulih Kenderaan",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Membaikpulih Kenderaan</h3>
                    <p>Pembiayaan untuk pembaikan kenderaan anda:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 5 tahun</li>
                        <li>Jumlah maksimum: RM2,000</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Proses permohonan mudah</li>
                                <li>Kelulusan segera</li>
                                <li>Bayaran balik yang fleksibel</li>
                            </ul>
                        </li>
                    </ul>`
            },
            kecemasan: {
                title: "Pinjaman Kecemasan (Al-Qardhul Hasan)",
                content: `
                    <h3>Maklumat Terperinci Pinjaman Kecemasan</h3>
                    <p>Bantuan kewangan segera untuk kecemasan:</p>
                    <ul>
                        <li>Tanpa keuntungan (Qardhul Hasan)</li>
                        <li>Tempoh bayaran yang fleksibel</li>
                        <li>Jumlah maksimum: RM500</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Kelulusan segera</li>
                                <li>Tanpa caj tambahan</li>
                                <li>Syarat minimum</li>
                            </ul>
                        </li>
                    </ul>`
            },
            berjaminsaham: {
                title: "Pinjaman Berjamin Saham",
                content: `
                    <h3>Maklumat Terperinci Pinjaman Berjamin Saham</h3>
                    <p>Pinjaman dengan jaminan saham atau penjamin:</p>
                    <ul>
                        <li>Nilai sehingga 80% saham/yuran</li>
                        <li>Pilihan dengan dua penjamin</li>
                        <li>Jumlah maksimum: RM1,000</li>
                        <li>Syarat-syarat:
                            <ul>
                                <li>Nilai saham mencukupi</li>
                                <li>Atau dua penjamin yang layak</li>
                                <li>Dokumen sokongan yang lengkap</li>
                            </ul>
                        </li>
                    </ul>`
            },
            pembelajaran: {
                title: "Skim Khas Pembelajaran",
                content: `
                    <h3>Maklumat Terperinci Skim Khas Pembelajaran</h3>
                    <p>Pembiayaan untuk pendidikan anak-anak:</p>
                    <ul>
                        <li>Pembayaran secara tunai</li>
                        <li>Khusus untuk pembelajaran anak</li>
                        <li>Jumlah maksimum: RM2,000</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Proses mudah dan cepat</li>
                                <li>Syarat-syarat yang fleksibel</li>
                                <li>Bayaran balik yang berpatutan</li>
                            </ul>
                        </li>
                    </ul>`
            }
        };

        function showDetails(loanType) {
            const modal = new bootstrap.Modal(document.getElementById('loanDetailsModal'));
            document.getElementById('modalTitle').textContent = loanInfo[loanType].title;
            document.getElementById('modalContent').innerHTML = loanInfo[loanType].content;
            modal.show();
        }

        // Updated script for sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const profileSidebar = document.getElementById('profileSidebar');
            const body = document.body;
            
            profileButton.addEventListener('click', function(e) {
                e.preventDefault();
                profileSidebar.classList.toggle('active');
                // Prevent body scroll when sidebar is open
                if (profileSidebar.classList.contains('active')) {
                    body.style.overflow = 'hidden';
                } else {
                    body.style.overflow = '';
                }
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (!profileSidebar.contains(e.target) && !profileButton.contains(e.target)) {
                    profileSidebar.classList.remove('active');
                    body.style.overflow = '';
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

        function checkProfileStatus() {
            fetch('/members/check-profile-status')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'approved') {
                        window.location.href = '/registerLoan';
                    } else {
                        const modal = new bootstrap.Modal(document.getElementById('profileStatusModal'));
                        let message = '';
                        switch(data.status) {
                            case 'pending':
                                message = 'Profil anda masih dalam proses semakan. Sila tunggu sehingga profil anda diluluskan untuk memohon pinjaman.';
                                break;
                            case 'rejected':
                                message = 'Maaf, profil anda telah ditolak. Sila hubungi pihak pentadbir untuk maklumat lanjut.';
                                break;
                            default:
                                message = 'Sila lengkapkan pendaftaran profil anda terlebih dahulu sebelum memohon pinjaman.';
                        }
                        const messageElement = document.getElementById('profileStatusMessage');
                        messageElement.textContent = message;
                        messageElement.className = 'text-danger fw-bold';
                        modal.show();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ralat semasa menyemak status profil. Sila cuba lagi.');
                });
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