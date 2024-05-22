<!DOCTYPE html>
<html>
<head>
    <title>QR Code Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background-image: url('https://wallpapercave.com/wp/mEF1kPI.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .qr-code {
            text-align: center;
            margin-bottom: 20px;
        }
        #qr-canvas {
            display: none;
        }
    </style>
</head>
<body>
    <h1 class="title text-center font-bold text-4xl mb-5">QR Scanner</h1><br>
    <div class="container">
        <div class="scanner">
            <div id='reader'></div> <!-- Removed unnecessary class -->
        </div>
        <div class="result" id='result'></div>
    </div>
</body>
<script src='https://unpkg.com/html5-qrcode' type='text/javascript'></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code matched = ${decodedText}`, decodedResult);
        document.getElementById('result').innerHTML = "<p>Qr Code Result:" + decodedText + "</p>";
        document.getElementById('result').innerHTML += "<button onclick='openWebsite(\"" + decodedText + "\")' class='site-link'>Open Website</button>";
    }
    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    function openWebsite(url) {
        window.open(url, '_blank');
        window.location.href = 'about:blank'; 
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    {fps: 10, qrbox: {width: 250, height: 250}},
    false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
</html>
