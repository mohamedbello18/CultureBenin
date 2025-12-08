<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe - Culture Benin</title>
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
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #166FE5;
            border-color: #166FE5;
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
                        <h4 class="mb-0 fw-bold">Réinitialiser le mot de passe</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Réinitialiser le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
