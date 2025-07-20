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

    <div class="form-login items-center flex flex-col shadow-2xl backdrop-blur-xl border border-white/30 bg-gradient-to-r from-white/0 from-13% to-green-700/70 w-[529px] max-[1300px]:w-[480px] px-10 rounded-[16px] py-8 my-40">
        <img src="src/image/logo.png" alt="" class="w-[150px]">
        <div class="mt-8">
            <h1 class="text-center max-[1300px]:text-3xl text-4xl font-raleway text-green-800 font-bold">Daftar</h1>
            <p class="font-raleway text-white text-sm font-normal mt-2">Selamat datang</p>
        </div>
        <form action="{{ route('register') }}" enctype="multipart/form-data" method="POST" class="w-full">
            @csrf
            <input class="w-full placeholder px-3 rounded shadow py-2" type="text" hidden name="status" value="spv">
            <!-- Username -->
            <h3 class="text-white text-base font-raleway font-medium mb-2">Username</h3>
            <input class="w-full border bg-transparent rounded-full h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-green-800 px-5 placeholder-lato max-[1300px]:text-sm text-base" placeholder="Full Name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <!-- Email -->
            <h3 class="text-white text-base font-raleway font-medium mb-2 mt-4">Email</h3>
            <input class="w-full border bg-transparent rounded-full h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-green-800 px-5 placeholder-lato max-[1300px]:text-sm text-base" placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />

            <!-- Kata Sandi -->
            <h3 class="text-white text-base font-raleway font-medium mb-2 mt-4">Kata Sandi</h3>
            <div class="relative w-full">
                <input id="password" class="w-full border bg-transparent rounded-full h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-green-800 px-5 placeholder-lato max-[1300px]:text-sm text-base" type="password" name="password" placeholder="Password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <!-- Tombol Icon Mata -->
                <button type="button" onclick="togglePassword('password', 'eye-open-1', 'eye-closed-1')" class="absolute inset-y-0 right-4 flex items-center">
                    <!-- Mata Terbuka -->
                    <svg id="eye-open-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-[#035233]">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                    </svg>

                    <!-- Mata Tertutup (Hidden by default) -->
                    <img id="eye-closed-1" src="{{ asset('assets/img/mata.svg') }}" alt="Mata Tertutup" class="w-6 h-6 hidden">
                </button>
            </div>

            <!-- Konfirmasi Kata Sandi -->
            <h3 class="text-white text-base font-raleway font-medium mb-2 mt-4">Konfirmasi Kata Sandi</h3>
            <div class="relative w-full">
                <input id="password_confirmation" class="w-full border bg-transparent rounded-full h-[45px] text-white border-[#E7E3FC3B]/35 placeholder-green-800 px-5 placeholder-lato max-[1300px]:text-sm text-base" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <!-- Tombol Icon Mata -->
                <button type="button" onclick="togglePassword('password_confirmation', 'eye-open-2', 'eye-closed-2')" class="absolute inset-y-0 right-4 flex items-center">
                    <!-- Mata Terbuka -->
                    <svg id="eye-open-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-[#035233]">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                    </svg>

                    <!-- Mata Tertutup (Hidden by default) -->
                    <img id="eye-closed-2" src="{{ asset('assets/img/mata.svg') }}" alt="Mata Tertutup" class="w-6 h-6 hidden">
                </button>
            </div>

            <h1 class="text-green-800 font-medium mt-3 font-raleway mr-auto">Sudah punya akun? <a href="{{ route('login') }}" class="text-white">Masuk</a></h1>

            <button type="submit" class="mt-8 font-raleway max-[1300px]:text-sm font-semibold text-white bg-green-800 border border-[#E7E3FC3B]/35 rounded-full flex justify-center items-center text-base h-[55px] w-full">
                Daftar
            </button>
        </form>



    </div>



<!-- JavaScript untuk Toggle Password -->
    <script>
        function togglePassword(inputId, openIconId, closedIconId) {
            let input = document.getElementById(inputId);
            let eyeOpen = document.getElementById(openIconId);
            let eyeClosed = document.getElementById(closedIconId);

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            }
        }
    </script>
</body>
</html>


