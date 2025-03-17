@extends('layouts.user_type.guest')

@section('content')
    <div id="imageCarousel" class="page-header align-items-center mx-auto border-radius-lg carousel slide position-relative"
        style="width: 98%; height: 70%;" data-bs-ride="carousel" data-bs-wrap="true">
        <div class="carousel-inner border-radius-lg w-100 h-100">
            <div class="carousel-item active"
                style="background-image: url('../assets/img/carousel/c1.jpg'); background-size: cover; background-position: center; width: 100%; height: 100%;">
                <span class="mask bg-gradient-dark opacity-6 position-absolute w-100 h-100"></span>
            </div>
            <div class="carousel-item"
                style="background-image: url('../assets/img/carousel/c2.jpg'); background-size: cover; background-position: center; width: 100%; height: 100%;">
                <span class="mask bg-gradient-dark opacity-6 position-absolute w-100 h-100"></span>
            </div>
            <div class="carousel-item"
                style="background-image: url('../assets/img/carousel/c3.jpg'); background-size: cover; background-position: center; width: 100%; height: 100%;">
                <span class="mask bg-gradient-dark opacity-6 position-absolute w-100 h-100"></span>
            </div>
            <div class="carousel-item"
                style="background-image: url('../assets/img/carousel/c4.jpeg'); background-size: cover; background-position: center; width: 100%; height: 100%;">
                <span class="mask bg-gradient-dark opacity-6 position-absolute w-100 h-100"></span>
            </div>
            <div class="carousel-item"
                style="background-image: url('../assets/img/carousel/c5.jpg'); background-size: cover; background-position: center; width: 100%; height: 100%;">
                <span class="mask bg-gradient-dark opacity-6 position-absolute w-100 h-100"></span>
            </div>
        </div>
        <div class="container position-absolute top-50 start-50 translate-middle z-index-3 text-center">
            <h1 class="text-white mb-2">¡Prepárate con la mejor plataforma educativa!</h1>
            <p class="text-lead text-white">La herramienta definitiva para alcanzar un puntaje sobresaliente y abrir
                las puertas a tu futuro académico y profesional.</p>
            <a href="https://wa.me/qr/ZM27K3GRHSH7I1" target="_blank"
                class="btn btn-sm btn-round mb-0 me-1 bg-white text-secondary">¡Inscríbete
                ahora y asegura tu éxito!</a>
            <div id="countdown-container" class="text-center mt-4 text-white">
                <div id="countdown" class="display-6 fw-bold"></div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev"
            style="z-index: 10;">
            <span class="carousel-control-prev-icon bg-dark p-3 rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next"
            style="z-index: 10;">
            <span class="carousel-control-next-icon bg-dark p-3 rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>

    </div>
    <br>
    <div class="container bg-white border-radius-lg p-4 position-relative" style="margin-top: -120px; z-index: 20;">
        <!-- Título -->
        <h3 class="text-center fw-bold mb-4 text-secondary">Todo lo que incluye tu preparación</h3>

        <div class="row">
            <!-- Primera sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-camera-video text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">120 horas de clases en vivo y grabadas</p>
            </div>
            <!-- Segunda sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-book text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">6 cartillas didácticas de 5 materias + guía</p>
            </div>
            <!-- Tercera sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-pencil-square text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">4 simulacros con 800 preguntas tipo ICFES</p>
            </div>
            <!-- Cuarta sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-person-check text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">Clases de vocación profesional</p>
            </div>
            <!-- Quinta sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-film text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">Tips, recomendaciones, videos y más</p>
            </div>
        </div>
    </div>
    <br>
    <div class="container p-4 mt-6">
        <div class="row">
            <!-- Columna izquierda: Imagen -->
            <div class="col-md-6 position-relative">
                <img src="assets/img/student_woman.jpg" class="border-radius-lg img-fluid w-100 d-block"
                    style="max-height: 90%; object-fit: cover;">
            </div>

            <!-- Columna derecha: Características con íconos -->
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-3 mt-3">
                    <h2 class="mb-3 text-secondary">Clases de orientación vocacional</h2>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person-bounding-box text-primary fs-4 me-3"></i>
                    <span><strong class="text-secondary">Autoconocimiento:</strong> Evaluamos tus fortalezas, gustos y
                        habilidades para encontrar la mejor opción para ti.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-pencil-square text-primary fs-4 me-3"></i>
                    <span><strong class="text-secondary">Exploración de opciones:</strong> Te presentamos diferentes áreas
                        de
                        estudio y sus oportunidades en el mercado laboral.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person-check text-primary fs-4 me-3"></i>
                    <span><strong class="text-secondary">Asesoría personalizada:</strong> Recibe orientación de
                        profesionales
                        con experiencia en diversas áreas del conocimiento.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-bookmark-check-fill text-primary fs-4 me-3"></i>
                    <span><strong class="text-secondary">Toma decisiones informadas:</strong> Te brindamos herramientas
                        para que elijas una carrera alineada con tu propósito de vida.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-4 mt-6 bg-white border-radius-lg">
        <div class="row">
            <div class="col-md-6">
                <h2 class="d-flex align-items-center mb-8 mt-md-7 text-secondary">Beneficios de estudiar con nosotros</h2>
            </div>

            <!-- Columna derecha: Características con íconos -->
            <div class="col-md-6 mt-5">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person text-primary fs-4 me-3"></i>
                    <span>Profesores expertos en todas las áreas del examen.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-whatsapp text-primary fs-4 me-3"></i>
                    <span>Atención personalizada vía WhatsApp.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-laptop text-primary fs-4 me-3"></i>
                    <span>Plataforma 100% online y accesible 24/7.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-phone text-primary fs-4 me-3"></i>
                    <span>Estudia desde cualquier dispositivo móvil.</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-cash-coin text-primary fs-4 me-3"></i>
                    <span>Precio competitivo: Por todo el programa pagas solo <strong class="text-secondary">$490.000
                            COP.</strong></span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container p-4 mt-6">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="mb-3 text-secondary">Fechas y horarios</h2>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-calendar-check text-primary fs-4 me-3"></i>
                    <span>Duración: Del 5 de mayo al 10 de agosto.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-clock text-primary fs-4 me-3"></i>
                    <span>Horarios</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-1-square-fill text-primary fs-4 me-3"></i>
                    <span> Lunes: 7:00 p.m. - 9:00 p.m.</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-2-square-fill text-primary fs-4 me-3"></i>
                    <span> Sábados: 7:00 a.m. - 12:00 m. | 1:00 p.m. - 6:00 p.m.</span>
                </div>
            </div>

            <div class="col-md-6 position-relative">
                <img src="assets/img/planner2.jpg" class="border-radius-lg img-fluid w-100 d-block"
                    style="max-height: 95%; object-fit: cover;">
            </div>
        </div>
    </div>
    <br>
    <div class="container bg-white border-radius-lg">
        <!-- Título -->
        <br>
        <h3 class="text-center fw-bold mb-4 text-secondary">Ventajas de obtener un alto puntaje en el ICFES</h3>

        <div class="row">
            <!-- Primera sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-currency-dollar text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">Acceso a universidades públicas, ahorrando hasta $180 millones.</p>
            </div>
            <!-- Segunda sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-award-fill text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">Becas y descuentos en universidades privadas (hasta un 25%).</p>
            </div>
            <!-- Tercera sección -->
            <div class="col-md-2 text-center mx-auto mb-4">
                <i class="bi bi-briefcase-fill text-primary fs-2 mb-2"></i>
                <p class="text-center px-2">Mejores oportunidades laborales y académicas.</p>
            </div>
        </div>
    </div>
    <br>
    <div class="position-relative d-flex justify-content-center text-center mt-4">
        <a href="{{ auth()->user() ? url('static-sign-up') : url('register') }}"
            class="btn btn-sm btn-round mb-0 me-1 bg-secondary text-white fs-7 {{ Request::is('static-sign-up') ? 'light' : 'dark' }}">
            ¡No pierdas más tiempo! Inscríbete hoy y prepárate para alcanzar tus sueños.
        </a>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var carousel = new bootstrap.Carousel(document.querySelector("#imageCarousel"), {
            interval: 3000, // Cambia de imagen cada 3 segundos
            pause: "hover"
        });

        document.addEventListener("visibilitychange", function() {
            if (document.hidden) {
                carousel.pause();
            } else {
                carousel.cycle();
            }
        });
    });
    const deadline = new Date("May 5, 2025 00:00:00").getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const timeLeft = deadline - now;

        if (timeLeft <= 0) {
            document.getElementById("countdown").innerHTML = "¡Tiempo Finalizado!";
            return;
        }

        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML =
            `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }

    // Actualizar cada segundo
    setInterval(updateCountdown, 1000);
    updateCountdown(); // Ejecutar inmediatamente para no esperar 1s
</script>

<style>
    .col-md-2.text-center {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .col-md-2.text-center:hover {
        transform: scale(1.1);
        /* box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); */
    }

    .btn:hover {
        transform: scale(1.1);
        transition: transform 0.2s;
    }

    .img-fluid {
        transition: transform 0.3s ease-in-out;
    }

    .img-fluid:hover {
        transform: scale(1.05);
    }
</style>
