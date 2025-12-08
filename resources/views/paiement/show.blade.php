<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Paiement - {{ config('app.name') }}</title>

    <!-- Dépendances CSS (Bootstrap & Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e17000;
            --gradient-primary: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }
        .payment-card {
            max-width: 600px;
            width: 100%;
        }
        .card-header {
            background: var(--gradient-primary);
        }
        .btn-pay {
            background: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="payment-card">
        <div class="text-center mb-4">
            <a href="{{ url('/') }}">
                <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Logo" style="width: 70px; height: auto;">
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header text-white text-center py-4">
                <h4 class="mb-0 fw-bold">Débloquer l'accès au contenu</h4>
            </div>
            <div class="card-body p-4 p-md-5">
                <p class="text-center fs-5 mb-4">
                    Vous êtes sur le point de débloquer l'accès complet pour :
                </p>

                <div class="bg-light p-4 rounded-3 mb-4 text-center">
                    <h2 class="fw-bold text-dark fs-4">{{ $contenu->titre }}</h2>
                    <p class="text-muted mb-0">{{ Str::limit($contenu->texte, 120) }}</p>
                </div>

                <div class="d-flex justify-content-between align-items-center fs-4 mb-5">
                    <span class="text-muted">Montant total :</span>
                    <span class="fw-bolder text-success">${{ number_format($prix, 2) }}</span>
                </div>

                <form action="{{ route('paiement.process', $contenu) }}" method="POST">
                    @csrf
                    <div class="d-grid">
                        <button type="submit" class="btn-pay btn-lg text-white fw-bold py-3">
                            <i class="bi bi-stripe me-2"></i>Payer avec Stripe
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i>Non, retourner à l'accueil
                    </a>
                </div>
            </div>
            <div class="card-footer text-center py-3 bg-light">
                <small class="text-muted">
                    <i class="bi bi-lock-fill"></i> Paiement sécurisé via Stripe.
                </small>
            </div>
        </div>
    </div>
</body>
</html>
