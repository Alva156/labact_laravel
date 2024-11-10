<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\OpinionsController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\MainController;





//Guest
Route::get('/', [MainController::class, 'welcome2'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/schedule', [MatchesController::class, 'schedule'])->name('schedule');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/history', [HistoriesController::class, 'history'])->name('history');
Route::get('/faqs', [FaqsController::class, 'faqs'])->name('faqs');
Route::get('/opinions', [OpinionsController::class, 'opinions'])->name('opinions');
Route::get('/contact', [ProductController::class, 'contact'])->name('contact');

// Authenticated Users and Admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // Admin and User
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::delete('/delete-opinion/{id}', [OpinionsController::class, 'destroy'])->name('delete-opinion');
    Route::post('/restore-opinion/{id}', [OpinionsController::class, 'restore'])->name('restore-opinion');
    Route::delete('/force-delete-opinion/{id}', [OpinionsController::class, 'forceDelete'])->name('force-delete-opinion');
    
    // Admin
    Route::middleware('isRole:admin')->group(function () {

        //Main Controller
    Route::get('/user-list', [MainController::class, 'userlist'])->name('user-list');

        //Product Controller
    Route::get('/manage-shop', [ProductController::class, 'mshop'])->name('manage-shop');
    Route::get('/add-product', [ProductController::class, 'addproduct'])->name('add-product');
    Route::get('/edit-product/{id}', [ProductController::class, 'editproduct'])->name('edit-product');
    Route::post('/store-product', [ProductController::class, 'storeproduct'])->name('store-product');
    Route::put('/update-product/{id}', [ProductController::class, 'updateproduct'])->name('update-product');
    Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');
    Route::post('/restore-product/{id}', [ProductController::class, 'restore'])->name('restore-product');
    Route::delete('/force-delete-product/{id}', [ProductController::class, 'forceDelete'])->name('force-delete-product');

      //Matches Controller
    Route::get('/manage-schedule', [MatchesController::class, 'mschedule'])->name('manage-schedule');
    Route::get('/add-schedule', [MatchesController::class, 'addschedule'])->name('add-schedule');
    Route::get('/edit-schedule/{id}', [MatchesController::class, 'editschedule'])->name('edit-schedule');
    Route::post('/store-schedule', [MatchesController::class, 'storeschedule'])->name('store-schedule');
    Route::delete('/delete-schedule/{id}', [MatchesController::class, 'destroy'])->name('delete-schedule');
    Route::post('/restore-schedule/{id}', [MatchesController::class, 'restore'])->name('restore-schedule');
    Route::delete('/force-delete-schedule/{id}', [MatchesController::class, 'forceDelete'])->name('force-delete-schedule');
    Route::put('/update-schedule/{id}', [MatchesController::class, 'updateschedule'])->name('update-schedule');

        //Histories Controller
    Route::get('/manage-history', [HistoriesController::class, 'mhistory'])->name('manage-history');
    Route::get('/add-history', [HistoriesController::class, 'addhistory'])->name('add-history');
    Route::get('/edit-history/{id}', [HistoriesController::class, 'edithistory'])->name('edit-history');
    Route::post('/store-history', [HistoriesController::class, 'storeshistory'])->name('store-history');
    Route::put('/update-history/{id}', [HistoriesController::class, 'updatehistory'])->name('update-history');
    Route::delete('/delete-history/{id}', [HistoriesController::class, 'destroy'])->name('delete-history');
    Route::post('/restore-history/{id}', [HistoriesController::class, 'restore'])->name('restore-history');
    Route::delete('/force-delete-history/{id}', [HistoriesController::class, 'forceDelete'])->name('force-delete-history');

        //Opinions Controller
    Route::get('/manage-opinions', [OpinionsController::class, 'mopinions'])->name('manage-opinions');
    

        //Faqs Controller
    Route::get('/manage-faqs', [FaqsController::class, 'mfaqs'])->name('manage-faqs');
    Route::get('/add-faqs', [FaqsController::class, 'addfaqs'])->name('add-faqs');
    Route::get('/edit-faqs/{id}', [FaqsController::class, 'editfaqs'])->name('edit-faqs');
    Route::post('/store-faq', [FaqsController::class, 'storesfaq'])->name('store-faq');
    Route::put('/update-faq/{id}', [FaqsController::class, 'updatefaq'])->name('update-faq');
    Route::delete('/delete-faq/{id}', [FaqsController::class, 'destroy'])->name('delete-faq');
    Route::post('/restore-faq/{id}', [FaqsController::class, 'restore'])->name('restore-faq');
    Route::delete('/force-delete-faq/{id}', [FaqsController::class, 'forceDelete'])->name('force-delete-faq');
});
    //User
    Route::middleware('isRole:user')->group(function () {
        
        //Matches Controller
    Route::get('/user-schedule', [MatchesController::class, 'userschedule'])->name('user-schedule');
    Route::get('/user-book/{id}', [MatchesController::class, 'userbook'])->name('user-book');
    Route::post('/store-book', [MatchesController::class, 'storebook'])->name('store-book');
    Route::get('/user-schedreserve', [MatchesController::class, 'userschedreserve'])->name('user-schedreserve');

        //Product Controller
    Route::get('/user-shop', [ProductController::class, 'usershop'])->name('user-shop');
    Route::get('/user-buy/{id}', [ProductController::class, 'userbuy'])->name('user-buy');
    Route::post('/store-buy', [ProductController::class, 'storesbuy'])->name('store-buy');
    Route::get('/user-shopreserve', [ProductController::class, 'usershopreserve'])->name('user-shopreserve');
    Route::get('/user-product-post/{slug}', [ProductController::class, 'post'])->where('slug', '[a-zA-Z0-9\-]+')->name('user-product-post');

        //Opinions Controller
    Route::get('/user-share', [OpinionsController::class, 'usershare'])->name('user-share');
    Route::get('/user-opinions', [OpinionsController::class, 'useropinions'])->name('user-opinions');
    Route::post('/store-opinion', [OpinionsController::class, 'storesopinion'])->name('store-opinion');
    Route::get('/user-myopinions', [OpinionsController::class, 'myopinions'])->name('user-myopinions');
    Route::get('/user-editopinions/{id}', [OpinionsController::class, 'editopinions'])->name('user-editopinions');
    Route::put('/user-updateopinion/{id}', [OpinionsController::class, 'updateopinion'])->name('user-updateopinion');
    

         //Histories Controller
    Route::get('/user-history', [HistoriesController::class, 'userhistory'])->name('user-history');
    
        //Faqs Controller
    Route::get('/user-faqs', [FaqsController::class, 'userfaqs'])->name('user-faqs');
  
});

});