<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\SimulacroController;
use App\Http\Controllers\VideoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [IndexController::class, 'index'])->name('index');
	Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
	Route::get('/profesor', [ProfesorController::class, 'index'])->name('profesor.dashboard');
	Route::get('/estudiante', [EstudianteController::class, 'index'])->name('estudiante.dashboard');
	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create'])->name('register');
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
	Route::get('/index', [IndexController::class, 'index'])->name('index');
	// Route::get('/index', function () {return view('index');});	


});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
	Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
	Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
	Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
	Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
	Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
	Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

// Profesor
Route::middleware(['auth', 'role:profesor'])->prefix('profesor')->group(function () {
	Route::get('/calificaciones', [ProfesorController::class, 'calificaciones'])->name('profesor.calificaciones');
	Route::get('/calificaciones/{id}/edit', [ProfesorController::class, 'editarCalificacion'])->name('profesor.editar_calificacion');
	Route::put('/calificaciones/{id}', [ProfesorController::class, 'actualizarCalificacion'])->name('profesor.actualizar_calificacion');
	Route::delete('/calificaciones/{id}', [ProfesorController::class, 'eliminarCalificacion'])->name('profesor.eliminar_calificacion');
	Route::get('cronograma', [ProfesorController::class, 'cronograma'])->name('profesor.cronograma');
	Route::post('cronograma', [ProfesorController::class, 'guardarEvento'])->name('profesor.cronograma.guardar');
	Route::put('cronograma/{id}', [ProfesorController::class, 'actualizarEvento'])->name('profesor.cronograma.actualizar');
	Route::delete('cronograma/{id}', [ProfesorController::class, 'eliminarEvento'])->name('profesor.cronograma.eliminar');
	Route::get('/modulos', [ProfesorController::class, 'modulos'])->name('profesor.modulos');
	Route::get('/modulos/create', [ProfesorController::class, 'crearModulo'])->name('profesor.crear_modulo');
	Route::post('/modulos', [ProfesorController::class, 'guardarModulo'])->name('profesor.guardar_modulo');
	Route::get('/modulos/{id}/edit', [ProfesorController::class, 'editarModulo'])->name('profesor.editar_modulo');
	Route::put('/modulos/{id}', [ProfesorController::class, 'actualizarModulo'])->name('profesor.actualizar_modulo');
	Route::delete('/modulos/{id}', [ProfesorController::class, 'eliminarModulo'])->name('profesor.eliminar_modulo');
	Route::post('/modulos/{id}/archivo', [ProfesorController::class, 'subirArchivo'])->name('profesor.subir_archivo');
	Route::delete('/archivos/{id}', [ProfesorController::class, 'eliminarArchivo'])->name('profesor.eliminar_archivo');
	// Listar simulacros
	Route::get('/simulacros', [SimulacroController::class, 'index'])
		->name('profesor.simulacros.index');

	// Formulario para crear un simulacro
	Route::get('/simulacros/create', [SimulacroController::class, 'create'])
		->name('profesor.simulacros.create');

	// Guardar simulacro (método store)
	Route::post('/simulacros', [SimulacroController::class, 'store'])
		->name('profesor.simulacros.store');

	// Actualizar simulacro (método update)
	Route::put('/simulacros/{id}', [SimulacroController::class, 'update'])
		->name('profesor.simulacros.update');

	// Eliminar simulacro (método destroy)
	Route::delete('/simulacros/{id}', [SimulacroController::class, 'destroy'])
		->name('profesor.simulacros.destroy');

	// Ruta para previsualizar (preview) el simulacro; se le asigna un slug distinto para evitar conflicto
	Route::post('/simulacros/preview', [SimulacroController::class, 'preview'])
		->name('profesor.simulacros.preview');

	// Ruta para "testear" el simulacro
	Route::get('/simulacros/{id}/test', [SimulacroController::class, 'test'])
		->name('profesor.simulacros.test');
	Route::get('/anuncios', [AnuncioController::class, 'index'])->name('profesor.anuncios');
	Route::get('/anuncios/create', [AnuncioController::class, 'create'])->name('profesor.crear_anuncio');
	Route::post('/anuncios', [AnuncioController::class, 'store'])->name('profesor.guardar_anuncio');
	Route::delete('/anuncios/{id}', [AnuncioController::class, 'destroy'])->name('profesor.eliminar_anuncio');
	Route::put('/anuncios/{id}', [AnuncioController::class, 'actualizarAnuncio'])->name('profesor.actualizar_anuncio');
	Route::get('/videos', [VideoController::class, 'index'])->name('profesor.video');
	Route::get('/videos/create', [VideoController::class, 'create'])->name('profesor.crear_video');
	Route::post('/videos', [VideoController::class, 'store'])->name('profesor.guardar_video');
	Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('profesor.eliminar_video');
});

// Estudiante
Route::middleware(['auth', 'role:estudiante'])->prefix('estudiante')->group(function () {
	Route::get('/calificaciones', [EstudianteController::class, 'calificaciones'])->name('estudiante.calificaciones');
	Route::get('/cronograma', [EstudianteController::class, 'cronograma'])->name('estudiante.cronograma');
	Route::get('/modulos', [EstudianteController::class, 'modulos'])->name('estudiante.modulos');
	Route::get('/anuncios', [AnuncioController::class, 'verAnuncios'])->name('estudiante.anuncios');
	Route::get('/simulacros', [SimulacroController::class, 'verSimulacros'])->name('estudiante.simulacros');
	Route::get('/simulacros/{id}', [SimulacroController::class, 'realizarSimulacro'])->name('estudiante.realizar_simulacro');
	Route::post('/simulacros/{id}', [SimulacroController::class, 'guardarRespuestas'])->name('estudiante.guardar_respuestas');
	Route::get('/videos', [VideoController::class, 'estudiantes'])->name('estudiante.video');
});
