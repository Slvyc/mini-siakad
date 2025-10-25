<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MINI SIAKAD</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">MINI SIAKAD</h1>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
                <a href="{{ route('login.admin.post') }}" class="text-gray-700 hover:text-blue-600 transition">Login
                    Admin</a>
                <a href="{{ route('register') }}"
                    class="text-blue-600 font-semibold hover:text-blue-700 transition">Pendaftaran</a>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
@vite('resources/js/app.js')

</html>