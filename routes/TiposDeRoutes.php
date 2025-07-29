<?php

use App\Http\Controllers\TiposDeRoutesController;
use App\Http\Controllers\UserGroupRouteController;
use App\Http\Middleware\OnlyAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Assinatura base de uma rota
// Route::Verb('uri', callback); - o callback é a ação que vai ser executada quando a rota for acionada

// rota com função anônima
Route::get('/rota', function () {
    return '<h1>Olá Laravel!</h1>';
});

Route::get('/user', function () {
    return '<h1>Aqui está o usuário</h1>';
});

Route::get('/injection', function (Request $request) {
    var_dump($request);
});

Route::match(['get', 'post'], '/match', function (Request $request) {
    return '<h1>Aceita GET e POST</h1>';
});

Route::any('/any', function (Request $request) {
    return '<h1>Aceita qualquer http verb</h1>';
});

Route::get('/index', [TiposDeRoutesController::class, 'index']);
Route::get('/about', [TiposDeRoutesController::class, 'about']);

Route::redirect('/saltar', '/index');
Route::permanentRedirect('/saltar2', '/index');

Route::view('/view', 'home');

Route::view('/view2', 'home', ['myName' => 'Isaque Soares']);

// --------------------------------------------------------------------
// ROUTE PARAMETERS
// --------------------------------------------------------------------

Route::get('/valor/{value}', [TiposDeRoutesController::class, 'mostrarValor']);
Route::get('/valores/{value1}/{value2}', [TiposDeRoutesController::class, 'mostrarValores']);
Route::get('/valores2/{value1}/{value2}', [TiposDeRoutesController::class, 'mostrarValores']);

Route::get('/opcional/{value?}', [TiposDeRoutesController::class, 'mostrarValorOpcional']);
Route::get('/opcional1/{value1}/{value2?}', [TiposDeRoutesController::class, 'mostrarValoresOpcional']);

Route::get('/user/{user_id}/post/{post_id}', [TiposDeRoutesController::class, 'mostrarPosts']);

// --------------------------------------------------------------------
// ROUTE PARAMETERS WITH CONSTRAINTS
// --------------------------------------------------------------------

Route::get('/exp1/{value}', function ($value) {
    echo $value;
})->where('value', '[0-9]+');

Route::get('/exp2/{value}', function ($value) {
    echo $value;
})->where('value', '[A-Za-z0-9]+');

Route::get('/exp3/{value1}/{value2}', function ($value1, $value2) {
    echo $value1 . ' e ' . $value2;
})->where([
    'value1' => '[0-9]+',
    'value2' => '[A-Za-z0-9]+'
]);

// --------------------------------------------------------------------
// ROUTE NAMES
// --------------------------------------------------------------------
Route::get('/rota_abc', function () {
    return 'Rota nomeada';
})->name('rota_nomeada');

Route::get('/rota_referenciada', function () {
    return redirect()->route('rota_nomeada');
});

// --------------------------------------------------------------------
// GROUPS ROUTES
// --------------------------------------------------------------------
Route::prefix('admin')->group(function () {
    /*
        /admin/home
        /admin/about
        /admin/management
    */
    Route::get('/home', [TiposDeRoutesController::class, 'index']);
    Route::get('/about', [TiposDeRoutesController::class, 'about']);
    Route::get('/management', [TiposDeRoutesController::class, 'mostrarValor']);
});

Route::get('/admin/only', function () {
    echo 'Apenas administradores 1';
})->Middleware([OnlyAdmin::class]);

Route::middleware(([OnlyAdmin::class]))->group(function () {
    Route::get('admin/only2', function () {
        echo 'Apenas administradores 2';
    });

    Route::get('admin/only3', function () {
        echo 'Apenas administradores 3';
    });
});

Route::controller(UserGroupRouteController::class)->group(function () {
    Route::get('/user/new', 'new');
    Route::get('/user/edit', 'edit');
    Route::get('/user/delete', 'delete');
});

Route::fallback(function() {
    echo 'Pagina não encontrada';
});