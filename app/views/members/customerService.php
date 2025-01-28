<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perkhidmatan Pelanggan - KADA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
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

        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
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

        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }

        .list-group-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            color: var(--primary-color);
        }

        .contact-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }

        .accordion-button:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(46, 125, 50, 0.25);
        }

        .badge {
            padding: 0.5em 1em;
        }

        .badge.bg-warning {
            background-color: #ffd54f !important;
            color: #000;
        }

        .badge.bg-info {
            background-color: #4fc3f7 !important;
        }

        .badge.bg-success {
            background-color: var(--primary-color) !important;
        }

        .btn-info {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }

        .btn-info:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        footer {
            background-color: var(--primary-color);
            color: var(--text-light);
            padding: 2rem 0;
            margin-top: 2rem;
        }

        .social-links a {
            color: var(--text-light);
            margin: 0 10px;
            font-size: 1.2rem;
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

    <div class="page-wrapper">
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
                                    <a class="nav-link active" href="/members/customerService">PERKHIDMATAN PELANGGAN</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="container my-5">
                    <!-- Back Button -->
                    <div class="mb-4">
                        <a href="/members" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Laman Utama
                        </a>
                    </div>

                    <div class="row">
                        <!-- Contact Information -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Hubungi Kami</h4>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-phone-alt fa-2x text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Sokongan Telefon</h6>
                                            <p class="mb-0">+60 97455388</p>
                                            <small class="text-muted">Tersedia 24/7</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-envelope fa-2x text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Sokongan E-mel</h6>
                                            <p class="mb-0">prokada@kada.gov.my</p>
                                            <small class="text-muted">Maklum balas dalam masa 24 jam</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt fa-2x text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Pejabat Utama</h6>
                                            <p class="mb-0">Lembaga Kemajuan Pertanian Kemubu,</p>
                                            <p class="mb-0">Peti Surat 127, Bandar Kota Bharu,</p>
                                            <p class="mb-0">15710 Kota Bahru, Kelantan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Hantar Mesej Kepada Kami</h4>
                                    <form action="/members/submitInquiry" method="POST">
                                        <div class="mb-3">
                                            <label for="subject" class="form-label">Subjek</label>
                                            <select class="form-select" id="subject" name="subject" required>
                                                <option value="">Pilih subjek</option>
                                                <option value="account">Isu Akaun</option>
                                                <option value="transaction">Isu Transaksi</option>
                                                <option value="technical">Sokongan Teknikal</option>
                                                <option value="other">Lain-lain</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="message" class="form-label">Mesej</label>
                                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">Hantar Pertanyaan</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Section -->
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Soalan Lazim</h4>
                                    <div class="accordion" id="faqAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                                    Mengapa saya tidak boleh memohon pinjaman?
                                                </button>
                                            </h2>
                                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    Pastikan anda telah melengkapkan profil anda terlebih dahulu, kemudian tunggu pihak admin meluluskan permohonan anda. Selepas itu, barulah anda boleh memohon pinjaman.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                                    Berapa lama masa yang diperlukan untuk memproses pengeluaran?
                                                </button>
                                            </h2>
                                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    Kebanyakan pengeluaran diproses secara serta-merta. Walau bagaimanapun, sesetengah pengeluaran mungkin mengambil masa 1-3 hari bekerja untuk diproses.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message History Section -->
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Sejarah Mesej</h4>
                                    <?php if (isset($data['inquiries']) && is_array($data['inquiries']) && count($data['inquiries']) > 0): ?>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Tarikh</th>
                                                        <th>Subjek</th>
                                                        <th>Status</th>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($data['inquiries'] as $inquiry): ?>
                                                        <tr>
                                                            <td><?= date('Y-m-d H:i', strtotime($inquiry->created_at)) ?></td>
                                                            <td><?= htmlspecialchars(
                                                                $inquiry->subject == 'account' ? 'Isu Akaun' : 
                                                                ($inquiry->subject == 'transaction' ? 'Isu Transaksi' : 
                                                                ($inquiry->subject == 'technical' ? 'Sokongan Teknikal' : 
                                                                ($inquiry->subject == 'other' ? 'Lain-lain' : $inquiry->subject)))
                                                            ) ?></td>
                                                            <td>
                                                                <span class="badge bg-<?= 
                                                                    $inquiry->status == 'pending' ? 'warning' : 
                                                                    ($inquiry->status == 'in_progress' ? 'info' : 'success') 
                                                                ?>">
                                                                    <?= $inquiry->status == 'pending' ? 'Dalam Proses' : 
                                                                        ($inquiry->status == 'in_progress' ? 'Sedang Diproses' : 'Selesai') ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <button type="button" 
                                                                        class="btn btn-info btn-sm view-response" 
                                                                        onclick="showModal(<?= $inquiry->id ?>)">
                                                                    <i class="fas fa-eye"></i> Lihat Maklum Balas
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">Tiada sejarah mesej ditemui.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-light py-4">
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
                        <img src="/images/qr.jpg" alt="QR Code" class="qr-code" style="max-width: 70px;">
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
                    <a href="/logout" class="btn btn-danger">Log Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <?php if (isset($data['inquiries']) && is_array($data['inquiries'])): ?>
        <?php foreach($data['inquiries'] as $inquiry): ?>
            <div class="modal fade" id="viewModal<?= $inquiry->id ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $inquiry->id ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Butiran Pertanyaan</h5>
                            <button type="button" class="btn-close" onclick="hideModal(<?= $inquiry->id ?>)"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Member's Message -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Mesej Anda</h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($inquiry->message)) ?></p>
                                </div>
                            </div>

                            <!-- Admin's Response -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Maklum Balas Admin</h6>
                                </div>
                                <div class="card-body">
                                    <?php if ($inquiry->status == 'resolved' && !empty($inquiry->admin_response)): ?>
                                        <p class="mb-0"><?= nl2br(htmlspecialchars($inquiry->admin_response)) ?></p>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">Belum ada maklum balas.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="hideModal(<?= $inquiry->id ?>)">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Profile Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const profileSidebar = document.getElementById('profileSidebar');
            
            profileButton.addEventListener('click', function(e) {
                e.preventDefault();
                profileSidebar.classList.toggle('active');
            });

            document.addEventListener('click', function(e) {
                if (!profileSidebar.contains(e.target) && !profileButton.contains(e.target)) {
                    profileSidebar.classList.remove('active');
                }
            });
        });

        function showModal(id) {
            const modalElement = document.getElementById('viewModal' + id);
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }

        function hideModal(id) {
            const modalElement = document.getElementById('viewModal' + id);
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
        }

        // Clean up modal events
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.dispose();
                    }
                });
            });
        });

        function toggleProfileSidebar() {
            const profileSidebar = document.getElementById('profileSidebar');
            profileSidebar.classList.toggle('active');
        }
    </script>
</body>
</html>