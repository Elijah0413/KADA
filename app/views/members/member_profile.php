<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Profile Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2E7D32;      /* Dark green */
            --secondary-color: #E8F5E9;    /* Light green background */
            --accent-color: #81C784;       /* Medium green */
            --text-color: #2C3E50;         /* Dark gray for text */
            --border-color: #E0E0E0;       /* Light gray for borders */
        }

        body { 
            background: url('/images/padi_bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text-color);
            padding-bottom: 40px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container { 
            max-width: 1000px; 
            background: rgba(255, 255, 255, 0.95); 
            padding: 40px;
            border-radius: 12px;
            margin: 30px auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .section-header {
            background-color: transparent;
            padding: 0;
            margin: 35px 0 25px 0;
            color: var(--primary-color);
            font-weight: 500;
            font-size: 1.2rem;
            border-bottom: 2px solid var(--primary-color);
            border-left: none;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 12px 16px;
            transition: all 0.2s ease;
            background-color: #FAFAFA;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.15);
            background-color: #FFFFFF;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .btn-primary:hover {
            background-color: #1B5E20;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
        }

        /* Step indicators styling */
        .section-indicator {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0 3rem;
            position: relative;
            z-index: 1;
        }

        .section-indicator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border-color);
            z-index: -1;
        }

        .section-indicator .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }

        .section-indicator .step span {
            background: white;
            padding: 0.5rem;
            font-size: 0.85rem;
            color: var(--text-color);
            margin-top: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .section-indicator .step::before {
            content: '';
            width: 30px;
            height: 30px;
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .section-indicator .step:nth-child(1)::before { content: '1'; }
        .section-indicator .step:nth-child(2)::before { content: '2'; }
        .section-indicator .step:nth-child(3)::before { content: '3'; }
        .section-indicator .step:nth-child(4)::before { content: '4'; }
        .section-indicator .step:nth-child(5)::before { content: '5'; }

        .section-indicator .step.active::before {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .section-indicator .step.active span {
            color: var(--primary-color);
            font-weight: 500;
        }

        .section-indicator .step.completed::before {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            content: '✓';
        }

        .section-indicator .step.completed span {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .section-indicator .step span {
                font-size: 0.75rem;
                padding: 0.25rem;
            }

            .section-indicator .step::before {
                width: 25px;
                height: 25px;
            }
        }

        @media (max-width: 576px) {
            .section-indicator .step span {
                display: none;
            }
            
            .section-indicator {
                margin: 1.5rem 0;
            }
        }

        /* Family member entry styling */
        .family-member-entry {
            transition: all 0.3s ease;
            background: #f8f9fa;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 1rem;
            padding: 1.5rem;
        }

        .family-member-entry:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* Modal styling */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .modal-header {
            background-color: var(--secondary-color);
            border-bottom: none;
            border-radius: 12px 12px 0 0;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .payment-option:hover {
            border-color: var(--primary-color);
            background-color: var(--secondary-color);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(10px); }
        }

        .form-section {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
            display: none;
        }

        .form-section:not(.d-none) {
            opacity: 1;
            transform: translateY(0);
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mb-4">
            <a href="/members" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman Utama
            </a>
        </div>

        <h2 class="text-center mb-4">Pendaftaran Profil Ahli</h2>

        <!-- Add section indicators -->
        <div class="section-indicator">
            <div class="step active" data-section="1">
                <span>Maklumat Peribadi</span>
            </div>
            <div class="step" data-section="2">
                <span>Maklumat Pekerjaan</span>
            </div>
            <div class="step" data-section="3">
                <span>Maklumat Perhubungan</span>
            </div>
            <div class="step" data-section="4">
                <span>Maklumat Keluarga</span>
            </div>
            <div class="step" data-section="5">
                <span>Maklumat Kewangan</span>
            </div>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php 
            $formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
            
            // Helper function to get old input
            function old($field) {
                global $formData;
                return isset($formData[$field]) ? htmlspecialchars($formData[$field]) : '';
            }
        ?>

        <form action="/save-member-profile" method="POST" class="needs-validation" novalidate>
            <!-- Section 1: Personal Information -->
            <div class="form-section" id="section1">
                <h4 class="section-header">Maklumat Peribadi</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Penuh</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?php echo old('name'); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ic_no" class="form-label">No. Kad Pengenalan</label>
                        <input type="text" class="form-control" id="ic_no" name="ic_no" 
                               value="<?php echo isset($userData['ic_no']) ? htmlspecialchars($userData['ic_no']) : old('ic_no'); ?>" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Jantina</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Pilih Jantina</option>
                            <option value="Male" <?php echo old('gender') === 'Male' ? 'selected' : ''; ?>>Lelaki</option>
                            <option value="Female" <?php echo old('gender') === 'Female' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="religion" class="form-label">Agama</label>
                        <select class="form-select" id="religion" name="religion" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" <?php echo old('religion') === 'Islam' ? 'selected' : ''; ?>>Islam</option>
                            <option value="Buddha" <?php echo old('religion') === 'Buddha' ? 'selected' : ''; ?>>Buddha</option>
                            <option value="Hindu" <?php echo old('religion') === 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                            <option value="Kristian" <?php echo old('religion') === 'Kristian' ? 'selected' : ''; ?>>Kristian</option>
                            <option value="Sikh" <?php echo old('religion') === 'Sikh' ? 'selected' : ''; ?>>Sikh</option>
                            <option value="Taoisme" <?php echo old('religion') === 'Taoisme' ? 'selected' : ''; ?>>Taoisme</option>
                            <option value="Konfusianisme" <?php echo old('religion') === 'Konfusianisme' ? 'selected' : ''; ?>>Konfusianisme</option>
                            <option value="Lain-lain" <?php echo old('religion') === 'Lain-lain' ? 'selected' : ''; ?>>Lain-lain</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="race" class="form-label">Bangsa</label>
                        <select class="form-select" id="race" name="race" required>
                            <option value="">Pilih Bangsa</option>
                            <option value="Melayu" <?php echo old('race') === 'Melayu' ? 'selected' : ''; ?>>Melayu</option>
                            <option value="Cina" <?php echo old('race') === 'Cina' ? 'selected' : ''; ?>>Cina</option>
                            <option value="India" <?php echo old('race') === 'India' ? 'selected' : ''; ?>>India</option>
                            <option value="Kadazan-Dusun" <?php echo old('race') === 'Kadazan-Dusun' ? 'selected' : ''; ?>>Kadazan-Dusun</option>
                            <option value="Iban" <?php echo old('race') === 'Iban' ? 'selected' : ''; ?>>Iban</option>
                            <option value="Bidayuh" <?php echo old('race') === 'Bidayuh' ? 'selected' : ''; ?>>Bidayuh</option>
                            <option value="Melanau" <?php echo old('race') === 'Melanau' ? 'selected' : ''; ?>>Melanau</option>
                            <option value="Murut" <?php echo old('race') === 'Murut' ? 'selected' : ''; ?>>Murut</option>
                            <option value="Bajau" <?php echo old('race') === 'Bajau' ? 'selected' : ''; ?>>Bajau</option>
                            <option value="Peranakan" <?php echo old('race') === 'Peranakan' ? 'selected' : ''; ?>>Peranakan</option>
                            <option value="Serani" <?php echo old('race') === 'Serani' ? 'selected' : ''; ?>>Serani</option>
                            <option value="Lain-lain" <?php echo old('race') === 'Lain-lain' ? 'selected' : ''; ?>>Lain-lain</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="marital_status" class="form-label">Status Perkahwinan</label>
                        <select class="form-select" id="marital_status" name="marital_status" required>
                            <option value="">Pilih Status</option>
                            <option value="Single">Bujang</option>
                            <option value="Married">Berkahwin</option>
                            <option value="Divorced">Bercerai</option>
                            <option value="Widowed">Balu/Duda</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary next-section">Seterusnya</button>
                </div>
            </div>

            <!-- Section 2: Employment Information -->
            <div class="form-section d-none" id="section2">
                <h4 class="section-header">Maklumat Pekerjaan</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="member_number" class="form-label">No. Ahli</label>
                        <input type="text" class="form-control" id="member_number" name="member_number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="pf_number" class="form-label">No. PF</label>
                        <input type="text" class="form-control" id="pf_number" name="pf_number" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="position" class="form-label">Jawatan</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <div class="col-md-4">
                        <label for="grade" class="form-label">Gred</label>
                        <input type="text" class="form-control" id="grade" name="grade" required>
                    </div>
                    <div class="col-md-4">
                        <label for="monthly_salary" class="form-label">Gaji Bulanan</label>
                        <input type="number" step="0.01" class="form-control" id="monthly_salary" name="monthly_salary" required>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-section">Kembali</button>
                    <button type="button" class="btn btn-primary next-section">Seterusnya</button>
                </div>
            </div>

            <!-- Section 3: Contact Information -->
            <div class="form-section d-none" id="section3">
                <h4 class="section-header">Maklumat Perhubungan</h4>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="home_address" class="form-label">Alamat Rumah</label>
                        <textarea class="form-control" id="home_address" name="home_address" rows="2" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="home_postcode" class="form-label">Poskod Rumah</label>
                        <input type="text" class="form-control" id="home_postcode" name="home_postcode" required>
                    </div>
                    <div class="col-md-6">
                        <label for="home_state" class="form-label">Negeri Rumah</label>
                        <select class="form-select" id="home_state" name="home_state" required>
                            <option value="">Pilih Negeri</option>
                            <option value="Johor" <?php echo old('home_state') === 'Johor' ? 'selected' : ''; ?>>Johor</option>
                            <option value="Kedah" <?php echo old('home_state') === 'Kedah' ? 'selected' : ''; ?>>Kedah</option>
                            <option value="Kelantan" <?php echo old('home_state') === 'Kelantan' ? 'selected' : ''; ?>>Kelantan</option>
                            <option value="Melaka" <?php echo old('home_state') === 'Melaka' ? 'selected' : ''; ?>>Melaka</option>
                            <option value="Negeri Sembilan" <?php echo old('home_state') === 'Negeri Sembilan' ? 'selected' : ''; ?>>Negeri Sembilan</option>
                            <option value="Pahang" <?php echo old('home_state') === 'Pahang' ? 'selected' : ''; ?>>Pahang</option>
                            <option value="Perak" <?php echo old('home_state') === 'Perak' ? 'selected' : ''; ?>>Perak</option>
                            <option value="Perlis" <?php echo old('home_state') === 'Perlis' ? 'selected' : ''; ?>>Perlis</option>
                            <option value="Pulau Pinang" <?php echo old('home_state') === 'Pulau Pinang' ? 'selected' : ''; ?>>Pulau Pinang</option>
                            <option value="Sabah" <?php echo old('home_state') === 'Sabah' ? 'selected' : ''; ?>>Sabah</option>
                            <option value="Sarawak" <?php echo old('home_state') === 'Sarawak' ? 'selected' : ''; ?>>Sarawak</option>
                            <option value="Selangor" <?php echo old('home_state') === 'Selangor' ? 'selected' : ''; ?>>Selangor</option>
                            <option value="Terengganu" <?php echo old('home_state') === 'Terengganu' ? 'selected' : ''; ?>>Terengganu</option>
                            <option value="Wilayah Persekutuan Kuala Lumpur" <?php echo old('home_state') === 'Wilayah Persekutuan Kuala Lumpur' ? 'selected' : ''; ?>>Wilayah Persekutuan Kuala Lumpur</option>
                            <option value="Wilayah Persekutuan Labuan" <?php echo old('home_state') === 'Wilayah Persekutuan Labuan' ? 'selected' : ''; ?>>Wilayah Persekutuan Labuan</option>
                            <option value="Wilayah Persekutuan Putrajaya" <?php echo old('home_state') === 'Wilayah Persekutuan Putrajaya' ? 'selected' : ''; ?>>Wilayah Persekutuan Putrajaya</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="office_address" class="form-label">Alamat Kantor</label>
                        <textarea class="form-control" id="office_address" name="office_address" rows="2" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="office_postcode" class="form-label">Poskod Kantor</label>
                        <input type="text" class="form-control" id="office_postcode" name="office_postcode" required>
                    </div>
                    <div class="col-md-4">
                        <label for="office_phone" class="form-label">Telefon Kantor</label>
                        <input type="text" class="form-control" id="office_phone" name="office_phone" required>
                    </div>
                    <div class="col-md-4">
                        <label for="home_phone" class="form-label">Telefon Rumah</label>
                        <input type="text" class="form-control" id="home_phone" name="home_phone" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fax" class="form-label">Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax">
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-section">Kembali</button>
                    <button type="button" class="btn btn-primary next-section">Seterusnya</button>
                </div>
            </div>

            <!-- Section 4: Family Information -->
            <div class="form-section d-none" id="section4">
                <h4 class="section-header">Maklumat Keluarga</h4>
                <div id="family-members-container">
                    <div class="family-member-entry mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Nama Ahli Keluarga</label>
                                <input type="text" class="form-control" name="family_members[0][name]" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. Kad Pengenalan</label>
                                <input type="text" class="form-control" name="family_members[0][ic_no]" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Hubungan</label>
                                <select class="form-select" name="family_members[0][relationship]" required>
                                    <option value="">Pilih Hubungan</option>
                                    <option value="Spouse">Pasangan</option>
                                    <option value="Child">Anak</option>
                                    <option value="Parent">Ibu/Bapa</option>
                                    <option value="Sibling">Adik-beradik</option>
                                </select>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-family-member" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" id="add-family-member">
                        <i class="fas fa-plus"></i> Tambah Ahli Keluarga
                    </button>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-section">Kembali</button>
                    <button type="button" class="btn btn-primary next-section">Seterusnya</button>
                </div>
            </div>

            <!-- Section 5: Financial Information -->
            <div class="form-section d-none" id="section5">
                <h4 class="section-header">Maklumat Kewangan</h4>
                
                <!-- Add confirmation checkbox -->
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreementCheck" name="agreement" required>
                        <label class="form-check-label" for="agreementCheck">
                            Jika diterima sebagai anggota, saya bersetuju membayar yuran dan sumbangan bulanan seperti di bawah
                        </label>
                        <div class="invalid-feedback">
                            Sila tandakan kotak ini untuk meneruskan pendaftaran.
                        </div>
                    </div>
                </div>

                <!-- Fixed Fees Section -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Yuran Tetap</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="registration_fee" class="form-label">Yuran Pendaftaran</label>
                                <input type="number" class="form-control" id="registration_fee" name="registration_fee" value="35" readonly>
                                <small class="text-muted">Untuk menjadi ahli</small>
                            </div>
                            <div class="col-md-3">
                                <label for="share_capital" class="form-label">Modal Saham</label>
                                <input type="number" class="form-control" id="share_capital" name="share_capital" value="300" readonly>
                                <small class="text-muted">Untuk memohon pinjaman</small>
                            </div>
                            <div class="col-md-3">
                                <label for="fee_capital" class="form-label">Modal Yuran</label>
                                <input type="number" class="form-control" id="fee_capital" name="fee_capital" value="50" readonly>
                                <small class="text-muted">RM50/bulan untuk mengekalkan status ahli</small>
                            </div>
                            <div class="col-md-3">
                                <label for="welfare_fund" class="form-label">Tabung Kebajikan</label>
                                <input type="number" class="form-control" id="welfare_fund" name="welfare_fund" value="5" readonly>
                                <small class="text-muted">RM5/bulan untuk tabung kebajikan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flexible Fees Section -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Yuran Fleksibel</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="deposit_funds" class="form-label">Modal Deposit</label>
                                <div class="input-group">
                                    <span class="input-group-text">RM</span>
                                    <input type="number" step="0.01" class="form-control" id="deposit_funds" name="deposit_funds" 
                                           min="20" required>
                                </div>
                                <small class="text-muted">Minimum RM20 - Akan dimasukkan ke dalam akaun simpanan jika diluluskan</small>
                            </div>
                            <div class="col-md-6">
                                <label for="fixed_deposit" class="form-label">Simpanan Tetap</label>
                                <div class="input-group">
                                    <span class="input-group-text">RM</span>
                                    <input type="number" step="0.01" class="form-control" id="fixed_deposit" name="fixed_deposit" 
                                           min="0" required>
                                </div>
                                <small class="text-muted">Minimum RM0 - Perlu deposit ke dalam akaun setiap bulan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Optional Contributions -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="other_contributions" class="form-label">Kontribusi Lain (Pilihan)</label>
                        <textarea class="form-control" id="other_contributions" name="other_contributions" rows="2"></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-section">Kembali</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Hantar Pendaftaran</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="fas fa-check-circle me-2"></i>Tahniah!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-4">
                        <i class="fas fa-envelope-open-text fa-3x text-success"></i>
                    </div>
                    <h5 class="mb-3">Borang Anda Telah Berjaya Dihantar!</h5>
                    <p class="mb-0">Sila tunggu email kelulusan daripada kami. Kami akan memproses permohonan anda secepat mungkin.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success px-4" onclick="window.location.href='/members'">
                        <i class="fas fa-home me-2"></i>Kembali ke Halaman Utama
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        document.addEventListener('DOMContentLoaded', function() {
            // Form handling
            const form = document.querySelector('form');
            const submitButton = document.getElementById('submitButton');
            
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                
                if (form.checkValidity()) {
                    // Show success modal
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                        backdrop: 'static',  // Prevent closing when clicking outside
                        keyboard: false      // Prevent closing with keyboard
                    });
                    successModal.show();
                    
                    // Only submit the form when user clicks the "Kembali ke Halaman Utama" button
                    document.querySelector('#successModal .btn-success').addEventListener('click', function() {
                        form.submit();
                    });
                } else {
                    form.classList.add('was-validated');
                }
            });

            // Section Navigation
            const sections = document.querySelectorAll('.form-section');
            const steps = document.querySelectorAll('.step');
            
            // Next section buttons
            document.querySelectorAll('.next-section').forEach(button => {
                button.addEventListener('click', function() {
                    const currentSection = this.closest('.form-section');
                    const nextSection = currentSection.nextElementSibling;
                    
                    // Validate current section
                    const inputs = currentSection.querySelectorAll('input[required], select[required], textarea[required]');
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
                        return;
                    }
                    
                    // Move to next section
                    currentSection.classList.add('d-none');
                    nextSection.classList.remove('d-none');
                    
                    // Update steps indicator
                    const currentStep = document.querySelector(`.step[data-section="${currentSection.id.replace('section', '')}"]`);
                    const nextStep = document.querySelector(`.step[data-section="${nextSection.id.replace('section', '')}"]`);
                    
                    currentStep.classList.remove('active');
                    nextStep.classList.add('active');
                });
            });
            
            // Previous section buttons
            document.querySelectorAll('.prev-section').forEach(button => {
                button.addEventListener('click', function() {
                    const currentSection = this.closest('.form-section');
                    const prevSection = currentSection.previousElementSibling;
                    
                    currentSection.classList.add('d-none');
                    prevSection.classList.remove('d-none');
                    
                    // Update steps indicator
                    const currentStep = document.querySelector(`.step[data-section="${currentSection.id.replace('section', '')}"]`);
                    const prevStep = document.querySelector(`.step[data-section="${prevSection.id.replace('section', '')}"]`);
                    
                    currentStep.classList.remove('active');
                    prevStep.classList.add('active');
                });
            });

            // Family Members
            const container = document.getElementById('family-members-container');
            const addButton = document.getElementById('add-family-member');
            let memberCount = 1;

            addButton.addEventListener('click', function() {
                const template = container.querySelector('.family-member-entry').cloneNode(true);
                const inputs = template.querySelectorAll('input, select');
                
                inputs.forEach(input => {
                    input.name = input.name.replace('[0]', `[${memberCount}]`);
                    input.value = '';
                });

                template.querySelector('.remove-family-member').style.display = 'block';
                container.appendChild(template);
                memberCount++;
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-family-member')) {
                    const entry = e.target.closest('.family-member-entry');
                    if (container.querySelectorAll('.family-member-entry').length > 1) {
                        entry.remove();
                    }
                }
            });
        });
    </script>
</body>
</html>
