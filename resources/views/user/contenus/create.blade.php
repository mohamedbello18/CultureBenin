@extends('user.layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 text-culture-green">
            <i class="bi bi-plus-circle-fill me-2"></i>Créer un Contenu
        </h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.contenus.index') }}" class="text-decoration-none">Mes Contenus</a></li>
            <li class="breadcrumb-item active text-culture-green" aria-current="page">Création</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Erreur(s) de Validation :</h4>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 text-white">
                        <i class="bi bi-pencil-square me-2"></i>Détails du Contenu
                    </h3>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-person-fill"></i> {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                    </span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('user.contenus.store') }}" method="POST">
                    @csrf
                    
                    <h5 class="text-primary mb-3"><i class="bi bi-card-heading me-2"></i>Identification</h5>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="titre" class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                   id="titre" name="titre" value="{{ old('titre') }}" 
                                   placeholder="Ex: Les Traditions Vodoun au Sud-Bénin" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-columns-gap me-2"></i>Classification</h5>
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <label for="id_type_contenu" class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_type_contenu') is-invalid @enderror" 
                                    id="id_type_contenu" name="id_type_contenu" required>
                                <option value="">Choisir...</option>
                                @foreach($types as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_type_contenu') == $id ? 'selected' : '' }}>
                                        {{ $nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_type_contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="id_region" class="form-label fw-semibold">Région <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_region') is-invalid @enderror" 
                                    id="id_region" name="id_region" required>
                                <option value="">Choisir...</option>
                                @foreach($regions as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_region') == $id ? 'selected' : '' }}>
                                        {{ $nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_region')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="id_langue" class="form-label fw-semibold">Langue <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_langue') is-invalid @enderror" 
                                    id="id_langue" name="id_langue" required>
                                <option value="">Choisir...</option>
                                @foreach($langues as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_langue') == $id ? 'selected' : '' }}>
                                        {{ $nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_langue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <label for="id_parent" class="form-label fw-semibold">Contenu Parent</label>
                            <select class="form-select @error('id_parent') is-invalid @enderror" 
                                    id="id_parent" name="id_parent">
                                <option value="">Aucun parent</option>
                                @foreach($parents as $id => $titre)
                                    <option value="{{ $id }}" {{ old('id_parent') == $id ? 'selected' : '' }}>
                                        {{ Str::limit($titre, 40) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_parent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-person-fill-gear me-2"></i>Statut</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="statut" class="form-label fw-semibold">Statut <span class="text-danger">*</span></label>
                            <select class="form-select @error('statut') is-invalid @enderror" 
                                    id="statut" name="statut" required>
                                <option value="">Choisir...</option>
                                @foreach($statuts as $key => $info)
                                    @if(in_array($key, ['brouillon', 'en_attente']))
                                        <option value="{{ $key }}" {{ old('statut', 'brouillon') == $key ? 'selected' : '' }}>
                                            {{ $info['label'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <small class="text-muted mt-1 d-block">
                                <i class="bi bi-info-circle me-1"></i> 
                                Le statut "En attente" nécessite une modération avant publication.
                            </small>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label for="date_creation" class="form-label fw-semibold">Date de Création</label>
                            <input type="date" class="form-control @error('date_creation') is-invalid @enderror" 
                                   id="date_creation" name="date_creation" 
                                   value="{{ old('date_creation', now()->format('Y-m-d')) }}">
                            @error('date_creation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-body-text me-2"></i>Corps du Contenu</h5>
                    <div class="mb-4">
                        <label for="texte" class="form-label fw-semibold">Contenu Textuel/HTML <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('texte') is-invalid @enderror" 
                                  id="texte" name="texte" rows="12" 
                                  placeholder="Rédigez votre contenu ici..." required>{{ old('texte') }}</textarea>
                        @error('texte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                        <a href="{{ route('user.contenus.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <div class="btn-group">
                            <button type="submit" name="action" value="save_draft" 
                                    class="btn btn-warning">
                                <i class="bi bi-save me-2"></i>Enregistrer comme brouillon
                            </button>
                            <button type="submit" name="action" value="submit" 
                                    class="btn btn-success">
                                <i class="bi bi-send me-2"></i>Soumettre pour modération
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Guide d'aide -->
        <div class="card mt-4 border-warning">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">
                    <i class="bi bi-lightbulb-fill me-2"></i>Conseils pour un bon contenu
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-semibold mb-1">Titre clair et descriptif</h6>
                                <p class="text-muted mb-0 small">Utilisez un titre qui résume bien votre contenu</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-semibold mb-1">Structure organisée</h6>
                                <p class="text-muted mb-0 small">Utilisez des paragraphes, titres et listes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-semibold mb-1">Orthographe vérifiée</h6>
                                <p class="text-muted mb-0 small">Relisez votre texte avant soumission</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-semibold mb-1">Sources citées</h6>
                                <p class="text-muted mb-0 small">Citez vos sources et respectez les droits d'auteur</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3 mb-0">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Note importante :</strong> Tous les contenus soumis pour publication seront modérés par un administrateur avant d'être publiés sur la plateforme.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-header-culture {
    background: linear-gradient(135deg, #008751 0%, #fcd116 50%, #e8112d 100%);
    border-bottom: none;
}

.form-control:focus, .form-select:focus {
    border-color: #008751;
    box-shadow: 0 0 0 0.25rem rgba(0, 135, 81, 0.25);
}

.btn-warning {
    background: linear-gradient(135deg, #fcd116 0%, #ffed4e 100%);
    border-color: #fcd116;
    color: #000;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e8b90c 0%, #f5e048 100%);
    border-color: #e8b90c;
    color: #000;
}

.btn-success {
    background: linear-gradient(135deg, #008751 0%, #00a862 100%);
    border-color: #008751;
}

.btn-success:hover {
    background: linear-gradient(135deg, #007044 0%, #009755 100%);
    border-color: #007044;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des boutons d'action
    const submitBtn = document.querySelector('button[value="submit"]');
    const draftBtn = document.querySelector('button[value="save_draft"]');
    const statutSelect = document.getElementById('statut');
    
    if (submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            statutSelect.value = 'en_attente';
        });
    }
    
    if (draftBtn) {
        draftBtn.addEventListener('click', function(e) {
            statutSelect.value = 'brouillon';
        });
    }
    
    // Compteur de caractères pour le titre
    const titreInput = document.getElementById('titre');
    const titreCounter = document.createElement('small');
    titreCounter.className = 'text-muted float-end mt-1';
    titreCounter.textContent = '0/255 caractères';
    titreInput.parentNode.appendChild(titreCounter);
    
    titreInput.addEventListener('input', function() {
        titreCounter.textContent = `${this.value.length}/255 caractères`;
        if (this.value.length > 250) {
            titreCounter.className = 'text-danger float-end mt-1';
        } else if (this.value.length > 200) {
            titreCounter.className = 'text-warning float-end mt-1';
        } else {
            titreCounter.className = 'text-muted float-end mt-1';
        }
    });
    
    // Compteur de caractères pour le contenu
    const texteTextarea = document.getElementById('texte');
    const texteCounter = document.createElement('small');
    texteCounter.className = 'text-muted float-end mt-1';
    texteCounter.textContent = '0 caractères';
    texteTextarea.parentNode.appendChild(texteCounter);
    
    texteTextarea.addEventListener('input', function() {
        texteCounter.textContent = `${this.value.length} caractères`;
        if (this.value.length < 100) {
            texteCounter.className = 'text-danger float-end mt-1';
        } else if (this.value.length < 300) {
            texteCounter.className = 'text-warning float-end mt-1';
        } else {
            texteCounter.className = 'text-muted float-end mt-1';
        }
    });
});
</script>
@endsection