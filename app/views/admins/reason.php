<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Ahli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(149, 157, 165, 0.15);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            font-size: 1.4rem;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
        }
        .section {
            margin-bottom: 2.8rem;
            animation: fadeIn 0.6s ease-in-out;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            color: #4b5563;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 1rem;
            width: 35%;
        }
        .table td {
            font-size: 0.95rem;
            padding: 1rem;
            color: #1f2937;
        }
        .bg-light {
            background-color: #f3f4f6 !important;
        }
        .card .card-body {
            padding: 2rem;
        }
        .icon {
            margin-right: 0.75rem;
        }
        h5 {
            color: #1e40af;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        .btn-outline-success {
            color: #16a34a;
            background-color: #fff;
            border: 1px solid #16a34a;
        }
        .btn-outline-success:hover {
            color: #fff;
            background-color: #16a34a;
            border-color: #16a34a;
            transform: translateY(-2px);
        }
        .btn-outline-danger {
            color: #dc2626;
            background-color: #fff;
            border: 1px solid #dc2626;
        }
        .btn-outline-danger:hover {
            color: #fff;
            background-color: #dc2626;
            border-color: #dc2626;
            transform: translateY(-2px);
        }
        .btn-outline-secondary {
            color: #4b5563;
            background-color: #fff;
            border: 1px solid #4b5563;
        }
        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #4b5563;
            border-color: #4b5563;
            transform: translateY(-2px);
        }
        .btn {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .contact-card {
            height: 100%;
        }
        .contact-card .card-header {
            background: #f8f9fa;
            color: #1e40af;
            font-weight: 600;
            font-size: 1.1rem;
            border-bottom: 2px solid #e5e7eb;
        }
        .financial-value {
            font-family: 'Poppins', monospace;
            font-weight: 500;
        }

        /* Specific icon colors for buttons */
        .btn-outline-success .icon {
            color: #16a34a;
        }
        .btn-outline-success:hover .icon {
            color: #fff;
        }

        .btn-outline-danger .icon {
            color: #dc2626;
        }
        .btn-outline-danger:hover .icon {
            color: #fff;
        }

        .btn-outline-secondary .icon {
            color: #4b5563;
        }
        .btn-outline-secondary:hover .icon {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="bi bi-person-lines-fill me-2 icon"></i>Maklumat Ahli</h4>
                    </div>
                    <div class="card-body">

                        <!-- Bahagian Maklumat Peribadi -->
                        <div class="section">
                            <h5><i class="bi bi-person-badge icon"></i>Maklumat Peribadi</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= htmlspecialchars($data['member']->name ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. IC</th>
                                            <td><?= htmlspecialchars($data['member']->ic_no ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jantina</th>
                                            <td><?= htmlspecialchars($data['member']->gender ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Agama</th>
                                            <td><?= htmlspecialchars($data['member']->religion ?? '-') ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                            <th>Bangsa</th>
                                            <td><?= htmlspecialchars($data['member']->race ?? '-') ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Jawatan</th>
                                            <td><?= htmlspecialchars($data['member']->position ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Gred</th>
                                            <td><?= htmlspecialchars($data['member']->grade ?? '-') ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Add new section for Termination Details -->
                        <div class="section">
                            <h5><i class="bi bi-file-text icon"></i>Maklumat Penamatan</h5>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        <tr>
                                            <th>Sebab Penamatan</th>
                                            <td>
                                                <?php 
                                                    $reasonMap = [
                                                        'pencen' => 'Pencen',
                                                        'pencen awal' => 'Pencen Awal',
                                                        'lain-lain' => 'Lain-lain'
                                                    ];
                                                    echo htmlspecialchars($reasonMap[$data['member']->reason] ?? '-');
                                                    if ($data['member']->reason === 'lain-lain' && !empty($data['member']->reason_details)) {
                                                        echo ': ' . htmlspecialchars($data['member']->reason_details);
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Butiran Lanjut</th>
                                            <td><?= htmlspecialchars($data['member']->reason_details ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tarikh Permohonan</th>
                                            <td><?= $data['member']->created_at ? date('d/m/Y', strtotime($data['member']->created_at)) : '-' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="button" class="btn btn-outline-success me-2" onclick="handleApproveTermination(<?= $data['member']->termination_id ?>)">
                                <i class="bi bi-check-circle icon"></i>Lulus
                            </button>
                            <button type="button" class="btn btn-outline-danger me-2" onclick="showRejectModal(<?= $data['member']->termination_id ?>)">
                                <i class="bi bi-x-circle icon"></i>Tolak
                            </button>
                            <a href="/admins#members-list" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left icon"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add the Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Tolak Permohonan Penamatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="adminRemark" class="form-label">Catatan Admin</label>
                        <textarea class="form-control" id="adminRemark" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="handleRejectTermination()">Hantar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    let currentTerminationId = null;

    function showRejectModal(terminationId) {
        console.log('Opening reject modal for ID:', terminationId);
        currentTerminationId = terminationId;
        const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
        modal.show();
    }

    function handleApproveTermination(terminationId) {
        Swal.fire({
            title: 'Pengesahan',
            text: 'Adakah anda pasti untuk meluluskan permohonan penamatan keahlian ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admins/approve-termination/${terminationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(async response => {
                    const responseText = await response.text();
                    console.log('Raw server response:', responseText);
                    
                    try {
                        const data = JSON.parse(responseText);
                        if (!response.ok) {
                            throw new Error(data.message || 'Network response was not ok');
                        }
                        return data;
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        throw new Error('Invalid response from server');
                    }
                })
                .then(data => {
                    console.log('Success response:', data);
                    if (data.success) {
                        Swal.fire({
                            title: 'Berjaya!',
                            text: data.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/admins#members-list';
                        });
                    } else {
                        throw new Error(data.message || 'Error processing request');
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

    function handleRejectTermination() {
        const remark = document.getElementById('adminRemark').value.trim();
        const terminationId = currentTerminationId;
        
        console.log('Submitting rejection with ID:', terminationId, 'and remark:', remark);
        
        if (!remark) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Sila masukkan catatan penolakan.',
                icon: 'warning'
            });
            return;
        }

        fetch(`/admins/reject-termination/${terminationId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                admin_remark: remark
            })
        })
        .then(async response => {
            const responseText = await response.text();
            console.log('Raw server response:', responseText);
            
            try {
                const data = JSON.parse(responseText);
                if (!response.ok) {
                    throw new Error(data.message || 'Network response was not ok');
                }
                return data;
            } catch (e) {
                console.error('Error parsing response:', e);
                throw new Error('Invalid response from server');
            }
        })
        .then(data => {
            console.log('Success response:', data);
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('rejectModal'));
                modal.hide();
                
                Swal.fire({
                    title: 'Berjaya!',
                    text: data.message,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '/admins#members-list';
                });
            } else {
                throw new Error(data.message || 'Error rejecting request');
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

    // Add this to check if the required libraries are loaded
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 is not loaded');
        }
        if (typeof bootstrap === 'undefined') {
            console.error('Bootstrap is not loaded');
        }
    });
    </script>
</body>
</html>
