<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .journal-container {
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .highlight {
            background-color: #ffff99;
            font-weight: bold;
        }
        .downloads {
            margin-top: 20px;
        }
        .references a {
            color: #007bff;
            text-decoration: none;
        }
        .references a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="journal-container">
        <h1 class="text-center">THE POTENTIAL OF SECANG WOOD DECOCTION AS AN ODOR CONTROL FOR DIABETIC FOOT ULCER</h1>
        <p class="text-center text-muted">POTENSI AIR REBUSAN KAYU SECANG SEBAGAI PENGONTROL BAU ULKUS KAKI DIABETIK</p>
        <hr>
        <h5>Authors:</h5>
        <p>Kurnia Harli, Irfan, Nur Auliyah Febriani, Siti Fatimah Azahra, Ikram Bauk, Aco Mursyid</p>
        <p>Universitas Sulawesi Barat (ID)</p>
        <h5 class="highlight">ABSTRACT</h5>
        <p>Diabetic foot ulcers are a serious complication that can significantly affect the quality of life for individuals with diabetes...</p>
        <div class="downloads">
            <h5>Downloads</h5>
            <canvas id="downloadsChart"></canvas>
        </div>
        <div class="references mt-4">
            <h5>REFERENCES</h5>
            <ul>
                <li>Farhana, H., Maulana, I. T., & Kodir, R. A. (2015). Perbandingan Pengaruh Suhu dan Waktu Perebusan Terhadap Kandungan Brazilin Pada Kayu Secang (Caesalpinia Sappan Linn.).</li>
                <li><a href="https://doi.org/10.1002/14651858.CD003861.PUB3" target="_blank">Fernandez, R., & Griffiths, R. (2012). Water for wound cleansing.</a></li>
                <li><a href="https://doi.org/10.1016/S0140-6736(05)65862-X" target="_blank">Haughton, W., & Young, T. (1996). Common problems in wound care.</a></li>
            </ul>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('downloadsChart').getContext('2d');
    const downloadsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb'],
            datasets: [{
                label: 'Downloads',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 45, 40],
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
