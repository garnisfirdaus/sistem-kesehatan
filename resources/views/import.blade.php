<!DOCTYPE html>
<html>
<head>
    <title>Import Data CSV</title>
</head>
<body>
    <h2>Import Data CSV</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".csv" required>
        <button type="submit">Upload & Import</button>
    </form>
</body>
</html>
