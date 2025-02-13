<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Pemuka Ahli - KOPERASI KAKITANGAN KADA KELANTAN BHD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
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

        /* Layout Styles */
        .main-wrapper {
            flex: 1;
            padding: 2rem 4rem;
            margin-top: 100px;
            min-height: calc(100vh - 200px);
            display: flex;
            flex-direction: column;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            width: 100%;
            max-width: 1400px;
            padding: 2rem;
            flex: 1;
        }

        /* Welcome Section Styles */
        .welcome-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .welcome-logo {
            width: 100px;
            height: auto;
        }

        /* Status Cards Styles */
        .status-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .status-card {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .status-card.pending {
            border-top: 3px solid #FFA000;
        }

        .status-card.approved {
            border-top: 3px solid #2E7D32;
        }

        .status-card.rejected {
            border-top: 3px solid #D32F2F;
        }

        .status-icon {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .status-card.pending .status-icon {
            color: #FFA000;
        }

        .status-card.approved .status-icon {
            color: #2E7D32;
        }

        .status-card.rejected .status-icon {
            color: #D32F2F;
        }

        .status-title {
            color: #616161;
            font-size: 0.8rem;
            margin-bottom: 0.25rem;
        }

        .status-count {
            font-size: 1.5rem;
            font-weight: 600;
            color: #212121;
        }

        /* Applications Table Styles */
        .applications-table {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #616161;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }

        .status-pending {
            background-color: #FFF3E0;
            color: #F57C00;
        }

        .status-approved {
            background-color: #E8F5E9;
            color: #2E7D32;
        }

        .status-rejected {
            background-color: #FFEBEE;
            color: #C62828;
        }

        .btn-details {
            background-color: #E3F2FD;
            color: #1976D2;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: background-color 0.2s;
        }

        .btn-details:hover {
            background-color: #BBDEFB;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
        }

        .empty-state i {
            font-size: 3rem;
            color: #9E9E9E;
            margin-bottom: 1rem;
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

        @media (max-width: 768px) {
            .main-wrapper {
                padding: 1rem;
            }
            
            .content-container {
                padding: 1rem;
            }

            .status-cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }

            .table-responsive {
                margin: 0 -1rem;
            }
        }

        /* Add these styles to your existing CSS */
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

        @media print {
            /* Reset the page */
            @page {
                margin: 0;
                size: auto;
            }

            /* Hide everything */
            body * {
                visibility: hidden;
            }

            /* Show only the print content */
            .print-content {
                visibility: visible !important;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
                margin: 0;
            }

            .print-content * {
                visibility: visible !important;
            }

            /* Hide modal elements */
            .modal,
            .modal-dialog,
            .modal-content {
                position: static !important;
                transform: none !important;
                padding: 0 !important;
                margin: 0 !important;
                border: none !important;
                box-shadow: none !important;
            }

            /* Hide these elements when printing */
            .modal-header,
            .modal-footer,
            .btn-close {
                display: none !important;
            }

            /* Reset status badge for print */
            .status-badge {
                border: 1px solid #000 !important;
                color: #000 !important;
                background: none !important;
            }

            /* Ensure footer stays at bottom when printing */
            .print-content {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            
            .print-content > div:last-child {
                margin-top: auto;
            }
            
            /* Adjust margins for better print layout */
            @page {
                margin: 15mm;
                size: A4;
            }
        }

        /* Add new styles for member status badge */
        .member-status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .member-status-badge i {
            font-size: 0.8rem;
        }

        .member-status-badge.status-pending {
            background-color: #FFF3E0;
            color: #F57C00;
            border: 1px solid #FFE0B2;
        }

        .member-status-badge.status-pending i {
            animation: pulse 2s infinite;
        }

        .member-status-badge.status-approved {
            background-color: #E8F5E9;
            color: #2E7D32;
            border: 1px solid #C8E6C9;
        }

        .member-status-badge.status-rejected {
            background-color: #FFEBEE;
            color: #C62828;
            border: 1px solid #FFCDD2;
        }

        .member-status-badge.status-inactive {
            background-color: #EEEEEE;
            color: #757575;
            border: 1px solid #E0E0E0;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.6; }
            100% { opacity: 1; }
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

    <div class="main-wrapper">
        <div class="content-container">
            <?php if (!$memberApplication): ?>
                <!-- Show this when no membership application exists -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-user-plus fa-4x"></i>
                    </div>
                    <h3 class="mb-3">Selamat Datang ke Portal Ahli Koperasi Kakitangan KADA</h3>
                    <p class="text-muted mb-4">
                        Untuk menjadi ahli Koperasi Kakitangan KADA, sila lengkapkan borang pendaftaran keahlian.
                    </p>
                    <a href="/member-profile" class="btn btn-success btn-lg">
                        <i class="fas fa-file-alt me-2"></i>
                        Isi Borang Pendaftaran Keahlian
                    </a>
                </div>
            <?php else: ?>
                <?php if (isset($memberApplication['status']) && $memberApplication['status'] === 'inactive'): ?>
                    <!-- Message for inactive members - above the table -->
                    <div class="alert alert-warning mb-4" role="alert">
                        <div class="text-center mb-3">
                            <i class="fas fa-exclamation-circle fa-lg text-warning mb-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Status Keahlian Tidak Aktif</h5>
                                <p class="mb-0">Anda bukan lagi ahli dalam sistem koperasi KADA.</p>
                            </div>
                        </div>
                        
                        <!-- Email notification - highlighted -->
                        <div class="alert alert-info mb-3 text-center">
                            <i class="fas fa-envelope-open-text me-2"></i>
                            <strong>Sila semak emel anda untuk maklumat lanjut.</strong>
                        </div>

                        <!-- Membership reapplication info -->
                        <div class="small text-center">
                            <p class="mb-2">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Untuk Memohon Semula Keahlian:</strong>
                            </p>
                            <div>
                                <p class="mb-2">
                                    <i class="fas fa-envelope me-2"></i>
                                    <strong>Emel:</strong>
                                    <a href="mailto:koperasi_kada@yahoo.com" class="text-decoration-none ms-1">
                                        koperasi_kada@yahoo.com
                                    </a>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-phone me-2"></i>
                                    <strong>Telefon:</strong>
                                    <span class="ms-1">+09-7447088 samb. 5339 @ 5312</span>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <strong>Alamat:</strong>
                                    <div class="mt-1">
                                        Lembaga Kemajuan Pertanian Kemubu<br>
                                        Peti Surat 127, Bandar Kota Bharu,<br>
                                        15710 Kota Bharu, Kelantan
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Existing dashboard content for active members -->
                <div class="welcome-section py-3">
                    <h2 class="h4 mb-3">Papan Pemuka Ahli</h2>
                    <div class="d-flex align-items-center">
                        <img src="/images/default-avatar.png" alt="Logo" class="welcome-logo me-3" style="width: 48px; height: 48px;">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <h2 class="h5 mb-0"><?php echo htmlspecialchars($member->full_name ?? 'Tetamu'); ?></h2>
                                <span class="member-status-badge status-<?php echo strtolower($memberApplication['status']); ?>">
                                    <i class="fas <?php echo getStatusIcon($memberApplication['status']); ?> me-1"></i>
                                    <?php echo getStatusText($memberApplication['status']); ?>
                                </span>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                <span id="currentDateTime">
                                    <?php 
                                    date_default_timezone_set('Asia/Kuala_Lumpur');
                                    echo date('d M Y, h:i A'); 
                                    ?>
                                </span>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Status Cards -->
                <div class="status-cards">
                    <!-- Remove membership card and keep only loan cards -->
                    <div class="status-card pending">
                        <div class="status-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="status-title">Pinjaman Dalam Proses</div>
                        <div class="status-count"><?php echo count(array_filter($applications, fn($a) => strtoupper($a['status']) === 'PENDING')); ?></div>
                    </div>
                    <div class="status-card approved">
                        <div class="status-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="status-title">Pinjaman Diluluskan</div>
                        <div class="status-count"><?php echo count(array_filter($applications, fn($a) => strtoupper($a['status']) === 'APPROVED')); ?></div>
                    </div>
                    <div class="status-card rejected">
                        <div class="status-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="status-title">Pinjaman Ditolak</div>
                        <div class="status-count"><?php echo count(array_filter($applications, fn($a) => strtoupper($a['status']) === 'REJECTED')); ?></div>
                    </div>
                </div>

                <!-- Applications Table -->
                <div class="applications-table">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No. Rujukan</th>
                                    <th>Tarikh</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($memberApplication)): ?>
                                    <!-- Membership Application Row -->
                                    <tr>
                                        <td>#M<?php echo $memberApplication['id']; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($memberApplication['created_at'])); ?></td>
                                        <td>Permohonan Keahlian</td>
                                        <td>
                                            <span class="status-badge status-<?php echo strtolower($memberApplication['status']); ?>">
                                                <?php echo getStatusText($memberApplication['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-details btn-sm" data-bs-toggle="modal" data-bs-target="#membershipModal">
                                                Lihat Butiran
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (isset($terminationRequest) && !empty($terminationRequest) && isset($terminationRequest['id'])): ?>
                                    <!-- Termination Application Row -->
                                    <tr>
                                        <td>#T<?php echo htmlspecialchars($terminationRequest['id']); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($terminationRequest['created_at'])); ?></td>
                                        <td>Penamatan Keahlian</td>
                                        <td>
                                            <span class="status-badge status-<?php echo strtolower($terminationRequest['status']); ?>">
                                                <?php 
                                                switch(strtolower($terminationRequest['status'])) {
                                                    case 'pending':
                                                        echo 'Dalam Proses';
                                                        break;
                                                    case 'approved':
                                                        echo 'Diluluskan';
                                                        break;
                                                    case 'rejected':
                                                        echo 'Ditolak';
                                                        break;
                                                    default:
                                                        echo ucfirst($terminationRequest['status']);
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-details btn-sm" data-bs-toggle="modal" data-bs-target="#terminationModal">
                                                Lihat Butiran
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                
                                <?php foreach ($applications as $application): ?>
                                    <tr>
                                        <td>#L<?php echo $application['id']; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($application['created_at'])); ?></td>
                                        <td><?php echo $application['loan_type']; ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo strtolower($application['status']); ?>">
                                                <?php echo getStatusText($application['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-details btn-sm" data-bs-toggle="modal" data-bs-target="#loanModal<?php echo $application['id']; ?>">
                                                Lihat Butiran
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Toast Notification for No Results -->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="noResultsToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-warning text-dark">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong class="me-auto">Notifikasi</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Tiada rekod dijumpai untuk carian ini.
                        </div>
                    </div>
                </div>

                <!-- Add this JavaScript at the bottom of your file -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Check if we have any results
                        const hasResults = <?php echo (!empty($applications) || !empty($memberApplication)) ? 'true' : 'false'; ?>;
                        const isFiltered = <?php echo (isset($_GET['month']) || isset($_GET['application_type'])) ? 'true' : 'false'; ?>;
                        
                        // Show toast if no results and filters are applied
                        if (!hasResults && isFiltered) {
                            const toast = new bootstrap.Toast(document.getElementById('noResultsToast'));
                            toast.show();
                        }

                        // Hide empty rows if no data
                        if (!hasResults) {
                            document.querySelector('.table').style.display = 'none';
                        }
                    });
                </script>
            <?php endif; ?>
        </div>
    </div>

    <!-- Profile Sidebar -->
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
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Keluar</a>
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

    <!-- Membership Application Modal -->
    <?php if ($memberApplication): ?>
    <div class="modal fade" id="membershipModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Butiran Permohonan Keahlian #M<?php echo htmlspecialchars($memberApplication['id']); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body print-content">
                    <!-- Header -->
                    <div class="text-end mb-2 small">
                        <div><?php echo date('d/m/Y', strtotime($memberApplication['updated_at'] ?? $memberApplication['created_at'])); ?></div>
                        <div><?php echo date('h:i A', strtotime($memberApplication['updated_at'] ?? $memberApplication['created_at'])); ?></div>
                    </div>
                    
                    <!-- Organization Name -->
                    <div class="text-center mb-4">
                        <img src="/images/logo.jpg" alt="KADA Logo" style="height: 60px;" class="mb-2">
                        <h6 class="fw-bold mb-1">KOPERASI KAKITANGAN KADA KELANTAN BHD</h6>
                        <p class="small text-muted mb-0">Resit Permohonan Keahlian</p>
                    </div>

                    <!-- Receipt Content -->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>No. Rujukan:</strong></div>
                            <div class="col-7">#M<?php echo htmlspecialchars($memberApplication['id']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Tarikh Mohon:</strong></div>
                            <div class="col-7"><?php echo date('d/m/Y', strtotime($memberApplication['created_at'])); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Masa:</strong></div>
                            <div class="col-7"><?php echo date('h:i A', strtotime($memberApplication['created_at'])); ?></div>
                        </div>
                    </div>

                    <div class="border-bottom pb-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>Nama Penuh:</strong></div>
                            <div class="col-7"><?php echo htmlspecialchars($memberApplication['name']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>No. KP:</strong></div>
                            <div class="col-7"><?php echo htmlspecialchars($memberApplication['ic_no']); ?></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>Status:</strong></div>
                            <div class="col-7">
                                <span class="status-badge status-<?php echo strtolower($memberApplication['status']); ?>">
                                    <?php echo getStatusText($memberApplication['status']); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php if ($memberApplication['status'] === 'rejected' && !empty($memberApplication['admin_remark'])): ?>
                        <div class="alert alert-danger">
                            <h6 class="alert-heading">Sebab Penolakan:</h6>
                            <p class="mb-0"><?php echo nl2br(htmlspecialchars($memberApplication['admin_remark'])); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Footer -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="text-center small">
                            <p class="mb-1"><strong>KOPERASI KAKITANGAN KADA KELANTAN BHD</strong></p>
                            <p class="mb-1">Lot 1-2-3, Bangunan KADA, Jalan Sultan Yahya Petra,</p>
                            <p class="mb-1">15200 Kota Bharu, Kelantan</p>
                            <p class="mb-1">Tel: 09-7475770 | Faks: 09-7484670</p>
                            <p class="mb-0">Emel: koperasi@kada.gov.my</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Update the Modal for Loan Details -->
    <?php foreach ($applications as $application): ?>
    <div class="modal fade" id="loanModal<?php echo $application['id']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Butiran Pinjaman #L<?php echo htmlspecialchars($application['id']); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body print-content">
                    <!-- Header -->
                    <div class="text-end mb-2 small">
                        <div><?php echo date('d/m/Y', strtotime($application['updated_at'] ?? $application['created_at'])); ?></div>
                        <div><?php echo date('h:i A', strtotime($application['updated_at'] ?? $application['created_at'])); ?></div>
                    </div>
                    
                    <!-- Organization Name -->
                    <div class="text-center mb-4">
                        <img src="/images/logo.jpg" alt="KADA Logo" style="height: 60px;" class="mb-2">
                        <h6 class="fw-bold mb-1">KOPERASI KAKITANGAN KADA KELANTAN BHD</h6>
                        <p class="small text-muted mb-0">Resit Permohonan Pinjaman</p>
                    </div>

                    <!-- Receipt Content -->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>No. Rujukan:</strong></div>
                            <div class="col-7">#L<?php echo htmlspecialchars($application['id']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Tarikh Mohon:</strong></div>
                            <div class="col-7"><?php echo date('d/m/Y', strtotime($application['created_at'])); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Masa:</strong></div>
                            <div class="col-7"><?php echo date('h:i A', strtotime($application['created_at'])); ?></div>
                        </div>
                    </div>

                    <div class="border-bottom pb-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>Nama Pemohon:</strong></div>
                            <div class="col-7"><?php echo htmlspecialchars($application['name']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>No. KP:</strong></div>
                            <div class="col-7"><?php echo htmlspecialchars($application['no_ic']); ?></div>
                        </div>
                    </div>

                    <div class="border-bottom pb-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>Jenis Pinjaman:</strong></div>
                            <div class="col-7"><?php echo htmlspecialchars($application['loan_type']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Jumlah:</strong></div>
                            <div class="col-7">RM <?php echo number_format($application['t_amount'], 2); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Tempoh:</strong></div>
                            <div class="col-7">
                                <?php 
                                if (isset($application['period']) && !empty($application['period'])) {
                                    $years = floor($application['period'] / 12);
                                    $months = $application['period'];
                                    echo htmlspecialchars($years) . ' tahun / ' . htmlspecialchars($months) . ' bulan';
                                } else {
                                    echo '-';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Ansuran Bulanan:</strong></div>
                            <div class="col-7">
                                <?php 
                                if (isset($application['monthly_payment']) && !empty($application['monthly_payment'])) {
                                    echo 'RM ' . number_format($application['monthly_payment'], 2);
                                } else {
                                    // Calculate monthly payment if not stored
                                    $principal = $application['t_amount'];
                                    $months = $application['period'];
                                    $interestRate = 0.042; // 5% annual interest rate
                                    
                                    $monthlyRate = $interestRate / 12;
                                    $monthlyPayment = ($principal * $monthlyRate * pow(1 + $monthlyRate, $months)) / 
                                                     (pow(1 + $monthlyRate, $months) - 1);
                                    
                                    echo 'RM ' . number_format($monthlyPayment, 2);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>Status:</strong></div>
                            <div class="col-7">
                                <span class="status-badge status-<?php echo strtolower($application['status']); ?>">
                                    <?php echo getStatusText($application['status']); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php if ($application['status'] === 'rejected' && !empty($application['admin_remark'])): ?>
                        <div class="alert alert-danger">
                            <h6 class="alert-heading">Sebab Penolakan:</h6>
                            <p class="mb-0"><?php echo nl2br(htmlspecialchars($application['admin_remark'])); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Footer -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="text-center small">
                            <p class="mb-1"><strong>KOPERASI KAKITANGAN KADA KELANTAN BHD</strong></p>
                            <p class="mb-1">Lot 1-2-3, Bangunan KADA, Jalan Sultan Yahya Petra,</p>
                            <p class="mb-1">15200 Kota Bharu, Kelantan</p>
                            <p class="mb-1">Tel: 09-7475770 | Faks: 09-7484670</p>
                            <p class="mb-0">Emel: koperasi@kada.gov.my</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Add Termination Modal -->
    <?php if (isset($terminationRequest)): ?>
    <div class="modal fade" id="terminationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Butiran Penamatan Keahlian #T<?php echo htmlspecialchars($terminationRequest['id']); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body print-content">
                    <!-- Header -->
                    <div class="text-end mb-2 small">
                        <div><?php echo date('d/m/Y', strtotime($terminationRequest['created_at'])); ?></div>
                        <div><?php echo date('h:i A', strtotime($terminationRequest['created_at'])); ?></div>
                    </div>
                    
                    <!-- Organization Name -->
                    <div class="text-center mb-4">
                        <img src="/images/logo.jpg" alt="KADA Logo" style="height: 60px;" class="mb-2">
                        <h6 class="fw-bold mb-1">KOPERASI KAKITANGAN KADA KELANTAN BHD</h6>
                        <p class="small text-muted mb-0">Resit Permohonan Penamatan Keahlian</p>
                    </div>

                    <!-- Receipt Content -->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>No. Rujukan:</strong></div>
                            <div class="col-7">#T<?php echo htmlspecialchars($terminationRequest['id']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Tarikh Mohon:</strong></div>
                            <div class="col-7"><?php echo date('d/m/Y', strtotime($terminationRequest['created_at'])); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Masa:</strong></div>
                            <div class="col-7"><?php echo date('h:i A', strtotime($terminationRequest['created_at'])); ?></div>
                        </div>
                    </div>

                    <div class="border-bottom pb-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>Nama Pemohon:</strong></div>
                            <div class="col-7"><?php echo htmlspecialchars($memberApplication['name']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>No. KP:</strong></div>
                            <div class="col-7"><?php echo htmlspecialchars($memberApplication['ic_no']); ?></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row mb-2">
                            <div class="col-5"><strong>Status:</strong></div>
                            <div class="col-7">
                                <span class="status-badge status-<?php echo strtolower($terminationRequest['status']); ?>">
                                    <?php 
                                    switch(strtolower($terminationRequest['status'])) {
                                        case 'pending':
                                            echo 'Dalam Proses';
                                            break;
                                        case 'approved':
                                            echo 'Diluluskan';
                                            break;
                                        case 'rejected':
                                            echo 'Ditolak';
                                            break;
                                        default:
                                            echo ucfirst($terminationRequest['status']);
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="text-center small">
                            <p class="mb-1"><strong>KOPERASI KAKITANGAN KADA KELANTAN BHD</strong></p>
                            <p class="mb-1">Lot 1-2-3, Bangunan KADA, Jalan Sultan Yahya Petra,</p>
                            <p class="mb-1">15200 Kota Bharu, Kelantan</p>
                            <p class="mb-1">Tel: 09-7475770 | Faks: 09-7484670</p>
                            <p class="mb-0">Emel: koperasi@kada.gov.my</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];
    
    // Get the date input elements
    const dateFromInput = document.querySelector('input[name="date_from"]');
    const dateToInput = document.querySelector('input[name="date_to"]');
    
    // Set max date for both inputs
    dateFromInput.max = today;
    dateToInput.max = today;
    
    // Add event listeners to ensure "date_to" is not before "date_from"
    dateFromInput.addEventListener('change', function() {
        dateToInput.min = this.value;
    });
    
    dateToInput.addEventListener('change', function() {
        if (dateFromInput.value && this.value < dateFromInput.value) {
            this.value = dateFromInput.value;
        }
    });

    // Add this to your existing JavaScript
    function updateDateTime() {
        const now = new Date();
        const options = { 
            day: 'numeric', 
            month: 'short', 
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true
        };
        document.getElementById('currentDateTime').textContent = now.toLocaleDateString('ms-MY', options).replace(/\./g, '');
    }

    // Update time every second
    setInterval(updateDateTime, 1000);
    updateDateTime(); // Initial call

    // Function to clear cache and handle logout
    function clearCacheAndLogout(event) {
        // Clear browser cache
        window.location.replace('/logout');
        
        // Prevent browser back button
        if (window.history && window.history.pushState) {
            window.history.pushState('', '', '/userlogin');
            window.onpopstate = function () {
                window.history.pushState('', '', '/userlogin');
            };
        }
        
        // Clear localStorage if any
        localStorage.clear();
        
        // Clear sessionStorage
        sessionStorage.clear();
        
        return true;
    }
    </script>
</body>
</html>

<?php
function getStatusIcon($status) {
    switch(strtolower($status)) {
        case 'pending':
            return 'fa-hourglass-half';
        case 'approved':
            return 'fa-check-circle';
        case 'rejected':
            return 'fa-times-circle';
        case 'inactive':
            return 'fa-user-slash';
        default:
            return 'fa-question-circle';
    }
}

function getStatusText($status) {
    switch(strtolower($status)) {
        case 'pending':
            return 'Dalam Proses';
        case 'approved':
            return 'Diluluskan';
        case 'rejected':
            return 'Dibatalkan';
        case 'inactive':
            return 'Tidak Aktif';
        default:
            return 'Tidak Diketahui';
    }
}
?>