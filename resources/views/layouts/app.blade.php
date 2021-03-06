<!DOCTYPE html>
<html>

<head>
    <title>AdiDash | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/dist/css/normalize.css" />
    <link rel="stylesheet" href="/dist/css/bulma.css" />
    <link rel="stylesheet" href="/dist/css/app.css" />
    <link rel="stylesheet" href="/dist/css/choices.min.css" />
    <link rel="stylesheet" href="/dist/css/bulma-tooltip.min.css" />
    @stack('styles')
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet" />

</head>

<body>
    <div class="sidebar">
        <h1>ADIDASH</h1>
        <a class="active" href="{{ route('student.home') }}">
            <div><i class="fas fa-home"></i></div>
            Accueil
        </a>
        <a href="{{ route('student.tasks.index') }}">
            <div><i class="fas fa-tasks"></i></div>
            Tâches
        </a>
        <a href="{{ route('student.projects.list') }}">
            <div><i class="far fa-lightbulb"></i></div>
            Projets
        </a>
        <a href="{{ route('meetings.index') }}">
            <div><i class="fas fa-calendar"></i></div>
            Agenda
        </a>

        @foreach (Auth::user()->ownedProjects as $project)
            <div class="nav-separator"></div>
            <a href="#" class="nav-header">{{ $project->name }}</a>
            <a href="{{ route('project-admin.home', ['project' => $project->id]) }}">
                <div><i class="fas fa-tools"></i></div>
                Gestion du projet
            </a>
            <a href="{{ route('project-admin.tasks', ['project' => $project->id]) }}">
                <div><i class="fas fa-tasks"></i></div>
                Tâches
            </a>
            <a href="#news">
                <div><i class="fas fa-users"></i></div>
                Membres de l'équipe
            </a>
        @endforeach

        @if (Auth::user()->hasCommitteeGroup())
            <div class="nav-separator"></div>
            <a href="{{ route('committee.home') }}" class="nav-header">Comité de projet</a>
            <a href="{{ route('committee.home') }}">
                <div><i class="fas fa-home"></i></div>
                Accueil
            </a>
            <a href="{{ route('committee.users') }}">
                <div><i class="fas fa-users"></i></div>
                Utilisateurs
            </a>
            <a href="{{ route('committee.projects') }}">
                <div><i class="far fa-lightbulb"></i></div>
                Projets
            </a>
            <a href="{{ route('committee.tags.list') }}">
                <div><i class="fas fa-tags"></i></div>
                Tags
            </a>
        @endif

        @if (Auth::user()->hasAdministrationGroup())
            <div class="nav-separator"></div>
            <a href="{{ route('administration.home') }}" class="nav-header">Administration</a>
            <a href="{{ route('administration.home') }}">
                <div><i class="fas fa-home"></i></div>
                Accueil
            </a>
        @endif
    </div>

    <div class="page-content">
        <div class="topbar">
            <div class="notifications">
                <p></p>
            </div>
            <div class="profile">
                <div class="dropdown">
                    <div class="dropdown-trigger">
                        <a aria-haspopup="true" aria-controls="dropdown-menu">
                            <span><i class="far fa-user"></i>{{ Auth::user()->fullName }}
                                @if (Auth::user()->hasClassGroup())
                                    ({{ Auth::user()->getClassGroups()->first()->name }}) @endif
                            </span>
                        </a>
                    </div>
                    <div class="dropdown-menu" id="dropdown-menu" role="menu">
                        <div class="dropdown-content">
                            <a class="dropdown-item" href={{ route('settings') }}>
                                <i class="fas fa-cog"></i> Paramètres
                            </a>
                            <a class="dropdown-item" href={{ route('logout') }}>
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="inner page-{{ str_replace('.', '-', $view_name) }}">
            <h2 class="page-title">
                @yield('page_name')
            </h2>
            @if (session('success'))
                <div class="notification is-success mb-2">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="notification is-danger mb-2">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script src="/dist/js/app.js"></script>
    <script src="/dist/js/choices.min.js"></script>

    @stack('scripts')
</body>

</html>
