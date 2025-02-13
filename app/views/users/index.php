<!DOCTYPE html>
<html lang="en">
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
            <!-- Welcome Section -->
            <section class="welcome-section py-4">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card mb-4 position-relative">
                            <img src="/images/padi2.jpg" class="card-img" alt="KADA Padi Field" style="height: 600px; object-fit: cover;">
                            <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background: rgba(0, 0, 0, 0.5);">
                                <div class="text-center text-white">
                                    <h2 class="mb-4 fw-bold">Selamat Datang ke Koperasi Kakitangan KADA Kelantan</h2>
                                    <p class="lead" style="max-width: 800px;">
                                        Selamat datang ke laman web rasmi Koperasi Kakitangan KADA Kelantan Sdn Bhd! Kami berdedikasi untuk menyediakan perkhidmatan kewangan dan kebajikan terbaik kepada ahli-ahli kami, sambil menyokong kesejahteraan dan kemajuan bersama. Terokai pelbagai maklumat, perkhidmatan, dan inisiatif koperasi yang direka khas untuk manfaat anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->
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
                        <i class="fas fa-envelope"></i> prokada@kada.gov.my
                    </address>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Imbas QR</h6>
                    <?php
                        // Adjust the path to be relative to the document root
                        $qrPath = '/images/qr.jpg';
                        $fullPath = $_SERVER['DOCUMENT_ROOT'] . $qrPath;
                        
                        // Debug logging
                        error_log("Checking for QR image at: " . $fullPath);
                        error_log("DOCUMENT_ROOT is: " . $_SERVER['DOCUMENT_ROOT']);
                        error_log("Directory exists?: " . (is_dir(dirname($fullPath)) ? 'Yes' : 'No'));
                        
                        if (is_dir(dirname($fullPath))) {
                            error_log("Directory contents: " . print_r(scandir(dirname($fullPath)), true));
                        }
                        
                        if (file_exists($fullPath)) {
                            error_log("QR image exists at: " . $fullPath);
                            echo '<img src="' . $qrPath . '" alt="QR Code" class="qr-code" 
                                     style="max-width: 70px; cursor: pointer;" 
                                     onclick="openQRModal(this.src)">';
                        } else {
                            error_log("QR image not found at: " . $fullPath);
                            echo '<p>QR code image not found. Please ensure the image is uploaded to: ' . $qrPath . '</p>';
                        }
                    ?>
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

    <!-- Add this modal HTML before the closing </body> tag -->
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

    <script>
    function showLoginMessage(event) {
        event.preventDefault();
        new bootstrap.Modal(document.getElementById('loginModal')).show();
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

    <!-- Add this script before closing body tag -->
    <script>
    function openQRModal(imgSrc) {
        document.getElementById('modalQRImage').src = imgSrc;
        new bootstrap.Modal(document.getElementById('qrModal')).show();
    }
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll function
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
    </script>
</body>
</html>