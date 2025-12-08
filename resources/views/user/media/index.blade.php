@extends('user.layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 text-culture-green">
            <i class="bi bi-images me-2"></i>Mes Médias
        </h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active text-culture-green" aria-current="page">Médias</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-success">
            <i class="bi bi-images me-2"></i>Ma Galerie de Médias
        </h1>
        <a href="{{ route('user.medias.create') }}" class="btn btn-success">
            <i class="bi bi-upload me-1"></i>Uploader un média
        </a>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center py-3">
                    <div class="h4 mb-1">{{ $medias->total() }}</div>
                    <small class="text-muted">Total médias</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Galerie -->
    @if($medias->count() > 0)
        <div class="row">
            @foreach($medias as $media)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card media-card h-100">
                    <div class="media-thumbnail">
                        @if(str_contains(strtolower($media->typeMedia->nom ?? ''), 'image'))
                            <img src="{{ asset($media->Chemin) }}" alt="{{ $media->description }}" class="img-fluid">
                        @elseif(str_contains(strtolower($media->typeMedia->nom ?? ''), 'vidéo'))
                            <div class="video-thumbnail">
                                <i class="bi bi-play-circle-fill"></i>
                            </div>
                        @elseif(str_contains(strtolower($media->typeMedia->nom ?? ''), 'audio'))
                            <div class="audio-thumbnail">
                                <i class="bi bi-music-note-beamed"></i>
                            </div>
                        @else
                            <div class="file-thumbnail">
                                <i class="bi bi-file-earmark"></i>
                            </div>
                        @endif
                        <div class="media-type-badge">
                            {{ $media->typeMedia->nom ?? 'Fichier' }}
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text small mb-2">
                            {{ Str::limit($media->description, 60) }}
                        </p>
                        <small class="text-muted d-block mb-2">
                            {{ $media->created_at->format('d/m/Y') }}
                        </small>
                        <div class="d-flex justify-content-between">
                            <a href="{{ asset($media->Chemin) }}" target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('user.medias.destroy', $media->id_media) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Supprimer ce média ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $medias->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-images display-4 text-muted d-block mb-3"></i>
            <h3 class="text-muted">Aucun média uploadé</h3>
            <p class="text-muted">Commencez par uploader vos premiers médias</p>
            <a href="{{ route('user.medias.create') }}" class="btn btn-success">
                <i class="bi bi-upload me-1"></i>Uploader un média
            </a>
        </div>
    @endif
</div>

<style>
.media-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.media-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.media-thumbnail {
    height: 150px;
    overflow: hidden;
    position: relative;
    border-radius: 10px 10px 0 0;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.media-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-thumbnail, .audio-thumbnail, .file-thumbnail {
    font-size: 3rem;
    color: #6c757d;
}

.media-type-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 3px 8px;
    border-radius: 5px;
    font-size: 0.7rem;
}
</style>
@endsection