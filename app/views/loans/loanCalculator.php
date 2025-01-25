<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }
        .card-body {
            padding: 2rem;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            padding: 0.75rem;
            border-radius: 8px;
        }
        .btn-primary {
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
        }
        .calculation-results {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e9ecef;
        }
        .alert {
            border-radius: 10px;
            padding: 1.5rem;
        }
        .table {
            margin-top: 2rem;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0 text-center">Loan Calculator</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="loan_amount" class="form-label">Loan Amount (RM)</label>
                                    <input type="number" class="form-control" id="loan_amount" name="loan_amount" required step="500" min="500" placeholder="e.g. 10000">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="interest_rate" class="form-label">Interest Rate (%)</label>
                                    <input type="number" class="form-control" id="interest_rate" name="interest_rate" required step="0.01" min="0" placeholder="e.g. 3.0">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="loan_term" class="form-label">Loan Term (Years)</label>
                                    <input type="number" class="form-control" id="loan_term" name="loan_term" required min="1" placeholder="e.g. 5">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Calculate Loan</button>
                            </div>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Get form inputs
                            $loan_amount = floatval($_POST['loan_amount']);
                            $interest_rate = floatval($_POST['interest_rate']);
                            $loan_term = intval($_POST['loan_term']);
                            
                            // Calculate using flat rate method
                            $total_profit = $loan_amount * ($interest_rate / 100) * $loan_term;
                            $total_repayment = $loan_amount + $total_profit;
                            $monthly_repayment = $total_repayment / ($loan_term * 12);
                        
                            // Round to 2 decimal places for currency
                            $monthly_repayment = round($monthly_repayment, 2);

                            // Display the summary results
                            echo '<div class="calculation-results">
                                    <div class="alert alert-success">
                                        <h4 class="alert-heading mb-4">Calculation Results</h4>
                                        <div class="row g-4">
                                            <div class="col-sm-6">
                                                <p class="mb-2"><strong>Loan Amount:</strong><br>
                                                <span class="fs-5">RM ' . number_format($loan_amount, 2) . '</span></p>
                                                <p class="mb-2"><strong>Interest Rate:</strong><br>
                                                <span class="fs-5">' . $interest_rate . '%</span></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-2"><strong>Loan Term:</strong><br>
                                                <span class="fs-5">' . $loan_term . ' years</span></p>
                                                <p class="mb-2"><strong>Monthly Repayment:</strong><br>
                                                <span class="fs-5 text-primary">RM ' . number_format($monthly_repayment, 2) . '</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center">Year</th>
                                                    <th class="text-center">Principal Paid</th>
                                                    <th class="text-center">Interest Paid</th>
                                                    <th class="text-center">Remaining Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                            
                            // For the amortization table
    $balance = $loan_amount;
    $annual_principal = 0;
    $annual_interest = 0;
    
    // Calculate yearly amortization
    for ($year = 1; $year <= $loan_term; $year++) {
        $annual_principal = 0;
        $annual_interest = 0;
        
        // Calculate monthly payments for each year
        for ($month = 1; $month <= 12; $month++) {
            // Monthly interest is total profit divided by total months
            $interest_payment = $total_profit / ($loan_term * 12);
            $principal_payment = $monthly_repayment - $interest_payment;
            
            $annual_principal += $principal_payment;
            $annual_interest += $interest_payment;
            $balance -= $principal_payment;
        }
        
        echo '<tr>
                <td>' . $year . '</td>
                <td>RM ' . number_format($annual_principal, 2) . '</td>
                <td>RM ' . number_format($annual_interest, 2) . '</td>
                <td>RM ' . number_format(max(0, $balance), 2) . '</td>
              </tr>';
    }
                            
                            echo '</tbody>
                                </table>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
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
    </script>
</body>
</html>