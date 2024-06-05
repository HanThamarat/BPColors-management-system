<x-guest-layout>
    <div class="h-screen lg:flex">
        <div class="lg:w-3/6 lg:h-screen my-5 mx-5 lg:mx-0 lg:my-0">
            <img src="{{ asset('img/web-ck.png') }}" class="lg:h-full object-cover h-48 w-full rounded drop-shadow-md" alt="">
        </div>
        <div class="lg:w-3/6 bg-white justify-center rounded lg:rounded-none py-5 mx-5 my-5 lg:mx-0 lg:my-0 drop-shadow-md flex items-center">
            <div class="mx-5 md:mx-20 w-full">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-3xl font-bold mb-5">
                    <span id="typing"></span>
                </div>
                <div class="text-2xl font-medium">
                    <span>Login</span>
                </div>

                <x-validation-errors class="my-4 rounded px-2 py-3 bg-red-200 animate-fade-right" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                    <div class="my-5">
                        <x-label for="Username" value="{{ __('Username') }}" />
                        <x-input id="Username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                    </div>
                    <div class="my-5">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        {{-- <div>
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div> --}}
                    </div>
                    <button class="btn-sub w-full border h-10 border bg-blue-500 rounded text-white font-medium my-4 hover:bg-blue-600 duration-100 ease-in-out" type="submit" id="submitForm" onclick="loading()">
                        <p class="login-btn">Log In</p>
                        <div class='spiner hidden flex space-x-2 justify-center items-center dark:invert'>
                            <span class='sr-only'>Loading...</span>
                            <div class='h-2 w-2 bg-white rounded-full animate-bounce [animation-delay:-0.3s]'></div>
                            <div class='h-2 w-2 bg-white rounded-full animate-bounce [animation-delay:-0.15s]'></div>
                            <div class='h-2 w-2 bg-white rounded-full animate-bounce'></div>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        
        const loginEl = document.querySelector('.login-btn');
        const spinerEl = document.querySelector('.spiner');
        const submitEl = document.querySelector('.btn-sub');
        const DsBtn = document.getElementById('submitForm');

        document.title = 'BP | Login';

        function loading() {
            loginEl.classList.add('hidden');
            submitEl.classList.add('bg-blue-400');
            spinerEl.classList.remove('hidden');
            submitEl.classList.remove('hover:bg-blue-600');

            if(document.getElementById('Username').value.length != 0 && document.getElementById('password').value.length != 0) {
                console.log('not null');
                loginEl.classList.add('hidden');
                submitEl.classList.add('bg-blue-400');
                spinerEl.classList.remove('hidden');
                submitEl.classList.remove('hover:bg-blue-600');
            } else {
                console.log('null');
                loginEl.classList.remove('hidden');
                submitEl.classList.remove('bg-blue-400');
                spinerEl.classList.add('hidden');
                submitEl.classList.add('hover:bg-blue-600');
            }
           
        }

        var typed = new Typed('#typing', {
            strings: [
                '<span class="text-blue-600">Wellcome to</span>',
                '<span class="text-red-600">Chookiat</span> Group.'
            ],
            typeSpeed: 50,
            loop: true,
            typeSpeed: 100,
            backSpeed:100,
        });
    </script>
</x-guest-layout>
