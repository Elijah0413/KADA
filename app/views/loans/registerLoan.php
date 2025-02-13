<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Borang Pembiayaan Ahli</title>
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
            font-family: 'Poppins', sans-serif;
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
            background: #2E7D32;
            border-color: #2E7D32;
            font-size: 0.9rem;
            padding: 6px 0;
        }

        .btn-success:hover {
            background: #1B5E20;
            border-color: #1B5E20;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            color: #2E7D32;
            text-decoration: none;
            font-size: 0.95rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .menu-item:hover {
            background-color: #81C784;
            text-decoration: none;
            color: #2E7D32;
        }

        .menu-item i {
            width: 20px;
            margin-right: 10px;
            color: #2E7D32;
        }

        .menu-item .fa-chevron-right {
            margin-left: auto;
            margin-right: 0;
            font-size: 0.75rem;
            color: #2E7D32;
        }

        .menu-item span {
            font-weight: 400;
        }

        /* Active state for menu items */
        .menu-item.active {
            background-color: #81C784;
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

        /* Your existing loan registration styles */
        /* ... keep your existing styles ... */

        .groups-container {
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-sections-container {
            min-height: auto;
        }

        .form-section {
            position: relative;
            padding: 1.5rem;
        }

        /* Animation Helper Classes */
        .slide-in {
            animation: slideIn 0.4s ease-in-out forwards;
        }

        .slide-out {
            animation: slideOut 0.4s ease-in-out forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(-50px);
            }
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
            padding: 0 1rem;
        }

        .step {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ddd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
        }

        .step.active .step-number {
            background-color: #007bff;
        }

        .step.completed .step-number {
            background-color: #28a745;
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            padding: 1rem 0;
        }

        .nav-buttons .btn-secondary {
            margin-right: auto; /* Pushes button to the left */
        }

        .nav-buttons .btn-primary,
        .nav-buttons .btn-success {
            margin-left: auto; /* Pushes button to the right */
        }

       

        footer {
            margin-top: auto;
        }

        .custom-breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb {
            margin-bottom: 0;
            background: transparent;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb-item a:hover {
            color: var(--secondary-color);
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: var(--primary-color);
        }

        .breadcrumb-item.active {
            color: var(--text-dark);
        }

        /* Icon styles */
        .breadcrumb-item i {
            font-size: 1rem;
        }

        .sidebar-menu {
            padding-top: 1rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #212529;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .menu-item:hover {
            background-color: #f8f9fa;
            text-decoration: none;
            color: #212529;
        }

        .menu-item i.fa-chevron-right {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .btn-success {
            background-color: #2E7D32;
            border-color: #2E7D32;
        }

        .btn-success:hover {
            background-color: #1B5E20;
            border-color: #1B5E20;
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
                <img src="/images/default-avatar.png" alt="Pengguna" class="rounded-circle">
                <div class="user-info">
                    <?php
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

            <!-- Add this after the navigation and before the footer -->
            <div class="container mt-4">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="/members/loans" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left"></i> Kembali ke Skim Pembiayaan
                    </a>
                </div>

                

                <!-- Form Card -->
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Borang Permohonan Pembiayaan</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="/loan/store" method="POST" enctype="multipart/form-data" id="loanForm" class="needs-validation" novalidate>
                            <!-- Hidden Fields -->
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
                            <input type="hidden" name="status" value="pending">

                            <!-- Progress Steps -->
                            <div class="progress-steps mb-4">
                                <div class="step active" data-step="1">
                                    <div class="step-number">1</div>
                                    <div class="step-label">Maklumat Pembiayaan</div>
                                </div>
                                <div class="step" data-step="2">
                                    <div class="step-number">2</div>
                                    <div class="step-label">Maklumat Peribadi</div>
                                </div>
                                <div class="step" data-step="3">
                                    <div class="step-number">3</div>
                                    <div class="step-label">Maklumat Penjamin</div>
                                </div>
                                <div class="step" data-step="4">
                                    <div class="step-number">4</div>
                                    <div class="step-label">Pengesahan</div>
                                </div>
                            </div>

                            <!-- Section 1: Loan Information -->
                            <div class="form-section active" id="section1">
                                <h5 class="section-title">Maklumat Pembiayaan</h5>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label required">Jenis Pembiayaan</label>
                                        <select name="loan_type" class="form-select" required>
                                        <option value="">Pilih Jenis Pembiayaan</option>
                                            <option value="Pembiayaan_Al_Bai">Pembiayaan Al-Baiubithaman Ajil</option>
                                            <option value="Pembiayaan_Al_Innah">Pembiayaan Bai Al-Inah</option>
                                            <option value="Pembiayaan_Membaikpulih_Kenderaan">Pembiayaan Membaikpulih Kenderaan</option>
                                            <option value="Pembiayaan_RoadTaxInsuran">Pinjaman Road Tax& Insuran</option>
                                            <option value="Pembiayaan_Skim_Khas">Skim Khas Pembelajaran</option>
                                            <option value="Pembiayaan_Al_Qardhul_Hasan">Pinjaman Kecemasan (Al-Qardhul Hasan)</option>
                                        </select>
                                        <div class="invalid-feedback">Sila pilih jenis pembiayaan</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Amaun Dipohon (RM)</label>
                                        <input type="number" 
                                               name="t_amount" 
                                               id="t_amount" 
                                               class="form-control" 
                                               step="0.01" 
                                               min="0.01" 
                                               placeholder="Masukkan amaun"
                                               oninput="validateAmount(this)"
                                               required>
                                        <div class="invalid-feedback">Sila masukkan amaun yang dipohon</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Tempoh Pembiayaan (Bulan)</label>
                                        <input type="number" name="period" id="period" class="form-control" min="1" max="120" required>
                                        <div class="invalid-feedback">Sila masukkan tempoh pembiayaan</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ansuran Bulanan (RM)</label>
                                        <input type="number" name="mon_installment" id="mon_installment" class="form-control" step="0.01" readonly>
                                    </div>
                                </div>
                                <div class="nav-buttons">
                                    <button type="button" class="btn btn-secondary prev-btn" style="visibility: hidden">Sebelumnya</button>
                                    <button type="button" class="btn btn-primary next-btn" data-next="2">Seterusnya</button>
                                </div>
                            </div>

                            <!-- Section 2: Personal Information -->
                            <div class="form-section" id="section2">
                                <h5 class="section-title">Maklumat Peribadi</h5>
                                <div class="row g-3">
                                    <!-- Basic Information -->
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Penuh</label>
                                        <div class="input-group">
                                            <input type="text" name="name" class="form-control bg-light" 
                                                   value="<?= htmlspecialchars($mappedMemberData['name']) ?>" readonly disabled>
                                            <input type="hidden" name="name" value="<?= htmlspecialchars($mappedMemberData['name']) ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">No. Kad Pengenalan</label>
                                        <div class="input-group">
                                            <input type="text" name="no_ic" class="form-control bg-light" 
                                                   value="<?= htmlspecialchars($mappedMemberData['no_ic']) ?>" readonly disabled>
                                            <input type="hidden" name="no_ic" value="<?= htmlspecialchars($mappedMemberData['no_ic']) ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jantina</label>
                                        <div class="input-group">
                                            <select class="form-select bg-light" id="sex" name="sex" readonly disabled>
                                                <option value="<?php echo htmlspecialchars($mappedMemberData['sex']); ?>"><?php echo htmlspecialchars($mappedMemberData['sex']); ?></option>
                                            </select>
                                            <input type="hidden" name="sex" value="<?php echo htmlspecialchars($mappedMemberData['sex']); ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Agama</label>
                                        <div class="input-group">
                                            <select class="form-select bg-light" id="religion" name="religion" readonly disabled>
                                                <option value="<?= htmlspecialchars($mappedMemberData['religion']) ?>"><?= htmlspecialchars($mappedMemberData['religion']) ?></option>
                                            </select>
                                            <input type="hidden" name="religion" value="<?= htmlspecialchars($mappedMemberData['religion']) ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Bangsa</label>
                                        <input type="text" name="nationality" class="form-control bg-light  <?= !empty($mappedMemberData['nationality'])  ?>" 
                                               value="<?= htmlspecialchars($mappedMemberData['nationality']) ?>" readonly disabled>
                                               <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tarikh Lahir</label>
                                        <div class="input-group">
                                            <input type="date" name="DOB" class="form-control bg-light" 
                                                   value="<?= htmlspecialchars($mappedMemberData['DOB']) ?>" readonly disabled>
                                            <input type="hidden" name="DOB" value="<?= htmlspecialchars($mappedMemberData['DOB']) ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <!-- Home Address -->
                                    <div class="col-md-12">
                                        <label class="form-label">Alamat Rumah</label>
                                        <div class="input-group">
                                            <input type="text" name="add1" class="form-control bg-light" 
                                                   value="<?= htmlspecialchars($mappedMemberData['add1']) ?>" readonly disabled>
                                            <input type="hidden" name="add1" value="<?= htmlspecialchars($mappedMemberData['add1']) ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Poskod</label>
                                        <div class="input-group">
                                            <input type="text" name="postcode1" class="form-control bg-light" 
                                                   value="<?= htmlspecialchars($mappedMemberData['postcode1']) ?>" readonly disabled>
                                            <input type="hidden" name="postcode1" value="<?= htmlspecialchars($mappedMemberData['postcode1']) ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Negeri</label>
                                        <div class="input-group">
                                            <select class="form-select bg-light" id="state1" name="state1" readonly disabled>
                                                <option value="<?= htmlspecialchars($mappedMemberData['state1']) ?>"><?= htmlspecialchars($mappedMemberData['state1']) ?></option>
                                            </select>
                                            <input type="hidden" name="state1" value="<?= htmlspecialchars($mappedMemberData['state1']) ?>">
                                        </div>
                                        <div class="form-text text-muted">
                                            Maklumat ini diambil dari profil anda
                                        </div>
                                    </div>

                                    <!-- Employment Information -->
                                    <div class="col-md-6">
                                        <label class="form-label required">No. Anggota</label>
                                        <input type="text" name="memberID" class="form-control" 
                                               value="<?= htmlspecialchars($user['member_id'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">No. PF</label>
                                        <input type="text" name="PFNo" class="form-control" 
                                               value="<?= htmlspecialchars($user['pf_number'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label required">Jawatan</label>
                                        <input type="text" name="position" class="form-control" required>
                                    </div>

                                    <!-- Office Contact and Address -->
                                    <div class="col-md-6">
                                        <label class="form-label required">No. Telefon Pejabat</label>
                                        <input type="tel" name="office_pNo" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">No. Telefon Bimbit</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+60</span>
                                            <input type="tel" name="pNo" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Office Address -->
                                    <div class="col-md-12">
                                        <label class="form-label required">Alamat Pejabat</label>
                                        <input type="text" name="add2" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Poskod Pejabat</label>
                                        <input type="text" name="postcode2" class="form-control" pattern="[0-9]{5}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Negeri Pejabat</label>
                                        <select name="state2" class="form-select" required>
                                            <option value="">Pilih Negeri</option>
                                            <?php foreach ($states as $state): ?>
                                                <option value="<?= $state ?>"><?= $state ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Bank Information -->
                                    <div class="col-md-6">
                                        <label class="form-label required">Nama Bank</label>
                                        <select name="bankName" class="form-select" required>
                                            <option value="">Pilih Bank</option>
                                            <option value="Maybank">Maybank</option>
                                            <option value="CIMB">CIMB Bank</option>
                                            <option value="RHB">RHB Bank</option>
                                            <option value="Public Bank">Public Bank</option>
                                            <option value="Bank Islam">Bank Islam</option>
                                            <option value="AmBank">AmBank</option>
                                            <option value="Hong Leong">Hong Leong Bank</option>
                                            <option value="Bank Rakyat">Bank Rakyat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">No. Akaun Bank</label>
                                        <input type="text" name="bankAcc" class="form-control" required>
                                    </div>
                                </div>

                                <div class="nav-buttons">
                                    <button type="button" class="btn btn-secondary prev-btn" data-prev="1">Sebelumnya</button>
                                    <button type="button" class="btn btn-primary next-btn" data-next="3">Seterusnya</button>
                                </div>
                            </div>

                            <!-- Section 3: Guarantor Information -->
                            <div class="form-section" id="section3">
                                <h5 class="section-title">Maklumat Penjamin</h5>
                                
                                <!-- First Guarantor -->
                                <div class="info-group">
                                    <h6 class="group-title">Penjamin 1</h6>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label required">Nama Penjamin</label>
                                            <input type="text" name="guarantor_N" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. Kad Pengenalan</label>
                                            <input type="text" name="guarantor_ic" class="form-control" 
                                                   pattern="[0-9]{12}" title="Sila masukkan 12 digit nombor sahaja" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. Telefon</label>
                                            <input type="tel" name="guarantor_pNo" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. PF</label>
                                            <input type="text" name="PFNo1" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. Anggota</label>
                                            <input type="text" name="guarantorMemberID" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Guarantor -->
                                <div class="info-group">
                                    <h6 class="group-title">Penjamin 2</h6>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label required">Nama Penjamin</label>
                                            <input type="text" name="guarantor_N2" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. Kad Pengenalan</label>
                                            <input type="text" name="guarantor_ic2" class="form-control" 
                                                   pattern="[0-9]{12}" title="Sila masukkan 12 digit nombor sahaja" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. Telefon</label>
                                            <input type="tel" name="guarantor_pNo2" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. PF</label>
                                            <input type="text" name="PFNo2" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">No. Anggota</label>
                                            <input type="text" name="guarantorMemberID2" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="nav-buttons">
                                    <button type="button" class="btn btn-secondary prev-btn" data-prev="2">Sebelumnya</button>
                                    <button type="button" class="btn btn-primary next-btn" data-next="4">Seterusnya</button>
                                </div>
                            </div>

                            <!-- Section 4: Confirmation -->
                            <div class="form-section" id="section4">
                                <h5 class="section-title">Pengesahan</h5>

                                <!-- Summary Section -->
                                <div class="info-group mb-4">
                                    <h6 class="group-title">Ringkasan Permohonan</h6>
                                    <div class="summary-details">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                </div>

                                <!-- Terms and Agreements -->
                                <div class="info-group">
                                    <h6 class="group-title">Terma dan Syarat</h6>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="agreement1" required>
                                        <label class="form-check-label" for="agreement1">
                                        Saya mengesahkan bahawa semua maklumat yang diberikan dalam borang ini adalah tepat dan benar. Saya faham bahawa sebarang maklumat palsu yang diberikan boleh menyebabkan permohonan ditolak dan tindakan undang-undang boleh diambil.
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="agreement2" required>
                                        <label class="form-check-label" for="agreement2">
                                        Saya bersetuju untuk memberi kuasa kepada KOPERASI KAKITANGAN KADA KELANTAN BHD atau wakilnya yang sah untuk medapat apa-apa maklumat yang diperlukan dan juga medapatkan bayaran balik dari potongan gaji dan emolumen saya sebagaimana amaun yang dipinjamkan.
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="agreement3" required>
                                        <label class="form-check-label" for="agreement3">
                                        Saya bersetuju menerima sebarang keputusan dari KOPERASI in untuk menolak permohonan tanpa memberi sebarang alasan.
                                        </label>
                                    </div>
                                </div>

                                <div class="nav-buttons">
                                    <button type="button" class="btn btn-secondary prev-btn" data-prev="3">Sebelumnya</button>
                                    <button type="submit" class="btn btn-success" id="submitBtn">Hantar Permohonan</button>
                                </div>
                            </div>
                        </form>

                        <!-- JavaScript for Form Handling -->
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const sections = document.querySelectorAll('.form-section');
                            const steps = document.querySelectorAll('.step');
                            let currentSection = 1;

                            function showSection(sectionNumber) {
                                // Hide all sections
                                sections.forEach(section => section.classList.remove('active'));
                                
                                // Show current section
                                document.getElementById(`section${sectionNumber}`).classList.add('active');
                                
                                // Update steps
                                steps.forEach((step, index) => {
                                    if (index + 1 < sectionNumber) {
                                        step.classList.add('completed');
                                        step.classList.remove('active');
                                    } else if (index + 1 === sectionNumber) {
                                        step.classList.add('active');
                                        step.classList.remove('completed');
                                    } else {
                                        step.classList.remove('completed', 'active');
                                    }
                                });

                                // Update buttons
                                updateNavigationButtons(sectionNumber);
                            }

                            function updateNavigationButtons(sectionNumber) {
                                const prevButtons = document.querySelectorAll('.prev-btn');
                                const nextButtons = document.querySelectorAll('.next-btn');
                                const submitBtn = document.getElementById('submitBtn');

                                // Update Previous buttons
                                prevButtons.forEach(btn => {
                                    btn.style.display = sectionNumber === 1 ? 'none' : 'block';
                                });

                                // Update Next/Submit buttons
                                nextButtons.forEach(btn => {
                                    btn.style.display = sectionNumber === 4 ? 'none' : 'block';
                                });
                                if (submitBtn) {
                                    submitBtn.style.display = sectionNumber === 4 ? 'block' : 'none';
                                }
                            }

                            // Navigation button handlers
                            document.querySelectorAll('.next-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    if (validateCurrentSection(currentSection)) {
                                        currentSection++;
                                        showSection(currentSection);
                                    }
                                });
                            });

                            document.querySelectorAll('.prev-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    currentSection--;
                                    showSection(currentSection);
                                });
                            });

                            function validateCurrentSection(sectionNumber) {
                                const currentSection = document.getElementById(`section${sectionNumber}`);
                                const requiredFields = currentSection.querySelectorAll('[required]');
                                let isValid = true;

                                requiredFields.forEach(field => {
                                    if (!field.value) {
                                        isValid = false;
                                        field.classList.add('is-invalid');
                                    } else {
                                        field.classList.remove('is-invalid');
                                    }
                                });

                                if (!isValid) {
                                    alert('Sila lengkapkan semua maklumat yang diperlukan.');
                                }

                                return isValid;
                            }

                            // Initialize first section
                            showSection(1);
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer - Moved outside container -->
    <footer class="bg-dark text-light py-3 mt-auto" id="contactInfo">
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

        function openQRModal(imgSrc) {
            document.getElementById('modalQRImage').src = imgSrc;
            new bootstrap.Modal(document.getElementById('qrModal')).show();
        }

        // Your existing form validation and functionality scripts
        // ... keep your existing scripts ...

        document.addEventListener('DOMContentLoaded', function() {
            // File size validation
            const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB in bytes
            const fileInputs = document.querySelectorAll('input[type="file"]');

            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.files[0].size > MAX_FILE_SIZE) {
                        alert('Fail terlalu besar. Sila pilih fail yang kurang daripada 5MB.');
                        this.value = '';
                    }
                });
            });

            // Form validation before submission
            const loanForm = document.getElementById('loanForm');
            loanForm.addEventListener('submit', function(e) {
                if (!document.getElementById('agree_terms').checked || 
                    !document.getElementById('agree_processing').checked) {
                    e.preventDefault();
                    alert('Sila tandakan semua kotak pengesahan sebelum menghantar permohonan.');
                }
            });

            // Guarantor IC validation
            const guarantorIC = document.querySelector('input[name="guarantor_ic"]');
            guarantorIC.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 12) {
                    this.value = this.value.slice(0, 12);
                }
            });

            // Phone number validation
            const phoneInputs = document.querySelectorAll('input[type="tel"]');
            phoneInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Form navigation
            const sections = document.querySelectorAll('.form-section');
            const steps = document.querySelectorAll('.step');
            
            function showSection(sectionNumber) {
                sections.forEach(section => section.classList.remove('active'));
                steps.forEach((step, index) => {
                    if (index < sectionNumber) {
                        step.classList.add('completed');
                    } else {
                        step.classList.remove('completed');
                    }
                });
                document.getElementById(`section${sectionNumber}`).classList.add('active');
            }

            // Navigation buttons
            document.querySelectorAll('.next-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const nextSection = this.getAttribute('data-next');
                    if (validateSection(parseInt(nextSection) - 1)) {
                        showSection(nextSection);
                    }
                });
            });

            document.querySelectorAll('.prev-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const prevSection = this.getAttribute('data-prev');
                    showSection(prevSection);
                });
            });

            // Loan calculation
            const loanAmount = document.getElementById('t_amount');
            const loanPeriod = document.getElementById('period');
            const monthlyInstallment = document.getElementById('mon_installment');
            
            function calculateMonthlyInstallment() {
                const amount = parseFloat(loanAmount.value) || 0;
                const months = parseInt(loanPeriod.value) || 0;
                const annualInterestRate = 4.196; // 4.2% per year
                
                if (amount > 0 && months > 0) {
                    const monthlyInterestRate = annualInterestRate / 12 / 100;
                    const installment = (amount * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, months)) / 
                                      (Math.pow(1 + monthlyInterestRate, months) - 1);
                    monthlyInstallment.value = installment.toFixed(2);
                }
            }

            loanAmount.addEventListener('input', calculateMonthlyInstallment);
            loanPeriod.addEventListener('input', calculateMonthlyInstallment);

            // Form validation
            function validateSection(sectionNumber) {
                const currentSection = document.getElementById(`section${sectionNumber}`);
                const inputs = currentSection.querySelectorAll('input[required], select[required]');
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.value) {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Sila lengkapkan semua maklumat yang diperlukan.');
                }

                return isValid;
            }

            // Form submission
            const form = document.getElementById('loanForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!validateSection(4)) {
                    return;
                }

                if (!document.getElementById('agreement1').checked ||
                    !document.getElementById('agreement2').checked ||
                    !document.getElementById('agreement3').checked) {
                    alert('Sila tandakan semua persetujuan sebelum menghantar permohonan.');
                    return;
                }

                // Submit form
                this.submit();
            });
        });

        // Loan amount limits object
        const loanLimits = {
            'Pembiayaan_Al_Baiubithaman_Ajil': 15000,
            'Pembiayaan_Bai_Al_Inah': 10000,
            'Pembiayaan_Membaikpulih_Kenderaan': 2000,
            'Pembiayaan_Al_Qardhul_Hasan': 500,
            'Pembiayaan_RoadTaxInsuran': 1000,
            'Skim_Khas_Pembelajaran': 2000
        };

        // Add event listener to loan type select
        document.querySelector('select[name="loan_type"]').addEventListener('change', function() {
            const selectedLoanType = this.value;
            const amountInput = document.getElementById('t_amount');
            
            if (selectedLoanType && loanLimits[selectedLoanType]) {
                amountInput.max = loanLimits[selectedLoanType];
                amountInput.title = `Jumlah maksimum: RM${loanLimits[selectedLoanType].toLocaleString('en-MY')}`;
            }
        });

        // Validate amount function
        function validateAmount(input) {
            const selectedLoanType = document.querySelector('select[name="loan_type"]').value;
            const maxAmount = loanLimits[selectedLoanType];
            
            if (maxAmount && parseFloat(input.value) > maxAmount) {
                input.value = maxAmount;
                alert(`Jumlah maksimum untuk pinjaman ini adalah RM${maxAmount.toLocaleString('en-MY')}`);
            }
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

        document.addEventListener('DOMContentLoaded', function() {
            // Add click handlers for breadcrumb navigation
            const breadcrumbLinks = document.querySelectorAll('.breadcrumb-item a');
            breadcrumbLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // You can add any additional navigation logic here if needed
                    window.location.href = this.getAttribute('href');
                });
            });
        });
    </script>
</body>
</html>





