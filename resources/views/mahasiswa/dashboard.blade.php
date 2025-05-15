@extends('app')

@section('content')
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Selamat Datang, {{ Auth::user()->name }}!</h3>
        <p class="mt-1 text-gray-600">Anda telah berhasil login sebagai mahasiswa.</p>

        @if (Auth::user()->mahasiswa)
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
@endsection
