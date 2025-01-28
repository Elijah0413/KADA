<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">KADA Membership Registration</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php 
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                Member with this IC number already exists in the system.
                                <div class="mt-2">
                                    <a href="/register" class="btn btn-danger">Try Again</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="/store" method="POST">
                            <!-- Personal Information -->
                            <h4 class="mb-3">Personal Information</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="ic_number" class="form-label">IC Number</label>
                                    <input type="text" class="form-control" name="ic_number" id="ic_number" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="marital_status" class="form-label">Marital Status</label>
                                    <select class="form-select" name="marital_status" id="marital_status" required>
                                        <option value="">Select Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="monthly_salary" class="form-label">Monthly Salary (RM)</label>
                                    <input type="number" step="0.01" class="form-control" name="monthly_salary" id="monthly_salary" required>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone_number" id="phone_number" required>
                                </div>
                            </div>

                            <!-- Home Address -->
                            <h4 class="mb-3">Home Address</h4>
                            <div class="mb-3">
                                <label for="home_address" class="form-label">Address</label>
                                <textarea class="form-control" name="home_address" id="home_address" rows="2" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="postcode" class="form-label">Postcode</label>
                                    <input type="text" class="form-control" name="postcode" id="postcode" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" name="state" id="state" required>
                                        <option value="">Select State</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Pulau Pinang">Pulau Pinang</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Work Information -->
                            <h4 class="mb-3">Work Information</h4>
                            <div class="mb-3">
                                <label for="post_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" name="post_title" id="post_title">
                            </div>

                            <div class="mb-3">
                                <label for="working_address" class="form-label">Work Address</label>
                                <textarea class="form-control" name="working_address" id="working_address" rows="2"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="working_postcode" class="form-label">Work Postcode</label>
                                <input type="text" class="form-control" name="working_postcode" id="working_postcode">
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the terms and conditions
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Submit Registration</button>
                                <a href="/" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto close alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        document.querySelector('form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                const response = await fetch('/store', {
                    method: 'POST',
                    body: formData
                });
                
                if (response.ok) {
                    // Show success modal
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    successModal.show();
                    
                    setTimeout(() => {
                        this.submit();
                    }, 1000);
                } else {
                    // Show error modal
                    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    errorModal.show();
                }
            } catch (error) {
                console.error('Error:', error);
                // Show error modal
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                errorModal.show();
            }
        });
    </script>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                </div>
                <div class="modal-body">
                    Your membership registration has been submitted successfully!
                </div>
                <div class="modal-footer">
                    <a href="/" class="btn btn-primary">Return to Homepage</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Registration Failed</h5>
                </div>
                <div class="modal-body">
                    Member with this IC number already exists in the system.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.reload()">Try Again</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>