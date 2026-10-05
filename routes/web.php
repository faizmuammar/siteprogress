<?php

use Illuminate\Support\Facades\Route;

// 1. Redirect
Route::redirect('/', '/home');
Route::redirect('/beranda', '/home');

// 2. Home Page
Route::get('/home', function () {
    return view('home');
})->name('home');

// 3. About Page
Route::get('/about', function () {
    return view('about');
})->name('about');

// 4. Program Group & Details
Route::prefix('program')->name('program.')->group(function () {
    Route::get('/', function () {
        return view('program.index');
    })->name('index');

    Route::get('/{category}', function ($category) {
        return view('program.detail', ['category' => $category]);
    })->name('detail');
});

// 5. Our Team Group & Member Profile
Route::prefix('our-team')->name('team.')->group(function () {
    Route::get('/', function () {
        return view('team.index');
    })->name('index');

    Route::get('/{member}', function ($member) {
        $memberName = ucwords(str_replace('-', ' ', $member));
        return view('team.detail', [
            'member' => $member,
            'memberName' => $memberName
        ]);
    })->name('detail');
});

// 6. Contact Us Page
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// 7. Fallback Route (404 Page)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});