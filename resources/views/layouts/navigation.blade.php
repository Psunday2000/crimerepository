<nav class="p-12 navbar navbar-expand-lg bg-white border-b border-gray-100">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"> {{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crimes.index') }}" :active="request()->routeIs('crimes.index')"> {{ __('Crimes') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('casefiles.index') }}" :active="request()->routeIs('casefiles.index')"> {{ __('Case Files') }}</a>
                </li>
            </ul>

            @auth
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>    
            @endauth
        </div>
    </div>
</nav>