<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Mail\Email;
use App\Models\User;
use Faker\Provider\Payment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Guid\Fields;

Route::get('/', [FieldController::class, 'home'])->name('home');
Route::get('/field-detail/{id}', [FieldController::class, 'fielddetail'])->name('field.detail');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/email-test', function () {
    Mail::to('muhamadhabibieraysyahtoha@gmail.com')->send(new Email());
    return 'Email terikirim';
});


Route::get('/register', function () {
    return view('register');
})->name('register')->middleware('isGuest');

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('isGuest');

Route::post('/auth', [UserController::class, 'login'])->name('login.auth');
Route::post('/signup', [UserController::class, 'signup'])->name('register.signup');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/chartjs', [PaymentController::class, 'chartData'])->name('chart');
    Route::prefix('/fields')->name('fields.')->group(function () {
        Route::get('/', [FieldController::class, 'index'])->name('index');
        Route::post('/store', [FieldController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [FieldController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [FieldController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [FieldController::class, 'destroy'])->name('destroy');
        Route::get('/export', [FieldController::class, 'export'])->name('export');
        Route::get('/trash', [FieldController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [FieldController::class, 'restore'])->name('restore');
        Route::delete('/deletepermanent/{id}', [FieldController::class, 'deletepermanent'])->name('deletepermanent');
    });
    Route::prefix('/staff')->name('staffs.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('delete');
        Route::get('/export', [UserController::class, 'export'])->name('export');
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [UserController::class, 'restore'])->name('restore');
        Route::delete('/deletepermanent/{id}', [UserController::class, 'deletepermanent'])->name('deletepermanent');
    });
});

Route::middleware('isStaff')->prefix('/staff')->name('staff.')->group(function () {
    Route::get('/', function () {
        return view('staff.dashboard');
    })->name('dashboard');

    Route::prefix('/schedule')->name('schedules.')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::post('/store', [ScheduleController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ScheduleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ScheduleController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ScheduleController::class, 'destroy'])->name('destroy');
        Route::get('/export', [ScheduleController::class, 'export'])->name('export');
        Route::get('/trash', [ScheduleController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [ScheduleController::class, 'restore'])->name('restore');
        Route::delete('/deletepermanent/{id}', [ScheduleController::class, 'deletepermanent'])->name('deletepermanent');
    });

    Route::prefix('/booking')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::patch('/approve/{id}bb', [BookingController::class, 'approve'])->name('approve');
    });
});

Route::middleware('isUser')->prefix('/user')->name('user.')->group(function () {
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
    Route::put('/updateprofile/{id}', [UserController::class, 'updateprofile'])->name('update.profile');
    Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/payment/{id}', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/struk/payment/{id}', [PaymentController::class, 'struk'])->name('struk');
    Route::get('/struk/payment/export/{id}', [PaymentController::class, 'exportPdf'])->name('pdf');
    Route::prefix('/booking-user')->name('booking-user.')->group(function () {
        Route::get('/', [BookingController::class, 'bookingUser'])->name('index');
        Route::post('/transaksi/{id}', [PaymentController::class, 'store'])->name('store.payment');
        Route::get('/checkout/{id}', [PaymentController::class, 'checkout'])->name('checkout');
        Route::get('/success/{id}',[PaymentController::class,'success'])->name('success');
        Route::get('/cancel/{id}',[PaymentController::class,'cancel'])->name('cancel');
    });
});
