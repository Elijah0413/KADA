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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #2c3e50;
        }

        .page-header {
            background: linear-gradient(45deg, #1a237e, #0d47a1);
            padding: 3rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect fill="rgba(255,255,255,0.1)" x="0" y="0" width="100" height="100"/></svg>');
            opacity: 0.1;
        }

        .page-header h1 {
            color: white;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            background: white;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(45deg, #1a237e, #0d47a1);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
            position: relative;
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
        }

        .table {
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background: #f8f9fa;
            color: #1a237e;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border-bottom: 2px solid #e9ecef;
        }

        .table tbody tr:hover {
            background-color: rgba(26, 35, 126, 0.02);
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table-primary {
            background: rgba(26, 35, 126, 0.05) !important;
        }

        .table-primary td {
            color: #1a237e;
            font-weight: 600;
        }

        .info-label {
            color: #1a237e;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .info-content {
            background: #f8f9fa;
            padding: 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #1a237e;
        }

        .contact-icon {
            color: #1a237e;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 1.25rem;
            margin-top: 2rem;
            background: rgba(26, 35, 126, 0.05);
            border-left: 4px solid #1a237e;
        }

        .alert-info {
            color: #1a237e;
        }

        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }

        .breadcrumb-item a {
            color: #1a237e;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .bank-list li {
            background: #f8f9fa;
            padding: 1.25rem;
            margin-bottom: 1rem;
            border-radius: 10px;
            border-left: 4px solid #1a237e;
            transition: all 0.3s ease;
        }

        .bank-list li:hover {
            transform: translateX(5px);
            background: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.25rem;
            }
            
            .table td, .table th {
                padding: 0.75rem;
            }
            
            .page-header {
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
            background: #1a237e;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0d47a1;
        }

        /* Print styles */
        @media print {
            .page-header {
                background: none !important;
                padding: 1rem 0;
            }
            
            .page-header h1 {
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
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="text-center mb-0">KOPERASI KAKITANGAN KADA</h1>
        </div>
    </div>

    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Info Koperasi</li>
            </ol>
        </nav>

        <!-- Company Info Card -->
        <div class="row justify-content-center">
            <div class="col-md-10">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>