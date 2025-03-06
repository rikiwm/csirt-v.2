<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Tiket</title>
</head>
<body>
    <h2>Halo, {{ $details['name'] }}</h2>
    <p>{{ $details['message'] }}</p>
    <p>Terima kasih,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
