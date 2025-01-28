<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Loan Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Confirm Loan Application Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            Please review your loan application details carefully before submitting.
                        </div>

                        <form action="/storeLoan" method="POST">
                            <!-- Hidden fields to store all the form data -->
                            <?php foreach ($formData as $key => $value): ?>
                                <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                            <?php endforeach; ?>

                            <!-- Display the information for review -->
                            <div class="row mb-4">
                                <h4 class="mb-3">Loan Details</h4>
                                <div class="col-md-6">
                                    <p><strong>Loan Type:</strong> <?= htmlspecialchars($formData['loan_type']) ?></p>
                                    <p><strong>Loan Amount:</strong> RM <?= number_format($formData['loan_amount'], 2) ?></p>
                                    <p><strong>Loan Period:</strong> <?= htmlspecialchars($formData['loan_period']) ?> months</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Monthly Installments:</strong> RM <?= number_format($formData['monthly_installments'], 2) ?></p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <h4 class="mb-3">Personal Information</h4>
                                <div class="col-md-6">
                                    <p><strong>Full Name:</strong> <?= htmlspecialchars($formData['full_name']) ?></p>
                                    <p><strong>ID Number:</strong> <?= htmlspecialchars($formData['id_number']) ?></p>
                                    <p><strong>Date of Birth:</strong> <?= htmlspecialchars($formData['date_of_birth']) ?></p>
                                    <p><strong>Age:</strong> <?= htmlspecialchars($formData['age']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Home Address:</strong> <?= nl2br(htmlspecialchars($formData['home_address'])) ?></p>
                                    <p><strong>Monthly Salary:</strong> RM <?= number_format($formData['monthly_salary'], 2) ?></p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <h4 class="mb-3">Guarantor Information</h4>
                                <div class="col-md-6">
                                    <h5>Guarantor 1</h5>
                                    <p><strong>Name:</strong> <?= htmlspecialchars($formData['guarantor1_name']) ?></p>
                                    <p><strong>ID:</strong> <?= htmlspecialchars($formData['guarantor1_id']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Guarantor 2</h5>
                                    <p><strong>Name:</strong> <?= htmlspecialchars($formData['guarantor2_name']) ?></p>
                                    <p><strong>ID:</strong> <?= htmlspecialchars($formData['guarantor2_id']) ?></p>
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="confirmCheck" required>
                                <label class="form-check-label" for="confirmCheck">
                                    I confirm that all the information provided above is correct and true.
                                </label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="javascript:history.back()" class="btn btn-secondary">Back to Edit</a>
                                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                    Confirm and Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable/disable submit button based on checkbox
        document.getElementById('confirmCheck').addEventListener('change', function() {
            document.getElementById('submitBtn').disabled = !this.checked;
        });
    </script>
</body>
</html> 