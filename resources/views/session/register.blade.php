@extends('layouts.user_type.guest')

@section('content')
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
            style="background-image: url('../assets/img/grado.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">¡Bienvenid@!</h1>
                        <p class="text-lead text-white">Ingresa tus datos en el formulario y te contactaremos lo antes
                            posible.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h4 class="text-secondary">Regístrate</h4>
                        </div>
                        <div class="card-body">
                            <!-- Mensaje de éxito -->
                            @if (session('success'))
                                <div class="alert border-0 bg-transparent text-secondary text-center">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Formulario con ID para control de visibilidad -->
                            <div id="form-container" @if (session('success')) hidden @endif>
                                <form role="form text-left" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Nombre" name="name"
                                            id="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Correo Electrónico"
                                            name="email" id="email" value="{{ old('email') }}">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="phone" class="form-control" placeholder="Teléfono" name="phone"
                                            id="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Checkbox de Términos y Condiciones -->
                                    <div class="form-check text-left">
                                        <input class="form-check-input custom-checkbox" type="checkbox" name="agreement"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Acepto los <a href="#" class="text-secondary font-weight-bolder">Términos
                                                y Condiciones</a>
                                        </label>
                                        @error('agreement')
                                            <p class="text-danger text-xs mt-2">Debes aceptar los términos y condiciones.</p>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn bg-secondary text-white w-100 my-4 mb-2">REGISTRARME</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">¿Ya tienes una cuenta? Ingresa al
                                        <a href="{{ route('login') }}" class="text-secondary font-weight-bolder">Campus
                                            Virtual</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let successMessage = document.querySelector(".alert-primary");
            let formContainer = document.getElementById("form-container");

            if (successMessage) {
                // Espera 5 segundos y muestra el formulario nuevamente
                setTimeout(() => {
                    successMessage.style.display = "none";
                    formContainer.hidden = false;
                }, 10000);
            }
        });
    </script>

    
@endsection

<style>
    /* ✅ Cambia el color del checkbox cuando está marcado */
    .custom-checkbox {
        width: 18px;
        height: 18px;
        accent-color: #3d348b !important;
        /* Aplica el color deseado */
        border-radius: 4px;
        /* Redondear esquinas */
        cursor: pointer;
    }

    /* ✅ Asegurar que el color se aplica correctamente */
    .custom-checkbox:checked {
        background-color: #3d348b !important;
        border-color: #3d348b !important;
    }
</style>
