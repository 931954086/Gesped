<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserPermissionController;
use App\Models\Produto;
use App\Models\User;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SignalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

|    return view('auth.login');
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        
        Route::middleware('can:edit-user')->group(function () {
            // Rotas para edição que exigem permissão específica 'edit-user'
            Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
            
            // Outras rotas que exigem permissão específica 'edit-user'
            Route::put('/status/{id}', [UserController::class, 'updateStatus'])->name('users.updateStatus');
            Route::put('/type-user/{id}', [UserController::class, 'updateTypeUser'])->name('users.updateTypeUser');
            Route::put('/permissions/{id}', [UserController::class, 'updatePermission'])->name('users.updatePermission');
        });
    });
});

*/


//Route::get('/signals', [SignalController::class, 'index']);
Route::get('/', [SignalController::class, 'index']);

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/s',       [UserController::class, 'index1'])->name('userss.index');

        Route::get('/',        [UserController::class, 'index'])->name('users.index');
        Route::get('/create',  [UserController::class, 'create'])->name('users.create');
        Route::post('/',       [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}',    [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}',    [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}',    [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::put('/status/{id}',    [UserController::class, 'updateStatus'])->name('users.updateStatus');
        Route::put('/type-user/{id}', [UserController::class, 'updateTypeUser'])->name('users.updateTypeUser');
        Route::put('/permissions/{id}',           [UserController::class,   'updatePermission'])->name('users.updatePermission');
    });


    Route::get('/profile',       [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',     [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',    [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rotas para usuários
    Route::prefix('users')->group(function () {
        Route::get('/',        [UserController::class, 'index'])->name('users.index');
        Route::get('/create',  [UserController::class, 'create'])->name('users.create');
        Route::post('/',       [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}',    [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}',    [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}',    [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::put('/status/{id}',    [UserController::class, 'updateStatus'])->name('users.updateStatus');
        Route::put('/type-user/{id}', [UserController::class, 'updateTypeUser'])->name('users.updateTypeUser');
        Route::put('/permissions/{id}',           [UserController::class,   'updatePermission'])->name('users.updatePermission');
    });


    Route::prefix('customers')->group(function () {
        Route::get('/',           [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/create',     [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/',          [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/{id}',       [CustomerController::class, 'show'])->name('customers.show');
        Route::get('/{id}',       [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/{id}',       [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/{id}',    [CustomerController::class, 'destroy'])->name('customers.destroy');
    });


    Route::prefix('departments')->group(function () {
        Route::get('/',           [DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/create',     [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/',          [DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/{id}',       [DepartmentController::class, 'show'])->name('departments.show');
        Route::get('/{id}',       [DepartmentController::class, 'edit'])->name('departments.edit');
        Route::put('/{id}',       [DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('/{id}',    [DepartmentController::class, 'destroy'])->name('departments.destroy');
    });



    Route::prefix('companies')->group(function () {
        Route::get('/',           [CompanyController::class, 'index'])->name('companies.index');
        Route::get('/create',     [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/',          [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/{id}',       [CompanyController::class, 'show'])->name('companies.show');
        Route::get('/{id}',       [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/{id}',       [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/{id}',    [CompanyController::class, 'destroy'])->name('companies.destroy');
    });


    Route::prefix('provinces')->group(function () {
        Route::get('/',           [ProvinceController::class, 'index'])->name('provinces.index');
        Route::get('/create',     [ProvinceController::class, 'create'])->name('provinces.create');
        Route::post('/',          [ProvinceController::class, 'store'])->name('provinces.store');
        Route::get('/{id}',       [ProvinceController::class, 'show'])->name('provinces.show');
        Route::get('/{id}',       [ProvinceController::class, 'edit'])->name('provinces.edit');
        Route::put('/{id}',       [ProvinceController::class, 'update'])->name('provinces.update');
        Route::delete('/{id}',    [ProvinceController::class, 'destroy'])->name('provinces.destroy');
    });

             
    Route::prefix('neighborhoods')->group(function () {
        Route::get('/',           [NeighborhoodController::class, 'index'])->name('neighborhoods.index');
        Route::get('/create',     [NeighborhoodController::class, 'create'])->name('neighborhoods.create');
        Route::post('/',          [NeighborhoodController::class, 'store'])->name('neighborhoods.store');
        Route::get('/{id}',       [NeighborhoodController::class, 'show'])->name('neighborhoods.show');
        Route::get('/{id}',       [NeighborhoodController::class, 'edit'])->name('neighborhoods.edit');
        Route::put('/{id}',       [NeighborhoodController::class, 'update'])->name('neighborhoods.update');
        Route::delete('/{id}',    [NeighborhoodController::class, 'destroy'])->name('neighborhoods.destroy');
    });

    Route::prefix('municipalities')->group(function () {
        Route::get('/',           [MunicipalityController::class, 'index'])->name('municipalities.index');
        Route::get('/create',     [MunicipalityController::class, 'create'])->name('municipalities.create');
        Route::post('/',          [MunicipalityController::class, 'store'])->name('municipalities.store');
        Route::get('/{id}',       [MunicipalityController::class, 'show'])->name('municipalities.show');
        Route::get('/{id}',       [MunicipalityController::class, 'edit'])->name('municipalities.edit');
        Route::put('/{id}',       [MunicipalityController::class, 'update'])->name('municipalities.update');
        Route::delete('/{id}',    [MunicipalityController::class, 'destroy'])->name('municipalities.destroy');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/',        [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create',  [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/',       [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/{id}',    [PermissionController::class, 'show'])->name('permissions.show');
        Route::get('/{id}',    [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/{id}',    [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    //============================= ROTAS ESPECIAS =================================
    Route::prefix('cart')->group(function () {
        Route::get   ('/',             [CartController::class, 'index'])   ->name('cart.index');
        Route::get   ('/create',       [CartController::class, 'create'])  ->name('cart.create');
        Route::post  ('/',             [CartController::class, 'store'])   ->name('cart.store');
      //Route::get   ('/{id}',         [CartController::class, 'show'])    ->name('cart.show');
      //Route::get   ('/{id}',         [CartController::class, 'edit'])    ->name('cart.edit');
        Route::post  ('/update/{product}', [CartController::class, 'update'])  ->name('cart.update');
        Route::get   ('/{id}',             [CartController::class, 'destroy']) ->name('cart.destroy');
        Route::post('/add/{product}',      [CartController::class,    'add'])->name('cart.add');
        Route::post('/checkout',           [CartController::class,     'checkout'])->name('cart.checkout');
    });

    Route::prefix('shop')->group(function () {
        Route::get   ('/',        [ShopController::class, 'index'])   ->name('shop.index');
    });


    //========== routes/web.php
    Route::get ('/invoices/{id}',            [InvoiceController::class, 'show'])->name('invoices.show'); 
    Route::get ('/invoices',                 [InvoiceController::class, 'search'])->name('invoices.search');
    Route::get('loja/',                      [ProductController::class, 'loja'])->name('loja.loja');
    Route::get('/invoices/{invoice}',        [InvoiceController::class, 'show'])->name('invoices.show');





    Route::prefix('user-permissions')->group(function () {
        Route::get('/',        [UserPermissionController::class, 'index'])->name('user-permissions.index');
        Route::get('/create',  [UserPermissionController::class, 'create'])->name('user-permissions.create');
        Route::post('/',       [UserPermissionController::class, 'store'])->name('user-permissions.store');
        Route::get('/{id}',    [UserPermissionController::class, 'show'])->name('user-permissions.show');
        Route::get('/{id}',    [UserPermissionController::class, 'edit'])->name('user-permissions.edit');
        Route::put('/{id}',    [UserPermissionController::class, 'update'])->name('user-permissions.update');
        Route::delete('/{id}', [UserPermissionController::class, 'destroy'])->name('user-permissions.destroy');
    });

  
    Route::prefix('products')->group(function () {
        Route::get('/',          [ProductController::class, 'index'])->name('products.index');
        Route::get('/create',    [ProductController::class, 'create'])->name('products.create');
        Route::post('/',         [ProductController::class, 'store'])->name('products.store');
        Route::get('/{id}',      [ProductController::class, 'show'])->name('products.show');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{id}',      [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{id}',   [ProductController::class, 'destroy'])->name('products.destroy');

    });

    Route::prefix('categories')->group(function () {
        Route::get('/',          [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create',    [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/',         [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{id}',      [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{id}',      [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{id}',   [CategoryController::class, 'destroy'])->name('categories.destroy');
    });


    
    Route::get('/opinions/create/{orderId}', [OpinionController::class, 'create'])->name('opinion.create');
    Route::post('/opinions', [OpinionController::class, 'store'])->name('opinions.store');

    Route::prefix('opinions')->group(function () {
        Route::get('/',          [OpinionController::class, 'index'])->name('opinion.index');
        Route::get('/create',    [OpinionController::class, 'create'])->name('opinion.create');
        Route::post('/',         [OpinionController::class, 'store'])->name('opinion.store');
        Route::get('/{id}',      [OpinionController::class, 'show'])->name('opinion.show');
        Route::get('/{id}/edit', [OpinionController::class, 'edit'])->name('opinion.edit');
        Route::put('/{id}',      [OpinionController::class, 'update'])->name('opinion.update');
        Route::delete('/{id}',   [OpinionController::class, 'destroy'])->name('opinions.destroy');
    });

    
    

    Route::prefix('orders')->group(function () {
        Route::get('/',          [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create',    [OrderController::class, 'create'])->name('orders.create');
        Route::post('/',         [OrderController::class, 'store'])->name('orders.store');
        Route::get('/show/{id}',      [OrderController::class, 'show'])->name('orders.show');
        //Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/{id}',      [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/{id}',   [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::put('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        //Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    });


    Route::prefix('orderItems')->group(function () {
        Route::get('/',          [OrderItemController::class, 'index'])->name('orderItems.index');
        Route::get('/create',    [OrderItemController::class, 'create'])->name('orderItems.create');
        Route::post('/',         [OrderItemController::class, 'store'])->name('orderItems.store');
        Route::get('/{id}',      [OrderItemController::class, 'show'])->name('orderItems.show');
        Route::get('/{id}/edit', [OrderItemController::class, 'edit'])->name('orderItems.edit');
        Route::put('/{id}',      [OrderItemController::class, 'update'])->name('orderItems.update');
        Route::delete('/{id}',   [OrderItemController::class, 'destroy'])->name('orderItems.destroy');
    });


    Route::prefix('orderTypes')->group(function () {
        Route::get('/service/{id}',   [OrderController::class, 'service'])->name('orderTypes.service');
        Route::get('/purchase/{id}',  [OrderController::class, 'purchase'])->name('orderTypes.purchase');
    });


    Route::prefix('status')->group(function () {
        Route::get('/',          [StatusController::class, 'index'])->name('status.index');
        Route::get('/create',    [StatusController::class, 'create'])->name('status.create');
        Route::post('/',         [StatusController::class, 'store'])->name('status.store');
        Route::get('/{id}',      [StatusController::class, 'show'])->name('status.show');
        Route::get('/{id}/edit', [StatusController::class, 'edit'])->name('status.edit');
        Route::put('/{id}',      [StatusController::class, 'update'])->name('status.update');
        Route::delete('/{id}',   [StatusController::class, 'destroy'])->name('status.destroy');
    });




    Route::get('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');
    Route::get('/email/create', [EmailController::class, 'create'])->name('email.create');
    Route::get('/email', [EmailController::class, 'index'])->name('email.index');





    Route::delete('/posts/{post}', [DashboardController::class, 'destroy'])->name('posts.destroy');
});
require __DIR__ . '/auth.php';
