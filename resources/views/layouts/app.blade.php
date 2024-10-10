<!DOCTYPE html>
<html lang="en">
    @include('Include.head')  
    <body class="font-sans antialiased">
        <x-banner />
        @include('Include.AD_BodyTop')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('modals')
        @livewireScripts
    </body>
</html>
