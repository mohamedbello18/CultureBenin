@extends('user.layout')

@section('title', 'Mes Contenus - Culture Benin')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-success">
            <i class="bi bi-file-text me-2"></i>Mes Contenus
        </h1>
        <a href="{{ route('user.contenus.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Nouveau Contenu
        </a>
    </div>

    <!-- Statistiques rapides -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card stat-card-success">
                <div class="card-body text-center py-3">
                    <div class="h4 mb-1">{{ $contenus->where('statut', 'publie')->count() }}</div>
                    <small class="text-muted">Publiés</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-warning">
                <div class="card-body text-center py-3">
                    <div class="h4 mb-1">{{ $contenus->where('statut', 'en_attente')->count() }}</div>
                    <small class="text-muted">En attente</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-secondary">
                <div class="card-body text-center py-3">
                    <div class="h4 mb-1">{{ $contenus->where('statut', 'brouillon')->count() }}</div>
                    <small class="text-muted">Brouillons</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center py-3">
                    <div class="h4 mb-1">{{ $contenus->total() }}</div>
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des contenus -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contenus as $contenu)
                        <tr>
                            <td>
                                <strong class="d-block">{{ Str::limit($contenu->titre, 50) }}</strong>
                                <small class="text-muted">{{ $contenu->region->nom_region ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $contenu->typeContenu->nom ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusInfo = $statuts[$contenu->statut] ?? $statuts['brouillon'];
                                @endphp
                                <span class="badge {{ $statusInfo['badge'] }}">
                                    {{ $statusInfo['label'] }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $contenu->created_at->format('d/m/Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('user.contenus.show', $contenu->id_contenu) }}" 
                                       class="btn btn-outline-primary" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('user.contenus.edit', $contenu->id_contenu) }}" 
                                       class="btn btn-outline-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('user.contenus.destroy', $contenu->id_contenu) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" 
                                                title="Supprimer"
                                                onclick="return confirm('Supprimer ce contenu ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-file-earmark-text display-4 d-block mb-3"></i>
                                Aucun contenu créé pour le moment
                                <br>
                                <a href="{{ route('user.contenus.create') }}" class="btn btn-success mt-3">
                                    Créer votre premier contenu
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($contenus->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $contenus->links() }}
    </div>
    @endif
</div>

<style>
.stat-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
</style>
@endsection