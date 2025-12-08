<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'Email - Culture Benin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ asset('adminlte/img/logo-culture-benin.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1877F2;
            --light-color: #F0F2F5;
            --dark-color: #1c1e21;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--dark-color);
        }
        .auth-card {
            width: 100%;
            max-width: 500px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .auth-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 2rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .auth-card .brand-logo {
            height: 50px;
            margin-bottom: 1rem;
        }
        .auth-card .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #166FE5;
            border-color: #166FE5;
        }
        .btn-link {
            color: #6c757d;
            text-decoration: none;
        }
        .btn-link:hover {
            color: var(--dark-color);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <div class="card auth-card">
                    <div class="card-header text-center">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin Logo" class="brand-logo">
                        </a>
                        <h4 class="mb-0 fw-bold">Vérifiez votre adresse e-mail</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-4">
                            Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons un autre avec plaisir.
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de votre inscription.
                            </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    Renvoyer l'e-mail de vérification
                                </button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    Se déconnecter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
