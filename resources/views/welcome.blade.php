<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Benin - Patrimoine Culturel Béninois</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ asset('adminlte/img/logo-culture-benin.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1877F2; /* Facebook Blue */
            --secondary-color: #42B72A; /* Facebook Green for positive actions */
            --accent-color: #E7F3FF; /* Light blue accent/background */
            --dark-color: #1c1e21; /* Dark text color */
            --light-color: #F0F2F5; /* Main background gray */
            --gradient-primary: linear-gradient(135deg, #1877F2 0%, #166FE5 100%);
            --gradient-benin: linear-gradient(135deg, #1877F2 0%, #E7F3FF 100%);
            --gradient-gold: linear-gradient(135deg, #1877F2 0%, #166FE5 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-color);
            color: var(--dark-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Amélioration de la typographie et de la fluidité */
        h1, h2, h3 {
            line-height: 1.2;
        }

        /* ===== HEADER PROFESSIONNEL & RESPONSIVE ===== */
        .main-header {
            background: #ffffff;
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
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(225, 112, 0, 0.3);
            transition: all 0.3s ease;
            padding: 5px;
            position: relative;
            overflow: hidden;
        }

        .logo-wrapper:hover {
            transform: rotate(-5deg) scale(1.05);
        }

        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            background: white;
        }

        .logo-fallback {
            width: 100%;
            height: 100%;
            display: none;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            color: var(--primary-color);
            font-size: 1.5rem;
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

        /* Menu de navigation principal */
        .nav-main {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-link {
            font-weight: 600;
            color: var(--dark-color);
            text-decoration: none;
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
            display: block;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background: var(--accent-color);
        }

        .nav-link.active {
            color: var(--primary-color);
            background: rgba(225, 112, 0, 0.1);
        }

        .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        /* BOUTONS PROFESSIONNELS */
        .btn-auth {
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: 2px solid;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        /* BOUTONS POUR UTILISATEUR CONNECTÉ */
        .btn-dashboard {
            background: var(--primary-color);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(24, 119, 242, 0.25);
        }

        .btn-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(24, 119, 242, 0.4);
            color: white;
        }

        .btn-logout {
            background: transparent;
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-logout:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* BOUTONS POUR VISITEUR NON CONNECTÉ */
        .btn-login {
            background: transparent;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-login:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(225, 112, 0, 0.3);
        }

        .btn-register {
            background: var(--secondary-color);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(66, 183, 42, 0.25);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(66, 183, 42, 0.4);
            color: white;
        }

        /* Nouveau : Bouton pour menu mobile (Hamburger) */
        .menu-toggle-btn {
            display: none; /* Masqué par défaut sur desktop */
            background: none;
            border: none;
            font-size: 1.8rem;
            color: var(--dark-color);
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .menu-toggle-btn:hover {
            color: var(--primary-color);
        }

        /* ===== HERO SECTION AVEC VIDÉO OU IMAGE DE FOND ===== */
        .hero-section {
            position: relative;
            height: 100vh;
            min-height: 800px;
            color: white;
            overflow: hidden;
            display: flex;
            align-items: center;
            margin-top: 80px;
            /* Image de fallback et dégradé si la vidéo ne charge pas */
            background: linear-gradient(
                rgba(255, 255, 255, 0.1) 0%,
                rgba(255, 255, 255, 0.1) 100%
            ), url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') no-repeat center center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Styles de l'élément Vidéo */
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2; /* Sous la superposition (overlay) */
        }

        /* Superposition sombre pour la lisibilité du texte */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(24, 119, 242, 0.1); /* Overlay bleu très léger */
            z-index: -1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
            animation: fadeInTop 1s ease-out;
        }

        @keyframes fadeInTop {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
        }

        .hero-accent {
            color: var(--primary-color);
        }

        .hero-subtitle {
            font-size: 1.4rem;
            font-weight: 400;
            margin-bottom: 3rem;
            opacity: 0.95;
            max-width: 700px;
            line-height: 1.6;
            margin-left: auto;
            margin-right: auto;
            color: #4b4f56;
        }

        .btn-hero {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 1.3rem 3.5rem;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 12px 35px rgba(24, 119, 242, 0.3);
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-hero:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 20px 45px rgba(24, 119, 242, 0.4);
            color: white;
        }

        /* ===== SECTION STATISTIQUES AMÉLIORÉE (inchangée) ===== */
        .stats-section {
            background: #ffffff;
            padding: 100px 0;
            position: relative;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }

        .stat-item {
            background: white;
            padding: 2rem 1rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            border-top: 5px solid var(--primary-color);
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;            
            background: var(--accent-color);
            padding: 10px;
            border-radius: 50%;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--dark-color);
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.95rem;
            font-weight: 500;
            color: #666;
            margin-top: 0.5rem;
        }

        /* ===== SECTIONS CONTENUS & MEDIAS (Améliorées) ===== */
        .section-padding {
            padding: 100px 0;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 1rem;
            text-align: center;
            position: relative;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 100px;
            height: 5px;
            background: var(--gradient-primary);
            margin: 1.5rem auto;
            border-radius: 3px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #666;
            text-align: center;
            margin-bottom: 4rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        /* Section Contenus Récents */
        .recent-section {
            background: var(--light-color);
        }

        .content-preview-grid, .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .preview-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .preview-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
        }

        .preview-image {
            height: 180px;
            background: var(--gradient-benin);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .preview-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(24, 119, 242, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .preview-content {
            padding: 1.5rem;
        }

        .preview-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .preview-text {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .preview-meta, .media-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
            margin-top: 10px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Section Médias Récents */
        .media-section {
            background: white;
        }

        .media-card {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .media-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
        }

        .media-thumbnail {
            height: 180px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
        }

        .media-type {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.5);
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 0.75rem;
        }

        .media-content {
            padding: 1.5rem;
        }

        .media-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .media-description {
            font-size: 0.9rem;
            color: #666;
        }

        /* Style pour le texte tronqué et le bouton "Voir plus" */
        .preview-text-truncated {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Limite à 3 lignes */
            -webkit-box-orient: vertical;
            transition: -webkit-line-clamp 0.3s ease;
        }

        .preview-text-expanded {
            -webkit-line-clamp: unset;
        }

        .btn-see-more {
            background: none;
            border: none;
            color: var(--primary-color);
            font-weight: 600;
            padding: 0;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-see-more.hidden {
            display: none;
        }

        .btn-unlock {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }


        /* ===== FOOTER PROFESSIONNEL ===== */
        .main-footer {
            background: #ffffff;
            color: var(--dark-color);
            padding-top: 60px;
            border-top: 5px solid var(--secondary-color);
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem 40px;
        }

        .footer-brand {
            /* styles... */
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
            overflow: hidden;
        }

        .footer-logo-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
            background: white;
        }

        .footer-logo-fallback {
            width: 100%;
            height: 100%;
            display: none;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 5px;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .footer-brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-description {
            font-size: 0.95rem;
            color: #606770;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .btn-admin {
            background: var(--secondary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-admin:hover {
            background: #009900;
            box-shadow: 0 5px 20px rgba(0, 128, 0, 0.4);
            transform: translateY(-2px);
            color: white;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            font-size: 1.5rem;
            color: #606770;
            transition: color 0.3s ease;
        }

        .social-link:hover {
            color: var(--primary-color);
        }

        .footer-heading {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark-color);
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
            background: var(--primary-color);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-link {
            color: #606770;
            text-decoration: none;
            display: block;
            padding: 5px 0;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .footer-link:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #606770;
            margin-bottom: 10px;
        }

        .contact-item i {
            color: var(--primary-color);
        }

        .footer-bottom {
            background: var(--light-color);
            padding: 15px 2rem;
            text-align: center;
        }

        .footer-bottom-text {
            font-size: 0.85rem;
            color: #606770;
            margin: 0;
        }


        /* ===== RESPONSIVE DESIGN pour le Header (ajustements) ===== */

        @media (max-width: 1200px) {
            .hero-title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 992px) { /* Tablette */
            /* Header */
            .nav-main {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 82px;
                left: 0;
                width: 100%;                
                background: #ffffff;
                border-top: 1px solid rgba(0, 0, 0, 0.08);
                box-shadow: 0 8px 60px rgba(0, 0, 0, 0.12);
                padding: 2rem 0;
                transition: transform 0.4s ease-out;
                transform: translateX(-100%);
                height: 100vh; /* Menu prend toute la hauteur */
                overflow-y: auto;
            }

            .nav-main.active {
                display: flex;
                transform: translateX(0);
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 0;
            }

            .nav-links li {
                width: 100%;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }

            .nav-link {
                padding: 1rem 2rem;
                border-radius: 0;
                font-size: 1.1rem;
            }

            .nav-link.active:after {
                bottom: auto;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                width: 5px;
                height: 80%;
                right: auto;
            }

            .header-actions {
                display: none;
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 2rem 0;
                width: 100%;
            }

            .nav-main.active .header-actions {
                display: flex;
            }

            .btn-auth {
                width: 100%;
                justify-content: center;
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }

            .menu-toggle-btn {
                display: block;
            }
            /* Fin Header */

            .header-container {
                padding: 0 1rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
                padding: 0 1rem 40px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .content-preview-grid,
            .media-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }

            .footer-top {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .btn-hero {
                padding: 1rem 2.5rem;
                font-size: 1rem;
            }

            .section-padding {
                padding: 60px 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="main-header" id="mainHeader">
        <div class="header-container">
            <div class="logo-section">
                <div class="logo-wrapper">
                    <a href="{{ url('/') }}" class="brand-link text-white">
                        <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    </a>
                        <div class="logo-fallback">
                        <i class="bi bi-globe-africa"></i>
                    </div>
                </div>
                <div>
                    <div class="brand-text">CULTURE BENIN</div>
                    <div class="brand-tagline">Patrimoine Culturel National</div>
                </div>
            </div>

            <button class="menu-toggle-btn" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>

            <nav class="nav-main" id="mainNav">
                <ul class="nav-links">
                    <li><a href="#contenus" class="nav-link">Contenus</a></li>
                    <li><a href="#medias" class="nav-link">Médias</a></li>
                    <li><a href="#regions" class="nav-link">Régions</a></li>
                    <li><a href="#langues" class="nav-link">Langues</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                    <li><a href="#apropos" class="nav-link">A propos</a></li>
                </ul>

                <!-- Version mobile pour utilisateur connecté -->
                <div class="header-actions d-lg-none">
                    @auth
                    <a href="{{ url('/user/dashboard') }}" class="btn-auth btn-dashboard">
                        <i class="bi bi-speedometer2"></i>Tableau de Bord
                    </a>
                    <a href="{{ route('logout') }}"
                       class="btn-auth btn-logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn-auth btn-login">
                        <i class="bi bi-box-arrow-in-right"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn-auth btn-register">
                        <i class="bi bi-person-plus"></i>Inscription
                    </a>
                    @endauth
                </div>
            </nav>

            <!-- Version desktop pour utilisateur connecté -->
            <div class="header-actions d-none d-lg-flex">
                @auth
                <a href="{{ url('/user/dashboard') }}" class="btn-auth btn-dashboard">
                    <i class="bi bi-speedometer2"></i>Tableau de Bord
                </a>
                <a href="{{ route('logout') }}"
                   class="btn-auth btn-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();">
                    <i class="bi bi-box-arrow-right"></i>Déconnexion
                </a>
                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" class="btn-auth btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>Connexion
                </a>
                <a href="{{ route('register') }}" class="btn-auth btn-register">
                    <i class="bi bi-person-plus"></i>Inscription
                </a>
                @endauth
            </div>
        </div>
    </header>

    <section class="hero-section" id="accueil">
        <video autoplay muted loop playsinline class="video-background">
            <source src="{{ asset('/videos/benin-culture-ganvie.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="hero-content">
            <h1 class="hero-title" style="color: var(--dark-color); text-shadow: none;">
                Découvrez la Richesse<br>
                <span class="hero-accent">Culturelle du Bénin</span>
            </h1>
            <p class="hero-subtitle" style="color: #4b4f56;">
                Explorez le patrimoine exceptionnel du Bénin à travers ses traditions ancestrales,
                ses langues locales, ses arts vivants et son héritage historique unique.
                Une immersion totale dans l'âme de la nation.
            </p>
            <a href="#contenus" class="btn-hero">
                <i class="bi bi-compass me-2"></i>Commencer l'Exploration
            </a>
        </div>
    </section>

    <section class="stats-section">
        <div class="stats-container">
            <h2 class="section-title">Notre Patrimoine en Chiffres</h2>
            <p class="section-subtitle">
                Découvrez l'étendue de notre collection culturelle à travers ces chiffres significatifs
            </p>

            <div class="stats-grid">
                <div class="stat-item">
                    <i class="bi bi-journal-richtext stat-icon"></i>
                    <div class="stat-number" data-count="{{ $stats['contenus'] }}">0</div>
                    <div class="stat-label">Contenus Culturels</div>
                </div>
                <div class="stat-item">
                    <i class="bi bi-images stat-icon"></i>
                    <div class="stat-number" data-count="{{ $stats['medias'] }}">0</div>
                    <div class="stat-label">Médias Numériques</div>
                </div>
                <div class="stat-item">
                    <i class="bi bi-translate stat-icon"></i>
                    <div class="stat-number" data-count="{{ $stats['langues'] }}">0</div>
                    <div class="stat-label">Langues Locales</div>
                </div>
                <div class="stat-item">
                    <i class="bi bi-geo-alt stat-icon"></i>
                    <div class="stat-number" data-count="{{ $stats['regions'] }}">0</div>
                    <div class="stat-label">Régions Couvertes</div>
                </div>
            </div>
        </div>
    </section>

    <section id="contenus" class="section-padding recent-section">
        <div class="container">
            <h2 class="section-title">Contenus Récents</h2>
            <p class="section-subtitle">
                Découvrez les derniers articles et documents culturels ajoutés à notre plateforme
            </p>

            <div class="content-preview-grid">
                @php
                    $contenusRecents = \App\Models\Contenu::with(['typeContenu', 'region', 'langue'])
                        ->where('statut', 'publié')
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
                @endphp
                @forelse($contenusRecents as $contenu)
                <div class="preview-card">
                    <div class="preview-image">
                        <i class="bi bi-journal-richtext"></i>
                        <div class="preview-badge">
                            {{ $contenu->type_contenu->nom ?? 'Article' }}
                        </div>
                    </div>
                    <div class="preview-content">
                        <h3 class="preview-title">{{ Str::limit($contenu->titre, 60) }}</h3>

                        @if(!in_array($contenu->id_contenu, $paidContentIds))

                            {{-- L'utilisateur n'a pas payé ou n'est pas connecté : on affiche un extrait et un bouton pour payer --}}
                            <p class="preview-text">{{ Str::limit($contenu->texte, 150) }}</p>
                            @guest
                                {{-- Si visiteur, rediriger vers la connexion --}}
                                <a href="{{ route('login') }}" class="btn-unlock">
                                    <i class="bi bi-unlock-fill"></i>
                                    <span>Débloquer pour lire</span>
                                </a>
                            @else
                                {{-- Si connecté, rediriger vers la page de paiement --}}
                                <a href="{{ route('paiement.show', $contenu) }}" class="btn-unlock">
                                    <i class="bi bi-unlock-fill"></i>
                                    <span>Débloquer pour lire ($1.00)</span>
                                </a>
                            @endguest
                        @else
                            {{-- L'utilisateur a payé : on affiche le contenu complet avec "Voir plus" --}}
                            <p class="preview-text preview-text-truncated" data-fulltext="{{ $contenu->texte }}">{{ $contenu->texte }}</p>
                            <button class="btn-see-more hidden">Voir plus</button>
                        @endif

                        <div class="preview-meta">
                            <div class="meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $contenu->region->nom ?? 'Bénin' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-calendar"></i>
                                <span>{{ $contenu->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="preview-card">
                    <div class="preview-image" style="background: #f8f9fa;">
                        <i class="bi bi-file-earmark-text text-muted"></i>
                    </div>
                    <div class="preview-content text-center">
                        <h3 class="preview-title text-muted">Aucun contenu disponible</h3>
                        <p class="preview-text">De nouveaux contenus seront bientôt publiés</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="medias" class="section-padding media-section">
        <div class="container">
            <h2 class="section-title">Médias Récents</h2>
            <p class="section-subtitle">
                Explorez notre dernière collection d'images et vidéos culturelles
            </p>

            <div class="media-grid">
                @php
                    $mediasRecents = \App\Models\Media::with('typeMedia')
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
                @endphp
                @forelse($mediasRecents as $media)
                <div class="media-card">
                    <div class="media-thumbnail">
                        <div class="media-type">
                            {{ $media->type_media->nom ?? 'Média' }}
                        </div>
                        <i class="bi bi-{{ $media->type_media->nom == 'Image' ? 'image' : 'camera-video' }}"></i>
                    </div>
                    <div class="media-content">
                        <h4 class="media-title">{{ Str::limit($media->description, 50) }}</h4>
                        <p class="media-description">{{ Str::limit($media->Chemin, 80) }}</p>
                        <div class="media-meta">
                            <span>{{ $media->created_at->format('d/m/Y') }}</span>
                            <span>{{ $media->type_media->nom ?? 'Fichier' }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="media-card">
                    <div class="media-thumbnail" style="background: #f8f9fa;">
                        <i class="bi bi-images text-muted"></i>
                    </div>
                    <div class="media-content text-center">
                        <h4 class="media-title text-muted">Aucun média disponible</h4>
                        <p class="media-description">Notre galerie sera bientôt enrichie</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-img">
                        <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="footer-logo-fallback">
                            <i class="bi bi-globe-africa"></i>
                        </div>
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
                    <li><a href="#accueil" class="footer-link">Accueil</a></li>
                    <li><a href="#contenus" class="footer-link">Contenus Culturels</a></li>
                    <li><a href="#medias" class="footer-link">Galerie Médias</a></li>
                    <li><a href="#regions" class="footer-link">Régions</a></li>
                    <li><a href="#langues" class="footer-link">Langues Locales</a></li>
                </ul>
            </div>

            <div class="footer-resources">
                <h4 class="footer-heading">Ressources</h4>
                <ul class="footer-links">
                    <li><a href="#apropos" class="footer-link">À Propos</a></li>
                    <li><a href="#contact" class="footer-link">Contact</a></li>
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
                <span style="color: var(--primary-color);">Patrimoine Culturel National</span> |
                Développé avec ❤️ pour le Bénin
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('mainHeader');
            const menuToggle = document.getElementById('menuToggle');
            const mainNav = document.getElementById('mainNav');
            const navLinks = document.querySelectorAll('.nav-link');

            // 1. Animation du header au scroll
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });

            // 2. Gestion du menu mobile (Hamburger)
            menuToggle.addEventListener('click', function() {
                const isExpanded = mainNav.classList.toggle('active');
                menuToggle.querySelector('i').className = isExpanded ? 'bi bi-x-lg' : 'bi bi-list';

                // Gérer le défilement du body pour éviter que l'arrière-plan ne bouge derrière le menu
                document.body.style.overflow = isExpanded ? 'hidden' : 'auto';
            });

            // Fermer le menu mobile lors du clic sur un lien
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (mainNav.classList.contains('active')) {
                        mainNav.classList.remove('active');
                        menuToggle.querySelector('i').className = 'bi bi-list';
                        document.body.style.overflow = 'auto'; // Rétablir le défilement
                    }
                });
            });

            // 3. Animation des statistiques avec compteur (Logique inchangée)
            function animateCounter(element, target) {
                let current = 0;
                const stepIncrement = target / 75; // 75 steps pour 1.5s

                const timer = setInterval(() => {
                    current += stepIncrement;
                    if (current >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current);
                    }
                }, 20);
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const statNumbers = document.querySelectorAll('.stat-number');
                        statNumbers.forEach(stat => {
                            if (stat.getAttribute('data-counted') !== 'true') {
                                const target = parseInt(stat.getAttribute('data-count'));
                                animateCounter(stat, target);
                                stat.setAttribute('data-counted', 'true');
                            }
                        });
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }


            // 4. Navigation active et Smooth scroll (Logique ajustée pour header fixe)
            const sections = document.querySelectorAll('section');

            const updateNavActive = () => {
                let current = '';
                const headerHeight = header.offsetHeight;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    // Déclencher lorsque la position de défilement dépasse le haut de la section moins la hauteur du header
                    if (scrollY >= (sectionTop - headerHeight - 1)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href').substring(1) === current) {
                        link.classList.add('active');
                    }
                });
            };

            window.addEventListener('scroll', updateNavActive);
            updateNavActive(); // Appel initial pour définir le lien actif au chargement

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const target = document.querySelector(targetId);

                    if (target) {
                        const headerHeight = document.getElementById('mainHeader').offsetHeight;
                        // Ajustement de la position cible pour le défilement fluide
                        const targetPosition = target.offsetTop - headerHeight + 1;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // 5. Gestion du "Voir plus" pour les descriptions de contenu
            document.querySelectorAll('.preview-content').forEach(content => {
                const textElement = content.querySelector('.preview-text-truncated');
                const button = content.querySelector('.btn-see-more');

                // Vérifier si le texte est réellement tronqué par le CSS
                if (textElement && button && textElement.scrollHeight > textElement.clientHeight) {
                    button.classList.remove('hidden'); // Afficher le bouton
                }

                if (button) {
                    button.addEventListener('click', function() {
                    textElement.classList.toggle('preview-text-expanded');

                    if (textElement.classList.contains('preview-text-expanded')) {
                        this.textContent = 'Voir moins';
                    } else {
                        this.textContent = 'Voir plus';
                    }
                    });
                };
            });
        });
    </script>
</body>
</html>
