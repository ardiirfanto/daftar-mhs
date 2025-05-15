<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mahasiswa Dashboard - Sistem Daftar Mahasiswa</title>
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
                            <h1 class="text-xl font-bold">Sistem Daftar Mahasiswa</h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="ml-3 relative">
                            <div class="flex items-center">
                                <span class="mr-2 text-gray-700">{{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-900">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Mahasiswa
                </h2>
            </div>
        </header>

        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="mt-1 text-gray-600">Anda telah berhasil login sebagai mahasiswa.</p>

                        @if(Auth::user()->mahasiswa)
                            <div class="mt-6">
                                <h4 class="text-md font-medium text-gray-900">Informasi Mahasiswa:</h4>
                                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-gray-500">NIM</p>
                                        <p class="mt-1 text-gray-900">{{ Auth::user()->mahasiswa->nim }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-gray-500">Program Studi</p>
                                        <p class="mt-1 text-gray-900">{{ Auth::user()->mahasiswa->prodi->nama_prodi }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-gray-500">Fakultas</p>
                                        <p class="mt-1 text-gray-900">{{ Auth::user()->mahasiswa->prodi->fakultas->nama_fakultas }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-gray-500">Tahun Masuk</p>
                                        <p class="mt-1 text-gray-900">{{ Auth::user()->mahasiswa->tahun_masuk }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-gray-500">Status</p>
                                        <p class="mt-1 text-gray-900">{{ ucfirst(Auth::user()->mahasiswa->status) }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-gray-500">Alamat</p>
                                        <p class="mt-1 text-gray-900">{{ Auth::user()->mahasiswa->alamat ?: '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mt-6 bg-yellow-50 p-4 rounded-lg">
                                <p class="text-yellow-700">Data mahasiswa belum lengkap. Silakan hubungi administrator.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
