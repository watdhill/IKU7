<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Monitoring Metode Pembelajaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center"
      style="background-image: url('https://www.unand.ac.id/images/Galeri%20Foto/Rektorat%20View.jpg');">

    <!-- Logo di kiri atas -->
    <div class="absolute top-6 left-6 flex items-center space-x-3 bg-white/80 backdrop-blur-md rounded-full shadow-md px-4 py-2">
        <img src="https://unand.ac.id/images/konten/Logo%20Unand%20PTNBH.png" 
             alt="Logo Universitas Andalas" class="w-10 h-10 object-contain">
        <div>
            <p class="text-sm font-semibold text-gray-800 leading-tight">Sistem IKU 7</p>
            <p class="text-xs text-gray-600">Universitas Andalas</p>
        </div>
    </div>

    <!-- Card Login -->
    <div class="bg-white/90 backdrop-blur-lg shadow-2xl rounded-3xl w-11/12 max-w-md mt-20 p-8 md:p-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login ke Akun Anda</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-800 focus:outline-none"
                    placeholder="contoh@unand.ac.id">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-800 focus:outline-none"
                    placeholder="Masukkan password">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2 rounded text-blue-900 focus:ring-blue-900">
                    Ingat saya
                </label>
            </div>

            <!-- Tombol -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 rounded-lg shadow-md transition duration-300">
                    Masuk
                </button>
            </div>
        </form>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 mt-8">
            © {{ date('Y') }} Sistem IKU 7 - Universitas Andalas
        </p>
    </div>
</body>
</html>
