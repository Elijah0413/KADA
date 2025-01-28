<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Ahli - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        /* Copy the same root variables and background styles from admin */
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
        }

        /* Sidebar styles */
        .sidebar {
            background: #ffffff;
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            margin-top: 85px;
            border-right: 1px solid #e0e0e0;
            transition: transform 0.3s ease;
        }

        .sidebar-content {
            padding: 1rem;
        }

        .sidebar-title {
            color: #2E7D32;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            padding: 0;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            color: #333333;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            width: 1.75rem;
            margin-right: 0.5rem;
            color: #2E7D32;
        }

        .sidebar-link:hover {
            background-color: #E8F5E9;
            color: #2E7D32;
            transform: translateX(3px);
        }

        .sidebar-link.active {
            background-color: #E8F5E9;
            color: #2E7D32;
            font-weight: 500;
            border-left: 3px solid #2E7D32;
        }

        /* Style for external navigation links */
        .sidebar-link[onclick] {
            cursor: pointer;
            color: var(--primary-color);
        }

        .sidebar-link[onclick]:hover {
            background-color: var(--accent-color);
            color: white;
        }

        /* Main content styles */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            margin-top: 85px;
            min-height: calc(100vh - 90px);
            transition: margin-left 0.3s ease;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        /* Card styles */
        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .text-center.py-5 {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 3rem !important;
        }

        .text-center.py-5 .fas.fa-user-plus {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .text-center.py-5 h3 {
            color: var(--text-dark);
            font-weight: 600;
        }

        .text-center.py-5 p {
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-success.btn-lg {
            padding: 1rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success.btn-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
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

        /* Section spacing */
        .sidebar-title:not(:first-child) {
            margin-top: 1rem;
        }

        /* Termination link styling */
        .list-group {
            margin-top: 1rem;
        }

        .list-group-item {
            border-radius: 6px;
            margin-top: 0.5rem;
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
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

    

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-content">
            <h4 class="sidebar-title">Maklumat Profil</h4>
            <nav class="sidebar-nav">
                <a href="#personal-info" class="sidebar-link">
                    <i class="bi bi-person"></i>
                    <span>Maklumat Peribadi</span>
                </a>
                <a href="#employment-info" class="sidebar-link">
                    <i class="bi bi-briefcase"></i>
                    <span>Maklumat Pekerjaan</span>
                </a>
                <a href="#contact-info" class="sidebar-link">
                    <i class="bi bi-envelope"></i>
                    <span>Maklumat Perhubungan</span>
                </a>
                <a href="#family-info" class="sidebar-link">
                    <i class="bi bi-people"></i>
                    <span>Maklumat Keluarga</span>
                </a>
            </nav>

            <h4 class="sidebar-title mt-4">Status</h4>
            <a href="/members/dashboard" class="sidebar-link" onclick="window.location.href='/members/dashboard'; return false;">
                <i class="bi bi-clipboard-data"></i>
                <span>Status Permohonan</span>
            </a>

            <h4 class="sidebar-title mt-4">Kewangan</h4>
            <a href="/members/saving_acc" class="sidebar-link" onclick="window.location.href='/members/saving_acc'; return false;">
                <i class="bi bi-piggy-bank"></i>
                <span>Akaun Simpanan</span>
            </a>

            <div class="list-group mb-4">
                <a href="/members/termination" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-user-times text-danger me-2"></i>
                        Tamat Keahlian
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php if (!$memberApplication): ?>
            <!-- Show registration prompt when no membership exists -->
            <div class="content-container">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-user-plus fa-4x"></i>
                    </div>
                    <h3 class="mb-3">Lengkapkan Profil Anda</h3>
                    <p class="text-muted mb-4">
                        Untuk melihat profil anda, sila lengkapkan borang pendaftaran keahlian terlebih dahulu.
                    </p>
                    <a href="/member-profile" class="btn btn-success btn-lg">
                        <i class="fas fa-file-alt me-2"></i>
                        Isi Borang Pendaftaran Keahlian
                    </a>
                </div>
            </div>
        <?php else: ?>
            <?php if (isset($pendingData['status']) && $pendingData['status'] === 'inactive'): ?>
                <!-- Message for inactive members -->
                <div class="content-container">
                    <div class="alert alert-warning" role="alert">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-times fa-3x text-warning mb-3"></i>
                            <h4 class="alert-heading">Status Keahlian Tidak Aktif</h4>
                            <hr>
                            <p class="mb-3">Anda bukan lagi ahli dalam sistem koperasi KADA.</p>
                        </div>
                        
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Untuk Memohon Semula Keahlian:
                                </h5>
                                
                                <div class="mb-3">
                                    <strong><i class="fas fa-envelope me-2"></i>Emel:</strong>
                                    <a href="mailto:koperasi_kada@yahoo.com" class="text-decoration-none ms-2">
                                        koperasi_kada@yahoo.com
                                    </a>
                                </div>

                                <div class="mb-3">
                                    <strong><i class="fas fa-phone me-2"></i>Telefon:</strong>
                                    <span class="ms-2">+09-7447088 samb. 5339 @ 5312</span>
                                </div>

                                <div>
                                    <strong><i class="fas fa-map-marker-alt me-2"></i>Alamat:</strong>
                                    <address class="ms-4 mb-0">
                                        Lembaga Kemajuan Pertanian Kemubu<br>
                                        Peti Surat 127, Bandar Kota Bharu,<br>
                                        15710 Kota Bharu, Kelantan
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Update the profile header -->
                <div class="content-container mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user text-success me-2 fs-3"></i>
                            <div>
                                <h4 class="mb-0 d-flex align-items-center gap-2">
                                    <?= htmlspecialchars($pendingData['name']) ?>
                                    <?php if (isset($pendingData['status'])): ?>
                                        <?php if ($pendingData['status'] === 'pending'): ?>
                                            <span class="badge bg-warning" style="font-size: 0.7em;">
                                                <i class="fas fa-clock me-1"></i>
                                                Menunggu Pengesahan
                                            </span>
                                        <?php elseif ($pendingData['status'] === 'approved'): ?>
                                            <span class="badge bg-success" style="font-size: 0.7em;">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Telah Disahkan
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </h4>
                                <p class="text-muted mb-0">Maklumat profil anda</p>
                            </div>
                        </div>
                        <div>
                            <a href="/members/edit-profile" class="btn btn-success">
                                <i class="fas fa-pencil me-2"></i>Kemaskini
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Status Messages -->
                <?php if (isset($pendingData['status'])): ?>
                    <?php if ($pendingData['status'] === 'rejected'): ?>
                        <div class="alert alert-danger shadow-sm mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Status Keahlian: Ditolak</h6>
                                    <p class="mb-0">Permohonan keahlian anda telah ditolak. Anda boleh:</p>
                                    <ul class="mb-0 mt-1">
                                        <li>Semak sebab penolakan melalui emel anda</li>
                                        <li>Lihat butiran penolakan di <a href="/members/dashboard" class="alert-link">Papan Pemuka Permohonan</a></li>
                                        <li>Sila <a href="/members/edit-profile" class="alert-link">kemaskini profil</a> anda untuk memohon semula</li>
                                    </ul>
                                    <p class="small mt-2 mb-0">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Sebelum profil anda diluluskan, anda tidak boleh:
                                    </p>
                                    <ul class="small mb-0 mt-1">
                                        <li>Memohon pinjaman</li>
                                        <li>Mengurus akaun simpanan anda</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($pendingData['status'] === 'pending'): ?>
                        <div class="alert alert-warning shadow-sm mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Status Keahlian: Dalam Proses</h6>
                                    <p class="mb-0">Beberapa ciri hanya tersedia untuk ahli yang diluluskan.</p>
                                    <p class="small mt-2 mb-0">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Sebelum profil anda diluluskan, anda tidak boleh:
                                    </p>
                                    <ul class="small mb-0 mt-1">
                                        <li>Memohon pinjaman</li>
                                        <li>Mengurus akaun simpanan anda</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Personal Information Section -->
                <div id="personal-info" class="content-container mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">
                            <i class="bi bi-person-circle text-success me-2"></i>
                            Maklumat Peribadi
                        </h5>
                        <a href="/members/edit-profile#personal-info" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-pencil me-1"></i>
                            Kemaskini
                        </a>
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th style="width: 30%">Nama</th>
                                        <td><?= htmlspecialchars($pendingData['name']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. KP</th>
                                        <td><?= htmlspecialchars($pendingData['ic_no']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jantina</th>
                                        <td><?= htmlspecialchars($pendingData['gender']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td><?= htmlspecialchars($pendingData['religion']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bangsa</th>
                                        <td><?= htmlspecialchars($pendingData['race']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status Perkahwinan</th>
                                        <td><?= htmlspecialchars($pendingData['marital_status']) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employment Information Section -->
                <div id="employment-info" class="content-container mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">
                            <i class="bi bi-briefcase text-success me-2"></i>
                            Maklumat Pekerjaan
                        </h5>
                        <a href="/members/edit-profile#employment-info" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-pencil me-1"></i>
                            Kemaskini
                        </a>
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th style="width: 30%">No. Ahli</th>
                                        <td><?= htmlspecialchars($pendingData['member_number']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. PF</th>
                                        <td><?= htmlspecialchars($pendingData['pf_number']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jawatan</th>
                                        <td><?= htmlspecialchars($pendingData['position']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gred</th>
                                        <td><?= htmlspecialchars($pendingData['grade']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gaji Bulanan</th>
                                        <td>RM <?= number_format($pendingData['monthly_salary'], 2) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div id="contact-info" class="content-container mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">
                            <i class="bi bi-envelope text-success me-2"></i>
                            Maklumat Perhubungan
                        </h5>
                        <a href="/members/edit-profile#contact-info" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-pencil me-1"></i>
                            Kemaskini
                        </a>
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th style="width: 30%">Alamat Rumah</th>
                                        <td>
                                            <?= htmlspecialchars($pendingData['home_address']) ?><br>
                                            <?= htmlspecialchars($pendingData['home_postcode']) ?> 
                                            <?= htmlspecialchars($pendingData['home_city']) ?><br>
                                            <?= htmlspecialchars($pendingData['home_state']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Pejabat</th>
                                        <td>
                                            <?= htmlspecialchars($pendingData['office_address']) ?><br>
                                            <?= htmlspecialchars($pendingData['office_postcode']) ?>
                                            <?= htmlspecialchars($pendingData['office_city']) ?><br>
                                            <?= htmlspecialchars($pendingData['office_state']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tel. Pejabat</th>
                                        <td><?= htmlspecialchars($pendingData['office_phone']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tel. Rumah</th>
                                        <td><?= htmlspecialchars($pendingData['home_phone']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. Faks</th>
                                        <td><?= htmlspecialchars($pendingData['fax']) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Information Section -->
                <div id="family-info" class="content-container mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">
                            <i class="bi bi-people text-success me-2"></i>
                            Maklumat Keluarga
                        </h5>
                        <a href="/members/edit-profile#family-info" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-pencil me-1"></i>
                            Kemaskini
                        </a>
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <?php if (!empty($pendingData['family_members'])): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>No. KP</th>
                                                <th>Hubungan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pendingData['family_members'] as $family): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($family['name']) ?></td>
                                                    <td><?= htmlspecialchars($family['ic_no']) ?></td>
                                                    <td><?= htmlspecialchars($family['relationship']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0">Tiada maklumat keluarga direkodkan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Add Profile Sidebar -->
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

    <!-- Add Logout Confirmation Modal -->
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
                    <a href="/logout" class="btn btn-danger">Log Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for sidebar links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                window.scrollTo({
                    top: targetSection.offsetTop - 100, // Adjust offset for fixed header
                    behavior: 'smooth'
                });
            });
        });

        // Update active sidebar link on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.content-container');
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            sidebarLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

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
</body>
</html>
