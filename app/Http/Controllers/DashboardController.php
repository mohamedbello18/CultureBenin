<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Media;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistiques dynamiques
        $stats = [
            'langues' => Langue::count(),
            'contenus' => Contenu::count(),
            'medias' => Media::count(),
            'users' => User::count(),
            'regions' => Region::count(),
            'commentaires' => Commentaire::count(),
        ];

        // 2. Statistiques d'évolution (comparaison avec le mois dernier)
        $moisDernier = now()->subMonth();
        $statsEvolution = [
            'langues' => Langue::where('created_at', '>=', $moisDernier)->count(),
            'contenus' => Contenu::where('created_at', '>=', $moisDernier)->count(),
            'medias' => Media::where('created_at', '>=', $moisDernier)->count(),
            'users' => User::where('created_at', '>=', $moisDernier)->count(),
        ];

        // 3. Activités récentes
        $languesRecentes = Langue::latest()->take(3)->get()->map(fn($item) => [
            'type' => 'langue',
            'icone' => 'bi-translate',
            'couleur' => 'primary',
            'description' => 'Nouvelle langue : ' . $item->nom_langue,
            'date' => $item->created_at,
        ]);

        $contenusRecents = Contenu::latest()->take(3)->get()->map(fn($item) => [
            'type' => 'contenu',
            'icone' => 'bi-file-text',
            'couleur' => 'success',
            'description' => 'Nouveau contenu : ' . Str::limit($item->titre, 40),
            'date' => $item->created_at,
        ]);

        $mediasRecents = Media::latest()->take(2)->get()->map(fn($item) => [
            'type' => 'media',
            'icone' => 'bi-image',
            'couleur' => 'warning',
            'description' => 'Média uploadé : ' . Str::limit($item->description ?? 'N/A', 30),
            'date' => $item->created_at,
        ]);

        $usersRecents = User::latest()->take(2)->get()->map(fn($item) => [
            'type' => 'utilisateur',
            'icone' => 'bi-person',
            'couleur' => 'info',
            'description' => 'Nouvel utilisateur : ' . $item->prenom . ' ' . $item->nom,
            'date' => $item->created_at,
        ]);

        // Fusionner et trier toutes les activités
        $activitesRecentes = collect()
            ->merge($languesRecentes)
            ->merge($contenusRecents)
            ->merge($mediasRecents)
            ->merge($usersRecents)
            ->sortByDesc('date')
            ->take(8);

        return view('dashboard', [
            'stats' => $stats,
            'statsEvolution' => $statsEvolution,
            'activitesRecentes' => $activitesRecentes,
        ]);
    }
}
