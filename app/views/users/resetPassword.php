<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tetapkan Semula Kata Laluan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2E7D32;    /* Dark green */
            --secondary-color: #4CAF50;  /* Medium green */
            --accent-color: #81C784;     /* Light green */
            --text-dark: #1B5E20;        /* Dark green text */
            --text-light: #E8F5E9;       /* Light green text */
            --background-overlay: rgba(255, 255, 255, 0.95); /* Light overlay */
        }

        body {
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 500px;
            width: 100%;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--background-overlay);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
        }

        .logo-container img {
            max-width: 100px;
            height: auto;
            margin-bottom: 0.5rem;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 0.9rem;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 1rem;
        }

        .form-section {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        .form-control {
            padding: 12px;
            font-size: 1.1rem;
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .btn-custom:hover {
            background-color: var(--text-dark);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .form-label {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .password-requirements {
            margin-top: 0.5rem;
        }

        .password-requirements ul {
            list-style: none;
            padding-left: 0;
            margin-top: 8px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .password-requirements li {
            font-size: 0.85rem;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 4px;
            margin: 0;
        }
        
        .requirement-met {
            color: var(--primary-color) !important;
            background-color: rgba(46, 125, 50, 0.08);
        }
        
        .requirement-met::before {
            content: '✓';
            font-weight: bold;
            color: var(--primary-color);
            font-size: 0.9rem;
        }
        
        .requirement-not-met::before {
            content: '○';
            color: #6c757d;
            font-size: 0.9rem;
        }

        .password-requirements small {
            color: #666;
            font-size: 0.8rem;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            color: #666;
            padding: 4px;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="/images/logo.jpg" alt="Logo" class="img-fluid">
            <h1 class="page-title">Tetapkan Semula Kata Laluan</h1>
            <p class="subtitle">Sila masukkan kata laluan baharu anda.</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="form-section">
            <form action="/handle-reset-password" method="POST">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Laluan Baharu</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Masukkan kata laluan baharu" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <div class="password-requirements mt-2">
                        <small>Keperluan kata laluan:</small>
                        <ul class="mb-0">
                            <li id="length-check">Min. 6 aksara</li>
                            <li id="uppercase-check">1 huruf besar</li>
                            <li id="lowercase-check">1 huruf kecil</li>
                            <li id="symbol-check">1 simbol (!@#$%&*)</li>
                        </ul>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Sahkan Kata Laluan Baharu</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                               placeholder="Masukkan semula kata laluan baharu" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-custom w-100">Tetapkan Semula Kata Laluan</button>
                <div class="mt-3 text-center">
                    <a href="/userlogin">Kembali ke Log Masuk</a>
                </div>
                <div class="text-center mt-2">
                    <a href="/" style="font-size: 24px; color: #666;">
                        <i class="bi bi-arrow-left-circle"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const passwordInput = document.getElementById('password');
            const lengthCheck = document.getElementById('length-check');
            const uppercaseCheck = document.getElementById('uppercase-check');
            const lowercaseCheck = document.getElementById('lowercase-check');
            const symbolCheck = document.getElementById('symbol-check');
            
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                
                // Check length
                updateRequirement(lengthCheck, password.length >= 6);
                
                // Check uppercase
                updateRequirement(uppercaseCheck, /[A-Z]/.test(password));
                
                // Check lowercase
                updateRequirement(lowercaseCheck, /[a-z]/.test(password));
                
                // Check symbol
                updateRequirement(symbolCheck, /[!@#$%^&*(),.?":{}|<>]/.test(password));
            });

            function updateRequirement(element, isMet) {
                if (isMet) {
                    element.classList.add('requirement-met');
                    element.classList.remove('requirement-not-met');
                } else {
                    element.classList.remove('requirement-met');
                    element.classList.add('requirement-not-met');
                }
            }
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const password = passwordInput.value;
                const confirmPassword = document.getElementById('confirm_password').value;
                
                if (password.length < 6) {
                    alert('Kata laluan mestilah sekurang-kurangnya 6 aksara');
                    return;
                }
                
                if (!/[A-Z]/.test(password)) {
                    alert('Kata laluan mesti mengandungi huruf besar');
                    return;
                }
                
                if (!/[a-z]/.test(password)) {
                    alert('Kata laluan mesti mengandungi huruf kecil');
                    return;
                }
                
                if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                    alert('Kata laluan mesti mengandungi simbol');
                    return;
                }
                
                if (password !== confirmPassword) {
                    alert('Kata laluan tidak sepadan');
                    return;
                }
                
                this.submit();
            });
        });

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>