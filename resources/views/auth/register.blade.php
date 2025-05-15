<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Sistem Pendaftaran Skripsi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        <div class="w-[60%] mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-center text-2xl font-bold mb-6">Register Pendaftaran Skripsi</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('processRegister') }}">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="nim" class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                        <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="prodi_id" class="block text-gray-700 text-sm font-bold mb-2">Program Studi</label>
                        <select id="prodi_id" name="prodi_id" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih Program Studi</option>
                            @foreach (\App\Models\Prodi::all() as $prodi)
                                <option value="{{ $prodi->id }}"
                                    {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tahun_masuk" class="block text-gray-700 text-sm font-bold mb-2">Tahun Masuk</label>
                        <input id="tahun_masuk" type="text" name="tahun_masuk" value="{{ old('tahun_masuk') }}"
                            required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="judul_skripsi" class="block text-gray-700 text-sm font-bold mb-2">Judul
                            Skripsi</label>
                        <textarea id="judul_skripsi" name="judul_skripsi" rows="2"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('judul_skripsi') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="dosen_pembimbing" class="block text-gray-700 text-sm font-bold mb-2">Dosen
                            Pembimbing</label>
                        <input id="dosen_pembimbing" type="text" name="dosen_pembimbing"
                            value="{{ old('dosen_pembimbing') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="status_skripsi" class="block text-gray-700 text-sm font-bold mb-2">Status
                            Skripsi</label>
                        <select id="status_skripsi" name="status_skripsi" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="belum_mulai" {{ old('status_skripsi') == 'belum_mulai' ? 'selected' : '' }}>
                                Belum Mulai</option>
                            <option value="proposal" {{ old('status_skripsi') == 'proposal' ? 'selected' : '' }}>
                                Proposal</option>
                            <option value="penelitian" {{ old('status_skripsi') == 'penelitian' ? 'selected' : '' }}>
                                Penelitian</option>
                            <option value="sidang" {{ old('status_skripsi') == 'sidang' ? 'selected' : '' }}>Sidang
                            </option>
                            <option value="selesai" {{ old('status_skripsi') == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_mulai_skripsi" class="block text-gray-700 text-sm font-bold mb-2">Tanggal
                            Mulai Skripsi</label>
                        <input id="tanggal_mulai_skripsi" type="date" name="tanggal_mulai_skripsi"
                            value="{{ old('tanggal_mulai_skripsi') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation"
                            class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="no_hp" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP</label>
                        <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex items-center justify-between mt-3">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Daftar
                        </button>
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                            Sudah punya akun?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
