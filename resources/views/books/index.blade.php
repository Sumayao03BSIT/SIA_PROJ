<!DOCTYPE html>
<html>
<head>
    <title>Books List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include the html5-qrcode library -->
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        /* Add custom CSS for background image */
        body {
            background-image: url('https://wallpapercave.com/wp/mEF1kPI.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        /* Add additional styling if needed */
        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Example: semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
        }
        h2, th, td {
            color: white; /* Set text color to white */
        }
        .btn, .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            color: black; /* Set button text color to black for contrast */
        }
        .btn-info, .btn-danger {
            color: white; /* Ensure button text for info and danger buttons is white */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Books List</h2>
    <a href="{{ route('books.export') }}" class="btn btn-success mb-2">Export to CSV</a>
    <a href="{{ route('books.import.view') }}" class="btn btn-primary mb-2">Import from CSV</a>
    <a href="{{ route('books.qrcode.view') }}" class="btn btn-primary mb-2">QrCode Scanner</a>
    <div id="qr-reader" style="width: 500px;"></div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>
                        <a href="{{ route('books.qrcode', $book->id) }}" class="btn btn-info">Generate QR Code</a>
                        <a href="{{ route('books.pdf', $book->id) }}" class="btn btn-danger">Generate PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- QR Code Scanner Script -->
<script>
    document.getElementById('start-scanner').addEventListener('click', function() {
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            // Handle the scanned result here
            alert(`QR Code detected: ${decodedText}`);
            // Redirect to the detected URL if it's a valid route
            if (decodedText.startsWith(window.location.origin)) {
                window.location.href = decodedText;
            }
        };

        const qrCodeErrorCallback = (errorMessage) => {
            // Handle the error here
            console.log(`QR Code scan error: ${errorMessage}`);
        };

        const html5QrCode = new Html5Qrcode("qr-reader");
        html5QrCode.start(
            { facingMode: "environment" }, // Use the back camera
            {
                fps: 10, // Frame rate per second
                qrbox: { width: 250, height: 250 } // QR code scanning box
            },
            qrCodeSuccessCallback,
            qrCodeErrorCallback
        ).catch((err) => {
            // Start failed, handle it here
            console.error(`Unable to start QR Code scanner: ${err}`);
        });
    });
</script>
</body>
</html>

