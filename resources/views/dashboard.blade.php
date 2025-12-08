@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-primary">
                <i class="bi bi-speedometer2 me-2"></i>Tableau de Bord Administration
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="bi bi-house-fill me-1"></i>Tableau de Bord
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

<!-- Cartes Statistiques Améliorées -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4 dashboard-card">
        <div class="card border-start-4 border-start-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                            Langues
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['langues'] }}</div>
                        <div class="text-xs text-muted">
                            @if($statsEvolution['langues'] > 0)
                                <span class="text-success">
                                    <i class="bi bi-arrow-up"></i> +{{ $statsEvolution['langues'] }} ce mois
                                </span>
                            @else
                                <span class="text-muted">Aucun ajout récent</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-translate fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ url('/admin/langues') }}" class="text-decoration-none small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 dashboard-card">
        <div class="card border-start-4 border-start-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">
                            Contenus
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['contenus'] }}</div>
                        <div class="text-xs text-muted">
                            @if($statsEvolution['contenus'] > 0)
                                <span class="text-success">
                                    <i class="bi bi-arrow-up"></i> +{{ $statsEvolution['contenus'] }} ce mois
                                </span>
                            @else
                                <span class="text-muted">Aucun ajout récent</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-file-text fa-2x text-success"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ url('/admin/contenus') }}" class="text-decoration-none small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 dashboard-card">
        <div class="card border-start-4 border-start-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                            Médias
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['medias'] }}</div>
                        <div class="text-xs text-muted">
                            @if($statsEvolution['medias'] > 0)
                                <span class="text-success">
                                    <i class="bi bi-arrow-up"></i> +{{ $statsEvolution['medias'] }} ce mois
                                </span>
                            @else
                                <span class="text-muted">Aucun ajout récent</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-images fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ url('/admin/medias') }}" class="text-decoration-none small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 dashboard-card">
        <div class="card border-start-4 border-start-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-danger text-uppercase mb-1">
                            Utilisateurs
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['users'] }}</div>
                        <div class="text-xs text-muted">
                            @if($statsEvolution['users'] > 0)
                                <span class="text-success">
                                    <i class="bi bi-arrow-up"></i> +{{ $statsEvolution['users'] }} ce mois
                                </span>
                            @else
                                <span class="text-muted">Aucun ajout récent</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ url('/admin/users') }}" class="text-decoration-none small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Contenu Principal -->
<div class="row">
    <div class="col-lg-8">
        <!-- Activité Récente Dynamique -->
        <div class="card shadow mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-clock-history me-2"></i>Activité Récente
                </h5>
                <span class="badge bg-primary">{{ $activitesRecentes->count() }} activités</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0" style="width: 20%">Type</th>
                                <th class="border-0" style="width: 50%">Description</th>
                                <th class="border-0" style="width: 30%">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activitesRecentes as $activite)
                            <tr>
                                <td>
                                    <span class="badge bg-{{ $activite['couleur'] }} bg-opacity-10 text-{{ $activite['couleur'] }}">
                                        <i class="bi {{ $activite['icone'] }} me-1"></i>
                                        {{ ucfirst($activite['type']) }}
                                    </span>
                                </td>
                                <td>
                                    <strong>{{ $activite['description'] }}</strong>
                                </td>
                                <td>
                                    <small class="text-muted d-block">{{ $activite['date']->format('d/m/Y H:i') }}</small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                    Aucune activité récente
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="card shadow">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-lightning me-2"></i>Actions Rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ url('/admin/langues/create') }}" class="btn btn-outline-primary w-100 text-start p-3">
                            <i class="bi bi-plus-circle me-2"></i>
                            <div>
                                <strong>Ajouter une Langue</strong>
                                <br>
                                <small class="text-muted">Nouvelle langue</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/admin/contenus/create') }}" class="btn btn-outline-success w-100 text-start p-3">
                            <i class="bi bi-file-plus me-2"></i>
                            <div>
                                <strong>Créer un Contenu</strong>
                                <br>
                                <small class="text-muted">Nouveau contenu culturel</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/admin/medias/create') }}" class="btn btn-outline-warning w-100 text-start p-3">
                            <i class="bi bi-upload me-2"></i>
                            <div>
                                <strong>Uploader un Média</strong>
                                <br>
                                <small class="text-muted">Image, vidéo ou audio</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/admin/users/create') }}" class="btn btn-outline-info w-100 text-start p-3">
                            <i class="bi bi-person-plus me-2"></i>
                            <div>
                                <strong>Ajouter un Utilisateur</strong>
                                <br>
                                <small class="text-muted">Nouvel utilisateur</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Carte de Bienvenue Personnalisée -->
        <div class="card bg-primary text-white shadow mb-4">
            <div class="card-body">
                <div class="text-center">
                    <i class="bi bi-globe-americas display-4 opacity-75 mb-3"></i>
                    <h4 class="fw-bold">Bienvenue {{ auth()->user()->prenom ?? 'Administrateur' }}</h4>
                    <p class="mb-2">Plateforme de gestion du patrimoine culturel béninois</p>
                    <small class="opacity-75">
                        <i class="bi bi-calendar me-1"></i>
                        {{ now()->translatedFormat('l d F Y') }}
                    </small>
                </div>
            </div>
        </div>

        <!-- Statistiques Détaillées -->
        <div class="card shadow">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-graph-up me-2"></i>Statistiques Globales
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <i class="bi bi-translate text-primary me-2"></i>
                            <span>Langues actives</span>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $stats['langues'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <i class="bi bi-file-text text-success me-2"></i>
                            <span>Contenus publiés</span>
                        </div>
                        <span class="badge bg-success rounded-pill">{{ $stats['contenus'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <i class="bi bi-images text-warning me-2"></i>
                            <span>Médias uploadés</span>
                        </div>
                        <span class="badge bg-warning rounded-pill">{{ $stats['medias'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <i class="bi bi-people text-danger me-2"></i>
                            <span>Utilisateurs actifs</span>
                        </div>
                        <span class="badge bg-danger rounded-pill">{{ $stats['users'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <i class="bi bi-geo-alt text-info me-2"></i>
                            <span>Régions couvertes</span>
                        </div>
                        <span class="badge bg-info rounded-pill">{{ $stats['regions'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <i class="bi bi-chat-dots text-secondary me-2"></i>
                            <span>Commentaires</span>
                        </div>
                        <span class="badge bg-secondary rounded-pill">{{ $stats['commentaires'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="card shadow mt-4">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-link-45deg me-2"></i>Accès Rapide
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ url('/admin/langues') }}" class="btn btn-outline-primary btn-sm text-start">
                        <i class="bi bi-list-ul me-2"></i>Gérer les Langues
                    </a>
                    <a href="{{ url('/admin/contenus') }}" class="btn btn-outline-success btn-sm text-start">
                        <i class="bi bi-collection me-2"></i>Gérer les Contenus
                    </a>
                    <a href="{{ url('/admin/medias') }}" class="btn btn-outline-warning btn-sm text-start">
                        <i class="bi bi-folder me-2"></i>Gérer les Médias
                    </a>
                    <a href="{{ url('/admin/users') }}" class="btn btn-outline-info btn-sm text-start">
                        <i class="bi bi-people me-2"></i>Gérer les Utilisateurs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.dashboard-card .card {
    border: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.dashboard-card .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.border-start-4 {
    border-left-width: 4px !important;
    border-left-style: solid;
    border-color: var(--bs-border-color); /* Fallback */
}

.btn-outline-primary, .btn-outline-success, .btn-outline-warning, .btn-outline-info {
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white;
}

.btn-outline-success:hover {
    background-color: #198754;
    color: white;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    color: black;
}

.btn-outline-info:hover {
    background-color: #0dcaf0;
    color: black;
}
</style>
