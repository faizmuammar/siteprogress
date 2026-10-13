<?php

use Illuminate\Support\Facades\Route;

// 1. ROUTE REDIRECT
Route::redirect('/', '/home');
Route::redirect('/beranda', '/home');

// 2. ROUTE HOME
Route::get('/home', function () {
    return view('home');
})->name('home');

// 3. ROUTE ABOUT
Route::get('/about', function () {
    return view('about');
})->name('about');

// 4. ROUTE PROGRAM (Group & Parameter)
Route::prefix('program')->name('program.')->group(function () {
    Route::get('/', function () {
        return view('program.index');
    })->name('index');

    Route::get('/{category}', function ($category) {
        return view('program.detail', ['category' => $category]);
    })->name('detail');
});

// 5. ROUTE OUR TEAM (Group & Parameter)
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

// 6. ROUTE CONTACT US
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// 7. ROUTE FALLBACK (404 Page)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});