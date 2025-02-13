<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Statistik KADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #34495E;
            --accent-color: #16A085;
            --light-bg: #F8F9FA;
            --border-radius: 10px;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .report-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .report-header {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .report-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                rgba(255, 255, 255, 0.1) 0%,
                rgba(255, 255, 255, 0.05) 100%);
            pointer-events: none;
        }

        .report-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-family: "Georgia", serif;
            font-style: italic;
            font-weight: normal;
            color: #34495e;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 0;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card .card-title {
            font-size: 0.9rem;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
            font-family: "Georgia", serif;
            color: rgba(0, 0, 0, 0.85);
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: normal;
            margin-bottom: 0.5rem;
            font-family: "Georgia", serif;
            color: rgba(0, 0, 0, 0.9);
        }

        .stat-card .stat-subtitle {
            font-size: 0.9rem;
            font-family: "Georgia", serif;
            color: rgba(0, 0, 0, 0.75);
        }

        .stat-card.bg-primary {
            background: linear-gradient(135deg, #e1f0ff, #bbdefb);
        }

        .stat-card.bg-success {
            background: linear-gradient(135deg, #e0f2f1, #b2dfdb);
        }

        .stat-card.bg-info {
            background: linear-gradient(135deg, #e8eaf6, #c5cae9);
        }

        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
            margin: 20px 0;
        }

        .gender-chart-container {
            max-width: 600px;
            height: 350px;
            margin: 0 auto;
            position: relative;
        }

        .gender-percentage {
            max-width: 600px;
            margin: 1rem auto;
            text-align: center;
        }

        .row.justify-content-center {
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-6, .col-lg-3 {
            padding-right: 15px;
            padding-left: 15px;
        }

        .g-4 {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 1.5rem;
        }

        .h-100 {
            height: 100% !important;
        }

        .text-center {
            text-align: center !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .print-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .print-button:hover {
            background-color: #128C7E;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        @media print {
            @page {
                margin: 0.75in !important;  /* Equal margins on all sides */
                size: portrait !important;
            }

            .report-container {
                width: 100% !important;
                margin: 0 auto !important;
                padding: 0 !important;
            }

            .report-section {
                width: 100% !important;
                margin: 30px 0 !important;
                padding: 1.5rem !important;
                border: 1px solid #ddd !important;
                background-color: white !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* Make graphs larger and clearer */
            .chart-container {
                height: 400px !important;      /* Increased height */
                width: 100% !important;
                margin: 20px 0 !important;
                padding: 10px !important;
            }

            /* Improve chart rendering */
            canvas {
                height: 100% !important;
                width: 100% !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Better dropdown positioning */
            .form-select {
                width: 200px !important;
                margin-bottom: 15px !important;
                margin-left: 0 !important;     /* Align with section edge */
            }

            /* Improve section title clarity */
            .section-title {
                font-size: 1.5rem !important;
                margin-bottom: 1.5rem !important;
                padding-bottom: 0.5rem !important;
                border-bottom: 2px solid var(--accent-color) !important;
                color: black !important;
                clear: both !important;
            }

            /* Ensure proper spacing between sections */
            .report-section + .report-section {
                margin-top: 40px !important;
            }

            /* Force high-quality printing */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .report-header,
            .report-header + .report-section {  /* This targets the Ringkasan Eksekutif section */
                position: static !important;
                margin-top: 0 !important;
                padding-top: 0 !important;
                background: white !important;
                transform: none !important;
                page-break-after: avoid !important;
                break-after: avoid !important;
            }

            /* Keep header and first section together */
            .report-header,
            .report-header + .report-section {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* Force page break after first section */
            .report-header + .report-section {
                page-break-after: always !important;
                break-after: always !important;
            }

            .report-header::before {
                display: none !important;
            }

            /* Remove any fixed positioning and floating elements */
            .back-button,
            .print-button {
                display: none !important;
                position: static !important;
            }

            /* Force all content to be positioned statically */
            * {
                position: static !important;
                float: none !important;
                overflow: visible !important;
            }

            /* Ensure the header prints properly */
            .report-header {
                background: none !important;
                color: black !important;
                padding: 20px !important;
                margin-bottom: 20px !important;
                box-shadow: none !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* Ensure proper page breaks */
            .report-section {
                background: white !important;
                margin-bottom: 20px !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                border: 1px solid #ddd !important;
                position: relative !important;
                width: 100% !important;
                overflow: visible !important;
            }

            .section-title {
                color: black !important;
                border-bottom: 2px solid var(--accent-color) !important;
                padding-bottom: 0.5rem !important;
                margin-bottom: 1.5rem !important;
                width: 100% !important;
                display: block !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Ensure chart containers don't overflow their borders */
            .chart-container {
                max-height: 300px !important;
                margin: 30px 0 !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            .gender-chart-container {
                max-width: 350px !important;
                height: 250px !important;
                margin: 30px auto !important;
            }

            /* Ensure proper text spacing around charts */
            .section-title {
                margin-bottom: 30px !important;
            }

            .gender-percentage {
                margin-top: 30px !important;
            }

            /* Ensure charts scale properly */
            canvas {
                max-width: 100% !important;
                height: auto !important;
            }

            /* Ensure stat cards print properly */
            .stat-card {
                border: 1px solid #ddd !important;
                margin-bottom: 15px !important;
                background: white !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* Ensure text is visible */
            .stat-card .card-title,
            .stat-card .stat-value,
            .stat-card .stat-subtitle,
            .section-title,
            .report-title,
            .report-date {
                color: black !important;
            }

            /* Adjust executive summary layout */
            .report-section:first-of-type {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                margin-top: 20px !important;
            }

            /* Make the stat cards more compact */
            .row.justify-content-center.g-4 {
                gap: 0.5rem !important;
            }

            .stat-card {
                padding: 1rem !important;
                margin-bottom: 0.5rem !important;
                min-height: auto !important;
            }

            .stat-card .card-title {
                font-size: 0.8rem !important;
                margin-bottom: 0.5rem !important;
            }

            .stat-card .stat-value {
                font-size: 1.5rem !important;
                margin-bottom: 0.25rem !important;
            }

            .stat-card .stat-subtitle {
                font-size: 0.8rem !important;
            }

            /* Adjust spacing for header */
            .report-header {
                padding: 1.5rem !important;
                margin-bottom: 1rem !important;
            }

            .report-title {
                font-size: 2rem !important;
                margin-bottom: 0.5rem !important;
            }

            .report-date {
                font-size: 0.9rem !important;
            }

            /* Ensure proper spacing */
            .section-title {
                margin-bottom: 1rem !important;
            }

            /* Force the executive summary to stay on one page */
            .report-header,
            .report-header + .report-section {
                page-break-after: auto !important;
                break-after: auto !important;
            }
        }

        .summary-box {
            background: #F8F9FA;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .trend-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 15px;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }

        .trend-up {
            background-color: #D4EDDA;
            color: #155724;
        }

        .trend-down {
            background-color: #F8D7DA;
            color: #721C24;
        }

        .report-title {
            font-size: 2.5rem;
            font-weight: normal;
            color: white;
            margin-bottom: 0.75rem;
            font-style: italic;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            font-family: "Georgia", serif;
        }

        @media print {
            .report-title {
                font-size: 2.5rem !important;
                color: black !important;
                text-shadow: none !important;
            }
        }

        .report-date {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            margin: 0;
            font-weight: 300;
            font-family: "Georgia", serif;
            letter-spacing: 0.5px;
        }

        @media print {
            .report-date {
                color: black !important;
                font-family: "Georgia", serif !important;
                letter-spacing: 0.5px !important;
            }
        }

        .back-button {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            backdrop-filter: blur(5px);
            font-family: "Georgia", serif;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            text-decoration: none;
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        .back-button .icon {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Report Header -->
        <div class="report-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="report-title">Laporan Statistik Koperasi KADA</h1>
                    <p class="report-date">Dijana pada: <?php 
                        date_default_timezone_set('Asia/Kuala_Lumpur');
                        echo date('d/m/Y H:i', time());
                    ?></p>
                </div>
                <div>
                    <a href="/admins" class="back-button">
                        <i class="bi bi-arrow-left icon"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Executive Summary -->
        <div class="report-section">
            <h2 class="section-title">Ringkasan Eksekutif</h2>
            <div class="row justify-content-center g-4">
                <!-- Loan Applications -->
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card bg-primary text-white h-100">
                        <h3 class="card-title">Jumlah Permohonan Pinjaman</h3>
                        <div class="stat-value"><?= $loanStats['total'] ?? 0 ?></div>
                        <div class="stat-subtitle">
                            Nilai: RM <?= number_format($loanStats['total_amount'] ?? 0, 2) ?>
                        </div>
                    </div>
                </div>
                <!-- Withdrawal Applications -->
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card bg-success text-white h-100">
                        <h3 class="card-title">Jumlah Permohonan Pindahan Wang</h3>
                        <div class="stat-value"><?= $withdrawalStats['total'] ?? 0 ?></div>
                        <div class="stat-subtitle">
                            Nilai: RM <?= number_format($withdrawalStats['total_amount'] ?? 0, 2) ?>
                        </div>
                    </div>
                </div>
                <!-- Member Applications -->
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card bg-info text-white h-100">
                        <h3 class="card-title">Jumlah Permohonan Ahli</h3>
                        <div class="stat-value"><?= $memberStats['total_applications'] ?? 0 ?></div>
                        <div class="stat-subtitle">
                            Berjaya: <?= $memberStats['approved_members'] ?? 0 ?>
                        </div>
                    </div>
                </div>
                <!-- Termination Applications -->
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card bg-info text-white h-100">
                        <h3 class="card-title">Jumlah Permohonan Penamatan Keahlian</h3>
                        <div class="stat-value"><?= $terminationStats['total_applications'] ?? 0 ?></div>
                        <div class="stat-subtitle">
                            Berjaya: <?= $terminationStats['approved_terminations'] ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Statistics -->
        <div class="report-section">
            <h2 class="section-title">Analisis Pinjaman</h2>
            <div class="mb-3">
                <select id="loanMonthSelector" class="form-select" style="width: 200px;">
                    <?php foreach ($availableMonths as $month): ?>
                        <option value="<?= $month['month_year'] ?>">
                            <?= $month['month_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="chart-container">
                <canvas id="loanChart"></canvas>
            </div>
        </div>

        <!-- Withdrawal Statistics -->
        <div class="report-section">
            <h2 class="section-title">Analisis Pengeluaran</h2>
            <div class="mb-3">
                <select id="withdrawalMonthSelector" class="form-select" style="width: 200px;">
                    <?php foreach ($availableMonths as $month): ?>
                        <option value="<?= $month['month_year'] ?>">
                            <?= $month['month_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="chart-container">
                <canvas id="withdrawalChart"></canvas>
            </div>
        </div>

        <!-- Member Statistics -->
        <div class="report-section">
            <h2 class="section-title">Analisis Permohonan Keahlian</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="gender-chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                    <div class="gender-percentage text-center mt-3">
                        <?php 
                        // Initialize male and female counts
                        $male_count = 0;
                        $female_count = 0;

                        // Calculate male and female counts from gender distribution
                        if (!empty($memberStats['gender_distribution'])) {
                            foreach ($memberStats['gender_distribution'] as $gender) {
                                if (strtolower($gender['gender']) == 'lelaki') {
                                    $male_count = $gender['total'];
                                } else if (strtolower($gender['gender']) == 'perempuan') {
                                    $female_count = $gender['total'];
                                }
                            }
                        }

                        // Calculate total from the actual gender counts
                        $total_members = $male_count + $female_count;
                        $male_percentage = $total_members > 0 ? ($male_count / $total_members) * 100 : 0;
                        $female_percentage = $total_members > 0 ? ($female_count / $total_members) * 100 : 0;
                        ?>
                        <p><strong>Jumlah Lelaki:</strong> <?= $male_count ?> (<?= number_format($male_percentage, 2) ?>%)</p>
                        <p><strong>Jumlah Perempuan:</strong> <?= $female_count ?> (<?= number_format($female_percentage, 2) ?>%)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Membership Termination Statistics -->
        <div class="report-section">
            <h2 class="section-title">Analisis Permohonan Penamatan Keahlian</h2>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <h4 class="mb-3">Status Penamatan Keahlian Tahun <?= date('Y') ?></h4>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Status</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pencen</td>
                                    <td><?= $terminationStats['retired_count'] ?? 0 ?></td>
                                </tr>
                                <tr>
                                    <td>Pencen Awal</td>
                                    <td><?= $terminationStats['early_retired_count'] ?? 0 ?></td>
                                </tr>
                                <tr>
                                    <td>Lain-lain</td>
                                    <td><?= $terminationStats['others_count'] ?? 0 ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="summary-box mt-3">
                        <p class="mb-2"><strong>Jumlah Keseluruhan Ahli yang berjaya menamatkan keahlian:</strong> 
                            <?= ($terminationStats['retired_count'] ?? 0) + 
                                ($terminationStats['early_retired_count'] ?? 0) + 
                                ($terminationStats['others_count'] ?? 0) ?>
                        </p>
                        <small class="text-muted">* Data dikemaskini sehingga <?= date('d/m/Y') ?></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Button -->
        <button onclick="window.print()" class="print-button">
            <i class="bi bi-printer-fill me-2"></i>Cetak Laporan
        </button>
    </div>

    <script>
        // Chart configurations
        Chart.defaults.font.family = "'Segoe UI', sans-serif";
        Chart.defaults.font.size = 13;

        // Gender Distribution Chart
        new Chart(document.getElementById('genderChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Lelaki', 'Perempuan'],
                datasets: [{
                    data: [
                        <?php 
                        $male_count = 0;
                        $female_count = 0;
                        foreach ($memberStats['gender_distribution'] as $gender) {
                            if (strtolower($gender['gender']) == 'lelaki') {
                                $male_count = $gender['total'];
                            } else if (strtolower($gender['gender']) == 'perempuan') {
                                $female_count = $gender['total'];
                            }
                        }
                        echo $male_count . ',' . $female_count;
                        ?>
                    ],
                    backgroundColor: [
                        '#2E86C1',  // Blue for Lelaki
                        '#FF69B4'   // Pink for Perempuan
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: { size: 14 }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Taburan Jantina Ahli',
                        font: { size: 16, weight: 'bold' }
                    }
                }
            }
        });

        // Loan and Withdrawal Charts
        let loanChart, withdrawalChart;

        function initializeCharts(loanData, withdrawalData) {
            console.log('Loan Data:', loanData); // Debugging line
            console.log('Withdrawal Data:', withdrawalData); // Debugging line

            // Loan Chart
            const loanCtx = document.getElementById('loanChart').getContext('2d');
            if (loanChart) loanChart.destroy();
            loanChart = new Chart(loanCtx, {
                type: 'bar',
                data: {
                    labels: loanData.map(item => new Date(item.date).toLocaleDateString('ms-MY')),
                    datasets: [{
                        label: 'Jumlah Pinjaman (RM)',
                        data: loanData.map(item => item.amount || 0),
                        backgroundColor: '#2C3E50',
                        yAxisID: 'y1'
                    }, {
                        label: 'Bilangan Permohonan',
                        data: loanData.map(item => item.total || 0),
                        backgroundColor: '#3498DB',
                        type: 'line',
                        yAxisID: 'y2'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 20,
                            bottom: 25  // Increased bottom padding
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                maxRotation: 45,  // Rotate labels
                                minRotation: 45,
                                padding: 10
                            }
                        },
                        y1: {
                            type: 'linear',
                            position: 'left',
                            title: { display: true, text: 'Jumlah (RM)' },
                            ticks: { callback: value => 'RM ' + value.toLocaleString() }
                        },
                        y2: {
                            type: 'linear',
                            position: 'right',
                            title: { display: true, text: 'Bilangan' },
                            grid: { drawOnChartArea: false }
                        }
                    }
                }
            });

            // Withdrawal Chart
            const withdrawalCtx = document.getElementById('withdrawalChart').getContext('2d');
            if (withdrawalChart) withdrawalChart.destroy();
            withdrawalChart = new Chart(withdrawalCtx, {
                type: 'bar',
                data: {
                    labels: withdrawalData.map(item => new Date(item.date).toLocaleDateString('ms-MY')),
                    datasets: [{
                        label: 'Jumlah Pemindahan Wang (RM)',
                        data: withdrawalData.map(item => item.amount || 0),
                        backgroundColor: '#16A085',
                        yAxisID: 'y1'
                    }, {
                        label: 'Bilangan Pemindahan',
                        data: withdrawalData.map(item => item.total || 0),
                        backgroundColor: '#1ABC9C',
                        type: 'line',
                        yAxisID: 'y2'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 20,
                            bottom: 25  // Increased bottom padding
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                maxRotation: 45,  // Rotate labels
                                minRotation: 45,
                                padding: 10
                            }
                        },
                        y1: {
                            type: 'linear',
                            position: 'left',
                            title: { display: true, text: 'Jumlah (RM)' },
                            ticks: { callback: value => 'RM ' + value.toLocaleString() }
                        },
                        y2: {
                            type: 'linear',
                            position: 'right',
                            title: { display: true, text: 'Bilangan' },
                            grid: { drawOnChartArea: false }
                        }
                    }
                }
            });
        }

        // Initialize charts with current data
        initializeCharts(
            <?= json_encode($loanStats['daily_data'] ?? []) ?>, 
            <?= json_encode($withdrawalStats['daily_data'] ?? []) ?>
        );

        // Update event listeners for both dropdowns
        document.getElementById('loanMonthSelector').addEventListener('change', async function(e) {
            const selectedMonth = e.target.value;
            try {
                const response = await fetch(`/admin/get-monthly-data/${selectedMonth}`);
                const data = await response.json();
                initializeCharts(data.loanData, withdrawalChart.data.datasets); // Keep withdrawal data unchanged
            } catch (error) {
                console.error('Error fetching loan data:', error);
            }
        });

        document.getElementById('withdrawalMonthSelector').addEventListener('change', async function(e) {
            const selectedMonth = e.target.value;
            try {
                const response = await fetch(`/admin/get-monthly-data/${selectedMonth}`);
                const data = await response.json();
                initializeCharts(loanChart.data.datasets, data.withdrawalData); // Keep loan data unchanged
            } catch (error) {
                console.error('Error fetching withdrawal data:', error);
            }
        });
    </script>
</body>
</html> 