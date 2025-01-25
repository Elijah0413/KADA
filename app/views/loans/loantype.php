<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skim Pembiayaan</title>
    
    <style>
    :root {
        --primary-color: #2B6777;        /* Muted teal */
        --secondary-color: #52AB98;      /* Soft green-blue */
        --background-color: #F2F2F2;     /* Light grey */
        --card-color: #FFFFFF;           /* White */
        --text-primary: #333333;         /* Dark grey for text */
        --text-secondary: #666666;       /* Medium grey for secondary text */
        --accent-color: #52AB98;         /* Same as secondary for consistency */
        --success-color: #52AB98;        /* Check marks */
    }

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
        margin-bottom: 50px;  /* Increased margin */
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

    .loans-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;  /* Increased gap */
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .loan-container {
        background-color: var(--card-color);
        border: none;
        border-radius: 15px;
        padding: 30px;  /* Increased padding */
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border-top: 4px solid var(--secondary-color);
    }

    .loan-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .loan-container h2 {
        color: var(--primary-color);
        margin: 0 0 20px 0;  /* Increased margin */
        font-size: 1.5rem;
        min-height: 3rem;
        display: flex;
        align-items: center;
    }

    .loan-container p {
        margin: 15px 0;  /* Increased margin */
        color: var(--secondary-color);
        font-size: 1.1rem;
        font-weight: 600;
    }

    .loan-features {
        margin: 20px 0;  /* Increased margin */
        padding: 0;
        list-style: none;
        flex-grow: 1;
    }

    .loan-features li {
        margin: 15px 0;  /* Increased margin */
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        padding-left: 25px;
        position: relative;
        font-size: 1.05rem;
    }

    .loan-features li:before {
        content: "✓";
        color: var(--success-color);
        position: absolute;
        left: 0;
        font-weight: bold;
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 25px;  /* Increased margin */
    }

    .learn-more-button {
        flex: 1;
        padding: 14px 24px;  /* Increased padding */
        font-size: 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        font-weight: 600;
        text-align: center;
        background-color: var(--secondary-color);
        color: white;
    }

    .learn-more-button:hover {
        background-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.3);
        z-index: 1000;
        backdrop-filter: blur(4px);
    }

    .modal-content {
        background-color: var(--card-color);
        margin: 5% auto;
        padding: 35px;  /* Increased padding */
        width: 80%;
        max-width: 800px;
        border-radius: 15px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        border-top: 4px solid var(--secondary-color);
    }

    .modal-content h2 {
        color: var(--primary-color);
        margin-bottom: 25px;  /* Increased margin */
        font-size: 1.8rem;
    }

    .modal-content h3 {
        color: var(--secondary-color);
        margin-top: 25px;  /* Increased margin */
        padding-bottom: 12px;
        border-bottom: 2px solid var(--secondary-color);
        font-size: 1.4rem;
    }

    .modal-content p {
        line-height: 1.6;
        color: var(--text-secondary);
        margin: 15px 0;
    }

    .modal-content ul {
        padding-left: 20px;
    }

    .modal-content li {
        margin: 12px 0;
        color: var(--text-secondary);
        line-height: 1.5;
    }

    .close {
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        color: var(--text-secondary);
        transition: all 0.3s ease;
    }

    .close:hover {
        color: var(--primary-color);
    }

    /* Breadcrumb styles */
    .breadcrumb {
        padding: 15px 0;
        margin-bottom: 25px;
    }

    .breadcrumb-item a {
        color: var(--secondary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-color);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .loans-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .modal-content {
            width: 90%;
            margin: 10% auto;
            padding: 25px;
        }

        .header h1 {
            font-size: 2rem;
        }

        .loan-container {
            padding: 25px;
        }
    }
</style>
</head>
<body>
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="display: inline;">
                <li class="breadcrumb-item" style="display: inline;"><a href="/">Laman Utama</a></li>
                <li class="breadcrumb-item" style="display: inline;"> / </li>
                <li class="breadcrumb-item active" aria-current="page" style="display: inline;">Skim Pembiayaan</li>
            </ol>
        </nav>
    </div>
    <div class="header">
        <h1>Skim Pembiayaan Yang Ditawarkan</h1>
    </div>

    <div class="loans-grid">
        <div class="loan-container">
            <h2>Pembiayaan Al Bai</h2>
            <p>Kadar: 4.2% setahun</p>
            <ul class="loan-features">
                <li>Patuh Syariah</li>
                <li>Proses yang telus</li>
                <li>Tiada cagaran diperlukan</li>
            </ul>
            <div class="button-group">
                <button onclick="showDetails('albai')" class="learn-more-button">Maklumat Lanjut</button>
            </div>
        </div>

        <div class="loan-container">
            <h2>Pembiayaan Al Innah</h2>
            <p>Kadar: 4.2% setahun</p>
            <ul class="loan-features">
                <li>Fleksibel untuk pelbagai keperluan</li>
                <li>Proses kelulusan pantas</li>
                <li>Tiada cagaran diperlukan</li>
            </ul>
            <div class="button-group">
                <button onclick="showDetails('alinnah')" class="learn-more-button">Maklumat Lanjut</button>
            </div>
        </div>

        <div class="loan-container">
            <h2>Pembiayaan Skim Khas</h2>
            <p>Kadar: 4.2% setahun</p>
            <ul class="loan-features">
                <li>Untuk keperluan mendesak</li>
                <li>Tempoh bayaran fleksibel</li>
                <li>Proses mudah dan pantas</li>
            </ul>
            <div class="button-group">
                <button onclick="showDetails('skimkhas')" class="learn-more-button">Maklumat Lanjut</button>
            </div>
        </div>

        <div class="loan-container">
            <h2>Pembiayaan Road Tax & Insuran</h2>
            <p>Kadar: 4.2% setahun</p>
            <ul class="loan-features">
                <li>Bayaran ansuran bulanan</li>
                <li>Proses mudah</li>
                <li>Tiada cagaran diperlukan</li>
            </ul>
            <div class="button-group">
                <button onclick="showDetails('roadtax')" class="learn-more-button">Maklumat Lanjut</button>
            </div>
        </div>

        <div class="loan-container">
            <h2>Pembiayaan Al Qardhul Hasan</h2>
            <p>Kadar: 4.2% setahun</p>
            <ul class="loan-features">
                <li>Jaminan 80% saham</li>
                <li>Tanpa faedah</li>
                <li>Untuk bantuan segera</li>
            </ul>
            <div class="button-group">
                <button onclick="showDetails('qardhulhasan')" class="learn-more-button">Maklumat Lanjut</button>
            </div>
        </div>
    </div>

    <div id="loanModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle"></h2>
            <div id="modalContent"></div>
        </div>
    </div>

    <script>
        const loanInfo = {
            'albai': {
                title: 'Pembiayaan_Al_Bai',
                content: `
                    <h3>Definisi:</h3>
                    <p>Pembiayaan ini menggunakan prinsip jual beli mengikut Syariah Islam. Dalam pembiayaan ini, koperasi akan membeli aset yang diminta oleh peminjam, seperti kenderaan, peralatan, atau aset lain, dan kemudian menjual semula aset tersebut kepada peminjam dengan harga yang termasuk kadar keuntungan yang telah ditetapkan.</p>
                    
                    <h3>Tujuan:</h3>
                    <p>Pembiayaan ini bertujuan untuk memenuhi keperluan peminjam yang ingin membeli aset tertentu tetapi tidak mampu membayar secara tunai.</p>
                    
                    <h3>Ciri-ciri Utama:</h3>
                    <ul>
                        <li>Mematuhi prinsip Syariah, menjadikannya pilihan yang sesuai untuk mereka yang ingin berurusan secara patuh Syariah.</li>
                        <li>Proses yang telus, di mana kadar keuntungan dinyatakan dengan jelas sebelum perjanjian dimeterai.</li>
                        <li>Tiada kolateral diperlukan, menjadikannya lebih mudah diakses oleh ahli koperasi.</li>
                        <li>Sekiranya peminjam gagal membayar ansuran, tindakan undang-undang boleh dikenakan kepada penjamin yang telah dinamakan dalam perjanjian pinjaman.</li>
                    </ul>`
            },
            'alinnah': {
                title: 'Pembiayaan Al Innah',
                content: `
                    <h3>Definisi:</h3>
                    <p>Pembiayaan ini melibatkan transaksi jual beli aset antara koperasi dan peminjam berdasarkan konsep tawar-menawar yang dibenarkan dalam Islam. Peminjam akan membeli semula aset daripada koperasi secara ansuran dengan harga yang termasuk keuntungan koperasi.</p>
                    
                    <h3>Tujuan:</h3>
                    <p>Pembiayaan ini lebih fleksibel dan tidak terhad kepada pembelian aset tertentu. Ia boleh digunakan untuk pelbagai keperluan kewangan seperti membayar hutang, menampung perbelanjaan peribadi, atau menambah modal perniagaan kecil.</p>
                    
                    <h3>Ciri-ciri Utama:</h3>
                    <ul>
                        <li>Memberikan penyelesaian kewangan segera kepada ahli koperasi.</li>
                        <li>Transaksi pinjaman direkodkan dengan teliti untuk memastikan ketelusan.</li>
                        <li>Walaupun tiada cagaran diperlukan, penjamin diperlukan sebagai langkah keselamatan.</li>
                    </ul>`
            },
            'Pembiayaan_Skim_Khas': {
                title: 'Pembiayaan Skim Khas',
                content: `
                    <h3>Definisi:</h3>
                    <p>Pembiayaan ini disediakan untuk situasi khas atau mendesak seperti pendidikan, pembaikan rumah, kos perubatan, atau untuk memulakan perniagaan kecil. Ia direka khas untuk membantu ahli koperasi mencapai kestabilan kewangan dalam situasi tertentu.</p>
                    
                    <h3>Tujuan:</h3>
                    <p>Membantu ahli koperasi yang menghadapi cabaran kewangan yang memerlukan sokongan segera dan spesifik.</p>
                    
                    <h3>Ciri-ciri Utama:</h3>
                    <ul>
                        <li>Proses permohonan yang mudah dan pantas.</li>
                        <li>Tempoh bayaran balik yang fleksibel berdasarkan keperluan peminjam.</li>
                        <li>Bebas daripada keperluan cagaran, menjadikannya lebih inklusif.</li>
                        <li>Penjamin tetap bertanggungjawab sekiranya peminjam gagal melunaskan pinjaman.</li>
                    </ul>`
            },
            'roadtax': {
                title: 'Pembiayaan Cukai Jalan & Insurans',
                content: `
                    <h3>Definisi:</h3>
                    <p>Pembiayaan ini bertujuan membantu ahli koperasi untuk membayar cukai jalan dan insurans kenderaan mereka secara ansuran. Ia direka untuk meringankan beban kewangan yang biasanya datang secara sekaligus setiap tahun.</p>
                    
                    <h3>Tujuan:</h3>
                    <p>Menyediakan kemudahan kewangan yang membolehkan ahli koperasi memperbaharui cukai jalan dan insurans tanpa perlu membayar jumlah penuh secara tunai.</p>
                    
                    <h3>Ciri-ciri Utama:</h3>
                    <ul>
                        <li>Pembayaran balik dibuat secara ansuran bulanan yang tetap.</li>
                        <li>Dapat membantu peminjam memastikan kenderaan mereka mematuhi peraturan undang-undang.</li>
                        <li>Kadar keuntungan tetap sama seperti pembiayaan lain.</li>
                        <li>Tiada kolateral diperlukan, namun penjamin bertanggungjawab sekiranya berlaku kegagalan pembayaran.</li>
                    </ul>`
            },
            'qardhulhasan': {
                title: 'Pembiayaan Al Qardhul Hasan',
                content: `
                    <h3>Definisi:</h3>
                    <p>Pembiayaan ini adalah pembiayaan tanpa faedah yang diberikan kepada ahli koperasi berdasarkan prinsip tolong-menolong dan amal. Jumlah pembiayaan yang diberikan dijamin oleh 80% daripada saham yang dimiliki oleh peminjam dalam koperasi.</p>
                    
                    <h3>Tujuan:</h3>
                    <p>Membantu ahli koperasi yang memerlukan bantuan kewangan segera tanpa membebankan mereka dengan keuntungan tambahan.</p>
                    
                    <h3>Ciri-ciri Utama:</h3>
                    <ul>
                        <li>Tiada kadar keuntungan dikenakan; peminjam hanya perlu membayar jumlah pokok.</li>
                        <li>Saham ahli digunakan sebagai jaminan, memberikan perlindungan kepada koperasi.</li>
                        <li>Menunjukkan semangat koperasi yang menekankan kerjasama dan bantuan sesama ahli.</li>
                        <li>Penjamin tetap diperlukan untuk memastikan tanggungjawab pembayaran.</li>
                    </ul>`
            }
        };

        function showDetails(loanType) {
            const modal = document.getElementById('loanModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            
            modalTitle.textContent = loanInfo[loanType].title;
            modalContent.innerHTML = loanInfo[loanType].content;
            modal.style.display = 'block';
        }

        // Close modal when clicking the X
        document.querySelector('.close').onclick = function() {
            document.getElementById('loanModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('loanModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>