<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faedah Keahlian - KADA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            font-size: 1rem;
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

        /* Benefits specific styles */
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin: 2rem 0;
        }

        .benefit-card {
            background: var(--background-overlay);
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            text-align: center;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .benefit-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .benefit-card h3 {
            color: var(--primary-color);
            margin: 15px 0;
            font-size: 1.3rem;
        }

        .requirements-section {
            background: var(--background-overlay);
            border-radius: 8px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .requirements-section h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .requirements-section ul {
            list-style-type: none;
            padding: 0;
        }

        .requirements-section li {
            margin: 15px 0;
            padding-left: 25px;
            position: relative;
            color: var(--text-dark);
        }

        .requirements-section li:before {
            content: "→";
            color: var(--secondary-color);
            position: absolute;
            left: 0;
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

        @media (max-width: 968px) {
            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }
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

        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-success:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        /* Add any other missing styles from members/index.php */
        
    </style>
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

                <div class="container py-4">
                    <div class="card mb-4">
                        <div class="card-body text-center py-4">
                            <h2 class="mb-4 fw-bold text-success">Faedah Keahlian Koperasi</h2>
                            <p class="lead">Nikmati pelbagai faedah dan kemudahan sebagai ahli koperasi KADA</p>
                        </div>
                    </div>

                    <div class="benefits-grid">
                        <div class="benefit-card">
                            <div class="benefit-icon">💰</div>
                            <h3>Dividen Tahunan</h3>
                            <p>Nikmati dividen tahunan yang menarik berdasarkan jumlah saham anda dalam koperasi.</p>
                        </div>

                        <div class="benefit-card">
                            <div class="benefit-icon">💳</div>
                            <h3>Kemudahan Pembiayaan</h3>
                            <p>Akses kepada pelbagai skim pembiayaan dengan kadar yang kompetitif dan proses yang mudah.</p>
                        </div>

                        <div class="benefit-card">
                            <div class="benefit-icon">🏥</div>
                            <h3>Bantuan Kesihatan</h3>
                            <p>Dapatkan bantuan perubatan dan kesihatan untuk anda dan keluarga.</p>
                        </div>

                        <div class="benefit-card">
                            <div class="benefit-icon">📚</div>
                            <h3>Bantuan Pendidikan</h3>
                            <p>Biasiswa dan bantuan pendidikan untuk anak-anak ahli yang cemerlang.</p>
                        </div>

                        <div class="benefit-card">
                            <div class="benefit-icon">🤝</div>
                            <h3>Khairat Kematian</h3>
                            <p>Bantuan khairat kematian untuk meringankan beban keluarga ahli.</p>
                        </div>

                        <div class="benefit-card">
                            <div class="benefit-icon">🎓</div>
                            <h3>Program Latihan</h3>
                            <p>Akses kepada program latihan dan pembangunan kemahiran.</p>
                        </div>
                    </div>

                    <div class="requirements-section">
                        <h2>Syarat-syarat Kelayakan</h2>
                        <ul>
                            <li>Warganegara Malaysia berumur 18 tahun ke atas</li>
                            <li>Kakitangan kerajaan atau swasta yang tetap</li>
                            <li>Minima Modal Sher RM300</li>
                            <li>Maksima Modal Sher RM10K</li>
                            <li>Minimum Caruman Yuran RM35</li>
                            <li>Mengemukakan dokumen yang diperlukan</li>
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