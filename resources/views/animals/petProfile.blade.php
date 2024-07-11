<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Profile</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff;
            color: #37474f;
            margin: 8;
            padding: 8;

        }

        .header {
            background-color: #00796b;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .image-container {
            text-align: center;
        }

        .image-container img {
            height: 140;
            width: 140;
            border-radius: 50%;
            border: 4px solid #00796b;
        }

        .section h3 {
            margin-bottom: 10px;
            font-size: 1.8em;
            border-bottom: 3px solid #00796b;
            padding-bottom: 5px;
            color: #00796b;
        }

        .section p {
            margin: 8px 0;
            font-size: 1.1em;
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">{{ $animal->name }}</div>
        <div class="main-content">
            <div class="image-container">
                @if ($animal->hasMedia('animal_gallery'))
                    <img src="{{ $animal->getFirstMediaUrl('animal_gallery') }}" alt="Photo of {{ $animal->name }}">
                @else
                    <img src='img/animaldefault.png' alt="Default Photo">
                @endif
            </div>
            <div class="details-container">
                <div class="section">
                    <h3>Datos de la Mascota</h3>
                    <p><strong>Raza:</strong> {{ $animal->breed }}</p>
                    <p><strong>Sexo:</strong> {{ $animal->sex }}</p>
                    <p><strong>Edad:</strong> {{ $animal->age }}</p>
                    <p><strong>Peso:</strong> {{ $animal->weight }} Kilos</p>
                    <p><strong>Color:</strong> {{ $animal->color }}</p>
                    <p><strong>Esterilizado:</strong> {{ $animal->is_sterilized == 1 ? 'Sí' : 'No' }}</p>
                </div>
                <div class="section">
                    <h3>Informacion</h3>
                    <p><strong>Fecha de ingreso:</strong> {{ $animal->entry_date }}</p>
                    <p><strong>Origen:</strong> {{ $animal->origin }}</p>
                    <p><strong>Comportamiento:</strong> {{ $animal->behavior }}</p>
                </div>
                <div class="section">
                    <h3>Historia</h3>
                    <p>{{ $animal->history }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
