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
        /* Copy the same root variables and background styles from admin */
        :root {
            --primary-color: #2E7D32;
            --secondary-color: #4CAF50;
            --accent-color: #81C784;
            --text-dark: #1B5E20;
            --text-light: #E8F5E9;
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

        /* Header Styles */
        .navbar {
            padding: 1rem 0;
            background-color: var(--background-overlay) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 1.1rem;
        }

        .nav-link {
            color: inherit;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Profile Sidebar Styles */
        .profile-sidebar {
            position: fixed;
            top: 0;
            right: -300px;
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
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* User Profile Section Styles */
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

        /* Sidebar Navigation Styles */
        .sidebar-scrollable {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }

        .dropdown-header {
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.875rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            color: var(--text-dark);
            transition: background-color 0.3s ease;
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 10px;
            color: var(--primary-color);
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }

        .dropdown-item .fa-chevron-right {
            margin-left: auto;
            font-size: 0.75rem;
            opacity: 0.5;
        }

        /* Header adjustments */
        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        .logo-section h1 {
            color: var(--primary-color);
            line-height: 1.2;
        }

        .logo-section .text-secondary {
            color: var(--secondary-color) !important;
        }

        /* Add new sidebar navigation styles */
        .sidebar-nav {
            position: fixed;
            left: 0;
            top: 80px; /* Adjusted to account for the main header */
            height: calc(100vh - 80px); /* Adjusted height */
            width: 250px;
            background: white;
            padding: 20px 0;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #495057;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 5px;
            font-size: 0.95rem;
        }

        .sidebar-nav .nav-link:hover {
            background: #f8f9fa;
            color: #0d6efd;
        }

        .sidebar-nav .nav-link.active {
            background: #e7f1ff;
            color: #0d6efd;
            border-left: 3px solid #0d6efd;
        }

        .sidebar-nav .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Logo section at the top */
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .sidebar-header img {
            height: 40px;
        }

        .sidebar-header h1 {
            font-size: 1.2rem;
            color: #333;
            margin: 10px 0 0 0;
        }

        /* Adjust main content */
        .main-wrapper {
            margin-left: 250px;
            padding: 20px;
            margin-top: 80px; /* Add top margin to account for header */
        }

        @media (max-width: 768px) {
            .sidebar-nav {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar-nav.active {
                transform: translateX(0);
            }
            
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
        <div class="page-wrapper">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/members">
                    <img src="/images/logo.jpg" alt="KADA Logo" style="height: 40px;" class="me-2">
                    <div>
                        <div class="fw-bold text-success">Koperasi Kakitangan KADA</div>
                        <div class="small text-muted">Panel Ahli</div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/members">
                                <i class="fas fa-home me-1"></i> Laman Utama
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="toggleProfileSidebar(); return false;">
                                <i class="fas fa-user me-1"></i> Profil
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

            <!-- Main content wrapper -->
            <div class="main-wrapper">
                
            <nav class="sidebar-nav">
                <div class="sidebar-header">
                    <h1>Akaun Simpanan</h1>
                </div>
                
                <a href="#yuran-section" class="nav-link">
                    <i class="fas fa-file-invoice"></i>
                    Yuran
                </a>
                <a href="#transaksi-section" class="nav-link">
                    <i class="fas fa-history"></i>
                    Sejarah Transaksi
                </a>
                <a href="#laporan-section" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    Laporan Kewangan
                </a>
            </nav>

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
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Monthly Installment -->
<div class="col-md-4 mb-5">
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
        
        <!-- Show breakdown of loans if there are multiple 
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
        -->

        <div class="auto-debit-notice">
            <div class="notice-icon">
                <i class="fas fa-sync-alt"></i>
            </div>
            <div class="notice-text">
                Ansuran akan ditolak secara automatik
            </div>
        </div>

        <!-- Add View Detail Button -->
        <div class="text-end mt-3">
            <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#loanDetailsModal">
                <i class="fas fa-eye me-1"></i>Pecahan Ansuran
            </button>
        </div>
    </div>
</div>

        <!-- Loan Details Modal -->
<div class="modal fade" id="loanDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-invoice-dollar me-2"></i>Butiran Pinjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Jenis Pinjaman</th>
                                <th class="text-end">Jumlah (RM)</th>
                                <th class="text-center">Tempoh (Bulan)</th>
                                <th class="text-end">Ansuran Bulanan (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($loan_applications as $loan): ?>
                                <tr>
                                    <td><?= htmlspecialchars($loan['loan_type']) ?></td>
                                    <td class="text-end"><?= number_format($loan['t_amount'], 2) ?></td>
                                    <td class="text-center"><?= $loan['period'] ?></td>
                                    <td class="text-end"><?= number_format($loan['mon_installment'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

        <!-- Outstanding Fees Section -->
        <div id="yuran-section">
        <div style="width: 100%; max-width: 1300px;">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-file-invoice me-2"></i>Yuran
                </h5>
                <!--button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#payFeesModal">
                    <i class="fas fa-credit-card me-2"></i>Bayar Yuran
                </button>-->
            </div>

            <div class="card-body">
                <!-- One-time Fees Table -->
                <h6 class="section-title mb-3">
                    <i class="fas fa-star me-2 text-success"></i>Yuran Sekali
                </h6>
                <div class="table-responsive mb-4">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%">Jenis Yuran</th>
                                <th style="width: 70%">Keterangan</th>
                                <th class="text-end">Jumlah (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fee Masuk</td>
                                <td>Yuran keahlian sekali sahaja</td>
                                <td class="text-end"><?= number_format($pending_member['registration_fee'] ?? 35, 2) ?></td>
                            </tr>
                            <tr>
                                <td>Modal Syer</td>
                                <td>Modal syer keahlian</td>
                                <td class="text-end"><?= number_format($pending_member['share_capital'] ?? 300, 2) ?></td>
                            </tr>
                            <tr>
                                <td>Tabung Kebajikan</td>
                                <td>Dibayar sekali sahaja</td>
                                <td class="text-end"><?= number_format($pending_member['welfare_fund'] ?? 5, 2) ?></td>
                            </tr>
                            <tr>
                                <td>Modal Deposit</td>
                                <td>Deposit kedalam akaun</td>
                                <td class="text-end"><?= number_format($pending_member['deposit_funds'] ?? 20, 2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Monthly Fees Table -->
                <h6 class="section-title mb-3">
                    <i class="fas fa-calendar-alt me-2 text-success"></i>Yuran Bulanan
                </h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%">Jenis Yuran</th>
                                <th style="width: 70%">Keterangan</th>
                                <th class="text-end">Jumlah (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Modal Yuran</td>
                                <td>Mengekalkan status member</td>
                                <td class="text-end"><?= number_format($pending_member['fee_capital'] ?? 35, 2) ?></td>
                            </tr>
                            <tr>
                                <td>Simpanan Tetap</td>
                                <td>Deposit kedalam akaun setiap bulan</td>
                                <td class="text-end"><?= number_format($pending_member['fixed_deposit'] ?? 0, 2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Total Row -->
                <div class="d-flex justify-content-end mt-3">
                    <div class="bg-light p-3 rounded">
                    <?php
                        $total = ($pending_member['registration_fee'] ?? 35) +
                                ($pending_member['share_capital'] ?? 300) +
                                ($pending_member['deposit_funds'] ?? 20) +
                                ($pending_member['fee_capital'] ?? 35) +
                                ($pending_member['welfare_fund'] ?? 5) +
                                ($pending_member['fixed_deposit'] ?? 0);
                    ?>
                        <strong>Jumlah Yuran: RM <?= number_format($total, 2) ?></strong>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Transaction History Section -->
        <div id="transaksi-section" class="transaction-history-section">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Sejarah Transaksi</h5>

                        <!-- Simplified Filter Dropdown -->
                        <select class="form-select form-select-sm" id="transactionFilter" style="width: 150px;">
                            <option value="all">Semua Transaksi</option>
                            <option value="deposit">Deposit</option>
                            <option value="transfer">Pindahan</option>
                        </select>
                    </div>
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
                                <tbody id="transactionTableBody">
                                    <?php foreach ($transactions as $transaction): ?>
                                        <tr class="transaction-row" data-type="<?= strtolower($transaction->transaction_type) ?>">
                                            <td><?= date('d/m/Y h:i A', strtotime($transaction->transaction_date)) ?></td>
                                            <td>
                                                <?php if (strtolower($transaction->transaction_type) == 'deposit'): ?>
                                                    <span class="badge badge-soft-success">Deposit</span>
                                                <?php elseif (strtolower($transaction->transaction_type) == 'transfer'): ?>
                                                    <span class="badge badge-soft-primary">Pindahan</span>
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
    </div>

    <!-- Add this JavaScript code before the closing body tag -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('transactionFilter');
            const tableBody = document.getElementById('transactionTableBody');
            const rows = tableBody.getElementsByClassName('transaction-row');

            // Add console.log for debugging
            console.log('Available rows:', rows.length);
            Array.from(rows).forEach(row => {
                console.log('Row type:', row.getAttribute('data-type'));
            });

            filterSelect.addEventListener('change', function() {
                const selectedFilter = this.value;
                console.log('Selected filter:', selectedFilter);
                
                Array.from(rows).forEach(row => {
                    const transactionType = row.getAttribute('data-type');
                    console.log('Checking row type:', transactionType, 'against filter:', selectedFilter);
                    
                    if (selectedFilter === 'all') {
                        row.style.display = '';
                    } else {
                        // Make sure to match the exact transaction type values
                        row.style.display = (transactionType === selectedFilter) ? '' : 'none';
                    }
                });
            });
        });
        </script>

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

    <!-- Add this JavaScript for form validation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('depositForm');
    const fpxRadio = document.getElementById('fpx');
    const cardRadio = document.getElementById('card');
    const fpxDetails = document.getElementById('fpxDetails');
    const cardDetails = document.getElementById('cardDetails');

    // Show/hide payment details based on selection
    fpxRadio.addEventListener('change', function() {
        fpxDetails.style.display = 'block';
        cardDetails.style.display = 'none';
    });

    cardRadio.addEventListener('change', function() {
        fpxDetails.style.display = 'none';
        cardDetails.style.display = 'block';
    });

    // Form validation
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Check amount
        const amount = form.querySelector('input[name="amount"]').value;
        if (!amount) {
            alert('Sila masukkan jumlah deposit');
            return;
        }

        // Check payment method selection
        if (!fpxRadio.checked && !cardRadio.checked) {
            alert('Sila pilih kaedah pembayaran');
            return;
        }

        // Validate FPX details
        if (fpxRadio.checked) {
            const bankName = form.querySelector('select[name="bank_name"]').value;
            const bankAccount = form.querySelector('input[name="bank_account"]').value;

            if (!bankName) {
                alert('Sila pilih bank');
                return;
            }
            if (!bankAccount) {
                alert('Sila masukkan nombor akaun bank');
                return;
            }
        }

        // Validate Card details
        if (cardRadio.checked) {
            const cardType = form.querySelector('select[name="card_type"]').value;
            const cardNumber = form.querySelector('input[name="card_number"]').value;
            const cardExpiry = form.querySelector('input[name="card_expiry"]').value;
            const cardCvv = form.querySelector('input[name="card_cvv"]').value;
            const cardHolder = form.querySelector('input[name="card_holder"]').value;

            if (!cardType) {
                alert('Sila pilih jenis kad');
                return;
            }
            if (!cardNumber) {
                alert('Sila masukkan nombor kad');
                return;
            }
            if (!cardExpiry) {
                alert('Sila masukkan tarikh luput kad');
                return;
            }
            if (!cardCvv) {
                alert('Sila masukkan CVV');
                return;
            }
            if (!cardHolder) {
                alert('Sila masukkan nama pada kad');
                return;
            }
        }

        // If all validations pass, submit the form
        form.submit();
    });
});
</script>

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

                        <!-- Add this hidden input with the current balance -->
                        <input type="hidden" id="current_balance" value="<?= $savings_account->total_balance ?>">

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
                    <form action="/members/view-financial-report" method="POST" class="needs-validation" id="financialReportForm" novalidate>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div class="row g-3">
                            <!-- Report Type Selection -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Jenis Laporan<span class="text-danger">*</span></label>
                                    <select name="report_type" class="form-select form-select-sm" id="reportType" required>
                                        <option value="">Pilih jenis laporan</option>
                                        <option value="monthly">Laporan Bulanan</option>
                                        <option value="yearly">Laporan Tahunan</option>
                                        <option value="custom">Tempoh Tersuai</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Sila pilih jenis laporan
                                    </div>
                                </div>
                            </div>

                            <!-- Date Selection -->
                            <div class="col-md-8">
                                <!-- Monthly Selection -->
                                <div class="form-group date-select" id="monthSelect">
                                    <label class="form-label">Pilih Bulan<span class="text-danger">*</span></label>
                                    <input type="month" name="selected_month" class="form-control form-control-sm" id="selectedMonth">
                                    <div class="invalid-feedback">
                                        Sila pilih bulan
                                    </div>
                                </div>

                                <!-- Yearly Selection -->
                                <div class="form-group date-select" id="yearSelect">
                                    <label class="form-label">Pilih Tahun<span class="text-danger">*</span></label>
                                    <select name="selected_year" class="form-select form-select-sm" id="selectedYear">
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

                                <!-- Custom Date Range -->
                                <div class="form-group date-select" id="customDateSelect">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Dari Tarikh<span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" class="form-control form-control-sm" id="startDate">
                                            <div class="invalid-feedback">
                                                Sila pilih tarikh mula
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Hingga Tarikh<span class="text-danger">*</span></label>
                                            <input type="date" name="end_date" class="form-control form-control-sm" id="endDate">
                                            <div class="invalid-feedback">
                                                Sila pilih tarikh akhir
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Filters -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Transaksi</label>
                                    <select name="transaction_type" class="form-select form-select-sm">
                                        <option value="all">Semua Transaksi</option>
                                        <option value="deposit">Deposit</option>
                                        <option value="transfer">Pengeluaran</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Pinjaman</label>
                                    <select name="loan_type" class="form-select form-select-sm">
                                        <option value="all">Semua Pinjaman</option>
                                        <option value="Pembiayaan_Al_Bai">Pembiayaan Al-Baiubithaman Ajil</option>
                                        <option value="Pembiayaan_Al_Innah">Pembiayaan Bai Al-Inah</option>
                                        <option value="Pembiayaan_Membaikpulih_Kenderaan">Pembiayaan Membaikpulih Kenderaan</option>
                                        <option value="Pembiayaan_Skim_Khas">Skim Khas Pembelajaran</option>
                                        <option value="Pembiayaan_RoadTaxInsuran">Pinjaman Road Tax& Insuran</option>
                                        <option value="Pembiayaan_Al_Qardhul_Hasan">Pinjaman Kecemasan (Al-Qardhul Hasan)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
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
    
    <!-- Updated JavaScript for form validation -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('financialReportForm');
        const reportType = document.getElementById('reportType');
        const monthSelect = document.getElementById('monthSelect');
        const yearSelect = document.getElementById('yearSelect');
        const customDateSelect = document.getElementById('customDateSelect');
        const selectedMonth = document.getElementById('selectedMonth');
        const selectedYear = document.getElementById('selectedYear');
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');

        // Initially hide all date selections
        monthSelect.style.display = 'none';
        yearSelect.style.display = 'none';
        customDateSelect.style.display = 'none';

        // Set default dates for custom date range
        const today = new Date();
        const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        const lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        
        startDate.value = firstDayOfMonth.toISOString().split('T')[0];
        endDate.value = lastDayOfMonth.toISOString().split('T')[0];

        reportType.addEventListener('change', function() {
            // Hide all first
            monthSelect.style.display = 'none';
            yearSelect.style.display = 'none';
            customDateSelect.style.display = 'none';

            // Reset validation
            selectedMonth.required = false;
            selectedYear.required = false;
            startDate.required = false;
            endDate.required = false;

            // Show relevant date selection based on report type
            switch(this.value) {
                case 'monthly':
                    monthSelect.style.display = 'block';
                    selectedMonth.required = true;
                    if (!selectedMonth.value) {
                        selectedMonth.value = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0');
                    }
                    break;
                case 'yearly':
                    yearSelect.style.display = 'block';
                    selectedYear.required = true;
                    if (!selectedYear.value) {
                        selectedYear.value = today.getFullYear();
                    }
                    break;
                case 'custom':
                    customDateSelect.style.display = 'block';
                    startDate.required = true;
                    endDate.required = true;
                    break;
            }
        });

        // Add date validation for custom range
        endDate.addEventListener('change', function() {
            if (startDate.value && this.value) {
                if (new Date(this.value) < new Date(startDate.value)) {
                    this.setCustomValidity('End date must be after start date');
                } else {
                    this.setCustomValidity('');
                }
            }
        });

        startDate.addEventListener('change', function() {
            if (endDate.value && this.value) {
                if (new Date(endDate.value) < new Date(this.value)) {
                    endDate.setCustomValidity('End date must be after start date');
                } else {
                    endDate.setCustomValidity('');
                }
            }
        });

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    </script>

    <!-- Pay Fees Modal -->
<div class="modal fade" id="payFeesModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-success-subtle">
                <div class="d-flex align-items-center">
                    <div class="modal-icon me-3">
                        <i class="fas fa-credit-card text-success"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0">Bayar Yuran</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="payFeesForm" action="/members/pay_fees" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    
                    <!-- Amount Display
                    <div class="amount-display mb-4">
                        <label class="form-label">Jumlah Bayaran</label>
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-light">RM</span>
                            <input type="text" 
                                   class="form-control form-control-lg border-0 bg-light" 
                                   value="<?= number_format($total, 2) ?>" 
                                   readonly>
                        </div>
                    </div>
                     -->

                    <!-- Agreement Checkbox -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="payrollDeductionAgreement" 
                                   name="payroll_agreement" 
                                   required
                                   <?= ($saving_account['potongan_gaji'] == 1) ? 'checked disabled' : '' ?>>
                            <label class="form-check-label" for="payrollDeductionAgreement">
                                Saya bersetuju untuk membayar yuran melalui potongan gaji
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            Sahkan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add this JavaScript for form validation and redirect -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payFeesForm');
    const agreementCheckbox = document.getElementById('payrollDeductionAgreement');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        if (!agreementCheckbox.checked) {
            alert('Sila tandakan kotak persetujuan untuk potongan gaji');
            return;
        }
        
        // Regular form submission instead of fetch
        form.submit();
    });
});
</script>

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
                        <img src="/images/QR.jpg" alt="QR Code" class="qr-code" style="max-width: 70px; cursor: pointer;" onclick="openQRModal(this.src)">
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

            // Show relevant date selection based on report type
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
    
<!-- Add this script for form validation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const transferForm = document.querySelector('form[action="/members/request-transfer"]');
        const amountInput = transferForm.querySelector('input[name="amount"]');
        const currentBalance = parseFloat(document.getElementById('current_balance').value);
        
        // Create error message element with proper styling and positioning
        const errorDiv = document.createElement('div');
        errorDiv.style.color = 'red';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '0.25rem';
        errorDiv.style.display = 'block'; // Force new line
        errorDiv.style.width = '100%'; // Full width
        
        // Insert error div after the input's parent div (input-group)
        const inputGroup = amountInput.closest('.input-group');
        inputGroup.parentNode.insertBefore(errorDiv, inputGroup.nextSibling);

        // Validate amount on input
        amountInput.addEventListener('input', function() {
            const amount = parseFloat(this.value);
            if (amount > currentBalance) {
                errorDiv.textContent = `Baki tidak mencukupi. Baki semasa anda ialah RM ${currentBalance.toFixed(2)}`;
                this.setCustomValidity('Insufficient funds');
            } else {
                errorDiv.textContent = '';
                this.setCustomValidity('');
            }
        });

        // Prevent form submission if amount exceeds balance
        transferForm.addEventListener('submit', function(e) {
            const amount = parseFloat(amountInput.value);
            if (amount > currentBalance) {
                e.preventDefault();
                errorDiv.textContent = `Baki tidak mencukupi. Baki semasa anda ialah RM ${currentBalance.toFixed(2)}`;
                amountInput.focus();
            }
        });
    });
    </script>

    <!-- Add QR Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <img src="" id="modalQRImage" class="img-fluid" alt="QR Code Large">
                    <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add QR click handler script -->
    <script>
    function openQRModal(imgSrc) {
        document.getElementById('modalQRImage').src = imgSrc;
        new bootstrap.Modal(document.getElementById('qrModal')).show();
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
                <?php
                // Get member data from the session or database
                $memberModel = new \App\Models\Member();
                $memberData = $memberModel->getPendingRegistration($_SESSION['user_id']);
                $memberName = $memberData ? htmlspecialchars($memberData['name']) : 'Nama Pengguna';
                ?>
                <div class="user-name"><?= $memberName ?></div>
                <a href="/logout" class="btn btn-success">Log Keluar</a>
            </div>
        </div>

        <!-- Scrollable Content -->
        <div class="sidebar-scrollable">
            <!-- Profile Section -->
            <div class="dropdown-header">
                <i class="fas fa-user"></i> Profil
            </div>
            <a class="dropdown-item" href="/members/profile">
                <i class="fas fa-id-card"></i>
                <span>Lihat Profil</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <!-- Dashboard Section -->
            <div class="dropdown-header">
                <i class="fas fa-th-large"></i> Papan Pemuka
            </div>
            <a class="dropdown-item" href="/members/dashboard">
                <i class="fas fa-clipboard-list"></i>
                <span>Status Permohonan</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <!-- Finance Section -->
            <div class="dropdown-header">
                <i class="fas fa-wallet"></i> Kewangan
            </div>
            <a class="dropdown-item" href="/members/saving_acc">
                <i class="fas fa-piggy-bank"></i>
                <span>Akaun Simpanan</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>
        </div>
    </div>
</div>

<script>
function toggleProfileSidebar() {
    const sidebar = document.getElementById('profileSidebar');
    sidebar.classList.toggle('active');
}

// Close sidebar when clicking outside
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('profileSidebar');
    const profileButton = document.querySelector('.nav-link[onclick*="toggleProfileSidebar"]');
    
    if (!sidebar.contains(event.target) && event.target !== profileButton && !profileButton.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');
    
    // Smooth scroll function
    function smoothScroll(target) {
        const element = document.querySelector(target);
        const headerOffset = 100; // Adjust based on your fixed header height
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }

    // Add click handlers to nav links
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('href');
            smoothScroll(target);
            
            // Update active state
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Update active state on scroll
    window.addEventListener('scroll', function() {
        const sections = ['yuran-section', 'transaksi-section', 'laporan-section'];
        let current = '';

        sections.forEach(section => {
            const element = document.getElementById(section);
            const rect = element.getBoundingClientRect();
            
            if (rect.top <= 150 && rect.bottom >= 150) {
                current = '#' + section;
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === current) {
                link.classList.add('active');
            }
        });
    });
});
</script>

