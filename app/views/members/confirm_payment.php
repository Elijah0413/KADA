<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengesahan Pembayaran - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .transaction-card {
            max-width: 600px;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .transaction-header {
            background: linear-gradient(135deg, #F8B195, #F67280);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
            text-align: center;
        }
        .transaction-body {
            padding: 2rem;
            background: white;
        }
        .transaction-detail {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            color: #666;
            font-weight: 500;
        }
        .detail-value {
            font-weight: 600;
            text-align: right;
        }
        .payment-method {
            margin: 2rem 0;
        }
        .payment-option {
            padding: 1rem;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .payment-option:hover {
            background: #f8f9fa;
        }
        .payment-details {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 1rem;
        }
        .countdown {
            font-size: 1.5rem;
            font-weight: bold;
            color: #F67280;
        }
        .transaction-details {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
        }
        .section-title {
            color: #333;
            font-weight: 600;
        }
        .fee-section {
            margin-top: 1.5rem;
        }
        .total-section {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid #eee;
        }
        .text-primary {
            color: #0d6efd !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="transaction-card">
            <div class="transaction-header">
                <h4 class="mb-0">Pengesahan Pembayaran</h4>
            </div>
            <div class="transaction-body">
                <!-- Payment Summary -->
                <div class="transaction-details">
                    <?php 
                    $account_status = isset($savings_account['status']) ? $savings_account['status'] : 'pending';
                    ?>

                    <?php if ($account_status === 'pending'): ?>
                        <!-- One-time Fees -->
                        <?php if ($pending_member['registration_fee'] > 0): ?>
                        <div class="transaction-detail">
                            <span class="detail-label">Yuran Pendaftaran</span>
                            <span class="detail-value">RM <?= number_format($pending_member['registration_fee'], 2) ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="transaction-detail">
                            <span class="detail-label">Modal Saham</span>
                            <span class="detail-value">RM <?= number_format($pending_member['share_capital'], 2) ?></span>
                        </div>
                        
                        <div class="transaction-detail">
                            <span class="detail-label">Modal Deposit</span>
                            <span class="detail-value">RM <?= number_format($pending_member['deposit_funds'], 2) ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Monthly Fees Section -->
                    <?php if ($account_status === 'complete'): ?>
                        <h6 class="mb-3">Yuran Bulanan</h6>
                    <?php endif; ?>
                    
                    <div class="transaction-detail">
                        <span class="detail-label">Modal Yuran</span>
                        <span class="detail-value">RM <?= number_format($pending_member['fee_capital'], 2) ?></span>
                    </div>
                    
                    <div class="transaction-detail">
                        <span class="detail-label">Tabung Kebajikan</span>
                        <span class="detail-value">RM <?= number_format($pending_member['welfare_fund'], 2) ?></span>
                    </div>
                    
                    <div class="transaction-detail">
                        <span class="detail-label">Simpanan Tetap</span>
                        <span class="detail-value">RM <?= number_format($pending_member['fixed_deposit'], 2) ?></span>
                    </div>

                    <!-- Total Section -->
                    <div class="total-section mt-4 border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Jumlah Bayaran</h5>
                            <h5 class="mb-0 text-primary">RM <?= number_format($total_amount, 2) ?></h5>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <form id="paymentForm" action="<?= BASEURL ?>/members/process_payment" method="POST">
                    <div class="payment-method">
                        <h6 class="text-muted mb-3">Kaedah Pembayaran</h6>
                        <div class="payment-options">
                            <div class="payment-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="cardPayment" value="card" checked>
                                    <label class="form-check-label" for="cardPayment">
                                        Kad Kredit/Debit
                                    </label>
                                </div>
                            </div>
                            <div class="payment-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="bankingPayment" value="banking">
                                    <label class="form-check-label" for="bankingPayment">
                                        Perbankan Dalam Talian
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Card Payment Details -->
                        <div id="cardDetails" class="payment-details">
                            <div class="row g-3">
                                <div class="col-12">
                                    <select class="form-select" name="cardType" required>
                                        <option value="">Pilih Jenis Kad</option>
                                        <option value="visa">Visa</option>
                                        <option value="mastercard">Mastercard</option>
                                        <option value="amex">American Express</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="cardNumber" placeholder="Nombor Kad" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="expiryDate" placeholder="MM/YY" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="cvv" placeholder="CVV" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="cardHolder" placeholder="Nama Pemegang Kad" required>
                                </div>
                            </div>
                        </div>

                        <!-- Online Banking Details -->
                        <div id="bankingDetails" class="payment-details" style="display: none;">
                            <div class="row g-3">
                                <div class="col-12">
                                    <select class="form-select" name="bankType">
                                        <option value="">Pilih Bank</option>
                                        <option value="maybank">Maybank</option>
                                        <option value="cimb">CIMB Bank</option>
                                        <option value="rhb">RHB Bank</option>
                                        <option value="publicbank">Public Bank</option>
                                        <option value="bankislam">Bank Islam</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="accountNumber" placeholder="Nombor Akaun">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add CSRF token -->
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    
                    <!-- Add hidden fields for amounts -->
                    <input type="hidden" name="total_amount" value="<?= $total_amount ?>">
                    <input type="hidden" name="deposit_amount" value="<?= $pending_member['deposit_funds'] + $pending_member['fixed_deposit'] ?>">

                    <div class="d-grid gap-3 mt-4">
                        <button type="submit" class="btn btn-primary w-100" id="confirmPaymentBtn">
                            <i class="fas fa-check-circle me-2"></i>Sahkan Pembayaran
                        </button>
                        <a href="<?= BASEURL ?>/members/saving_acc" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-times-circle me-2"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <i class="fas fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                    <h5 class="mb-3">Pembayaran Berjaya!</h5>
                    <p>Pembayaran anda telah berjaya diproses.</p>
                    <a href="<?= BASEURL ?>/members/saving_acc" class="btn btn-primary mt-3">
                        Kembali ke Akaun Simpanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('paymentForm');
        const cardDetails = document.getElementById('cardDetails');
        const bankingDetails = document.getElementById('bankingDetails');
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        
        // Toggle payment details
        document.querySelectorAll('input[name="paymentMethod"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'card') {
                    cardDetails.style.display = 'block';
                    bankingDetails.style.display = 'none';
                    // Update required attributes
                    setCardFieldsRequired(true);
                    setBankFieldsRequired(false);
                } else {
                    cardDetails.style.display = 'none';
                    bankingDetails.style.display = 'block';
                    // Update required attributes
                    setCardFieldsRequired(false);
                    setBankFieldsRequired(true);
                }
            });
        });

        function setCardFieldsRequired(required) {
            cardDetails.querySelectorAll('input, select').forEach(field => {
                field.required = required;
            });
        }

        function setBankFieldsRequired(required) {
            bankingDetails.querySelectorAll('input, select').forEach(field => {
                field.required = required;
            });
        }

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successModal.show();
                } else {
                    alert('Pembayaran gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ralat semasa pemprosesan pembayaran');
            });
        });
    });
    </script>
</body>
</html>