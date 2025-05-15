@extends('app')

@section('content')
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Data Mahasiswa</h3>
        <p class="mt-1 text-gray-600">Berikut adalah data mahasiswa yang terdaftar.</p>
        <div class="mt-6">
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">NIM</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Program Studi</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td class="border px-4 py-2">{{ $mhs->nim }}</td>
                            <td class="border px-4 py-2">{{ $mhs->user->name }}</td>
                            <td class="border px-4 py-2">{{ $mhs->user->email }}</td>
                            <td class="border px-4 py-2">{{ $mhs->prodi->nama_prodi }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.mahasiswa.show', ['id' => encrypt($mhs->id)]) }}"
                                    class="text-blue-500 hover:underline">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
