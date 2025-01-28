<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Ahli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                            <th>Status</th>
                                            <td><?= htmlspecialchars($data['member']->marital_status ?? '-') ?></td>
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

                        <!-- Bahagian Maklumat Hubungan -->
                        <div class="section">
                            <h5><i class="bi bi-house-door icon"></i>Maklumat Hubungan</h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card contact-card">
                                        <div class="card-header">
                                            <i class="bi bi-house-door icon"></i>Alamat Rumah
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-3"><?= htmlspecialchars($data['member']->home_address ?? '-') ?></p>
                                            <p class="mb-3">
                                                <span class="text-muted">Poskod:</span> <?= htmlspecialchars($data['member']->home_postcode ?? '-') ?>
                                                <br>
                                                <span class="text-muted">Negeri:</span> <?= htmlspecialchars($data['member']->home_state ?? '-') ?>
                                            </p>
                                            <p class="mb-0"><i class="bi bi-telephone icon"></i><?= htmlspecialchars($data['member']->home_phone ?? '-') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card contact-card">
                                        <div class="card-header">
                                            <i class="bi bi-house-door icon"></i>Alamat Pejabat
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-3"><?= htmlspecialchars($data['member']->office_address ?? '-') ?></p>
                                            <p class="mb-3">
                                                <span class="text-muted">Poskod:</span> <?= htmlspecialchars($data['member']->office_postcode ?? '-') ?>
                                                <br>
                                                <span class="text-muted">Negeri:</span> <?= htmlspecialchars($data['member']->office_state ?? '-') ?>
                                            </p>
                                            <p class="mb-0"><i class="bi bi-telephone icon"></i><?= htmlspecialchars($data['member']->office_phone ?? '-') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bahagian Maklumat Kewangan -->
                        <div class="section">
                            <h5><i class="bi bi-cash-stack icon"></i>Maklumat Kewangan</h5>
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Gaji Bulanan</th>
                                            <td class="text-success financial-value">RM <?= number_format($data['member']->monthly_salary ?? 0, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Yuran Pendaftaran</th>
                                            <td>RM <?= number_format($data['member']->registration_fee ?? 0, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Modal Saham</th>
                                            <td>RM <?= number_format($data['member']->share_capital ?? 0, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Modal Yuran</th>
                                            <td>RM <?= number_format($data['member']->fee_capital ?? 0, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tabung Simpanan</th>
                                            <td>RM <?= number_format($data['member']->deposit_funds ?? 0, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tabung Kebajikan</th>
                                            <td>RM <?= number_format($data['member']->welfare_fund ?? 0, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deposit Tetap</th>
                                            <td>RM <?= number_format($data['member']->fixed_deposit ?? 0, 2) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bahagian Maklumat Keluarga -->
                        <div class="section">
                            <h5><i class="bi bi-people icon"></i>Maklumat Keluarga</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>No. Kad Pengenalan</th>
                                                    <th>Hubungan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($data['member']->family_members) && !empty($data['member']->family_members)): ?>
                                                    <?php foreach ($data['member']->family_members as $family): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($family->name) ?></td>
                                                            <td><?= htmlspecialchars($family->ic_no) ?></td>
                                                            <td>
                                                                <?php
                                                                $relationships = [
                                                                    'Spouse' => 'Pasangan',
                                                                    'Child' => 'Anak',
                                                                    'Parent' => 'Ibu/Bapa',
                                                                    'Sibling' => 'Adik-beradik'
                                                                ];
                                                                echo isset($relationships[$family->relationship]) 
                                                                    ? $relationships[$family->relationship] 
                                                                    : htmlspecialchars($family->relationship);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center">Tiada maklumat ahli keluarga</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button class="btn btn-outline-success me-2" onclick="handleApprove(<?= $data['member']->id ?>)">
                                <i class="bi bi-check-circle icon"></i>Lulus
                            </button>
                            <button class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#rejectModal<?= $data['member']->id ?>">
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

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal<?= $data['member']->id ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Permohonan Keahlian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Catatan Admin</label>
                        <textarea id="memberAdminRemark<?= $data['member']->id ?>" class="form-control" rows="3" required 
                            placeholder="Sila masukkan sebab penolakan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="rejectMember(<?= $data['member']->id ?>)">Hantar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function handleApprove(memberId) {
        Swal.fire({
            title: 'Pengesahan',
            text: 'Adakah anda pasti untuk meluluskan permohonan keahlian ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admins/approve/' + memberId)
                    .then(response => {
                        Swal.fire({
                            title: 'Berjaya!',
                            text: 'Permohonan keahlian telah berjaya diluluskan.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/admins#members-list';
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Ralat!',
                            text: 'Ralat semasa meluluskan permohonan.',
                            icon: 'error'
                        }).then(() => {
                            window.location.href = '/admins#members-list';
                        });
                    });
            }
        });
    }

    function rejectMember(memberId) {
        const remark = document.getElementById('memberAdminRemark' + memberId).value;
        
        if (!remark.trim()) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Sila masukkan catatan penolakan.',
                icon: 'warning'
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
                const modal = bootstrap.Modal.getInstance(document.getElementById('rejectModal' + memberId));
                modal.hide();
                Swal.fire({
                    title: 'Berjaya!',
                    text: 'Permohonan keahlian telah berjaya ditolak.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '/admins#members-list';
                });
            } else {
                Swal.fire({
                    title: 'Ralat!',
                    text: data.message || 'Ralat semasa menolak permohonan.',
                    icon: 'error'
                }).then(() => {
                    window.location.href = '/admins#members-list';
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Ralat!',
                text: 'Ralat semasa menolak permohonan.',
                icon: 'error'
            }).then(() => {
                window.location.href = '/admins#members-list';
            });
        });
    }
    </script>
</body>
</html>
