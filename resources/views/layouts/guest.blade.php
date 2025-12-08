<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Culture Benin') }}</title>

    <!-- Bootstrap, Icons, and Fonts -->
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
            color: var(--dark-color);
        }
        .auth-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 0;
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
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6" style="animation: fadeInUp 0.5s ease-out;">
                    <div class="card auth-card">
                        @if (isset($header))
                            <div class="card-header text-center">
                                {{ $header }}
                            </div>
                        @endif

                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
