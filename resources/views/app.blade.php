<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Sistem Daftar Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <h1 class="text-xl font-bold">Sistem Pendaftaran Skripsi Mahasiswa</h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="ml-3 relative">
                            <div class="flex items-end flex-col">
                                <span class="mr-2 text-xs text-gray-700 font-semibold">
                                    Login As : {{ Auth::user()->name }}
                                </span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm font-bold text-white bg-red-500 hover:bg-red-700 px-2 py-1 rounded-lg">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @include('menu')

        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>

</html>
