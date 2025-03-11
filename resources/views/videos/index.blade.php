@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 bg-white border-radius-lg">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Lista de videos</h3>
            <a href="{{ route('profesor.crear_video') }}" class="btn btn-primary mb-3">+ Nuevo Video</a>
        </div>
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">{{ $video->title }}</h5>
                                <form action="{{ route('profesor.eliminar_video', $video->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-danger"
                                        onclick="return confirm('¿Eliminar este video?');" data-bs-toggle="tooltip"
                                        data-bs-original-title="Eliminar simulacro">
                                        <i class="fas fa-trash fs-6 text-white"></i>
                                    </button>
                                </form>
                            </div>

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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Ver Video</h5>
                    <button type="button" class="btn-close bg-primary" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <iframe id="videoFrame" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
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
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let videoModal = document.getElementById("videoModal");
            let videoFrame = document.getElementById("videoFrame");

            document.querySelectorAll(".video-thumbnail").forEach(item => {
                item.addEventListener("click", function() {
                    let videoUrl = this.getAttribute("data-video");
                    videoFrame.src = videoUrl;
                });
            });

            videoModal.addEventListener("hidden.bs.modal", function() {
                videoFrame.src = "";
            });
        });
    </script>
@endsection
