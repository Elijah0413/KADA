<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - KADA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1a5f7a;
            --secondary-color: #2c8fb5;
            --accent-color: #f0b429;
            --text-dark: #2d3748;
            --text-light: #718096;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .text-success {
            color: var(--primary-color) !important;
        }

        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-success:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
    </style>
</head>
<body>

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
                        <!-- Add more FAQ items as needed -->
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
                                                    <i class="bi bi-eye-fill"></i> Lihat Maklum Balas
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

<!-- View Modal -->
<!-- Move all modals outside the table loop and place them directly under the container div -->
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

<!-- Make sure these scripts are at the bottom of the file, just before </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
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

// Clean up any bootstrap modal events when the modal is hidden
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
</script>
</body>
</html>