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

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

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
	Route::get('/index', [IndexController::class, 'index']);
	// Route::get('/index', function () {return view('index');});	


});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
Route::middleware(['auth'])->group(function () {
	Route::get('/profesor', [ProfesorController::class, 'index'])->name('profesor.dashboard');
	Route::get('/estudiante', [EstudianteController::class, 'index'])->name('estudiante.dashboard');
});
Route::middleware(['auth'])->group(function () {
	// Admin
	Route::get('/admin/usuarios', function () {
		return view('admin.registro-usuarios');
	})->name('admin.usuarios');

	Route::get('/admin/profesores', function () {
		return view('admin.registro-profesores');
	})->name('admin.profesores');

	// Profesor
	Route::prefix('profesor')->group(function () {
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
		Route::resource('/simulacros', SimulacroController::class)->names([
			'index' => 'profesor.simulacros.index',
			'create' => 'profesor.simulacros.create',
			'store' => 'profesor.simulacros.store',
			'show' => 'profesor.simulacros.show',
			'edit' => 'profesor.simulacros.edit',
			'update' => 'profesor.simulacros.update',
			'destroy' => 'profesor.simulacros.destroy',
		]);
		Route::post('/simulacros/preview', [SimulacroController::class, 'preview'])->name('profesor.simulacros.preview');
		Route::get('/anuncios', [AnuncioController::class, 'index'])->name('profesor.anuncios');
		Route::get('/anuncios/create', [AnuncioController::class, 'create'])->name('profesor.crear_anuncio');
		Route::post('/anuncios', [AnuncioController::class, 'store'])->name('profesor.guardar_anuncio');
		Route::delete('/anuncios/{id}', [AnuncioController::class, 'destroy'])->name('profesor.eliminar_anuncio');
	});

	// Estudiante
	Route::prefix('estudiante')->group(function () {
		Route::get('/calificaciones', [EstudianteController::class, 'calificaciones'])->name('estudiante.calificaciones');
		Route::get('/cronograma', [EstudianteController::class, 'cronograma'])->name('estudiante.cronograma');
		Route::get('/modulos', [EstudianteController::class, 'modulos'])->name('estudiante.modulos');
		Route::get('/anuncios', [AnuncioController::class, 'verAnuncios'])->name('estudiante.anuncios');
		Route::get('/simulacros', [SimulacroController::class, 'verSimulacros'])->name('estudiante.simulacros');
		Route::get('/simulacros/{id}', [SimulacroController::class, 'realizarSimulacro'])->name('estudiante.realizar_simulacro');
		Route::post('/simulacros/{id}', [SimulacroController::class, 'guardarRespuestas'])->name('estudiante.guardar_respuestas');
	});
});
