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
            border-radius: var(--radius);
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
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
            height: 400px;
            margin: 20px 0;
        }

        .gender-chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px;
            max-width: 600px;
            margin: 20px auto;
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
            /* General print settings */
            body {
                background: white;
                margin: 0;
                padding: 20px;
            }

            .report-container {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            /* Hide elements not needed in print */
            .back-button,
            .print-button,
            .month-selector {
                display: none !important;
            }

            /* Adjust header for print */
            .report-header {
                background: none !important;
                color: black !important;
                padding: 0 0 20px 0 !important;
                margin-bottom: 30px !important;
                box-shadow: none !important;
                border-bottom: 2px solid #000 !important;
            }

            .report-title {
                color: black !important;
                text-shadow: none !important;
            }

            .report-date {
                color: black !important;
            }

            /* Adjust stat cards for print */
            .stat-card {
                break-inside: avoid;
                background: none !important;
                border: 1px solid #000 !important;
                margin-bottom: 20px !important;
                page-break-inside: avoid;
                box-shadow: none !important;
            }

            /* Ensure charts print properly */
            .chart-container {
                break-inside: avoid;
                page-break-inside: avoid;
                margin-bottom: 30px !important;
            }

            /* Remove hover effects */
            .stat-card:hover {
                transform: none !important;
                box-shadow: none !important;
            }

            /* Ensure text is black for print */
            .stat-card .card-title,
            .stat-card .stat-value,
            .stat-card .stat-subtitle {
                color: black !important;
            }

            /* Add page breaks where needed */
            .report-section {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            /* Remove gradients and backgrounds */
            .stat-card.bg-primary,
            .stat-card.bg-success,
            .stat-card.bg-info {
                background: white !important;
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
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card bg-primary text-white">
                        <h3 class="card-title">Jumlah Permohonan Pinjaman</h3>
                        <div class="stat-value"><?= $loanStats['total'] ?? 0 ?></div>
                        <div class="stat-subtitle">
                            Nilai: RM <?= number_format($loanStats['total_amount'] ?? 0, 2) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-success text-white">
                        <h3 class="card-title">Jumlah Permohonan Pindahan Wang</h3>
                        <div class="stat-value"><?= $withdrawalStats['total'] ?? 0 ?></div>
                        <div class="stat-subtitle">
                            Nilai: RM <?= number_format($withdrawalStats['total_amount'] ?? 0, 2) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-info text-white">
                        <h3 class="card-title">Jumlah Permohonan Ahli</h3>
                        <div class="stat-value"><?= $memberStats['total_applications'] ?? 0 ?></div>
                        <div class="stat-subtitle">
                            Aktif: <?= $memberStats['approved_members'] ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Statistics -->
        <div class="report-section">
            <h2 class="section-title">Analisis Pinjaman</h2>
            <div class="mb-3">
                <select id="monthSelector" class="form-select" style="width: 200px;">
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
            <div class="chart-container">
                <canvas id="withdrawalChart"></canvas>
            </div>
        </div>

        <!-- Member Statistics -->
        <div class="report-section">
            <h2 class="section-title">Analisis Keahlian</h2>
            <div class="gender-chart-container">
                <canvas id="genderChart"></canvas>
            </div>
            <div class="gender-percentage">
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
                    scales: {
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
                    scales: {
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

        // Handle month selection change
        document.getElementById('monthSelector').addEventListener('change', async function(e) {
            const selectedMonth = e.target.value;
            try {
                const response = await fetch(`/admin/get-monthly-data/${selectedMonth}`);
                const data = await response.json();
                initializeCharts(data.loanData, data.withdrawalData);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        });
    </script>
</body>
</html> 