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

        /* Additional styles specific to info_user content */
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
            font-size: 1rem;
            line-height: 1.6;
            color: #2c3e2c;
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
            font-size: 1rem;
            padding: 0.875rem;
            border-bottom: 2px solid #e8f5e9;
        }

        .table tbody td {
            font-size: 1rem;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.25rem;
            }
            
            .table td, .table th {
                padding: 0.75rem;
            }
            
            .logo-section {
                padding: 2rem 0;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2e7d32;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1b5e20;
        }

        /* Print styles */
        @media print {
            .logo-section {
                background: none !important;
                padding: 1rem 0;
            }
            
            .logo-section h1 {
                color: #1a237e;
                text-shadow: none;
            }
            
            .card {
                box-shadow: none;
                border: 1px solid #dee2e6;
            }
            
            .card-header {
                background: none !important;
                color: #1a237e;
                border-bottom: 2px solid #1a237e;
            }
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

            <!-- Main Content Area -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <!-- Your content cards go here -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="mb-0 text-center">Maklumat Koperasi</h2>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <span class="info-label">NAMA BERDAFTAR</span>
                                        <div class="info-content">
                                            <i class="fas fa-building contact-icon"></i>
                                            KOPERASI KAKITANGAN KADA SDN BHD
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <span class="info-label">NO. PENDAFTARAN</span>
                                        <div class="info-content">
                                            <i class="fas fa-registered contact-icon"></i>
                                            IP5429/1
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <span class="info-label">TARIKH DAFTAR</span>
                                        <div class="info-content">
                                            <i class="fas fa-calendar-alt contact-icon"></i>
                                            29 Ogos 1981
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <span class="info-label">PEJABAT BERDAFTAR</span>
                                        <div class="info-content">
                                            <i class="fas fa-map-marker-alt contact-icon"></i>
                                            D/A Lembaga Kemajuan Pertanian Kemubu,<br>
                                            P/S 127, 15710 Kota Bharu, Kelantan.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <span class="info-label">NO. TELEFON</span>
                                        <div class="info-content">
                                            <i class="fas fa-phone contact-icon"></i>
                                            09-7447088 samb. 5339 @ 5312
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <span class="info-label">EMEL</span>
                                        <div class="info-content">
                                            <i class="fas fa-envelope contact-icon"></i>
                                            <a href="mailto:koperasi_kada@yahoo.com" class="text-decoration-none">koperasi_kada@yahoo.com</a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <span class="info-label">BANK</span>
                                        <ul class="bank-list">
                                            <li><i class="fas fa-university contact-icon"></i>BANK ISLAM MALAYSIA BHD – CAWANGAN KUBANG KERIAN</li>
                                            <li><i class="fas fa-university contact-icon"></i>BANK MUAMALAT MALAYSIA BERHAD – CAWANGAN JALAN SULTAN YAHYA PETRA</li>
                                            <li><i class="fas fa-university contact-icon"></i>BANK MUAMALAT MALAYSIA BERHAD – CAWANGAN KOTA BHARU</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Committee Members Table Card -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="mb-0 text-center">SENARAI AHLI JAWATANKUASA KOPERASI BAGI TAHUN 2015 HINGGA 2019</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>JAWATAN</th>
                                                <th>NAMA AHLI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>PENGERUSI</td>
                                                <td>Wan Badri b. Wan Omar</td>
                                            </tr>
                                            <tr>
                                                <td>TIMBALAN PENGERUSI</td>
                                                <td>Shazlan b. Sekari@Shokri</td>
                                            </tr>
                                            <tr>
                                                <td>SETIAUSAHA</td>
                                                <td>Mohamed Azami b. Mohamed Salleh</td>
                                            </tr>
                                            <tr>
                                                <td>TIMBALAN SETIAUSAHA</td>
                                                <td>Zariani bt. Hussin</td>
                                            </tr>
                                            <tr>
                                                <td>BENDAHARI</td>
                                                <td>Mohd Badli Shah b. Che Mohamad</td>
                                            </tr>
                                            <tr>
                                                <td>TIMBALAN BENDAHARI</td>
                                                <td>Ab. Aziz b. Mustapha</td>
                                            </tr>
                                            <tr>
                                                <td>PENGERUSI PERNIAGAAN & PELABURAN</td>
                                                <td>Shazlan b. Sekari@Shokri</td>
                                            </tr>
                                            <tr>
                                                <td>PENGERUSI KEBAJIKAN & SYARIE</td>
                                                <td>Engku Safrudin b. Engku Chik</td>
                                            </tr>
                                            <tr>
                                                <td>TIMB. PENGERUSI KEBAJIKAN & SYARIE</td>
                                                <td>Wan Nur Hasyila bt. Wan Suleman</td>
                                            </tr>
                                            <tr>
                                                <td>PENGERUSI PENTADBIRAN ICT & DISIPLIN</td>
                                                <td>Mohammad Hazwan b. Mohamad</td>
                                            </tr>
                                            <tr>
                                                <td>TIMB. PENGERUSI PENTADBIRAN ICT & DISIPLIN</td>
                                                <td>Siti Salwani bt. Mustapha</td>
                                            </tr>
                                            <tr>
                                                <td>TIMB. PENGERUSI PERNIAGAAN & PELABURAN I</td>
                                                <td>Wan Mahidin b. Wan Shafie</td>
                                            </tr>
                                            <tr>
                                                <td>TIMB. PENGERUSI PERNIAGAAN & PELABURAN II</td>
                                                <td>Mohd Zalimin b. Husin</td>
                                            </tr>
                                            <tr>
                                                <td>AUDIT LUAR (1)</td>
                                                <td>Khairuddin Hasyudeen & Razi</td>
                                            </tr>
                                            <tr>
                                                <td>AUDIT LUAR (2)</td>
                                                <td>Chartered Accountants (AF1161)</td>
                                            </tr>
                                            <tr>
                                                <td>AUDIT DALAM (1)</td>
                                                <td>Zulfikri Bin Mohamad</td>
                                            </tr>
                                            <tr>
                                                <td>AUDIT DALAM (2)</td>
                                                <td>Nor Salwana bt. Zaini</td>
                                            </tr>
                                            <tr>
                                                <td>AUDIT DALAM (3)</td>
                                                <td>Wan Shafini bt. Wan Muhamad</td>
                                            </tr>
                                            <tr>
                                                <td>KAKITANGAN (1)</td>
                                                <td>Ahmad Rohailan b. Hani</td>
                                            </tr>
                                            <tr>
                                                <td>KAKITANGAN (2)</td>
                                                <td>Noor Zafran bt. Ahmad Kamal</td>
                                            </tr>
                                            <tr>
                                                <td>KAKITANGAN (3)</td>
                                                <td>Wan Shafini bt. Wan Muhamad</td>
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
                                                <th style="width: 70%">PERKARA</th>
                                                <th style="width: 30%">PEMBIAYAAN MAKSIMA (RM)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Perniagaan Section -->
                                            <tr class="table-primary">
                                                <td colspan="2"><strong>PERNIAGAAN</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Skim Pembiayaan Al-Baiubithaman Ajil</td>
                                                <td>15,000.00</td>
                                            </tr>
                                            <tr>
                                                <td>Skim Pembiayaan Bai Al-Inah</td>
                                                <td>10,000.00</td>
                                            </tr>
                                            <tr>
                                                <td>Skim Pembiayaan Membaikpulih Kenderaan Bermotor</td>
                                                <td>2,000.00</td>
                                            </tr>
                                            <tr>
                                                <td>Skim Pembiayaan Cukai Jalan dan Insuran Kenderaan</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Pembekalan Peralatan & Penyediaan Makanan</td>
                                                <td>-</td>
                                            </tr>
                                            
                                            <!-- Al-Qardhul Hasan Section -->
                                            <tr class="table-primary">
                                                <td colspan="2"><strong>AL-QARDHUL HASAN</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Pinjaman Kecemasan</td>
                                                <td>500.00</td>
                                            </tr>
                                            <tr>
                                                <td>Pinjaman Berjamin Sama ada dengan saham (dihadkan 80% saham / yuran) atau dengan dua penjamin dengan syarat-syarat yang telah ditetapkan.</td>
                                                <td>1,000.00</td>
                                            </tr>
                                            <tr>
                                                <td>Skim Khas (tunai) untuk pembiayaan pembelajaran anak.</td>
                                                <td>2,000.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Tabung Kebajikan & Khairat Card -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="mb-0 text-center">TABUNG KEBAJIKAN DAN KHAIRAT</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 70%">TABUNG KEBAJIKAN & KHAIRAT</th>
                                                <th style="width: 30%">NILAI SUMBANGAN (RM)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Kematian Section -->
                                            <tr class="table-primary">
                                                <td colspan="2"><strong>KEMATIAN</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Anggota</td>
                                                <td>800</td>
                                            </tr>
                                            <tr>
                                                <td>Anak @ Anak angkat yang sah (21 tahun ke bawah)</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td>Ibu dan bapa anggota</td>
                                                <td>200</td>
                                            </tr>

                                            <!-- Melanjutkan Pelajaran Section -->
                                            <tr class="table-primary">
                                                <td colspan="2"><strong>MELANJUTKAN PELAJARAN</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Ijazah (seberang laut)</td>
                                                <td>150</td>
                                            </tr>
                                            <tr>
                                                <td>Ijazah (dalam negeri)</td>
                                                <td>100</td>
                                            </tr>

                                            <!-- Other Benefits Section -->
                                            <tr class="table-primary">
                                                <td colspan="2"><strong>LAIN-LAIN MANFAAT</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Hadiah bersalin (maksima 5 kali)</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Anggota pencen (wang tunai)</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Menunaikan Haji (1 kali / anggota)</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td>Menunaikan Umrah (1 kali / anggota)</td>
                                                <td>150</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Important Notice -->
                                <div class="alert alert-info mt-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Nota Penting:</strong> Tuntutan hendaklah dibuat dalam tempoh tidak lebih 3 bulan selepas dari tarikh kejadian.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Scripts -->
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
    </script>
</body>
</html>