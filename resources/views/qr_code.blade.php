<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
</head>
<body>
    <div>
        <h2>QR Code:</h2>
        <img src="{{ Storage::url('qr_codes/' . $filename) }}" alt="QR Code">
    </div>
</body>
</html>
