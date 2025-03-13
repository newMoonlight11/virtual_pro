@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 bg-white border-radius-lg">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Lista de videos</h3>
        </div>
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>

                            <!-- Miniatura del video -->
                            <img src="https://img.youtube.com/vi/{{ explode('embed/', $video->youtube_url)[1] }}/hqdefault.jpg"
                                class="img-fluid video-thumbnail" data-bs-toggle="modal" data-bs-target="#videoModal"
                                data-video="{{ $video->youtube_url }}">

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Ver Video</h5>
                    <button type="button" class="btn-close bg-primary" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center video-wrapper">
                    <iframe id="videoFrame" width="100%" height="400" frameborder="0"
                        allow="encrypted-media; fullscreen" allowfullscreen></iframe>
                    <div class="video-overlay"></div>
                    <div class="video-overlay-bottom"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .video-container {
            pointer-events: none;
            /* Deshabilita interacciones del usuario */
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* Proporción 16:9 */
            height: 0;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
            /* Relación 16:9 */
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: auto;
            /* Permite interacción en el video */
        }

        /* Bloquea solo la parte superior donde aparece "Ver en YouTube" */
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 15%;
            /* Ajusta este valor si aún se puede hacer clic en "Ver en YouTube" */
            background: transparent;
            pointer-events: auto;
            /* Bloquea clics en el logo y título */
        }

        .video-overlay-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 15%;
            /* Ajustar según sea necesario */
            background: transparent;
            pointer-events: auto;
            /* Bloquea clics */
        }

        /* Evitar selección de texto para impedir copiar la URL */
        .modal-body {
            user-select: none;
        }

        .modal-body iframe {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let videoModal = document.getElementById("videoModal");
            let videoFrame = document.getElementById("videoFrame");

            document.querySelectorAll(".video-thumbnail").forEach(item => {
                item.addEventListener("click", function() {
                    let videoUrl = this.getAttribute("data-video");
                    videoFrame.src = videoUrl +
                        "?autoplay=0&controls=1&modestbranding=1&rel=0&fs=1&disablekb=1&iv_load_policy=3&showinfo=0";

                });
            });

            videoModal.addEventListener("hidden.bs.modal", function() {
                videoFrame.src = "";
            });
        });
    </script>
@endsection
