<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMPSTI</title>
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- STYLE -->

    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body class="bg-login" style="background-image: url('{{ asset('assets/img/bg-login.jpg') }}');">
    {{-- <!-- Form Container -->
     <div class="form-container">
        <div class="col col-1">
            <div class="image-layer">
                <img src="{{ asset('assets/img/white-outline.png') }}" class="form-image-main" alt="">
                <img src="{{ asset('assets/img/dots.png') }}" class="form-image dots" alt="">
                <img src="{{ asset('assets/img/coin.png') }}" class="form-image coin" alt="">
                <img src="{{ asset('assets/img/spring.png') }}" class="form-image spring" alt="">
                <img src="{{ asset('assets/img/rocket.png') }}" class="form-image rocket" alt="">
                <img src="{{ asset('assets/img/cloud.png') }}" class="form-image cloud" alt="">
                <img src="{{ asset('assets/img/stars.png') }}" class="form-image stars" alt="">
            </div>
        </div>

        <div class="col col-2">
            <div class="btn-box">
                <a class="btn btn-2" href="{{ route('register') }}">Sign Up</a>
            </div>

            <!-- logins Form Container -->
            <div class="login-form active">
                <div class="form-tittle">
                    <span>Sign In</span>
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form action="{{ route('login') }}" method="POST" class="form-inputs">
                    @csrf
                    <div class="input-box">
                        <input id="email" class="w-full border rounded-full h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-[#C1C2C4] px-5 placeholder-lato max-[1300px]:text-sm text-base" type="email" name="email" required autofocus autocomplete="Email"  class="input-field" placeholder="Email"/>
                        <i class="bx bx-user icon"></i>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="input-box">
                        <input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" class="w-full border rounded-full h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-[#C1C2C4] px-5 placeholder-lato max-[1300px]:text-sm text-base pr-12" placeholder="Password"/>
                        <i class="bx bx-lock-alt icon"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <div class="forgot-pass">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="input-box">
                       <button class="input-submit">
                            <span>Sign In</span>
                            <i class="bx bx-right-arrow-alt"></i>
                       </button>
                    </div>
                </form>

            </div>
        </div>
     </div> --}}


     <div class="form-login items-center flex flex-col bg-[#181A1CD6] bg-opacity-[84%] w-[529px] max-[1300px]:w-[480px] px-10 rounded-[16px] py-8 my-40">
        <img src="src/image/logo.png" alt="" class="w-[150px]">
        <div class="mt-8 mb-5">
            <h1 class="text-center text-4xl max-[1300px]:text-3xl font-raleway text-white font-normal">Masuk</h1>
            <p class="font-raleway text-white text-sm font-normal mt-2">Selamat datang kembali!</p>
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form action="{{ route('login') }}" method="POST" class="w-full">
            @csrf
            <!-- Email -->
            <h3 class="text-white text-base font-raleway font-medium mb-2">Email</h3>
            <input id="email" class="w-full border rounded-full bg-transparent h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-[#C1C2C4] px-5 placeholder-lato max-[1300px]:text-sm text-base" type="email" name="email" required autofocus autocomplete="Email"  class="input-field" placeholder="Email"/>

            <!-- Kata Sandi -->
            <h3 class="text-white text-base font-raleway font-medium mb-2 mt-8">Kata Sandi</h3>
            <div class="relative w-full">
                <input id="password"
                type="password"
                name="password"
                required autocomplete="current-password" class="w-full border rounded-full bg-transparent h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-[#C1C2C4] px-5 placeholder-lato max-[1300px]:text-sm text-base pr-12" placeholder="Password"/>

                <!-- Tombol Icon Mata -->
                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-4 flex items-center">
                    <!-- Mata Terbuka -->
                    <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                    </svg>

                    <!-- Mata Tertutup (Hidden by default) -->
                    <img id="eye-closed" src="{{ asset('assets/img/mata.svg') }}" alt="Mata Tertutup" class="w-6 h-6 hidden">
                </button>
            </div>

            <div class="flex">
                <h1 class="text-[#C1C2C4] mt-3 font-raleway mr-auto">Belum punya akun? <a href="{{ route('register') }}" class="text-white">Daftar</a></h1>
                @if (Route::has('password.request'))
                <a class="mt-2 font-raleway text-white" href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Sandi?') }}
                </a>
                @endif
            </div>

            <button type="submit" class="mt-8 font-raleway font-semibold text-white bg-[#3D4142] border border-[#E7E3FC3B]/35 rounded-full flex justify-center items-center text-base max-[1300px]:text-sm h-[55px] w-full">
                Masuk
            </button>
        </form>



    </div>



<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeOpen = document.getElementById("eye-open");
        const eyeClosed = document.getElementById("eye-closed");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeOpen.classList.add("hidden");
            eyeClosed.classList.remove("hidden");
        } else {
            passwordInput.type = "password";
            eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
        }
    }
</script>
    <!-- JS -->

    {{-- <script src="{{ asset('assets/js/login.js') }}"></script> --}}
</body>
</html>


