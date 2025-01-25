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
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="/images/logo.jpg" alt="Logo" class="img-fluid">
            <h1 class="page-title">Tetapkan Semula Kata Laluan</h1>
            <p class="subtitle">Masukkan nombor IC dan emel anda untuk menetapkan semula kata laluan.</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <div class="form-section">
            <form action="/handle-forgot-password" method="POST">
                <div class="mb-3">
                    <label for="ic_no" class="form-label">Nombor IC</label>
                    <input type="text" class="form-control" id="ic_no" name="ic_no" 
                           placeholder="Contoh: 123456789012" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Emel</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           placeholder="Contoh: nama@email.com" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Tetapkan Semula Kata Laluan</button>
                <div class="text-center mt-2">
                    <a href="/userlogin" style="font-size: 24px; color: #666;">
                        <i class="bi bi-arrow-left-circle"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const icInput = document.getElementById('ic_no');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const icNo = icInput.value.trim();
            
            if (icNo.length !== 12 || !/^\d+$/.test(icNo)) {
                alert('Nombor IC mestilah 12 digit');
                icInput.focus();
                return;
            }
            
            this.submit();
        });
        
        icInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 12) {
                this.value = this.value.slice(0, 12);
            }
        });
    });
    </script>
</body>
</html>