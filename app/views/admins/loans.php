<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Permohonan Pinjaman</title>
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
            background: linear-gradient(135deg, #16a34a, #15803d);
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
        .icon {
            margin-right: 0.75rem;
        }
        h5 {
            color: #15803d;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        .contact-card {
            height: 100%;
        }
        .contact-card .card-header {
            background: #f8f9fa;
            color: #15803d;
            font-weight: 600;
            font-size: 1.1rem;
            border-bottom: 2px solid #e5e7eb;
        }
        .financial-value {
            font-family: 'Poppins', monospace;
            font-weight: 500;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
                        <h4><i class="bi bi-person-lines-fill me-2 icon"></i>Maklumat Permohonan Pinjaman</h4>
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
                                            <td><?= htmlspecialchars($data['loan']->name ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. IC</th>
                                            <td><?= htmlspecialchars($data['loan']->no_ic ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jantina</th>
                                            <td><?= htmlspecialchars($data['loan']->sex ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Agama</th>
                                            <td><?= htmlspecialchars($data['loan']->religion ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Warganegara</th>
                                            <td><?= htmlspecialchars($data['loan']->nationality ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tarikh Lahir</th>
                                            <td><?= htmlspecialchars($data['loan']->DOB ?? '-') ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                            <th>No. Ahli</th>
                                            <td><?= htmlspecialchars($data['loan']->memberID ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. PF</th>
                                            <td><?= htmlspecialchars($data['loan']->PFNo ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jawatan</th>
                                            <td><?= htmlspecialchars($data['loan']->position ?? '-') ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bahagian Maklumat Hubungan -->
                        <div class="section">
                            <h5><i class="bi bi-house-door icon"></i>Alamat</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-header">Alamat Rumah</div>
                                        <div class="card-body">
                                            <p><?= htmlspecialchars($data['loan']->add1 ?? '-') ?></p>
                                            <p>Poskod: <?= htmlspecialchars($data['loan']->postcode1 ?? '-') ?><br>Negeri: <?= htmlspecialchars($data['loan']->state1 ?? '-') ?></p>
                                            <p><i class="bi bi-telephone icon"></i><?= htmlspecialchars($data['loan']->pNo ?? '-') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-header">Alamat Pejabat</div>
                                        <div class="card-body">
                                            <p><?= htmlspecialchars($data['loan']->add2 ?? '-') ?></p>
                                            <p>Poskod: <?= htmlspecialchars($data['loan']->postcode2 ?? '-') ?><br>Negeri: <?= htmlspecialchars($data['loan']->state2 ?? '-') ?></p>
                                            <p><i class="bi bi-telephone icon"></i><?= htmlspecialchars($data['loan']->office_pNo ?? '-') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bahagian Maklumat Pinjaman -->
                        <div class="section">
                            <h5><i class="bi bi-cash-stack icon"></i>Maklumat Pinjaman</h5>
                            <table class="table">
                                <tr>
                                    <th>Jenis Pinjaman</th>
                                    <td><?= htmlspecialchars($data['loan']->loan_type ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pinjaman</th>
                                    <td>RM <?= number_format($data['loan']->t_amount ?? 0, 2) ?></td>
                                </tr>
                                <tr>
                                    <th>Tempoh (Bulan)</th>
                                    <td><?= htmlspecialchars($data['loan']->period ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <th>Ansuran Bulanan</th>
                                    <td>RM <?= number_format($data['loan']->mon_installment ?? 0, 2) ?></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Bahagian Maklumat Penjamin -->
                        <div class="section">
                            <h5><i class="bi bi-people icon"></i>Maklumat Penjamin</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Penjamin 1</h6>
                                    <table class="table">
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantor_N ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. IC</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantor_ic ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Telefon</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantor_pNo ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. PF</th>
                                            <td><?= htmlspecialchars($data['loan']->PFNo1 ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Ahli</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantorMemberID ?? '-') ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6>Penjamin 2</h6>
                                    <table class="table">
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantor_N2 ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. IC</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantor_ic2 ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Telefon</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantor_pNo2 ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. PF</th>
                                            <td><?= htmlspecialchars($data['loan']->PFNo2 ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Ahli</th>
                                            <td><?= htmlspecialchars($data['loan']->guarantorMemberID2 ?? '-') ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button class="btn btn-outline-success me-2" onclick="handleApprove(<?= $data['loan']->id ?>)">
                                <i class="bi bi-check-circle icon"></i>Lulus
                            </button>
                            <button class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#rejectModal<?= $data['loan']->id ?>">
                                <i class="bi bi-x-circle icon"></i>Tolak
                            </button>
                            <a href="/admins#loan-applications" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left icon"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal<?= $data['loan']->id ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Permohonan Pinjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Catatan Admin</label>
                        <textarea id="adminRemark<?= $data['loan']->id ?>" class="form-control" rows="3" required 
                            placeholder="Sila masukkan sebab penolakan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="rejectLoan(<?= $data['loan']->id ?>)">Hantar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function handleApprove(loanId) {
        Swal.fire({
            title: 'Pengesahan',
            text: 'Adakah anda pasti untuk meluluskan permohonan pinjaman ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admins/approveLoan/' + loanId)
                    .then(response => {
                        Swal.fire({
                            title: 'Berjaya!',
                            text: 'Permohonan pinjaman telah berjaya diluluskan.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/admins#loan-applications';
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Ralat!',
                            text: 'Ralat semasa meluluskan permohonan.',
                            icon: 'error'
                        }).then(() => {
                            window.location.href = '/admins#loan-applications';
                        });
                    });
            }
        });
    }

    function rejectLoan(loanId) {
        const remark = document.getElementById('adminRemark' + loanId).value;
        
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

        fetch('/admins/rejectLoan/' + loanId, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('rejectModal' + loanId));
                modal.hide();
                Swal.fire({
                    title: 'Berjaya!',
                    text: 'Permohonan pinjaman telah berjaya ditolak.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '/admins#loan-applications';
                });
            } else {
                Swal.fire({
                    title: 'Ralat!',
                    text: data.message || 'Ralat semasa menolak permohonan.',
                    icon: 'error'
                }).then(() => {
                    window.location.href = '/admins#loan-applications';
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
                window.location.href = '/admins#loan-applications';
            });
        });
    }
    </script>
</body>
</html>
