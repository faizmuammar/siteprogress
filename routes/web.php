<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SiteProgress Enterprise Monitoring System
|--------------------------------------------------------------------------
*/

//URL Langsung ke Home
Route::redirect('/', '/home');
Route::redirect('/beranda', '/home');

//Home
Route::get('/home', function () {
    return '<h1>SiteProgress - Home Page</h1><p>Welcome to SiteProgress Enterprise Monitoring System for Industrial Construction.</p>';
})->name('home');

//About Us
Route::get('/about', function () {
    return '<h1>About Us</h1><p>SiteProgress is a real-time daily site monitoring web app built for large-scale industrial contractors.</p>';
})->name('about');

//Program
Route::prefix('program')->name('program.')->group(function () {
    
    //Halaman Utama Program
    Route::get('/', function () {
        return '<h1>Our Programs & Solutions</h1><ul><li><a href="/program/industrial">Industrial Factory Building</a></li><li><a href="/program/warehouse">Logistics Warehouse Construction</a></li></ul>';
    })->name('index');

    //Parameter Program
    Route::get('/{category}', function ($category) {
        $categoryName = ucfirst($category);
        return "<h1>Program Solution: {$categoryName}</h1><p>This is a dummy page for the <strong>{$categoryName}</strong> monitoring solution program.</p>";
    })->name('detail');

});

//Our Team
Route::prefix('our-team')->name('team.')->group(function () {

    // Halaman Our Team
    Route::get('/', function () {
        return '<h1>Our Team - Syntax Builders</h1><ul><li><a href="/our-team/ahmad-faiz">Ahmad Faiz Muammar (Ketua Tim)</a></li><li><a href="/our-team/muzakki-wafi">Muzakki Abdul Wafi (Anggota)</a></li></ul>';
    })->name('index');

    //Parameter Our Team
    Route::get('/{member}', function ($member) {
        $memberName = ucwords(str_replace('-', ' ', $member));
        return "<h1>Team Member Profile: {$memberName}</h1><p>Member profile detail page for <strong>{$memberName}</strong>.</p>";
    })->name('detail');

});

//Contact Us
Route::get('/contact-us', function () {
    return '<h1>Contact Us</h1><p>Get in touch with us at support@siteprogress.com or call +62 812-3456-7890.</p>';
})->name('contact');

//404 kalo eror
Route::fallback(function () {
    return '<h1 style="color: red;">404 - Page Not Found</h1><p>Sorry, the page you are looking for in SiteProgress does not exist.</p><a href="/home">Back to Home</a>';
});