<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borang Penamatan Keahlian - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .readonly-field {
            background-color: var(--secondary-color);
            cursor: not-allowed;
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

        .btn-danger {
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mb-4">
            <a href="/members/profile" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Profil
            </a>
        </div>

        <h2 class="text-center mb-4">Borang Penamatan Keahlian</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Ralat!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="/members/submit-termination" method="POST" class="needs-validation" novalidate>
            <!-- Personal Information Section -->
            <div class="section-header">
                <h4>Maklumat Peribadi</h4>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Penuh</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['name']); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">No. Kad Pengenalan</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['ic_no']); ?>" readonly>
                    <input type="hidden" name="ic_no" value="<?php echo htmlspecialchars($member['ic_no']); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Jantina</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['gender']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Agama</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['religion']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Bangsa</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['race']); ?>" readonly>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="section-header mt-4">
                <h4>Maklumat Perhubungan</h4>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Alamat Rumah</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['home_address']); ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Poskod</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['home_postcode']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Bandar</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['home_city']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Negeri</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['home_state']); ?>" readonly>
                </div>
            </div>

            <!-- Employment Information -->
            <div class="section-header mt-4">
                <h4>Maklumat Pekerjaan</h4>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">No. Keahlian</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['member_number']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">No. PF</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['pf_number']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jawatan</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['position']); ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Alamat Pejabat</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['office_address']); ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Poskod Pejabat</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['office_postcode']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Bandar Pejabat</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['office_city']); ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">No. Telefon Pejabat</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['office_phone']); ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">No. Telefon Bimbit</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['home_phone']); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">No. Fax</label>
                    <input type="text" class="form-control readonly-field" value="<?php echo htmlspecialchars($member['fax']); ?>" readonly>
                </div>
            </div>

            <!-- Termination Reasons -->
            <div class="section-header mt-4">
                <h4>Sebab-sebab Penamatan</h4>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Sebab Penamatan</label>
                    <select class="form-select" name="reason" required>
                        <option value="">Sila Pilih</option>
                        <option value="pencen">Pencen</option>
                        <option value="pencen awal">Pencen Awal</option>
                        <option value="lain-lain">Lain-lain</option>
                    </select>
                    <div class="invalid-feedback">
                        Sila pilih sebab penamatan
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Keterangan Lanjut</label>
                    <textarea class="form-control" name="reason_details" rows="3" placeholder="Sila berikan keterangan lanjut mengenai sebab penamatan"></textarea>
                </div>
            </div>

            <!-- Declaration -->
            <div class="section-header mt-4">
                <h4>Pengakuan</h4>
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="declarationCheck" name="declaration" required>
                    <label class="form-check-label" for="declarationCheck">
                        Saya mengaku bahawa maklumat yang diberikan adalah benar dan tepat. Saya faham bahawa penamatan keahlian ini adalah muktamad.
                    </label>
                    <div class="invalid-feedback">
                        Sila tandakan pengakuan ini untuk meneruskan
                    </div>
                </div>
            </div>

            <input type="hidden" name="submission_date" value="<?php echo date('Y-m-d'); ?>">

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger" id="submitButton">
                    <i class="fas fa-user-times me-2"></i>Hantar Permohonan Penamatan
                </button>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="confirmationModalLabel">
                        <i class="fas fa-exclamation-circle me-2"></i>Pengesahan Penamatan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-4">
                        <i class="fas fa-user-times fa-3x text-success"></i>
                    </div>
                    <h5 class="mb-3">Pengesahan Penamatan Keahlian</h5>
                    <p class="mb-0">Adakah anda pasti untuk menamatkan keahlian anda?</p>
                    
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Maklumat Penting:</strong>
                        <ul class="list-unstyled text-start mt-2 mb-0">
                            <li><i class="fas fa-check-circle text-success me-2"></i>Tempoh pemprosesan: 1-3 hari bekerja</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Selepas kelulusan, status keahlian akan ditamatkan</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Wang yang akan dikembalikan:
                                <ul class="ms-4">
                                    <li>Modal Syer</li>
                                    <li>Simpanan Anggota</li>
                                    <li>Jumlah Modal Yuran</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-exclamation-triangle text-warning me-2"></i>Tindakan ini tidak boleh dibatalkan</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="button" class="btn btn-success px-4" id="confirmSubmit">
                        <i class="fas fa-check me-2"></i>Ya, Teruskan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="fas fa-check-circle me-2"></i>Permohonan Berjaya
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-4">
                        <i class="fas fa-envelope-open-text fa-3x text-success"></i>
                    </div>
                    <h5 class="mb-3">Permohonan Penamatan Telah Dihantar!</h5>
                    
                    <div class="alert alert-success mb-3">
                        <i class="fas fa-clock me-2"></i>
                        <strong>Status Permohonan:</strong>
                        <p class="mb-0 mt-2">Permohonan anda akan diproses dalam masa 1-3 hari bekerja.</p>
                    </div>

                    <div class="alert alert-info mb-3">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        <strong>Proses Pemulangan Wang:</strong>
                        <ul class="text-start mb-0 mt-2">
                            <li>Wang yang akan dikembalikan:
                                <ul>
                                    <li>Modal Syer</li>
                                    <li>Simpanan Anggota</li>
                                    <li>Jumlah Modal Yuran</li>
                                </ul>
                            </li>
                            <li>Tempoh pemprosesan pemulangan: 5-7 hari bekerja</li>
                            <li>Pemulangan akan dibuat ke akaun bank yang didaftarkan</li>
                        </ul>
                    </div>

                    <p class="mb-0">Anda akan menerima notifikasi melalui emel untuk setiap status permohonan.</p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-success px-4" onclick="window.location.href='/members/profile'">
                        <i class="fas fa-home me-2"></i>Kembali ke Profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitButton = document.getElementById('submitButton');
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            
            // Form validation and submission
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                if (!form.checkValidity()) {
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }

                // Check if reason is selected
                const reasonSelect = form.querySelector('select[name="reason"]');
                if (!reasonSelect.value) {
                    reasonSelect.classList.add('is-invalid');
                    return;
                }

                // Check if declaration is checked
                const declarationCheck = form.querySelector('input[name="declaration"]');
                if (!declarationCheck.checked) {
                    declarationCheck.classList.add('is-invalid');
                    return;
                }

                try {
                    confirmationModal.show();
                } catch (error) {
                    console.error('Error showing confirmation modal:', error);
                    alert('Ralat telah berlaku. Sila cuba lagi.');
                }
            });

            // Confirmation modal submit button
            document.getElementById('confirmSubmit').addEventListener('click', function() {
                try {
                    confirmationModal.hide();
                    
                    // Submit form data
                    const formData = new FormData(form);
                    
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successModal.show();
                        } else {
                            throw new Error(data.message || 'Ralat telah berlaku. Sila cuba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting form:', error);
                        alert('Ralat telah berlaku. Sila cuba lagi.');
                    });

                } catch (error) {
                    console.error('Error in confirmation process:', error);
                    alert('Ralat telah berlaku. Sila cuba lagi.');
                }
            });

            // Success modal redirect
            document.querySelector('#successModal .btn-success').addEventListener('click', function() {
                try {
                    window.location.href = '/members/profile';
                } catch (error) {
                    console.error('Error redirecting:', error);
                    alert('Ralat telah berlaku. Sila cuba lagi.');
                }
            });

            // Clear validation on input change
            form.querySelectorAll('input, select').forEach(element => {
                element.addEventListener('change', function() {
                    this.classList.remove('is-invalid');
                });
            });
        });
    </script>
</body>
</html>
