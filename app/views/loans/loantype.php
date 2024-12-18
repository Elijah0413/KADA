<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Types</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .header {
            text-align: center;
            padding: 40px 0;
            background-color: #ffffff;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 2.5rem;
        }

        .loans-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Changed to 2 columns */
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .loan-container {
            background-color: #ffffff;
            border: none;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
            height: 100%; /* Ensure same height */
            display: flex;
            flex-direction: column;
        }

        .loan-container:hover {
            transform: translateY(-5px);
        }

        .loan-container h2 {
            color: #2c3e50;
            margin: 0 0 15px 0;
            font-size: 1.5rem;
            min-height: 3rem; /* Ensure title heights are consistent */
            display: flex;
            align-items: center;
        }

        .loan-container p {
            margin: 10px 0;
            color: #666;
            font-size: 1.1rem;
        }

        .loan-features {
            margin: 15px 0;
            padding: 0;
            list-style: none;
            flex-grow: 1; /* Allow features list to expand */
        }

        .loan-features li {
            margin: 8px 0;
            color: #666;
            display: flex;
            align-items: center;
            padding-left: 25px;
            position: relative;
        }

        .loan-features li:before {
            content: "✓";
            color: #2ecc71;
            position: absolute;
            left: 0;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: auto; /* Push buttons to bottom */
        }

        .apply-button, .learn-more-button {
            flex: 1;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-weight: 600;
            text-align: center;
        }

        .apply-button {
            background-color: #2ecc71;
            color: white;
        }

        .apply-button:hover {
            background-color: #27ae60;
        }

        .learn-more-button {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        .learn-more-button:hover {
            background-color: #bdc3c7;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .loans-grid {
                grid-template-columns: 1fr; /* Single column on mobile */
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Available Loan Types</h1>
    </div>

    <div class="loans-grid">
        <div class="loan-container">
            <h2>Plan AL-BAI'UBITHAMAN AAJIL/BAI AL-INAH</h2>
            <p>Rate: 4.5% p.a.</p>
            <ul class="loan-features">
                <li>Quick approval process</li>
                <li>Flexible repayment terms</li>
                <li>No hidden charges</li>
            </ul>
            <div class="button-group">
                <a href="/registerLoan" class="apply-button">Apply Now</a>
            </div>
        </div>

        <div class="loan-container">
            <h2>Personal Flexi Loan</h2>
            <p>Rate: 4.5% p.a.</p>
            <ul class="loan-features">
                <li>Competitive interest rates</li>
                <li>Flexible loan amount</li>
                <li>Quick disbursement</li>
            </ul>
            <div class="button-group">
                <button class="apply-button" onclick="applyLoan('Personal Flexi Loan')">Apply Now</button>
            
            </div>
        </div>

        <div class="loan-container">
            <h2>Education Assistance Loan</h2>
            <p>Rate: 4.5% p.a.</p>
            <ul class="loan-features">
                <li>Special rates for students</li>
                <li>Extended repayment period</li>
                <li>Grace period available</li>
            </ul>
            <div class="button-group">
                <button class="apply-button" onclick="applyLoan('Education Assistance Loan')">Apply Now</button>
               
            </div>
        </div>

        <div class="loan-container">
            <h2>Business Expansion Loan</h2>
            <p>Rate: 4.5% p.a.</p>
            <ul class="loan-features">
                <li>High loan ceiling</li>
                <li>Customized repayment plans</li>
                <li>Business advisory support</li>
            </ul>
            <div class="button-group">
                <button class="apply-button" onclick="applyLoan('Business Expansion Loan')">Apply Now</button>
               
            </div>
        </div>
    </div>

    <script>
        function applyLoan(loanType) {
            alert(`You have selected to apply for: ${loanType}`);
            // Here you can redirect to an application form or handle further logic
        }

        function learnMore(loanId) {
            const loanInfo = {
                'plan-albai': 'This Islamic financing plan follows Shariah principles...',
                'personal-flexi': 'Our Personal Flexi Loan offers customizable terms...',
                'education': 'Support your educational journey with our specialized loan...',
                'business': 'Grow your business with our comprehensive financing solution...'
            };
            alert(loanInfo[loanId]);
            
        }
    </script>
</body>
</html>