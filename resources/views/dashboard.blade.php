@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        @if (auth()->user()->role === 'admin')
            <!-- Total de Usuarios -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total de usuarios</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $totalUsuarios }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="bi bi-people-fill text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usuarios de hoy -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Usuarios de hoy</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $usuariosHoy }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nuevos usuarios -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Nuevos usuarios
                                    </p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $nuevosUsuarios }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="bi bi-person-plus-fill text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'profesor' || auth()->user()->role === 'estudiante')
            <!-- Días para el simulacro -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Fecha simulacro</p>
                                    <h5 id="countdown" class="font-weight-bolder text-lg"></h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="bi bi-hourglass-top text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif

    <div class="row mt-4 d-flex align-items-stretch">
        <!-- Card de Anuncio -->
        <div class="col-lg-6">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                    style="background-image: url('../assets/img/planner.jpg');">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                        @if ($anuncio)
                            <p class="mb-1 pt-2 text-bold text-white">Último Anuncio</p>
                            <h5 class="font-weight-bolder text-white">{{ $anuncio->titulo }}</h5>
                            <p class="mb-5 text-white">{{ $anuncio->subtitulo }}</p>
                            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                href="{{ route('profesor.anuncios') }}">
                                Ver más
                                <i class="fas fa-arrow-right text-sm ms-1 text-white" aria-hidden="true"></i>
                            </a>
                        @else
                            <p class="mb-1 pt-2 text-bold text-white">Último Anuncio</p>
                            <h5 class="font-weight-bolder text-white">No hay anuncios aún</h5>
                            <p class="mb-5 text-white">Cuando se publiquen anuncios, aparecerán aquí.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Card de Módulo -->
        <div class="col-lg-6">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                    style="background-image: url('../assets/img/carousel/c2.jpg');">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                        @if ($modulo)
                            <p class="mb-1 pt-2 text-bold text-white">Último Módulo</p>
                            <h5 class="font-weight-bolder text-white">{{ $modulo->nombre }}</h5>
                            <p class="mb-5 text-white">{{ $modulo->descripcion }}</p>
                            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                href="{{ route('profesor.modulos') }}">
                                Ver más
                                <i class="fas fa-arrow-right text-sm ms-1 text-white" aria-hidden="true"></i>
                            </a>
                        @else
                            <p class="mb-1 pt-2 text-bold text-white">Último Módulo</p>
                            <h5 class="font-weight-bolder text-white">No hay módulos aún</h5>
                            <p class="mb-5 text-white">Cuando se publiquen módulos, aparecerán aquí.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Cronograma de actividades</h6>
            </div>
            <div class="card-body p-3">
                <div class="timeline timeline-one-side">
                    @foreach ($eventos as $evento)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-bell-55 text-primary"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    {{ $evento->evento }}
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('j F, h:i A') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                    href="{{ route('profesor.cronograma') }}">
                    Ver más
                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
@push('dashboard')
    <script>
        window.onload = function() {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                display: false
                            },
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                            label: "Mobile apps",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#cb0c9f",
                            borderWidth: 3,
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                            maxBarThickness: 6

                        },
                        {
                            label: "Websites",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#3A416F",
                            borderWidth: 3,
                            backgroundColor: gradientStroke2,
                            fill: true,
                            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                            maxBarThickness: 6
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            var fechaSimulacro = "{{ $fechaSimulacro }}"; // Fecha desde Laravel
            if (!fechaSimulacro) {
                document.getElementById("countdown").innerHTML = "Ninguno";
                return;
            }

            var countDownDate = new Date(fechaSimulacro).getTime();

            var countdownFunction = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                if (distance < 0) {
                    clearInterval(countdownFunction);
                    document.getElementById("countdown").innerHTML = "¡El simulacro ha comenzado!";
                    return;
                }

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes +
                    "m " + seconds + "s ";
            }, 1000);
        });
    </script>
@endpush
