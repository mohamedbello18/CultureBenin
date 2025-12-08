<style>
    :root {
        --primary-color: #1877F2;
        --secondary-color: #42B72A;
        --light-color: #F0F2F5;
        --dark-color: #1c1e21;
        --navbar-text-color: #495057; /* Gray-700 */
    }
    .user-navbar {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }
    .user-navbar .navbar-brand .brand-logo {
        height: 40px;
    }
    .user-navbar .navbar-brand .brand-text {
        font-weight: 700;
        color: var(--dark-color);
    }
    .user-navbar .nav-link {
        color: var(--navbar-text-color);
        font-weight: 500;
    }
    .user-navbar .nav-link.active {
        color: var(--primary-color);
        /* background-color: var(--light-color); */ /* Add a light background on active */
        font-weight: 700;
    }
    .user-navbar .dropdown-menu {
        border-radius: 0.5rem;
        border: 1px solid rgba(0,0,0,0.1);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    .user-navbar .dropdown-item {
        font-weight: 500;
    }

    .user-navbar .dropdown-item:hover {
        background-color: var(--light-color);
        color: var(--primary-color);
    }

    .user-navbar .dropdown-item i {
        width: 20px;
    }
</style>

<nav class="navbar navbar-expand-lg user-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin Logo" class="brand-logo me-2"/>
            <span class="brand-text">Culture Benin</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="userNavbar">
            <!-- Navigation Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Tableau de bord
                        Tableau de bord
                    </a>
                </li>
                {{-- You can add other user-specific links here --}}
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2 fs-5"></i>
                            {{ Auth::user()->prenom ?? Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i>Mon Profil
                                </a>
                            </li>
                            @if(Auth::user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-shield-lock me-2"></i>Panneau Admin
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Se déconnecter
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- This requires Bootstrap 5 JS to be loaded on the page that uses this layout. --}}
{{-- Make sure your profile page layout includes: --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
