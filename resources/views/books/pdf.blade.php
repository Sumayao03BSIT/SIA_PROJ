<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Book Details</h1>
    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>

    <!-- Display the QR code -->
    <div class="qr-code">
        <h2>QR Code</h2>
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
</body>
</html>
