<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BP COLOR By Mitsubishi Chookait') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        />
        <link rel="icon" type="image/x-icon" href="{{ asset('img/logo-title.jpeg') }}">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.lordicon.com/lordicon.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-prompt antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @include('layouts.model-locscreen')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script>
            AOS.init();
        </script>
        @include('sweetalert::alert')
        <script>
            console.log('👨🏻‍💻 System is ready!');
            const countdownDisplay = document.getElementById("countdown");
            let countdownTime;
            let timer;
            let minutes, seconds;
            let countdownInterval;
            $(document).ready(function() {
                let timeOutId;

                $("#close-modal").click(function() {
                    $('#modal').addClass('hidden');
                    $('#modal').removeClass('flex');
                })

                $("#close-modal-2").click(function() {
                    $('#modal').addClass('hidden');
                    $('#modal').removeClass('flex');
                })

                function startLockScreen() {
                    timeOutId = setTimeout(() => {
                        countdown(120, countdownDisplay);
                        console.log('👋 Not event in system');
                        $('#modal').removeClass('hidden');
                        $('#modal').addClass('flex');
                    }, 100000);
                }

                function resetTimer() {
                    console.log('✅ Active event in system');
                    clearTimeout(timeOutId);
                    clearTimeout(timer);
                    clearTimeout(minutes);
                    clearTimeout(seconds);
                    clearInterval(countdownInterval);
                    startLockScreen();
                }

                document.addEventListener("mousemove", resetTimer);
                document.addEventListener("keydown", resetTimer);

                startLockScreen();

                function countdown(durationInSeconds, displayElement) {
                    timer = durationInSeconds;

                    countdownInterval = setInterval(function () {
                        minutes = parseInt(timer / 60, 10);
                        seconds = parseInt(timer % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        displayElement.textContent = minutes + ":" + seconds;

                        console.log(`🎉 Countdown for your : ${countdownTime}`);

                        countdownTime = minutes + ":" + seconds;

                        if (--timer < 0) {
                            window.location.href = "{{ route('lockscreen') }}";
                        }
                    }, 1000);
                }
            })
        </script>
    </body>
</html>
