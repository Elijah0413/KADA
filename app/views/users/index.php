<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Lembaga Kemajuan Pertanian Kemubu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Professional color scheme */
        :root {
            --primary-color: #1a5f7a;    /* Professional dark blue */
            --secondary-color: #2c8fb5;  /* Lighter blue */
            --accent-color: #f0b429;     /* Gold accent */
            --text-dark: #2d3748;        /* Dark gray for text */
            --text-light: #718096;       /* Light gray for secondary text */
        }

        /* Enhanced top bar */
        .top-bar {
            background: var(--primary-color);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* Improved logo section */
        .logo-section {
            padding: 1.5rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Enhanced navigation */
        .main-nav {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-bottom: 3px solid var(--secondary-color);
        }

        .nav-link {
            font-weight: 500;
            padding: 1rem 1.5rem !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Enhanced quick links */
        .quick-link-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin: 10px;
            padding: 2rem;
        }

        .quick-link-item i {
            color: var(--secondary-color);
        }

        /* Enhanced cards */
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Enhanced carousel */
        .carousel-caption {
            background: rgba(0,0,0,0.5);
            padding: 2rem;
            border-radius: 8px;
        }

        /* Professional buttons */
        .btn-custom {
            background: var(--secondary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Enhanced section headers */
        .section-header {
            position: relative;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
        }

        .section-header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }

        /* Professional footer */
        footer {
            background: var(--primary-color);
        }

        .social-links a {
            background: rgba(255,255,255,0.1);
            padding: 0.5rem;
            border-radius: 50%;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="/login" class="text-white text-decoration-none me-3">
                        <i class="fas fa-sign-in-alt"></i> Log in
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fas fa-universal-access"></i> Accessibility
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <select class="bg-dark text-white border-0">
                        <option>ENGLISH</option>
                        <option>BAHASA MELAYU</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo Section -->
    <div class="logo-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="/images/logo.jpg" alt="KADA Logo" class="img-fluid" style="max-height: 80px; width: auto;">
                    <span class="h3 ms-3">Lembaga Kemajuan Pertanian Kemubu</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light main-nav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#">HOME</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/info">INFO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">MEMBER</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/register">Registration</a></li>
                            <li><a class="dropdown-item" href="#">Status Dashboard</a></li>
                            <li><a class="dropdown-item" href="#">My Saving Account</a></li>
                            <li><a class="dropdown-item" href="#">Financial Report</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">LOAN</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/loantype">Loan Types</a></li>
                            <li><a class="dropdown-item" href="/loanCalculator">Loan Calculator</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">PROGRAM</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/program">Available Programs</a></li>
                            <li><a class="dropdown-item" href="#">Apply for Program</a></li>
    
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CUSTOMER SERVICE</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Quick Links -->
    <div class="quick-links">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="quick-link-item">
                        <a href="/faqList" <i class="fas fa-question-circle"></i></a>
                        <h5 class="mt-3">FAQ</h5>
                        <p>Common Questions</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quick-link-item">
                        <i class="fas fa-phone"></i>
                        <h5 class="mt-3">Contact Us</h5>
                        <p>Get in Touch</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quick-link-item">
                        <i class="fas fa-file-alt"></i>
                        <h5 class="mt-3">Applications</h5>
                        <p>Forms & Status</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quick-link-item">
                        <i class="fas fa-sitemap"></i>
                        <h5 class="mt-3">Site Map</h5>
                        <p>Website Guide</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section with Carousel -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/program1.jpg" class="d-block w-100" alt="Agricultural Support" 
                     style="height: 400px; object-fit: cover; filter: brightness(0.8);">
                <div class="carousel-caption">
                    <h2 class="display-4 fw-bold">Empowering Agricultural Communities</h2>
                    <p class="lead">Supporting farmers with innovative financial solutions and development programs</p>
                    <a href="#" class="btn btn-custom btn-lg mt-3">Learn More</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/program2.jpg" class="d-block w-100" alt="Loan Programs" 
                style="height: 400px; object-fit: cover; filter: brightness(0.8);">
                <div class="carousel-caption">
                    <h2 class="display-4 fw-bold">Flexible Loan Programs</h2>
                    <p class="lead">Access affordable financing for your agricultural ventures</p>
                    <a href="#" class="btn btn-custom btn-lg mt-3">Learn More</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Latest News Section -->
    <section class="latest-news py-5">
        <div class="container">
            <h2 class="text-center section-header">Latest News & Announcements</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Loan Scheme for Paddy Farmers</h5>
                            <p class="card-text">Special financing package with reduced interest rates for paddy farmers...</p>
                            <small class="text-muted">Posted on: 15 Dec 2023</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agricultural Training Program</h5>
                            <p class="card-text">Free training sessions on modern farming techniques starting next month...</p>
                            <small class="text-muted">Posted on: 14 Dec 2023</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Member Benefits Update</h5>
                            <p class="card-text">New benefits added for premium members including insurance coverage...</p>
                            <small class="text-muted">Posted on: 13 Dec 2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Programs -->
    <section class="featured-programs py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-header">Our Featured Programs</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <h5 class="card-title">
                                <i class="fas fa-hand-holding-usd text-success me-2"></i>
                                Agricultural Loans
                            </h5>
                            <ul class="list-unstyled">
                                <li>✓ Competitive interest rates</li>
                                <li>✓ Flexible repayment terms</li>
                                <li>✓ Quick approval process</li>
                                <li>✓ No collateral for small loans</li>
                            </ul>
                            <a href="#" class="btn btn-custom mt-3">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-graduation-cap text-success"></i> Training Programs</h5>
                            <ul class="list-unstyled">
                                <li>✓ Modern farming techniques</li>
                                <li>✓ Financial management</li>
                                <li>✓ Agricultural technology</li>
                                <li>✓ Marketing strategies</li>
                            </ul>
                            <a href="#" class="btn btn-success">View Programs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Benefits -->
    <section class="membership-benefits py-5">
        <div class="container">
            <h2 class="text-center mb-4">Membership Benefits</h2>
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-percentage fa-3x text-success mb-3"></i>
                    <h5>Special Interest Rates</h5>
                    <p>Exclusive rates for members on all loan products</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-user-shield fa-3x text-success mb-3"></i>
                    <h5>Insurance Coverage</h5>
                    <p>Agricultural insurance at preferential rates</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-chalkboard-teacher fa-3x text-success mb-3"></i>
                    <h5>Free Training</h5>
                    <p>Access to workshops and training sessions</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-handshake fa-3x text-success mb-3"></i>
                    <h5>Network Access</h5>
                    <p>Connect with other agricultural professionals</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <address>
                        Lembaga Kemajuan Pertanian Kemubu<br>
                        123 Agriculture Street<br>
                        Kelantan, Malaysia<br>
                        <i class="fas fa-phone"></i> +60 1234567890<br>
                        <i class="fas fa-envelope"></i> info@kada.gov.my
                    </address>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">About Us</a></li>
                        <li><a href="#" class="text-light">Member Login</a></li>
                        <li><a href="#" class="text-light">Programs</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="social-links">
                        <a href="#" class="text-light me-2"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-light me-2"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-light me-2"><i class="fab fa-instagram fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <small>&copy; 2023 Lembaga Kemajuan Pertanian Kemubu. All rights reserved.</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>