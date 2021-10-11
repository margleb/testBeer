<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Models\Beer;
use Illuminate\Support\Facades\DB;

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


/* главная страница, отображающая список пива в таблице */
Route::get('/', function() {
   return view('beerList')->with('beers', DB::table('beers')->simplePaginate(3));
});

/* страница логина */
Route::get('/login', function() {
    return view('login');
})->name('login');
Route::post('/login_user', [LoginController::class, 'authenticate'])->name('login_user');

/* страница регистрации */
Route::get('/register', function() {
    return view('register');
})->name('register');
Route::post('/register_user', [RegisterController::class, 'register'])->name('register_user');

Route::get('/admin', function() {

    if(!Auth::check()) return redirect(route('login'));

    return view('admin')->with('beers', Beer::all());

})->name('admin');

Route::post('/logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

//    /* ресурсный контроллер отвечающий за CRUD beer */
Route::resource('Beer', BeerController::class);

//Route::post('/userRegister', [RegisterController::class, 'register'])->name('userRegister');
//
///* здесь находятся все маршруты связанные с админ областью */
//Route::name('admin.')->group(function() {
//
//    /* ресурсный контроллер отвечающий за CRUD beer */
//    Route::resource('Beer', BeerController::class);
//
//});