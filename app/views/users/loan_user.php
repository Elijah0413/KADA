<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Skim Pembiayaan Ahli</title>
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

        /* Loan specific styles */
        .loans-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            padding: 0 20px;
        }

        .loan-container {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-top: 4px solid var(--secondary-color);
        }

        .loan-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .loan-container h2 {
            color: var(--primary-color);
            margin: 0 0 15px 0;
            font-size: 1.5rem;
        }

        .loan-features {
            list-style-type: none;
            padding: 0;
            margin: 15px 0;
        }

        .loan-features li {
            margin: 8px 0;
            padding-left: 25px;
            position: relative;
            color: var(--text-dark);
        }

        .loan-features li:before {
            content: "✓";
            color: var(--primary-color);
            position: absolute;
            left: 0;
        }

        .button-group {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .learn-more-button, .apply-button {
            flex: 1;
            padding: 12px 20px;
            font-size: 0.95rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
        }

        .learn-more-button {
            background-color: var(--secondary-color);
            color: white;
        }

        .apply-button {
            background-color: var(--primary-color);
            color: white;
        }

        .learn-more-button:hover, .apply-button:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .loans-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Additional styles for loan details modal */
        .loan-details h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .loan-details p {
            color: var(--text-dark);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .loan-details ul {
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .loan-details ul li {
            margin-bottom: 0.75rem;
            color: var(--text-dark);
        }

        .loan-details ul ul {
            margin-top: 0.75rem;
            margin-bottom: 0;
        }

        .modal-header {
            padding: 1rem 1.5rem;
        }

        .modal-header .modal-title {
            font-size: 1.25rem;
        }

        .modal-content {
            border-radius: 12px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Additional styles for alert modal */
        .modal-content {
            border-radius: 12px;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary {
            border: 1px solid #dee2e6;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #6c757d;
            border-color: #dee2e6;
        }

        .btn-success {
            background-color: var(--primary-color);
        }

        .btn-success:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }

        .text-muted {
            color: #6c757d !important;
        }

        .modal-body i {
            opacity: 0.9;
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
                            <h1 class="mb-0 fs-4 fw-bold text-success">Koperasi Kakitangan KADA Kelantan Sdn Bhd</h1>
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

            <!-- Main Content -->
            <div class="container">
                <!-- Alert Modal for Non-Members -->
                <div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-body text-center p-4">
                                <div class="mb-4">
                                    <i class="fas fa-info-circle text-success" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="mb-3 fw-bold">Perhatian</h5>
                                <p class="text-muted mb-4">Hanya ahli yang berdaftar sahaja boleh memohon pembiayaan ini. Sila log masuk untuk melihat butiran lanjut.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                                    <a href="/userlogin" class="btn btn-success px-4">Log Masuk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loan cards content -->
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h2 class="mb-0 text-center">Skim Pembiayaan Untuk Ahli</h2>
                            </div>
                            <div class="card-body">
                                <div class="loans-grid">
                                    <div class="loan-container">
                                        <h2>Pembiayaan Al Bai</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Patuh Syariah</li>
                                            <li>Proses yang telus</li>
                                            <li>Tiada cagaran diperlukan</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('albai')" class="learn-more-button">Maklumat Lanjut</button>
                                            <a href="#" onclick="showAlertModal(event)" class="apply-button">Mohon Sekarang</a>
                                        </div>
                                    </div>

                                    <div class="loan-container">
                                        <h2>Pembiayaan Al Innah</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Fleksibel untuk pelbagai keperluan</li>
                                            <li>Proses kelulusan pantas</li>
                                            <li>Tiada cagaran diperlukan</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('alinnah')" class="learn-more-button">Maklumat Lanjut</button>
                                            <a href="#" onclick="showAlertModal(event)" class="apply-button">Mohon Sekarang</a>
                                        </div>
                                    </div>

                                    <div class="loan-container">
                                        <h2>Pembiayaan Skim Khas</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Tempoh bayaran balik fleksibel</li>
                                            <li>Kadar keuntungan yang kompetitif</li>
                                            <li>Proses permohonan mudah</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('peribadi')" class="learn-more-button">Maklumat Lanjut</button>
                                            <a href="#" onclick="showAlertModal(event)" class="apply-button">Mohon Sekarang</a>
                                        </div>
                                    </div>

                                    <div class="loan-container">
                                        <h2>Pembiayaan Road Tax & Insuran</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Untuk kenderaan baru dan terpakai</li>
                                            <li>Tempoh pembiayaan sehingga 9 tahun</li>
                                            <li>Kadar yang kompetitif</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('kenderaan')" class="learn-more-button">Maklumat Lanjut</button>
                                            <a href="#" onclick="showAlertModal(event)" class="apply-button">Mohon Sekarang</a>
                                        </div>
                                    </div>

                                    <div class="loan-container">
                                        <h2>Pembiayaan Al Qardhul Hasan</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Pembiayaan sehingga 90%</li>
                                            <li>Tempoh pembiayaan sehingga 35 tahun</li>
                                            <li>Kadar yang kompetitif</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('perumahan')" class="learn-more-button">Maklumat Lanjut</button>
                                            <a href="#" onclick="showAlertModal(event)" class="apply-button">Mohon Sekarang</a>
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

    <!-- Modals -->
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loanInfo = {
            albai: {
                title: "Pembiayaan Al Bai",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Al Bai</h3>
                    <p>Pembiayaan Al Bai adalah skim pembiayaan yang mematuhi prinsip Syariah:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah pembiayaan: RM1,000 - RM50,000</li>
                        <li>Dokumen yang diperlukan:
                            <ul>
                                <li>Salinan Kad Pengenalan</li>
                                <li>Slip gaji 3 bulan terkini</li>
                                <li>Penyata bank 3 bulan terkini</li>
                            </ul>
                        </li>
                    </ul>`
            },
            alinnah: {
                title: "Pembiayaan Al Innah",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Al Innah</h3>
                    <p>Pembiayaan Al Innah menawarkan penyelesaian kewangan yang fleksibel:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah pembiayaan: RM1,000 - RM50,000</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Proses kelulusan yang cepat</li>
                                <li>Tiada cagaran diperlukan</li>
                                <li>Terma yang fleksibel</li>
                            </ul>
                        </li>
                    </ul>`
            },
            peribadi: {
                title: "Pembiayaan Skim Khas",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Skim Khas</h3>
                    <p>Pembiayaan peribadi untuk pelbagai keperluan anda:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah pembiayaan: RM1,000 - RM100,000</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Kelulusan segera</li>
                                <li>Bayaran bulanan tetap</li>
                                <li>Tiada penalti penyelesaian awal</li>
                            </ul>
                        </li>
                    </ul>`
            },
            kenderaan: {
                title: "Pembiayaan Road Tax & Insuran",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Road Tax & Insuran</h3>
                    <p>Pembiayaan kenderaan yang komprehensif:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: sehingga 9 tahun</li>
                        <li>Margin pembiayaan: sehingga 90%</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Kadar yang kompetitif</li>
                                <li>Proses dokumentasi yang mudah</li>
                                <li>Perlindungan takaful komprehensif</li>
                            </ul>
                        </li>
                    </ul>`
            },
            perumahan: {
                title: "Pembiayaan Al Qardhul Hasan",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Al Qardhul Hasan</h3>
                    <p>Pembiayaan perumahan yang komprehensif untuk rumah idaman anda:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: sehingga 35 tahun</li>
                        <li>Margin pembiayaan: sehingga 90%</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Kadar pembiayaan yang kompetitif</li>
                                <li>Tempoh pembayaran yang fleksibel</li>
                                <li>Proses dokumentasi yang mudah</li>
                                <li>Perlindungan takaful komprehensif</li>
                            </ul>
                        </li>
                        <li>Dokumen yang diperlukan:
                            <ul>
                                <li>Salinan Kad Pengenalan</li>
                                <li>Slip gaji 3 bulan terkini</li>
                                <li>Penyata bank 6 bulan terkini</li>
                                <li>Surat Tawaran Pekerjaan</li>
                                <li>Dokumen berkaitan hartanah</li>
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

        function showLoginMessage(event) {
            event.preventDefault();
            new bootstrap.Modal(document.getElementById('loginModal')).show();
        }

        function openQRModal(imgSrc) {
            document.getElementById('modalQRImage').src = imgSrc;
            new bootstrap.Modal(document.getElementById('qrModal')).show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        function showAlertModal(event) {
            event.preventDefault();
            new bootstrap.Modal(document.getElementById('alertModal')).show();
        }
    </script>
</body>
</html>