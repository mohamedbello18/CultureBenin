<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Culture Benin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ asset('adminlte/img/logo-culture-benin.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #e17000;
            --secondary-color: #008000;
            --accent-color: #ffd700;
            --dark-color: #1a1d21;
            --light-color: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
            --gradient-benin: linear-gradient(135deg, #008000 0%, #ffd700 50%, #e17000 100%);
            --gradient-header: linear-gradient(135deg, #008751 0%, #fcd116 50%, #e8112d 100%);
            --gradient-gold: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            --success-color: #198754;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* ===== HEADER PROFESSIONNEL ===== */
        .main-header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header-scrolled {
            box-shadow: 0 8px 60px rgba(0, 0, 0, 0.12);
            padding: 0.8rem 0;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-wrapper {
            width: 60px;
            height: 60px;
            background: var(--gradient-benin);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(225, 112, 0, 0.3);
            transition: all 0.3s ease;
            padding: 5px;
            position: relative;
            overflow: hidden;
        }

        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
            background: white;
        }

        .brand-text {
            font-size: 1.8rem;
            font-weight: 900;
            background: var(--gradient-benin);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .brand-tagline {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
            margin-top: -2px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            text-align: right;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: #666;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        /* Bouton déconnexion dans le header */
        .btn-logout-header {
            background: transparent;
            color: #dc3545;
            border: 2px solid #dc3545;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            white-space: nowrap;
        }

        .btn-logout-header:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* ===== CONTENU PRINCIPAL ===== */
        .dashboard-container {
            max-width: 1400px;
            margin: 100px auto 40px;
            padding: 0 2rem;
        }

        /* Message de bienvenue amélioré */
        .welcome-alert {
            background: linear-gradient(135deg, var(--success-color) 0%, #157347 100%);
            border: none;
            border-radius: 16px;
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-alert::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        /* Cartes statistiques améliorées */
        .stat-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .stat-card-success::before { background: var(--success-color); }
        .stat-card-warning::before { background: var(--warning-color); }
        .stat-card-info::before { background: var(--info-color); }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon-success { background: var(--success-color); }
        .stat-icon-warning { background: var(--warning-color); }
        .stat-icon-info { background: var(--info-color); }

        /* Table améliorée */
        .content-table {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .content-table thead {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #006400 100%);
            color: white;
        }

        .content-table th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .content-table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f1f3f4;
        }

        .content-table tbody tr {
            transition: all 0.3s ease;
        }

        .content-table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        /* Actions rapides améliorées */
        .quick-action-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .quick-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .action-btn {
            border: 2px solid;
            border-radius: 12px;
            padding: 1.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            text-decoration: none;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        /* Profil utilisateur amélioré */
        .profile-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }

        /* Guide amélioré */
        .guide-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .guide-item {
            border: none;
            padding: 1rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .guide-item:hover {
            background-color: #f8f9fa;
            padding-left: 1rem;
        }

        .guide-icon {
            width: 30px;
            height: 30px;
            background: var(--success-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        /* Badges améliorés */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== FOOTER PROFESSIONNEL ===== */
        .main-footer {
            background: var(--dark-color);
            color: white;
            padding-top: 60px;
            border-top: 5px solid var(--secondary-color);
            margin-top: 4rem;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem 40px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .footer-logo-img {
            width: 50px;
            height: 50px;
            background: var(--gradient-benin);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }

        .footer-logo-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
            background: white;
        }

        .footer-brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-description {
            font-size: 0.95rem;
            color: #aaa;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            font-size: 1.5rem;
            color: #aaa;
            transition: color 0.3s ease;
        }

        .social-link:hover {
            color: var(--primary-color);
        }

        .footer-heading {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .footer-heading:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 30px;
            height: 2px;
            background: var(--accent-color);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-link {
            color: #aaa;
            text-decoration: none;
            display: block;
            padding: 5px 0;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .footer-link:hover {
            color: white;
            transform: translateX(5px);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #aaa;
            margin-bottom: 10px;
        }

        .contact-item i {
            color: var(--primary-color);
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.2);
            padding: 15px 2rem;
            text-align: center;
        }

        .footer-bottom-text {
            font-size: 0.85rem;
            color: #888;
            margin: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .footer-top {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 0 1rem;
                margin-top: 80px;
            }

            .header-container {
                padding: 0 1rem;
            }

            .footer-top {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 0 1rem 40px;
            }

            .user-info .user-name {
                display: none;
            }

            .btn-logout-header {
                padding: 0.4rem 0.8rem;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 576px) {
            .brand-text {
                font-size: 1.4rem;
            }

            .welcome-alert {
                padding: 1.5rem;
            }

            .stat-card {
                margin-bottom: 1rem;
            }

            .user-info {
                gap: 0.5rem;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header" id="mainHeader">
        <div class="header-container">
            <div class="logo-section">
                <div class="logo-wrapper">
                    <a href="{{ url('/') }}" class="brand-link text-white">
                        <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" class="logo-img">
                    </a>
                </div>
                <div>
                    <div class="brand-text">CULTURE BENIN</div>
                    <div class="brand-tagline">Patrimoine Culturel National</div>
                </div>
            </div>

            <div class="user-menu">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
                    </div>
                    <div>
                        <div class="user-name">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</div>
                        <div class="user-role">Membre</div>
                    </div>
                    <a href="{{ route('logout') }}" 
                       class="btn-logout-header"
                       onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                        <i class="bi bi-box-arrow-right"></i>Déconnexion
                    </a>
                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main class="dashboard-container">
        <!-- Message de bienvenue -->
        <div class="welcome-alert animate-fade-in">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-2">
                        <i class="bi bi-emoji-smile me-2"></i>Bienvenue {{ auth()->user()->prenom }} {{ auth()->user()->nom }} !
                    </h3>
                    <p class="mb-0 opacity-90">Vous êtes connecté à votre espace membre Culture Benin.</p>
                </div>
                <div class="col-md-4 text-end">
                    <i class="bi bi-person-check display-4 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Cartes Statistiques -->
        <div class="row mb-5 animate-fade-in">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="stat-card stat-card-success h-100">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Mes Contenus</div>
                                <div class="h3 fw-bold text-dark mb-1">{{ $stats['contenus'] ?? 0 }}</div>
                                <div class="text-muted small">Contenus publiés</div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="stat-icon stat-icon-success">
                                    <i class="bi bi-file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="{{ url('/user/contenus') }}" class="btn btn-sm btn-outline-success w-100">
                            <i class="bi bi-arrow-right me-1"></i>Gérer mes contenus
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="stat-card stat-card-warning h-100">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Mes Médias</div>
                                <div class="h3 fw-bold text-dark mb-1">{{ $stats['medias'] ?? 0 }}</div>
                                <div class="text-muted small">Médias uploadés</div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="stat-icon stat-icon-warning">
                                    <i class="bi bi-images"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="{{ url('/user/medias') }}" class="btn btn-sm btn-outline-warning w-100">
                            <i class="bi bi-arrow-right me-1"></i>Gérer mes médias
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="stat-card stat-card-info h-100">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Mes Commentaires</div>
                                <div class="h3 fw-bold text-dark mb-1">{{ $stats['commentaires'] ?? 0 }}</div>
                                <div class="text-muted small">Commentaires postés</div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="stat-icon stat-icon-info">
                                    <i class="bi bi-chat-dots"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="{{ url('/user/commentaires') }}" class="btn btn-sm btn-outline-info w-100">
                            <i class="bi bi-arrow-right me-1"></i>Voir mes commentaires
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Mes Contenus Récents (Limité à 4) -->
                <div class="card quick-action-card mb-4 animate-fade-in">
                    <div class="card-header bg-white border-0 py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold text-success">
                                <i class="bi bi-clock-history me-2"></i>Mes 4 Derniers Contenus
                            </h4>
                            <a href="{{ url('/user/contenus') }}" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-list me-1"></i>Voir tout
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table content-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Limiter à 4 contenus récents
                                        $contenusLimites = $contenusRecents->take(4);
                                    @endphp
                                    @forelse($contenusLimites as $contenu)
                                    <tr>
                                        <td>
                                            <strong class="d-block">{{ Str::limit($contenu->titre, 40) }}</strong>
                                            <small class="text-muted">{{ $contenu->typeContenu->nom ?? 'Non classé' }}</small>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'brouillon' => 'secondary',
                                                    'en_attente' => 'warning', 
                                                    'publié' => 'success',
                                                    'rejeté' => 'danger'
                                                ];
                                                $statusIcons = [
                                                    'brouillon' => 'bi-pencil',
                                                    'en_attente' => 'bi-clock',
                                                    'publié' => 'bi-check-circle',
                                                    'rejeté' => 'bi-x-circle'
                                                ];
                                            @endphp
                                            <span class="status-badge bg-{{ $statusColors[$contenu->statut] ?? 'secondary' }}">
                                                <i class="bi {{ $statusIcons[$contenu->statut] ?? 'bi-pencil' }} me-1"></i>
                                                {{ $contenu->statut }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $contenu->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ url('/user/contenus/' . $contenu->id_contenu) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5">
                                            <i class="bi bi-file-earmark-text display-4 d-block mb-3 opacity-50"></i>
                                            Aucun contenu créé pour le moment
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Actions Rapides -->
                <div class="card quick-action-card animate-fade-in">
                    <div class="card-header bg-white border-0 py-4">
                        <h4 class="mb-0 fw-bold text-success">
                            <i class="bi bi-lightning me-2"></i>Actions Rapides
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ url('/user/contenus/create') }}" class="action-btn border-success text-success">
                                    <div class="action-icon bg-success text-white">
                                        <i class="bi bi-file-plus"></i>
                                    </div>
                                    <div>
                                        <strong>Créer un Contenu</strong>
                                        <div class="text-muted small mt-1">Partager du contenu culturel</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/user/medias/create') }}" class="action-btn border-warning text-warning">
                                    <div class="action-icon bg-warning text-white">
                                        <i class="bi bi-upload"></i>
                                    </div>
                                    <div>
                                        <strong>Uploader un Média</strong>
                                        <div class="text-muted small mt-1">Image, vidéo ou audio</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/user/profile') }}" class="action-btn border-info text-info">
                                    <div class="action-icon bg-info text-white">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <strong>Mon Profil</strong>
                                        <div class="text-muted small mt-1">Modifier mes informations</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/') }}" class="action-btn border-primary text-primary">
                                    <div class="action-icon bg-primary text-white">
                                        <i class="bi bi-globe"></i>
                                    </div>
                                    <div>
                                        <strong>Explorer</strong>
                                        <div class="text-muted small mt-1">Voir le site public</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Profil Utilisateur -->
                <div class="card profile-card mb-4 animate-fade-in">
                    <div class="card-header bg-white border-0 py-4">
                        <h4 class="mb-0 fw-bold text-success">
                            <i class="bi bi-person-badge me-2"></i>Mon Profil
                        </h4>
                    </div>
                    <div class="card-body text-center py-4">
                        <div class="profile-avatar">
                            {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
                        </div>
                        <h5 class="mb-2">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h5>
                        <p class="text-muted mb-3">{{ auth()->user()->email }}</p>
                        <div class="d-flex justify-content-center align-items-center text-muted small mb-3">
                            <i class="bi bi-calendar me-1"></i>
                            <span>Membre depuis {{ auth()->user()->created_at->format('d/m/Y') }}</span>
                        </div>
                        <a href="{{ url('/user/profile') }}" class="btn btn-success w-100 mb-2">
                            <i class="bi bi-pencil me-1"></i>Modifier le profil
                        </a>
                        <a href="{{ route('logout') }}" 
                           class="btn btn-outline-danger w-100"
                           onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">
                            <i class="bi bi-box-arrow-right me-1"></i>Se déconnecter
                        </a>
                        <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                <!-- Guide Utilisateur -->
                <div class="card guide-card animate-fade-in">
                    <div class="card-header bg-white border-0 py-4">
                        <h4 class="mb-0 fw-bold text-success">
                            <i class="bi bi-info-circle me-2"></i>Guide Rapide
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="guide-item">
                                <div class="guide-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div>
                                    <strong>Créez du contenu culturel</strong>
                                    <div class="text-muted small">Partagez vos connaissances</div>
                                </div>
                            </div>
                            <div class="guide-item">
                                <div class="guide-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div>
                                    <strong>Uploader des médias</strong>
                                    <div class="text-muted small">Images, vidéos, audio</div>
                                </div>
                            </div>
                            <div class="guide-item">
                                <div class="guide-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div>
                                    <strong>Commentez les contenus</strong>
                                    <div class="text-muted small">Échangez avec la communauté</div>
                                </div>
                            </div>
                            <div class="guide-item">
                                <div class="guide-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div>
                                    <strong>Partagez la culture</strong>
                                    <div class="text-muted small">Valorisez le patrimoine béninois</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-img">
                        <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin">
                    </div>
                    <div class="footer-brand-text">CULTURE BENIN</div>
                </div>
                <p class="footer-description">
                    Plateforme officielle de préservation et de promotion du patrimoine culturel béninois.
                    Nous œuvrons pour la sauvegarde et la valorisation de notre héritage culturel unique.
                </p>

                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            <div class="footer-nav">
                <h4 class="footer-heading">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}#accueil" class="footer-link">Accueil</a></li>
                    <li><a href="{{ url('/') }}#contenus" class="footer-link">Contenus Culturels</a></li>
                    <li><a href="{{ url('/') }}#medias" class="footer-link">Galerie Médias</a></li>
                    <li><a href="{{ url('/') }}#regions" class="footer-link">Régions</a></li>
                    <li><a href="{{ url('/') }}#langues" class="footer-link">Langues Locales</a></li>
                </ul>
            </div>

            <div class="footer-resources">
                <h4 class="footer-heading">Ressources</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}#apropos" class="footer-link">À Propos</a></li>
                    <li><a href="{{ url('/') }}#contact" class="footer-link">Contact</a></li>
                    <li><a href="#" class="footer-link">FAQ</a></li>
                    <li><a href="#" class="footer-link">Support</a></li>
                    <li><a href="#" class="footer-link">Mentions Légales</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4 class="footer-heading">Contact</h4>
                <div class="contact-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>Porto-Novo, Bénin</span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-envelope"></i>
                    <span>contact@culturebenin.bj</span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-phone"></i>
                    <span>+229 XX XX XX XX</span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-clock"></i>
                    <span>Lun - Ven: 8h - 18h</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-bottom-text">
                &copy; 2025 Culture Benin. Tous droits réservés. |
                <span style="color: var(--accent-color);">Patrimoine Culturel National</span> |
                Développé avec ❤️ pour le Bénin
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('mainHeader');
            
            // Animation du header au scroll
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });

            // Animation des éléments au chargement
            const animatedElements = document.querySelectorAll('.animate-fade-in');
            animatedElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>