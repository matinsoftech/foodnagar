<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ setting('localeCode', 'en') }}"
    dir="{{ isRTL() ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ setting('favicon') }}" />
    <title>@yield('title', '') - {{ setting('websiteName', env('APP_NAME')) }}</title>
    @include('layouts.partials.styles')
    @yield('styles')
    @stack('styles')
    <style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
</head>

<body>
    <!-- Loader -->
    <div id="page-loader"
        style="position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255,255,255,0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;">
        <div class="loader-spinner"
            style="border: 6px solid #f3f3f3;
                    border-top: 6px solid #3498db;
                    border-radius: 50%;
                    width: 50px;
                    height: 50px;
                    animation: spin 1s linear infinite;">
        </div>
    </div>

    <div class="flex h-screen bg-gray-50" :class="{ 'overflow-hidden': isSideMenuOpen }">

        <!-- Desktop sidebar -->
        @include('layouts.partials.nav.desktop')

        <!-- Mobile sidebar -->
        @include('layouts.partials.nav.mobile')

        <div class="flex flex-col flex-1 w-full">

            {{-- header --}}
            @livewire('header.profile')



            <main class="h-full overflow-y-auto">
                <div class="container grid px-6 py-5 mx-auto">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </main>

            {{-- subscription --}}
            @livewire('header.subscription')
        </div>
    </div>
<script>
    window.addEventListener('load', function () {
        document.getElementById('page-loader').style.display = 'none';
    });
</script>

    @include('layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
