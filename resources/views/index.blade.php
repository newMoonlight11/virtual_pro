@extends('layouts.user_type.guest')

@section('content')
<div class="page-header align-items-start min-vh-50 pt-5 pb-10 mx-3 border-radius-lg" style="background-image: url('../assets/img/oxford.jpg');">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto pt-5">
          <h1 class="text-white mb-2 mt-5">¡Aprende con la mejor plataforma educativa!</h1>
          <p class="text-lead text-white">Prepárate para el ICFES como nunca antes y abre las puertas a tu futuro</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container bg-white border-radius-lg p-4 position-relative" style="margin-top: -170px; z-index: 20;">
    <!-- Título -->
    <h3 class="text-center fw-bold mb-4">Todo lo que incluye tu preparación</h3>
  
    <div class="row">
      <!-- Primera sección -->
      <div class="col-md-2 text-center mx-auto mb-4">
        <i class="bi bi-camera-video text-primary fs-2 mb-2"></i>
        <p class="text-center px-2">150 horas de clases en vivo y grabadas</p>
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
        <p class="text-center px-2">Tips, recomendaciones y más en video</p>
      </div>
    </div>
  </div>
  
@endsection