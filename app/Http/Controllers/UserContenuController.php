<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserContenuController extends Controller
{
    public function index()
    {
        $contenus = Contenu::with(['typeContenu', 'region', 'langue'])
            ->where('id_auteur', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $statuts = $this->getStatutOptions();

        return view('user.contenus.index', compact('contenus', 'statuts'));
    }

    public function create()
    {
        $types = TypeContenu::orderBy('nom')->pluck('nom', 'id_type');
        $regions = Region::orderBy('nom_region')->pluck('nom_region', 'id_region');
        $langues = Langue::orderBy('nom_langue')->pluck('nom_langue', 'id_langue');
        $statuts = $this->getStatutOptions();
        
        // Les utilisateurs ne peuvent choisir que leurs propres contenus comme parents
        $parents = Contenu::where('id_auteur', Auth::id())
                         ->where('statut', 'publie')
                         ->pluck('titre', 'id_contenu');

        return view('user.contenus.create', compact('types', 'regions', 'langues', 'statuts', 'parents'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());

        // L'auteur est automatiquement l'utilisateur connecté
        $validatedData['id_auteur'] = Auth::id();
        $validatedData['date_creation'] = $validatedData['date_creation'] ?? now();
        
        // Les utilisateurs normaux ne peuvent pas publier directement
        if ($validatedData['statut'] === 'publie') {
            $validatedData['statut'] = 'en_attente'; // Doit être modéré
        }

        Contenu::create($validatedData);

        return redirect()->route('user.contenus.index')
                         ->with('success', 'Contenu créé avec succès. Il sera publié après modération.');
    }

    public function show($id)
    {
        $contenu = Contenu::with(['typeContenu', 'region', 'langue', 'parent'])
            ->where('id_auteur', Auth::id())
            ->findOrFail($id);
            
        $statuts = $this->getStatutOptions();

        return view('user.contenus.show', compact('contenu', 'statuts'));
    }

    public function edit($id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);
        
        $types = TypeContenu::orderBy('nom')->pluck('nom', 'id_type');
        $regions = Region::orderBy('nom_region')->pluck('nom_region', 'id_region');
        $langues = Langue::orderBy('nom_langue')->pluck('nom_langue', 'id_langue');
        $statuts = $this->getStatutOptions();
        
        $parents = Contenu::where('id_auteur', Auth::id())
                         ->where('statut', 'publie')
                         ->where('id_contenu', '!=', $id)
                         ->pluck('titre', 'id_contenu');

        return view('user.contenus.edit', compact('contenu', 'types', 'regions', 'langues', 'statuts', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);
        
        $validatedData = $request->validate($this->validationRules($id));
        
        // Si le statut passe à "publié", il doit être modéré
        if ($validatedData['statut'] === 'publie' && $contenu->statut !== 'publie') {
            $validatedData['statut'] = 'en_attente';
        }

        $contenu->update($validatedData);

        return redirect()->route('user.contenus.index')
                         ->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);
        $contenu->delete();

        return redirect()->route('user.contenus.index')
                         ->with('success', 'Contenu supprimé avec succès.');
    }

    protected function getStatutOptions()
    {
        return [
            'brouillon' => ['label' => 'Brouillon', 'badge' => 'bg-secondary'],
            'en_attente' => ['label' => 'En Attente de Modération', 'badge' => 'bg-warning text-dark'],
            'publie' => ['label' => 'Publié', 'badge' => 'bg-success'],
            'rejete' => ['label' => 'Rejeté', 'badge' => 'bg-danger'],
        ];
    }

    protected function validationRules($id = null)
    {
        return [
            'titre' => 'required|string|max:255',
            'id_type_contenu' => 'required|exists:type_contenus,id_type',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_parent' => 'nullable|exists:contenus,id_contenu',
            'texte' => 'required|string',
            'date_creation' => 'nullable|date',
            'statut' => ['required', Rule::in(['brouillon', 'en_attente'])], // Utilisateurs ne peuvent pas publier directement
        ];
    }
}