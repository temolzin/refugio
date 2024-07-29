<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Apadrinamiento</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            padding: 40px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin: 50px auto;
            text-align: center;
            flex: 1;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 45px;
        }

        .header img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .header .details {
            text-align: center;
        }

        .header p {
            font-size: 16px;
            line-height: 24px;
            color: #536387;
        }

        .title {
            margin-bottom: 30px;
        }

        .title h2 {
            font-weight: 600;
            font-size: 28px;
            line-height: 34px;
            color: #07074d;
        }

        .section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .section div {
            width: 48%;
            padding: 20px;
            border: 1px solid #dde3ec;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: left;
            background: #ffffff;
        }

        .section span {
            font-weight: 600;
            color: #07074d;
        }

        .thank-you {
            margin-top: 25px;
            font-size: 16px;
            font-weight: 600;
            color: #536387;
        }

        .credit {
            background-color: #eaf8e6;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .credit img {
            max-width: 30px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .credit span {
            vertical-align: middle;
            font-size: 12px;
        }

        .credit a {
            text-decoration: none;
            color: #6a64f1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            @if ($shelter->getMedia('logos')->isNotEmpty())
            @php
            $logo = $shelter->getFirstMedia('logos');
            @endphp
            <img src="{{ $logo->getUrl() }}" alt="Logo not found">
            @else
            <img src='img/avatardefault.png' alt="Logo por defecto">
            @endif
            <div class="details">
                <p>{{ $shelter->name }}<br>
                    Teléfono: {{ $shelter->phone }}<br>
                    Dirección: {{ $shelter->address }}, Col. {{ $shelter->colony }}, C.P. {{ $shelter->postal_code }}, Estado de {{ $shelter->state }} - {{$shelter->city }}
                </p>
            </div>
        </div>
        <div class="title">Recibo de apadrinamiento</div>
        <div class="section">
            <div>
            <span>Nombre del Padrino:</span> {{ $shelterMember->name }} {{ $shelterMember->last_name }}<br>
            <span>Teléfono:</span> {{$shelterMember->phone }}<br>
            <span>Dirección:</span> {{ $shelterMember->address }}, Col. {{ $shelterMember->colony }}, C.P. {{ $shelterMember->postal_code }}, Estado de {{ $shelterMember->state }} - {{ $shelterMember->city }}

            </div>
            <div>
                <span>ID del Padrino:</span> {{ $sponsorship->id }}<br>
                <span>Nombre de la Mascota:</span> {{ $sponsorship->animal->name }}<br>
                <span>Fecha de Inicio:</span> {{ $sponsorship->start_date }}<br>
                <span>Fecha de Finalización:</span> {{ $sponsorship->finish_date }}<br>
                <span>Fecha de Pago:</span> {{ $sponsorship->payment_date }}<br>
                <span>Monto:</span> {{ $sponsorship->amount }}<br>
                <span>Observación:</span> {{ $sponsorship->observation}}<br>
            </div>
        </div>
        <div class="thank-you">¡Gracias por apadrinar y por contribuir a mejorar la vida de nuestras mascotas!</div>
    </div>
    <div class="credit">
        <img src="img/logoRootBlack.png" alt="Logo">
        <span><a href="https://rootheim.com/">Root Heim Company</a></span>
    </div>
</body>

</html>
