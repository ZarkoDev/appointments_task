<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Labforty</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Template -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])</head>

<body class="has-sidebar has-fixed-sidebar-and-header">
<header class="header bg-body">
    <nav class="navbar flex-nowrap p-0">
        <div class="navbar-brand-wrapper d-flex align-items-center col-auto">
            <a class="navbar-brand navbar-brand-desktop" href="/">
                <img class="side-nav-hide-on-closed" src="{{asset('img/logo.png')}}" style="width: auto; height: 33px;">
            </a>
        </div>
    </nav>
</header>

<main class="main">
    @include('components.sidebar-nav')

    <div class="content">
        <div class="py-4 px-3 px-md-4">
            <x-alerts-container />

            <div class="card mb-3 mb-md-4">
                @yield('content-wrapper')
            </div>
        </div>
    </div>
</main>


@stack('scripts')

</body>
</html>
