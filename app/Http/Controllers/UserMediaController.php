<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserMediaController extends Controller
{
    public function index()
    {
        $medias = Media::with('typeMedia')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('user.medias.index', compact('medias'));
    }

    public function create()
    {
        $types = TypeMedia::orderBy('nom')->pluck('nom', 'id_type');
        return view('user.medias.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_media' => 'required|exists:type_medias,id_type',
            'fichier' => 'required|file|max:10240', // 10MB max
            'description' => 'nullable|string|max:500',
        ]);

        // Upload du fichier
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $path = $file->store('public/medias');
            $chemin = str_replace('public/', 'storage/', $path);
            
            // Création du média
            Media::create([
                'id_type_media' => $request->id_type_media,
                'Chemin' => $chemin,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('user.medias.index')
                         ->with('success', 'Média uploadé avec succès.');
    }

    public function show($id)
    {
        $media = Media::with('typeMedia')->findOrFail($id);
        return view('user.medias.show', compact('media'));
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        
        // Suppression du fichier physique
        if (Storage::exists(str_replace('storage/', 'public/', $media->Chemin))) {
            Storage::delete(str_replace('storage/', 'public/', $media->Chemin));
        }
        
        $media->delete();

        return redirect()->route('user.medias.index')
                         ->with('success', 'Média supprimé avec succès.');
    }
}