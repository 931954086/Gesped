<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Sinais de 1 Minuto</title>
</head>
<body>
    <h1>Gerador de Sinais de 1 Minuto</h1>
    <p>Par: AAPL</p>
    <p>Último Preço: {{ end($minuteData['c']) }}</p>
    <p>Alta do Último Minuto: {{ end($minuteData['h']) }}</p>
    <p>Baixa do Último Minuto: {{ end($minuteData['l']) }}</p>
    <p>Volume do Último Minuto: {{ end($minuteData['v']) }}</p>
    <p>Sinal: {{ $signal }}</p>
</body>
</html>
