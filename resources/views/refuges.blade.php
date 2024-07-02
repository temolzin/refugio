<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shelters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{ asset('public/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_home/layout/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('assets_home/layout/styles/shelters.css') }}" rel="stylesheet" type="text/css">
</head>

<body id="top" class="hold-transition layout-top-nav">
    <div class="bgded overlay"
        style="background-image:url('{{ asset('assets_home/images/backgrounds/background_shelter.jpg') }}');">
        <div class="wrapper row0">
            <div id="topbar" class="hoc clear">
                <div class="fl_left">
                    <ul class="nospace">
                        <li><i class="fas fa-phone"></i> 56 2364 0302</li>
                        <li><i class="far fa-envelope"></i> info@rootheim.com</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="wrapper row1">
            <header id="header" class="hoc clear">
                <nav class="main-header navbar navbar-expand-lg navbar-dark">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="home" class="nav-link">Inicio</a>
                                </li>
                                <li class="nav-item active">
                                    <a href="refuges" class="nav-link">Albergues</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/login" class="nav-link">Ingresar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <div id="pageintro" class="hoc clear">
                <article class="center">
                    <h3 class="heading underline">Catálogo de Albergues</h3>
                    <p>Conoce los albergues que confían en "Patitas Felices" para la gestión y cuidado de sus mascotas.
                    </p>
                </article>
            </div>
        </div>
    </div>

    <div class="wrapper row3">
        <main class="hoc container clear">
            <section id="shelters" class="group">
                <div class="content">
                    @foreach ($shelters as $shelter)
                        <div class="shelter-card">
                            <img src="{{ $shelter->logo_url ?: asset('img/avatardefault.png') }}"
                                alt="{{ $shelter->name }}">
                            <h4>{{ $shelter->name }}</h4>
                            <p>Teléfono: {{ $shelter->phone }}</p>
                            <p><a href="{{ $shelter->facebook }}" target="_blank">Facebook</a></p>
                            <p><a href="{{ $shelter->tiktok }}" target="_blank">TikTok</a></p>
                        </div>
                    @endforeach
                </div>
            </section>
            <div class="clear"></div>
        </main>
    </div>

    <div class="wrapper row4">
        <footer id="footer" class="hoc clear">
            <div class="center btmspace-50">
                <h6 class="heading">Patitas Felices</h6>
                <nav>
                    <ul class="nospace inline pushright uppercase">
                        <li><a href="home">Inicio</a></li>
                        <li><a href="refuges">Albergues</a></li>
                        <li><a href="/login">Ingresar</a></li>
                    </ul>
                </nav>
            </div>
            <hr class="btmspace-50">
            <div>
                <h6 class="heading">Contacto</h6>
                <ul class="nospace btmspace-30 linklist contact">
                    <li><i class="fas fa-map-marker-alt"></i>
                        <address>
                            La Palma No. Ext. 9, Col. Purificación, Teotihuacan, Edo. de México, C.P. 55804
                        </address>
                    </li>
                    <li><i class="fas fa-phone"></i> 56 2364 0302</li>
                    <li><i class="far fa-envelope"></i> https://rootheim.com/</li>
                </ul>
            </div>
        </footer>
    </div>

    <div class="wrapper row5">
        <div id="copyright" class="hoc clear">
            <p class="fl_left">Copyright &copy; 2024 - Todos los derechos reservados - <a href="#">Patitas
                    Felices</a></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var menuToggle = document.querySelector('.navbar-toggler');
            var menuCollapse = document.querySelector('#navbarCollapse');
        });
    </script>
</body>

</html>
