<!-- Navbar -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 {{ (Request::is('static-sign-up') ? 'w-100 shadow-none  navbar-transparent mt-4' : 'blur blur-rounded shadow py-2 start-0 end-0 mx4') }}">
  <div class="container-fluid {{ (Request::is('static-sign-up') ? 'container' : 'container-fluid') }}">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-none d-lg-block {{ (Request::is('static-sign-up') ? 'text-white' : '') }}" href="{{ url('dashboard') }}">
      <img src="{{ asset('assets\img\virtualPRO_color.png') }}" style="max-width: 25%" >
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mx-auto">
        @if (auth()->user())
            <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ url('dashboard') }}">
                <i class="fa fa-chart-pie opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
                Dashboard
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="{{ url('profile') }}">
                <i class="fa fa-user opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
                Profile
            </a>
            </li>
        @endif
        <li class="nav-item">
          <a class="nav-link me-2" href="{{ auth()->user() ? url('static-sign-in') : url('index') }}">
            <i class="fas fa-house opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="{{ auth()->user() ? url('static-sign-up') : url('register') }}">
            <i class="fas fa-user-circle opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
            Regístrate
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="{{ auth()->user() ? url('static-sign-in') : url('login') }}">
            <i class="fas fa-book opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
            Campus virtual
          </a>
        </li>
      </ul>
      <ul class="navbar-nav d-lg-block d-none">
        <li class="nav-item">
          <a href="https://wa.me/qr/ZM27K3GRHSH7I1" target="_blank" class="btn btn-sm btn-round mb-0 me-1 bg-secondary text-white {{ (Request::is('static-sign-up') ? 'light' : 'dark') }}">
            <i class="bi bi-whatsapp text-white fs-6 me-2"></i>
            CONTÁCTANOS</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
