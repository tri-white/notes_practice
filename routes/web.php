<?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->get('/setup', function(){
    $email = "admin@admin.com";
    $password="password";
    if(Auth::attempt(['email' => $email, 'password' => $password])){
        $user = Auth::user();

        $adminToken = $user->createToken('admin-token',['create','update','delete']);
        $updateToken = $user->createToken('update-token',['create','update']);
        $basicToken = $user->createToken('basic-token',['none']);
          
        return [
            'admin' => $adminToken->plainTextToken,
            'basic' => $basicToken->plainTextToken,
            'update' => $updateToken->plainTextToken,
        ];
    }
    else{
        abort(404);       
    }
});

Route::group(['namespace'=>'App\Http\Controllers', 'middleware'=>['throttle:60,1'], ] , function(){
    Route::resource("notes",NotesController::class);
    Route::resource("users",UserController::class, ['only' => ['index', 'show']]);
});

require __DIR__.'/auth.php';
