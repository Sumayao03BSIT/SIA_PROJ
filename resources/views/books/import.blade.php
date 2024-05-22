<!DOCTYPE html>
<html>
<head>
    <title>Import Books</title>
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
            display: flex;
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
        .form-control, .btn {
            background-color: rgba(255, 255, 255, 0.8);
        }
        .alert {
            background-color: rgba(40, 167, 69, 0.8); /* Corresponds to Bootstrap's success color */
        }
        .preview {
            margin-top: 20px;
        }
        .preview table {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
        }
        .preview th, .preview td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Import Books from CSV</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose CSV File</label>
            <input type="file" id="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>

    <div class="preview" id="preview">
        <h3>File Preview</h3>
        <table class="table table-bordered">
            <thead id="preview-head"></thead>
            <tbody id="preview-body"></tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || file.type === 'text/csv') {
            const reader = new FileReader();
            reader.onload = function(e) {
                const contents = e.target.result;
                parseCSV(contents);
            };
            reader.readAsText(file);
        } else {
            alert('Please upload a valid CSV file.');
        }
    });

    function parseCSV(contents) {
        const lines = contents.split('\n');
        const tableHead = document.getElementById('preview-head');
        const tableBody = document.getElementById('preview-body');

        tableHead.innerHTML = '';
        tableBody.innerHTML = '';

        if (lines.length > 0) {
            const headers = lines[0].split(',');
            let headRow = '<tr>';
            headers.forEach(header => {
                headRow += `<th>${header.trim()}</th>`;
            });
            headRow += '</tr>';
            tableHead.innerHTML = headRow;

            for (let i = 1; i < lines.length; i++) {
                const cells = lines[i].split(',');
                let bodyRow = '<tr>';
                cells.forEach(cell => {
                    bodyRow += `<td>${cell.trim()}</td>`;
                });
                bodyRow += '</tr>';
                tableBody.innerHTML += bodyRow;
            }
        }
    }
</script>
</body>
</html>
