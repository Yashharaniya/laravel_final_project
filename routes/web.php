<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::middleware(['auth'])->group(function () {
    Route::get('/shop', [HomeController::class, 'shop']);
    Route::get('/about', [HomeController::class, 'about']);
    Route::get('/services', [HomeController::class, 'services']);
    Route::post('/send-contact-us', [HomeController::class, 'sendContactUsEmail'])->name('contactus.send');
    Route::get('/blogg', [HomeController::class, 'blogg']);
    Route::get('/contact', [HomeController::class, 'contactus']);

    // Cart routes
    Route::post('cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
    Route::get('cart', [HomeController::class, 'showCart'])->name('cart.show');
    Route::post('cart/remove', [HomeController::class, 'removeFromCart'])->name('remove.from.cart');
    Route::post('cart/update', [HomeController::class, 'updateQuantity'])->name('cart.update');

    Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
    Route::get('/post', [HomeController::class, 'post'])->middleware(['auth', 'admin']);
    Route::get('/thankyou', function () {
        return view('user.thankyou');
    })->name('thankyou');
    Route::post('/cart/checkout', [HomeController::class, 'checkout'])->name('cart.checkout');

 
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('/category', [AdminController::class, 'category']);
    Route::get('/view_product', [AdminController::class, 'view_product']);
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/showpro', [AdminController::class, 'showpro']);
    Route::post('/category', [AdminController::class, 'store']);
    Route::post('/add_product', [AdminController::class, 'add_product']);
    Route::get('/category/delete/{id}', [AdminController::class, 'destroy']);
    Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
    Route::get('/update_product/{id}', [AdminController::class, 'showEditForm'])->name('show_update_product');
    Route::put('/update_product/{id}', [AdminController::class, 'update'])->name('update_product');    
});
