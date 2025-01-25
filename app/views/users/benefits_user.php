<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faedah Keahlian - KADA</title>
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

        /* Additional styles for benefits page */
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

        .requirements-section {
            background: var(--background-overlay);
            border-radius: 8px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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

        /* Add consistent container padding */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

            <!-- Benefits Content -->
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