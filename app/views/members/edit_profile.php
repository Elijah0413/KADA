<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemaskini Profil Ahli - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Root variables and background */
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
            padding-top: 85px;
        }

        /* Logo section */
        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        /* Form styles */
        .form-control, .form-select {
            border: 1px solid #dee2e6;
            padding: 0.625rem 0.875rem;
            font-size: 0.95rem;
            border-radius: 0.5rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
        }

        .form-label {
            font-size: 0.9rem;
            color: #2c3e50;
            font-weight: 500;
        }

        .section-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
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
            color: #333333;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #f5f5f5;
            color: #2E7D32;
        }

        .sidebar-link.active {
            background-color: #f5f5f5;
            color: #2E7D32;
            font-weight: 500;
        }

        .sidebar-link i {
            font-size: 1rem;
            width: 1.5rem;
            margin-right: 0.75rem;
            color: #666666;
        }

        /* Main content adjustment */
        .main-content {
            margin-left: 250px;
            padding: 0 1rem;
            transition: margin-left 0.3s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        /* Add styles for the family count badge */
        #family-count {
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .member-number {
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            margin-top: 2rem;
        }

        /* Add some styles for the alerts */
        .alert {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .gap-3 {
            gap: 1rem !important;
        }
    </style>
</head>
<body>
    <!-- Logo Section -->
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
            </div>
        </div>
    </div>

    <!-- Add this after the logo section and before the main content -->
    <div class="container mb-4">
        <?php if (isset($member['status']) && strtolower($member['status']) === 'pending'): ?>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-exclamation-circle fa-2x"></i>
                    </div>
                    <div>
                        <h4 class="alert-heading mb-1">Profil Dalam Proses Pengemaskinian</h4>
                        <p class="mb-0">
                            Profil anda sedang dalam proses pengesahan oleh admin. 
                            Anda masih boleh membuat perubahan pada profil anda, tetapi perubahan tersebut akan mengemaskini permohonan sedia ada.
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Add Sidebar -->
    <div class="sidebar">
        <div class="sidebar-content">
            <h4 class="sidebar-title">Kemaskini Profil</h4>
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
        </div>
    </div>

    <!-- Update Main Content Container -->
    <div class="main-content">
        <div class="container" style="padding-top: 2rem;">
            <!-- Update the header section -->
            <div class="content-container mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit text-success me-2 fs-3"></i>
                        <div>
                            <h4 class="mb-0"><?= htmlspecialchars($pendingData['name']) ?></h4>
                            <p class="text-muted mb-0">Sila kemaskini maklumat anda di bawah</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <?php if (isset($pendingData['status'])): ?>
                            <?php if ($pendingData['status'] === 'pending'): ?>
                                <div class="alert alert-warning py-2 px-3 mb-0">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    Sila tunggu pengesahan sebelum membuat kemaskini
                                </div>
                            <?php elseif ($pendingData['status'] === 'approved'): ?>
                                <div class="alert alert-success py-2 px-3 mb-0">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Anda dibenarkan untuk mengemaskini profil
                                </div>
                            <?php elseif ($pendingData['status'] === 'rejected'): ?>
                                <div class="alert alert-info shadow-sm mb-4" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <h6 class="alert-heading mb-1">Kemaskini Profil Anda</h6>
                                            <p class="mb-0">Sila kemaskini profil anda berdasarkan sebab penolakan untuk mengaktifkan semula akaun anda.</p>
                                            <p class="small mt-2 mb-0">
                                                Anda boleh menyemak sebab penolakan melalui:
                                            </p>
                                            <ul class="small mb-0 mt-1">
                                                <li>Emel yang telah dihantar kepada anda</li>
                                                <li><a href="/members/dashboard" class="alert-link">Papan Pemuka Permohonan</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="/members/profile" class="btn btn-outline-success">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Profil
                        </a>
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form action="/members/update-profile" method="POST" class="needs-validation" id="updateProfileForm" novalidate>
                <!-- Personal Information Section -->
                <div id="personal-info" class="content-container mb-4">
                    <h5 class="section-title">
                        <i class="fas fa-user text-success me-2"></i>
                        Maklumat Peribadi
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Penuh</label>
                            <div class="input-group-edit">
                                <input type="text" class="form-control" name="name" 
                                       value="<?= htmlspecialchars($pendingData['name'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Kad Pengenalan</label>
                            <input type="text" class="form-control" name="ic_no" 
                                   value="<?= htmlspecialchars($pendingData['ic_no'] ?? '') ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jantina</label>
                            <div class="input-group-edit">
                                <select class="form-select" name="gender" required>
                                    <option value="Male" <?= ($pendingData['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Lelaki</option>
                                    <option value="Female" <?= ($pendingData['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Agama</label>
                            <div class="input-group-edit">
                                <input type="text" class="form-control" name="religion" 
                                       value="<?= htmlspecialchars($pendingData['religion'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Bangsa</label>
                            <div class="input-group-edit">
                                <input type="text" class="form-control" name="race" 
                                       value="<?= htmlspecialchars($pendingData['race'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status Perkahwinan</label>
                            <div class="input-group-edit">
                                <select class="form-select" name="marital_status" required>
                                    <option value="Single" <?= ($pendingData['marital_status'] ?? '') === 'Single' ? 'selected' : '' ?>>Bujang</option>
                                    <option value="Married" <?= ($pendingData['marital_status'] ?? '') === 'Married' ? 'selected' : '' ?>>Berkahwin</option>
                                    <option value="Divorced" <?= ($pendingData['marital_status'] ?? '') === 'Divorced' ? 'selected' : '' ?>>Bercerai</option>
                                    <option value="Widowed" <?= ($pendingData['marital_status'] ?? '') === 'Widowed' ? 'selected' : '' ?>>Balu/Duda</option>
                                </select>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employment Information Section -->
                <div id="employment-info" class="content-container mb-4">
                    <h5 class="section-title">
                        <i class="fas fa-briefcase text-success me-2"></i>
                        Maklumat Pekerjaan
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">No. Ahli</label>
                            <div class="input-group-edit">
                                <input type="text" class="form-control" name="member_number" 
                                       value="<?= htmlspecialchars($pendingData['member_number'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. PF</label>
                            <div class="input-group-edit">
                                <input type="text" class="form-control" name="pf_number" 
                                       value="<?= htmlspecialchars($pendingData['pf_number'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jawatan</label>
                            <div class="input-group-edit">
                                <input type="text" class="form-control" name="position" 
                                       value="<?= htmlspecialchars($pendingData['position'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gred</label>
                            <div class="input-group-edit">
                                <input type="text" class="form-control" name="grade" 
                                       value="<?= htmlspecialchars($pendingData['grade'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gaji Bulanan</label>
                            <div class="input-group-edit">
                                <input type="number" step="0.01" class="form-control" name="monthly_salary" 
                                       value="<?= htmlspecialchars($pendingData['monthly_salary'] ?? '') ?>" required>
                                <i class="fas fa-pencil edit-icon text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div id="contact-info" class="content-container mb-4">
                    <h5 class="section-title">
                        <i class="fas fa-address-card text-success me-2"></i>
                        Maklumat Perhubungan
                    </h5>
                    <div class="row g-3">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Alamat Rumah</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="home_address" 
                                           value="<?= htmlspecialchars($pendingData['home_address'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Poskod</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="home_postcode" 
                                           value="<?= htmlspecialchars($pendingData['home_postcode'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Bandar</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="home_city" 
                                           value="<?= htmlspecialchars($pendingData['home_city'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Negeri</label>
                                <div class="input-group-edit">
                                    <select class="form-select" name="home_state" required>
                                        <option value="">Pilih Negeri</option>
                                        <?php
                                        $states = [
                                            'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan', 
                                            'Pahang', 'Perak', 'Perlis', 'Pulau Pinang', 'Sabah', 
                                            'Sarawak', 'Selangor', 'Terengganu', 
                                            'Wilayah Persekutuan Kuala Lumpur',
                                            'Wilayah Persekutuan Labuan',
                                            'Wilayah Persekutuan Putrajaya'
                                        ];
                                        foreach ($states as $state): ?>
                                            <option value="<?= $state ?>" <?= ($pendingData['home_state'] ?? '') === $state ? 'selected' : '' ?>>
                                                <?= $state ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Office Address Section -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Alamat Pejabat</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="office_address" 
                                           value="<?= htmlspecialchars($pendingData['office_address'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Poskod Pejabat</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="office_postcode" 
                                           value="<?= htmlspecialchars($pendingData['office_postcode'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Bandar Pejabat</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="office_city" 
                                           value="<?= htmlspecialchars($pendingData['office_city'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Negeri Pejabat</label>
                                <div class="input-group-edit">
                                    <select class="form-select" name="office_state" required>
                                        <option value="">Pilih Negeri</option>
                                        <?php foreach ($states as $state): ?>
                                            <option value="<?= $state ?>" <?= ($pendingData['office_state'] ?? '') === $state ? 'selected' : '' ?>>
                                                <?= $state ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Telefon Pejabat</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="office_phone" 
                                           value="<?= htmlspecialchars($pendingData['office_phone'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Telefon Rumah</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="home_phone" 
                                           value="<?= htmlspecialchars($pendingData['home_phone'] ?? '') ?>" required>
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. Fax</label>
                                <div class="input-group-edit">
                                    <input type="text" class="form-control" name="fax" 
                                           value="<?= htmlspecialchars($pendingData['fax'] ?? '') ?>">
                                    <i class="fas fa-pencil edit-icon text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Information Section -->
                <div id="family-info" class="content-container mb-4">
                    <h5 class="section-title">
                        <i class="fas fa-users text-success me-2"></i>
                        Maklumat Ahli Keluarga
                        <span class="badge bg-success ms-2" id="family-count">0 Ahli</span>
                        <button type="button" class="btn btn-success btn-sm float-end" id="add-family-member">
                            <i class="fas fa-plus me-1"></i>Tambah Ahli Keluarga
                        </button>
                    </h5>
                    <div id="family-members-container">
                        <?php 
                        if (isset($pendingData['family_members']) && is_array($pendingData['family_members'])):
                            foreach ($pendingData['family_members'] as $index => $family): 
                        ?>
                            <div class="family-member-entry mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Ahli Keluarga</label>
                                        <input type="hidden" name="family_members[<?= $index ?>][id]" 
                                               value="<?= htmlspecialchars($family['id'] ?? '') ?>">
                                        <input type="text" class="form-control" 
                                               name="family_members[<?= $index ?>][name]" 
                                               value="<?= htmlspecialchars($family['name'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">No. Kad Pengenalan</label>
                                        <input type="text" class="form-control" 
                                               name="family_members[<?= $index ?>][ic_no]" 
                                               value="<?= htmlspecialchars($family['ic_no'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Hubungan</label>
                                        <select class="form-select" 
                                                name="family_members[<?= $index ?>][relationship]" required>
                                            <option value="">Pilih Hubungan</option>
                                            <option value="Suami" <?= ($family['relationship'] ?? '') === 'Suami' ? 'selected' : '' ?>>Suami</option>
                                            <option value="Isteri" <?= ($family['relationship'] ?? '') === 'Isteri' ? 'selected' : '' ?>>Isteri</option>
                                            <option value="Anak" <?= ($family['relationship'] ?? '') === 'Anak' ? 'selected' : '' ?>>Anak</option>
                                            <option value="Ibu" <?= ($family['relationship'] ?? '') === 'Ibu' ? 'selected' : '' ?>>Ibu</option>
                                            <option value="Bapa" <?= ($family['relationship'] ?? '') === 'Bapa' ? 'selected' : '' ?>>Bapa</option>
                                            <option value="Adik-beradik" <?= ($family['relationship'] ?? '') === 'Adik-beradik' ? 'selected' : '' ?>>Adik-beradik</option>
                                            <option value="Penjaga" <?= ($family['relationship'] ?? '') === 'Penjaga' ? 'selected' : '' ?>>Penjaga</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-family-member">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="content-container">
                    <div class="d-grid">
                        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">
                            <i class="fas fa-save me-2"></i>Kemaskini Profil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Confirmation Modal -->
    <div class="modal fade" id="confirmUpdateModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengesahan Kemaskini</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning mb-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Selepas kemaskini, profil anda akan dalam status <strong>Dalam Proses</strong> sehingga disahkan oleh admin.
                        <p class="mt-2 mb-1">
                            Sebelum profil anda diluluskan, anda tidak boleh:
                        </p>
                        <ul class="small mb-0 mt-1">
                            <li>Memohon pinjaman</li>
                            <li>Mengurus akaun simpanan anda</li>
                        </ul>
                    </div>
                    <p>Adakah anda pasti untuk mengemaskini profil anda?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success" id="confirmUpdate" form="updateProfileForm">
                        <i class="fas fa-check me-2"></i>Ya, Kemaskini
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Success Alert -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>Berjaya
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Profil anda telah dikemaskini dan kini dalam status <strong>Dalam Proses</strong>. 
                        Sila tunggu pengesahan daripada admin.
                    </div>
                    <p class="mb-0">Anda boleh menyemak status kemaskini profil di Papan Pemuka.</p>
                </div>
                <div class="modal-footer">
                    <a href="/members/dashboard" class="btn btn-success">
                        <i class="fas fa-tachometer-alt me-2"></i>Ke Papan Pemuka
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle smooth scrolling with offset
        function scrollToSection(targetId) {
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                const headerOffset = 120; // Increased offset to account for fixed header
                const elementPosition = targetSection.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Update active state in sidebar
                document.querySelectorAll('.sidebar-link').forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === targetId) {
                        link.classList.add('active');
                    }
                });
            }
        }

        // Check for hash in URL when page loads
        if (window.location.hash) {
            // Delay the scroll to ensure page is fully loaded
            setTimeout(() => {
                scrollToSection(window.location.hash);
            }, 100);
        }

        // Add click event listeners to sidebar links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                scrollToSection(targetId);
                // Update URL without triggering scroll
                history.pushState(null, '', targetId);
            });
        });

        // Update active link on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.content-container[id]');
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.pageYOffset >= (sectionTop - 150)) {
                    currentSection = section.getAttribute('id');
                }
            });

            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${currentSection}`) {
                    link.classList.add('active');
                }
            });
        });

        // Update initial family count
        updateFamilyCount();

        // Function to update family count badge
        function updateFamilyCount() {
            const count = document.querySelectorAll('.family-member-entry').length;
            const familyCountBadge = document.getElementById('family-count');
            if (familyCountBadge) {
                familyCountBadge.textContent = count + ' Ahli';
            }
        }

        // Add family member functionality
        const addFamilyMemberBtn = document.getElementById('add-family-member');
        const familyMembersContainer = document.getElementById('family-members-container');
        
        if (addFamilyMemberBtn) {
            addFamilyMemberBtn.addEventListener('click', function() {
                const index = document.querySelectorAll('.family-member-entry').length;
                const newEntry = `
                    <div class="family-member-entry mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Nama Ahli Keluarga</label>
                                <input type="text" class="form-control" 
                                       name="family_members[${index}][name]" 
                                       placeholder="Masukkan nama penuh"
                                       required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. Kad Pengenalan</label>
                                <input type="text" class="form-control" 
                                       name="family_members[${index}][ic_no]" 
                                       placeholder="Contoh: 890123045678"
                                       required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Hubungan</label>
                                <select class="form-select" name="family_members[${index}][relationship]" required>
                                    <option value="">Pilih Hubungan</option>
                                    <option value="Suami">Suami</option>
                                    <option value="Isteri">Isteri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Bapa">Bapa</option>
                                    <option value="Adik-beradik">Adik-beradik</option>
                                    <option value="Penjaga">Penjaga</option>
                                </select>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-family-member">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                familyMembersContainer.insertAdjacentHTML('beforeend', newEntry);
                updateFamilyCount();
                
                // Add event listener to new remove button
                const newRemoveBtn = familyMembersContainer.lastElementChild.querySelector('.remove-family-member');
                if (newRemoveBtn) {
                    addRemoveButtonListener(newRemoveBtn);
                }
            });
        }

        // Function to add remove button listener
        function addRemoveButtonListener(button) {
            button.addEventListener('click', function() {
                if (confirm('Adakah anda pasti ingin membuang ahli keluarga ini?')) {
                    this.closest('.family-member-entry').remove();
                    reindexFamilyMembers();
                    updateFamilyCount();
                }
            });
        }

        // Add listeners to existing remove buttons
        document.querySelectorAll('.remove-family-member').forEach(button => {
            addRemoveButtonListener(button);
        });

        // Function to reindex family members after removal
        function reindexFamilyMembers() {
            document.querySelectorAll('.family-member-entry').forEach((entry, index) => {
                entry.querySelectorAll('[name^="family_members["]').forEach(input => {
                    const fieldName = input.name.match(/\[([^\]]+)\]$/)[1];
                    input.name = `family_members[${index}][${fieldName}]`;
                });
            });
        }

        const form = document.getElementById('updateProfileForm');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Submit form using fetch
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                // Hide confirmation modal
                const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmUpdateModal'));
                confirmModal.hide();
                
                // Show success modal
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ralat telah berlaku. Sila cuba lagi.');
            });
        });
    });
    </script>
</body>
</html>

