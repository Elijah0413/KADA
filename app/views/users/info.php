<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Kakitangan KADA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            font-family: 'Poppins', sans-serif;
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: #2c3e2c;
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

        .logo-section h1 {
            color: var(--primary-color);
            line-height: 1.2;
        }

        .logo-section .text-secondary {
            color: var(--secondary-color) !important;
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

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 4px;
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }

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

        .card {
            background: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border-bottom: none;
            padding: 1.25rem;
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-light);
        }

        .card-body {
            padding: 2rem;
        }

        .table thead th {
            background: #f8faf8;
            color: #1b5e20;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.875rem;
            border-bottom: 2px solid #e8f5e9;
        }

        .table-primary {
            background: #e8f5e9 !important;
        }

        .table-primary td {
            color: #1b5e20;
            font-weight: 600;
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

        footer {
            background-color: var(--primary-color);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
            margin-top: auto;
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
                            <img src="/images/logo.jpg" alt="Logo KADA" class="img-fluid me-3" style="max-height: 70px;">
                            <div>
                                <h1 class="mb-0 fs-4 fw-bold">Lembaga Kemajuan Pertanian Kemubu</h1>
                                <span class="text-secondary">KADA</span>
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

        <!-- Profile Sidebar -->
        <div class="profile-sidebar" id="profileSidebar">
            <div class="sidebar-content">
                <!-- User Profile Section -->
                <div class="user-profile-section">
                    <img src="<?= isset($user['profile_picture']) ? $user['profile_picture'] : '/images/default-avatar.png' ?>" 
                         alt="Profile Picture" 
                         class="rounded-circle">
                    <div class="user-info">
                        <div class="user-name">
                            <?php 
                            if (isset($_SESSION['user_name'])) {
                                echo htmlspecialchars($_SESSION['user_name']);
                            } else {
                                echo 'Nama Pengguna';
                            }
                            ?>
                        </div>
                        <a href="/logout" class="btn btn-sm btn-success">Log Keluar</a>
                    </div>
                </div>

                <!-- Scrollable Content -->
                <div class="sidebar-scrollable">
                    <!-- Profile Section -->
                    <div class="dropdown-header">
                        <i class="fas fa-user"></i>
                        Profil
                    </div>
                    <a class="dropdown-item" href="/members/profile">
                        <i class="fas fa-id-card"></i>
                        <span>Lihat Profil</span>
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>

                    <!-- Dashboard Section -->
                    <div class="dropdown-header">
                        <i class="fas fa-th-large"></i>
                        Papan Pemuka
                    </div>
                    <a class="dropdown-item" href="/members/dashboard">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Status Permohonan</span>
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>

                    <!-- My Saving Account -->
                    <div class="dropdown-header">
                        <i class="fas fa-piggy-bank"></i>
                        Simpanan Saya
                    </div>
                    <a class="dropdown-item" href="/members/saving_acc">
                        <i class="fas fa-wallet"></i>
                        <span>Akaun Simpanan Saya</span>
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
                                    <a class="nav-link" href="/members/info">MAKLUMAT</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/members/benefits">MANFAAT AHLI</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">PINJAMAN</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/members/loans">Jenis Pinjaman</a></li>
                                        <li><a class="dropdown-item" href="/loanCalculator">Kalkulator Pinjaman</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/members/customerService">PERKHIDMATAN PELANGGAN</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <!-- Maklumat Koperasi Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0 text-center">MAKLUMAT KOPERASI</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td width="30%"><strong>Nama Koperasi</strong></td>
                                                    <td>Koperasi Kakitangan KADA Kelantan Berhad</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>No. Pendaftaran</strong></td>
                                                    <td>3246</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tarikh Pendaftaran</strong></td>
                                                    <td>14 Februari 1977</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Alamat</strong></td>
                                                    <td>Lembaga Kemajuan Pertanian Kemubu (KADA)<br>
                                                        Peti Surat 127, Bandar Kota Bharu<br>
                                                        15710 Kota Bharu, Kelantan</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Kawasan Operasi</strong></td>
                                                    <td>Negeri Kelantan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Committee Members Table Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0 text-center">AHLI LEMBAGA KOPERASI</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>JAWATAN</th>
                                                    <th>NAMA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Pengerusi</strong></td>
                                                    <td>En. Ahmad bin Abdullah</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Naib Pengerusi</strong></td>
                                                    <td>En. Mohd Razali bin Hassan</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Setiausaha</strong></td>
                                                    <td>Pn. Aminah binti Ismail</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Bendahari</strong></td>
                                                    <td>En. Kamal bin Omar</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Aktiviti Koperasi Table Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0 text-center">AKTIVITI KOPERASI</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>AKTIVITI</th>
                                                    <th>KETERANGAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Simpanan</strong></td>
                                                    <td>Simpanan wajib dan sukarela ahli</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Pinjaman</strong></td>
                                                    <td>Pinjaman wang kepada ahli</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Kebajikan</strong></td>
                                                    <td>Bantuan kematian, pelajaran, dan kesihatan</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Pelaburan</strong></td>
                                                    <td>Pelaburan dalam hartanah dan saham</td>
                                                </tr>
                                            </tbody>
                                        </table>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Profile Sidebar Toggle
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
        });

        function openQRModal(imgSrc) {
            document.getElementById('modalQRImage').src = imgSrc;
            new bootstrap.Modal(document.getElementById('qrModal')).show();
        }
    </script>
</body>
</html>