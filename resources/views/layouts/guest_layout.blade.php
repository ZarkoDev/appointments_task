<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Labforty</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="public/img/favicon.ico">

    <!-- Template -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])</head>

<body class="has-sidebar has-fixed-sidebar-and-header">
<!-- Header -->
<header class="header bg-body">
    <nav class="navbar flex-nowrap p-0">
        <div class="navbar-brand-wrapper d-flex align-items-center col-auto">
            <a class="navbar-brand navbar-brand-desktop" href="/">
                <img class="side-nav-hide-on-closed" src="{{asset('img/logo.png')}}" alt="Graindashboard" style="width: auto; height: 33px;">
            </a>
        </div>
    </nav>
</header>
<!-- End Header -->

<main class="main">
    @include('components.sidebar-nav')

    @yield('content-wrapper')
</main>


<script src="public/graindashboard/js/graindashboard.js"></script>
<script src="public/graindashboard/js/graindashboard.vendor.js"></script>

</body>
</html>
