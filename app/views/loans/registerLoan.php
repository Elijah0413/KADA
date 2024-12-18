<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application - KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-page { display: none; }
        .form-page.active { display: block; }
        #termsModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Loan Application Form</h2>
                    </div>
                    <div class="card-body">
                        <form id="loanForm" action="/storeLoan" method="POST">
                            <!-- Page 1: Personal Information -->
                            <div class="form-page active">
                                <h4 class="mb-3">Personal Information</h4>
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" id="full_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mykad_no" class="form-label">MyKad Number</label>
                                    <input type="text" class="form-control" name="mykad_no" id="mykad_no" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mobile_phone" class="form-label">Mobile Phone</label>
                                    <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="financing_amount" class="form-label">Financing Amount</label>
                                    <input type="number" step="0.01" class="form-control" name="financing_amount" id="financing_amount" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loan_purpose" class="form-label">Loan Purpose</label>
                                    <input type="text" class="form-control" name="loan_purpose" id="loan_purpose" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ic_number" class="form-label">IC Number</label>
                                    <input type="text" class="form-control" name="ic_number" id="ic_number" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the terms and conditions
                                    </label>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                    <a href="/" class="btn btn-secondary">Cancel</a>
                                </div>
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

        const nextButtons = document.querySelectorAll('.next');
        const prevButtons = document.querySelectorAll('.prev');
        const pages = document.querySelectorAll('.form-page');
        let currentPage = 0;

        function showPage(index) {
            pages.forEach((page, i) => {
                page.classList.toggle('active', i === index);
            });
        }

        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (currentPage < pages.length - 1) {
                    currentPage++;
                    showPage(currentPage);
                }
            });
        });

        prevButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (currentPage > 0) {
                    currentPage--;
                    showPage(currentPage);
                }
            });
        });

        document.querySelector('form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                const response = await fetch('/storeLoan', { // Updated endpoint
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

   
    </div>

    <script>
        const termsBtn = document.getElementById('termsBtn');
        const termsModal = document.getElementById('termsModal');
        const closeBtn = document.getElementById('closeBtn');
        const agreeBtn = document.getElementById('agreeBtn');

        termsBtn.onclick = function() {
            termsModal.style.display = "block";
        }

        closeBtn.onclick = function() {
            termsModal.style.display = "none";
        }

        agreeBtn.onclick = function() {
            alert("Thank you for agreeing to the terms and conditions.");
            termsModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == termsModal) {
                termsModal.style.display = "none";
            }
        }
    </script>
</body>
</html>