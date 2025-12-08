<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Media;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    /**
     * Affiche la page d'accueil avec toutes les données nécessaires.
     */
    public function index()
    {
        // 1. Récupérer les statistiques pour les compteurs
        $stats = [
            'contenus' => Contenu::count(),
            'medias' => Media::count(),
            'langues' => Langue::count(),
            'regions' => Region::count(),
        ];

        // 2. Récupérer les contenus récents
        $contenusRecents = Contenu::with(['typeContenu', 'region', 'langue'])
            ->where('statut', 1) // CORRECTION : Utiliser la valeur numérique (1) pour 'publié'
            ->latest() // Raccourci pour orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // 3. Récupérer les médias récents
        $mediasRecents = Media::with('typeMedia')
            ->latest()
            ->take(4)
            ->get();

        // 4. Vérifier les paiements de l'utilisateur connecté pour les contenus affichés
        $paidContentIds = [];
        if (Auth::check()) {
            $paidContentIds = Auth::user()->paiements()
                ->whereIn('contenu_id', $contenusRecents->pluck('id_contenu'))
                ->where('statut_paiement', 'reussi')
                ->pluck('contenu_id')
                ->toArray();
        }

        // 5. Passer toutes les données à la vue
        return view('welcome', [
            'stats' => $stats,
            'contenusRecents' => $contenusRecents,
            'mediasRecents' => $mediasRecents,
            'paidContentIds' => $paidContentIds,
        ]);
    }
}