<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faedah Keahlian</title>
    
    <style>
        :root {
            --primary-color: #2B6777;
            --secondary-color: #52AB98;
            --background-color: #F2F2F2;
            --card-color: #FFFFFF;
            --text-primary: #333333;
            --text-secondary: #666666;
            --accent-color: #52AB98;
        }

        /* Reusing your existing base styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--background-color);
            color: var(--text-primary);
        }

        .header {
            text-align: center;
            padding: 40px 0;
            background-color: var(--primary-color);
            border-radius: 15px;
            margin-bottom: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .header h1 {
            color: white;
            margin: 0;
            font-size: 2.5rem;
            font-weight: 600;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .benefit-card {
            background-color: var(--card-color);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            text-align: center;
            border-top: 4px solid var(--secondary-color);
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .benefit-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .benefit-card h3 {
            color: var(--primary-color);
            margin: 15px 0;
            font-size: 1.3rem;
        }

        .benefit-card p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .info-section {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: var(--card-color);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .info-section h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .info-section ul {
            list-style-type: none;
            padding: 0;
        }

        .info-section li {
            margin: 15px 0;
            padding-left: 25px;
            position: relative;
            color: var(--text-secondary);
        }

        .info-section li:before {
            content: "→";
            color: var(--secondary-color);
            position: absolute;
            left: 0;
        }

        @media (max-width: 968px) {
            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="display: inline;">
                <li class="breadcrumb-item" style="display: inline;"><a href="/members">Laman Utama</a></li>
                <li class="breadcrumb-item" style="display: inline;"> / </li>
                <li class="breadcrumb-item active" aria-current="page" style="display: inline;">Faedah Keahlian</li>
            </ol>
        </nav>
    </div>

    <div class="header">
        <h1>Faedah Keahlian Koperasi</h1>
    </div>

    <div class="benefits-grid">
        <div class="benefit-card">
            <div class="benefit-icon">💰</div>
            <h3>Dividen Tahunan</h3>
            <p>Nikmati dividen tahunan yang menarik berdasarkan jumlah saham anda dalam koperasi.</p>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">💳</div>
            <h3>Kemudahan Pembiayaan</h3>
            <p>Akses kepada pelbagai skim pembiayaan dengan kadar yang kompetitif dan proses yang mudah.</p>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">🏥</div>
            <h3>Bantuan Kesihatan</h3>
            <p>Dapatkan bantuan perubatan dan kesihatan untuk anda dan keluarga.</p>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">📚</div>
            <h3>Bantuan Pendidikan</h3>
            <p>Biasiswa dan bantuan pendidikan untuk anak-anak ahli yang cemerlang.</p>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">🤝</div>
            <h3>Khairat Kematian</h3>
            <p>Bantuan khairat kematian untuk meringankan beban keluarga ahli.</p>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">🎓</div>
            <h3>Program Latihan</h3>
            <p>Akses kepada program latihan dan pembangunan kemahiran.</p>
        </div>
    </div>

    <div class="info-section">
        <h2>Syarat-syarat Kelayakan</h2>
        <ul>
            <li>Warganegara Malaysia berumur 18 tahun ke atas</li>
            <li>Kakitangan kerajaan atau swasta yang tetap</li>
            <li>Minima Modal Sher RM300</li>
            <li>Maksima Modal Sher RM10K</li>
            <li>Minimum Caruman Yuran RM35<li>
            <li>Mengemukakan dokumen yang diperlukan</li>
        </ul>
    </div>
</body>
</html>