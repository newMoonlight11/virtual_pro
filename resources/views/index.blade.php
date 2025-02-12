@extends('layouts.user_type.guest')

@section('content')
<div class="page-header align-items-start min-vh-50 pt-5 pb-10 mx-3 border-radius-lg" style="background-image: url('../assets/img/oxford.jpg');">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto pt-5">
          <h1 class="text-white mb-2 mt-5">¡Prepárate con la mejor plataforma educativa!</h1>
          <p class="text-lead text-white">La herramienta definitiva para alcanzar un puntaje sobresaliente y abrir las puertas a tu futuro académico y profesional.</p>
          <a href="" target="_blank" class="btn btn-sm btn-round mb-0 me-1 bg-white text-secondary {{ (Request::is('static-sign-up') ? 'light' : 'dark') }}">¡Inscríbete ahora y asegura tu éxito!</a>
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
  <br>
  <div class="container p-4 mt-6">
    <div class="row">
      <!-- Columna izquierda: Imagen -->
      <div class="col-md-6 position-relative">
        <img src="assets/img/student_woman.jpg" class="border-radius-lg img-fluid w-100 d-block" style="max-height: 90%; object-fit: cover;">
      </div>
  
      <!-- Columna derecha: Características con íconos -->
      <div class="col-md-6">
        <div class="d-flex align-items-center mb-3 mt-3">
          <h2 class="mb-3">Clases de orientación vocacional</h2>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-person-bounding-box text-primary fs-4 me-3"></i>
          <span>Autoconocimiento: Evaluamos tus fortalezas, gustos y 
            habilidades para encontrar la mejor opción para ti.</span>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-pencil-square text-primary fs-4 me-3"></i>
          <span>Exploración de opciones: Te presentamos diferentes áreas de 
            estudio y sus oportunidades en el mercado laboral.</span>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-person-check text-primary fs-4 me-3"></i>
          <span>Asesoría personalizada: Recibe orientación de profesionales 
            con experiencia en diversas áreas del conocimiento.</span>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-bookmark-check-fill text-primary fs-4 me-3"></i>
          <span>Toma decisiones informadas: Te brindamos herramientas 
           para que elijas una carrera alineada con tu propósito de vida.</span>
        </div>
      </div>
    </div>
  </div>
  <div class="container p-4 mt-6 bg-white">
    <div class="row">
      <div class="col-md-6">
        <h2 class="d-flex align-items-center mb-3 mt-md-7">Beneficios de estudiar con nosotros</h2>
      </div>
  
      <!-- Columna derecha: Características con íconos -->
      <div class="col-md-6">
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
          <span>Precio competitivo: Solo $399.000 COP por todo el programa.</span>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container p-4 mt-6">
    <div class="row">
      <div class="col-md-6">
        <div class="d-flex align-items-center mb-3">
          <h2 class="mb-3">Fechas y horarios</h2>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-calendar-check text-primary fs-4 me-3"></i>
          <span>Duración: Del 3 de mayo al 10 de agosto.</span>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-clock text-primary fs-4 me-3"></i>
          <span>Horarios</span>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-1-square-fill text-primary fs-4 me-3"></i>
          <span>  Sábados: 8:00 a.m. - 1:00 p.m.</span>
        </div>
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-2-square-fill text-primary fs-4 me-3"></i>
          <span>  Domingos: 8:00 a.m. - 1:00 p.m.</span>
        </div>
      </div>

      <div class="col-md-6 position-relative">
        <img src="assets/img/planner2.jpg" class="border-radius-lg img-fluid w-100 d-block" style="max-height: 95%; object-fit: cover;">
      </div>
    </div>
  </div>
  <br>
  <div class="container bg-white border-radius-lg">
    <!-- Título -->
    <br>
    <h3 class="text-center fw-bold mb-4">Ventajas de obtener un alto puntaje en el ICFES</h3>
  
    <div class="row">
      <!-- Primera sección -->
      <div class="col-md-2 text-center mx-auto mb-4">
        <i class="bi bi-currency-dollar text-primary fs-2 mb-2"></i>
        <p class="text-center px-2">Acceso a universidades públicas, ahorrando hasta $180 millones en matrículas.</p>
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
    <a href="" target="_blank" class="btn btn-sm btn-round mb-0 me-1 bg-secondary text-white fs-7 {{ (Request::is('static-sign-up') ? 'light' : 'dark') }}">
      ¡No pierdas más tiempo! Inscríbete hoy y prepárate para alcanzar tus sueños.
    </a>
  </div>  
@endsection