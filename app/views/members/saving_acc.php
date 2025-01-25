<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akaun Simpanan - KADA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styles */
        :root {
            --primary-color: #2E7D32;    /* Dark green */
            --secondary-color: #4CAF50;  /* Medium green */
            --accent-color: #81C784;     /* Light green */
            --text-dark: #1B5E20;        /* Dark green text */
            --text-light: #E8F5E9;       /* Light green text */
            --background-overlay: rgba(255, 255, 255, 0.95);
        }
        
        body {
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        .main-wrapper {
            flex: 1;
            padding: 2rem 4rem;
            margin-top: 100px;
            min-height: calc(100vh - 200px);
            display: flex;
            flex-direction: column;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            width: 100%;
            max-width: 1400px;
            padding: 2rem 4rem;
            flex: 1;
        }

        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }
        
        .savings-card {
            background: linear-gradient(135deg, #F8B195, #F67280);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .savings-card h4 {
            color: white !important;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .savings-card h4 i {
            color: white !important;
        }

        .savings-card .balance-amount {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .savings-card .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .savings-card .btn-primary {
            background-color: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
        }

        .savings-card .btn-primary:hover {
            background-color: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .savings-card .btn-outline-primary {
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.4);
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .savings-card .btn-outline-primary:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .withdrawal-history {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .filter-section {
            background: #f8fafc;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .payment-methods .btn-outline-primary {
            border: 2px solid #dee2e6;
            background-color: white;
            color: #333;
            transition: all 0.3s ease;
            min-height: 100px;
        }

        .payment-methods .btn-outline-primary:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }

        .payment-methods .btn-check:checked + .btn-outline-primary {
            background-color: #e7f1ff;
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .payment-methods i {
            font-size: 1.5rem;
        }

        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-radius: 15px 15px 0 0;
        }

        .modal-footer {
            background-color: #f8f9fa;
            border-radius: 0 0 15px 15px;
        }

        .installment-card {
            background: linear-gradient(135deg, #F5E6CA, #E6B89C);
            color: #6B4423;
            border-radius: 15px;
            padding: 1.2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .installment-card h5 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .installment-card .amount {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .installment-card .next-payment {
            text-align: right;
            font-size: 0.9rem;
        }

        .installment-card .text-muted {
            color: rgba(107, 68, 35, 0.7) !important;
        }

        .auto-debit-notice {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            padding: 0.8rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-top: 0.8rem;
        }

        .notice-icon {
            background: #F67280;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notice-text {
            font-size: 0.8rem;
            line-height: 1.3;
            color: #6B4423;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        @media (max-width: 768px) {
            .content-container {
                width: 95%;
                padding: 2rem 1rem;
            }
            .main-wrapper {
                padding: 2rem 1rem;
            }

            .installment-card {
                margin-top: 1rem;
            }
            
            .savings-card {
                padding: 1.5rem;
            }
            
            .btn-action {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
            }
        }

        .table {
            font-size: 0.95rem;
        }

        .table th {
            font-weight: 600;
            color: #555;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
            border-radius: 6px;
        }

        .badge-soft-success {
            background-color: #D1F2E4;
            color: #0E6245;
            border: 1px solid #A3E4C9;
        }

        .badge-soft-primary {
            background-color: #D1E3FF;
            color: #1A4B99;
            border: 1px solid #A3C7FF;
        }

        .badge-soft-warning {
            background-color: #FFE7C3;
            color: #956206;
            border: 1px solid #FFD599;
        }

        .badge-soft-danger {
            background-color: #FFD6D6;
            color: #B42C2C;
            border: 1px solid #FFADAD;
        }

        .card-header h5 {
            color: #2d3748;
            font-weight: 600;
        }

        .table-responsive {
            border-radius: 0.5rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }

        .back-btn {
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: #f5f5f5;
            color: #666;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .back-btn:hover {
            background: #eeeeee;
            color: #444;
            transform: translateX(-3px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .back-btn:active {
            background: #e8e8e8;
            transform: translateX(-2px);
        }

        .back-btn i {
            font-size: 0.9rem;
            transition: transform 0.3s ease;
            color: #777;
        }

        .back-btn:hover i {
            transform: translateX(-2px);
            color: #555;
        }

        .modal-content {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .modal-header {
            padding: 1.5rem;
            border-radius: 20px 20px 0 0;
        }

        .modal-icon {
            width: 35px;
            height: 35px;
            background: #e7f0ff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            font-size: 1rem;
        }

        .amount-input .input-group {
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
        }

        .amount-input input {
            font-size: 1.5rem;
            font-weight: 500;
        }

        .amount-input input:focus {
            box-shadow: none;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem;
            background: #f8f9fa;
            border: 2px solid #f8f9fa;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }

        .payment-icon {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #6c757d;
        }

        .payment-text {
            font-size: 1rem;
            font-weight: 500;
        }

        .payment-text small {
            display: none;
        }

        .btn-check:checked + .payment-option {
            border-color: #0d6efd;
            background: #e7f0ff;
        }

        .btn-check:checked + .payment-option .payment-icon {
            background: #0d6efd;
            color: white;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .btn-primary {
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 500;
        }

        /* Animation for modal */
        .modal.fade .modal-dialog {
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
        }

        .payment-methods .row {
            margin-right: -8px;
            margin-left: -8px;
        }

        .payment-methods .col-6 {
            padding-right: 8px;
            padding-left: 8px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem;
            background: #f8f9fa;
            border: 2px solid #f8f9fa;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 100%;
        }

        .payment-option:hover {
            background: #f0f2f5;
        }

        .payment-icon {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #6c757d;
            flex-shrink: 0;
        }

        .payment-text {
            font-size: 0.9rem;
            line-height: 1.2;
        }

        .payment-text small {
            font-size: 0.75rem;
        }

        .btn-check:checked + .payment-option {
            border-color: #0d6efd;
            background: #e7f0ff;
        }

        .btn-check:checked + .payment-option .payment-icon {
            background: #0d6efd;
            color: white;
        }

        .btn-check:checked + .payment-option .payment-text {
            color: #0d6efd;
        }

        .balance-info {
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .current-balance {
            font-weight: 600;
            color: #198754;
        }

        .purpose-option {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: #f8f9fa;
            border: 2px solid #f8f9fa;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 100%;
            font-size: 0.9rem;
        }

        .purpose-icon {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #6c757d;
        }

        .purpose-text {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-check:checked + .purpose-option {
            border-color: #0d6efd;
            background: #e7f0ff;
            color: #0d6efd;
        }

        .btn-check:checked + .purpose-option .purpose-icon {
            background: #0d6efd;
            color: white;
        }

        .btn-check:checked + .purpose-option .purpose-text {
            color: #0d6efd;
        }

        .form-control {
            padding: 0.5rem 0.75rem;
        }

        .btn-primary {
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        /* Keep existing modal styles and add these new ones */
        .balance-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 12px;
        }

        .current-balance {
            font-size: 1.5rem;
            font-weight: 600;
            color: #198754;
        }

        .purpose-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem;
            background: #f8f9fa;
            border: 2px solid #f8f9fa;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 100%;
            text-align: center;
        }

        .purpose-icon {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #6c757d;
        }

        .purpose-text {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-check:checked + .purpose-option {
            border-color: #0d6efd;
            background: #e7f0ff;
        }

        .btn-check:checked + .purpose-option .purpose-icon {
            background: #0d6efd;
            color: white;
        }

        .btn-check:checked + .purpose-option .purpose-text {
            color: #0d6efd;
        }

        .alert {
            max-width: 1320px; 
            margin: 1rem auto;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
        }

        .alert-success {
            background-color: #d1f2e4;
            color: #0E6245;
            border: 1px solid #A3E4C9;
        }

        .alert-danger {
            background-color: #FFD6D6;
            color: #B42C2C;
            border: 1px solid #FFADAD;
        }

        .form-select {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
            width: 100%;
        }

        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: #f5f5f5;
            color: #666;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .btn-outline-success {
            border-color: #198754;
            color: #198754;
            background: #fff;
        }

        .btn-outline-info {
            border-color: #0dcaf0;
            color: #0dcaf0;
            background: #fff;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
            background: #fff;
        }

        .btn-outline-success:hover {
            background-color: #198754;
            color: #fff;
        }

        .btn-outline-info:hover {
            background-color: #0dcaf0;
            color: #fff;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .btn i {
            font-size: 0.9rem;
            transition: transform 0.3s ease;
            color: inherit;
        }

        .btn:hover i {
            transform: translateX(-2px);
        }

        .fee-item {
            padding: 10px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .fee-item:hover {
            background-color: #f0f2f5;
        }

        .deposit-info {
            border-left: 4px solid #198754;
        }

        .modal-icon {
            width: 32px;
            height: 32px;
            background: #fff3cd;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #997404;
        }

        .fee-item {
            background-color: #f8f9fa;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .fee-item:hover {
            background-color: #f0f2f5;
        }

        .modal-icon {
            width: 32px;
            height: 32px;
            background: #e9ecef;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-icon i {
            color: #495057;
            font-size: 1rem;
        }

        .fw-medium {
            font-weight: 500;
        }

        .summary-section {
            border-left: 4px solid #0d6efd;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .section-title {
            color: #6c757d;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fee-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .fee-item {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .fee-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.25rem;
        }

        .fee-name {
            font-weight: 500;
            color: #212529;
        }

        .fee-amount {
            font-weight: 600;
            color: #0d6efd;
        }

        .fee-description {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .summary-section {
            background: #f8f9fa;
            padding: 1.25rem;
            border-radius: 8px;
            margin-top: 1.5rem;
        }

        .total-row, .savings-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-row {
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }

        .total-label, .savings-label {
            font-weight: 500;
            color: #212529;
        }

        .total-amount {
            font-size: 1.25rem;
            font-weight: 600;
            color: #dc3545;
        }

        .savings-amount {
            font-weight: 600;
            color: #198754;
        }

        .modal-footer {
            border-top: none;
            padding: 1.25rem;
        }

        .btn-primary {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            
        }

        .card {
            margin-bottom: 2rem; 
        }

        .table {
            width: 100%;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th, .table td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #555;
        }

        .table-responsive {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }

        .transaction-history-section {
            margin-top: 2rem; 
        }

        .payment-dates {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        .fee-item {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .fee-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .fee-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .fee-name {
            font-weight: 600;
            color: #495057;
        }

        .fee-amount {
            font-weight: 600;
            color: #0d6efd;
        }

        .fee-description {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .summary-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }

        .total-amount {
            color: #0d6efd;
            font-size: 1.1rem;
        }

        /* Update the existing payment-dates styles */
        .payment-dates {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        /* Add new styles for the date boxes */
        .payment-date-box {
            flex: 1;
            padding: 0.5rem 1rem;
        }

        .date-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .date-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #212529;
        }

        .date-value.text-danger {
            color: #dc3545 !important;
        }

        /* Add divider between dates */
        .payment-date-box:first-child {
            border-right: 2px solid #dee2e6;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .payment-dates {
                padding: 1rem;
            }
            
            .date-label {
                font-size: 0.8rem;
            }
            
            .date-value {
                font-size: 1.1rem;
            }
        }

        .btn-action {
            background: rgba(255, 255, 255, 0.2);  /* Transparent white background */
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            width: 50%;  /* Changed from 100% to auto */
            min-width: 200px;  /* Added minimum width */
            text-align: left;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            margin-right: 20px;
        }

        .btn-action:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
            color: white;
        }

        .btn-action i {
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }

        /* Add new container style for the buttons */
        .action-buttons-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding-right: 20px; /* Add padding from the right edge */
        }

        /* Add profile sidebar styles */
        .profile-sidebar {
            position: fixed;
            right: -300px;
            top: 0;
            width: 300px;
            height: 100vh;
            background-color: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1040;
        }

        .profile-sidebar.active {
            right: 0;
        }

        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .user-profile-section {
            padding: 1rem;
            background-color: white;
            color: #333;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-profile-section img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .user-name {
            font-weight: 500;
            color: #333;
            font-size: 1rem;
        }

        .user-info .btn-success {
            background-color: #2E7D32;
            border: none;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }

        .sidebar-scrollable {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }

        .dropdown-header {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            color: #666;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #333;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .dropdown-item .fa-chevron-right {
            margin-left: auto;
            font-size: 0.8em;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
        <div class="page-wrapper">
        <!-- Top Bar -->
        <div class="logo-section">
                    <div class="container">
                        <div class="row align-items-center py-2">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <img src="/images/logo.jpg" alt="Logo KADA" class="img-fluid me-3" style="max-height: 70px; width: auto;">
                                    <div class="d-flex flex-column">
                                        <h1 class="mb-0 fs-4 fw-bold text-success">Lembaga Kemajuan Pertanian Kemubu</h1>
                                        <span class="text-secondary fs-6">KADA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="#" id="profileButton" class="nav-link">
                                    <i class="fas fa-user-circle fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Main content wrapper -->
            <div class="main-wrapper">
            <div class="content-container">
                <!-- Keep your existing content structure -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error'] ?>
                        <?php unset($_SESSION['error']) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <?= $_SESSION['success'] ?>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
        <div class="row">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="/members" class="btn btn-light back-btn">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman Utama
            </a>
        </div>

        
            <!-- Left Column: Savings Overview -->
            <div class="col-md-8">
                <div class="savings-card mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h4 class="text-white"><i class="fas fa-piggy-bank me-2 text-white"></i>Jumlah Simpanan</h4>
                            <div class="balance-amount">
                                RM <?= number_format($savings_account->total_balance ?? 0, 2) ?>
                            </div>
                            <p class="text-muted mb-2">No. Akaun: <?= htmlspecialchars($savings_account->account_number ?? '-') ?></p>
                            <p class="text-muted mb-0">Kemas kini terakhir: <?= date('d M Y, H:i A', strtotime($savings_account->updated_at ?? 'now')) ?></p>
                        </div>
                        <div class="col-md-5">
                            <div class="action-buttons-container">
                                <button type="button" class="btn btn-light btn-action" data-bs-toggle="modal" data-bs-target="#depositModal">
                                    <i class="fas fa-plus-circle me-2"></i>Buat Deposit
                                </button>
                                <button type="button" class="btn btn-light btn-action" data-bs-toggle="modal" data-bs-target="#transferModal">
                                    <i class="fas fa-exchange-alt me-2"></i>Pindahan Wang
                                </button>
                                <button type="button" class="btn btn-light btn-action" data-bs-toggle="modal" data-bs-target="#outstandingFeesModal">
                                    <i class="fas fa-file-invoice me-2"></i>Yuran Tertunggak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Monthly Installment -->
<div class="col-md-4">
    <div class="installment-card">
        <h5 class="mb-3"><i class="fas fa-calendar-alt me-2"></i>Ansuran Bulanan</h5>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="amount">
                RM <?= number_format($total_monthly_installment ?? 0, 2) ?>
            </div>
            <div class="next-payment">
                <small class="text-muted">Bayaran Seterusnya:</small><br>
                <strong><?= date('d M Y', strtotime('+1 month')) ?></strong>
            </div>
        </div>
        
        <!-- Show breakdown of loans if there are multiple -->
        <?php if (!empty($loan_applications) && count($loan_applications) > 1): ?>
            <div class="loan-breakdown mt-3">
                <small class="text-muted d-block mb-2">Pecahan Ansuran:</small>
                <?php foreach ($loan_applications as $loan): ?>
                    <div class="d-flex justify-content-between small">
                        <span><?= $loan['loan_type'] ?></span>
                        <span>RM <?= number_format($loan['mon_installment'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="auto-debit-notice">
            <div class="notice-icon">
                <i class="fas fa-sync-alt"></i>
            </div>
            <div class="notice-text">
                Ansuran akan ditolak secara automatik
            </div>
        </div>
    </div>
</div>

        <!-- Place this right after the account summary section and before the transaction history table -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-check-circle me-2"></i>
                        <?= $_SESSION['success'] ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Transaction History Section -->
        <div class="transaction-history-section">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Sejarah Transaksi</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($transactions)): ?>
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-info-circle me-2"></i>Tiada transaksi dijumpai
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tarikh</th>
                                        <th>Jenis</th>
                                        <th>Jumlah (RM)</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $transaction): ?>
                                        <!-- Debug line to see transaction data -->
                                        <?php error_log("Transaction object: " . print_r($transaction, true)); ?>

                                        <tr>
                                            <td><?= date('d/m/Y h:i A', strtotime($transaction->transaction_date)) ?></td>
                                            <td>
                                                <?php if ($transaction->transaction_type == 'deposit'): ?>
                                                    <span class="badge badge-soft-success">Deposit</span>
                                                <?php else: ?>
                                                    <span class="badge badge-soft-primary">Pengeluaran</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>RM <?= number_format($transaction->amount, 2) ?></td>
                                            <td>
                                                <?php if ($transaction->status == 'approved'): ?>
                                                    <span class="badge badge-soft-success">Diluluskan</span>
                                                <?php elseif ($transaction->status == 'rejected'): ?>
                                                    <span class="badge badge-soft-danger">Ditolak</span>
                                                <?php else: ?>
                                                    <span class="badge badge-soft-warning">Dalam Proses</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $transaction->description ?></td>
                                            <td>
                                                <?php if ($transaction->status === 'approved'): ?>
                                                    <a href="/members/receipt/<?= $transaction->id ?>" 
                                                       class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-download me-1"></i>Muat Turun Resit
                                                    </a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Deposit Modal -->
    <div class="modal fade" id="depositModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <!-- Modal Header -->
                <div class="modal-header border-0 bg-light">
                    <div class="d-flex align-items-center">
                        <div class="modal-icon me-3">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <h5 class="modal-title fw-bold mb-0">Buat Deposit</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form id="depositForm" action="/members/deposit" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        
                        <!-- Amount Input -->
                        <div class="amount-input mb-4">
                            <label class="form-label">Jumlah Deposit (RM)</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light">RM</span>
                                <input type="number" 
                                       name="amount" 
                                       class="form-control form-control-lg border-0 bg-light" 
                                       required 
                                       min="1" 
                                       step="0.01"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <label class="form-label">Kaedah Pembayaran</label>
                            <div class="payment-methods">
                                <div class="row g-3">
                                    <!-- FPX Online Banking -->
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="payment_method" id="fpx" value="fpx" checked>
                                        <label class="payment-option" for="fpx">
                                            <div class="payment-icon">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div class="payment-text">
                                                <span class="d-block">FPX</span>
                                                <small class="text-muted">Online Banking</small>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Credit/Debit Card -->
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="payment_method" id="card" value="card">
                                        <label class="payment-option" for="card">
                                            <div class="payment-icon">
                                                <i class="fas fa-credit-card"></i>
                                            </div>
                                            <div class="payment-text">
                                                <span class="d-block">Kad</span>
                                                <small class="text-muted">Kredit/Debit</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- FPX Bank Details (shown when FPX is selected) -->
                                <div id="fpxDetails" class="mt-3">
                                    <div class="form-group">
                                        
                                        <select class="form-select" name="bank_name" id="bankSelect">
                                            <option value="">Pilih Bank</option>
                                            <option value="Maybank">Maybank</option>
                                            <option value="CIMB Bank">CIMB Bank</option>
                                            <option value="Public Bank">Public Bank</option>
                                            <option value="RHB Bank">RHB Bank</option>
                                            <option value="Hong Leong Bank">Hong Leong Bank</option>
                                            <option value="AmBank">AmBank</option>
                                            <option value="UOB Bank">UOB Bank</option>
                                            <option value="Bank Rakyat">Bank Rakyat</option>
                                            <option value="Bank Islam">Bank Islam</option>
                                            <option value="Affin Bank">Affin Bank</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="bank_account" placeholder="Masukkan nombor akaun bank">
                                    </div>
                                </div>

                                <!-- Card Details (shown when Card is selected) -->
                                <div id="cardDetails" class="mt-3" style="display: none;">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-4">
                                            <div class="form-group">
                                                
                                                <select class="form-select" name="card_type">
                                                    <option value="">Pilih Jenis Kad</option>
                                                    <option value="Visa">Visa</option>
                                                    <option value="Mastercard">Mastercard</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                
                                                <input type="text" class="form-control" name="card_number" placeholder="Masukkan nombor kad">
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    
                                                    <input type="text" class="form-control" name="card_expiry" placeholder="MM/YY">
                                                </div>
                                                <div class="col-6">
                                                    
                                                    <input type="text" class="form-control" name="card_cvv" placeholder="CVV">
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                
                                                <input type="text" class="form-control" name="card_holder" placeholder="Nama pada kad">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="mb-4">
                            <label class="form-label">Catatan (Pilihan)</label>
                            <textarea name="remarks" 
                                      class="form-control border-0 bg-light" 
                                      rows="2" 
                                      placeholder="Tambah catatan untuk transaksi ini..."></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Teruskan Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Transfer Modal -->
    <div class="modal fade" id="transferModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <div class="modal-icon me-3">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <h5 class="modal-title fw-bold mb-0">Pindahan Wang</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/members/request-transfer" method="POST">
                    <div class="modal-body p-4">
                        <!-- Amount Input -->
                        <div class="mb-4">
                            <label class="form-label">Jumlah Pindahan (RM)</label>
                            <div class="input-group">
                                <span class="input-group-text">RM</span>
                                <input type="number" 
                                       name="amount" 
                                       class="form-control form-control-lg fw-bold" 
                                       required 
                                       min="0" 
                                       step="0.01" 
                                       placeholder="0.00">
                            </div>
                        </div>

                        <!-- Bank Information Section -->
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Nama Bank</label>
                            <select class="form-select" id="bank_name" name="bank_name" required>
                                <option value="" selected disabled>Pilih Bank</option>
                                <option value="Maybank">Maybank</option>
                                <option value="CIMB Bank">CIMB Bank</option>
                                <option value="Public Bank">Public Bank</option>
                                <option value="RHB Bank">RHB Bank</option>
                                <option value="Hong Leong Bank">Hong Leong Bank</option>
                                <option value="AmBank">AmBank</option>
                                <option value="UOB Bank">UOB Bank</option>
                                <option value="Bank Rakyat">Bank Rakyat</option>
                                <option value="Bank Islam">Bank Islam</option>
                                <option value="Affin Bank">Affin Bank</option>
                                <option value="Alliance Bank">Alliance Bank</option>
                                <option value="BSN">Bank Simpanan Nasional (BSN)</option>
                                <option value="OCBC Bank">OCBC Bank</option>
                                <option value="Standard Chartered">Standard Chartered</option>
                                <option value="HSBC Bank">HSBC Bank</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            
                            <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Masukkan nombor akaun bank" required>
                        </div>

                        <!-- Purpose Section -->
                        <div class="mb-4">
                            <label class="form-label">Tujuan Pindahan</label>
                            <div class="row g-3">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="purpose" id="payment" value="payment" checked>
                                    <label class="payment-option" for="payment">
                                        <div class="payment-icon">
                                            <i class="fas fa-file-invoice"></i>
                                        </div>
                                        <div class="payment-text">Pembayaran</div>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="purpose" id="transfer" value="transfer">
                                    <label class="payment-option" for="transfer">
                                        <div class="payment-icon">
                                            <i class="fas fa-exchange-alt"></i>
                                        </div>
                                        <div class="payment-text">Pemindahan</div>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="purpose" id="education" value="education">
                                    <label class="payment-option" for="education">
                                        <div class="payment-icon">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="payment-text">Pendidikan</div>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="purpose" id="others" value="others">
                                    <label class="payment-option" for="others">
                                        <div class="payment-icon">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </div>
                                        <div class="payment-text">Lain-lain</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="mb-4">
                            <label class="form-label">Catatan (Pilihan)</label>
                            <textarea name="remarks" class="form-control" rows="2" placeholder="Tambah catatan untuk transaksi ini..."></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Teruskan Pembayaran
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Financial Report Section -->
    <div class="d-flex justify-content-center">
        <div style="width: 100%; max-width: 1300px;">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-file-pdf me-2"></i>Laporan Kewangan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="/members/view-financial-report" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div class="row g-3">
                            <!-- Report Type Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Laporan</label>
                                    <select name="report_type" class="form-select form-select-sm" id="reportType" required>
                                        <option value="">Pilih jenis laporan</option>
                                        <option value="monthly">Laporan Bulanan</option>
                                        <option value="yearly">Laporan Tahunan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Sila pilih jenis laporan
                                    </div>
                                </div>
                            </div>

                            <!-- Date Selection -->
                            <div class="col-md-6">
                                <!-- Monthly Selection -->
                                <div class="form-group" id="monthSelect">
                                    <label class="form-label">Pilih Bulan</label>
                                    <input type="month" 
                                           name="selected_month" 
                                           class="form-control form-control-sm" 
                                           max="<?php echo date('Y-m'); ?>"
                                           value="<?php echo date('Y-m'); ?>">
                                    <div class="invalid-feedback">
                                        Sila pilih bulan
                                    </div>
                                </div>

                                <!-- Yearly Selection -->
                                <div class="form-group" id="yearSelect">
                                    <label class="form-label">Pilih Tahun</label>
                                    <select name="selected_year" class="form-select form-select-sm">
                                        <option value="">Pilih tahun</option>
                                        <?php 
                                        $currentYear = date('Y');
                                        for($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Sila pilih tahun
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add form validation script -->
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.querySelector('.needs-validation');
                            
                            form.addEventListener('submit', function(event) {
                                const reportType = document.getElementById('reportType').value;
                                const monthInput = document.querySelector('input[name="selected_month"]');
                                const yearSelect = document.querySelector('select[name="selected_year"]');

                                // Reset required attributes
                                monthInput.required = false;
                                yearSelect.required = false;

                                // Set required based on report type
                                if (reportType === 'monthly') {
                                    monthInput.required = true;
                                    if (!monthInput.value) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                } else if (reportType === 'yearly') {
                                    yearSelect.required = true;
                                    if (!yearSelect.value) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                }

                                form.classList.add('was-validated');
                            });
                        });
                        </script>

                        <!-- View Report Button -->
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search me-2"></i>Papar Penyata
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Outstanding Fees Modal -->
    <div class="modal fade" id="outstandingFeesModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 bg-success-subtle">
                    <div class="d-flex align-items-center">
                        <div class="modal-icon me-3">
                            <i class="fas fa-file-invoice text-success"></i>
                        </div>
                        <h5 class="modal-title fw-bold mb-0">Yuran Tertunggak</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Payment Dates -->
                    <div class="payment-dates mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="payment-date-box">
                                <div class="date-label">Pembayaran Terakhir</div>
                                <div class="date-value">
                                    <?= date('d/m/Y', strtotime($payment_dates['last_payment_date'])) ?>
                                </div>
                            </div>
                            <div class="payment-date-box text-end">
                                <div class="date-label">Pembayaran Seterusnya</div>
                                <div class="date-value text-success">
                                    <?= date('d/m/Y', strtotime($payment_dates['next_payment_date'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Payments Button -->
                    <button type="button" class="btn btn-outline-success w-100 mb-4 py-3 rounded-3" id="showPendingPayments">
                        <i class="fas fa-list-ul me-2"></i>
                        Lihat Senarai Pembayaran Tertunggak
                    </button>

                    <!-- Pending Payments List -->
                    <div id="pendingPaymentsList" style="display: none;">
                        <!-- One-time Fees -->
                        <div class="fee-section mb-4">
                            <h6 class="section-title">
                                <i class="fas fa-star me-2 text-success"></i>
                                Yuran Sekali
                            </h6>
                            <div class="fee-list">
                                <div class="fee-item">
                                    <div class="fee-details">
                                        <div class="fee-name">Yuran Pendaftaran</div>
                                        <div class="fee-amount">RM <?= number_format($pending_member['registration_fee'] ?? 35, 2) ?></div>
                                    </div>
                                    <div class="fee-description">Yuran keahlian sekali sahaja</div>
                                </div>

                                <div class="fee-item">
                                    <div class="fee-details">
                                        <div class="fee-name">Modal Saham</div>
                                        <div class="fee-amount">RM <?= number_format($pending_member['share_capital'] ?? 300, 2) ?></div>
                                    </div>
                                    <div class="fee-description">Modal saham keahlian</div>
                                </div>

                                <div class="fee-item">
                                    <div class="fee-details">
                                        <div class="fee-name">Modal Deposit</div>
                                        <div class="fee-amount">RM <?= number_format($pending_member['deposit_funds'] ?? 20, 2) ?></div>
                                    </div>
                                    <div class="fee-description">Deposit kedalam akaun</div>
                                </div>
                            </div>
                        </div>

                        <!-- Monthly Fees -->
                        <div class="fee-section mb-4">
                            <h6 class="section-title">
                                <i class="fas fa-calendar-alt me-2 text-success"></i>
                                Yuran Bulanan
                            </h6>
                            <div class="fee-list">
                                <div class="fee-item">
                                    <div class="fee-details">
                                        <div class="fee-name">Modal Yuran</div>
                                        <div class="fee-amount">RM <?= number_format($pending_member['fee_capital'] ?? 50, 2) ?></div>
                                    </div>
                                    <div class="fee-description">Mengekalkan status member</div>
                                </div>

                                <div class="fee-item">
                                    <div class="fee-details">
                                        <div class="fee-name">Tabung Kebajikan</div>
                                        <div class="fee-amount">RM <?= number_format($pending_member['welfare_fund'] ?? 5, 2) ?></div>
                                    </div>
                                    <div class="fee-description">Dibayar setiap bulan</div>
                                </div>

                                <div class="fee-item">
                                    <div class="fee-details">
                                        <div class="fee-name">Simpanan Tetap</div>
                                        <div class="fee-amount">RM <?= number_format($pending_member['fixed_deposit'] ?? 0, 2) ?></div>
                                    </div>
                                    <div class="fee-description">Deposit kedalam akaun setiap bulan</div>
                                </div>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="summary-section">
                            <div class="total-row">
                                <div class="total-label">Jumlah Tertunggak</div>
                                <?php
                                    $total = ($pending_member['registration_fee'] ?? 35) +
                                            ($pending_member['share_capital'] ?? 300) +
                                            ($pending_member['deposit_funds'] ?? 20) +
                                            ($pending_member['fee_capital'] ?? 50) +
                                            ($pending_member['welfare_fund'] ?? 5) +
                                            ($pending_member['fixed_deposit'] ?? 0);
                                ?>
                                <div class="total-amount">RM <?= number_format($total, 2) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" id="backButton" style="display: none;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal" id="closeButton">Tutup</button>
                    <a href="<?= BASEURL ?>/members/confirm_payment" class="btn btn-success px-4" id="paymentButton" style="display: none;">
                        <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages -->
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <?= $_SESSION['success'] ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </div>
    </div>
    </div>
    

    <!-- Footer -->
    <footer class="bg-dark text-light py-3">
            <div class="container">
                <div class="row justify-content-center text-center g-4">
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-2">Hubungi Kami</h6>
                        <address class="small mb-0">
                            Lembaga Kemajuan Pertanian Kemubu<br>
                            Peti Surat 127, Bandar Kota Bharu,<br>
                            15710 Kota Bharu, Kelantan<br>
                            <i class="fas fa-phone"></i> +60 97455388<br>
                            <i class="fas fa-envelope"></i> prokada@kada.gov.my
                        </address>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-2">Imbas QR</h6>
                        <img src="/images/QR.jpg" alt="QR Code" class="qr-code" style="max-width: 70px; cursor: pointer;">
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-2">Ikuti Kami</h6>
                        <div class="social-links">
                            <a href="https://www.facebook.com/kadakemubu/" class="text-light">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </div>
                        <div class="mt-2 small">
                            <small>&copy; 2023 KADA. Semua hak terpelihara.</small>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            
    <!-- Add this script right before the closing </div> of the card-body -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the select element
        const reportType = document.getElementById('reportType');
        const monthSelect = document.getElementById('monthSelect');
        const yearSelect = document.getElementById('yearSelect');

        // Add console logs for debugging
        console.log('Report Type Element:', reportType);
        console.log('Month Select Element:', monthSelect);
        console.log('Year Select Element:', yearSelect);

        // Hide both selections initially
        if (monthSelect) monthSelect.style.display = 'none';
        if (yearSelect) yearSelect.style.display = 'none';

        reportType.addEventListener('change', function() {
            console.log('Selected value:', this.value); // Debug log

            // Hide both initially
            monthSelect.style.display = 'none';
            yearSelect.style.display = 'none';

            // Show the appropriate selection based on report type
            if (this.value === 'monthly') {
                console.log('Showing monthly selection');
                monthSelect.style.display = 'block';
                // Reset year selection
                document.querySelector('select[name="selected_year"]').value = '';
            } else if (this.value === 'yearly') {
                console.log('Showing yearly selection');
                yearSelect.style.display = 'block';
                // Reset month selection
                document.querySelector('input[name="selected_month"]').value = '';
            }
        });  
    });
    </script>

    <!-- Add this script at the bottom of the file -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const showPendingPaymentsBtn = document.getElementById('showPendingPayments');
        const pendingPaymentsList = document.getElementById('pendingPaymentsList');
        const paymentButton = document.getElementById('paymentButton');
        const backButton = document.getElementById('backButton');
        const closeButton = document.getElementById('closeButton');

        function showPaymentsList() {
            pendingPaymentsList.style.display = 'block';
            paymentButton.style.display = 'block';
            backButton.style.display = 'block';
            showPendingPaymentsBtn.style.display = 'none';
            closeButton.style.display = 'none';
        }

        function hidePaymentsList() {
            pendingPaymentsList.style.display = 'none';
            paymentButton.style.display = 'none';
            backButton.style.display = 'none';
            showPendingPaymentsBtn.style.display = 'block';
            closeButton.style.display = 'block';
        }

        showPendingPaymentsBtn.addEventListener('click', showPaymentsList);
        backButton.addEventListener('click', hidePaymentsList);
    });
    </script>

    <!-- Add this JavaScript code at the bottom of the file -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fpxRadio = document.getElementById('fpx');
        const cardRadio = document.getElementById('card');
        const fpxDetails = document.getElementById('fpxDetails');
        const cardDetails = document.getElementById('cardDetails');

        function togglePaymentDetails() {
            if (fpxRadio.checked) {
                fpxDetails.style.display = 'block';
                cardDetails.style.display = 'none';
            } else if (cardRadio.checked) {
                fpxDetails.style.display = 'none';
                cardDetails.style.display = 'block';
            }
        }

        fpxRadio.addEventListener('change', togglePaymentDetails);
        cardRadio.addEventListener('change', togglePaymentDetails);

        // Initialize the display
        togglePaymentDetails();
    });
    </script>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutConfirmModalLabel">Pengesahan Log Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Adakah anda pasti untuk log keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="/logout" class="btn btn-danger" onclick="clearCacheAndLogout(event)">Log Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Update script section -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Profile sidebar toggle functionality
        const profileButton = document.getElementById('profileButton');
        const profileSidebar = document.getElementById('profileSidebar');
        
        if (profileButton && profileSidebar) {
            profileButton.addEventListener('click', function(e) {
                e.preventDefault();
                profileSidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (!profileSidebar.contains(e.target) && !profileButton.contains(e.target)) {
                    profileSidebar.classList.remove('active');
                }
            });
        }

        // Existing logout modal code
        const logoutLinks = document.querySelectorAll('a[href="/logout"]');
        logoutLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const logoutModal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));
                logoutModal.show();
            });
        });
    });

    function clearCacheAndLogout(event) {
        window.location.replace('/logout');
        
        if (window.history && window.history.pushState) {
            window.history.pushState('', '', '/userlogin');
            window.onpopstate = function () {
                window.history.pushState('', '', '/userlogin');
            };
        }
        
        localStorage.clear();
        sessionStorage.clear();
        
        return true;
    }
    </script>
</body>
</html>

<!-- Add Profile Sidebar HTML before closing body tag -->
<div class="profile-sidebar" id="profileSidebar">
    <div class="sidebar-content">
        <!-- User Profile Section at Top -->
        <div class="user-profile-section">
            <img src="/images/default-avatar.png" alt="Pengguna" class="rounded-circle">
            <div class="user-info">
                <div class="user-name"><?= htmlspecialchars($member->name ?? 'Nama Pengguna') ?></div>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Keluar</a>
            </div>
        </div>

        <!-- Scrollable Content -->
        <div class="sidebar-scrollable">
            <!-- Profile Section -->
            <div class="dropdown-header">
                <i class="fas fa-user"></i>Profil
            </div>
            <a class="dropdown-item" href="/members/profile">
                <i class="fas fa-id-card"></i>
                <span>Lihat Profil</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <!-- Dashboard Section -->
            <div class="dropdown-header">
                <i class="fas fa-th-large"></i>Papan Pemuka
            </div>
            <a class="dropdown-item" href="/members/dashboard">
                <i class="fas fa-clipboard-list"></i>
                <span>Status Permohonan</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <!-- My Saving Account -->
            <div class="dropdown-header">
                <i class="fas fa-piggy-bank"></i>Simpanan Saya
            </div>
            <a class="dropdown-item" href="/members/saving_acc">
                <i class="fas fa-wallet"></i>
                <span>Akaun Simpanan Saya</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>
        </div>
    </div>
</div>