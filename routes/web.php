<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserMediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\UserContenuController;

// Page d'accueil publique
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

// Routes Breeze (DOIT être AVANT le groupe admin)
require __DIR__.'/auth.php';

// Routes admin (protégées) - IMPORTANT: Placer APRÈS auth.php
Route::middleware(['auth', CheckAdminRole::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        require __DIR__.'/admin.php';
    });

// Routes du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes publiques (si vous en avez)

    // Routes utilisateur (protégées)
Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Routes pour les contenus utilisateur
        Route::prefix('contenus')->name('contenus.')->group(function () {
            Route::get('/', [UserContenuController::class, 'index'])->name('index');
            Route::get('/create', [UserContenuController::class, 'create'])->name('create');
            Route::post('/', [UserContenuController::class, 'store'])->name('store');
            Route::get('/{id}', [UserContenuController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [UserContenuController::class, 'edit'])->name('edit');
            Route::put('/{id}', [UserContenuController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserContenuController::class, 'destroy'])->name('destroy');
        });

        // Routes pour les médias utilisateur
        Route::prefix('medias')->name('medias.')->group(function () {
            Route::get('/', [UserMediaController::class, 'index'])->name('index');
            Route::get('/create', [UserMediaController::class, 'create'])->name('create');
            Route::post('/', [UserMediaController::class, 'store'])->name('store');
            Route::get('/{id}', [UserMediaController::class, 'show'])->name('show');
            Route::delete('/{id}', [UserMediaController::class, 'destroy'])->name('destroy');
        });

        // Route profil utilisateur
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    });


// Routes pour initier le paiement (nécessite une authentification)
Route::middleware(['auth'])->group(function () {
    Route::get('/paiement/{contenu}', [PaiementController::class, 'show'])->name('paiement.show');
    Route::post('/paiement/process/{contenu}', [PaiementController::class, 'process'])->name('paiement.process');
});

// Routes de retour de Stripe (doivent être publiques)
Route::get('/paiement/succes/{session_id}', [PaiementController::class, 'success'])->name('paiement.success'); // Route pour le succès du paiement
Route::get('/paiement/cancel', [PaiementController::class, 'cancel'])->name('paiement.cancel');
