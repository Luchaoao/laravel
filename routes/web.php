<?php

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;

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
// 首頁
// Route::get('/', function () {
//     // 宣告變數
//     $a = 0;
//     $b = [1, 2, 3];
//     $c = 'hello';
//     $d = (object)['id' => 1];
//     $e = ['id' => 1];

//     $books = Book::get();

//     $data = [
//         'books' => $books,
//         'count' => 5,
//         'title' => 'Midnight',
//     ];
    
//     // 中止並印出
//     // dd($books);
    
//     return Inertia::render('Test', [
//         'response' => $data,
//     ]);
// });

Route::middleware(['auth', 'verified'])->group(function () {

// 將邏輯放置 controller 呼叫index涵式
Route::get('/test', [TestController::class, 'index']);

// 新增Book資料 用get
Route::get('/add-book',[TestController::class, 'store']);

// 新增Book資料 用post
Route::post('/post-book',[TestController::class, 'add']);

// 刪除Book路由
Route::post('/delete-book',[TestController::class, 'deleteBook']);

// 更新Book路由
Route::post('/update-book',[TestController::class, 'updateBook']);

});



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
