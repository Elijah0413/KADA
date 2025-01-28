<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KADA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

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
            background-color: #f5f5f5;
        }

        .main-content {
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .table th {
            font-weight: 600;
            color: #2E7D32;
        }

        .badge {
            padding: 8px 12px;
            font-weight: 500;
        }

        .btn-group .btn {
            padding: 6px 12px;
            font-weight: 500;
        }

        .input-group-text {
            border-right: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
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

        /* Sidebar styles */
        .sidebar {
            display: none;
        }

        /* Update main content styles to remove sidebar margin */
        .main-content {
            margin-left: 0;
            margin-top: 85px;
            padding: 20px;
            transition: none;
        }

        /* Update container width and centering */
        .content-container {
            max-width: 1400px;  /* Limit maximum width */
            margin: 0 auto;     /* Center the container */
            padding: 0 20px;    /* Add some padding on the sides */
        }

        /* Update card styles for better spacing */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        /* Stats cards layout */
        .stats-card {
            height: 100%;
            border-left: 4px solid;
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-3px);
        }
        .border-left-success {
            border-left-color: var(--primary-color);
        }
        .border-left-danger {
            border-left-color: #dc3545;
        }
        .border-left-info {
            border-left-color: #0dcaf0;
        }
        .border-left-warning {
            border-left-color: #ffc107;
        }

        /* Main content area */
        .main-content {
            margin-top: 85px;
            padding: 20px 0;
        }

        /* Responsive adjustments */
        @media (max-width: 1500px) {
            .content-container {
                max-width: 1200px;
            }
        }

        @media (max-width: 1200px) {
            .content-container {
                max-width: 95%;
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



<div class="main-content">
    <div class="content-container">
        <!-- Move the back button above the stats -->
        <div class="mb-4">
            <a href="/admins" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Stats Cards Section -->
        <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stats-card border-left-success shadow h-100 py-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                                    Jumlah Ahli Aktif</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $stats['active'] ?? 0 ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-check-fill fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stats-card border-left-danger shadow h-100 py-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                                    Jumlah Ahli Tidak Aktif</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $stats['inactive'] ?? 0 ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-x-fill fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stats-card border-left-info shadow h-100 py-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-2">
                                    Cadangan Pencen (60+)</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $stats['retirement_eligible'] ?? 0 ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-fill-exclamation fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 text-success">
                            <i class="bi bi-people-fill me-2"></i>Senarai Ahli Aktif
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Search and Filter -->
                <div class="row g-3 mb-4">
                    <!-- Search Fields -->
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent">
                                <i class="bi bi-search text-success"></i>
                            </span>
                            <input type="text" id="nameSearch" class="form-control border-start-0" placeholder="Cari nama ahli...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent">
                                <i class="bi bi-search text-success"></i>
                            </span>
                            <input type="text" id="pfSearch" class="form-control border-start-0" placeholder="Cari No. PF...">
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent">
                                <i class="bi bi-funnel text-success"></i>
                            </span>
                            <select id="ageFilter" class="form-select border-start-0">
                                <option value="">Semua Umur</option>
                                <option value="60">60 Tahun ke Atas</option>
                                <option value="below60">Bawah 60 Tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="activeFilter" checked>
                            <label class="form-check-label" for="activeFilter">Ahli Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inactiveFilter" checked>
                            <label class="form-check-label" for="inactiveFilter">Ahli Tidak Aktif</label>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="membersTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>No. Ahli</th>
                                <th>No. IC</th>
                                <th>Umur</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($members as $index => $member): ?>
                                <tr data-member-id="<?= $member['id'] ?>" data-status="<?= $member['status'] ?>">
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $member['name'] ?></td>
                                    <td><?= $member['pf_number'] ?></td>
                                    <td><?= $member['ic_no'] ?></td>
                                    <td><?= $member['age'] ?></td>
                                    <td>
                                        <?php if ($member['status'] === 'approved'): ?>
                                            <span class="badge rounded-pill bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                                Aktif
                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill bg-danger">
                                                <i class="bi bi-x-circle-fill me-1"></i>
                                                Tidak Aktif
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="/admins/lihat/<?= $member['id'] ?>" 
                                               class="btn btn-outline-primary btn-sm" style="min-width: 80px;">
                                                <i class="bi bi-eye-fill me-1"></i>Lihat
                                            </a>
                                            <?php if ($member['termination_status'] === 'pending'): ?>
                                                <button class="btn btn-outline-info btn-sm" style="min-width: 110px;"
                                                        onclick='showTerminationDetails(<?= json_encode([
                                                            "submission_date" => $member["termination_date"],
                                                            "reason_1" => $member["reason_1"],
                                                            "reason_2" => $member["reason_2"],
                                                            "reason_3" => $member["reason_3"]
                                                        ]) ?>)'>
                                                    <i class="bi bi-file-text-fill me-1"></i>Lihat Alasan
                                                </button>
                                                <button class="btn btn-outline-success btn-sm" style="min-width: 80px;"
                                                        onclick="handleTerminationApproval(<?= $member['id'] ?>, '<?= $member['ic_no'] ?>')">
                                                    <i class="bi bi-check-circle-fill me-1"></i>Lulus
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm" style="min-width: 80px;"
                                                        onclick="handleTerminationRejection(<?= $member['id'] ?>, '<?= $member['ic_no'] ?>')">
                                                    <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                                </button>
                                            <?php elseif ($member['status'] === 'inactive'): ?>
                                                <button class="btn btn-outline-success btn-sm" style="min-width: 95px;"
                                                        onclick="handleActivate(<?= $member['id'] ?>)">
                                                    <i class="bi bi-person-check-fill me-1"></i>Aktif
                                                </button>
                                            <?php elseif ($member['age'] >= 60): ?>
                                                <button class="btn btn-outline-danger btn-sm" style="min-width: 95px;"
                                                        onclick="handleDeactivate(<?= $member['id'] ?>, 'retirement')">
                                                    <i class="bi bi-person-x-fill me-1"></i>Nyahaktif
                                                </button>
                                                <button class="btn btn-outline-info btn-sm" style="min-width: 110px;"
                                                        onclick="handleRetirementNotification(<?= $member['id'] ?>, '<?= htmlspecialchars($member['name']) ?>', '<?= htmlspecialchars($member['pf_number']) ?>')">
                                                    <i class="bi bi-envelope-fill me-1"></i>Notis Pencen
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-outline-danger btn-sm" style="min-width: 95px;"
                                                        onclick="handleDeactivate(<?= $member['id'] ?>, 'other')">
                                                    <i class="bi bi-person-x-fill me-1"></i>Nyahaktif
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deactivation Modal -->
<div class="modal fade" id="deactivateModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Nyahaktif Ahli
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="deactivateForm">
                    <input type="hidden" id="memberId" name="member_id">
                    <input type="hidden" id="deactivateReason" name="reason">
                    <div class="mb-3">
                        <label class="form-label text-muted">Catatan Admin</label>
                        <textarea class="form-control" name="remarks" rows="3" required 
                                placeholder="Sila masukkan catatan untuk nyahaktif ahli ini..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger px-4" onclick="submitDeactivation()">
                    <i class="bi bi-check-circle me-2"></i>Sahkan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add this modal at the bottom of the page (outside the table) -->
<div class="modal fade" id="terminationDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Permohonan Berhenti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="terminationDetails"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
// Add event listeners for all filters
document.getElementById('nameSearch').addEventListener('input', filterTable);
document.getElementById('pfSearch').addEventListener('input', filterTable);
document.getElementById('ageFilter').addEventListener('change', filterTable);
document.getElementById('activeFilter').addEventListener('change', filterTable);
document.getElementById('inactiveFilter').addEventListener('change', filterTable);

function filterTable() {
    const nameSearch = document.getElementById('nameSearch').value.toLowerCase();
    const pfSearch = document.getElementById('pfSearch').value.toLowerCase();
    const ageFilter = document.getElementById('ageFilter').value;
    const activeChecked = document.getElementById('activeFilter').checked;
    const inactiveChecked = document.getElementById('inactiveFilter').checked;
    
    const rows = document.querySelectorAll('#membersTable tbody tr');

    rows.forEach(row => {
        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const pfNumber = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const age = parseInt(row.querySelector('td:nth-child(5)').textContent);
        const status = row.getAttribute('data-status');

        // Check if row should be visible based on all filters
        let showRow = true;

        // Name filter
        if (nameSearch && !name.includes(nameSearch)) {
            showRow = false;
        }

        // PF number filter
        if (pfSearch && !pfNumber.includes(pfSearch)) {
            showRow = false;
        }

        // Age filter
        if (ageFilter) {
            if (ageFilter === '60' && age < 60) {
                showRow = false;
            } else if (ageFilter === 'below60' && age >= 60) {
                showRow = false;
            }
        }

        // Status filter
        if (!activeChecked && status === 'approved') {
            showRow = false;
        }
        if (!inactiveChecked && status === 'inactive') {
            showRow = false;
        }

        // Show/hide row based on all filters
        row.style.display = showRow ? '' : 'none';
    });
}

// Initialize the table with active members shown
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('activeFilter').checked = true;
    document.getElementById('inactiveFilter').checked = true;
    filterTable();
});

function handleDeactivate(memberId, reason) {
    Swal.fire({
        title: 'Nyahaktif Ahli?',
        text: 'Adakah anda pasti untuk nyahaktif ahli ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Nyahaktif',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/admins/deactivate-member', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    member_id: memberId,
                    reason: reason,
                    termination_status: 'rejected',
                    process_date: new Date().toISOString().split('T')[0]
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Find the member's row and update only the status cell
                    const memberRow = document.querySelector(`tr[data-member-id="${memberId}"]`);
                    if (memberRow) {
                        const statusCell = memberRow.querySelector('td:nth-child(6)');
                        statusCell.innerHTML = `
                            <span class="badge rounded-pill bg-danger">
                                <i class="bi bi-x-circle-fill me-1"></i>
                                Tidak Aktif
                            </span>
                        `;
                        
                        // Don't hide the row, just update the status
                        filterTable(); // Reapply filters but both active and inactive should be visible
                    }
                    
                    Swal.fire({
                        title: 'Berjaya!',
                        text: 'Status ahli telah dikemaskini',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Ralat!',
                    text: error.message,
                    icon: 'error'
                });
            });
        }
    });
}

function handleRetirementNotification(memberId, memberName, pfNumber) {
    Swal.fire({
        title: 'Hantar Notis Pencen?',
        text: `Hantar notis persaraan kepada ${memberName}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hantar',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/admins/send-retirement-notice', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    member_id: memberId,
                    name: memberName,
                    pf_number: pfNumber
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text().then(text => {
                    return text ? JSON.parse(text) : {}
                });
            })
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Berjaya!',
                        'Notis persaraan telah dihantar.',
                        'success'
                    );
                } else {
                    throw new Error(data.message || 'Ralat menghantar notis');
                }
            })
            .catch(error => {
                Swal.fire(
                    'Ralat!',
                    error.message,
                    'error'
                );
            });
        }
    });
}

function handleRejectionEmail(memberId, memberName, pfNumber) {
    // First show the remarks input dialog
    Swal.fire({
        title: 'Catatan Penolakan',
        html: `
            <div class="mb-3">
                <label for="admin-remarks" class="form-label">Sila masukkan catatan untuk penolakan:</label>
                <textarea id="admin-remarks" class="form-control" rows="3" 
                    placeholder="Masukkan catatan penolakan di sini..."></textarea>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Hantar',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        preConfirm: () => {
            const remarks = document.getElementById('admin-remarks').value;
            if (!remarks.trim()) {
                Swal.showValidationMessage('Sila masukkan catatan');
                return false;
            }
            return remarks;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const adminRemarks = result.value;
            
            Swal.fire({
                title: 'Hantar Notis Penolakan?',
                text: `Hantar notis penolakan permohonan menamatkan keahlian kepada ${memberName}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hantar',
                cancelButtonText: 'Batal'
            }).then((confirmResult) => {
                if (confirmResult.isConfirmed) {
                    Swal.fire({
                        title: 'Menghantar notis...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch('/admins/send-termination-rejection', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            member_id: memberId,
                            name: memberName,
                            pf_number: pfNumber,
                            admin_remarks: adminRemarks,
                            update_status: true  // Add this flag to update the status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berjaya!',
                                text: 'Notis penolakan telah dihantar dan status ahli telah dikemaskini.',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Ralat menghantar notis');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Ralat!',
                            text: error.message || 'Ralat menghantar notis'
                        });
                    });
                }
            });
        }
    });
}

function showTerminationDetails(dataString) {
    const data = JSON.parse(dataString);
    console.log('Termination data:', data); // Debug log
    
    let html = `
        <p><strong>Tarikh Permohonan:</strong><br>
           ${data.submission_date ? new Date(data.submission_date).toLocaleDateString('ms-MY') : '-'}
        </p>
        <p><strong>Alasan 1:</strong><br>
           ${data.reason_1 || '-'}
        </p>
        <p><strong>Alasan 2:</strong><br>
           ${data.reason_2 || '-'}
        </p>
        <p><strong>Alasan 3:</strong><br>
           ${data.reason_3 || '-'}
        </p>
    `;
    
    document.getElementById('terminationDetails').innerHTML = html;
    new bootstrap.Modal(document.getElementById('terminationDetailsModal')).show();
}

function handleTerminationApproval(memberId, icNo) {
    Swal.fire({
        title: 'Sahkan Penamatan Keahlian?',
        text: 'Adakah anda pasti untuk meluluskan penamatan keahlian ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Luluskan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/admins/approve-termination', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    member_id: memberId,
                    ic_no: icNo,
                    process_date: new Date().toISOString().split('T')[0]
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Berjaya!',
                        text: 'Penamatan keahlian telah diluluskan',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Ralat!',
                    text: error.message,
                    icon: 'error'
                });
            });
        }
    });
}

function handleTerminationRejection(memberId, icNo) {
    Swal.fire({
        title: 'Catatan Penolakan',
        html: `
            <div class="mb-3">
                <label for="admin-remarks" class="form-label">Sila masukkan catatan untuk penolakan:</label>
                <textarea id="admin-remarks" class="form-control" rows="3" 
                    placeholder="Masukkan catatan penolakan di sini..."></textarea>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Hantar',
        cancelButtonText: 'Batal',
        preConfirm: () => {
            const remarks = document.getElementById('admin-remarks').value;
            if (!remarks.trim()) {
                Swal.showValidationMessage('Sila masukkan catatan');
                return false;
            }
            return remarks;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/admins/reject-termination', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    member_id: memberId,
                    ic_no: icNo,
                    admin_remarks: result.value,
                    process_date: new Date().toISOString().split('T')[0]
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Berjaya!',
                        text: 'Permohonan penamatan keahlian telah ditolak',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Ralat!',
                    text: error.message,
                    icon: 'error'
                });
            });
        }
    });
}

function handleActivate(memberId) {
    Swal.fire({
        title: 'Aktifkan Ahli?',
        text: 'Adakah anda pasti untuk aktifkan ahli ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Aktifkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/admins/activate-member', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    member_id: memberId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text().then(text => {
                    return text ? JSON.parse(text) : {}
                });
            })
            .then(data => {
                if (data.success) {
                    // Find the member's row and update the status cell
                    const memberRow = document.querySelector(`tr[data-member-id="${memberId}"]`);
                    if (memberRow) {
                        memberRow.setAttribute('data-status', 'approved');
                        const statusCell = memberRow.querySelector('td:nth-child(6)');
                        statusCell.innerHTML = `
                            <span class="badge rounded-pill bg-success">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Aktif
                            </span>
                        `;
                        
                        // Update the action buttons
                        const actionCell = memberRow.querySelector('td:last-child .d-flex');
                        actionCell.innerHTML = `
                            <a href="/admins/lihat/${memberId}" 
                               class="btn btn-outline-primary btn-sm" style="min-width: 80px;">
                                <i class="bi bi-eye-fill me-1"></i>Lihat
                            </a>
                            <button class="btn btn-outline-danger btn-sm" style="min-width: 80px;"
                                    onclick="handleDeactivate(${memberId}, 'other')">
                                <i class="bi bi-person-x-fill me-1"></i>Nyahaktif
                            </button>
                        `;
                        
                        filterTable(); // Reapply filters
                    }
                    
                    Swal.fire({
                        title: 'Berjaya!',
                        text: 'Status ahli telah dikemaskini',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.message || 'Ralat mengaktifkan ahli');
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

// Logout confirmation
function showLogoutConfirmation(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Log Keluar?',
        text: "Adakah anda pasti untuk log keluar?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Log Keluar',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/logout';
        }
    });
}

// Debug function to check statuses
function debugStatuses() {
    const rows = document.querySelectorAll('#membersTable tbody tr');
    rows.forEach(row => {
        console.log('Row status:', row.getAttribute('data-status'));
    });
}

// Call this in console to debug
// debugStatuses();
</script>

<!-- Required JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html> 