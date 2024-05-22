<!DOCTYPE html>
<html>
<head>
    <title>Book QR Code</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS for background image */
        body {
            background-image: url('https://wallpapercave.com/wp/mEF1kPI.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white; /* Make text white for better readability */
        }
        /* Add additional styling if needed */
        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black background */
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
        .table th, .table td {
            color: white; /* Ensure table text is white */
        }
        .btn {
            background-color: #007bff; /* Ensure button color stands out against background */
            border-color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Book Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $book->id }}</td>
        </tr>
        <tr>
            <th>Title</th>
            <td>{{ $book->title }}</td>
        </tr>
        <tr>
            <th>Author</th>
            <td>{{ $book->author }}</td>
        </tr>
        <tr>
            <th>ISBN</th>
            <td>{{ $book->isbn }}</td>
        </tr>
    </table>
    <div class="qr-code">
        <h3>QR Code</h3>
        {!! $qrCode !!}
    </div>
    <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">Back to Book List</a>
</div>
</body>
</html>

