<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

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
        font-family: 'Poppins', sans-serif;
    }

    /* Logo section */
    .logo-section {
        background-color: var(--background-overlay);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1030;
    }

    .logo-section img {
        max-height: 70px;
        width: auto;
    }

    .logo-section .py-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .logo-section .btn {
        font-size: 0.9rem;
        padding: 0.375rem 0.75rem;
    }

    /* Adjust main content and sidebar top margin */
    .main-content {
        margin-top: 82px;
    }

    .sidebar {
        margin-top: 82px;
    }

    /* Ensure consistent spacing */
    .logo-section .me-3 {
        margin-right: 0.75rem !important;
    }

    /* Updated sidebar styles */
    .sidebar {
        background-color: #ffffff !important; /* Force white background */
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

    .sidebar.collapsed {
        transform: translateX(-250px);
    }

    .sidebar-content {
        padding: 1.5rem 1rem;
    }

    .sidebar-title {
        color: #2E7D32;
        font-size: 1rem;
        font-weight: 600;
        padding: 0 0.5rem;
        margin-bottom: 1.5rem;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #333333 !important; /* Force dark text color */
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.2s ease;
        margin-bottom: 0.25rem;
        background-color: transparent !important; /* Force transparent background */
    }

    .sidebar-link:hover {
        background-color: rgba(46, 125, 50, 0.1) !important; /* Light green background on hover */
        color: #2E7D32 !important;
    }

    .sidebar-link.active {
        background-color: rgba(46, 125, 50, 0.15) !important;
        color: #2E7D32 !important;
        font-weight: 500;
    }

    .sidebar-link i {
        font-size: 1rem;
        width: 1.5rem;
        margin-right: 0.75rem;
        color: #666666;
    }

    .sidebar-link:hover i,
    .sidebar-link.active i {
        color: #2E7D32;
    }

    .sidebar-link span {
        font-size: 0.9rem;
    }

    /* Logout button styles */
    .sidebar-footer {
        padding: 1rem;
        border-top: 1px solid #dee2e6;
        margin-top: auto;
    }

    .sidebar-footer .sidebar-link {
        color: #dc3545;
    }

    .sidebar-footer .sidebar-link:hover {
        background-color: #fff;
        color: #dc3545;
    }

    .sidebar-footer .sidebar-link i {
        color: #dc3545;
    }

    .sidebar-toggle {
        position: absolute;
        right: -2rem;
        top: 1rem;
        background: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 0 4px 4px 0;
        padding: 0.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        color: #333333;
    }

    .sidebar-toggle:hover {
        background: #f5f5f5;
        color: #2E7D32;
    }

    /* Adjust main content margin */
    .main-content {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
        padding: 2rem;
    }

    .main-content.expanded {
        margin-left: 0;
    }

    /* Dark mode compatibility */
    @media (prefers-color-scheme: dark) {
        .sidebar,
        .sidebar-link,
        .sidebar-toggle {
            background-color: #ffffff !important;
            color: #333333 !important;
        }
    }

    /* Main content wrapper */
    .main-content {
        margin-left: 250px;
        padding: 2rem;
        margin-top: 85px;
        min-height: calc(100vh - 90px);
        background: transparent;
        transition: margin-left 0.3s ease;
    }

    .main-content.expanded {
        margin-left: 0;
    }

    .content-container {
        background-color: var(--background-overlay);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 2rem;
        backdrop-filter: blur(10px);
    }

    /* Card styles */
    .card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding: 1.5rem;
    }

    .card-title {
        color: var(--text-dark);
        font-size: 1.5rem !important;
        font-weight: 600;
        margin-bottom: 0;
    }

    /* Table styles */
    .table {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 8px;
        overflow: hidden;
    }

    .table th {
        background: rgba(46, 125, 50, 0.1);
        color: var(--text-dark);
        font-weight: 600;
        border-color: rgba(0,0,0,0.1);
    }

    .table td {
        vertical-align: middle;
        border-color: rgba(0,0,0,0.1);
    }

    /* Form controls */
    .form-select {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(46, 125, 50, 0.2);
        border-radius: 8px;
        padding: 0.5rem 1rem;
    }

    /* Button styles */
    .btn {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Alert styles */
    .alert {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    /* Modal styles */
    .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        border: none;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    .modal-header {
        border-bottom: 1px solid rgba(46, 125, 50, 0.1);
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid rgba(46, 125, 50, 0.1);
        padding: 1.5rem;
    }

    /* Dashboard header */
    .dashboard-header {
        background: transparent;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .dashboard-header h2 {
        color: var(--text-dark);
        font-size: 1.8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
        text-align: center;
    }

    /* Sidebar toggle button */
    .sidebar-toggle {
        position: absolute;
        right: -40px;
        top: 20px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0 8px 8px 0;
        padding: 0.5rem;
        z-index: 1029;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .sidebar-toggle:hover {
        background: var(--secondary-color);
    }

    /* Updated sidebar styles */
    .sidebar {
        transform: translateX(0);
        transition: transform 0.3s ease;
    }

    .sidebar.collapsed {
        transform: translateX(-250px);
    }

    /* Adjust main content for collapsed sidebar */
    .main-content {
        transition: margin-left 0.3s ease;
    }

    .main-content.expanded {
        margin-left: 0;
    }

    /* Adjust toggle button position when sidebar is collapsed */
    .sidebar-toggle.collapsed {
        left: 0;
    }

    /* Update the header container styles */
    .header-container {
        margin-bottom: 2rem;
    }

    .welcome-section {
        padding: 2rem 0;
    }

    .welcome-section .card {
        border: none;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .welcome-section .card-img {
        height: 600px;
        object-fit: cover;
    }

    .welcome-section .card-img-overlay {
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .welcome-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .welcome-section .lead {
        font-size: 1.1rem;
        max-width: 800px;
        line-height: 1.6;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
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
        line-height: 1.4;
        font-size: 1.35rem;
        margin-top: 2px;
        font-weight: 625;
    }

    .logo-section .text-secondary {
        color: var(--secondary-color) !important;
        font-size: 1rem;
        margin-top: -4px;
    }

    /* Update dropdown styles */
    .form-select {
        min-width: 200px;  /* Increased minimum width */
        padding-right: 2.5rem !important;  /* More space for the arrow */
        font-size: 0.95rem;
    }

    /* Specific adjustments for each table's dropdown */
    #loan-table .form-select,
    #withdrawal-table .form-select,
    #members-table .form-select,
    #inquiries-table .form-select {
        width: 220px;  /* Fixed width for consistency */
    }

    /* Ensure the dropdown arrow doesn't overlap text */
    .form-select {
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    /* Add these styles in the existing <style> section */

    /* Sidebar category styles */
    .sidebar-category {
        margin-bottom: 1.5rem;
        padding: 0 0.5rem;
    }

    .sidebar-subtitle {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: #2E7D32;
        margin-bottom: 0.75rem;
        padding-left: 0.5rem;
    }

    /* Adjust spacing for links within categories */
    .sidebar-category .sidebar-link {
        padding: 0.5rem 1rem;
        margin-bottom: 0.25rem;
    }

    /* Add subtle divider between categories */
    .sidebar-category:not(:last-child) {
        border-bottom: 1px solid rgba(46, 125, 50, 0.2);
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    /* Dark mode adjustments */
    @media (prefers-color-scheme: dark) {
        .sidebar {
            background: #1a1a1a;
        }
        
        .sidebar-subtitle {
            color: #81C784; /* Lighter green for dark mode */
        }
        
        .sidebar-link {
            color: #e0e0e0;
        }
        
        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: rgba(129, 199, 132, 0.2); /* Lighter green background */
            color: #81C784;
        }
        
        .sidebar-category:not(:last-child) {
            border-bottom-color: rgba(129, 199, 132, 0.2);
        }
    }
</style>
</head>
<body>
    <!-- Logo section -->
    <div class="page-wrapper">
        <!-- Top Bar -->
        <div class="logo-section">
            <div class="container">
                <div class="row align-items-center py-2">
                    <div class="col">
                        <div class="d-flex align-items-center">
                            <img src="/images/logo.jpg" alt="Logo KADA" class="img-fluid me-3" style="max-height: 70px; width: auto;">
                            <div class="d-flex flex-column">
                                <h1 class="mb-0 fs-4 fw-bold text-success">Koperasi Kakitangan KADA Kelantan Sdn Bhd</h1>
                                <span class="text-secondary fs-6">KADA</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a href="#" onclick="showLogoutConfirmation(event)" class="btn btn-outline-success">
                            <i class="bi bi-box-arrow-right me-2"></i>Log Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update the sidebar structure -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-content">
            <h4 class="sidebar-title mb-4">Panel Pentadbir</h4>
            <nav class="sidebar-nav">
                <!-- Permohonan Category -->
                <div class="sidebar-category mb-3">
                    <h6 class="sidebar-subtitle mb-2 text-muted ps-3">Permohonan</h6>
                    <a href="#loan-applications" class="sidebar-link">
                        <i class="bi bi-file-text"></i>
                        <span>Permohonan Pinjaman</span>
                    </a>
                    <a href="#withdrawal-requests" class="sidebar-link">
                        <i class="bi bi-cash-stack"></i>
                        <span>Pindahan Wang</span>
                    </a>
                    <a href="#members-list" class="sidebar-link">
                        <i class="bi bi-people"></i>
                        <span>Permohonan Keahlian</span>
                    </a>
                    <a href="#termination-list" class="sidebar-link">
                        <i class="bi bi-person-x"></i>
                        <span>Penamatan Keahlian</span>
                    </a>
                    <a href="#inquiries-list" class="sidebar-link">
                        <i class="bi bi-chat-dots"></i>
                        <span>Mesej Pertanyaan</span>
                    </a>
                </div>

                <!-- Data Category -->
                <div class="sidebar-category">
                    <h6 class="sidebar-subtitle mb-2 text-muted ps-3">Data</h6>
                    <a href="/admins/active-members" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Senarai Ahli</span>
                    </a>
                    <a href="/admins/report" class="sidebar-link">
                        <i class="bi bi-graph-up"></i>
                        <span>Laporan Statistik</span>
                    </a>
                </div>
            </nav>
        </div>
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="bi bi-chevron-left"></i>
        </button>
    </div>

    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Single Alert Section for all notifications -->
            <div id="alertContainer" style="display: none;" class="alert alert-dismissible fade show" role="alert">
                <span id="alertMessage"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Executive Dashboard Analytics -->
            <div class="analytics-dashboard mb-5">
                <!-- Primary Metrics -->
                <div class="row g-4 mb-4">
                    <!-- Loan Applications Analytics -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-light rounded p-2 me-3">
                                        <i class="bi bi-file-text text-primary fs-4"></i>
                                    </div>
                                    <h6 class="card-title fw-semibold mb-0">Permohonan Pinjaman</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-baseline mb-3">
                                    <div class="stats-left">
                                        <h3 class="mb-1 fw-bold"><?= number_format($stats['loans']['pending'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0 small">Dalam Proses</p>
                                    </div>
                                    <div class="stats-right text-end">
                                        <p class="mb-1 fw-semibold">Jumlah: <?= number_format($stats['loans']['total'] ?? 0) ?></p>
                                        <div class="stats-details small">
                                            <span class="text-success me-2">
                                                <i class="bi bi-check-circle-fill"></i> <?= number_format($stats['loans']['approved'] ?? 0) ?>
                                            </span>
                                            <span class="text-danger">
                                                <i class="bi bi-x-circle-fill"></i> <?= number_format($stats['loans']['rejected'] ?? 0) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress rounded-pill" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" 
                                         style="width: <?= ($stats['loans']['pending'] / max($stats['loans']['total'], 1)) * 100 ?>%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Money Transfer Analytics -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-light rounded p-2 me-3">
                                        <i class="bi bi-cash-stack text-success fs-4"></i>
                                    </div>
                                    <h6 class="card-title fw-semibold mb-0">Pindahan Wang</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-baseline mb-3">
                                    <div class="stats-left">
                                        <h3 class="mb-1 fw-bold"><?= number_format($stats['transfers']['pending'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0 small">Dalam Proses</p>
                                    </div>
                                    <div class="stats-right text-end">
                                        <p class="mb-1 fw-semibold">Jumlah: <?= number_format($stats['transfers']['total'] ?? 0) ?></p>
                                        <div class="stats-details small">
                                            <span class="text-success me-2">
                                                <i class="bi bi-check-circle-fill"></i> <?= number_format($stats['transfers']['approved'] ?? 0) ?>
                                            </span>
                                            <span class="text-danger">
                                                <i class="bi bi-x-circle-fill"></i> <?= number_format($stats['transfers']['rejected'] ?? 0) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress rounded-pill" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: <?= ($stats['transfers']['pending'] / max($stats['transfers']['total'], 1)) * 100 ?>%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Membership Analytics -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-light rounded p-2 me-3">
                                        <i class="bi bi-people text-info fs-4"></i>
                                    </div>
                                    <h6 class="card-title fw-semibold mb-0">Keahlian</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-baseline mb-3">
                                    <div class="stats-left">
                                        <h3 class="mb-1 fw-bold"><?= number_format($stats['members']['pending'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0 small">Dalam Proses</p>
                                    </div>
                                    <div class="stats-right text-end">
                                        <p class="mb-1 fw-semibold">Jumlah: <?= number_format($stats['members']['total'] ?? 0) ?></p>
                                        <div class="stats-details small">
                                            <span class="text-success me-2">
                                                <i class="bi bi-check-circle-fill"></i> <?= number_format($stats['members']['approved'] ?? 0) ?>
                                            </span>
                                            <span class="text-danger">
                                                <i class="bi bi-x-circle-fill"></i> <?= number_format($stats['members']['rejected'] ?? 0) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress rounded-pill" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" 
                                         style="width: <?= ($stats['members']['pending'] / max($stats['members']['total'], 1)) * 100 ?>%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secondary Metrics -->
                <div class="row g-4">
                    <!-- Inquiries Analytics -->
                    <div class="col-xl-6 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-light rounded p-2 me-3">
                                        <i class="bi bi-chat-dots text-warning fs-4"></i>
                                    </div>
                                    <h6 class="card-title fw-semibold mb-0">Pertanyaan</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-baseline mb-3">
                                    <div class="stats-left">
                                        <h3 class="mb-1 fw-bold"><?= number_format($stats['inquiries']['pending'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0 small">Belum Dijawab</p>
                                    </div>
                                    <div class="stats-right text-end">
                                        <p class="mb-1 fw-semibold">Jumlah: <?= number_format($stats['inquiries']['total'] ?? 0) ?></p>
                                        <div class="stats-details small">
                                            <span class="text-success me-2">
                                                <i class="bi bi-check-circle-fill"></i> <?= number_format($stats['inquiries']['resolved'] ?? 0) ?>
                                            </span>
                                            <span class="text-danger">
                                                <i class="bi bi-x-circle-fill"></i> <?= number_format($stats['inquiries']['rejected'] ?? 0) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress rounded-pill" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" 
                                         style="width: <?= ($stats['inquiries']['pending'] / max($stats['inquiries']['total'], 1)) * 100 ?>%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Termination Analytics -->
                    <div class="col-xl-6 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-light rounded p-2 me-3">
                                        <i class="bi bi-person-x text-danger fs-4"></i>
                                    </div>
                                    <h6 class="card-title fw-semibold mb-0">Permohonan Berhenti</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-baseline mb-3">
                                    <div class="stats-left">
                                        <h3 class="mb-1 fw-bold"><?= number_format($terminationStats['pending_terminations'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0 small">Dalam Proses</p>
                                    </div>
                                    <div class="stats-right text-end">
                                        <p class="mb-1 fw-semibold">Jumlah: <?= number_format($terminationStats['total_applications'] ?? 0) ?></p>
                                        <div class="stats-details small">
                                            <span class="text-success me-2">
                                                <i class="bi bi-check-circle-fill"></i> <?= number_format($terminationStats['approved_terminations'] ?? 0) ?>
                                            </span>
                                            <span class="text-danger">
                                                <i class="bi bi-x-circle-fill"></i> <?= number_format($terminationStats['rejected_terminations'] ?? 0) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress rounded-pill" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" 
                                         style="width: <?= ($terminationStats['pending_terminations'] / max($terminationStats['total_applications'], 1)) * 100 ?>%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= $_SESSION['success']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <!-- Loan Applications Table -->
            <?php 
                $title = 'List of Loan';
            ?>

            <div class="container mt-4" id="loan-applications">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success']; ?>
                        <?php unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                <!-- Main Content -->

                <!-- Loan -->
                <div class="card shadow-lg mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="card-title">
                                <i class="bi bi-people-fill me-2"></i>Senarai Permohonan Pinjaman
                            </h2>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <select class="form-select w-auto" onchange="filterTable('loan-table', this.value)">
                                <option value="pending">Dalam Proses</option>
                                <option value="all">Semua Permohonan</option>
                                <option value="approved">Diluluskan</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle" id="loan-table">
                                <thead>
                                    <tr class="text-center">
                                        <th><i class="bi bi-calendar me-2"></i>Tarikh</th>
                                        <th><i class="bi bi-person me-2"></i>Nama</th>
                                        <th><i class="bi bi-file-text me-2"></i>Jenis Pinjaman</th>
                                        <th><i class="bi bi-cash me-2"></i>Jumlah (RM)</th>
                                        <th><i class="bi bi-gear me-2"></i>Tindakan</th>
                                        <th><i class="bi bi-flag me-2"></i>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($loan_applications as $loan): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($loan['created_at']); ?></td>
                                        <td><?= htmlspecialchars($loan['name']); ?></td>
                                        <td><?= htmlspecialchars($loan['loan_type']); ?></td>
                                        <td class="text-end">RM <?= number_format($loan['t_amount'], 2); ?></td>
                                        <td class="text-center action-buttons">
                                            <a href="/admins/loans/<?= $loan['id']; ?>" class="btn btn-outline-primary btn-sm me-1">
                                                <i class="bi bi-eye-fill me-1"></i>Lihat
                                            </a>
                                            <a href="#" class="btn btn-outline-success btn-sm me-1" onclick="handleApprove(<?= $loan['id'] ?>, event)">
                                                <i class="bi bi-check-circle-fill me-1"></i>Lulus
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal<?= $loan['id']; ?>">
                                                <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-<?= getLoanStatusClass($loan['status'] ?? 'pending') ?>">
                                                <?= getLoanStatusText($loan['status'] ?? 'pending') ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal<?= $loan['id']; ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Permohonan Pinjaman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Catatan Admin</label>
                                                        <textarea id="adminRemark<?= $loan['id']; ?>" class="form-control" rows="3" required 
                                                            placeholder="Sila masukkan sebab penolakan..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-danger" onclick="rejectLoan(<?= $loan['id']; ?>)">Hantar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                       
            </div>

            <!-- Withdrawal Requests Section -->
            <div class="container mt-4" id="withdrawal-requests">
                <div class="card shadow-lg mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="card-title">
                                <i class="bi bi-cash-stack me-2"></i>Senarai Permohonan Pindahan Wang
                            </h2>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <select class="form-select w-auto" onchange="filterTable('withdrawal-table', this.value)">
                                <option value="pending">Dalam Proses</option>
                                <option value="all">Semua Permohonan</option>
                                <option value="approved">Diluluskan</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle" id="withdrawal-table">
                                <thead>
                                    <tr class="text-center">
                                        <th><i class="bi bi-person me-2"></i>Nama</th>
                                        <th><i class="bi bi-credit-card me-2"></i>No. Akaun</th>
                                        <th><i class="bi bi-cash me-2"></i>Jumlah (RM)</th>
                                        <th><i class="bi bi-gear me-2"></i>Tindakan</th>
                                        <th><i class="bi bi-flag me-2"></i>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($withdrawals as $withdrawal): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($withdrawal['member_name']) ?></td>
                                        <td class="text-center"><?= htmlspecialchars($withdrawal['account_number']) ?></td>
                                        <td class="text-end">RM <?= number_format($withdrawal['amount'], 2) ?></td>
                                        <td class="text-center action-buttons">
                                            <a href="#" class="btn btn-outline-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $withdrawal['id'] ?>">
                                                <i class="bi bi-eye-fill me-1"></i>Lihat
                                            </a>
                                            <a href="#" class="btn btn-outline-success btn-sm me-1" onclick="handleApproveTransfer(<?= $withdrawal['id'] ?>)">
                                                <i class="bi bi-check-circle-fill me-1"></i>Lulus
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectTransferModal<?= $withdrawal['id']; ?>">
                                                <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-<?= getWithdrawStatusClass($withdrawal['status']) ?> rounded-pill">
                                                <?= $withdrawal['status'] === 'pending' ? 'Dalam Proses' : 
                                                    ($withdrawal['status'] === 'approved' ? 'Diluluskan' : 'Ditolak') ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Reject Transfer Modal -->
                                    <div class="modal fade" id="rejectTransferModal<?= $withdrawal['id']; ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Permohonan Pindahan Wang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Catatan Admin</label>
                                                        <textarea id="transferAdminRemark<?= $withdrawal['id']; ?>" class="form-control" rows="3" required 
                                                            placeholder="Sila masukkan sebab penolakan..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-danger" onclick="handleRejectTransfer(<?= $withdrawal['id']; ?>)">Hantar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewModal<?= $withdrawal['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Butiran Pengeluaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Nama:</label>
                                                        <p><?= htmlspecialchars($withdrawal['member_name']) ?></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Jumlah:</label>
                                                        <p>RM <?= number_format($withdrawal['amount'], 2) ?></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Tujuan:</label>
                                                        <p><?= nl2br(htmlspecialchars($withdrawal['description'])) ?></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Status:</label>
                                                        <p>
                                                            <span class="badge bg-<?= getWithdrawStatusClass($withdrawal['status']) ?>">
                                                                <?= $withdrawal['status'] === 'pending' ? 'Dalam Proses' : 
                                                                    ($withdrawal['status'] === 'approved' ? 'Diluluskan' : 'Ditolak') ?>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <?php if (!empty($withdrawal['admin_remark'])): ?>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Catatan Admin:</label>
                                                        <p><?= nl2br(htmlspecialchars($withdrawal['admin_remark'])) ?></p>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members Table -->
            <?php 
                $title = 'List of Users';
            ?>


            <div class="container mt-4" id="members-list">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success']; ?>
                        <?php unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>


                <!-- Main Content -->
                <div class="card shadow-lg mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="card-title">
                                <i class="bi bi-people-fill me-2"></i>Senarai Ahli
                            </h2>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <select class="form-select w-auto" onchange="filterTable('members-table', this.value, 'membership')">
                                <option value="pending">Dalam Proses</option>
                                <option value="all">Semua Ahli</option>
                                <option value="approved">Diluluskan</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle" id="members-table" data-table-type="membership">
                                <thead>
                                    <tr class="text-center">
                                        <th><i class="bi bi-person me-2"></i>Nama</th>
                                        <th><i class="bi bi-credit-card me-2"></i>No. KP</th>
                                        <th><i class="bi bi-gender-ambiguous me-2"></i>Jantina</th>
                                        <th><i class="bi bi-briefcase me-2"></i>Jawatan</th>
                                        <th><i class="bi bi-cash me-2"></i>Gaji Bulanan</th>
                                        <th><i class="bi bi-gear me-2"></i>Tindakan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($pendingregistermembers as $member): ?>
                                <tr>
                                    <td><?= htmlspecialchars($member['name']); ?></td>
                                    <td><?= htmlspecialchars($member['ic_no']); ?></td>
                                    <td><?= htmlspecialchars($member['gender']); ?></td>
                                    <td><?= htmlspecialchars($member['position']); ?></td>
                                    <td class="text-end">RM <?= number_format($member['monthly_salary'], 2); ?></td>
                                    <td class="text-center action-buttons">
                                        <a href="/admins/view/<?= $member['id']; ?>" class="btn btn-outline-primary btn-sm me-1">
                                            <i class="bi bi-eye-fill me-1"></i>Lihat
                                        </a>
                                        <a href="#" class="btn btn-outline-success btn-sm" onclick="handleApproveMember(<?= $member['id'] ?>)">
                                            <i class="bi bi-check-circle-fill"></i> Lulus
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectMemberModal<?= $member['id']; ?>">
                                            <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                        </button>
                                    </td>
                                    <td>
                                        <?php
                                            // Map English status to Malay display text
                                            $statusDisplayMap = [
                                                'pending' => 'Dalam Proses',
                                                'approved' => 'Diluluskan',
                                                'rejected' => 'Ditolak'
                                            ];
                                        ?>
                                        <span class="badge bg-<?= getMemberStatusClass($member['status'] ?? 'pending') ?>">
                                            <?= $statusDisplayMap[$member['status']] ?? $member['status'] ?>
                                        </span>
                                    </td>
                                </tr>

                                <!-- Reject Member Modal -->
                                <div class="modal fade" id="rejectMemberModal<?= $member['id']; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tolak Permohonan Keahlian</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Catatan Admin</label>
                                                    <textarea id="memberAdminRemark<?= $member['id']; ?>" class="form-control" rows="3" required 
                                                        placeholder="Sila masukkan sebab penolakan..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-danger" onclick="rejectMember(<?= $member['id']; ?>)">Hantar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                       
            </div>



            <!-- Termination Table -->
            <div class="container mt-4" id="termination-list">
                <div class="card shadow-lg mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="card-title">
                                <i class="bi bi-person-x-fill"></i>Senarai Penamatan Keahlian
                            </h2>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <select class="form-select w-auto" onchange="filterTable('termination-table', this.value, 'termination')">
                                <option value="pending">Dalam Proses</option>
                                <option value="all">Semua Ahli</option>
                                <option value="approved">Diluluskan</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle" id="termination-table" data-table-type="termination">
                                <thead>
                                    <tr class="text-center">
                                        <th><i class="bi bi-person me-2"></i>Nama</th>
                                        <th><i class="bi bi-credit-card me-2"></i>No. KP</th>
                                        <th><i class="bi bi-gender-ambiguous me-2"></i>Jantina</th>
                                        <th><i class="bi bi-calendar-date me-2"></i>Tarikh Permohonan</th>
                                        <th><i class="bi bi-journal-text me-2"></i>Alasan Penamatan</th>
                                        <th><i class="bi bi-gear me-2"></i>Tindakan</th>
                                        <th><i class="bi bi-check-circle me-2"></i>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($membership_termination)): ?>
                                    <?php foreach ($membership_termination as $request): ?>
                                        <tr data-status="<?= htmlspecialchars($request['status']) ?>">
                                            <td><?= htmlspecialchars($request['name']); ?></td>
                                            <td><?= htmlspecialchars($request['ic_no']); ?></td>
                                            <td><?= htmlspecialchars($request['gender']); ?></td>
                                            <td><?= date('d/m/Y', strtotime($request['created_at'])); ?></td>
                                            <td>
                                                <?php 
                                                    $reasonMap = [
                                                        'pencen' => 'Pencen',
                                                        'pencen awal' => 'Pencen Awal',
                                                        'lain-lain' => 'Lain-lain'
                                                    ];
                                                    echo htmlspecialchars($reasonMap[$request['reason']] ?? $request['reason']);
                                                    if ($request['reason'] === 'lain-lain' && !empty($request['reason_details'])) {
                                                        echo ': ' . htmlspecialchars($request['reason_details']);
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center action-buttons">
                                                <a href="/admins/reason/<?= $request['id']; ?>" class="btn btn-outline-primary btn-sm me-1">
                                                    <i class="bi bi-eye-fill me-1"></i>Lihat
                                                </a>
                                                <?php if ($request['status'] === 'pending'): ?>
                                                    <a href="#" class="btn btn-outline-success btn-sm" onclick="handleApproveTermination(<?= $request['id'] ?>, '<?= htmlspecialchars($request['ic_no']) ?>')">
                                                        <i class="bi bi-check-circle-fill"></i> Lulus
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectTerminationModal<?= $request['id']; ?>">
                                                        <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= getTerminationStatusBadge($request['status'], $request['member_status']) ?>
                                            </td>
                                        </tr>

                                        <!-- Reject Termination Modal -->
                                        <div class="modal fade" id="rejectTerminationModal<?= $request['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tolak Permohonan Penamatan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Catatan Admin</label>
                                                            <textarea id="terminationAdminRemark<?= $request['id']; ?>" class="form-control" rows="3" required 
                                                                placeholder="Sila masukkan sebab penolakan..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="button" class="btn btn-danger" onclick="handleRejectTermination(<?= $request['id']; ?>, '<?= htmlspecialchars($request['ic_no']) ?>')">Hantar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tiada permohonan penamatan keahlian dijumpai.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                       
            </div>



            <!-- Inquiries Table -->
            <?php 
                $title = 'List of Inquiries';
            ?>


            <div class="container mt-4" id="members-list">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success']; ?>
                        <?php unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>


        <!-- Customer Service Inquiries Section -->
    <div class="container mt-4" id="inquiries-list">
                <div class="card shadow-lg mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="card-title">
                                <i class="bi bi-chat-dots-fill me-2"></i>Senarai Mesej Pertanyaan
                            </h2>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <select class="form-select w-auto" onchange="filterTable('inquiries-table', this.value)">
                                <option value="pending">Dalam Proses</option>
                                <option value="all">Semua Pertanyaan</option>
                                <option value="resolved">Selesai</option>
                                <option value="in_progress">Sedang Diproses</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle" id="inquiries-table">
                                <thead>
                                    <tr class="text-center">
                                        <th><i class="bi bi-person-badge me-2"></i>ID Ahli</th>
                                        <th><i class="bi bi-calendar me-2"></i>Tarikh</th>
                                        <th><i class="bi bi-chat-text me-2"></i>Subjek</th>
                                        <th><i class="bi bi-gear me-2"></i>Tindakan</th>
                                        <th><i class="bi bi-flag me-2"></i>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data['inquiries']) && is_array($data['inquiries'])): ?>
                                        <?php foreach ($data['inquiries'] as $inquiry): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($inquiry['user_id']) ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($inquiry['created_at'])) ?></td>
                                                <td><?= htmlspecialchars($inquiry['subject']) ?></td>
                                                <td class="text-center action-buttons">
                                                    <button type="button" class="btn btn-outline-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#inquiryModal<?= $inquiry['id'] ?>">
                                                        <i class="bi bi-eye-fill me-1"></i>Lihat
                                                    </button>

                                                    <!-- Combined View/Reply Modal -->
                                                    <div class="modal fade" id="inquiryModal<?= $inquiry['id'] ?>" tabindex="-1">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Butiran Pertanyaan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Member's Message Section -->
                                                                    <div class="card mb-3">
                                                                        <div class="card-header bg-light">
                                                                            <h6 class="mb-0">Mesej Ahli</h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <p class="mb-0"><?= nl2br(htmlspecialchars($inquiry['message'])) ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Admin's Response Section -->
                                                                    <?php if ($inquiry['status'] != 'resolved'): ?>
                                                                        <form id="replyForm<?= $inquiry['id'] ?>" onsubmit="handleInquiryResponse(event, <?= $inquiry['id'] ?>)">
                                                                            <input type="hidden" name="inquiry_id" value="<?= $inquiry['id'] ?>">
                                                                            <input type="hidden" name="status" value="completed">
                                                                            
                                                                            <div class="card">
                                                                                <div class="card-header bg-light">
                                                                                    <h6 class="mb-0">Maklum Balas Admin</h6>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <textarea name="admin_response" class="form-control" rows="4" required 
                                                                                        placeholder="Tulis maklum balas anda di sini..."></textarea>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="text-end mt-3">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-success ms-2">
                                                                                    <i class="bi bi-send"></i> Balas
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    <?php else: ?>
                                                                        <div class="card">
                                                                            <div class="card-header bg-light">
                                                                                <h6 class="mb-0">Maklum Balas Admin</h6>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <p class="mb-0"><?= nl2br(htmlspecialchars($inquiry['admin_response'])) ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mt-3">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-<?= 
                                                        $inquiry['status'] == 'pending' ? 'warning' : 
                                                        ($inquiry['status'] == 'in_progress' ? 'info' : 'success') 
                                                    ?> text-dark">
                                                        <?= $inquiry['status'] == 'pending' ? 'Dalam Proses' : 
                                                            ($inquiry['status'] == 'in_progress' ? 'Sedang Diproses' : 'Selesai') ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Tiada pertanyaan dijumpai.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function showAlert(message, type = 'success') {
        const alertContainer = document.getElementById('alertContainer');
        const alertMessage = document.getElementById('alertMessage');
        
        alertContainer.className = `alert alert-${type} alert-dismissible fade show`;
        alertMessage.textContent = message;
        alertContainer.style.display = 'block';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            const alertInstance = bootstrap.Alert.getOrCreateInstance(alertContainer);
            alertInstance.close();
        }, 5000);
    }

    function rejectLoan(loanId) {
        const remark = document.getElementById('adminRemark' + loanId).value;
        
        if (!remark.trim()) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Sila masukkan catatan penolakan.',
                icon: 'warning',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
            return;
        }

        const formData = new FormData();
        formData.append('admin_remark', remark);
        formData.append('loan_id', loanId);
        formData.append('status', 'rejected');

        fetch('/admins/rejectLoan/' + loanId, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('rejectModal' + loanId));
                modal.hide();
                Swal.fire({
                    title: 'Berjaya!',
                    text: 'Permohonan pinjaman telah berjaya ditolak.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    scrollbarPadding: false,
                    allowOutsideClick: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Error rejecting application');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Ralat!',
                text: 'Sila cuba sekali lagi.',
                icon: 'error',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
        });
    }

    function rejectMember(memberId) {
        const remark = document.getElementById('memberAdminRemark' + memberId).value;
        
        if (!remark.trim()) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Sila masukkan catatan penolakan.',
                icon: 'warning',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
            return;
        }

        const data = new FormData();
        data.append('admin_remark', remark);

        fetch('/admins/reject/' + memberId, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('rejectMemberModal' + memberId));
                modal.hide();
                Swal.fire({
                    title: 'Berjaya!',
                    text: 'Permohonan keahlian telah berjaya ditolak.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    scrollbarPadding: false,
                    allowOutsideClick: false
                }).then(() => {
                    location.reload();
                });
            } else {
                throw new Error(data.message || 'Error rejecting application');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Ralat!',
                text: 'Sila cuba sekali lagi.',
                icon: 'error'
            });
        });
    }

    function showLogoutConfirmation(event) {
        event.preventDefault();
        const logoutModal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));
        logoutModal.show();
    }

    function clearCacheAndLogout(event) {
        event.preventDefault();
        localStorage.clear();
        sessionStorage.clear();
        window.location.replace('/logout');
    }

    // Add comprehensive history and navigation protection
    document.addEventListener('DOMContentLoaded', function() {
        // Disable browser's back functionality
        history.pushState(null, '', location.href);
        window.onpopstate = function() {
            history.pushState(null, '', location.href);
            checkLoginStatus();
        };
        
        // Handle all navigation events
        ['mousedown', 'keydown', 'keyup', 'touchstart'].forEach(event => {
            document.addEventListener(event, function(e) {
                if ((e.which || e.keyCode) == 8 || // Backspace
                    (e.which || e.keyCode) == 90 && e.ctrlKey) { // Ctrl + Z
                    checkLoginStatus();
                }
            });
        });
    });

    // Function to check login status
    function checkLoginStatus() {
        const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        if (!isLoggedIn) {
            window.location.replace('/userlogin');
        }
    }

    // Check login status on page visibility change
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'visible') {
            checkLoginStatus();
        }
    });

    // Additional protection against history manipulation
    window.onload = function() {
        if (performance.navigation.type === 2 || // Back/forward navigation
            performance.navigation.type === 255) { // Any other type of navigation
            checkLoginStatus();
        }
    }
    </script>

    <script>
    document.querySelectorAll('.sidebar a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const section = document.querySelector(this.getAttribute('href'));
            
            if (section) {
                // Add larger offset to account for fixed header
                const offset = 120; // Increased offset
                const elementPosition = section.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add scroll margin to sections
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll margin to all sections that are targets of sidebar links
        document.querySelectorAll('section, .card, .table-responsive').forEach(section => {
            section.style.scrollMarginTop = '120px'; // Increased margin to match offset
        });
    });
    </script>

    

    <script>
    function filterTable(tableId, status, tableType) {
        // Save the selected status to sessionStorage with table type
        sessionStorage.setItem(`${tableId}_${tableType}_filter`, status);
        
        const table = document.getElementById(tableId);
        if (!table) return;

        const rows = table.getElementsByTagName('tr');

        // Update the dropdown to reflect the current selection
        const dropdown = document.querySelector(`select[onchange="filterTable('${tableId}', this.value, '${tableType}')"]`);
        if (dropdown) {
            dropdown.value = status;
        }

        // Start from index 1 to skip the header row
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const statusCell = row.querySelector('.badge') || row.querySelector('[class*="bg-"]');
            
            if (statusCell) {
                const badgeText = statusCell.textContent.trim().toLowerCase();
                const rowStatus = getStatusFromBadge(badgeText);
                
                if (status === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = (rowStatus === status) ? '' : 'none';
                }
            }
        }
    }

    function getStatusFromBadge(badgeText) {
        const statusMap = {
            'dalam proses': 'pending',
            'diluluskan': 'approved',
            'ditolak': 'rejected',
            'dibatalkan': 'rejected',
            'selesai': 'resolved',
            'sedang diproses': 'in_progress'
        };
        
        return statusMap[badgeText] || badgeText;
    }

    // Initialize tables with saved filters or default to pending
    document.addEventListener('DOMContentLoaded', function() {
        const tableConfigs = [
            { id: 'loan-table', type: 'loan' },
            { id: 'withdrawal-table', type: 'withdrawal' },
            { id: 'members-table', type: 'membership' },
            { id: 'termination-table', type: 'termination' },
            { id: 'inquiries-table', type: 'inquiries' }
        ];
        
        tableConfigs.forEach(config => {
            // Get saved filter from sessionStorage with table type
            const savedFilter = sessionStorage.getItem(`${config.id}_${config.type}_filter`) || 'pending';
            filterTable(config.id, savedFilter, config.type);
        });
    });

    // Reset all filters to 'pending' when the page loads for the first time in a session
    if (!sessionStorage.getItem('initialized')) {
        sessionStorage.setItem('initialized', 'true');
        const tableConfigs = [
            { id: 'loan-table', type: 'loan' },
            { id: 'withdrawal-table', type: 'withdrawal' },
            { id: 'members-table', type: 'membership' },
            { id: 'termination-table', type: 'termination' },
            { id: 'inquiries-table', type: 'inquiries' }
        ];
        
        tableConfigs.forEach(config => {
            filterTable(config.id, 'pending', config.type);
        });
    }
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const sidebarToggle = document.getElementById('sidebarToggle');
        
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            // Toggle arrow direction
            const arrow = this.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                arrow.classList.remove('bi-chevron-left');
                arrow.classList.add('bi-chevron-right');
            } else {
                arrow.classList.remove('bi-chevron-right');
                arrow.classList.add('bi-chevron-left');
            }
        });
    });
    </script>

    <!-- Add this JavaScript function for handling alerts -->
    <script>
    function showAlert(message, type = 'success') {
        const alertContainer = document.getElementById('alertContainer');
        const alertMessage = document.getElementById('alertMessage');
        
        alertContainer.className = `alert alert-${type} alert-dismissible fade show`;
        alertMessage.textContent = message;
        alertContainer.style.display = 'block';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            const alertInstance = bootstrap.Alert.getOrCreateInstance(alertContainer);
            alertInstance.close();
        }, 5000);
    }

    // Update the reject functions to use the new alert system
    function rejectLoan(loanId) {
        const remark = document.getElementById('adminRemark' + loanId).value;
        
        if (!remark.trim()) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Sila masukkan catatan penolakan.',
                icon: 'warning',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
            return;
        }

        const formData = new FormData();
        formData.append('admin_remark', remark);
        formData.append('loan_id', loanId);
        formData.append('status', 'rejected');

        fetch('/admins/rejectLoan/' + loanId, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('rejectModal' + loanId));
                modal.hide();
                Swal.fire({
                    title: 'Berjaya!',
                    text: 'Permohonan pinjaman telah berjaya ditolak.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    scrollbarPadding: false,
                    allowOutsideClick: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Error rejecting application');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Ralat!',
                text: 'Sila cuba sekali lagi.',
                icon: 'error',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
        });
    }

    function rejectMember(memberId) {
        const remark = document.getElementById('memberAdminRemark' + memberId).value;
        
        if (!remark.trim()) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Sila masukkan catatan penolakan.',
                icon: 'warning',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
            return;
        }

        const data = new FormData();
        data.append('admin_remark', remark);

        fetch('/admins/reject/' + memberId, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('rejectMemberModal' + memberId));
                modal.hide();
                Swal.fire({
                    title: 'Berjaya!',
                    text: 'Permohonan keahlian telah berjaya ditolak.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    scrollbarPadding: false,
                    allowOutsideClick: false
                }).then(() => {
                    location.reload();
                });
            } else {
                throw new Error(data.message || 'Error rejecting application');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Ralat!',
                text: 'Sila cuba sekali lagi.',
                icon: 'error'
            });
        });
    }

    // Add function for handling withdrawal approvals/rejections
    function handleWithdrawal(action, id) {
        Swal.fire({
            title: 'Pengesahan',
            text: `Adakah anda pasti untuk ${action === 'approve' ? 'meluluskan' : 'menolak'} permohonan pindahan wang ini?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: `Ya, ${action === 'approve' ? 'Lulus' : 'Tolak'}`,
            cancelButtonText: 'Batal',
            reverseButtons: true,
            scrollbarPadding: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.querySelector(`#${action}Modal${id} form`);
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById(`${action}Modal${id}`));
                        if (modal) modal.hide();
                        Swal.fire({
                            title: 'Berjaya!',
                            text: `Permohonan telah berjaya ${action === 'approve' ? 'diluluskan' : 'ditolak'}.`,
                            icon: 'success'
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Error processing application');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Ralat!',
                        text: 'Sila cuba sekali lagi.',
                        icon: 'error',
                        scrollbarPadding: false,
                        allowOutsideClick: false
                    });
                });
            }
        });
    }

    // Add function for handling inquiry responses
    function handleInquiryResponse(event, id) {
        event.preventDefault();
        
        const form = document.getElementById(`replyForm${id}`);
        const formData = new FormData(form);

        fetch('/admins/replyInquiry', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById(`inquiryModal${id}`));
                modal.hide();
                
                // Show success message
                Swal.fire({
                    title: 'Berjaya!',
                    text: 'Maklum balas telah berjaya dihantar.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    scrollbarPadding: false,
                    allowOutsideClick: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Ralat semasa menghantar maklum balas.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Ralat!',
                text: 'Ralat semasa menghantar maklum balas.',
                icon: 'error',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
        });
    }

    function handleApprove(loanId, event) {
        // Prevent default behavior and store current scroll position
        if (event) {
            event.preventDefault();
        }
        const scrollPosition = window.pageYOffset;

        Swal.fire({
            title: 'Pengesahan',
            text: 'Adakah anda pasti untuk meluluskan permohonan ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            scrollbarPadding: false,
            allowOutsideClick: false,
            willOpen: () => {
                // Restore scroll position when dialog opens
                window.scrollTo(0, scrollPosition);
            },
            didOpen: () => {
                // Prevent body from scrolling while dialog is open
                document.body.style.overflow = 'hidden';
            },
            willClose: () => {
                // Restore body scrolling when dialog closes
                document.body.style.overflow = 'auto';
                window.scrollTo(0, scrollPosition);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admins/approveLoan/' + loanId)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(result => {
                        Swal.fire({
                            title: 'Berjaya!',
                            text: 'Permohonan telah berjaya diluluskan.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            scrollbarPadding: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                window.scrollTo(0, scrollPosition);
                            }
                        }).then(() => {
                            window.location.href = '/admins#loan-applications';
                            location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Ralat!',
                            text: 'Ralat rangkaian. Sila cuba sekali lagi.',
                            icon: 'error',
                            scrollbarPadding: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                window.scrollTo(0, scrollPosition);
                            }
                        });
                    });
            } else {
                // Restore scroll position if canceled
                window.scrollTo(0, scrollPosition);
            }
        });
    }

    function handleApproveTransfer(transferId) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Pengesahan',
            text: 'Adakah anda pasti untuk meluluskan permohonan pindahan wang ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('transaction_id', transferId);
                formData.append('status', 'approved');

                fetch('/admins/processTransfer', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);  // Debug log
                    if (data.success) {
                        Swal.fire({
                            title: 'Berjaya!',
                            text: data.message || 'Permohonan pindahan wang telah berjaya diluluskan.',
                            icon: 'success'
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Ralat tidak diketahui');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Ralat!',
                        text: error.message || 'Sila cuba sekali lagi.',
                        icon: 'error'
                    });
                });
            }
        });
    }

    function handleRejectTransfer(transferId) {
        const remark = document.getElementById('transferAdminRemark' + transferId).value;
        
        if (!remark.trim()) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Sila masukkan catatan penolakan.',
                icon: 'warning',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
            return;
        }

        const formData = new FormData();
        formData.append('transaction_id', transferId);
        formData.append('status', 'rejected');
        formData.append('admin_remark', remark);

        fetch('/admins/processTransfer', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById(`rejectTransferModal${transferId}`));
                modal.hide();
                Swal.fire({
                    title: 'Berjaya!',
                    text: data.message || 'Permohonan pindahan wang telah berjaya ditolak.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    scrollbarPadding: false,
                    allowOutsideClick: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Ralat tidak diketahui');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Ralat!',
                text: error.message || 'Sila cuba sekali lagi.',
                icon: 'error',
                scrollbarPadding: false,
                allowOutsideClick: false
            });
        });
    }

    // Add this to handle alerts on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check if we should skip the default alert
        if (sessionStorage.getItem('skipDefaultAlert')) {
            // Remove any existing success alerts
            const successAlerts = document.querySelectorAll('.alert-success');
            successAlerts.forEach(alert => alert.remove());
            
            // Clear the flag
            sessionStorage.removeItem('skipDefaultAlert');
        }

        // Restore scroll position
        const scrollPosition = sessionStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition));
            sessionStorage.removeItem('scrollPosition');
        }

        // Check if we need to scroll to a specific section
        const activeSection = sessionStorage.getItem('activeSection');
        if (activeSection) {
            const section = document.getElementById(activeSection);
            if (section) {
                // Add a slight delay to ensure the page is fully loaded
                setTimeout(() => {
                    section.scrollIntoView({ behavior: 'smooth' });
                    // Clear the stored section
                    sessionStorage.removeItem('activeSection');
                }, 100);
            }
        }
    });

    function handleApproveMember(memberId) {
        event.preventDefault();
        
        // Store current scroll position
        const currentPosition = window.pageYOffset;
        
        Swal.fire({
            title: 'Pengesahan',
            text: 'Adakah anda pasti untuk meluluskan permohonan keahlian ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            scrollbarPadding: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Store position in sessionStorage before redirecting
                sessionStorage.setItem('scrollPosition', currentPosition);
                
                fetch('/admins/approve/' + memberId)
                .then(response => {
                    Swal.fire({
                        title: 'Berjaya!',
                        text: 'Permohonan keahlian telah berjaya diluluskan.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        scrollbarPadding: false,
                        allowOutsideClick: false,
                        heightAuto: false,
                        position: 'center'
                    }).then(() => {
                        // Reload the page and maintain scroll position
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Ralat!',
                        text: 'Sila cuba sekali lagi.',
                        icon: 'error'
                    });
                });
            }
        });
    }

    // Handle page load and scroll position
    document.addEventListener('DOMContentLoaded', function() {
        const savedPosition = sessionStorage.getItem('scrollPosition');
        if (savedPosition) {
            window.scrollTo(0, parseInt(savedPosition));
            sessionStorage.removeItem('scrollPosition');
        }
    });

    function handleApproveTermination(memberId, icNo) {
        Swal.fire({
            title: 'Lulus Permohonan?',
            text: 'Adakah anda pasti untuk meluluskan permohonan penamatan keahlian ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admins/approve-termination/${memberId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        ic_no: icNo,
                        status: 'inactive',
                        termination_status: 'approved'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the row status in the termination table
                        const row = document.querySelector(`tr[data-member-id="${memberId}"]`);
                        if (row) {
                            // Update member status to inactive
                            row.setAttribute('data-status', 'inactive');
                            
                            // Update the status badge to show "Tidak Aktif"
                            const statusCell = row.querySelector('td:nth-child(7)'); // Adjust column number if needed
                            statusCell.innerHTML = `
                                <span class="badge bg-secondary">
                                    <i class="bi bi-x-circle-fill me-1"></i>
                                    Tidak Aktif
                                </span>
                            `;

                            // Update action buttons
                            const actionCell = row.querySelector('td:nth-child(6)'); // Adjust column number if needed
                            actionCell.innerHTML = `
                                <a href="/admins/reason/${memberId}" class="btn btn-outline-primary btn-sm me-1">
                                    <i class="bi bi-eye-fill me-1"></i>Lihat
                                </a>
                            `;
                        }

                        Swal.fire({
                            title: 'Berjaya!',
                            text: 'Permohonan penamatan keahlian telah diluluskan dan status ahli telah dikemaskini kepada tidak aktif',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Ralat meluluskan permohonan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Ralat!',
                        text: error.message,
                        icon: 'error'
                    });
                });
            }
        });
    }

    // Add this helper function to update status display
    function updateMemberStatusDisplay(row, status) {
        const statusCell = row.querySelector('td:nth-child(7)'); // Adjust column number if needed
        let badge = '';
        
        switch(status.toLowerCase()) {
            case 'inactive':
                badge = `
                    <span class="badge bg-secondary">
                        <i class="bi bi-x-circle-fill me-1"></i>
                        Tidak Aktif
                    </span>
                `;
                break;
            case 'approved':
                badge = `
                    <span class="badge bg-success">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Aktif
                    </span>
                `;
                break;
            case 'pending':
                badge = `
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-clock-fill me-1"></i>
                        Dalam Proses
                    </span>
                `;
                break;
            default:
                badge = `
                    <span class="badge bg-secondary">
                        <i class="bi bi-question-circle-fill me-1"></i>
                        ${status}
                    </span>
                `;
        }
        
        statusCell.innerHTML = badge;
    }
    </script>

    <!-- Modal Pengesahan Log Keluar -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutConfirmModalLabel">Pengesahan Log Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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

    <!-- Remove the alertContainer div and add success modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 5rem; margin: 20px;"></i>
                    <h4 id="successMessage"></h4>
                </div>
            </div>
        </div>
    </div>

<?php
function getLoanStatusClass($status) {
    switch (strtolower($status)) {
        case 'pending':
            return 'warning text-dark';
        case 'approved':
            return 'success';
        case 'rejected':
            return 'danger';
        default:
            return 'secondary';
    }
}

function getLoanStatusText($status) {
    switch (strtolower($status)) {
        case 'pending':
            return 'Dalam Proses';
        case 'approved':
            return 'Diluluskan';
        case 'rejected':
            return 'Ditolak';
        default:
            return 'Tidak Diketahui';
    }
}

function getMemberStatusClass($status) {
    switch (strtolower($status)) {
        case 'pending':
            return 'warning text-dark';
        case 'approved':
            return 'success';
        case 'rejected':
            return 'danger';
        default:
            return 'secondary';
    }
}

function getWithdrawStatusClass($status) {
    switch ($status) {
        case 'pending':
            return 'warning text-dark';
        case 'approved':
            return 'success';
        case 'rejected':
            return 'danger';
        default:
            return 'secondary';
    }
}

function getStatusClass($status) {
    switch ($status) {
        case 'pending':
            return 'warning text-dark';
        case 'approved':
            return 'success';
        case 'rejected':
            return 'danger';
        case 'inactive':
            return 'secondary';
        default:
            return 'primary';
    }
}

function getTerminationStatusBadge($status, $memberStatus) {
    if ($memberStatus === 'inactive') {
        return '<span class="badge bg-secondary"><i class="bi bi-x-circle-fill me-1"></i>Tidak Aktif</span>';
    }
    
    switch(strtolower($status)) {
        case 'pending':
            return '<span class="badge bg-warning text-dark"><i class="bi bi-clock-fill me-1"></i>Dalam Proses</span>';
        case 'approved':
            return '<span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Diluluskan</span>';
        case 'rejected':
            return '<span class="badge bg-danger"><i class="bi bi-x-circle-fill me-1"></i>Ditolak</span>';
        default:
            return '<span class="badge bg-secondary"><i class="bi bi-question-circle-fill me-1"></i>' . ucfirst($status) . '</span>';
    }
}
?>

