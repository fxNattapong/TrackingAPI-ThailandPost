<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Track Result</title>

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            width: 1000px;
            border: 1px solid black;
            padding: 2em;
        }

        .grid-item {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            grid-column: span 2;
        }

        .tracking-info {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Tracking Result</h2>
    <pre>
        {!! json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </pre>

    <div class="grid-container">
        @foreach($data['response']['items'] as $trackingNumber => $items)
            <h3 class="tracking-info">Tracking Number: {{ $trackingNumber }}</h3>
            @foreach($items as $item)
                @if (!empty($item))
                    <div class="grid-item">
                        <strong>Status Description:</strong> {!! $item['status_description'] !!}<br>
                        <strong>Location:</strong> {{ $item['location'] }}<br>
                        <strong>Status Date:</strong> {{ $item['status_date'] }}
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>

</body>
</html>
