<!DOCTYPE html>
<html>
<head>
    <title>Track Shipment</title>
</head>
<body>
    <form action="/track-shipment" method="post">
        @csrf
        <label for="tracking_number">Tracking Number:</label>
        <input type="text" name="tracking_number" required>
        <button type="submit">Track Shipment</button>
    </form>
</body>
</html>
