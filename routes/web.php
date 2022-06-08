<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PDFController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('v_admin');
// })->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');




Route::get('/', function () {
    return Redirect::to('/landingpage/index.html');
});

//Ak1
Route::post('/ak1', [App\Http\Controllers\Ak1Controller::class, 'nextStep'])->name('nextStep');
Route::get('/ak1', [App\Http\Controllers\Ak1Controller::class, 'step1DataDiri'])->name('step1DataDiri');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
Route::get('/admin/daftar', [App\Http\Controllers\AdminController::class, 'daftar'])->name('ak1daftar');
Route::get('/admin/siapcetak', [App\Http\Controllers\AdminController::class, 'siapcetak'])->name('siapcetak');
Route::get('/admin/pengambilan', [App\Http\Controllers\AdminController::class, 'pengambilan'])->name('pengambilan');

// Route::get('/admin/wawancara', [App\Http\Controllers\Ak1wawancaraController::class, 'wawancara'])->name('wawancara');
// Route::get('/admin/penetapan_libur', [App\Http\Controllers\AdminController::class, 'penetapan_libur'])->name('penetapan_libur');

Route::get('/penetapan_libur', [App\Http\Controllers\AdminController::class, 'penetapan_libur'])->name('penetapan_libur');
Route::get('/slot_layanan', [App\Http\Controllers\Ak1wawancaraController::class, 'wawancara'])->name('slot_layanan');
Route::get('/wa_gateway', [App\Http\Controllers\AdminController::class, 'wa_gateway'])->name('wa_gateway');

//Full Calendar
Route::get('fullcalendar', [App\Http\Controllers\FullCalendarController::class, 'index']);
Route::post('fullcalendarAjax', [App\Http\Controllers\FullCalendarController::class, 'ajax']);

//Verifikasi
Route::get('/verifikasi/{rand_ak1}', [App\Http\Controllers\VerifikasiController::class, 'verifikasi'])->name('verifikasi');
Route::post('/verifikasix/{rand_ak1}', [App\Http\Controllers\VerifikasiController::class, 'nextStepVerification'])->name('nextStepVerification');


Route::get('generate-pdf/{rand_ak1}', [PDFController::class, 'generatePDF']);
Route::get('show-ktp/{rand_ak1}', [App\Http\Controllers\ShowKTPController::class, 'showKTP']);
Route::get('wa_gateway', [App\Http\Controllers\WAGatewayController::class, 'index']);