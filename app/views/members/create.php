<?php
// Generate CSRF token if not exists
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Profile</h2>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="/members/store" method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <!-- Personal Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" 
                                value="<?php echo isset($member->full_name) ? htmlspecialchars($member->full_name) : ''; ?>" 
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">IC Number</label>
                            <input type="text" class="form-control" name="ic_number" 
                                value="<?php echo isset($member->ic_number) ? htmlspecialchars($member->ic_number) : ''; ?>" 
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" 
                                value="<?php echo isset($member->date_of_birth) ? htmlspecialchars($member->date_of_birth) : ''; ?>" 
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-select" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" <?php echo (isset($member->gender) && $member->gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo (isset($member->gender) && $member->gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Race</label>
                            <select class="form-select" name="race" required>
                                <option value="">Select Race</option>
                                <option value="Malay" <?php echo (isset($member->race) && $member->race === 'Malay') ? 'selected' : ''; ?>>Malay</option>
                                <option value="Chinese" <?php echo (isset($member->race) && $member->race === 'Chinese') ? 'selected' : ''; ?>>Chinese</option>
                                <option value="Indian" <?php echo (isset($member->race) && $member->race === 'Indian') ? 'selected' : ''; ?>>Indian</option>
                                <option value="Others" <?php echo (isset($member->race) && $member->race === 'Others') ? 'selected' : ''; ?>>Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Marital Status</label>
                            <select class="form-select" name="marital_status" required>
                                <option value="">Select Status</option>
                                <option value="Single" <?php echo (isset($member->marital_status) && $member->marital_status === 'Single') ? 'selected' : ''; ?>>Single</option>
                                <option value="Married" <?php echo (isset($member->marital_status) && $member->marital_status === 'Married') ? 'selected' : ''; ?>>Married</option>
                                <option value="Divorced" <?php echo (isset($member->marital_status) && $member->marital_status === 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                <option value="Widowed" <?php echo (isset($member->marital_status) && $member->marital_status === 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Employment Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Occupation</label>
                            <input type="text" class="form-control" name="occupation" 
                                value="<?php echo isset($member->occupation) ? htmlspecialchars($member->occupation) : ''; ?>" 
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" class="form-control" name="department" 
                                value="<?php echo isset($member->department) ? htmlspecialchars($member->department) : ''; ?>" 
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Position</label>
                            <input type="text" class="form-control" name="position" 
                                value="<?php echo isset($member->position) ? htmlspecialchars($member->position) : ''; ?>" 
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Employment Date</label>
                            <input type="date" class="form-control" name="employment_date" 
                                value="<?php echo isset($member->employment_date) ? htmlspecialchars($member->employment_date) : ''; ?>" 
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Monthly Salary (RM)</label>
                            <input type="number" class="form-control" name="monthly_salary" 
                                value="<?php echo isset($member->monthly_salary) ? htmlspecialchars($member->monthly_salary) : ''; ?>" 
                                required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Contact Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Home Address</label>
                            <textarea class="form-control" name="home_address" required><?php echo isset($member->home_address) ? htmlspecialchars($member->home_address) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Postcode</label>
                            <input type="text" class="form-control" name="postcode" 
                                value="<?php echo isset($member->postcode) ? htmlspecialchars($member->postcode) : ''; ?>" 
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" name="state" 
                                value="<?php echo isset($member->state) ? htmlspecialchars($member->state) : ''; ?>" 
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone_no" 
                                value="<?php echo isset($member->phone_no) ? htmlspecialchars($member->phone_no) : ''; ?>" 
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" 
                                value="<?php echo isset($member->email) ? htmlspecialchars($member->email) : ''; ?>" 
                                required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">Save Profile</button>
                <a href="/members/profile" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>